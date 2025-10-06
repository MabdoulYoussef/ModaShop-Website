@extends('layouts.admin')

@section('title', 'تعديل المنتج')
@section('page-title', 'تعديل المنتج')
@section('page-description', 'تعديل بيانات المنتج: ' . $product->name)

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<!-- Page Header -->
<div class="admin-page-header mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-edit me-3"></i>تعديل المنتج</h1>
            <p>تعديل بيانات المنتج: {{ $product->name }}</p>
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
            <div class="stats-number">{{ $product->created_at->format('d/m/Y') }}</div>
            <div class="stats-label">تاريخ الإضافة</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stats-number">{{ $product->orderItems->count() }}</div>
            <div class="stats-label">عدد الطلبات</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stats-number">{{ $product->views ?? 0 }}</div>
            <div class="stats-label">عدد المشاهدات</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stats-number">{{ $product->stock }}</div>
            <div class="stats-label">الكمية المتوفرة</div>
        </div>
    </div>
</div>

<!-- Product Creation Form -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-edit"></i> بيانات المنتج</h5>
                <p class="mb-0 text-light">تعديل معلومات المنتج</p>
            </div>

            <div class="admin-card-body">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
                    @csrf
                    @method('PUT')

                    <!-- Hidden inputs for removed images -->
                    <div id="removedImagesInputs"></div>

                    <!-- Product Images Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <h6><i class="fas fa-images"></i> صور المنتج</h6>
                            <p>اختر صور عالية الجودة للمنتج - يمكن رفع عدة صور</p>
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
                                        <small>يمكن رفع عدة صور - PNG, JPG, GIF حتى 5MB</small>
                                    </label>
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="images-preview-container">
                                    <div id="imagesPreview" class="images-preview">
                                        @if($product->images && count($product->images) > 0)
                                            @foreach($product->images as $index => $image)
                                                <div class="preview-image-item">
                                                    <img src="/assets/img/{{ $image }}" alt="صورة {{ $index + 1 }}">
                                                    <div class="preview-overlay">
                                                        <span>صورة {{ $index + 1 }}</span>
                                                        <button type="button" class="btn-remove-preview" onclick="removeExistingImage(this, {{ $index }})">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @elseif($product->image)
                                            <div class="preview-image-item">
                                                <img src="/assets/img/{{ $product->image }}" alt="صورة المنتج الحالية">
                                                <div class="preview-overlay">
                                                    <span>الصورة الحالية</span>
                                                    <button type="button" class="btn-remove-preview" onclick="removeExistingImage(this, 0)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="no-images-placeholder">
                                                <i class="fas fa-images fa-3x"></i>
                                                <p>معاينة الصور ستظهر هنا</p>
                                            </div>
                                        @endif
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
                                       value="{{ old('name', $product->name) }}"
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
                                       value="{{ old('price', $product->price) }}"
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
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                       value="{{ old('stock', $product->stock) }}"
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
                                            $selectedSizes = old('sizes', explode(',', $product->size ?? ''));
                                            $selectedSizes = array_filter($selectedSizes);
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
                                <input type="hidden" name="size" id="sizeInput" value="{{ old('size', $product->size) }}">
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
                                               {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
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
                                               {{ old('is_monthly_offer', $product->is_monthly_offer) ? 'checked' : '' }}>
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
                                               value="{{ old('monthly_offer_deadline', $product->monthly_offer_deadline ? $product->monthly_offer_deadline->format('Y-m-d\TH:i') : '') }}"
                                               min="{{ now()->format('Y-m-d\TH:i') }}">
                                        <small class="form-text text-muted">حدد تاريخ ووقت انتهاء العرض الشهري</small>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="is_recommended"
                                               id="is_recommended"
                                               value="1"
                                               {{ old('is_recommended', $product->is_recommended) ? 'checked' : '' }}>
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
                                      placeholder="اكتب وصفاً مفصلاً للمنتج...">{{ old('description', $product->description) }}</textarea>
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
                                    <i class="fas fa-save"></i> حفظ التغييرات
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<style>
    .admin-page-header {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(173, 143, 83, 0.3);
    }

    .admin-page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .admin-page-header p {
        font-size: 1.1rem;
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
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
        border-left: 4px solid #ad8f53;
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .stats-icon {
        font-size: 2.5rem;
        color: #ad8f53;
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
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: none;
        margin-bottom: 2rem;
    }

    .admin-card-header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 1.5rem 2rem;
        border: none;
    }

    .admin-card-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .admin-card-body {
        padding: 2rem;
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
        border-color: #ad8f53;
        background: #f0f4ff;
    }

    .upload-label i {
        font-size: 3rem;
        color: #ad8f53;
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

    .images-preview-container {
        height: 100%;
    }

    .images-preview {
        width: 100%;
        min-height: 200px;
        border: 2px dashed #dee2e6;
        border-radius: 15px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 15px;
        background: #f8f9fa;
        color: #666;
        transition: all 0.3s ease;
    }

    .preview-image-item {
        position: relative;
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .preview-image-item:hover {
        border-color: #ad8f53;
        transform: scale(1.05);
    }

    .preview-image-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
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
        text-align: center;
    }

    .preview-image-item:hover .preview-overlay {
        opacity: 1;
    }

    .preview-overlay span {
        margin-bottom: 5px;
        font-weight: 600;
    }

    .btn-remove-preview {
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 10px;
        transition: all 0.3s ease;
    }

    .btn-remove-preview:hover {
        background: #c82333;
        transform: scale(1.1);
    }

    .no-images-placeholder {
        width: 100%;
        height: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #666;
    }

    .no-images-placeholder i {
        margin-bottom: 10px;
        color: #ad8f53;
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
        background-color: #ad8f53;
        border-color: #ad8f53;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e");
    }

    .form-check-input:hover {
        border-color: #ad8f53;
        box-shadow: 0 0 0 3px rgba(173, 143, 83, 0.1);
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
        border-color: #ad8f53;
        box-shadow: 0 0 0 3px rgba(173, 143, 83, 0.1);
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
        background: #ad8f53;
        color: white;
    }

    .btn-admin:hover {
        background: #8b6f3f;
        transform: translateY(-2px);
    }

    .btn-admin-outline {
        background: transparent;
        color: #ad8f53;
        border: 2px solid #ad8f53;
    }

    .btn-admin-outline:hover {
        background: #ad8f53;
        color: white;
        transform: translateY(-2px);
    }

    .text-danger {
        color: #dc3545 !important;
    }
</style>

<script>
// Global variables for multiple image handling
let allSelectedFiles = [];
let existingImages = @json($product->images ?? []);
let removedImageIndexes = [];

function previewImages(event) {
    const files = Array.from(event.target.files);
    console.log('Files selected:', files.length);
    console.log('Files:', files);

    // Add new files to the global array
    files.forEach(file => {
        // Check if file already exists
        const fileExists = allSelectedFiles.some(existingFile =>
            existingFile.name === file.name && existingFile.size === file.size
        );

        if (!fileExists) {
            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert(`حجم الملف ${file.name} يجب أن يكون أقل من 5 ميجابايت`);
                return;
            }

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert(`يرجى اختيار ملف صورة صالح: ${file.name}`);
                return;
            }

            allSelectedFiles.push(file);
        }
    });

    // Update the file input to reflect all selected files
    updateFileInput();

    // Generate previews for new files
    generatePreviews();
}

