<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Show checkout form for all customers (session-based only)
     *
     * This function:
     * 1. Loads cart from session
     * 2. Calculates total
     * 3. Shows checkout form
     *
     * No authentication required - open to all customers
     */
    public function checkout()
    {
        $sessionCart = session('cart', []);

        if (empty($sessionCart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $total = $this->calculateSessionCartTotal($sessionCart);

        return view('orders.checkout', compact('total'));
    }

    /**
     * Process order for all customers (session-based only)
     *
     * This function:
     * 1. Validates customer information (firstname, lastname, phone, city)
     * 2. Validates shipping information (address, city)
     * 3. Creates or finds customer by phone number
     * 4. Creates order and order items
     * 5. Reduces product stock
     * 6. Clears session cart
     *
     * No authentication required - open to all customers
     */
    public function store(Request $request)
    {
        // Validate customer information
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|string|max:100',
        ]);

        // Get session cart
        $sessionCart = session('cart', []);
        if (empty($sessionCart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Check stock for all items
        foreach ($sessionCart as $item) {
            $product = Product::find($item['product_id']);
            if (!$product || $product->stock < $item['quantity']) {
                return back()->with('error', 'Insufficient stock for ' . ($product ? $product->name : 'product'));
            }
        }

        $total = $this->calculateSessionCartTotal($sessionCart);

        // If credit card payment, redirect to payment page (only if enabled)
        if ($validated['payment_method'] === 'بطاقة ائتمان' && config('app.credit_card_enabled')) {
            // Store customer info in session for payment page
            session([
                'checkout_data' => [
                    'firstname' => $validated['firstname'],
                    'lastname' => $validated['lastname'],
                    'phone' => $validated['phone'],
                    'city' => $validated['city'],
                    'shipping_address' => $validated['shipping_address'],
                    'shipping_city' => $validated['city'], // Use customer's city for shipping
                    'payment_method' => $validated['payment_method'],
                    'total' => $total
                ]
            ]);

            return redirect()->route('payment.credit-card');
        }

        // For cash on delivery, process order directly
        try {
            DB::beginTransaction();

            // Create or find customer by phone number
            $customer = Customer::findOrCreateByPhone(
                $validated['phone'],
                $validated['firstname'],
                $validated['lastname'],
                $validated['city']
            );

            // Generate unique tracking code
            $trackingCode = $this->generateTrackingCode();

            // Create order
            $order = Order::create([
                'tracking_code' => $trackingCode,
                'customer_id' => $customer->id,
                'status' => 'pending',
                'shipping_address' => $validated['shipping_address'],
                'shipping_city' => $validated['city'], // Use customer's city for shipping
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
                'total_price' => $total,
            ]);

            // Create order items and reduce stock
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

            DB::commit();

            return redirect()->route('orders.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while placing your order. Please try again.');
        }
    }

    /**
     * Show order success page
     *
     * This function displays the order success page after order completion
     * No authentication required - customers can view their order success
     */
    public function success($id)
    {
        $order = Order::with(['customer', 'orderItems.product'])->findOrFail($id);
        return view('orders.success', compact('order'));
    }

    /**
     * Show order details
     *
     * This function displays order details for customers
     * No authentication required - customers can view their orders
     */
    public function show($id)
    {
        $order = Order::with(['customer', 'orderItems.product'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * List customer orders (if they provide phone number)
     *
     * This function allows customers to view their order history
     * by providing their phone number
     */
    public function index(Request $request)
    {
        $orders = collect();

        if ($request->has('phone') && $request->phone) {
            $customer = Customer::where('phone', $request->phone)->first();

            if ($customer) {
                $orders = $customer->orders()->with('orderItems.product')->latest()->get();
            }
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * Show credit card payment form
     *
     * This function shows the credit card payment form
     * No authentication required - open to all customers
     */
    public function creditCardPayment()
    {
        $sessionCart = session('cart', []);

        if (empty($sessionCart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $total = $this->calculateSessionCartTotal($sessionCart);

        return view('orders.credit-card-payment', compact('total'));
    }

    /**
     * Process credit card payment
     *
     * This function processes the credit card payment
     * No authentication required - open to all customers
     */
    public function processCreditCard(Request $request)
    {
        // Validate credit card information
        $validated = $request->validate([
            'card_number' => 'required|string|min:16|max:19',
            'expiry_month' => 'required|integer|min:1|max:12',
            'expiry_year' => 'required|integer|min:' . date('Y'),
            'cvv' => 'required|string|min:3|max:4',
            'cardholder_name' => 'required|string|max:255',
        ]);

        // Get checkout data from session
        $checkoutData = session('checkout_data');
        if (!$checkoutData) {
            return redirect()->route('orders.checkout')->with('error', 'Checkout session expired. Please try again.');
        }

        // Get session cart
        $sessionCart = session('cart', []);
        if (empty($sessionCart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Check stock for all items
        foreach ($sessionCart as $item) {
            $product = Product::find($item['product_id']);
            if (!$product || $product->stock < $item['quantity']) {
                return redirect()->route('orders.checkout')->with('error', 'Insufficient stock for ' . ($product ? $product->name : 'product'));
            }
        }

        // Here you would integrate with a payment gateway
        // For now, we'll simulate successful payment and create the order

        try {
            DB::beginTransaction();

            // Create or find customer by phone number
            $customer = Customer::findOrCreateByPhone(
                $checkoutData['phone'],
                $checkoutData['firstname'],
                $checkoutData['lastname'],
                $checkoutData['city']
            );

            // Create order
            $order = Order::create([
                'customer_id' => $customer->id,
                'status' => 'pending',
                'shipping_address' => $checkoutData['shipping_address'],
                'shipping_city' => $checkoutData['shipping_city'],
                'payment_method' => $checkoutData['payment_method'],
                'payment_status' => 'paid', // Mark as paid for credit card
                'total_price' => $checkoutData['total'],
            ]);

            // Create order items and reduce stock
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

            // Clear session cart and checkout data
            session()->forget(['cart', 'checkout_data']);

            DB::commit();

            return redirect()->route('orders.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('orders.checkout')->with('error', 'An error occurred while processing your payment. Please try again.');
        }
    }

    /**
     * Calculate total for session cart items
     *
     * This helper function calculates the total price for cart items
     * stored in session
     */
    private function calculateSessionCartTotal($sessionCart): float
    {
        $total = 0;
        foreach ($sessionCart as $item) {
            $total += $item['quantity'] * $item['product']['price'];
        }
        return $total;
    }

    /**
     * Generate unique tracking code
     */
    private function generateTrackingCode(): string
    {
        do {
            $code = str_pad(random_int(10000000, 99999999), 8, '0', STR_PAD_LEFT);
        } while (Order::where('tracking_code', $code)->exists());

        return $code;
    }
}
