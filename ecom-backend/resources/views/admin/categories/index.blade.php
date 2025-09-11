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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من حذف الفئة <strong id="categoryName"></strong>؟</p>
                <p class="text-danger"><small>هذا الإجراء لا يمكن التراجع عنه. سيتم نقل جميع المنتجات إلى فئة "غير محدد".</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
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
</style>

<script>
function confirmDelete(categoryId, categoryName) {
    document.getElementById('categoryName').textContent = categoryName;
    document.getElementById('deleteForm').action = `/admin/categories/${categoryId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection
