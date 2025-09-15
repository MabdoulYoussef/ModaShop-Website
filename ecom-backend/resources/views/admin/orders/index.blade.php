@extends('layouts.admin')

@section('content')
<style>
    .admin-page-header {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(173, 143, 83, 0.3);
    }

    .admin-page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .admin-page-header p {
        font-size: 1.1rem;
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }

    .admin-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        border: none;
        margin-bottom: 2rem;
    }

    .admin-card-header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 1.5rem 2rem;
        border: none;
    }

    .admin-card-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .admin-card-body {
        padding: 2rem;
    }

    .admin-table {
        margin: 0;
    }

    .admin-table thead {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
    }

    .admin-table thead th {
        border: none;
        padding: 1.5rem 1rem;
        font-weight: 600;
        font-size: 1.1rem;
        text-align: center;
    }

    .admin-table tbody tr {
        border-bottom: 1px solid #f1f3f4;
        transition: all 0.3s ease;
    }

    .admin-table tbody tr:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .admin-table tbody td {
        border: none;
        padding: 1.5rem 1rem;
        vertical-align: middle;
        text-align: center;
    }

    .badge-admin {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .badge-pending {
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        color: #856404;
        border: 2px solid #ffc107;
    }

    .badge-processing {
        background: linear-gradient(135deg, #cce5ff 0%, #99d6ff 100%);
        color: #004085;
        border: 2px solid #007bff;
    }

    .badge-shipped {
        background: linear-gradient(135deg, #e2e3e5 0%, #d6d8db 100%);
        color: #383d41;
        border: 2px solid #6c757d;
    }

    .badge-delivered {
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        color: #0c5460;
        border: 2px solid #17a2b8;
    }

    .badge-cancelled {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
        border: 2px solid #dc3545;
    }

    .btn-admin {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }

    .btn-admin:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(173, 143, 83, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-admin-outline {
        background: transparent;
        border: 2px solid #ad8f53;
        color: #ad8f53;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }

    .btn-admin-outline:hover {
        background: #ad8f53;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(173, 143, 83, 0.4);
        text-decoration: none;
    }

    .form-control-admin {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control-admin:focus {
        border-color: #ad8f53;
        box-shadow: 0 0 0 3px rgba(173, 143, 83, 0.1);
        background: white;
    }

    .btn-back-admin {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back-admin:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        color: white;
        text-decoration: none;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="admin-page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1><i class="fas fa-shopping-cart me-3"></i>إدارة الطلبات</h1>
                        <p>إدارة ومتابعة جميع طلبات العملاء</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="btn-back-admin">
                        <i class="fas fa-arrow-right"></i> العودة للوحة التحكم
                    </a>
                </div>
            </div>

            <!-- Filters -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5><i class="fas fa-filter me-2"></i>تصفية الطلبات</h5>
                </div>
                <div class="admin-card-body">
                    <form method="GET" action="{{ route('admin.orders.index') }}">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="status" class="form-label">حالة الطلب</label>
                                <select name="status" id="status" class="form-control-admin">
                                    <option value="">جميع الحالات</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                            @if($status == 'pending')
                                                معلق
                                            @elseif($status == 'processing')
                                                قيد المعالجة
                                            @elseif($status == 'shipped')
                                                تم الشحن
                                            @elseif($status == 'delivered')
                                                تم التسليم
                                            @elseif($status == 'cancelled')
                                                ملغي
                                            @else
                                                {{ $status }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="date_from" class="form-label">من تاريخ</label>
                                <input type="date" name="date_from" id="date_from" class="form-control-admin" value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="date_to" class="form-label">إلى تاريخ</label>
                                <input type="date" name="date_to" id="date_to" class="form-control-admin" value="{{ request('date_to') }}">
                            </div>
                            <div class="col-md-3 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn-admin me-2">
                                    <i class="fas fa-search"></i> تصفية
                                </button>
                                <a href="{{ route('admin.orders.index') }}" class="btn-admin-outline">
                                    <i class="fas fa-times"></i> مسح
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5><i class="fas fa-list me-2"></i>قائمة الطلبات ({{ $orders->total() }})</h5>
                </div>
                <div class="admin-card-body">
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table admin-table">
                                <thead>
                                    <tr>
                                        <th>رقم الطلب</th>
                                        <th>العميل</th>
                                        <th>المبلغ</th>
                                        <th>الحالة</th>
                                        <th>طريقة الدفع</th>
                                        <th>التاريخ</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <strong>#{{ $order->id }}</strong>
                                            </td>
                                            <td>
                                                @if($order->customer)
                                                    {{ $order->customer->firstname }} {{ $order->customer->lastname }}
                                                    <br><small class="text-muted">{{ $order->customer->phone }}</small>
                                                @else
                                                    عميل غير محدد
                                                @endif
                                            </td>
                                            <td>{{ number_format($order->total_price, 0) }} درهم</td>
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
                                            <td>{{ $order->payment_method }}</td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                   class="btn-admin-outline btn-sm">
                                                    <i class="fas fa-eye"></i> عرض
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $orders->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">لا توجد طلبات</h5>
                            @if(request('status') || request('date_from') || request('date_to'))
                                <p class="text-muted">لا توجد نتائج للتصفية المحددة</p>
                                <a href="{{ route('admin.orders.index') }}" class="btn-admin">
                                    <i class="fas fa-times"></i> مسح التصفية
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
