@extends('layouts.shop')

@section('content')
<style>
    /* Credit Card Payment Page Styling */
    .payment-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .payment-header {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(173, 143, 83, 0.3);
    }

    .payment-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .payment-header p {
        font-size: 1.1rem;
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }

    .payment-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        border: none;
        margin-bottom: 2rem;
    }

    .payment-card-header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 1.5rem 2rem;
        border: none;
    }

    .payment-card-header h4 {
        margin: 0;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .payment-card-body {
        padding: 2rem;
    }

    .credit-card-form {
        max-width: 500px;
        margin: 0 auto;
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

    .card-number-input {
        font-family: 'Courier New', monospace;
        letter-spacing: 2px;
        font-size: 1.1rem;
    }

    .expiry-cvv-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .btn-pay {
        background: linear-gradient(135deg, #d4af37 0%, #b8941f 100%);
        border: none;
        color: white;
        padding: 1.2rem 2.5rem;
        border-radius: 15px;
        font-weight: 700;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        width: 100%;
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-pay::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-pay:hover::before {
        left: 100%;
    }

    .btn-pay:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(212, 175, 55, 0.6);
        color: white;
        background: linear-gradient(135deg, #e6c547 0%, #c9a52a 100%);
    }

    .btn-pay:active {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
    }

    .btn-back {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        border: none;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 1rem;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-back::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: left 0.5s;
    }

    .btn-back:hover::before {
        left: 100%;
    }

    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(108, 117, 125, 0.4);
        color: white;
        text-decoration: none;
        background: linear-gradient(135deg, #7a8289 0%, #5a6268 100%);
    }

    .btn-back:active {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
    }

    .order-summary {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
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

    .security-badges {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 2rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .security-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #28a745;
        font-weight: 600;
    }

    .security-badge i {
        font-size: 1.2rem;
    }

    .card-preview {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .card-preview::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .card-preview h6 {
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .card-number-preview {
        font-family: 'Courier New', monospace;
        font-size: 1.2rem;
        letter-spacing: 2px;
        margin-bottom: 1rem;
    }

    .card-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cardholder-name {
        font-weight: 600;
    }

    .expiry-date {
        font-family: 'Courier New', monospace;
    }

    @media (max-width: 768px) {
        .payment-header h1 {
            font-size: 2rem;
        }

        .payment-card-body {
            padding: 1.5rem;
        }

        .expiry-cvv-row {
            grid-template-columns: 1fr;
        }

        .security-badges {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>

<div class="payment-container">
    <div class="container">
        <!-- Payment Header -->
        <div class="payment-header text-center">
            <h1><i class="fas fa-credit-card me-3"></i>الدفع بالبطاقة الائتمانية</h1>
            <p>أدخل معلومات بطاقتك الائتمانية لإتمام الدفع</p>
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
            <!-- Credit Card Form -->
            <div class="col-lg-8">
                <div class="payment-card">
                    <div class="payment-card-header">
                        <h4><i class="fas fa-credit-card me-2"></i>معلومات البطاقة الائتمانية</h4>
                    </div>
                    <div class="payment-card-body">
                        <!-- Card Preview -->
                        <div class="card-preview">
                            <h6>معاينة البطاقة</h6>
                            <div class="card-number-preview" id="cardNumberPreview">**** **** **** ****</div>
                            <div class="card-details">
                                <div class="cardholder-name" id="cardholderPreview">اسم حامل البطاقة</div>
                                <div class="expiry-date" id="expiryPreview">MM/YY</div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('payment.process-credit-card') }}" class="credit-card-form">
                            @csrf

                            <div class="mb-3">
                                <label for="card_number" class="form-label">
                                    رقم البطاقة <span class="required-field">*</span>
                                </label>
                                <input type="text"
                                       class="form-control card-number-input @error('card_number') is-invalid @enderror"
                                       id="card_number"
                                       name="card_number"
                                       value="{{ old('card_number') }}"
                                       placeholder="1234 5678 9012 3456"
                                       maxlength="19"
                                       required>
                                @error('card_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cardholder_name" class="form-label">
                                    اسم حامل البطاقة <span class="required-field">*</span>
                                </label>
                                <input type="text"
                                       class="form-control @error('cardholder_name') is-invalid @enderror"
                                       id="cardholder_name"
                                       name="cardholder_name"
                                       value="{{ old('cardholder_name') }}"
                                       placeholder="أدخل اسم حامل البطاقة كما هو مكتوب على البطاقة"
                                       required>
                                @error('cardholder_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="expiry-cvv-row">
                                <div class="mb-3">
                                    <label for="expiry_month" class="form-label">
                                        شهر الانتهاء <span class="required-field">*</span>
                                    </label>
                                    <select class="form-control @error('expiry_month') is-invalid @enderror"
                                            id="expiry_month"
                                            name="expiry_month"
                                            required>
                                        <option value="">الشهر</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ sprintf('%02d', $i) }}" {{ old('expiry_month') == sprintf('%02d', $i) ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('expiry_month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="expiry_year" class="form-label">
                                        سنة الانتهاء <span class="required-field">*</span>
                                    </label>
                                    <select class="form-control @error('expiry_year') is-invalid @enderror"
                                            id="expiry_year"
                                            name="expiry_year"
                                            required>
                                        <option value="">السنة</option>
                                        @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                            <option value="{{ $i }}" {{ old('expiry_year') == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('expiry_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="cvv" class="form-label">
                                    رمز الأمان (CVV) <span class="required-field">*</span>
                                </label>
                                <input type="text"
                                       class="form-control @error('cvv') is-invalid @enderror"
                                       id="cvv"
                                       name="cvv"
                                       value="{{ old('cvv') }}"
                                       placeholder="123"
                                       maxlength="4"
                                       required>
                                @error('cvv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-3">
                                <a href="{{ route('orders.checkout') }}" class="btn btn-back">
                                    <i class="fas fa-arrow-right me-2"></i>العودة للدفع
                                </a>
                                <button type="submit" class="btn btn-pay">
                                    <i class="fas fa-lock me-2"></i>دفع آمن
                                </button>
                            </div>
                        </form>

                        <!-- Security Badges -->
                        <div class="security-badges">
                            <div class="security-badge">
                                <i class="fas fa-shield-alt"></i>
                                <span>دفع آمن</span>
                            </div>
                            <div class="security-badge">
                                <i class="fas fa-lock"></i>
                                <span>مشفر SSL</span>
                            </div>
                            <div class="security-badge">
                                <i class="fas fa-check-circle"></i>
                                <span>مضمون</span>
                            </div>
                        </div>
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
    // Card preview functionality
    document.addEventListener('DOMContentLoaded', function() {
        const cardNumberInput = document.getElementById('card_number');
        const cardholderInput = document.getElementById('cardholder_name');
        const expiryMonthSelect = document.getElementById('expiry_month');
        const expiryYearSelect = document.getElementById('expiry_year');

        const cardNumberPreview = document.getElementById('cardNumberPreview');
        const cardholderPreview = document.getElementById('cardholderPreview');
        const expiryPreview = document.getElementById('expiryPreview');

        // Format card number input
        cardNumberInput.addEventListener('input', function() {
            let value = this.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            this.value = formattedValue;

            // Update preview
            if (value.length > 0) {
                let masked = value.replace(/\d(?=\d{4})/g, "*");
                let formattedMasked = masked.match(/.{1,4}/g)?.join(' ') || masked;
                cardNumberPreview.textContent = formattedMasked;
            } else {
                cardNumberPreview.textContent = '**** **** **** ****';
            }
        });

        // Update cardholder preview
        cardholderInput.addEventListener('input', function() {
            cardholderPreview.textContent = this.value || 'اسم حامل البطاقة';
        });

        // Update expiry preview
        function updateExpiryPreview() {
            const month = expiryMonthSelect.value;
            const year = expiryYearSelect.value;
            if (month && year) {
                expiryPreview.textContent = month + '/' + year.slice(-2);
            } else {
                expiryPreview.textContent = 'MM/YY';
            }
        }

        expiryMonthSelect.addEventListener('change', updateExpiryPreview);
        expiryYearSelect.addEventListener('change', updateExpiryPreview);

        // Initialize preview on page load
        updateExpiryPreview();
    });
</script>
@endsection
