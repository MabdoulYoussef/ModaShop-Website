@extends('layouts.shop')

@section('content')
<style>
    /* Order Details Page Styling */
    .order-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .order-header {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(173, 143, 83, 0.3);
    }

    .order-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .order-header p {
        font-size: 1.1rem;
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }

    .order-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        border: none;
        margin-bottom: 2rem;
    }

    .order-card-header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 1.5rem 2rem;
        border: none;
    }

    .order-card-header h4 {
        margin: 0;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .order-card-body {
        padding: 2rem;
    }

    .order-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .info-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem;
        border-radius: 15px;
        border: 2px solid #e9ecef;
    }

    .info-section h5 {
        color: #ad8f53;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #ad8f53;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #dee2e6;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #6c757d;
    }

    .info-value {
        font-weight: 600;
        color: #2c3e50;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .status-pending {
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        color: #856404;
        border: 2px solid #ffc107;
    }

    .status-paid {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        border: 2px solid #28a745;
    }

    .status-processing {
        background: linear-gradient(135deg, #cce5ff 0%, #99d6ff 100%);
        color: #004085;
        border: 2px solid #007bff;
    }

    .status-shipped {
        background: linear-gradient(135deg, #e2e3e5 0%, #d6d8db 100%);
        color: #383d41;
        border: 2px solid #6c757d;
    }

    .status-delivered {
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        color: #0c5460;
        border: 2px solid #17a2b8;
    }

    .order-items {
        margin-top: 2rem;
    }

    .order-items h4 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .item-card {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .item-card:hover {
        border-color: #ad8f53;
        box-shadow: 0 5px 15px rgba(173, 143, 83, 0.1);
        transform: translateY(-2px);
    }

    .item-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .item-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .item-details h6 {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .item-details p {
        color: #6c757d;
        margin: 0;
        font-size: 0.9rem;
    }

    .item-price {
        text-align: left;
        margin-top: 1rem;
    }

    .item-price .price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ad8f53;
    }

    .item-price .quantity {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .order-summary {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 2rem;
        border-radius: 15px;
        border: 2px solid #ad8f53;
        margin-top: 2rem;
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

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .order-header h1 {
            font-size: 2rem;
        }

        .order-card-body {
            padding: 1.5rem;
        }

        .order-info-grid {
            grid-template-columns: 1fr;
        }

        .item-info {
            flex-direction: column;
            text-align: center;
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

<div class="order-container">
    <div class="container">
        <!-- Order Header -->
        <div class="order-header text-center">
            <h1><i class="fas fa-receipt me-3"></i>تفاصيل الطلب</h1>
            <p>معلومات مفصلة عن طلبك</p>
        </div>

        <!-- Order Information -->
        <div class="order-card">
            <div class="order-card-header">
                <h4><i class="fas fa-info-circle me-2"></i>معلومات الطلب</h4>
            </div>
            <div class="order-card-body">
                <div class="order-info-grid">
                    <!-- Customer Information -->
                    <div class="info-section">
                        <h5><i class="fas fa-user"></i>معلومات العميل</h5>
                        <div class="info-row">
                            <span class="info-label">رقم الطلب:</span>
                            <span class="info-value">#{{ $order->id }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">الاسم:</span>
                            <span class="info-value">{{ $order->customer->firstname }} {{ $order->customer->lastname }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">رقم الهاتف:</span>
                            <span class="info-value">{{ $order->customer->phone }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">المدينة:</span>
                            <span class="info-value">{{ $order->customer->city }}</span>
                        </div>
                    </div>

                    <!-- Order Status -->
                    <div class="info-section">
                        <h5><i class="fas fa-clipboard-check"></i>حالة الطلب</h5>
                        <div class="info-row">
                            <span class="info-label">حالة الطلب:</span>
                            <span class="info-value">
                                @if($order->status == 'pending')
                                    <span class="status-badge status-pending">في الانتظار</span>
                                @elseif($order->status == 'processing')
                                    <span class="status-badge status-processing">قيد المعالجة</span>
                                @elseif($order->status == 'shipped')
                                    <span class="status-badge status-shipped">تم الشحن</span>
                                @elseif($order->status == 'delivered')
                                    <span class="status-badge status-delivered">تم التسليم</span>
                                @else
                                    <span class="status-badge status-pending">{{ $order->status }}</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">طريقة الدفع:</span>
                            <span class="info-value">{{ $order->payment_method }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">حالة الدفع:</span>
                            <span class="info-value">
                                @if($order->payment_status == 'paid')
                                    <span class="status-badge status-paid">مدفوع</span>
                                @else
                                    <span class="status-badge status-pending">في الانتظار</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">تاريخ الطلب:</span>
                            <span class="info-value">{{ $order->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="info-section">
                    <h5><i class="fas fa-truck"></i>معلومات التوصيل</h5>
                    <div class="info-row">
                        <span class="info-label">عنوان التوصيل:</span>
                        <span class="info-value">{{ $order->shipping_address }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">مدينة التوصيل:</span>
                        <span class="info-value">{{ $order->shipping_city }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">وقت التوصيل المتوقع:</span>
                        <span class="info-value">2-3 أيام عمل</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="order-card">
            <div class="order-card-header">
                <h4><i class="fas fa-shopping-bag me-2"></i>المنتجات المطلوبة</h4>
            </div>
            <div class="order-card-body">
                @if($order->orderItems->count() > 0)
                    <div class="order-items">
                        @foreach($order->orderItems as $item)
                            <div class="item-card">
                                <div class="item-info">
                                    @if($item->product->image)
                                        <img src="{{ asset('assets/img/products/' . $item->product->image) }}"
                                             alt="{{ $item->product->name }}"
                                             class="item-image">
                                    @endif
                                    <div class="item-details">
                                        <h6>{{ $item->product->name }}</h6>
                                        @if($item->product->description)
                                            <p>{{ Str::limit($item->product->description, 100) }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="item-price">
                                    <div class="price">{{ number_format($item->price, 0) }} درهم</div>
                                    <div class="quantity">الكمية: {{ $item->quantity }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-shopping-bag"></i>
                        <h5>لا توجد منتجات في هذا الطلب</h5>
                    </div>
                @endif

                <!-- Order Summary -->
                <div class="order-summary">
                    <h4><i class="fas fa-calculator me-2"></i>ملخص الطلب</h4>

                    <div class="summary-row">
                        <span>عدد المنتجات:</span>
                        <span>{{ $order->orderItems->count() }}</span>
                    </div>

                    <div class="summary-row">
                        <span>المجموع الفرعي:</span>
                        <span>{{ number_format($order->orderItems->sum(function($item) { return $item->price * $item->quantity; }), 0) }} درهم</span>
                    </div>

                    <div class="summary-row">
                        <span>الشحن:</span>
                        <span style="color: #28a745; font-weight: 600;">مجاني</span>
                    </div>

                    <div class="summary-row">
                        <span>المجموع الكلي:</span>
                        <span>{{ number_format($order->total_price, 0) }} درهم</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('products.index') }}" class="btn-primary-action">
                <i class="fas fa-shopping-bag"></i>
                تسوق المزيد
            </a>
        </div>
    </div>
</div>
@endsection
