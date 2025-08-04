<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Place a new order (for authenticated users)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_state' => 'required|string',
            'shipping_zip' => 'required|string',
            'shipping_country' => 'required|string',
            'payment_method' => 'required|string|in:stripe,paypal,cash',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => 0, // We'll calculate this below
            'status' => 'pending',
            'shipping_address' => $validated['shipping_address'],
            'shipping_city' => $validated['shipping_city'],
            'shipping_state' => $validated['shipping_state'],
            'shipping_zip' => $validated['shipping_zip'],
            'shipping_country' => $validated['shipping_country'],
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
        ]);

        $total = 0;
        foreach ($validated['items'] as $item) {
            $product = \App\Models\Product::find($item['product_id']);
            $subtotal = $product->price * $item['quantity'];
            $total += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
        }

        $order->update(['total_price' => $total]);

        return response()->json($order->load('orderItems.product'), 201);
    }

    // List orders for the authenticated user
    public function index()
    {
        $orders = Order::with('orderItems.product')->where('user_id', Auth::id())->get();
        return response()->json($orders);
    }

    // (Optional) Admin: List all orders
    public function allOrders()
    {
        $orders = Order::with('orderItems.product', 'user')->get();
        return response()->json($orders);
    }

    // (Optional) Admin: Update order status
    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        $validated = $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
        ]);
        $order->update(['status' => $validated['status']]);
        return response()->json($order);
    }
}
