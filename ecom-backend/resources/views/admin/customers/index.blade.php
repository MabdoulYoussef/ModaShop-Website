@extends('layouts.master')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>إدارة العملاء</h2>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i> العودة للوحة التحكم
                </a>
            </div>

            <!-- Search Form -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">البحث عن العملاء</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.customers.index') }}">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       placeholder="البحث بالاسم أو رقم الهاتف..."
                                       value="{{ request('search') }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-search"></i> بحث
                                </button>
                                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> مسح
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Customers Table -->
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">قائمة العملاء ({{ $customers->total() }})</h5>
                </div>
                <div class="card-body">
                    @if($customers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>رقم الهاتف</th>
                                        <th>المدينة</th>
                                        <th>عدد الطلبات</th>
                                        <th>تاريخ التسجيل</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>
                                                <strong>{{ $customer->firstname }} {{ $customer->lastname }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $customer->phone }}</span>
                                            </td>
                                            <td>{{ $customer->city }}</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $customer->orders_count }}</span>
                                            </td>
                                            <td>{{ $customer->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.customers.show', $customer->id) }}"
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
                            {{ $customers->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">لا توجد عملاء</h5>
                            @if(request('search'))
                                <p class="text-muted">لا توجد نتائج للبحث: "{{ request('search') }}"</p>
                                <a href="{{ route('admin.customers.index') }}" class="btn btn-primary">
                                    <i class="fas fa-times"></i> مسح البحث
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
