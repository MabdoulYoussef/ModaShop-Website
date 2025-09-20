@extends('layouts.admin')

@section('title', 'إضافة فئة جديدة')
@section('page-title', 'إضافة فئة جديدة')
@section('page-description', 'إضافة فئة جديدة لتنظيم المنتجات')

@section('content')

<!-- Category Add Form -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header">
                <h5><i class="fas fa-plus"></i> إضافة فئة جديدة</h5>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Category Image Upload -->
                    <div class="col-md-4 mb-4">
                        <div class="category-image-section">
                            <label class="form-label">صورة الفئة</label>
                            <div class="image-upload-area">
                                <input type="file" name="image" id="categoryImage" accept="image/*"
                                       onchange="previewImage(event)">
                                <div id="imagePreview" class="image-preview">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>اضغط لرفع صورة</p>
                                </div>
                            </div>
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
                                       value="{{ old('name') }}"
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
                                       value="{{ old('slug') }}"
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
                                      placeholder="اكتب وصفاً مختصراً للفئة...">{{ old('description') }}</textarea>
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
                                       value="{{ old('sort_order', 0) }}"
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
                                           {{ old('is_active', true) ? 'checked' : '' }}>
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
                                           {{ old('show_in_menu', true) ? 'checked' : '' }}>
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
                                    <i class="fas fa-save"></i> حفظ الفئة
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

<!-- Preview Section -->
<div class="row mt-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header">
                <h5><i class="fas fa-eye"></i> معاينة الفئة</h5>
            </div>
            <div class="category-preview">
                <div class="preview-category-card">
                    <div class="preview-icon">
                        <i id="previewIcon" class="fas fa-tag"></i>
                    </div>
                    <div class="preview-content">
                        <h6 id="previewName">اسم الفئة</h6>
                        <p id="previewDescription">وصف الفئة</p>
                        <small id="previewSlug">category-slug</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<style>
    .category-image-section {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        padding: 25px;
        border-radius: 15px;
        border: 2px solid #e9ecef;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .category-image-section:hover {
        border-color: #ceb57f;
        box-shadow: 0 6px 20px rgba(206, 181, 127, 0.15);
        transform: translateY(-1px);
    }

    .image-upload-area {
        position: relative;
        margin-top: 15px;
    }

    .image-upload-area input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .image-preview {
        width: 100%;
        height: 300px;
        border: 2px dashed #dee2e6;
        border-radius: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        cursor: pointer;
    }

    .image-preview:hover {
        border-color: #ceb57f;
        background: linear-gradient(135deg, #fff5e6 0%, #f0e6d2 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(206, 181, 127, 0.2);
    }

    .image-preview i {
        font-size: 4rem;
        color: #ceb57f;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .image-preview p {
        color: #8b6f3f;
        font-weight: 600;
        margin: 0;
        font-size: 1.1rem;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    .form-label {
        font-weight: 700;
        color: #8b6f3f;
        margin-bottom: 12px;
        font-size: 1.1rem;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label::before {
        content: "📸";
        font-size: 1.2rem;
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

    .category-preview {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .preview-category-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        max-width: 400px;
    }

    .preview-icon {
        background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%);
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .preview-content h6 {
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
    }

    .preview-content p {
        color: #666;
        margin-bottom: 5px;
        font-size: 0.9rem;
    }

    .preview-content small {
        color: #999;
        font-size: 0.8rem;
    }

    .text-danger {
        color: #dc3545 !important;
    }
</style>

<script>
// Image preview functionality
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
            `;
        };
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = `
            <i class="fas fa-cloud-upload-alt"></i>
            <p>اضغط لرفع صورة</p>
        `;
    }
}

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
        updatePreview();
    }
});

// Update preview
function updatePreview() {
    const name = document.getElementById('name').value || 'اسم الفئة';
    const description = document.getElementById('description').value || 'وصف الفئة';
    const slug = document.getElementById('slug').value || 'category-slug';

    document.getElementById('previewName').textContent = name;
    document.getElementById('previewDescription').textContent = description;
    document.getElementById('previewSlug').textContent = slug;
}

// Update preview on input change
document.querySelectorAll('#name, #description, #slug').forEach(input => {
    input.addEventListener('input', updatePreview);
});

function clearForm() {
    if (confirm('هل أنت متأكد من مسح جميع البيانات؟')) {
        document.querySelector('form').reset();
        document.querySelectorAll('.icon-option').forEach(opt => opt.classList.remove('selected'));
        document.querySelector('.icon-option').classList.add('selected');
        document.getElementById('selectedIcon').value = 'fas fa-tag';
        document.getElementById('previewIcon').className = 'fas fa-tag';
        updatePreview();
    }
}

// Auto-save draft functionality
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input, textarea, select');

    // Load saved draft
    const savedDraft = localStorage.getItem('category_create_draft');
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
            updatePreview();
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
            localStorage.setItem('category_create_draft', JSON.stringify(data));
        });
    });

    // Clear draft on successful submit
    form.addEventListener('submit', function() {
        localStorage.removeItem('category_create_draft');
    });
});
</script>
@endsection
