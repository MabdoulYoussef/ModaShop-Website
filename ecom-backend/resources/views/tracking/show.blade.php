@extends('layouts.shop')

@section('title', 'نتائج التتبع')
@section('page-title', 'نتائج التتبع')
@section('page-description', 'تفاصيل طلبك وحالة التوصيل')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Order Summary -->
            <div class="order-summary-card">
                <div class="order-header">
                    <div class="order-info">
                        <h2><i class="fas fa-receipt"></i> تفاصيل الطلب</h2>
                        <div class="order-meta">
                            <span class="order-number">رقم الطلب: #{{ $order->id }}</span>
                            <span class="tracking-code">رقم التتبع: {{ $order->tracking_code }}</span>
                            <span class="order-date">تاريخ الطلب: {{ $order->created_at->format('Y-m-d') }}</span>
                        </div>
                    </div>
                    <div class="order-status">
                        @if($order->status == 'pending')
                            <span class="status-badge status-pending">
                                <i class="fas fa-clock"></i> معلق
                            </span>
                        @elseif($order->status == 'processing')
                            <span class="status-badge status-processing">
                                <i class="fas fa-cog"></i> قيد المعالجة
                            </span>
                        @elseif($order->status == 'shipped')
                            <span class="status-badge status-shipped">
                                <i class="fas fa-truck"></i> تم الشحن
                            </span>
                        @elseif($order->status == 'delivered')
                            <span class="status-badge status-delivered">
                                <i class="fas fa-check-circle"></i> تم التسليم
                            </span>
                        @elseif($order->status == 'cancelled')
                            <span class="status-badge status-cancelled">
                                <i class="fas fa-times-circle"></i> ملغي
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="customer-info">
                    <h4><i class="fas fa-user"></i> معلومات العميل</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">الاسم:</span>
                            <span class="value">{{ $order->customer->firstname }} {{ $order->customer->lastname }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">رقم الهاتف:</span>
                            <span class="value">{{ $order->customer->phone }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">المدينة:</span>
                            <span class="value">{{ $order->customer->city }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">عنوان التوصيل:</span>
                            <span class="value">{{ $order->shipping_address }}</span>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="order-items">
                    <h4><i class="fas fa-box"></i> المنتجات المطلوبة</h4>
                    <div class="items-table">
                        @foreach($order->orderItems as $item)
                        <div class="item-row">
                            <div class="item-image">
                                @if($item->product->image)
                                    <!-- Debug: Image path: {{ asset('assets/img/products/' . $item->product->image) }} -->
                                    <img src="{{ asset('assets/img/products/' . $item->product->image) }}"
                                         alt="{{ $item->product->name }}"
                                         class="product-thumb"
                                         onerror="console.log('Image failed to load: {{ asset('assets/img/products/' . $item->product->image) }}'); this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="product-placeholder" style="display: none;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @else
                                    <div class="product-placeholder">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="item-details">
                                <h5>{{ $item->product->name }}</h5>
                                <p class="item-category">{{ $item->product->category->name ?? 'بدون فئة' }}</p>
                            </div>
                            <div class="item-quantity">
                                <span class="quantity">{{ $item->quantity }}</span>
                            </div>
                            <div class="item-price">
                                <span class="price">{{ number_format($item->price, 0) }} درهم</span>
                            </div>
                            <div class="item-total">
                                <span class="total">{{ number_format($item->quantity * $item->price, 0) }} درهم</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="order-total">
                    <div class="total-row">
                        <span class="label">إجمالي الطلب:</span>
                        <span class="value">{{ number_format($order->total_price, 0) }} درهم</span>
                    </div>
                    <div class="payment-method">
                        <span class="label">طريقة الدفع:</span>
                        <span class="value">{{ $order->payment_method }}</span>
                    </div>
                </div>
            </div>

            <!-- Tracking Progress -->
            <div class="tracking-progress-card">
                <h3><i class="fas fa-route"></i> مراحل التوصيل</h3>
                <div class="progress-steps">
                    <div class="step {{ $order->status == 'pending' || $order->status == 'processing' || $order->status == 'shipped' || $order->status == 'delivered' ? 'completed' : '' }}">
                        <div class="step-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="step-content">
                            <h5>تم الطلب</h5>
                            <p>تم استلام طلبك بنجاح</p>
                        </div>
                    </div>

                    <div class="step {{ $order->status == 'processing' || $order->status == 'shipped' || $order->status == 'delivered' ? 'completed' : '' }}">
                        <div class="step-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="step-content">
                            <h5>قيد المعالجة</h5>
                            <p>جاري تحضير طلبك</p>
                        </div>
                    </div>

                    <div class="step {{ $order->status == 'shipped' || $order->status == 'delivered' ? 'completed' : '' }}">
                        <div class="step-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="step-content">
                            <h5>تم الشحن</h5>
                            <p>تم إرسال طلبك للتوصيل</p>
                        </div>
                    </div>

                    <div class="step {{ $order->status == 'delivered' ? 'completed' : '' }}">
                        <div class="step-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="step-content">
                            <h5>تم التسليم</h5>
                            <p>تم تسليم طلبك بنجاح</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="tracking-actions">
                <a href="{{ route('tracking.index') }}" class="btn btn-secondary">
                    <i class="fas fa-search"></i> تتبع طلب آخر
                </a>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="fas fa-home"></i> العودة للرئيسية
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.order-summary-card, .tracking-progress-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    border: 1px solid #eee;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f8f9fa;
}

.order-info h2 {
    color: #333;
    font-weight: 700;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.order-meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.order-meta span {
    color: #666;
    font-size: 0.95rem;
}

.tracking-code {
    font-weight: 600;
    color: #ceb57f !important;
    font-size: 1.1rem !important;
}

.status-badge {
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.95rem;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-processing { background: #d1ecf1; color: #0c5460; }
.status-shipped { background: #cce5ff; color: #004085; }
.status-delivered { background: #d4edda; color: #155724; }
.status-cancelled { background: #f8d7da; color: #721c24; }

.customer-info, .order-items {
    margin-bottom: 25px;
}

.customer-info h4, .order-items h4 {
    color: #333;
    font-weight: 600;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f8f9fa;
}

.info-item .label {
    font-weight: 600;
    color: #666;
}

.info-item .value {
    color: #333;
}

.items-table {
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
}

.item-row {
    display: grid;
    grid-template-columns: 80px 1fr 80px 120px 120px;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid #f8f9fa;
    gap: 15px;
}

.item-row:last-child {
    border-bottom: none;
}

.item-image {
    width: 60px;
    height: 60px;
}

.product-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.product-placeholder {
    width: 100%;
    height: 100%;
    background: #f8f9fa;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
}

.item-details h5 {
    margin: 0 0 5px 0;
    font-weight: 600;
    color: #333;
}

.item-category {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.item-quantity, .item-price, .item-total {
    text-align: center;
    font-weight: 600;
}

.quantity {
    background: #ceb57f;
    color: white;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.9rem;
}

.price, .total {
    color: #333;
}

.order-total {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin-top: 20px;
}

.total-row, .payment-method {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.total-row:last-child, .payment-method:last-child {
    margin-bottom: 0;
}

.total-row .label, .payment-method .label {
    font-weight: 600;
    color: #666;
}

.total-row .value {
    font-weight: 700;
    color: #ceb57f;
    font-size: 1.2rem;
}

.tracking-progress-card h3 {
    color: #333;
    font-weight: 700;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.progress-steps {
    position: relative;
}

.step {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    position: relative;
}

.step:last-child {
    margin-bottom: 0;
}

.step::after {
    content: '';
    position: absolute;
    right: 20px;
    top: 50px;
    width: 2px;
    height: 30px;
    background: #e9ecef;
}

.step:last-child::after {
    display: none;
}

.step.completed::after {
    background: #ceb57f;
}

.step-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 20px;
    flex-shrink: 0;
}

.step.completed .step-icon {
    background: #ceb57f;
    color: white;
}

.step-content h5 {
    margin: 0 0 5px 0;
    font-weight: 600;
    color: #333;
}

.step.completed .step-content h5 {
    color: #ceb57f;
}

.step-content p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.tracking-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 30px;
}

.btn {
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(206, 181, 127, 0.3);
    color: white;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    color: white;
}

@media (max-width: 768px) {
    .order-header {
        flex-direction: column;
        gap: 15px;
    }

    .item-row {
        grid-template-columns: 60px 1fr;
        gap: 10px;
    }

    .item-quantity, .item-price, .item-total {
        grid-column: 2;
        text-align: right;
        margin-top: 5px;
    }

    .tracking-actions {
        flex-direction: column;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
