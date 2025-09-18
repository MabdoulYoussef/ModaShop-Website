@extends('layouts.admin')

@section('title', 'إضافة منتج جديد')
@section('page-title', 'إضافة منتج جديد')
@section('page-description', 'إضافة منتج جديد إلى المتجر')

@section('content')

<!-- Page Header -->
<div class="admin-page-header mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-plus me-3"></i>إضافة منتج جديد</h1>
            <p>إضافة منتج جديد إلى متجر ModaShop</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.products.index') }}" class="btn-back-admin">
                <i class="fas fa-arrow-right"></i> العودة للمنتجات
            </a>
        </div>
    </div>
</div>

<!-- Product Statistics Overview -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stats-number">{{ date('d/m/Y') }}</div>
            <div class="stats-label">تاريخ اليوم</div>
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
            <div class="stats-number">{{ $categories->count() }}</div>
            <div class="stats-label">إجمالي الفئات</div>
        </div>
    </div>
</div>

<!-- Product Creation Form -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header">
                <h5><i class="fas fa-plus"></i> بيانات المنتج الجديد</h5>
                <p class="mb-0 text-muted">املأ جميع الحقول المطلوبة لإضافة المنتج</p>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf

                <!-- Product Image Section -->
                <div class="form-section">
                    <div class="section-header">
                        <h6><i class="fas fa-image"></i> صورة المنتج</h6>
                        <p>اختر صورة عالية الجودة للمنتج</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="image-upload-area">
                                <input type="file"
                                       name="image"
                                       id="productImage"
                                       class="file-input @error('image') is-invalid @enderror"
                                       accept="image/*"
                                       onchange="previewImage(event)">
                                <label for="productImage" class="upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>اختر صورة المنتج</span>
                                    <small>PNG, JPG, GIF حتى 5MB</small>
                                </label>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="image-preview-container">
                                <div id="imagePreview" class="image-preview">
                                    <i class="fas fa-image fa-3x"></i>
                                    <p>معاينة الصورة ستظهر هنا</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basic Information -->
                <div class="form-section">
                    <div class="section-header">
                        <h6><i class="fas fa-info-circle"></i> المعلومات الأساسية</h6>
                        <p>أدخل المعلومات الأساسية للمنتج</p>
                    </div>

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
                </div>

                <!-- Product Details -->
                <div class="form-section">
                    <div class="section-header">
                        <h6><i class="fas fa-cog"></i> تفاصيل المنتج</h6>
                        <p>أدخل التفاصيل الإضافية للمنتج</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="size" class="form-label">المقاسات المتوفرة</label>
                            <div class="size-options">
                                <div class="row">
                                    @php
                                        $availableSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
                                        $selectedSizes = old('sizes', []);
                                    @endphp
                                    @foreach($availableSizes as $size)
                                        <div class="col-4 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       name="sizes[]"
                                                       value="{{ $size }}"
                                                       id="size_{{ $size }}"
                                                       {{ in_array($size, $selectedSizes) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="size_{{ $size }}">
                                                    {{ $size }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <input type="hidden" name="size" id="sizeInput" value="{{ old('size') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">خيارات المنتج</label>
                            <div class="product-options">
                                <div class="form-check mb-3">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="is_featured"
                                           id="is_featured"
                                           value="1"
                                           {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        <i class="fas fa-star"></i> منتج مميز
                                        <small class="d-block text-muted">يظهر في الصفحة الرئيسية</small>
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
                                        <i class="fas fa-thumbs-up"></i> منتج موصى به
                                        <small class="d-block text-muted">يظهر في قسم التوصيات</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">وصف المنتج</label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="5"
                                  placeholder="اكتب وصفاً مفصلاً للمنتج...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-info">
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> جميع الحقول المميزة بـ * مطلوبة
                            </small>
                        </div>
                        <div class="action-buttons">
                            <button type="button" class="btn-admin-outline" onclick="previewProduct()">
                                <i class="fas fa-eye"></i> معاينة المنتج
                            </button>
                            <button type="button" class="btn-admin-outline" onclick="resetForm()">
                                <i class="fas fa-undo"></i> إعادة تعيين
                            </button>
                            <button type="submit" class="btn-admin">
                                <i class="fas fa-save"></i> حفظ المنتج
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<style>
    .admin-page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
    }

    .admin-page-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .admin-page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .btn-back-admin {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .btn-back-admin:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        text-decoration: none;
    }

    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border-left: 4px solid #667eea;
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .stats-icon {
        font-size: 2.5rem;
        color: #667eea;
        margin-bottom: 1rem;
    }

    .stats-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .stats-label {
        color: #666;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .admin-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem;
        border-bottom: 1px solid #dee2e6;
    }

    .card-header h5 {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-section {
        padding: 2rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .form-section:last-of-type {
        border-bottom: none;
    }

    .section-header {
        margin-bottom: 1.5rem;
    }

    .section-header h6 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .section-header p {
        color: #666;
        margin-bottom: 0;
    }

    .image-upload-area {
        position: relative;
    }

    .file-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem;
        border: 2px dashed #dee2e6;
        border-radius: 15px;
        background: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .upload-label:hover {
        border-color: #667eea;
        background: #f0f4ff;
    }

    .upload-label i {
        font-size: 3rem;
        color: #667eea;
        margin-bottom: 1rem;
    }

    .upload-label span {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .upload-label small {
        color: #666;
        font-size: 0.9rem;
    }

    .image-preview-container {
        height: 100%;
    }

    .image-preview {
        width: 100%;
        height: 200px;
        border: 2px dashed #dee2e6;
        border-radius: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        color: #666;
        transition: all 0.3s ease;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 10px;
        object-fit: cover;
    }

    .size-options {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 10px;
        border: 1px solid #dee2e6;
    }

    .size-options .form-check {
        margin-bottom: 0.5rem;
        padding-right: 30px;
    }

    .size-options .form-check-input {
        width: 16px;
        height: 16px;
    }

    .size-options .form-check-label {
        font-weight: 600;
        color: #333;
        font-size: 0.95rem;
    }

    .form-check {
        margin-bottom: 0.8rem;
        padding-right: 25px;
        position: relative;
    }

    .form-check-input {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: pointer;
        border: 2px solid #dee2e6;
        border-radius: 4px;
        background-color: white;
        transition: all 0.3s ease;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e");
    }

    .form-check-input:hover {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-check-label {
        font-weight: 500;
        color: #333;
        cursor: pointer;
        padding-right: 5px;
        line-height: 1.4;
    }

    .form-check-label small {
        display: block;
        margin-top: 3px;
        font-size: 0.85rem;
        color: #666;
        font-weight: 400;
    }

    .product-options {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 10px;
        border: 1px solid #dee2e6;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .form-actions {
        padding: 2rem;
        background: #f8f9fa;
        border-top: 1px solid #dee2e6;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-admin, .btn-admin-outline {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-admin {
        background: #667eea;
        color: white;
    }

    .btn-admin:hover {
        background: #5a6fd8;
        transform: translateY(-2px);
    }

    .btn-admin-outline {
        background: transparent;
        color: #667eea;
        border: 2px solid #667eea;
    }

    .btn-admin-outline:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
    }

    .text-danger {
        color: #dc3545 !important;
    }
</style>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        // Validate file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
            alert('حجم الملف يجب أن يكون أقل من 5 ميجابايت');
            return;
        }

        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('يرجى اختيار ملف صورة صالح');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = `
                <img src="${e.target.result}" alt="معاينة الصورة">
                <div class="mt-2">
                    <small class="text-success">
                        <i class="fas fa-check-circle"></i> تم اختيار الصورة بنجاح
                    </small>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }
}

function resetForm() {
    if (confirm('هل أنت متأكد من إعادة تعيين النموذج؟ سيتم مسح جميع البيانات المدخلة.')) {
        document.getElementById('productForm').reset();
        document.getElementById('imagePreview').innerHTML = `
            <i class="fas fa-image fa-3x"></i>
            <p>معاينة الصورة ستظهر هنا</p>
        `;
        localStorage.removeItem('product_create_draft');
    }
}

function previewProduct() {
    const formData = new FormData(document.getElementById('productForm'));
    const productData = {};

    for (let [key, value] of formData.entries()) {
        productData[key] = value;
    }

    // Create preview window
    const previewWindow = window.open('', '_blank', 'width=800,height=600');
    previewWindow.document.write(`
        <html>
        <head>
            <title>معاينة المنتج</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; direction: rtl; }
                .preview-container { max-width: 600px; margin: 0 auto; }
                .preview-header { background: #667eea; color: white; padding: 20px; border-radius: 10px; text-align: center; margin-bottom: 20px; }
                .preview-content { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
                .preview-image { width: 100%; max-width: 300px; height: 300px; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
                .preview-details { margin-bottom: 15px; }
                .preview-label { font-weight: bold; color: #333; }
                .preview-value { color: #666; margin-right: 10px; }
                .status-badge { display: inline-block; padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: bold; }
                .status-new { background: #28a745; color: white; }
            </style>
        </head>
        <body>
            <div class="preview-container">
                <div class="preview-header">
                    <h2>معاينة المنتج الجديد</h2>
                </div>
                <div class="preview-content">
                    <div class="preview-image">
                        <span>صورة المنتج</span>
                    </div>
                    <div class="preview-details">
                        <span class="preview-label">اسم المنتج:</span>
                        <span class="preview-value">${productData.name || 'غير محدد'}</span>
                    </div>
                    <div class="preview-details">
                        <span class="preview-label">السعر:</span>
                        <span class="preview-value">${productData.price || '0'} درهم مغربي</span>
                    </div>
                    <div class="preview-details">
                        <span class="preview-label">الكمية:</span>
                        <span class="preview-value">${productData.stock || '0'}</span>
                    </div>
                    <div class="preview-details">
                        <span class="preview-label">الحالة:</span>
                        <span class="status-badge status-new">منتج جديد</span>
                    </div>
                    ${productData.description ? `
                    <div class="preview-details">
                        <span class="preview-label">الوصف:</span>
                        <span class="preview-value">${productData.description}</span>
                    </div>
                    ` : ''}
                </div>
            </div>
        </body>
        </html>
    `);
}

// Auto-save draft functionality
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('productForm');
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

    // Update size input when checkboxes change
    const sizeCheckboxes = document.querySelectorAll('input[name="sizes[]"]');
    const sizeInput = document.getElementById('sizeInput');

    sizeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const selectedSizes = Array.from(sizeCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
            sizeInput.value = selectedSizes.join(', ');
        });
    });
});
</script>
@endsection
