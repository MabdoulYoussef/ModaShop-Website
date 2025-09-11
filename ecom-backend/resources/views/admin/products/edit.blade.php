@extends('layouts.admin')

@section('title', 'تعديل المنتج')
@section('page-title', 'تعديل المنتج')
@section('page-description', 'تعديل بيانات المنتج: ' . $product->name)

@section('content')

<!-- Product Edit Form -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header">
                <h5><i class="fas fa-edit"></i> تعديل المنتج: {{ $product->name }}</h5>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Product Image Preview -->
                    <div class="col-md-4 mb-4">
                        <div class="product-image-section">
                            <label class="form-label">صورة المنتج الحالية</label>
                            <div class="current-image">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="img-fluid rounded"
                                         style="max-height: 200px; width: 100%; object-fit: cover;">
                                @else
                                    <div class="no-image-placeholder">
                                        <i class="fas fa-image fa-3x"></i>
                                        <p class="mt-2">لا توجد صورة</p>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-3">
                                <label for="image" class="form-label">تغيير الصورة</label>
                                <input type="file"
                                       class="form-control"
                                       id="image"
                                       name="image"
                                       accept="image/*"
                                       onchange="previewImage(this)">
                                <small class="form-text text-muted">اختر صورة جديدة (JPG, PNG, GIF) - اختياري</small>
                            </div>
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
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $product->name) }}"
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
                                       step="0.01"
                                       class="form-control @error('price') is-invalid @enderror"
                                       id="price"
                                       name="price"
                                       value="{{ old('price', $product->price) }}"
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

                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label">
                                    الكمية المتاحة <span class="text-danger">*</span>
                                </label>
                                <input type="number"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       id="stock"
                                       name="stock"
                                       value="{{ old('stock', $product->stock) }}"
                                       required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="size" class="form-label">المقاس</label>
                                <input type="text"
                                       class="form-control @error('size') is-invalid @enderror"
                                       id="size"
                                       name="size"
                                       value="{{ old('size', $product->size) }}"
                                       placeholder="مثال: S, M, L, XL">
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">حالة المنتج</label>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           id="is_featured"
                                           name="is_featured"
                                           value="1"
                                           {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
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
                                        منتج موصى به
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">وصف المنتج</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="4"
                                      placeholder="اكتب وصفاً مفصلاً للمنتج...">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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
                                    <i class="fas fa-save"></i> حفظ التغييرات
                                </button>
                                <a href="{{ route('products.show', $product->id) }}"
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

<!-- Product Statistics -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="stats-number">{{ $product->created_at->format('Y-m-d') }}</div>
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
                <i class="fas fa-star"></i>
            </div>
            <div class="stats-number">{{ $product->reviews->count() }}</div>
            <div class="stats-label">عدد التقييمات</div>
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
</div>

@endsection

@section('scripts')
<style>
    .product-image-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border: 2px dashed #dee2e6;
    }

    .current-image img {
        border: 3px solid #ceb57f;
        border-radius: 10px;
    }

    .no-image-placeholder {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 40px;
        text-align: center;
        color: #6c757d;
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
</style>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            const currentImage = document.querySelector('.current-image');
            currentImage.innerHTML = `
                <img src="${e.target.result}"
                     alt="معاينة الصورة الجديدة"
                     class="img-fluid rounded"
                     style="max-height: 200px; width: 100%; object-fit: cover;">
                <div class="mt-2">
                    <small class="text-success">
                        <i class="fas fa-check-circle"></i> تم اختيار صورة جديدة
                    </small>
                </div>
            `;
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// Auto-save draft functionality
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input, textarea, select');

    // Save form data to localStorage on input change
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const formData = new FormData(form);
            const data = {};
            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }
            localStorage.setItem('product_edit_draft', JSON.stringify(data));
        });
    });

    // Load draft data if exists
    const draftData = localStorage.getItem('product_edit_draft');
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
    form.addEventListener('submit', function() {
        localStorage.removeItem('product_edit_draft');
    });
});
</script>
@endsection
