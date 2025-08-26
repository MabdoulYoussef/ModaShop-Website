@extends('layouts.master')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>إدارة الطلبات</h2>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i> العودة للوحة التحكم
                </a>
            </div>

            <!-- Filters -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">تصفية الطلبات</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.orders.index') }}">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="status" class="form-label">حالة الطلب</label>
                                <select name="status" id="status" class="form-select">
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
                                                تم التوصيل
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
                                <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="date_to" class="form-label">إلى تاريخ</label>
                                <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to') }}">
                            </div>
                            <div class="col-md-3 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-search"></i> تصفية
                                </button>
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> مسح
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">قائمة الطلبات ({{ $orders->total() }})</h5>
                </div>
                <div class="card-body">
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
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
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">
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
