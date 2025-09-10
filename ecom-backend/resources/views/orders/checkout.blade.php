@extends('layouts.shop')

@section('content')
<style>
    /* Checkout Page Styling */
    .checkout-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .checkout-header {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(173, 143, 83, 0.3);
    }

    .checkout-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .checkout-header p {
        font-size: 1.1rem;
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }

    .checkout-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        border: none;
        margin-bottom: 2rem;
    }

    .checkout-card-header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 1.5rem 2rem;
        border: none;
    }

    .checkout-card-header h4 {
        margin: 0;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .checkout-card-body {
        padding: 2rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-section h5 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #ad8f53;
        display: inline-block;
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control:focus {
        border-color: #ad8f53;
        box-shadow: 0 0 0 3px rgba(173, 143, 83, 0.1);
        background: white;
    }

    .form-control.is-invalid {
        border-color: #e74c3c;
        background: #fdf2f2;
    }

    .form-control.is-invalid:focus {
        border-color: #e74c3c;
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
    }

    .invalid-feedback {
        color: #e74c3c;
        font-weight: 600;
        margin-top: 0.5rem;
    }

    .form-select {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-select:focus {
        border-color: #ad8f53;
        box-shadow: 0 0 0 3px rgba(173, 143, 83, 0.1);
        background: white;
    }

    .form-select.is-invalid {
        border-color: #e74c3c;
        background: #fdf2f2;
    }

    .form-select.is-invalid:focus {
        border-color: #e74c3c;
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
    }

    .btn-checkout {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(173, 143, 83, 0.3);
    }

    .btn-checkout:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(173, 143, 83, 0.4);
        color: white;
    }

    .btn-back {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
        color: white;
        text-decoration: none;
    }

    .order-summary {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        position: sticky;
        top: 2rem;
    }

    .order-summary h5 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-align: center;
        padding-bottom: 1rem;
        border-bottom: 2px solid #ad8f53;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #dee2e6;
    }

    .summary-row:last-child {
        border-bottom: none;
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 10px;
        margin-top: 1rem;
    }

    .summary-row:last-child span {
        color: white;
    }

    .alert {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
    }

    .alert-danger ul {
        margin: 0.5rem 0 0 0;
        padding-right: 1.5rem;
    }

    .section-divider {
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, #ad8f53 50%, transparent 100%);
        margin: 2rem 0;
        border: none;
    }

    .required-field {
        color: #e74c3c;
        font-weight: bold;
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .payment-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .payment-option {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .payment-option:hover {
        border-color: #ad8f53;
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .payment-option.selected {
        border-color: #ad8f53;
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
    }

    .payment-option i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .payment-option span {
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* City Autocomplete Styling */
    .city-autocomplete-container {
        position: relative;
    }

    .city-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 2px solid #e9ecef;
        border-top: none;
        border-radius: 0 0 10px 10px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        display: none;
    }

    .city-suggestions.show {
        display: block;
    }

    .city-suggestion {
        padding: 0.75rem 1rem;
        cursor: pointer;
        border-bottom: 1px solid #f1f3f4;
        transition: all 0.2s ease;
        font-size: 0.95rem;
        color: #2c3e50;
    }

    .city-suggestion:hover {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
    }

    .city-suggestion:last-child {
        border-bottom: none;
    }

    .city-suggestion.highlighted {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
    }

    .city-suggestion .city-name {
        font-weight: 600;
        display: block;
    }

    .city-suggestion .city-region {
        font-size: 0.8rem;
        opacity: 0.8;
        margin-top: 0.25rem;
    }

    .city-suggestion.highlighted .city-region {
        opacity: 0.9;
    }

    .no-suggestions {
        padding: 1rem;
        text-align: center;
        color: #6c757d;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .checkout-header h1 {
            font-size: 2rem;
        }

        .checkout-card-body {
            padding: 1.5rem;
        }

        .order-summary {
            position: static;
            margin-top: 2rem;
        }

        .payment-options {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="checkout-container">
    <div class="container">
        <!-- Checkout Header -->
        <div class="checkout-header text-center">
            <h1><i class="fas fa-credit-card me-3"></i>إتمام الطلب</h1>
            <p>أكمل طلبك بسهولة وأمان</p>
        </div>

        <!-- Error Messages -->
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>يرجى تصحيح الأخطاء التالية:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <!-- Checkout Form -->
            <div class="col-lg-8">
                <div class="checkout-card">
                    <div class="checkout-card-header">
                        <h4><i class="fas fa-user me-2"></i>معلومات العميل</h4>
                    </div>
                    <div class="checkout-card-body">
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf

                            <!-- Customer Information -->
                            <div class="form-section">
                                <h5><i class="fas fa-user-circle me-2"></i>البيانات الشخصية</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstname" class="form-label">
                                            الاسم الأول <span class="required-field">*</span>
                                        </label>
                                        <input type="text"
                                               class="form-control @error('firstname') is-invalid @enderror"
                                               id="firstname"
                                               name="firstname"
                                               value="{{ old('firstname') }}"
                                               placeholder="أدخل اسمك الأول"
                                               required>
                                        @error('firstname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="lastname" class="form-label">
                                            الاسم الأخير <span class="required-field">*</span>
                                        </label>
                                        <input type="text"
                                               class="form-control @error('lastname') is-invalid @enderror"
                                               id="lastname"
                                               name="lastname"
                                               value="{{ old('lastname') }}"
                                               placeholder="أدخل اسمك الأخير"
                                               required>
                                        @error('lastname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">
                                            رقم الهاتف <span class="required-field">*</span>
                                        </label>
                                        <input type="tel"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               id="phone"
                                               name="phone"
                                               value="{{ old('phone') }}"
                                               placeholder="مثال: 0612345678"
                                               required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">
                                            المدينة <span class="required-field">*</span>
                                        </label>
                                        <div class="city-autocomplete-container">
                                            <input type="text"
                                                   class="form-control @error('city') is-invalid @enderror"
                                                   id="city"
                                                   name="city"
                                                   value="{{ old('city') }}"
                                                   placeholder="اكتب اسم المدينة..."
                                                   autocomplete="off"
                                                   required>
                                            <div class="city-suggestions" id="citySuggestions"></div>
                                        </div>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="section-divider">

                            <!-- Shipping Information -->
                            <div class="form-section">
                                <h5><i class="fas fa-truck me-2"></i>عنوان الشحن</h5>
                                <div class="mb-3">
                                    <label for="shipping_address" class="form-label">
                                        عنوان الشحن <span class="required-field">*</span>
                                    </label>
                                    <textarea class="form-control form-textarea @error('shipping_address') is-invalid @enderror"
                                              id="shipping_address"
                                              name="shipping_address"
                                              placeholder="أدخل العنوان الكامل للشحن (الشارع، الحي، الرمز البريدي)"
                                              required>{{ old('shipping_address') }}</textarea>
                                    @error('shipping_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>ملاحظة:</strong> سيتم الشحن إلى المدينة المحددة أعلاه: <span id="shipping-city-display" class="fw-bold text-primary">اختر المدينة أولاً</span>
                                </div>
                            </div>

                            <hr class="section-divider">

                            <!-- Payment Information -->
                            <div class="form-section">
                                <h5><i class="fas fa-credit-card me-2"></i>طريقة الدفع</h5>
                                <div class="mb-3">
                                    <label class="form-label">
                                        اختر طريقة الدفع <span class="required-field">*</span>
                                    </label>
                                    <div class="payment-options">
                                        <div class="payment-option" data-value="الدفع عند الاستلام">
                                            <i class="fas fa-hand-holding-usd"></i>
                                            <span>الدفع عند الاستلام</span>
                                        </div>
                                        <div class="payment-option" data-value="بطاقة ائتمان">
                                            <i class="fas fa-credit-card"></i>
                                            <span>بطاقة ائتمان</span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="payment_method" id="payment_method" value="{{ old('payment_method') }}" required>
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 justify-content-end mt-4">
                                <a href="{{ route('cart.index') }}" class="btn btn-back">
                                    <i class="fas fa-arrow-right me-2"></i>العودة للسلة
                                </a>
                                <button type="submit" class="btn btn-checkout">
                                    <i class="fas fa-check me-2"></i>تأكيد الطلب
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="order-summary">
                    <h5><i class="fas fa-receipt me-2"></i>ملخص الطلب</h5>

                    <div class="summary-row">
                        <span>المجموع:</span>
                        <span>{{ number_format($total, 0) }} درهم</span>
                    </div>

                    <div class="summary-row">
                        <span>الشحن:</span>
                        <span style="color: #28a745; font-weight: 600;">مجاني</span>
                    </div>

                    <div class="summary-row">
                        <span>الإجمالي:</span>
                        <span>{{ number_format($total, 0) }} درهم</span>
                    </div>

                    <div class="mt-4 text-center">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1"></i>
                            طلبك محمي ومضمون
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Payment method selection and shipping city display
    document.addEventListener('DOMContentLoaded', function() {
        const paymentOptions = document.querySelectorAll('.payment-option');
        const paymentInput = document.getElementById('payment_method');
        const citySelect = document.getElementById('city');
        const shippingCityDisplay = document.getElementById('shipping-city-display');

        // Handle payment option clicks
        paymentOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from all options
                paymentOptions.forEach(opt => opt.classList.remove('selected'));

                // Add selected class to clicked option
                this.classList.add('selected');

                // Update hidden input value
                paymentInput.value = this.dataset.value;
            });
        });

        // Update shipping city display when customer city changes
        citySelect.addEventListener('change', function() {
            if (this.value) {
                shippingCityDisplay.textContent = this.value;
                shippingCityDisplay.classList.remove('text-muted');
                shippingCityDisplay.classList.add('text-primary');
            } else {
                shippingCityDisplay.textContent = 'اختر المدينة أولاً';
                shippingCityDisplay.classList.remove('text-primary');
                shippingCityDisplay.classList.add('text-muted');
            }
        });

        // Set initial selection if there's an old value
        const oldValue = paymentInput.value;
        if (oldValue) {
            const selectedOption = document.querySelector(`[data-value="${oldValue}"]`);
            if (selectedOption) {
                selectedOption.classList.add('selected');
            }
        }

        // Set initial shipping city display
        if (citySelect.value) {
            shippingCityDisplay.textContent = citySelect.value;
            shippingCityDisplay.classList.remove('text-muted');
            shippingCityDisplay.classList.add('text-primary');
        }
    });
</script>
@endsection
