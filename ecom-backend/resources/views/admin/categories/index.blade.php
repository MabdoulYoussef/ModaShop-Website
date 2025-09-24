@extends('layouts.admin')

@section('title', 'إدارة الفئات')
@section('page-title', 'إدارة الفئات')
@section('page-description', 'عرض وإدارة جميع فئات المنتجات')

@section('content')

<!-- Action Buttons -->
<div class="row mb-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0"><i class="fas fa-tags"></i> جميع الفئات</h5>
                    <small class="text-muted">إجمالي الفئات: {{ $categories->count() }}</small>
                </div>
                <div>
                    <a href="{{ route('admin.categories.create') }}" class="btn-admin">
                        <i class="fas fa-plus"></i> إضافة فئة جديدة
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Grid -->
<div class="row">
    @if($categories->count() > 0)
        @foreach($categories as $category)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="category-actions">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="btn-action btn-edit"
                               title="تعديل">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button"
                                    class="btn-action btn-delete"
                                    title="حذف"
                                    onclick="confirmDelete({{ $category->id }}, '{{ $category->name }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="category-body">
                        <h6 class="category-name">{{ $category->name }}</h6>
                        <div class="category-stats">
                            <div class="stat-item">
                                <i class="fas fa-box"></i>
                                <span>{{ $category->products->count() }} منتج</span>
                            </div>
                        </div>
                        <div class="category-meta">
                            <small class="text-muted">
                                <i class="fas fa-calendar"></i>
                                {{ $category->created_at->format('Y-m-d') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="admin-card">
                <div class="text-center py-5">
                    <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">لا توجد فئات</h5>
                    <p class="text-muted">ابدأ بإضافة فئات جديدة لتنظيم منتجاتك</p>
                    <a href="{{ route('admin.categories.create') }}" class="btn-admin">
                        <i class="fas fa-plus"></i> إضافة فئة جديدة
                    </a>
                </div>
            </div>
        </div>
    @endif
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
                    <p>هل أنت متأكد من حذف الفئة <strong id="categoryName"></strong>؟</p>
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i>
                        <span>هذا الإجراء لا يمكن التراجع عنه. سيتم نقل جميع المنتجات إلى فئة "غير محدد".</span>
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
    .category-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid #eee;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .category-header {
        background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%);
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .category-icon {
        color: white;
        font-size: 2rem;
    }

    .category-actions {
        display: flex;
        gap: 5px;
    }

    .btn-action {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: rgba(255,255,255,0.2);
        color: white;
    }

    .btn-edit:hover {
        background: rgba(255,255,255,0.3);
        color: white;
    }

    .btn-delete {
        background: rgba(220, 53, 69, 0.8);
        color: white;
    }

    .btn-delete:hover {
        background: rgba(220, 53, 69, 1);
        color: white;
    }

    .category-body {
        padding: 20px;
    }

    .category-name {
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .category-stats {
        margin-bottom: 15px;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
        font-size: 0.9rem;
    }

    .stat-item i {
        color: #ceb57f;
        width: 16px;
    }

    .category-meta {
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .category-meta i {
        color: #ceb57f;
        margin-left: 5px;
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
function confirmDelete(categoryId, categoryName) {
    document.getElementById('categoryName').textContent = categoryName;
    document.getElementById('deleteForm').action = `/admin/categories/${categoryId}`;
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

// Ensure modal closes when clicking outside or pressing Escape
document.addEventListener('DOMContentLoaded', function() {
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
