@extends('layouts.admin')

@section('title', 'إدارة المنتجات')
@section('page-title', 'إدارة المنتجات')
@section('page-description', 'عرض وإدارة جميع منتجات المتجر')

@section('content')

<!-- Action Buttons -->
<div class="row mb-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0"><i class="fas fa-box"></i> جميع المنتجات</h5>
                    <small class="text-muted">إجمالي المنتجات: {{ $products->total() }}</small>
                </div>
                <div>
                    <a href="{{ route('admin.categories.index') }}" class="btn-admin-outline">
                        <i class="fas fa-tags"></i> جميع الفئات
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="btn-admin">
                        <i class="fas fa-plus"></i> إضافة منتج جديد
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="row mb-4">
    <div class="col-12">
        <div class="admin-card">
            <form method="GET" action="{{ route('admin.products.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">البحث</label>
                    <input type="text"
                           class="form-control"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="ابحث بالاسم أو الوصف...">
                </div>
                <div class="col-md-3">
                    <label for="category" class="form-label">الفئة</label>
                    <select class="form-select" id="category" name="category_id">
                        <option value="">جميع الفئات</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="stock_filter" class="form-label">المخزون</label>
                    <select class="form-select" id="stock_filter" name="stock_filter">
                        <option value="">الكل</option>
                        <option value="in_stock" {{ request('stock_filter') == 'in_stock' ? 'selected' : '' }}>متوفر</option>
                        <option value="out_of_stock" {{ request('stock_filter') == 'out_of_stock' ? 'selected' : '' }}>نفد المخزون</option>
                        <option value="low_stock" {{ request('stock_filter') == 'low_stock' ? 'selected' : '' }}>مخزون منخفض</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="sort" class="form-label">ترتيب حسب</label>
                    <select class="form-select" id="sort" name="sort">
                        <option value="created_at_desc" {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>الأحدث</option>
                        <option value="created_at_asc" {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>الأقدم</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>الاسم (أ-ي)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>الاسم (ي-أ)</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>السعر (منخفض)</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>السعر (عالي)</option>
                        <option value="stock_asc" {{ request('sort') == 'stock_asc' ? 'selected' : '' }}>المخزون (منخفض)</option>
                        <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>المخزون (عالي)</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-grid">
                        <button type="submit" class="btn-admin-outline">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            @if($products->count() > 0)
                <div class="admin-table">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>الصورة</th>
                                <th>اسم المنتج</th>
                                <th>الفئة</th>
                                <th>السعر</th>
                                <th>المخزون</th>
                                <th>الحالة</th>
                                <th>تاريخ الإضافة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <div class="product-image-thumb">
                                            @if($product->image)
                                                <img src="/assets/img/{{ $product->image }}"
                                                     alt="{{ $product->name }}"
                                                     class="img-thumbnail"
                                                     style="width: 60px; height: 60px; object-fit: cover;"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                <div class="no-image-placeholder" style="display: none; width: 60px; height: 60px; background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 4px; align-items: center; justify-content: center; flex-direction: column;">
                                                    <i class="fas fa-image" style="color: #6c757d;"></i>
                                                </div>
                                            @else
                                                <div class="no-image-placeholder">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-info">
                                            <strong>{{ $product->name }}</strong>
                                            @if($product->description)
                                                <br><small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($product->category)
                                            <span class="badge-admin" style="background: #17a2b8; color: white;">
                                                {{ $product->category->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">غير محدد</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ number_format($product->price, 2) }} درهم</strong>
                                    </td>
                                    <td>
                                        <span class="stock-badge {{ $product->stock > 10 ? 'stock-high' : ($product->stock > 0 ? 'stock-low' : 'stock-out') }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($product->stock > 10)
                                            <span class="badge-admin badge-delivered">متوفر</span>
                                        @elseif($product->stock > 0)
                                            <span class="badge-admin badge-processing">مخزون منخفض</span>
                                        @else
                                            <span class="badge-admin badge-cancelled">نفد المخزون</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                               class="btn-admin-outline btn-sm"
                                               title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('products.show', $product->id) }}"
                                               class="btn-admin-outline btn-sm"
                                               title="عرض في الموقع"
                                               target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn-admin-outline btn-sm text-danger"
                                                    title="حذف"
                                                    onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">لا توجد منتجات</h5>
                    <p class="text-muted">ابدأ بإضافة منتجات جديدة إلى متجرك</p>
                    <a href="{{ route('admin.products.create') }}" class="btn-admin">
                        <i class="fas fa-plus"></i> إضافة منتج جديد
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content delete-modal">
            <div class="modal-header">
                <div class="modal-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="warning-message">
                    <p>هل أنت متأكد من حذف المنتج <strong id="productName"></strong>؟</p>
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i>
                        <span>هذا الإجراء لا يمكن التراجع عنه.</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" onclick="closeModal()">
                    <i class="fas fa-times"></i> إلغاء
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">
                        <i class="fas fa-trash"></i> حذف
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<style>
    .product-image-thumb {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .no-image-placeholder {
        width: 60px;
        height: 60px;
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 1.5rem;
    }

    .product-info {
        max-width: 200px;
    }

    .stock-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .stock-high {
        background: #d4edda;
        color: #155724;
    }

    .stock-low {
        background: #fff3cd;
        color: #856404;
    }

    .stock-out {
        background: #f8d7da;
        color: #721c24;
    }

    .btn-group .btn {
        margin-left: 2px;
    }

    .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 8px 12px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ceb57f;
        box-shadow: 0 0 0 2px rgba(206, 181, 127, 0.25);
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    /* Enhanced Delete Modal Styling */
    .delete-modal {
        border-radius: 20px;
        border: none;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        overflow: hidden;
    }

    .delete-modal .modal-header {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        padding: 1.5rem 2rem;
        border-bottom: none;
        position: relative;
    }

    .delete-modal .modal-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        pointer-events: none;
    }

    .modal-icon {
        background: rgba(255,255,255,0.2);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 15px;
        font-size: 1.5rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .delete-modal .modal-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .btn-close {
        background: rgba(255,255,255,0.2);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .btn-close:hover {
        background: rgba(255,255,255,0.3);
        transform: scale(1.1);
    }

    .delete-modal .modal-body {
        padding: 2rem;
        background: #f8f9fa;
    }

    .warning-message p {
        font-size: 1.1rem;
        color: #333;
        margin-bottom: 1rem;
        text-align: center;
    }

    .warning-message strong {
        color: #dc3545;
        font-weight: 700;
    }

    .alert {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        border-left: 4px solid #ffc107;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert i {
        color: #856404;
        font-size: 1.2rem;
    }

    .alert span {
        color: #856404;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .delete-modal .modal-footer {
        padding: 1.5rem 2rem;
        background: white;
        border-top: 1px solid #e9ecef;
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .btn-cancel {
        background: #6c757d;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 25px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
    }

    .btn-cancel:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 25px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        color: white;
    }

    .btn-delete:focus {
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25);
    }

    /* Modal backdrop */
    .modal-backdrop {
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(5px);
    }
</style>

<script>
function confirmDelete(productId, productName) {
    document.getElementById('productName').textContent = productName;
    document.getElementById('deleteForm').action = `/admin/products/${productId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

function closeModal() {
    const modalElement = document.getElementById('deleteModal');

    // Direct DOM manipulation - most reliable method
    modalElement.style.display = 'none';
    modalElement.classList.remove('show');
    modalElement.setAttribute('aria-hidden', 'true');
    modalElement.removeAttribute('aria-modal');

    // Remove backdrop
    const backdrops = document.querySelectorAll('.modal-backdrop');
    backdrops.forEach(backdrop => backdrop.remove());

    // Reset body
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
}

// Auto-submit search form on filter change
document.addEventListener('DOMContentLoaded', function() {
    const filterSelects = document.querySelectorAll('#category, #stock_filter, #sort');
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });

    const modal = document.getElementById('deleteModal');

    // Add direct event listeners to buttons
    const cancelBtn = document.querySelector('.btn-cancel');
    const closeBtn = document.querySelector('.btn-close');

    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeModal();
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeModal();
        });
    }

    // Close on backdrop click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
});
</script>
@endsection
