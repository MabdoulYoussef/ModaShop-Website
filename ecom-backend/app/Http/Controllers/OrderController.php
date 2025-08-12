<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Show checkout form
    public function checkout()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to checkout');
        }

        $cart = $user->cart()->with('cartItems.product')->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $total = $this->calculateCartTotal($cart->cartItems);

        return view('orders.checkout', compact('cart', 'total'));
    }

    // Process order
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to place order');
        }

        $validated = $request->validate([
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_postal_code' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);

        $cart = $user->cart()->with('cartItems.product')->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Check stock before creating order
        foreach ($cart->cartItems as $item) {
            if ($item->product->stock < $item->quantity) {
                return back()->with('error', 'Insufficient stock for ' . $item->product->name);
            }
        }

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . time() . '-' . $user->id,
                'status' => 'pending',
                'shipping_address' => $validated['shipping_address'],
                'shipping_city' => $validated['shipping_city'],
                'shipping_postal_code' => $validated['shipping_postal_code'],
                'shipping_country' => $validated['shipping_country'],
                'notes' => $validated['notes'] ?? null,
                'total_amount' => $this->calculateCartTotal($cart->cartItems),
            ]);

            // Create order items and reduce stock
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
}
