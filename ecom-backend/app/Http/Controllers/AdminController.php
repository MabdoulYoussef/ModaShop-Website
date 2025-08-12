<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // Admin dashboard
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'low_stock_products' => Product::where('stock', '<', 10)->count(),
        ];

        $recent_orders = Order::with('user')
                            ->latest()
                            ->take(5)
                            ->get();

        $low_stock_products = Product::where('stock', '<', 10)
                                    ->with('category')
                                    ->take(5)
                                    ->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'low_stock_products'));
    }

    // List all orders
    public function orders(Request $request)
    {
        $query = Order::with(['user', 'orderItems.product']);

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->latest()->paginate(20);
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    // Show single order
    public function showOrder($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Update order status
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return redirect()->route('admin.orders.show', $order->id)
                        ->with('success', 'Order status updated successfully');
    }

    // List all users
    public function users(Request $request)
    {
        $query = User::withCount('orders');

        // Filter by role
        if ($request->has('role') && $request->role !== '') {
            $query->where('role', $request->role);
        }

        // Search by name or email
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(20);
        $roles = ['user', 'admin'];

        return view('admin.users.index', compact('users', 'roles'));
    }

    // Show user details
    public function showUser($id)
    {
        $user = User::with(['orders.orderItems.product', 'reviews.product'])->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    // Update user role
    public function updateUserRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->update(['role' => $validated['role']]);

        return redirect()->route('admin.users.show', $user->id)
                        ->with('success', 'User role updated successfully');
    }

    // List all products
    public function products(Request $request)
    {
        $query = Product::with('category');

        // Filter by category
        if ($request->has('category_id') && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
        }

        // Filter by stock
        if ($request->has('stock_filter')) {
            switch ($request->stock_filter) {
                case 'in_stock':
                    $query->where('stock', '>', 0);
                    break;
                case 'out_of_stock':
                    $query->where('stock', 0);
                    break;
                case 'low_stock':
                    $query->where('stock', '<', 10);
                    break;
            }
        }

        $products = $query->latest()->paginate(20);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    // List all reviews
    public function reviews(Request $request)
    {
        $query = Review::with(['user', 'product']);

        // Filter by approval status
        if ($request->has('approved') && $request->approved !== '') {
            $query->where('is_approved', $request->boolean('approved'));
        }

        $reviews = $query->latest()->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    // Approve/reject review
    public function updateReviewStatus(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $review->update(['is_approved' => $validated['is_approved']]);

        $message = $validated['is_approved'] ? 'approved' : 'rejected';

        return redirect()->route('admin.reviews.index')
                        ->with('success', "Review {$message} successfully");
    }

    // Sales statistics
    public function sales(Request $request)
    {
        $period = $request->get('period', 'month');

        switch ($period) {
            case 'week':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'year':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
            default:
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
        }

        $sales = Order::where('status', 'completed')
                     ->whereBetween('created_at', [$startDate, $endDate])
                     ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total, COUNT(*) as count')
                     ->groupBy('date')
                     ->orderBy('date')
                     ->get();

        $totalRevenue = $sales->sum('total');
        $totalOrders = $sales->sum('count');

        return view('admin.sales.index', compact('sales', 'totalRevenue', 'totalOrders', 'period'));
    }

    // Low stock products
    public function lowStock(Request $request)
    {
        $threshold = $request->get('threshold', 10);

        $products = Product::where('stock', '<', $threshold)
                          ->with('category')
                          ->orderBy('stock')
                          ->paginate(20);

        return view('admin.low-stock.index', compact('products', 'threshold'));
    }
}
