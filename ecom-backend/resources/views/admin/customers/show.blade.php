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

    .badge-info-admin {
        background: linear-gradient(135deg, #cce5ff 0%, #99d6ff 100%);
        color: #004085;
        border: 2px solid #007bff;
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

    .stats-card {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 10px 25px rgba(173, 143, 83, 0.3);
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(173, 143, 83, 0.4);
    }

    .stats-card h4 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .stats-card p {
        margin: 0.5rem 0 0 0;
        font-size: 1rem;
        opacity: 0.9;
    }

    .customer-info-table {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
    }

    .customer-info-table td {
        padding: 0.75rem 0;
        border: none;
    }

    .customer-info-table td:first-child {
        font-weight: 600;
        color: #2c3e50;
        width: 40%;
    }

    .customer-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 5px 15px rgba(173, 143, 83, 0.3);
    }

    .customer-avatar i {
        font-size: 2rem;
        color: white;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="admin-page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1><i class="fas fa-user me-3"></i>تفاصيل العميل</h1>
                        <p>معلومات مفصلة عن العميل وطلباته</p>
                    </div>
                    <a href="{{ route('admin.customers.index') }}" class="btn-back-admin">
                        <i class="fas fa-arrow-right"></i> العودة لقائمة العملاء
                    </a>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="row">
                <div class="col-md-4">
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h5><i class="fas fa-user me-2"></i>معلومات العميل</h5>
                        </div>
                        <div class="admin-card-body">
                            <div class="customer-avatar">
                                <i class="fas fa-user"></i>
                            </div>

                            <table class="table customer-info-table">
                                <tr>
                                    <td><strong>الاسم:</strong></td>
                                    <td>{{ $customer->firstname }} {{ $customer->lastname }}</td>
                                </tr>
                                <tr>
                                    <td><strong>رقم الهاتف:</strong></td>
                                    <td>
                                        <span class="badge-admin badge-info-admin">{{ $customer->phone }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>المدينة:</strong></td>
                                    <td>{{ $customer->city }}</td>
                                </tr>
                                <tr>
                                    <td><strong>تاريخ التسجيل:</strong></td>
                                    <td>{{ $customer->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>آخر تحديث:</strong></td>
                                    <td>{{ $customer->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Customer Orders -->
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h5><i class="fas fa-shopping-cart me-2"></i>سجل الطلبات ({{ $customer->orders->count() }})</h5>
                        </div>
                        <div class="admin-card-body">
                            @if($customer->orders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table admin-table">
                                        <thead>
                                            <tr>
                                                <th>رقم الطلب</th>
                                                <th>المبلغ</th>
                                                <th>الحالة</th>
                                                <th>طريقة الدفع</th>
                                                <th>التاريخ</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customer->orders as $order)
                                                <tr>
                                                    <td>
                                                        <strong>#{{ $order->id }}</strong>
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
                                                            <span class="badge-admin badge-delivered">تم التوصيل</span>
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
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">لا توجد طلبات لهذا العميل</h5>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Order Statistics -->
                    @if($customer->orders->count() > 0)
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="stats-card">
                                    <h4>{{ $customer->orders->count() }}</h4>
                                    <p>إجمالي الطلبات</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-card">
                                    <h4>{{ number_format($customer->orders->sum('total_price'), 0) }} درهم</h4>
                                    <p>إجمالي المشتريات</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-card">
                                    <h4>{{ number_format($customer->orders->avg('total_price'), 0) }} درهم</h4>
                                    <p>متوسط قيمة الطلب</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


