@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4">إتمام الطلب</h2>

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

            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">معلومات العميل</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('orders.store') }}">
                                @csrf

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

                                <h5 class="mb-3">عنوان الشحن</h5>

                                <div class="mb-3">
                                    <label for="shipping_address" class="form-label">عنوان الشحن *</label>
                                    <textarea class="form-control @error('shipping_address') is-invalid @enderror"
                                              id="shipping_address"
                                              name="shipping_address"
                                              rows="3"
                                              placeholder="أدخل العنوان الكامل للشحن"
                                              required>{{ old('shipping_address') }}</textarea>
                                    @error('shipping_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="shipping_city" class="form-label">مدينة الشحن *</label>
                                        <select class="form-select @error('shipping_city') is-invalid @enderror"
                                                id="shipping_city"
                                                name="shipping_city"
                                                required>
                                            <option value="">اختر مدينة الشحن</option>
                                            <option value="الدار البيضاء" {{ old('shipping_city') == 'الدار البيضاء' ? 'selected' : '' }}>الدار البيضاء</option>
                                            <option value="الرباط" {{ old('shipping_city') == 'الرباط' ? 'selected' : '' }}>الرباط</option>
                                            <option value="فاس" {{ old('shipping_city') == 'فاس' ? 'selected' : '' }}>فاس</option>
                                            <option value="مراكش" {{ old('shipping_city') == 'مراكش' ? 'selected' : '' }}>مراكش</option>
                                            <option value="طنجة" {{ old('shipping_city') == 'طنجة' ? 'selected' : '' }}>طنجة</option>
                                            <option value="أكادير" {{ old('shipping_city') == 'أكادير' ? 'selected' : '' }}>أكادير</option>
                                            <option value="مكناس" {{ old('shipping_city') == 'مكناس' ? 'selected' : '' }}>مكناس</option>
                                            <option value="وجدة" {{ old('shipping_city') == 'وجدة' ? 'selected' : '' }}>وجدة</option>
                                            <option value="القنيطرة" {{ old('shipping_city') == 'القنيطرة' ? 'selected' : '' }}>القنيطرة</option>
                                            <option value="تطوان" {{ old('shipping_city') == 'تطوان' ? 'selected' : '' }}>تطوان</option>
                                            <option value="أخرى" {{ old('shipping_city') == 'أخرى' ? 'selected' : '' }}>أخرى</option>
                                        </select>
                                        @error('shipping_city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="payment_method" class="form-label">طريقة الدفع *</label>
                                        <select class="form-select @error('payment_method') is-invalid @enderror"
                                                id="payment_method"
                                                name="payment_method"
                                                required>
                                            <option value="">اختر طريقة الدفع</option>
                                            <option value="الدفع عند الاستلام" {{ old('payment_method') == 'الدفع عند الاستلام' ? 'selected' : '' }}>الدفع عند الاستلام</option>
                                            <option value="تحويل بنكي" {{ old('payment_method') == 'تحويل بنكي' ? 'selected' : '' }}>تحويل بنكي</option>
                                            <option value="بطاقة ائتمان" {{ old('payment_method') == 'بطاقة ائتمان' ? 'selected' : '' }}>بطاقة ائتمان</option>
                                        </select>
                                        @error('payment_method')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ route('cart.index') }}" class="btn btn-secondary me-md-2">
                                        <i class="fas fa-arrow-right"></i> العودة للسلة
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-check"></i> تأكيد الطلب
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">ملخص الطلب</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>المجموع:</span>
                                <strong>{{ number_format($total, 2) }} درهم</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>الشحن:</span>
                                <strong>مجاني</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="fs-5">الإجمالي:</span>
                                <strong class="fs-5 text-success">{{ number_format($total, 2) }} درهم</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
