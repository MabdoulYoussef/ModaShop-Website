@extends('layouts.shop')

@section('content')
<style>
    /* Order Success Page Styling */
    .success-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 2rem 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .success-card {
        background: white;
        border-radius: 25px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        padding: 3rem;
        text-align: center;
        max-width: 600px;
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    .success-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
    }

    .success-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        animation: successPulse 2s ease-in-out infinite;
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
    }

    @keyframes successPulse {
        0% { transform: scale(1); box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3); }
        50% { transform: scale(1.05); box-shadow: 0 15px 40px rgba(40, 167, 69, 0.4); }
        100% { transform: scale(1); box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3); }
    }

    .success-icon i {
        font-size: 3rem;
        color: white;
        animation: checkmark 0.8s ease-in-out;
    }

    @keyframes checkmark {
        0% { transform: scale(0) rotate(45deg); }
        50% { transform: scale(1.2) rotate(45deg); }
        100% { transform: scale(1) rotate(45deg); }
    }

    .success-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .success-subtitle {
        font-size: 1.3rem;
        color: #6c757d;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .order-details {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 2rem;
        margin: 2rem 0;
        border: 2px solid #e9ecef;
    }

    .order-details h4 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #dee2e6;
    }

    .detail-row:last-child {
        border-bottom: none;
        font-weight: 700;
        font-size: 1.2rem;
        color: #2c3e50;
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
        padding: 1rem;
        border-radius: 10px;
        margin-top: 1rem;
    }

    .detail-row:last-child span {
        color: white;
    }

    .detail-label {
        font-weight: 600;
        color: #6c757d;
    }

    .detail-value {
        font-weight: 600;
        color: #2c3e50;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .btn-primary-action {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 6px 20px rgba(173, 143, 83, 0.3);
    }

    .btn-primary-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(173, 143, 83, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-secondary-action {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-secondary-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
        color: white;
        text-decoration: none;
    }

    .success-message {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: 2px solid #c3e6cb;
        border-radius: 15px;
        padding: 1.5rem;
        margin: 2rem 0;
        color: #155724;
        font-weight: 600;
    }

    .success-message i {
        color: #28a745;
        margin-left: 0.5rem;
    }

    .order-tracking {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px solid #ad8f53;
        border-radius: 15px;
        padding: 1.5rem;
        margin: 2rem 0;
        color: #2c3e50;
    }

    .order-tracking h5 {
        color: #ad8f53;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tracking-info {
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .celebration-animation {
        position: absolute;
        top: -50px;
        left: -50px;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        border-radius: 50%;
        opacity: 0.1;
        animation: celebration 3s ease-in-out infinite;
    }

    .celebration-animation:nth-child(2) {
        top: -30px;
        right: -30px;
        animation-delay: 0.5s;
    }

    .celebration-animation:nth-child(3) {
        bottom: -40px;
        left: 20px;
        animation-delay: 1s;
    }

    @keyframes celebration {
        0%, 100% { transform: scale(0) rotate(0deg); opacity: 0.1; }
        50% { transform: scale(1) rotate(180deg); opacity: 0.3; }
    }

    @media (max-width: 768px) {
        .success-card {
            padding: 2rem 1.5rem;
            margin: 1rem;
        }

        .success-title {
            font-size: 2rem;
        }

        .success-subtitle {
            font-size: 1.1rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-primary-action,
        .btn-secondary-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="success-container">
    <div class="success-card">
        <!-- Celebration Animations -->
        <div class="celebration-animation"></div>
        <div class="celebration-animation"></div>
        <div class="celebration-animation"></div>

        <!-- Success Icon -->
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>

        <!-- Success Message -->
        <h1 class="success-title">تم الطلب بنجاح!</h1>
        <p class="success-subtitle">
            شكراً لك على ثقتك بنا! تم استلام طلبك وسيتم معالجته في أقرب وقت ممكن.
        </p>

        <!-- Success Message Box -->
        <div class="success-message">
            <i class="fas fa-check-circle"></i>
            <strong>تم تأكيد طلبك!</strong> ستحصل على رسالة تأكيد عبر الهاتف قريباً.
        </div>

        <!-- Order Details -->
        <div class="order-details">
            <h4><i class="fas fa-receipt"></i>تفاصيل الطلب</h4>

            <div class="detail-row">
                <span class="detail-label">رقم الطلب:</span>
                <span class="detail-value">#{{ $order->id }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">اسم العميل:</span>
                <span class="detail-value">{{ $order->customer->firstname }} {{ $order->customer->lastname }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">رقم الهاتف:</span>
                <span class="detail-value">{{ $order->customer->phone }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">طريقة الدفع:</span>
                <span class="detail-value">{{ $order->payment_method }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">حالة الدفع:</span>
                <span class="detail-value">
                    @if($order->payment_status == 'paid')
                        <span class="text-success">مدفوع</span>
                    @else
                        <span class="text-warning">في الانتظار</span>
                    @endif
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">المجموع الكلي:</span>
                <span class="detail-value">{{ number_format($order->total_price, 0) }} درهم</span>
            </div>
        </div>

        <!-- Order Tracking Info -->
        <div class="order-tracking">
            <h5><i class="fas fa-truck"></i>معلومات التوصيل</h5>
            <div class="tracking-info">
                <p><strong>عنوان التوصيل:</strong> {{ $order->shipping_address }}</p>
                <p><strong>المدينة:</strong> {{ $order->shipping_city }}</p>
                <p><strong>وقت التوصيل المتوقع:</strong> 2-3 أيام عمل</p>
                <p><strong>للمتابعة:</strong> يمكنك متابعة طلبك برقم الهاتف: {{ $order->customer->phone }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('products.index') }}" class="btn-primary-action">
                <i class="fas fa-shopping-bag"></i>
                تسوق المزيد
            </a>

            <a href="{{ route('orders.show', $order->id) }}" class="btn-secondary-action">
                <i class="fas fa-eye"></i>
                عرض الطلب
            </a>
        </div>

        <!-- Additional Info -->
        <div class="mt-4">
            <small class="text-muted">
                <i class="fas fa-shield-alt me-1"></i>
                طلبك محمي ومضمون - شكراً لاختيارك ModaShop
            </small>
        </div>
    </div>
</div>

<script>
    // Add some interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        // Add confetti effect (simple)
        const successIcon = document.querySelector('.success-icon');

        successIcon.addEventListener('click', function() {
            this.style.transform = 'scale(1.2)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });

        // Add smooth scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
@endsection
