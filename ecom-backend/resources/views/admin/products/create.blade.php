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
                                       name="images[]"
                                       id="productImages"
                                       class="file-input @error('images') is-invalid @enderror"
                                       accept="image/*"
                                       multiple
                                       onchange="previewImages(event)">
                                <label for="productImages" class="upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>اختر صور المنتج</span>
                                    <small>PNG, JPG, GIF حتى 5MB (يمكن رفع عدة صور)</small>
                                </label>
                                @error('images')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('images.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="images-preview-container">
                                <div id="imagesPreview" class="images-preview">
                                    <i class="fas fa-images fa-3x"></i>
                                    <p>معاينة الصور ستظهر هنا</p>
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
                            <label class="form-label">الألوان المتوفرة</label>
                            <div class="color-selection-container">

                                <!-- Predefined Colors -->
                                <div class="predefined-colors-section">
                                    <h6 class="colors-section-title">الألوان الأساسية</h6>
                                    <div class="predefined-colors-grid">
                                        <div class="color-checkbox-item">
                                            <input type="checkbox" name="predefined_colors[]" value="أسود" id="color_black">
                                            <label for="color_black" class="color-label">
                                                <span class="color-swatch" style="background: #000;"></span>
                                                <span class="color-name">أسود</span>
                                            </label>
                                        </div>
                                        <div class="color-checkbox-item">
                                            <input type="checkbox" name="predefined_colors[]" value="أبيض" id="color_white">
                                            <label for="color_white" class="color-label">
                                                <span class="color-swatch" style="background: #fff; border: 1px solid #ccc;"></span>
                                                <span class="color-name">أبيض</span>
                                            </label>
                                        </div>
                                        <div class="color-checkbox-item">
                                            <input type="checkbox" name="predefined_colors[]" value="أزرق" id="color_blue">
                                            <label for="color_blue" class="color-label">
                                                <span class="color-swatch" style="background: #0066cc;"></span>
                                                <span class="color-name">أزرق</span>
                                            </label>
                                        </div>
                                        <div class="color-checkbox-item">
                                            <input type="checkbox" name="predefined_colors[]" value="أخضر" id="color_green">
                                            <label for="color_green" class="color-label">
                                                <span class="color-swatch" style="background: #00cc66;"></span>
                                                <span class="color-name">أخضر</span>
                                            </label>
                                        </div>
                                        <div class="color-checkbox-item">
                                            <input type="checkbox" name="predefined_colors[]" value="أصفر" id="color_yellow">
                                            <label for="color_yellow" class="color-label">
                                                <span class="color-swatch" style="background: #ffcc00;"></span>
                                                <span class="color-name">أصفر</span>
                                            </label>
                                        </div>
                                        <div class="color-checkbox-item">
                                            <input type="checkbox" name="predefined_colors[]" value="بنفسجي" id="color_purple">
                                            <label for="color_purple" class="color-label">
                                                <span class="color-swatch" style="background: #9900cc;"></span>
                                                <span class="color-name">بنفسجي</span>
                                            </label>
                                        </div>
                                        <div class="color-checkbox-item">
                                            <input type="checkbox" name="predefined_colors[]" value="بني" id="color_brown">
                                            <label for="color_brown" class="color-label">
                                                <span class="color-swatch" style="background: #8B4513;"></span>
                                                <span class="color-name">بني</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Custom Colors -->
                                <div class="custom-colors-section">
                                    <h6 class="colors-section-title">ألوان مخصصة</h6>
                                    <div class="color-inputs" id="colorInputs">
                                        <div class="color-input-group">
                                            <input type="text"
                                                   name="custom_colors[]"
                                                   class="form-control color-input"
                                                   placeholder="اكتب اسم اللون بالعربية (مثل: وردي فاتح، أزرق داكن)"
                                                   value="{{ old('custom_colors.0') }}">
                                            <button type="button" class="btn-remove-color" onclick="removeColorInput(this)" style="display: none;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-add-color" onclick="addColorInput()">
                                        <i class="fas fa-plus"></i> إضافة لون مخصص آخر
                                    </button>
                                </div>

                                <small class="form-text text-muted">
                                    يمكنك اختيار الألوان الأساسية أو إضافة ألوان مخصصة
                                </small>
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

                    <!-- Product Options -->
                    <div class="mb-3">
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
                                    <small class="d-block text-muted">يظهر في قسم "منتجاتنا المميزة" (حد أقصى 3 منتجات)</small>
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="is_monthly_offer"
                                       id="is_monthly_offer"
                                       value="1"
                                       {{ old('is_monthly_offer') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_monthly_offer">
                                    <i class="fas fa-percentage"></i> عرض الشهر
                                    <small class="d-block text-muted">يظهر في قسم "عرض الشهر" (منتج واحد فقط)</small>
                                </label>
                            </div>

                            <!-- Monthly Offer Deadline -->
                            <div class="monthly-offer-deadline" id="monthly-offer-deadline" style="display: none;">
                                <label for="monthly_offer_deadline" class="form-label">
                                    <i class="fas fa-calendar-alt"></i> تاريخ انتهاء العرض
                                </label>
                                <input type="datetime-local"
                                       class="form-control"
                                       id="monthly_offer_deadline"
                                       name="monthly_offer_deadline"
                                       value="{{ old('monthly_offer_deadline') }}"
                                       min="{{ now()->format('Y-m-d\TH:i') }}">
                                <small class="form-text text-muted">حدد تاريخ ووقت انتهاء العرض الشهري</small>
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

<script>
    // Monthly offer deadline functionality
    document.addEventListener('DOMContentLoaded', function() {
        const monthlyOfferCheckbox = document.getElementById('is_monthly_offer');
        const monthlyOfferDeadline = document.getElementById('monthly-offer-deadline');

        if (monthlyOfferCheckbox && monthlyOfferDeadline) {
            monthlyOfferCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    monthlyOfferDeadline.style.display = 'block';
                    // Set default deadline to 30 days from now
                    const defaultDate = new Date();
                    defaultDate.setDate(defaultDate.getDate() + 30);
                    document.getElementById('monthly_offer_deadline').value = defaultDate.toISOString().slice(0, 16);
                } else {
                    monthlyOfferDeadline.style.display = 'none';
                    document.getElementById('monthly_offer_deadline').value = '';
                }
            });

            // Initialize monthly offer deadline visibility
            if (monthlyOfferCheckbox.checked) {
                monthlyOfferDeadline.style.display = 'block';
            }
        }
    });
