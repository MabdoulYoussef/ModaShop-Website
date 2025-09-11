@extends('layouts.admin')

@section('title', 'تفاصيل الطلب')
@section('page-title', 'تفاصيل الطلب #' . $order->id)
@section('page-description', 'عرض تفاصيل الطلب وإدارة حالته')

@section('content')

<!-- Order Status Alert -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">
    <!-- Order Information -->
    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h5><i class="fas fa-info-circle me-2"></i>معلومات الطلب</h5>
            </div>
            <div class="admin-card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>رقم الطلب:</label>
                            <span class="order-number">#{{ $order->id }}</span>
                        </div>
                        <div class="info-item">
                            <label>تاريخ الطلب:</label>
                            <span>{{ $order->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <label>حالة الطلب:</label>
                            <span class="status-badge status-{{ $order->status }}">
                                @switch($order->status)
                                    @case('pending')
                                        <i class="fas fa-clock"></i> معلق
                                        @break
                                    @case('processing')
                                        <i class="fas fa-cog"></i> قيد المعالجة
                                        @break
                                    @case('shipped')
                                        <i class="fas fa-shipping-fast"></i> تم الشحن
                                        @break
                                    @case('delivered')
                                        <i class="fas fa-check-circle"></i> تم التسليم
                                        @break
                                    @case('cancelled')
                                        <i class="fas fa-times-circle"></i> ملغي
                                        @break
                                    @default
                                        {{ $order->status }}
                                @endswitch
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>طريقة الدفع:</label>
                            <span class="payment-method">
                                @if($order->payment_method == 'الدفع عند الاستلام')
                                    <i class="fas fa-hand-holding-usd"></i> الدفع عند الاستلام
                                @else
                                    <i class="fas fa-credit-card"></i> {{ $order->payment_method }}
                                @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <label>المبلغ الإجمالي:</label>
                            <span class="total-amount">{{ number_format($order->total_price, 2) }} درهم</span>
                        </div>
                        <div class="info-item">
                            <label>آخر تحديث:</label>
                            <span>{{ $order->updated_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <label>وقت الاستجابة:</label>
                            <span class="response-time">
                                @php
                                    $responseTime = $order->updated_at->diffInMinutes($order->created_at);
                                    if ($responseTime < 60) {
                                        echo $responseTime . ' دقيقة';
                                    } else {
                                        echo floor($responseTime / 60) . ' ساعة ' . ($responseTime % 60) . ' دقيقة';
                                    }
                                @endphp
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h5><i class="fas fa-user me-2"></i>معلومات العميل</h5>
            </div>
            <div class="admin-card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>الاسم:</label>
                            <span>{{ $order->customer->firstname }} {{ $order->customer->lastname }}</span>
                        </div>
                        <div class="info-item">
                            <label>رقم الهاتف:</label>
                            <span class="phone-number">{{ $order->customer->phone }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label>المدينة:</label>
                            <span>{{ $order->customer->city }}</span>
                        </div>
                        <div class="info-item">
                            <label>عنوان الشحن:</label>
                            <span class="shipping-address">{{ $order->shipping_address }}</span>
                        </div>
                        @if($order->customer->email)
                        <div class="info-item">
                            <label>البريد الإلكتروني:</label>
                            <span class="email-address">{{ $order->customer->email }}</span>
                        </div>
                        @endif
                        <div class="info-item">
                            <label>عدد الطلبات السابقة:</label>
                            <span class="order-count">{{ $order->customer->orders->count() - 1 }} طلب</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h5><i class="fas fa-shopping-bag me-2"></i>منتجات الطلب</h5>
            </div>
            <div class="admin-card-body">
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>المنتج</th>
                                <th>السعر</th>
                                <th>الكمية</th>
                                <th>المجموع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>
                                    <div class="product-info">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                 alt="{{ $item->product->name }}"
                                                 class="product-image">
                                        @else
                                            <div class="no-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        <div class="product-details">
                                            <h6>{{ $item->product->name }}</h6>
                                            <small class="text-muted">{{ $item->product->category->name ?? 'بدون فئة' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ number_format($item->price, 2) }} درهم</td>
                                <td>
                                    <span class="quantity-badge">{{ $item->quantity }}</span>
                                </td>
                                <td class="item-total">{{ number_format($item->price * $item->quantity, 2) }} درهم</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="3" class="text-end"><strong>المجموع الإجمالي:</strong></td>
                                <td class="total-price">{{ number_format($order->total_price, 2) }} درهم</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Actions -->
    <div class="col-lg-4">
        <!-- Status Update -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h5><i class="fas fa-edit me-2"></i>تحديث حالة الطلب</h5>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="status" class="form-label">الحالة الجديدة</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                <i class="fas fa-clock"></i> معلق
                            </option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                <i class="fas fa-cog"></i> قيد المعالجة
                            </option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                <i class="fas fa-shipping-fast"></i> تم الشحن
                            </option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                <i class="fas fa-check-circle"></i> تم التسليم
                            </option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                <i class="fas fa-times-circle"></i> ملغي
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn-admin w-100">
                        <i class="fas fa-save"></i> تحديث الحالة
                    </button>
                </form>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h5><i class="fas fa-bolt me-2"></i>إجراءات سريعة</h5>
            </div>
            <div class="admin-card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.orders.index') }}" class="btn-admin-outline">
                        <i class="fas fa-list"></i> جميع الطلبات
                    </a>
                    <a href="{{ route('admin.customers.show', $order->customer->id) }}" class="btn-admin-outline">
                        <i class="fas fa-user"></i> عرض العميل
                    </a>
                    <button class="btn-admin-outline" onclick="window.print()">
                        <i class="fas fa-print"></i> طباعة الطلب
                    </button>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-calculator me-2"></i>ملخص الطلب</h5>
            </div>
            <div class="admin-card-body">
                <div class="summary-item">
                    <span>عدد المنتجات:</span>
                    <span>{{ $order->orderItems->count() }}</span>
                </div>
                <div class="summary-item">
                    <span>إجمالي الكمية:</span>
                    <span>{{ $order->orderItems->sum('quantity') }}</span>
                </div>
                <div class="summary-item">
                    <span>المبلغ الإجمالي:</span>
                    <span class="summary-total">{{ number_format($order->total_price, 2) }} درهم</span>
                </div>
                <hr>
                <div class="summary-item">
                    <span>تاريخ الطلب:</span>
                    <span>{{ $order->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="summary-item">
                    <span>وقت الطلب:</span>
                    <span>{{ $order->created_at->format('H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
/* Order Details Styling */
.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item label {
    font-weight: 600;
    color: #666;
    margin: 0;
    min-width: 120px;
}

.info-item span {
    color: #333;
    font-weight: 500;
}

.order-number {
    font-size: 1.2rem;
    font-weight: bold;
    color: #d4af37;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.status-processing {
    background: #cce5ff;
    color: #004085;
    border: 1px solid #74b9ff;
}

.status-shipped {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #81ecec;
}

.status-delivered {
    background: #d4edda;
    color: #155724;
    border: 1px solid #00b894;
}

.status-cancelled {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #e17055;
}

.payment-method {
    color: #d4af37;
    font-weight: 600;
}

.total-amount {
    font-size: 1.3rem;
    font-weight: bold;
    color: #d4af37;
}

.phone-number {
    font-family: 'Courier New', monospace;
    background: #f8f9fa;
    padding: 4px 8px;
    border-radius: 4px;
    color: #495057;
}

.shipping-address {
    background: #f8f9fa;
    padding: 8px 12px;
    border-radius: 6px;
    border-left: 3px solid #d4af37;
    font-style: italic;
}

/* Product Info Styling */
.product-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.product-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #f0f0f0;
}

.no-image {
    width: 50px;
    height: 50px;
    background: #f8f9fa;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
    border: 2px solid #e9ecef;
}

.product-details h6 {
    margin: 0;
    font-weight: 600;
    color: #333;
}

.product-details small {
    color: #666;
}

.quantity-badge {
    background: #d4af37;
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.9rem;
}

.item-total {
    font-weight: 600;
    color: #d4af37;
}

.total-row {
    background: #f8f9fa;
    border-top: 2px solid #d4af37;
}

.total-price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #d4af37;
}

/* Summary Styling */
.summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.summary-item:last-child {
    border-bottom: none;
}

.summary-total {
    font-size: 1.1rem;
    font-weight: bold;
    color: #d4af37;
}

/* Timeline Styling */
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 30px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
    padding-right: 60px;
}

.timeline-icon {
    position: absolute;
    right: 20px;
    top: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    color: #6c757d;
    z-index: 2;
}

.timeline-item.active .timeline-icon {
    background: #d4af37;
    color: white;
    animation: pulse 2s infinite;
}

.timeline-item.completed .timeline-icon {
    background: #28a745;
    color: white;
}

.timeline-item.cancelled .timeline-icon {
    background: #dc3545;
    color: white;
}

.timeline-content h6 {
    margin: 0 0 5px 0;
    font-weight: 600;
    color: #333;
}

.timeline-content p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Enhanced Info Items */
.response-time {
    background: linear-gradient(135deg, #d4af37, #8b6f3f);
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 600;
}

.email-address {
    color: #007bff;
    font-family: 'Courier New', monospace;
    background: #f8f9fa;
    padding: 4px 8px;
    border-radius: 4px;
}

.order-count {
    background: #17a2b8;
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* Alert Styling */
.alert {
    border: none;
    border-radius: 10px;
    padding: 15px 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.alert-success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    color: #721c24;
    border-left: 4px solid #dc3545;
}

/* Print Styles */
@media print {
    .admin-card-header,
    .btn-admin,
    .btn-admin-outline,
    .timeline,
    .alert {
        display: none !important;
    }

    .admin-card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
        page-break-inside: avoid;
    }

    .status-badge {
        border: 1px solid #333 !important;
        background: white !important;
        color: #333 !important;
    }

    .timeline-item {
        padding-right: 0;
        margin-bottom: 15px;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }

    .info-item label {
        min-width: auto;
    }

    .product-info {
        flex-direction: column;
        align-items: flex-start;
        text-align: center;
    }

    .product-image,
    .no-image {
        align-self: center;
    }
}
</style>
@endsection

@section('scripts')
<script>
// Copy Order Information Function
function copyOrderInfo() {
    const orderInfo = `
طلب رقم: #{{ $order->id }}
العميل: {{ $order->customer->firstname }} {{ $order->customer->lastname }}
الهاتف: {{ $order->customer->phone }}
المدينة: {{ $order->customer->city }}
العنوان: {{ $order->shipping_address }}
طريقة الدفع: {{ $order->payment_method }}
المبلغ الإجمالي: {{ number_format($order->total_price, 2) }} درهم
حالة الطلب: {{ $order->status }}
تاريخ الطلب: {{ $order->created_at->format('Y-m-d H:i') }}

المنتجات:
@foreach($order->orderItems as $item)
- {{ $item->product->name }} ({{ $item->quantity }} × {{ number_format($item->price, 2) }} درهم)
@endforeach
    `.trim();

    navigator.clipboard.writeText(orderInfo).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i> تم النسخ!';
        button.style.background = '#28a745';
        button.style.color = 'white';

        setTimeout(function() {
            button.innerHTML = originalText;
            button.style.background = '';
            button.style.color = '';
        }, 2000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
        alert('حدث خطأ في النسخ');
    });
}

// Auto-refresh order status every 30 seconds
setInterval(function() {
    // Only refresh if the order is not completed or cancelled
    const currentStatus = '{{ $order->status }}';
    if (!['delivered', 'cancelled'].includes(currentStatus)) {
        location.reload();
    }
}, 30000);

// Add smooth scrolling for timeline
document.addEventListener('DOMContentLoaded', function() {
    // Add animation to timeline items
    const timelineItems = document.querySelectorAll('.timeline-item');
    timelineItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(20px)';

        setTimeout(() => {
            item.style.transition = 'all 0.5s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, index * 200);
    });

    // Add hover effects to action buttons
    const actionButtons = document.querySelectorAll('.btn-admin-outline');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 15px rgba(0,0,0,0.2)';
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });
});
</script>
@endsection
