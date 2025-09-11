@extends('layouts.admin')

@section('title', 'إضافة منتج جديد')
@section('page-title', 'إضافة منتج جديد')
@section('page-description', 'إضافة منتج جديد إلى المتجر')

@section('content')

<!-- Product Add Form -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header">
                <h5><i class="fas fa-plus"></i> إضافة منتج جديد</h5>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Product Image Upload -->
                    <div class="col-md-4 mb-4">
                        <div class="product-image-section">
                            <label class="form-label">صورة المنتج الرئيسية</label>
                            <div class="image-upload-container">
                                <input type="file"
                                       name="image"
                                       id="productImage"
                                       class="form-control @error('image') is-invalid @enderror"
                                       accept="image/*"
                                       onchange="previewImage(event)">
                                <div id="imagePreview" class="image-preview">
                                    <i class="fas fa-cloud-upload-alt fa-3x"></i>
                                    <p>اختر صورة المنتج</p>
                                </div>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">صورة المنتج الرئيسية (يفضل 800x800 بكسل)</small>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    اسم المنتج <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       placeholder="أدخل اسم المنتج"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">
                                    السعر (درهم مغربي) <span class="text-danger">*</span>
                                </label>
                                <input type="number"
                                       name="price"
                                       id="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price') }}"
                                       step="0.01"
                                       placeholder="0.00"
                                       required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">
                                    الفئة <span class="text-danger">*</span>
                                </label>
                                <select name="category_id"
                                        id="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror"
                                        required>
                                    <option value="">اختر الفئة</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label">
                                    الكمية المتوفرة <span class="text-danger">*</span>
                                </label>
                                <input type="number"
                                       name="stock"
                                       id="stock"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ old('stock', 0) }}"
                                       min="0"
                                       placeholder="0"
                                       required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="size" class="form-label">المقاس (اختياري)</label>
                                <input type="text"
                                       name="size"
                                       id="size"
                                       class="form-control @error('size') is-invalid @enderror"
                                       value="{{ old('size') }}"
                                       placeholder="مثال: S, M, L, XL">
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">خيارات المنتج</label>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="is_featured"
                                           id="is_featured"
                                           value="1"
                                           {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        منتج مميز (يظهر في الصفحة الرئيسية)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="is_recommended"
                                           id="is_recommended"
                                           value="1"
                                           {{ old('is_recommended') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_recommended">
                                        منتج موصى به
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">وصف المنتج</label>
                    <textarea name="description"
                              id="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="4"
                              placeholder="اكتب وصفاً مفصلاً للمنتج...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-12">
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('admin.products.index') }}" class="btn-admin-outline">
                                    <i class="fas fa-arrow-right"></i> العودة إلى قائمة المنتجات
                                </a>
                            </div>
                            <div>
                                <button type="submit" class="btn-admin">
                                    <i class="fas fa-save"></i> حفظ المنتج
                                </button>
                                <button type="button" class="btn-admin-outline" onclick="clearForm()">
                                    <i class="fas fa-undo"></i> مسح النموذج
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stats-number">{{ $categories->count() }}</div>
            <div class="stats-label">إجمالي الفئات</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-plus"></i>
            </div>
            <div class="stats-number">جديد</div>
            <div class="stats-label">منتج جديد</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-image"></i>
            </div>
            <div class="stats-number">مطلوب</div>
            <div class="stats-label">صورة المنتج</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stats-number">مطلوب</div>
            <div class="stats-label">فئة المنتج</div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<style>
    .product-image-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border: 2px dashed #dee2e6;
        text-align: center;
    }

    .image-upload-container {
        position: relative;
    }

    .image-preview {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 40px;
        margin-top: 15px;
        color: #6c757d;
        transition: all 0.3s ease;
    }

    .image-preview:hover {
        border-color: #ceb57f;
        background: #fff;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        border: 3px solid #ceb57f;
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
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = `
                <img src="${e.target.result}" alt="معاينة الصورة">
                <div class="mt-2">
                    <small class="text-success">
                        <i class="fas fa-check-circle"></i> تم اختيار الصورة
                    </small>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }
}

function clearForm() {
    if (confirm('هل أنت متأكد من مسح جميع البيانات؟')) {
        document.querySelector('form').reset();
        document.getElementById('imagePreview').innerHTML = `
            <i class="fas fa-cloud-upload-alt fa-3x"></i>
            <p>اختر صورة المنتج</p>
        `;
        localStorage.removeItem('product_create_draft');
    }
}

// Auto-save draft functionality
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input, textarea, select');

    // Load saved draft
    const savedDraft = localStorage.getItem('product_create_draft');
    if (savedDraft) {
        try {
            const data = JSON.parse(savedDraft);
            Object.keys(data).forEach(key => {
                const input = form.querySelector(`[name="${key}"]`);
                if (input && input.type !== 'file') {
                    if (input.type === 'checkbox') {
                        input.checked = data[key];
                    } else {
                        input.value = data[key];
                    }
                }
            });
        } catch (e) {
            console.log('No valid draft data found');
        }
    }

    // Save draft on input change
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const formData = new FormData(form);
            const data = {};
            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }
            localStorage.setItem('product_create_draft', JSON.stringify(data));
        });
    });

    // Clear draft on successful submit
    form.addEventListener('submit', function() {
        localStorage.removeItem('product_create_draft');
    });
});
</script>
@endsection
