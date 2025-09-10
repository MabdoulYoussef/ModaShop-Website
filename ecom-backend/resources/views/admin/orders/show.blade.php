@extends('layouts.admin')

@section('title', 'تفاصيل الطلب')
@section('page-title', 'تفاصيل الطلب #' . $order->id)
@section('page-description', 'عرض تفاصيل الطلب وإدارة حالته')

@section('content')

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

/* Print Styles */
@media print {
    .admin-card-header,
    .btn-admin,
    .btn-admin-outline {
        display: none !important;
    }

    .admin-card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }

    .status-badge {
        border: 1px solid #333 !important;
        background: white !important;
        color: #333 !important;
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
