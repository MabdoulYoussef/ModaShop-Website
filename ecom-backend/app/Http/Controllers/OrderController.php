<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Show checkout form
    public function checkout()
    {
        $user = Auth::user();
        $cart = null;
        $total = 0;

        if ($user) {
            // Authenticated user checkout
            $cart = $user->cart()->with('cartItems.product')->first();

            if (!$cart || $cart->cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty');
            }

            $total = $this->calculateCartTotal($cart->cartItems);
        } else {
            // Guest checkout - check session cart
            $sessionCart = session('cart', []);

            if (empty($sessionCart)) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty');
            }

            $total = $this->calculateSessionCartTotal($sessionCart);
        }

        return view('orders.checkout', compact('cart', 'total', 'user'));
    }

    // Process order
    public function store(Request $request)
    {
        $user = Auth::user();
        $isGuest = !$user;

        // Validate customer information for guest checkout
        if ($isGuest) {
            $validated = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'city' => 'required|string|max:255',
                'shipping_address' => 'required|string|max:500',
                'shipping_city' => 'required|string|max:100',
                'shipping_state' => 'required|string|max:100',
                'shipping_zip' => 'required|string|max:20',
                'shipping_country' => 'required|string|max:100',
                'payment_method' => 'required|string|max:100',
                'notes' => 'nullable|string|max:1000',
            ]);
        } else {
            $validated = $request->validate([
                'shipping_address' => 'required|string|max:500',
                'shipping_city' => 'required|string|max:100',
                'shipping_state' => 'required|string|max:100',
                'shipping_zip' => 'required|string|max:20',
                'shipping_country' => 'required|string|max:100',
                'payment_method' => 'required|string|max:100',
                'notes' => 'nullable|string|max:1000',
            ]);
        }

        // Get cart items based on user type
        if ($isGuest) {
            $sessionCart = session('cart', []);
            if (empty($sessionCart)) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty');
            }

            // Check stock for session cart
            foreach ($sessionCart as $item) {
                $product = Product::find($item['product_id']);
                if (!$product || $product->stock < $item['quantity']) {
                    return back()->with('error', 'Insufficient stock for ' . ($product ? $product->name : 'product'));
                }
            }

            $total = $this->calculateSessionCartTotal($sessionCart);
        } else {
            $cart = $user->cart()->with('cartItems.product')->first();
            if (!$cart || $cart->cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty');
            }

            // Check stock for authenticated user cart
            foreach ($cart->cartItems as $item) {
                if ($item->product->stock < $item->quantity) {
                    return back()->with('error', 'Insufficient stock for ' . $item->product->name);
                }
            }

            $total = $this->calculateCartTotal($cart->cartItems);
        }

        try {
            DB::beginTransaction();

            // Handle customer creation/lookup for guest checkout
            $customer = null;
            if ($isGuest) {
                $customer = Customer::findOrCreateByPhone(
                    $validated['phone'],
                    $validated['firstname'],
                    $validated['lastname'],
                    $validated['city']
                );
            }

            // Create order
            $orderData = [
                'user_id' => $user ? $user->id : null,
                'customer_id' => $customer ? $customer->id : null,
                'status' => 'pending',
                'shipping_address' => $validated['shipping_address'],
                'shipping_city' => $validated['shipping_city'],
                'shipping_state' => $validated['shipping_state'],
                'shipping_zip' => $validated['shipping_zip'],
                'shipping_country' => $validated['shipping_country'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
                'notes' => $validated['notes'] ?? null,
                'total_price' => $total,
            ];

            // Add customer info for guest orders
            if ($isGuest) {
                $orderData['customer_firstname'] = $validated['firstname'];
                $orderData['customer_lastname'] = $validated['lastname'];
                $orderData['customer_phone'] = $validated['phone'];
                $orderData['customer_city'] = $validated['city'];
            }

            $order = Order::create($orderData);

            // Create order items and reduce stock
            if ($isGuest) {
                foreach ($sessionCart as $item) {
                    $product = Product::find($item['product_id']);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                    ]);

                    // Reduce stock
                    $product->decrement('stock', $item['quantity']);
                }

                // Clear session cart
                session()->forget('cart');
            } else {
                foreach ($cart->cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                    ]);

                    // Reduce stock
                    $item->product->decrement('stock', $item->quantity);
                }

                // Clear cart
                $cart->cartItems()->delete();
            }

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                            ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while placing your order. Please try again.');
        }
    }

    // Show user's orders
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view orders');
        }

        $orders = $user->orders()
                      ->with('orderItems.product')
                      ->latest()
                      ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    // Show a single order
    public function show($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view order');
        }

        $order = $user->orders()
                      ->with(['orderItems.product', 'user'])
                      ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    // Cancel order
    public function cancel($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to cancel order');
        }

        $order = $user->orders()->findOrFail($id);

        if ($order->status !== 'pending') {
            return back()->with('error', 'Only pending orders can be cancelled');
        }

        try {
            DB::beginTransaction();

            // Restore stock
            foreach ($order->orderItems as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            $order->update(['status' => 'cancelled']);

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                            ->with('success', 'Order cancelled successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while cancelling the order');
        }
    }

    // Calculate cart total
    private function calculateCartTotal($cartItems): float
    {
        return $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        });
    }

    // Calculate session cart total for guest users
    private function calculateSessionCartTotal($sessionCart): float
    {
        $total = 0;
        foreach ($sessionCart as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $total += $item['quantity'] * $product->price;
            }
        }
        return $total;
    }
}
