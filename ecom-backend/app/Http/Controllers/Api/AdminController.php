<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard statistics
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_reviews' => Review::count(),
            'pending_reviews' => Review::where('is_approved', false)->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total_price'),
        ];

        return response()->json($stats);
    }

    // Get all orders with details
    public function getAllOrders()
    {
        $orders = Order::with('user', 'orderItems.product')
                      ->orderBy('created_at', 'desc')
                      ->get();
        return response()->json($orders);
    }

    // Update order status
    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $validated = $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);
        return response()->json(['message' => 'Order status updated', 'order' => $order]);
    }

    // Get all users
    public function getAllUsers()
    {
        $users = User::with('orders')->get();
        return response()->json($users);
    }

    // Get pending reviews
    public function getPendingReviews()
    {
        $reviews = Review::with('user', 'product')
                        ->where('is_approved', false)
                        ->get();
        return response()->json($reviews);
    }

    // Approve review
    public function approveReview($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->update(['is_approved' => true]);
        return response()->json(['message' => 'Review approved']);
    }

    // Reject review
    public function rejectReview($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->delete();
        return response()->json(['message' => 'Review rejected and deleted']);
    }

    // Get low stock products
    public function getLowStockProducts()
    {
        $products = Product::where('stock', '<', 10)->get();
        return response()->json($products);
    }

    // Update product stock
    public function updateProductStock(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $validated = $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $product->update(['stock' => $validated['stock']]);
        return response()->json(['message' => 'Stock updated', 'product' => $product]);
    }

    // Get sales statistics
    public function getSalesStats()
    {
        $stats = [
            'today_sales' => Order::whereDate('created_at', today())->sum('total_price'),
            'week_sales' => Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total_price'),
            'month_sales' => Order::whereMonth('created_at', now()->month)->sum('total_price'),
            'total_orders_today' => Order::whereDate('created_at', today())->count(),
            'total_orders_week' => Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        return response()->json($stats);
    }
}
