@extends('layouts.shop')

@section('title', 'تتبع الطلب')
@section('page-title', 'تتبع الطلب')
@section('page-description', 'تتبع حالة طلبك باستخدام رقم التتبع')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="tracking-card">
                <div class="tracking-header">
                    <i class="fas fa-truck"></i>
                    <h2>تتبع طلبك</h2>
                    <p>أدخل رقم التتبع المكون من 8 أرقام للاطلاع على حالة طلبك</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('tracking.track') }}" method="POST" class="tracking-form">
                    @csrf
                    <div class="form-group">
                        <label for="tracking_code" class="form-label">
                            <i class="fas fa-barcode"></i>
                            رقم التتبع
                        </label>
                        <input type="text"
                               name="tracking_code"
                               id="tracking_code"
                               class="form-control @error('tracking_code') is-invalid @enderror"
                               placeholder="مثال: 12345678"
                               maxlength="8"
                               pattern="[0-9]{8}"
                               required>
                        @error('tracking_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i>
                            رقم التتبع مكون من 8 أرقام فقط
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-search"></i>
                        تتبع الطلب
                    </button>
                </form>

                <div class="tracking-help">
                    <h4><i class="fas fa-question-circle"></i> كيف أحصل على رقم التتبع؟</h4>
                    <ul>
                        <li><i class="fas fa-check"></i> يتم إرسال رقم التتبع عند تأكيد الطلب</li>
                        <li><i class="fas fa-check"></i> يمكنك العثور عليه في صفحة تأكيد الطلب</li>
                        <li><i class="fas fa-check"></i> احتفظ برقم التتبع للرجوع إليه لاحقاً</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tracking-card {
    background: white;
    border-radius: 15px;
    padding: 40px;
    margin: 40px 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid #eee;
}

.tracking-header {
    text-align: center;
    margin-bottom: 30px;
}

.tracking-header i {
    font-size: 3rem;
    color: #ceb57f;
    margin-bottom: 15px;
}

.tracking-header h2 {
    color: #333;
    font-weight: 700;
    margin-bottom: 10px;
}

.tracking-header p {
    color: #666;
    font-size: 1.1rem;
}

.tracking-form {
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 15px 20px;
    font-size: 1.1rem;
    text-align: center;
    letter-spacing: 2px;
    font-weight: 600;
}

.form-control:focus {
    border-color: #ceb57f;
    box-shadow: 0 0 0 3px rgba(206, 181, 127, 0.1);
}

.btn-primary {
    background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%);
    border: none;
    border-radius: 10px;
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    width: 100%;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(206, 181, 127, 0.3);
}

.tracking-help {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 25px;
    border-right: 4px solid #ceb57f;
}

.tracking-help h4 {
    color: #333;
    font-weight: 600;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.tracking-help ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.tracking-help li {
    padding: 8px 0;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #666;
}

.tracking-help li i {
    color: #ceb57f;
    width: 16px;
}

.alert {
    border-radius: 10px;
    padding: 15px 20px;
    margin-bottom: 20px;
    border: none;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
}

@media (max-width: 768px) {
    .tracking-card {
        padding: 25px;
        margin: 20px 0;
    }

    .tracking-header i {
        font-size: 2.5rem;
    }

    .tracking-header h2 {
        font-size: 1.5rem;
    }
}
</style>
@endsection