</script>

@section('scripts')
<style>
    .admin-page-header {
        background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%);
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
        border-left: 4px solid #ceb57f;
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .stats-icon {
        font-size: 2.5rem;
        color: #ceb57f;
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
        border-color: #ceb57f;
        background: #f0f4ff;
    }

    .upload-label i {
        font-size: 3rem;
        color: #ceb57f;
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
        background-color: #ceb57f;
        border-color: #ceb57f;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e");
    }

    .form-check-input:hover {
        border-color: #ceb57f;
        box-shadow: 0 0 0 3px rgba(206, 181, 127, 0.1);
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

    /* Enhanced Color Selection Styling */
    .color-selection-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 1.5rem;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .color-selection-container:hover {
        border-color: #ceb57f;
        box-shadow: 0 5px 20px rgba(206, 181, 127, 0.1);
    }

    .color-inputs {
        margin-bottom: 1rem;
    }

    .color-input-group {
        position: relative;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .color-input {
        flex: 1;
        border: 2px solid #dee2e6;
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .color-input:focus {
        border-color: #ceb57f;
        box-shadow: 0 0 0 3px rgba(206, 181, 127, 0.1);
        transform: translateY(-1px);
    }

    .color-input::placeholder {
        color: #999;
        font-style: italic;
    }

    .btn-remove-color {
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }

    .btn-remove-color:hover {
        background: #c82333;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    }

    .btn-add-color {
        background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(206, 181, 127, 0.3);
    }

    .btn-add-color:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(206, 181, 127, 0.4);
    }

    .btn-add-color i {
        font-size: 14px;
    }

    /* Predefined Colors Styling */
    .predefined-colors-section {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #e9ecef;
    }

    .custom-colors-section {
        margin-top: 1rem;
    }

    .colors-section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .colors-section-title::before {
        content: "🎨";
        font-size: 1.1rem;
    }

    /* Color-specific label styling */
    .form-label[for="colors"]::before,
    .form-label:has(+ .color-selection-container)::before {
        content: "🎨";
        font-size: 1.2rem;
    }

    .predefined-colors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 12px;
    }

    .color-checkbox-item {
        position: relative;
    }

    .color-checkbox-item input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 2;
    }

    .color-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 15px 10px;
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        text-align: center;
    }

    .color-label:hover {
        border-color: #ceb57f;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(206, 181, 127, 0.15);
    }

    .color-checkbox-item input[type="checkbox"]:checked + .color-label {
        border-color: #ceb57f;
        background: linear-gradient(135deg, #f0f4ff 0%, #e6f0ff 100%);
        box-shadow: 0 4px 15px rgba(206, 181, 127, 0.2);
        transform: translateY(-2px);
    }

    .color-checkbox-item input[type="checkbox"]:checked + .color-label .color-swatch {
        transform: scale(1.1);
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .color-swatch {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-bottom: 8px;
        transition: all 0.3s ease;
        border: 2px solid rgba(255,255,255,0.3);
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .color-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: #333;
        transition: color 0.3s ease;
    }

    .color-checkbox-item input[type="checkbox"]:checked + .color-label .color-name {
        color: #ceb57f;
        font-weight: 700;
    }

    /* Enhanced Form Styling */
    .form-section {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        margin-bottom: 2rem;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        border: 1px solid #e9ecef;
        overflow: hidden;
    }

    .section-header {
        background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%);
        color: white;
        padding: 1.5rem 2rem;
        margin: -2rem -2rem 1.5rem -2rem;
        border-radius: 20px 20px 0 0;
    }

    .section-header h6 {
        color: white;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .section-header p {
        color: rgba(255,255,255,0.9);
        margin-bottom: 0;
        font-size: 0.95rem;
    }

    .form-label {
        font-weight: 700;
        color: #333;
        margin-bottom: 12px;
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label::before {
        content: "";
        font-size: 1.2rem;
    }

    /* Enhanced Input Styling */
    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 15px 18px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .form-control:focus, .form-select:focus {
        border-color: #ceb57f;
        box-shadow: 0 0 0 4px rgba(206, 181, 127, 0.1);
        transform: translateY(-1px);
    }

    /* Enhanced Size Options */
    .size-options {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem;
        border-radius: 15px;
        border: 2px solid #e9ecef;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .size-options .form-check {
        background: white;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 10px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .size-options .form-check:hover {
        border-color: #ceb57f;
        box-shadow: 0 4px 15px rgba(206, 181, 127, 0.15);
        transform: translateY(-2px);
    }

    .size-options .form-check-input {
        position: static;
        transform: none;
        width: 20px;
        height: 20px;
        margin: 0;
        flex-shrink: 0;
    }

    .size-options .form-check-label {
        font-weight: 600;
        color: #333;
        font-size: 1rem;
        margin: 0;
        padding: 0;
        cursor: pointer;
        flex: 1;
    }

    /* Enhanced Product Options */
    .product-options {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem;
        border-radius: 15px;
        border: 2px solid #e9ecef;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .product-options .form-check {
        background: white;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 12px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .product-options .form-check:hover {
        border-color: #ceb57f;
        box-shadow: 0 3px 12px rgba(206, 181, 127, 0.15);
        transform: translateY(-2px);
    }

    /* Enhanced Image Upload */
    .image-upload-area {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 20px;
        padding: 2rem;
        border: 3px dashed #dee2e6;
        transition: all 0.3s ease;
    }

    .image-upload-area:hover {
        border-color: #ceb57f;
        background: linear-gradient(135deg, #f0f4ff 0%, #e6f0ff 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(206, 181, 127, 0.15);
    }

    .upload-label {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    /* Enhanced Action Buttons */
    .form-actions {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-top: 3px solid #ceb57f;
    }

    .btn-admin {
        background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%);
        border-radius: 12px;
        padding: 15px 25px;
        font-weight: 700;
        font-size: 1rem;
        box-shadow: 0 6px 20px rgba(206, 181, 127, 0.3);
    }

    .btn-admin:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(206, 181, 127, 0.4);
    }

    .btn-admin-outline {
        border-radius: 12px;
        padding: 15px 25px;
        font-weight: 700;
        font-size: 1rem;
        border: 2px solid #ceb57f;
        box-shadow: 0 4px 15px rgba(206, 181, 127, 0.2);
    }

    .btn-admin-outline:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(206, 181, 127, 0.3);
    /* Multiple Images Preview */
    .images-preview-container {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 15px;
        padding: 20px;
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .images-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    /* Override global body img rule for this page only - More specific */
    body .images-preview-container .preview-image-item img,
    .images-preview-container .preview-image-item img,
    .preview-image-item img {
        max-width: 80px !important;
        width: 80px !important;
        height: 80px !important;
        object-fit: cover !important;
        display: block !important;
        min-width: 80px !important;
        min-height: 80px !important;
    }

    /* Multiple Images Preview - Specific targeting */
    .images-preview-container .preview-image-item {
        position: relative;
        width: 80px !important;
        height: 80px !important;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #ceb57f;
        max-width: 80px !important;
        max-height: 80px !important;
        flex-shrink: 0;
    }

    .preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        font-size: 10px;
    }

    .preview-image-item:hover .preview-overlay {
        opacity: 1;
    }

    .btn-remove-preview {
        background: #dc3545;
        border: none;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        cursor: pointer;
        margin-top: 5px;
    }
</style>

<script>
// Global variable to store all selected files
let allSelectedFiles = [];

function previewImages(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('imagesPreview');

    console.log('Files selected:', files.length);
    console.log('Files:', files);

    // Add new files to the existing collection
    Array.from(files).forEach(file => {
        // Check if file already exists
        const exists = allSelectedFiles.some(existingFile =>
            existingFile.name === file.name && existingFile.size === file.size
        );

        if (!exists) {
            allSelectedFiles.push(file);
            console.log('Added file:', file.name);
        }
    });

    console.log('Total files:', allSelectedFiles.length);

    // Clear previous previews
    previewContainer.innerHTML = '';

    if (allSelectedFiles.length === 0) {
        previewContainer.innerHTML = '<i class="fas fa-images fa-3x"></i><p>معاينة الصور ستظهر هنا</p>';
        return;
    }

    // Validate all files
    for (let i = 0; i < allSelectedFiles.length; i++) {
        const file = allSelectedFiles[i];

        // Validate file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
            alert(`حجم الملف ${file.name} يجب أن يكون أقل من 5 ميجابايت`);
            // Remove the invalid file
            allSelectedFiles.splice(i, 1);
            continue;
        }

        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert(`الملف ${file.name} ليس صورة صالحة`);
            // Remove the invalid file
            allSelectedFiles.splice(i, 1);
            continue;
        }
    }

    // Create preview for each image
    allSelectedFiles.forEach((file, index) => {
        console.log(`Processing file ${index + 1}:`, file.name, file.size);
        const reader = new FileReader();
        reader.onload = function(e) {
            const imagePreview = document.createElement('div');
            imagePreview.className = 'preview-image-item';
            imagePreview.innerHTML = `
                <img src="${e.target.result}" alt="معاينة ${index + 1}" style="width: 250px !important; height: 400px !important; max-width: 250px !important; max-height: 400px !important; object-fit: cover !important; display: block !important; border-radius : 10px !important;20px !important; ">
                <div class="preview-overlay">
                    <span>صورة ${index + 1}</span>
                    <button type="button" class="btn-remove-preview" onclick="removePreviewImage(this, ${index})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            previewContainer.appendChild(imagePreview);
            console.log(`Preview added for file ${index + 1}`);
        };
        reader.readAsDataURL(file);
    });

    // Update the file input to include all selected files
    updateFileInput();
}

function updateFileInput() {
    const fileInput = document.getElementById('productImages');
    const dt = new DataTransfer();

    allSelectedFiles.forEach(file => {
        dt.items.add(file);
    });

    fileInput.files = dt.files;
    console.log('File input updated with', allSelectedFiles.length, 'files');
}

function removePreviewImage(button, index) {
    // Remove from array
    allSelectedFiles.splice(index, 1);

    // Remove from DOM
    const previewItem = button.closest('.preview-image-item');
    previewItem.remove();

    // Update file input
    updateFileInput();

    // Re-render all previews to update numbering
    const previewContainer = document.getElementById('imagesPreview');
    previewContainer.innerHTML = '';

    if (allSelectedFiles.length === 0) {
        previewContainer.innerHTML = '<i class="fas fa-images fa-3x"></i><p>معاينة الصور ستظهر هنا</p>';
        return;
    }

    // Recreate all previews
    allSelectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imagePreview = document.createElement('div');
            imagePreview.className = 'preview-image-item';
            imagePreview.innerHTML = `
                <img src="${e.target.result}" alt="معاينة ${index + 1}" style="width: 80px !important; height: 80px !important; max-width: 80px !important; max-height: 80px !important; object-fit: cover !important; display: block !important;">
                <div class="preview-overlay">
                    <span>صورة ${index + 1}</span>
                    <button type="button" class="btn-remove-preview" onclick="removePreviewImage(this, ${index})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            previewContainer.appendChild(imagePreview);
        };
        reader.readAsDataURL(file);
    });
}

function resetForm() {
    if (confirm('هل أنت متأكد من إعادة تعيين النموذج؟ سيتم مسح جميع البيانات المدخلة.')) {
        document.getElementById('productForm').reset();
        // Clear the global files array
        allSelectedFiles = [];
        document.getElementById('imagesPreview').innerHTML = `
            <i class="fas fa-images fa-3x"></i>
            <p>معاينة الصور ستظهر هنا</p>
        `;

        // Reset color inputs
        const colorInputs = document.getElementById('colorInputs');
        colorInputs.innerHTML = `
            <div class="color-input-group">
                <input type="text"
                       name="custom_colors[]"
                       class="form-control color-input"
                       placeholder="اكتب اسم اللون بالعربية (مثل: وردي فاتح، أزرق داكن)">
                <button type="button" class="btn-remove-color" onclick="removeColorInput(this)" style="display: none;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        // Reset predefined colors
        document.querySelectorAll('input[name="predefined_colors[]"]').forEach(checkbox => {
            checkbox.checked = false;
        });

        localStorage.removeItem('product_create_draft');
        alert('تم مسح النموذج بنجاح');
    }
}

function previewProduct() {
    const formData = new FormData(document.getElementById('productForm'));
    const productData = {};

    // Get basic form data
    for (let [key, value] of formData.entries()) {
        if (key !== 'image' && key !== 'predefined_colors[]' && key !== 'custom_colors[]') {
            productData[key] = value;
        }
    }

    // Get colors
    const allColors = combineColors();
    productData.colors = allColors;

    // Get sizes
    const selectedSizes = Array.from(document.querySelectorAll('input[name="sizes[]"]:checked'))
        .map(cb => cb.value);
    productData.sizes = selectedSizes;

    // Create preview window
    const previewWindow = window.open('', '_blank', 'width=800,height=600');
    previewWindow.document.write(`
        <html>
        <head>
            <title>معاينة المنتج</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; direction: rtl; background: #f8f9fa; }
                .preview-container { max-width: 600px; margin: 0 auto; }
                .preview-header { background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%); color: white; padding: 20px; border-radius: 10px; text-align: center; margin-bottom: 20px; }
                .preview-content { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
                .preview-image { width: 100%; max-width: 300px; height: 300px; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
                .preview-details { margin-bottom: 15px; }
                .preview-label { font-weight: bold; color: #333; }
                .preview-value { color: #666; margin-right: 10px; }
                .status-badge { display: inline-block; padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: bold; }
                .status-new { background: #28a745; color: white; }
                .colors-list { display: flex; flex-wrap: wrap; gap: 5px; margin-top: 5px; }
                .color-tag { background: #ceb57f; color: white; padding: 3px 8px; border-radius: 12px; font-size: 12px; }
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
                        <span class="preview-label">الألوان:</span>
                        <div class="colors-list">
                            ${allColors.map(color => `<span class="color-tag">${color}</span>`).join('')}
                        </div>
                    </div>
                    <div class="preview-details">
                        <span class="preview-label">المقاسات:</span>
                        <span class="preview-value">${selectedSizes.join(', ') || 'غير محدد'}</span>
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

// Color Selection Functions
function addColorInput() {
    const colorInputs = document.getElementById('colorInputs');
    const colorCount = colorInputs.children.length;

    const colorGroup = document.createElement('div');
    colorGroup.className = 'color-input-group';
    colorGroup.innerHTML = `
        <input type="text"
               name="custom_colors[]"
               class="form-control color-input"
               placeholder="اكتب اسم اللون بالعربية (مثل: وردي فاتح، أزرق داكن)">
        <button type="button" class="btn-remove-color" onclick="removeColorInput(this)">
            <i class="fas fa-times"></i>
        </button>
    `;

    colorInputs.appendChild(colorGroup);

    // Show remove buttons for all inputs
    updateRemoveButtons();

    // Focus on the new input
    colorGroup.querySelector('.color-input').focus();
}

function removeColorInput(button) {
    const colorGroup = button.parentElement;
    colorGroup.remove();
    updateRemoveButtons();
}

function updateRemoveButtons() {
    const colorInputs = document.getElementById('colorInputs');
    const removeButtons = colorInputs.querySelectorAll('.btn-remove-color');

    // Show remove button only if there's more than one input
    removeButtons.forEach(button => {
        button.style.display = colorInputs.children.length > 1 ? 'flex' : 'none';
    });
}

// Combine predefined and custom colors before form submission
function combineColors() {
    const predefinedColors = Array.from(document.querySelectorAll('input[name="predefined_colors[]"]:checked'))
        .map(checkbox => checkbox.value);

    const customColors = Array.from(document.querySelectorAll('input[name="custom_colors[]"]'))
        .map(input => input.value.trim())
        .filter(value => value !== '');

    return [...predefinedColors, ...customColors];
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
    form.addEventListener('submit', function(e) {
        // Combine predefined and custom colors
        const allColors = combineColors();

        // Create hidden input for combined colors
        const colorsInput = document.createElement('input');
        colorsInput.type = 'hidden';
        colorsInput.name = 'colors';
        colorsInput.value = JSON.stringify(allColors);

        // Remove any existing colors input
        const existingColorsInput = form.querySelector('input[name="colors"]');
        if (existingColorsInput) {
            existingColorsInput.remove();
        }

        // Add the combined colors input
        form.appendChild(colorsInput);

        // Debug: Log form data before submission
        console.log('Form submitting with colors:', allColors);
        console.log('Form action:', form.action);
        console.log('Form method:', form.method);

        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';
        }

        // Add error handling
        form.addEventListener('error', function(e) {
            console.error('Form submission error:', e);
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save"></i> حفظ المنتج';
            }
        });

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
