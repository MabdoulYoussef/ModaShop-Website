@extends('layouts.admin')

@section('title', 'تعديل الفئة')
@section('page-title', 'تعديل الفئة')
@section('page-description', 'تعديل بيانات الفئة: ' . $category->name)

@section('content')

<!-- Category Edit Form -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header">
                <h5><i class="fas fa-edit"></i> تعديل الفئة: {{ $category->name }}</h5>
            </div>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Category Icon Selection -->
                    <div class="col-md-4 mb-4">
                        <div class="category-icon-section">
                            <label class="form-label">أيقونة الفئة</label>
                            <div class="icon-grid">
                                <div class="icon-option {{ $category->icon == 'fas fa-tag' ? 'selected' : '' }}" data-icon="fas fa-tag">
                                    <i class="fas fa-tag"></i>
                                    <span>علامة</span>
                                </div>
                                <div class="icon-option {{ $category->icon == 'fas fa-tshirt' ? 'selected' : '' }}" data-icon="fas fa-tshirt">
                                    <i class="fas fa-tshirt"></i>
                                    <span>ملابس</span>
                                </div>
                                <div class="icon-option {{ $category->icon == 'fas fa-shoe-prints' ? 'selected' : '' }}" data-icon="fas fa-shoe-prints">
                                    <i class="fas fa-shoe-prints"></i>
                                    <span>أحذية</span>
                                </div>
                                <div class="icon-option {{ $category->icon == 'fas fa-handbag' ? 'selected' : '' }}" data-icon="fas fa-handbag">
                                    <i class="fas fa-handbag"></i>
                                    <span>حقائب</span>
                                </div>
                                <div class="icon-option {{ $category->icon == 'fas fa-gem' ? 'selected' : '' }}" data-icon="fas fa-gem">
                                    <i class="fas fa-gem"></i>
                                    <span>مجوهرات</span>
                                </div>
                                <div class="icon-option {{ $category->icon == 'fas fa-watch' ? 'selected' : '' }}" data-icon="fas fa-watch">
                                    <i class="fas fa-watch"></i>
                                    <span>ساعات</span>
                                </div>
                                <div class="icon-option {{ $category->icon == 'fas fa-glasses' ? 'selected' : '' }}" data-icon="fas fa-glasses">
                                    <i class="fas fa-glasses"></i>
                                    <span>نظارات</span>
                                </div>
                                <div class="icon-option {{ $category->icon == 'fas fa-ring' ? 'selected' : '' }}" data-icon="fas fa-ring">
                                    <i class="fas fa-ring"></i>
                                    <span>خواتم</span>
                                </div>
                            </div>
                            <input type="hidden" name="icon" id="selectedIcon" value="{{ $category->icon ?? 'fas fa-tag' }}">
                        </div>
                    </div>

                    <!-- Category Details -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    اسم الفئة <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $category->name) }}"
                                       placeholder="أدخل اسم الفئة"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label">الرابط (Slug)</label>
                                <input type="text"
                                       name="slug"
                                       id="slug"
                                       class="form-control @error('slug') is-invalid @enderror"
                                       value="{{ old('slug', $category->slug) }}"
                                       placeholder="سيتم إنشاؤه تلقائياً">
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">سيتم إنشاء الرابط تلقائياً من اسم الفئة</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">وصف الفئة</label>
                            <textarea name="description"
                                      id="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="3"
                                      placeholder="اكتب وصفاً مختصراً للفئة...">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sort_order" class="form-label">ترتيب العرض</label>
                                <input type="number"
                                       name="sort_order"
                                       id="sort_order"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                                       min="0"
                                       placeholder="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">رقم أقل = ظهور أول</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">خيارات الفئة</label>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="is_active"
                                           id="is_active"
                                           value="1"
                                           {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        فئة نشطة (ستظهر في الموقع)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="show_in_menu"
                                           id="show_in_menu"
                                           value="1"
                                           {{ old('show_in_menu', $category->show_in_menu ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_in_menu">
                                        إظهار في القائمة الرئيسية
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-12">
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('admin.categories.index') }}" class="btn-admin-outline">
                                    <i class="fas fa-arrow-right"></i> العودة إلى قائمة الفئات
                                </a>
                            </div>
                            <div>
                                <button type="submit" class="btn-admin">
                                    <i class="fas fa-save"></i> حفظ التغييرات
                                </button>
                                <a href="{{ route('categories.show', $category->id) }}"
                                   class="btn-admin-outline"
                                   target="_blank">
                                    <i class="fas fa-eye"></i> عرض في الموقع
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Category Statistics -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="stats-number">{{ $category->created_at->format('Y-m-d') }}</div>
            <div class="stats-label">تاريخ الإنشاء</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stats-number">{{ $category->products->count() }}</div>
            <div class="stats-label">عدد المنتجات</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stats-number">{{ $category->views ?? 0 }}</div>
            <div class="stats-label">عدد المشاهدات</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stats-number">{{ $category->products->sum('stock') }}</div>
            <div class="stats-label">إجمالي المخزون</div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<style>
    .category-icon-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border: 2px dashed #dee2e6;
    }

    .icon-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin-top: 15px;
    }

    .icon-option {
        background: white;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .icon-option:hover {
        border-color: #ceb57f;
        background: #fff;
        transform: translateY(-2px);
    }

    .icon-option.selected {
        border-color: #ceb57f;
        background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%);
        color: white;
    }

    .icon-option i {
        font-size: 1.5rem;
        display: block;
        margin-bottom: 5px;
    }

    .icon-option span {
        font-size: 0.8rem;
        font-weight: 600;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ceb57f;
        box-shadow: 0 0 0 3px rgba(206, 181, 127, 0.1);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .form-check {
        margin-bottom: 10px;
    }

    .form-check-input {
        margin-left: 8px;
    }

    .form-check-input:checked {
        background-color: #ceb57f;
        border-color: #ceb57f;
    }

    .form-text {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 5px;
    }

    .btn-admin, .btn-admin-outline {
        margin-left: 10px;
    }

    .stats-card {
        text-align: center;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-left: 4px solid #ceb57f;
    }

    .stats-card .stats-icon {
        font-size: 2rem;
        color: #ceb57f;
        margin-bottom: 10px;
    }

    .stats-card .stats-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
    }

    .stats-card .stats-label {
        color: #666;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .text-danger {
        color: #dc3545 !important;
    }
</style>

<script>
// Icon selection
document.addEventListener('DOMContentLoaded', function() {
    const iconOptions = document.querySelectorAll('.icon-option');
    const selectedIconInput = document.getElementById('selectedIcon');

    iconOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from all options
            iconOptions.forEach(opt => opt.classList.remove('selected'));

            // Add selected class to clicked option
            this.classList.add('selected');

            // Update hidden input
            const iconClass = this.dataset.icon;
            selectedIconInput.value = iconClass;
        });
    });
});

// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    const slugInput = document.getElementById('slug');
    if (!slugInput.value || slugInput.value === '') {
        const slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9\u0600-\u06FF\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
        slugInput.value = slug;
    }
});

// Auto-save draft functionality
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input, textarea, select');

    // Save draft on input change
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const formData = new FormData(form);
            const data = {};
            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }
            localStorage.setItem('category_edit_draft', JSON.stringify(data));
        });
    });

    // Clear draft on successful submit
    form.addEventListener('submit', function() {
        localStorage.removeItem('category_edit_draft');
    });
});
</script>
@endsection
