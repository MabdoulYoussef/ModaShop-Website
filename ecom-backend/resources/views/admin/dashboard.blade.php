@extends('layouts.admin')

@section('title', 'لوحة التحكم')
@section('page-title', 'لوحة التحكم')
@section('page-description', 'مرحباً بك في لوحة تحكم Moda2Shop - إدارة متجرك بسهولة')

@section('content')

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-number">{{ $stats['total_customers'] }}</div>
                <div class="stats-label">إجمالي العملاء</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stats-number">{{ $stats['total_products'] }}</div>
                <div class="stats-label">إجمالي المنتجات</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stats-number">{{ $stats['total_orders'] }}</div>
                <div class="stats-label">إجمالي الطلبات</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stats-number">{{ number_format($stats['total_revenue'], 0) }}</div>
                <div class="stats-label">إجمالي الإيرادات (درهم)</div>
            </div>
        </div>
    </div>

    <!-- Additional Statistics Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stats-number">{{ $stats['low_stock_products'] }}</div>
                <div class="stats-label">منتجات مخزون منخفض</div>
            </div>
        </div>
    </div>

    <!-- Additional Stats -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-number">{{ $stats['pending_orders'] }}</div>
                <div class="stats-label">الطلبات المعلقة</div>
            </div>
        </div>


    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-header">
                    <h5><i class="fas fa-bolt"></i> إجراءات سريعة</h5>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.products.create') }}" class="btn-admin w-100">
                            <i class="fas fa-plus"></i> إضافة منتج جديد
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.orders.index') }}" class="btn-admin-outline w-100">
                            <i class="fas fa-shopping-cart"></i> إدارة الطلبات
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.customers.index') }}" class="btn-admin-outline w-100">
                            <i class="fas fa-users"></i> إدارة العملاء
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.products.index') }}" class="btn-admin-outline w-100">
                            <i class="fas fa-box"></i> إدارة المنتجات
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-header">
                    <h5><i class="fas fa-clock"></i> آخر الطلبات</h5>
                </div>
                @if($recent_orders->count() > 0)
                    <div class="admin-table">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>العميل</th>
                                    <th>المبلغ</th>
                                    <th>الحالة</th>
                                    <th>التاريخ</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_orders as $order)
                                    <tr>
                                        <td><strong>#{{ $order->id }}</strong></td>
                                        <td>
                                            @if($order->customer)
                                                {{ $order->customer->firstname }} {{ $order->customer->lastname }}
                                                <br><small class="text-muted">{{ $order->customer->phone }}</small>
                                            @else
                                                عميل غير محدد
                                            @endif
                                        </td>
                                        <td><strong>{{ number_format($order->total_price, 2) }} درهم</strong></td>
                                        <td>
                                            @if($order->status == 'pending')
                                                <span class="badge-admin badge-pending">معلق</span>
                                            @elseif($order->status == 'processing')
                                                <span class="badge-admin badge-processing">قيد المعالجة</span>
                                            @elseif($order->status == 'shipped')
                                                <span class="badge-admin badge-shipped">تم الشحن</span>
                                            @elseif($order->status == 'delivered')
                                                <span class="badge-admin badge-delivered">تم التسليم</span>
                                            @elseif($order->status == 'cancelled')
                                                <span class="badge-admin badge-cancelled">ملغي</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-admin-outline btn-sm">
                                                <i class="fas fa-eye"></i> عرض
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">لا توجد طلبات حديثة</h5>
                        <p class="text-muted">ستظهر الطلبات الجديدة هنا عند وصولها</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
