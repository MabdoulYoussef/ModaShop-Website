@extends('layouts.master')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>تفاصيل العميل</h2>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i> العودة لقائمة العملاء
                </a>
            </div>

            <!-- Customer Information -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">معلومات العميل</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="fas fa-user-circle fa-4x text-primary"></i>
                            </div>

                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>الاسم:</strong></td>
                                    <td>{{ $customer->firstname }} {{ $customer->lastname }}</td>
                                </tr>
                                <tr>
                                    <td><strong>رقم الهاتف:</strong></td>
                                    <td>
                                        <span class="badge bg-info">{{ $customer->phone }}</span>
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
                    <div class="card shadow">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">سجل الطلبات ({{ $customer->orders->count() }})</h5>
                        </div>
                        <div class="card-body">
                            @if($customer->orders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-dark">
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
                                                    <td>{{ number_format($order->total_price, 2) }} درهم</td>
                                                    <td>
                                                        @if($order->status == 'pending')
                                                            <span class="badge bg-warning">معلق</span>
                                                        @elseif($order->status == 'processing')
                                                            <span class="badge bg-info">قيد المعالجة</span>
                                                        @elseif($order->status == 'shipped')
                                                            <span class="badge bg-primary">تم الشحن</span>
                                                        @elseif($order->status == 'delivered')
                                                            <span class="badge bg-success">تم التوصيل</span>
                                                        @elseif($order->status == 'cancelled')
                                                            <span class="badge bg-danger">ملغي</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $order->payment_method }}</td>
                                                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                                           class="btn btn-sm btn-primary">
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
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <h4>{{ $customer->orders->count() }}</h4>
                                        <p class="mb-0">إجمالي الطلبات</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <h4>{{ number_format($customer->orders->sum('total_price'), 2) }} درهم</h4>
                                        <p class="mb-0">إجمالي المشتريات</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <h4>{{ number_format($customer->orders->avg('total_price'), 2) }} درهم</h4>
                                        <p class="mb-0">متوسط قيمة الطلب</p>
                                    </div>
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
