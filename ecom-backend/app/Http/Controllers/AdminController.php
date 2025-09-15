<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
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


    // Sales statistics
    public function sales(Request $request)
    {
        $period = $request->get('period', 'month');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        // Set date range based on period
        switch ($period) {
            case 'today':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                break;
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
            case 'monthly':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
            case 'custom':
                $startDate = $dateFrom ? \Carbon\Carbon::parse($dateFrom)->startOfDay() : now()->startOfMonth();
                $endDate = $dateTo ? \Carbon\Carbon::parse($dateTo)->endOfDay() : now()->endOfMonth();
                break;
            default:
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
        }

        // Current period data
        $currentOrders = Order::where('status', 'delivered')
                            ->whereBetween('created_at', [$startDate, $endDate]);

        $totalRevenue = $currentOrders->sum('total_price');
        $totalOrders = $currentOrders->count();
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        $totalCustomers = Customer::whereBetween('created_at', [$startDate, $endDate])->count();

        // Previous period data for comparison
        $periodLength = $endDate->diffInDays($startDate);
        $previousStartDate = $startDate->copy()->subDays($periodLength + 1);
        $previousEndDate = $startDate->copy()->subDay();

        $previousOrders = Order::where('status', 'delivered')
                              ->whereBetween('created_at', [$previousStartDate, $previousEndDate]);

        $previousRevenue = $previousOrders->sum('total_price');
        $previousOrdersCount = $previousOrders->count();
        $previousAverageOrderValue = $previousOrdersCount > 0 ? $previousRevenue / $previousOrdersCount : 0;
        $previousCustomers = Customer::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();

        // Calculate percentage changes
        $revenueChange = $previousRevenue > 0 ? (($totalRevenue - $previousRevenue) / $previousRevenue) * 100 : 0;
        $ordersChange = $previousOrdersCount > 0 ? (($totalOrders - $previousOrdersCount) / $previousOrdersCount) * 100 : 0;
        $aovChange = $previousAverageOrderValue > 0 ? (($averageOrderValue - $previousAverageOrderValue) / $previousAverageOrderValue) * 100 : 0;
        $customersChange = $previousCustomers > 0 ? (($totalCustomers - $previousCustomers) / $previousCustomers) * 100 : 0;

        // Chart data
        $chartData = $this->getChartData($startDate, $endDate, $period);

        // Top products
        $topProducts = $this->getTopProducts($startDate, $endDate);

        // Top customers
        $topCustomers = $this->getTopCustomers($startDate, $endDate);

        // Sales by category
        $categoryData = $this->getCategoryData($startDate, $endDate);

        // Sales by city
        $salesByCity = $this->getSalesByCity($startDate, $endDate);

        // Payment methods data
        $paymentData = $this->getPaymentData($startDate, $endDate);

        return view('admin.sales.index', compact(
            'totalRevenue', 'totalOrders', 'averageOrderValue', 'totalCustomers',
            'revenueChange', 'ordersChange', 'aovChange', 'customersChange',
            'chartData', 'topProducts', 'topCustomers', 'categoryData',
            'salesByCity', 'paymentData', 'period', 'dateFrom', 'dateTo'
        ));
    }

    private function getChartData($startDate, $endDate, $period)
    {
        $labels = [];
        $revenue = [];
        $orders = [];

        if ($period === 'today') {
            // Hourly data for today
            for ($i = 0; $i < 24; $i++) {
                $hour = $startDate->copy()->addHours($i);
                $labels[] = $hour->format('H:i');

                $hourRevenue = Order::where('status', 'delivered')
                                  ->whereBetween('created_at', [$hour, $hour->copy()->addHour()])
                                  ->sum('total_price');
                $revenue[] = $hourRevenue;

                $hourOrders = Order::where('status', 'delivered')
                                 ->whereBetween('created_at', [$hour, $hour->copy()->addHour()])
                                 ->count();
                $orders[] = $hourOrders;
            }
        } elseif ($period === 'monthly') {
            // Monthly data for the year
            $monthNames = [
                1 => 'يناير', 2 => 'فبراير', 3 => 'مارس', 4 => 'أبريل',
                5 => 'مايو', 6 => 'يونيو', 7 => 'يوليو', 8 => 'أغسطس',
                9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر'
            ];

            for ($month = 1; $month <= 12; $month++) {
                $monthStart = $startDate->copy()->month($month)->startOfMonth();
                $monthEnd = $startDate->copy()->month($month)->endOfMonth();

                $labels[] = $monthNames[$month];

                $monthRevenue = Order::where('status', 'delivered')
                                   ->whereBetween('created_at', [$monthStart, $monthEnd])
                                   ->sum('total_price');
                $revenue[] = $monthRevenue;

                $monthOrders = Order::where('status', 'delivered')
                                  ->whereBetween('created_at', [$monthStart, $monthEnd])
                                  ->count();
                $orders[] = $monthOrders;
            }
        } else {
            // Daily data for other periods
            $current = $startDate->copy();
            while ($current->lte($endDate)) {
                $labels[] = $current->format('Y-m-d');

                $dayRevenue = Order::where('status', 'delivered')
                                 ->whereDate('created_at', $current)
                                 ->sum('total_price');
                $revenue[] = $dayRevenue;

                $dayOrders = Order::where('status', 'delivered')
                                ->whereDate('created_at', $current)
                                ->count();
                $orders[] = $dayOrders;

                $current->addDay();
            }
        }

        return compact('labels', 'revenue', 'orders');
    }

    private function getTopProducts($startDate, $endDate)
    {
        return DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.status', 'delivered')
                ->whereBetween('orders.created_at', [$startDate, $endDate])
                ->select('products.id', 'products.name', 'products.price', 'products.image', 'products.category_id',
                        'categories.name as category_name',
                        DB::raw('SUM(order_items.quantity) as total_quantity'),
                        DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'))
                ->groupBy('products.id', 'products.name', 'products.price', 'products.image', 'products.category_id', 'categories.name')
                ->orderBy('total_quantity', 'desc')
                ->limit(10)
                ->get();
    }

    private function getTopCustomers($startDate, $endDate)
    {
        return Customer::withCount(['orders' => function($query) use ($startDate, $endDate) {
                        $query->where('status', 'delivered')
                              ->whereBetween('created_at', [$startDate, $endDate]);
                    }])
                    ->withSum(['orders' => function($query) use ($startDate, $endDate) {
                        $query->where('status', 'delivered')
                              ->whereBetween('created_at', [$startDate, $endDate]);
                    }], 'total_price')
                    ->having('orders_count', '>', 0)
                    ->orderBy('orders_sum_total_price', 'desc')
                    ->limit(10)
                    ->get()
                    ->map(function($customer) {
                        $customer->total_spent = $customer->orders_sum_total_price ?? 0;
                        $customer->average_order_value = $customer->orders_count > 0
                            ? $customer->total_spent / $customer->orders_count
                            : 0;
                        return $customer;
                    });
    }

    private function getCategoryData($startDate, $endDate)
    {
        $categorySales = DB::table('order_items')
                          ->join('products', 'order_items.product_id', '=', 'products.id')
                          ->join('categories', 'products.category_id', '=', 'categories.id')
                          ->join('orders', 'order_items.order_id', '=', 'orders.id')
                          ->where('orders.status', 'delivered')
                          ->whereBetween('orders.created_at', [$startDate, $endDate])
                          ->select('categories.id', 'categories.name',
                                  DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'))
                          ->groupBy('categories.id', 'categories.name')
                          ->orderBy('total_revenue', 'desc')
                          ->get();

        return [
            'labels' => $categorySales->pluck('name')->toArray(),
            'data' => $categorySales->pluck('total_revenue')->toArray()
        ];
    }

    private function getSalesByCity($startDate, $endDate)
    {
        return Order::where('status', 'delivered')
                   ->whereBetween('created_at', [$startDate, $endDate])
                   ->select('shipping_city as city',
                           DB::raw('COUNT(*) as orders_count'),
                           DB::raw('SUM(total_price) as total_revenue'))
                   ->groupBy('shipping_city')
                   ->orderBy('total_revenue', 'desc')
                   ->get();
    }

    private function getPaymentData($startDate, $endDate)
    {
        $paymentMethods = Order::where('status', 'delivered')
                             ->whereBetween('created_at', [$startDate, $endDate])
                             ->select('payment_method',
                                     DB::raw('COUNT(*) as count'))
                             ->groupBy('payment_method')
                             ->get();

        return [
            'labels' => $paymentMethods->pluck('payment_method')->toArray(),
            'data' => $paymentMethods->pluck('count')->toArray()
        ];
    }

    // Export sales report
    public function exportSales(Request $request)
    {
        $period = $request->get('period', 'month');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        // Set date range based on period (same logic as sales method)
        switch ($period) {
            case 'today':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                break;
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
            case 'monthly':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
            case 'custom':
                $startDate = $dateFrom ? \Carbon\Carbon::parse($dateFrom)->startOfDay() : now()->startOfMonth();
                $endDate = $dateTo ? \Carbon\Carbon::parse($dateTo)->endOfDay() : now()->endOfMonth();
                break;
            default:
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
        }

        // Get orders data
        $orders = Order::with(['customer', 'orderItems.product'])
                      ->where('status', 'delivered')
                      ->whereBetween('created_at', [$startDate, $endDate])
                      ->orderBy('created_at', 'desc')
                      ->get();

        // Generate CSV content
        $csvData = [];
        $csvData[] = ['تقرير المبيعات', '', '', ''];
        $csvData[] = ['الفترة', $startDate->format('Y-m-d') . ' إلى ' . $endDate->format('Y-m-d'), '', ''];
        $csvData[] = ['تاريخ التصدير', now()->format('Y-m-d H:i'), '', ''];
        $csvData[] = ['', '', '', ''];

        $csvData[] = ['إجمالي الإيرادات', number_format($orders->sum('total_price'), 0) . ' درهم', '', ''];
        $csvData[] = ['إجمالي الطلبات', $orders->count(), '', ''];
        $csvData[] = ['متوسط قيمة الطلب', number_format($orders->avg('total_price'), 0) . ' درهم', '', ''];
        $csvData[] = ['', '', '', ''];

        $csvData[] = ['تفاصيل الطلبات', '', '', ''];
        $csvData[] = ['رقم الطلب', 'التاريخ', 'العميل', 'المبلغ', 'طريقة الدفع', 'المدينة'];

        foreach ($orders as $order) {
            $csvData[] = [
                $order->id,
                $order->created_at->format('Y-m-d H:i'),
                $order->customer->full_name ?? 'غير محدد',
                number_format($order->total_price, 0) . ' درهم',
                $order->payment_method,
                $order->shipping_city
            ];
        }

        // Convert to CSV string
        $csvContent = '';
        foreach ($csvData as $row) {
            $csvContent .= implode(',', array_map(function($field) {
                return '"' . str_replace('"', '""', $field) . '"';
            }, $row)) . "\n";
        }

        // Set headers for download
        $filename = 'sales_report_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '.csv';

        return response($csvContent)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    // Low stock products
    public function lowStock(Request $request)
    {
        $threshold = $request->get('threshold', 10);
        $categoryFilter = $request->get('category');

        $query = Product::where('stock', '<', $threshold)
                       ->with('category');

        // Filter by category if selected
        if ($categoryFilter) {
            $query->where('category_id', $categoryFilter);
        }

        $products = $query->orderBy('stock')
                         ->paginate(20);

        $categories = Category::all();

        return view('admin.low-stock.index', compact('products', 'threshold', 'categories'));
    }
}
