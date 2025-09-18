@extends('layouts.admin')

@section('title', 'تعديل المنتج')
@section('page-title', 'تعديل المنتج')
@section('page-description', 'تعديل بيانات المنتج: ' . $product->name)

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
            <div class="stats-label">المخزون الحالي</div>
        </div>
    </div>
</div>

<!-- Main Edit Form -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-edit me-2"></i>تعديل المنتج: {{ $product->name }}</h5>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="productEditForm">
                @csrf
                @method('PUT')

                <div class="admin-card-body">
                    <div class="row">
                        <!-- Product Image Section -->
                        <div class="col-lg-4 mb-4">
                            <div class="product-image-section">
                                <div class="section-header">
                                    <h6><i class="fas fa-image me-2"></i>صورة المنتج</h6>
                                </div>

                                <div class="current-image-container">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             class="current-image"
                                             id="currentImage">
                                    @else
                                        <div class="no-image-placeholder">
                                            <i class="fas fa-image fa-3x"></i>
                                            <p class="mt-2">لا توجد صورة</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="image-upload-section">
                                    <label for="image" class="upload-label">
                                        <i class="fas fa-cloud-upload-alt me-2"></i>
                                        تغيير الصورة
                                    </label>
                                    <input type="file"
                                           class="form-control"
                                           id="image"
                                           name="image"
                                           accept="image/*"
                                           onchange="previewImage(this)">
                                    <small class="upload-hint">اختر صورة جديدة (JPG, PNG, GIF) - اختياري</small>
                                </div>

                                <!-- Image Actions -->
                                <div class="image-actions mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                                        <i class="fas fa-trash"></i> حذف الصورة
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="col-lg-8">
                            <!-- Basic Information -->
                            <div class="form-section">
                                <div class="section-header">
                                    <h6><i class="fas fa-info-circle me-2"></i>المعلومات الأساسية</h6>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="name" class="form-label">
                                                <i class="fas fa-tag me-1"></i>
                                                اسم المنتج <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   id="name"
                                                   name="name"
                                                   value="{{ old('name', $product->name) }}"
                                                   placeholder="أدخل اسم المنتج"
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="price" class="form-label">
                                                <i class="fas fa-dollar-sign me-1"></i>
                                                السعر (درهم) <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="number"
                                                       step="0.01"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       id="price"
                                                       name="price"
                                                       value="{{ old('price', $product->price) }}"
                                                       placeholder="0.00"
                                                       required>
                                                <span class="input-group-text">درهم</span>
                                            </div>
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="category_id" class="form-label">
                                                <i class="fas fa-folder me-1"></i>
                                                الفئة <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select @error('category_id') is-invalid @enderror"
                                                    id="category_id"
                                                    name="category_id"
                                                    required>
                                                <option value="">اختر الفئة</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="stock" class="form-label">
                                                <i class="fas fa-boxes me-1"></i>
                                                الكمية المتاحة <span class="text-danger">*</span>
                                            </label>
                                            <input type="number"
                                                   class="form-control @error('stock') is-invalid @enderror"
                                                   id="stock"
                                                   name="stock"
                                                   value="{{ old('stock', $product->stock) }}"
                                                   placeholder="0"
                                                   min="0"
                                                   required>
                                            @error('stock')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="form-section">
                                <div class="section-header">
                                    <h6><i class="fas fa-cog me-2"></i>معلومات إضافية</h6>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-ruler me-1"></i>
                                                المقاسات المتاحة
                                            </label>
                                            <div class="size-options">
                                                @php
                                                    $availableSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
                                                    $selectedSizes = $product->size ? explode(',', $product->size) : [];
                                                @endphp
                                                @foreach($availableSizes as $size)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input size-checkbox"
                                                               type="checkbox"
                                                               id="size_{{ $size }}"
                                                               name="sizes[]"
                                                               value="{{ $size }}"
                                                               {{ in_array($size, $selectedSizes) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="size_{{ $size }}">
                                                            {{ $size }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <input type="hidden" id="size" name="size" value="{{ old('size', $product->size) }}">
                                            @error('size')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-star me-1"></i>
                                                حالة المنتج
                                            </label>
                                            <div class="product-status-options">
                                                <div class="form-check">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           id="is_featured"
                                                           name="is_featured"
                                                           value="1"
                                                           {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_featured">
                                                        <i class="fas fa-star text-warning me-1"></i>
                                                        منتج مميز
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           id="is_recommended"
                                                           name="is_recommended"
                                                           value="1"
                                                           {{ old('is_recommended', $product->is_recommended ?? false) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_recommended">
                                                        <i class="fas fa-thumbs-up text-success me-1"></i>
                                                        منتج موصى به
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="form-label">
                                        <i class="fas fa-align-right me-1"></i>
                                        وصف المنتج
                                    </label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description"
                                              name="description"
                                              rows="4"
                                              placeholder="اكتب وصفاً مفصلاً للمنتج...">{{ old('description', $product->description) }}</textarea>
                                    <div class="form-text">اكتب وصفاً شاملاً للمنتج يساعد العملاء على فهمه بشكل أفضل</div>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="admin-card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-actions-left">
                            <a href="{{ route('admin.products.index') }}" class="btn-admin-outline">
                                <i class="fas fa-arrow-right"></i> العودة للمنتجات
                            </a>
                            <button type="button" class="btn-admin-outline" onclick="resetForm()">
                                <i class="fas fa-undo"></i> إعادة تعيين
                            </button>
                        </div>
                        <div class="form-actions-right">
                            <button type="button" class="btn-admin-outline" onclick="previewProduct()">
                                <i class="fas fa-eye"></i> معاينة
                            </button>
                            <button type="submit" class="btn-admin" id="saveButton">
                                <i class="fas fa-save"></i> حفظ التغييرات
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
/* Page Header Styles */
.admin-page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.admin-page-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
}

.admin-page-header p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0.5rem 0 0 0;
}

.btn-back-admin {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 2px solid rgba(255,255,255,0.3);
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-back-admin:hover {
    background: rgba(255,255,255,0.3);
    color: white;
    transform: translateY(-2px);
}

/* Statistics Cards */
.stats-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.stats-icon {
    font-size: 2.5rem;
    color: #667eea;
    margin-bottom: 1rem;
}

.stats-number {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
}

.stats-label {
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Form Sections */
.form-section {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #e9ecef;
}

.section-header {
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid #e9ecef;
}

.section-header h6 {
    color: #495057;
    font-weight: 600;
    margin: 0;
    font-size: 1.1rem;
}

/* Product Image Section */
.product-image-section {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    border: 2px solid #e9ecef;
    text-align: center;
}

.current-image-container {
    margin-bottom: 1.5rem;
}

.current-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 10px;
    border: 3px solid #667eea;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.no-image-placeholder {
    background: #f8f9fa;
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    padding: 3rem;
    color: #6c757d;
}

.image-upload-section {
    margin-bottom: 1rem;
}

.upload-label {
    display: block;
    background: #667eea;
    color: white;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    margin-bottom: 0.5rem;
    text-align: center;
}

.upload-label:hover {
    background: #5a6fd8;
    transform: translateY(-2px);
}

/* File input styling */
#image {
    display: none;
}

/* Custom file input button */
.image-upload-section {
    position: relative;
}

.image-upload-section::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: transparent;
    pointer-events: none;
}

.upload-hint {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 0.5rem;
}

.image-actions {
    text-align: center;
}

/* Form Elements */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.75rem;
    display: block;
}

.form-control, .form-select {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 0.875rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: white;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    outline: none;
}

.form-control.is-invalid, .form-select.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 500;
}

.input-group-text {
    background: #667eea;
    color: white;
    border: 2px solid #667eea;
    font-weight: 600;
}

/* Size Options */
.size-options {
    background: white;
    padding: 1rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.size-options .form-check-inline {
    margin: 0;
    padding: 0.5rem 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.size-options .form-check-inline:hover {
    background: #e9ecef;
    border-color: #667eea;
}

.size-options .form-check-input {
    margin: 0;
    margin-left: 0.5rem;
    transform: scale(1.2);
}

.size-options .form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.size-options .form-check-label {
    margin: 0;
    padding: 0;
    font-weight: 500;
    color: #495057;
    cursor: pointer;
    font-size: 0.9rem;
}

.size-options .form-check-input:checked + .form-check-label {
    color: #667eea;
    font-weight: 600;
}

/* Product Status Options */
.product-status-options {
    background: white;
    padding: 1rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.form-check {
    margin-bottom: 0.75rem;
}

.form-check-input {
    margin-left: 0.75rem;
    transform: scale(1.2);
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.form-check-label {
    font-weight: 500;
    color: #495057;
}

.form-text {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 0.5rem;
    font-style: italic;
}

/* Action Buttons */
.admin-card-footer {
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
    padding: 1.5rem;
    border-radius: 0 0 15px 15px;
}

.form-actions-left, .form-actions-right {
    display: flex;
    gap: 0.75rem;
}

.btn-admin, .btn-admin-outline {
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-admin {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.btn-admin:hover {
    background: #5a6fd8;
    border-color: #5a6fd8;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.btn-admin-outline {
    background: transparent;
    color: #667eea;
    border-color: #667eea;
}

.btn-admin-outline:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .admin-page-header {
        padding: 1.5rem;
    }

    .admin-page-header h1 {
        font-size: 2rem;
    }

    .form-actions-left, .form-actions-right {
        flex-direction: column;
        width: 100%;
    }

    .btn-admin, .btn-admin-outline {
        width: 100%;
        justify-content: center;
    }
}

/* Loading Animation */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid #667eea;
    border-top: 2px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
// Enhanced Image Preview Function
function previewImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Check file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('حجم الصورة كبير جداً. الحد الأقصى 5 ميجابايت');
            input.value = '';
            return;
        }

        // Check file type
        if (!file.type.startsWith('image/')) {
            alert('يرجى اختيار ملف صورة صالح');
            input.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {
            const container = document.querySelector('.current-image-container');
            container.innerHTML = `
                <img src="${e.target.result}"
                     alt="معاينة الصورة الجديدة"
                     class="current-image">
                <div class="mt-2">
                    <small class="text-success">
                        <i class="fas fa-check-circle"></i> تم اختيار صورة جديدة
                    </small>
                </div>
            `;
        };

        reader.readAsDataURL(file);
    }
}

// Remove Image Function
function removeImage() {
    if (confirm('هل أنت متأكد من حذف الصورة؟')) {
        const container = document.querySelector('.current-image-container');
        container.innerHTML = `
            <div class="no-image-placeholder">
                <i class="fas fa-image fa-3x"></i>
                <p class="mt-2">لا توجد صورة</p>
            </div>
        `;
        document.getElementById('image').value = '';
    }
}

// Reset Form Function
function resetForm() {
    if (confirm('هل أنت متأكد من إعادة تعيين النموذج؟ سيتم فقدان جميع التغييرات غير المحفوظة.')) {
        document.getElementById('productEditForm').reset();
        // Reload the page to get original values
        window.location.reload();
    }
}

// Preview Product Function
function previewProduct() {
    const form = document.getElementById('productEditForm');
    const formData = new FormData(form);

    // Get current image source
    const currentImage = document.querySelector('.current-image');
    const imageSrc = currentImage ? currentImage.src : 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmOWZhIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzZjNzU3ZCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0i>لا توجد صورة</text></svg>';

    // Create a preview window
    const previewWindow = window.open('', '_blank', 'width=900,height=700,scrollbars=yes');

    previewWindow.document.write(`
        <!DOCTYPE html>
        <html dir="rtl" lang="ar">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>معاينة المنتج</title>
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    padding: 20px;
                    direction: rtl;
                    min-height: 100vh;
                }
                .preview-container {
                    max-width: 800px;
                    margin: 0 auto;
                    background: white;
                    border-radius: 20px;
                    overflow: hidden;
                    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
                }
                .preview-header {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    padding: 2rem;
                    text-align: center;
                }
                .preview-header h1 {
                    font-size: 2rem;
                    margin-bottom: 0.5rem;
                }
                .preview-header p {
                    opacity: 0.9;
                }
                .preview-content {
                    padding: 2rem;
                }
                .preview-image {
                    width: 100%;
                    max-width: 400px;
                    border-radius: 15px;
                    margin: 0 auto 2rem auto;
                    display: block;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                }
                .preview-info {
                    text-align: center;
                }
                .preview-info h2 {
                    color: #333;
                    font-size: 1.8rem;
                    margin-bottom: 1rem;
                }
                .preview-info .price {
                    font-size: 2rem;
                    color: #667eea;
                    font-weight: bold;
                    margin-bottom: 1rem;
                }
                .preview-info .details {
                    background: #f8f9fa;
                    padding: 1.5rem;
                    border-radius: 15px;
                    margin: 1rem 0;
                }
                .preview-info .details p {
                    color: #666;
                    line-height: 1.8;
                    margin-bottom: 0.5rem;
                    font-size: 1.1rem;
                }
                .preview-info .description {
                    background: #f8f9fa;
                    padding: 1.5rem;
                    border-radius: 15px;
                    margin-top: 1rem;
                    text-align: right;
                }
                .preview-info .description h3 {
                    color: #333;
                    margin-bottom: 1rem;
                }
                .preview-info .description p {
                    color: #666;
                    line-height: 1.8;
                }
                .status-badges {
                    display: flex;
                    justify-content: center;
                    gap: 1rem;
                    margin: 1rem 0;
                }
                .status-badge {
                    padding: 0.5rem 1rem;
                    border-radius: 20px;
                    font-size: 0.9rem;
                    font-weight: bold;
                }
                .status-badge.featured {
                    background: #ffc107;
                    color: white;
                }
                .status-badge.recommended {
                    background: #28a745;
                    color: white;
                }
            </style>
        </head>
        <body>
            <div class="preview-container">
                <div class="preview-header">
                    <h1>معاينة المنتج</h1>
                    <p>عرض المنتج كما سيظهر للعملاء</p>
                </div>
                <div class="preview-content">
                    <img src="${imageSrc}" alt="معاينة المنتج" class="preview-image">
                    <div class="preview-info">
                        <h2>${formData.get('name') || 'اسم المنتج'}</h2>
                        <div class="price">${formData.get('price') || '0'} درهم</div>

                        <div class="status-badges">
                            ${formData.get('is_featured') ? '<span class="status-badge featured">⭐ منتج مميز</span>' : ''}
                            ${formData.get('is_recommended') ? '<span class="status-badge recommended">👍 منتج موصى به</span>' : ''}
                        </div>

                        <div class="details">
                            <p><strong>الكمية المتاحة:</strong> ${formData.get('stock') || '0'} قطعة</p>
                            <p><strong>المقاس:</strong> ${formData.get('size') || 'غير محدد'}</p>
                        </div>

                        ${formData.get('description') ? `
                        <div class="description">
                            <h3>وصف المنتج</h3>
                            <p>${formData.get('description')}</p>
                        </div>
                        ` : ''}
                    </div>
                </div>
            </div>
        </body>
        </html>
    `);
}

// Auto-save functionality
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('productEditForm');
    const inputs = form.querySelectorAll('input, textarea, select');
    const saveButton = document.getElementById('saveButton');

    // Make upload label clickable
    const uploadLabel = document.querySelector('.upload-label');
    const fileInput = document.getElementById('image');

    if (uploadLabel && fileInput) {
        uploadLabel.addEventListener('click', function(e) {
            e.preventDefault();
            fileInput.click();
        });

        // Also handle direct file input change
        fileInput.addEventListener('change', function(e) {
            previewImage(this);
        });
    }

    // Handle size checkboxes
    const sizeCheckboxes = document.querySelectorAll('.size-checkbox');
    const sizeHiddenInput = document.getElementById('size');

    function updateSizeInput() {
        const selectedSizes = Array.from(sizeCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        sizeHiddenInput.value = selectedSizes.join(',');
    }

    sizeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSizeInput);
    });

    // Initialize size input
    updateSizeInput();

    // Auto-save every 30 seconds
    setInterval(function() {
        const formData = new FormData(form);
        const data = {};
        for (let [key, value] of formData.entries()) {
            data[key] = value;
        }
        localStorage.setItem('product_edit_draft_' + {{ $product->id }}, JSON.stringify(data));

        // Show auto-save indicator
        const indicator = document.createElement('small');
        indicator.className = 'text-muted';
        indicator.innerHTML = '<i class="fas fa-save"></i> تم الحفظ التلقائي';
        indicator.style.position = 'fixed';
        indicator.style.top = '20px';
        indicator.style.right = '20px';
        indicator.style.background = 'white';
        indicator.style.padding = '5px 10px';
        indicator.style.borderRadius = '5px';
        indicator.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        indicator.style.zIndex = '9999';

        document.body.appendChild(indicator);
        setTimeout(() => indicator.remove(), 2000);
    }, 30000);

    // Load draft data
    const draftData = localStorage.getItem('product_edit_draft_' + {{ $product->id }});
    if (draftData) {
        try {
            const data = JSON.parse(draftData);
            Object.keys(data).forEach(key => {
                const input = form.querySelector(`[name="${key}"]`);
                if (input && input.type !== 'file') {
                    input.value = data[key];
                }
            });
        } catch (e) {
            console.log('No valid draft data found');
        }
    }

    // Clear draft on successful submit
    form.addEventListener('submit', function(e) {
        // Debug: Check if image file is selected
        const imageFile = fileInput.files[0];
        if (imageFile) {
            console.log('Image file selected:', imageFile.name, imageFile.size);
        } else {
            console.log('No image file selected');
        }

        localStorage.removeItem('product_edit_draft_' + {{ $product->id }});
        saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';
        saveButton.disabled = true;
    });

    // Form validation
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('يرجى ملء جميع الحقول المطلوبة');
        }
    });

    // Real-time validation
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    });
});
</script>
@endsection