function updateFileInput() {
    const fileInput = document.getElementById('productImages');
    const dataTransfer = new DataTransfer();

    allSelectedFiles.forEach(file => {
        dataTransfer.items.add(file);
    });

    fileInput.files = dataTransfer.files;
}

function generatePreviews() {
    const previewContainer = document.getElementById('imagesPreview');

    // Clear existing previews
    previewContainer.innerHTML = '';

    // Add existing images (that haven't been removed)
    existingImages.forEach((image, index) => {
        if (!removedImageIndexes.includes(index)) {
            const imagePreview = document.createElement('div');
            imagePreview.className = 'preview-image-item';
            imagePreview.innerHTML = `
                <img src="/assets/img/${image}" alt="صورة ${index + 1}">
                <div class="preview-overlay">
                    <span>صورة ${index + 1}</span>
                    <button type="button" class="btn-remove-preview" onclick="removeExistingImage(this, ${index})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            previewContainer.appendChild(imagePreview);
        }
    });

    // Add new selected files
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

function removePreviewImage(button, index) {
    // Remove from allSelectedFiles array
    allSelectedFiles.splice(index, 1);

    // Update file input
    updateFileInput();

    // Regenerate previews
    generatePreviews();
}

function removeExistingImage(button, index) {
    // Add to removed indexes
    removedImageIndexes.push(index);

    // Update hidden inputs for removed images
    updateRemovedImagesInputs();

    // Regenerate previews
    generatePreviews();
}

function updateRemovedImagesInputs() {
    const container = document.getElementById('removedImagesInputs');
    container.innerHTML = '';

    removedImageIndexes.forEach(index => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'removed_image_indexes[]';
        input.value = index;
        container.appendChild(input);
    });
}

function resetForm() {
    if (confirm('هل أنت متأكد من إعادة تعيين النموذج؟ سيتم مسح جميع البيانات المدخلة.')) {
        // Clear multiple image arrays
        allSelectedFiles = [];
        removedImageIndexes = [];

        // Clear removed images inputs
        document.getElementById('removedImagesInputs').innerHTML = '';

        // Clear preview container
        const previewContainer = document.getElementById('imagesPreview');
        previewContainer.innerHTML = '<div class="no-images-placeholder"><i class="fas fa-images fa-3x"></i><p>معاينة الصور ستظهر هنا</p></div>';

        // Reset file input
        document.getElementById('productImages').value = '';

        // Reload page to reset everything
        location.reload();
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
                .preview-header { background: #ad8f53; color: white; padding: 20px; border-radius: 10px; text-align: center; margin-bottom: 20px; }
                .preview-content { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
                .preview-image { width: 100%; max-width: 300px; height: 300px; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
                .preview-details { margin-bottom: 15px; }
                .preview-label { font-weight: bold; color: #333; }
                .preview-value { color: #666; margin-right: 10px; }
                .status-badge { display: inline-block; padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: bold; }
                .status-edit { background: #17a2b8; color: white; }
            </style>
        </head>
        <body>
            <div class="preview-container">
                <div class="preview-header">
                    <h2>معاينة المنتج المحدث</h2>
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
                        <span class="status-badge status-edit">منتج محدث</span>
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

// CSRF Token refresh function
function refreshCSRFToken() {
    fetch('/admin/products/{{ $product->id }}/edit', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newToken = doc.querySelector('input[name="_token"]');
        if (newToken) {
            const currentToken = document.querySelector('input[name="_token"]');
            if (currentToken) {
                currentToken.value = newToken.value;
            }
        }
    })
    .catch(error => {
        console.log('CSRF token refresh failed:', error);
    });
}

// Auto-save draft functionality
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('productForm');
    const inputs = form.querySelectorAll('input, textarea, select');

    // Refresh CSRF token every 30 minutes
    setInterval(refreshCSRFToken, 30 * 60 * 1000);

    // Load saved draft
    const savedDraft = localStorage.getItem('product_edit_draft_{{ $product->id }}');
    if (savedDraft) {
        try {
            const data = JSON.parse(savedDraft);
            Object.keys(data).forEach(key => {
                // Skip CSRF token and method override
                if (key === '_token' || key === '_method') {
                    return;
                }

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
                // Skip CSRF token and method override
                if (key === '_token' || key === '_method') {
                    continue;
                }
                data[key] = value;
            }
            localStorage.setItem('product_edit_draft_{{ $product->id }}', JSON.stringify(data));
        });
    });

    // Clear draft on successful submit
    form.addEventListener('submit', function(e) {
        // Ensure CSRF token is present
        const csrfToken = document.querySelector('input[name="_token"]');
        if (!csrfToken || !csrfToken.value) {
            e.preventDefault();
            alert('خطأ في الأمان. يرجى إعادة تحميل الصفحة والمحاولة مرة أخرى.');
            return;
        }

        // Clear draft
        localStorage.removeItem('product_edit_draft_{{ $product->id }}');

        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';
        }
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

    // Monthly offer deadline functionality
    const monthlyOfferCheckbox = document.getElementById('is_monthly_offer');
    const monthlyOfferDeadline = document.getElementById('monthly-offer-deadline');

    if (monthlyOfferCheckbox && monthlyOfferDeadline) {
        monthlyOfferCheckbox.addEventListener('change', function() {
            if (this.checked) {
                monthlyOfferDeadline.style.display = 'block';
                // Set default deadline to 30 days from now if no deadline is set
                const deadlineInput = document.getElementById('monthly_offer_deadline');
                if (!deadlineInput.value) {
                    const defaultDate = new Date();
                    defaultDate.setDate(defaultDate.getDate() + 30);
                    deadlineInput.value = defaultDate.toISOString().slice(0, 16);
                }
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
@endsection
