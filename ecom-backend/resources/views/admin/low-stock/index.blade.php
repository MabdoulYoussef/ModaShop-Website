@extends('layouts.admin')

@section('title', 'مخزون منخفض')
@section('page-title', 'مخزون منخفض')
@section('page-description', 'إدارة المنتجات ذات المخزون المنخفض')

@section('content')

<!-- Filter Section -->
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <h5><i class="fas fa-filter me-2"></i>تصفية المنتجات</h5>
    </div>
    <div class="admin-card-body">
        <form method="GET" action="{{ route('admin.low-stock.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="threshold" class="form-label">حد المخزون المنخفض</label>
                <select name="threshold" id="threshold" class="form-select" onchange="this.form.submit()">
                    <option value="5" {{ $threshold == 5 ? 'selected' : '' }}>أقل من 5 قطع</option>
                    <option value="10" {{ $threshold == 10 ? 'selected' : '' }}>أقل من 10 قطع</option>
                    <option value="15" {{ $threshold == 15 ? 'selected' : '' }}>أقل من 15 قطعة</option>
                    <option value="20" {{ $threshold == 20 ? 'selected' : '' }}>أقل من 20 قطعة</option>
                    <option value="25" {{ $threshold == 25 ? 'selected' : '' }}>أقل من 25 قطعة</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="category" class="form-label">الفئة</label>
                <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                    <option value="">جميع الفئات</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin">
                        <i class="fas fa-search"></i> تطبيق
                    </button>
                    <a href="{{ route('admin.products.create') }}" class="btn-admin-outline">
                        <i class="fas fa-plus"></i> إضافة منتج
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stats-number">{{ $products->total() }}</div>
            <div class="stats-label">منتجات مخزون منخفض</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stats-number">{{ $products->sum('stock') }}</div>
            <div class="stats-label">إجمالي القطع المتاحة</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stats-number">{{ number_format($products->sum(function($p) { return $p->stock * $p->price; }), 0) }}</div>
            <div class="stats-label">قيمة المخزون (درهم)</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stats-number">{{ $products->avg('stock') > 0 ? number_format($products->avg('stock'), 1) : 0 }}</div>
            <div class="stats-label">متوسط المخزون</div>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h5><i class="fas fa-list me-2"></i>قائمة المنتجات</h5>
    </div>
    <div class="admin-card-body">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>الصورة</th>
                            <th>اسم المنتج</th>
                            <th>الفئة</th>
                            <th>السعر</th>
                            <th>المخزون</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('assets/img/products/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="product-thumb"
                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <div class="product-placeholder"
                                         style="width: 50px; height: 50px; background: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <div class="fw-bold">{{ $product->name }}</div>
                                    <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge-admin" style="background: #ceb57f; color: white;">
                                    {{ $product->category->name ?? 'بدون فئة' }}
                                </span>
                            </td>
                            <td class="fw-bold">{{ number_format($product->price, 0) }} درهم</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="stock-number {{ $product->stock == 0 ? 'text-danger' : ($product->stock < 5 ? 'text-warning' : 'text-success') }}">
                                        {{ $product->stock }}
                                    </span>
                                    <small class="text-muted ms-2">قطعة</small>
                                </div>
                            </td>
                            <td>
                                @if($product->stock == 0)
                                    <span class="badge-admin badge-cancelled">نفد المخزون</span>
                                @elseif($product->stock < 5)
                                    <span class="badge-admin badge-warning">مخزون منخفض جداً</span>
                                @else
                                    <span class="badge-admin badge-warning">مخزون منخفض</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('products.show', $product->id) }}"
                                       class="btn btn-sm btn-outline-info"
                                       title="عرض"
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="fas fa-check-circle text-success mb-3" style="font-size: 4rem;"></i>
                    <h4 class="text-muted">لا توجد منتجات مخزون منخفض</h4>
                    <p class="text-muted">جميع المنتجات لديها مخزون كافي</p>
                    <a href="{{ route('admin.products.index') }}" class="btn-admin mt-3">
                        <i class="fas fa-box"></i> عرض جميع المنتجات
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-bolt me-2"></i>إجراءات سريعة</h5>
            </div>
            <div class="admin-card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.create') }}" class="btn-admin-outline">
                        <i class="fas fa-plus"></i> إضافة منتج جديد
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="btn-admin-outline">
                        <i class="fas fa-list"></i> جميع المنتجات
                    </a>
                    <a href="{{ route('admin.sales.index') }}" class="btn-admin-outline">
                        <i class="fas fa-chart-line"></i> التقارير والمبيعات
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-info-circle me-2"></i>معلومات مهمة</h5>
            </div>
            <div class="admin-card-body">
                <div class="alert alert-info">
                    <h6><i class="fas fa-lightbulb me-2"></i>نصائح لإدارة المخزون:</h6>
                    <ul class="mb-0">
                        <li>راقب المنتجات ذات المخزون المنخفض بانتظام</li>
                        <li>أعد توريد المنتجات الشائعة قبل نفادها</li>
                        <li>فكر في خصومات للمنتجات قليلة المخزون</li>
                        <li>تتبع أنماط المبيعات لتوقع الطلب</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Auto-refresh every 5 minutes to keep stock data updated
setInterval(function() {
    if (document.visibilityState === 'visible') {
        location.reload();
    }
}, 300000); // 5 minutes
</script>

<style>
.stock-number {
    font-weight: bold;
    font-size: 1.1rem;
}

.product-thumb {
    border: 1px solid #dee2e6;
}

.empty-state {
    padding: 2rem;
}

.badge-warning {
    background: #ffc107;
    color: #000;
}

.table th {
    background: #f8f9fa;
    border-bottom: 2px solid #ceb57f;
    font-weight: 600;
}

.table td {
    vertical-align: middle;
}

.btn-group .btn {
    margin: 0 2px;
}
</style>
@endsection
