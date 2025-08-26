@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">إضافة تقييم للمنتج</h3>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Product Information -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="img-fluid rounded">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $product->name }}</h4>
                            <p class="text-muted">{{ $product->description }}</p>
                            <h5 class="text-primary">{{ number_format($product->price, 2) }} درهم</h5>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('reviews.store', $product->id) }}">
                        @csrf

                        <!-- Customer Information -->
                        <h5 class="mb-3">معلومات العميل</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstname" class="form-label">الاسم الأول *</label>
                                <input type="text"
                                       class="form-control @error('firstname') is-invalid @enderror"
                                       id="firstname"
                                       name="firstname"
                                       value="{{ old('firstname') }}"
                                       required>
                                @error('firstname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lastname" class="form-label">الاسم الأخير *</label>
                                <input type="text"
                                       class="form-control @error('lastname') is-invalid @enderror"
                                       id="lastname"
                                       name="lastname"
                                       value="{{ old('lastname') }}"
                                       required>
                                @error('lastname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">رقم الهاتف *</label>
                                <input type="tel"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="06XXXXXXXX"
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">المدينة *</label>
                                <select class="form-select @error('city') is-invalid @enderror"
                                        id="city"
                                        name="city"
                                        required>
                                    <option value="">اختر المدينة</option>
                                    <option value="الدار البيضاء" {{ old('city') == 'الدار البيضاء' ? 'selected' : '' }}>الدار البيضاء</option>
                                    <option value="الرباط" {{ old('city') == 'الرباط' ? 'selected' : '' }}>الرباط</option>
                                    <option value="فاس" {{ old('city') == 'فاس' ? 'selected' : '' }}>فاس</option>
                                    <option value="مراكش" {{ old('city') == 'مراكش' ? 'selected' : '' }}>مراكش</option>
                                    <option value="طنجة" {{ old('city') == 'طنجة' ? 'selected' : '' }}>طنجة</option>
                                    <option value="أكادير" {{ old('city') == 'أكادير' ? 'selected' : '' }}>أكادير</option>
                                    <option value="مكناس" {{ old('city') == 'مكناس' ? 'selected' : '' }}>مكناس</option>
                                    <option value="وجدة" {{ old('city') == 'وجدة' ? 'selected' : '' }}>وجدة</option>
                                    <option value="القنيطرة" {{ old('city') == 'القنيطرة' ? 'selected' : '' }}>القنيطرة</option>
                                    <option value="تطوان" {{ old('city') == 'تطوان' ? 'selected' : '' }}>تطوان</option>
                                    <option value="أخرى" {{ old('city') == 'أخرى' ? 'selected' : '' }}>أخرى</option>
                                </select>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Review Information -->
                        <h5 class="mb-3">التقييم</h5>

                        <div class="mb-3">
                            <label for="rating" class="form-label">التقييم *</label>
                            <div class="rating-input">
                                <div class="d-flex gap-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input type="radio"
                                               name="rating"
                                               value="{{ $i }}"
                                               id="rating{{ $i }}"
                                               class="btn-check"
                                               {{ old('rating') == $i ? 'checked' : '' }}
                                               required>
                                        <label class="btn btn-outline-warning" for="rating{{ $i }}">
                                            <i class="fas fa-star"></i> {{ $i }}
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            @error('rating')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">التعليق *</label>
                            <textarea class="form-control @error('comment') is-invalid @enderror"
                                      id="comment"
                                      name="comment"
                                      rows="4"
                                      placeholder="اكتب تعليقك عن المنتج..."
                                      required>{{ old('comment') }}</textarea>
                            <div class="form-text">يجب أن يكون التعليق 10 أحرف على الأقل</div>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-right"></i> إلغاء
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> إرسال التقييم
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rating-input .btn-check:checked + .btn {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #000;
}
</style>
@endsection
