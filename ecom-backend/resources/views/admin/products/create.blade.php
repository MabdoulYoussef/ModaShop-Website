@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="arabic-text mb-4">إضافة منتج جديد</h1>

            @if(session('success'))
                <div class="alert alert-success arabic-text">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger arabic-text">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name" class="arabic-text">اسم المنتج</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="price" class="arabic-text">السعر (درهم مغربي)</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="category_id" class="arabic-text">الفئة</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">اختر الفئة</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="stock" class="arabic-text">الكمية المتاحة</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="size" class="arabic-text">المقاس</label>
                            <input type="text" class="form-control" id="size" name="size" value="{{ old('size') }}" placeholder="مثال: S, M, L, XL">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="image" class="arabic-text">صورة المنتج</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                            <small class="form-text text-muted arabic-text">اختر صورة واضحة للمنتج (JPG, PNG, GIF)</small>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="description" class="arabic-text">وصف المنتج</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="اكتب وصفاً مفصلاً للمنتج...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary arabic-text">
                        <i class="fas fa-save"></i> حفظ المنتج
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary arabic-text">
                        <i class="fas fa-arrow-left"></i> العودة
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-group label {
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
}

.form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px 15px;
    font-size: 14px;
}

.form-control:focus {
    border-color: #f28123;
    box-shadow: 0 0 0 0.2rem rgba(242, 129, 35, 0.25);
}

.btn {
    padding: 10px 20px;
    margin-left: 10px;
}

.alert {
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
}
</style>
@endsection
