<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
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
        $this->middleware('auth:admin');
    }

    // Admin dashboard
    public function dashboard()
    {
        $stats = [
            'total_customers' => Customer::count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_price'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'low_stock_products' => Product::where('stock', '<', 10)->count(),
        ];

        $recent_orders = Order::with('customer')
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
        $query = Order::with(['customer', 'orderItems.product']);

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
        $order = Order::with(['customer', 'orderItems.product'])->findOrFail($id);
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

    // List all customers
    public function customers(Request $request)
    {
        $query = Customer::withCount('orders');

        // Search by name or phone
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $customers = $query->latest()->paginate(20);

        return view('admin.customers.index', compact('customers'));
    }

    // Show customer details
    public function showCustomer($id)
    {
        $customer = Customer::with(['orders.orderItems.product'])->findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }

    // List all products
    public function products(Request $request)
    {
        $query = Product::with('category');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

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

        // Sort by
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $products = $query->paginate(20);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    // List all categories
    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('admin.categories.index', compact('categories'));
    }

    // List all reviews
    public function reviews(Request $request)
    {
        $query = Review::with(['customer', 'product']);

        // Filter by approval status
        if ($request->has('approved') && $request->approved !== '') {
            $query->where('is_approved', $request->boolean('approved'));
        }

        // Filter by rating
        if ($request->has('rating') && $request->rating !== '') {
            $query->where('rating', $request->rating);
        }

        // Search in comments
        if ($request->has('search') && $request->search !== '') {
            $search = $request->get('search');
            $query->where('comment', 'like', "%{$search}%");
        }

        $reviews = $query->latest()->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    // Approve review
    public function approveReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved' => true]);

        return redirect()->route('admin.reviews.index')
                        ->with('success', 'تم الموافقة على التقييم بنجاح');
    }

    // Reject review
    public function rejectReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved' => false]);

        return redirect()->route('admin.reviews.index')
                        ->with('success', 'تم رفض التقييم بنجاح');
    }

    // Delete review
    public function destroyReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.index')
                        ->with('success', 'تم حذف التقييم بنجاح');
    }

    // Approve/reject review (legacy method)
    public function updateReviewStatus(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $review->update(['is_approved' => $validated['is_approved']]);

        $message = $validated['is_approved'] ? 'تم الموافقة على التقييم بنجاح' : 'تم رفض التقييم بنجاح';

        return redirect()->route('admin.reviews.index')
                        ->with('success', $message);
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
