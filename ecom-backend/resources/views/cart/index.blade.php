@extends('layouts.shop')

@section('content')
<style>
    /* Cart Page Styling */
    .cart-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .cart-header {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(173, 143, 83, 0.3);
    }

    .cart-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .cart-header p {
        font-size: 1.1rem;
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }

    .cart-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        border: none;
        margin-bottom: 2rem;
    }

    .cart-table {
        margin: 0;
    }

    .cart-table thead {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
    }

    .cart-table thead th {
        border: none;
        padding: 1.5rem 1rem;
        font-weight: 600;
        font-size: 1.1rem;
        text-align: center;
    }

    .cart-table tbody tr {
        border-bottom: 1px solid #f1f3f4;
        transition: all 0.3s ease;
    }

    .cart-table tbody tr:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .cart-table tbody td {
        border: none;
        padding: 1.5rem 1rem;
        vertical-align: middle;
        text-align: center;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        text-align: right;
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }

    .product-image:hover {
        transform: scale(1.05);
    }

    .product-details h6 {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .product-details small {
        color: #6c757d;
        display: block;
        margin-bottom: 0.25rem;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .quantity-btn {
        width: 35px;
        height: 35px;
        border: 2px solid #ad8f53;
        background: white;
        color: #ad8f53;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: bold;
    }

    .quantity-btn:hover {
        background: #ad8f53;
        color: white;
        transform: scale(1.1);
    }

    .quantity-input {
        width: 60px;
        text-align: center;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 0.5rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .quantity-input:focus {
        border-color: #ad8f53;
        outline: none;
        box-shadow: 0 0 0 3px rgba(173, 143, 83, 0.1);
    }

    .price-display {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ad8f53;
    }

    .total-display {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn-remove {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .btn-remove:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
        color: white;
    }

    .cart-summary {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
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
    }

    .btn-clear {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
    }

    .btn-clear:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(243, 156, 18, 0.4);
        color: white;
    }

    .btn-continue {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-continue:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        color: white;
        text-decoration: none;
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
        width: 100%;
        box-shadow: 0 6px 20px rgba(173, 143, 83, 0.3);
    }

    .btn-checkout:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(173, 143, 83, 0.4);
        color: white;
    }

    .empty-cart {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .empty-cart i {
        font-size: 4rem;
        color: #ad8f53;
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }

    .empty-cart h3 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .empty-cart p {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .btn-start-shopping {
        background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
        border: none;
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 6px 20px rgba(173, 143, 83, 0.3);
    }

    .btn-start-shopping:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(173, 143, 83, 0.4);
        color: white;
        text-decoration: none;
    }

    .alert {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
    }

    @media (max-width: 768px) {
        .cart-header h1 {
            font-size: 2rem;
        }

        .product-info {
            flex-direction: column;
            text-align: center;
        }

        .quantity-controls {
            flex-direction: column;
            gap: 0.25rem;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="cart-container">
    <div class="container">
        <!-- Cart Header -->
        <div class="cart-header text-center">
            <h1><i class="fas fa-shopping-cart me-3"></i>سلة التسوق</h1>
            <p>راجع منتجاتك قبل المتابعة للدفع</p>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        @if(isset($cartData) && $cartData && $cartData->cartItems->count() > 0)
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="cart-card">
                        <div class="table-responsive">
                            <table class="table cart-table">
                                <thead>
                                    <tr>
                                        <th>المنتج</th>
                                        <th>السعر</th>
                                        <th>الكمية</th>
                                        <th>المجموع</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartData->cartItems as $item)
                                        <tr>
                                            <td>
                                                <div class="product-info">
                                                    @if($item->product->image)
                                                        <img src="{{ asset('assets/img/products/' . $item->product->image) }}"
                                                             alt="{{ $item->product->name }}"
                                                             class="product-image">
                                                    @endif
                                                    <div>
                                                        <h6>{{ $item->product->name }}</h6>
                                                        @if(isset($item->product->size) && $item->product->size)
                                                            <small>المقاس: {{ $item->product->size }}</small>
                                                        @endif
                                                        @if(isset($item->product->description) && $item->product->description)
                                                            <small>{{ Str::limit($item->product->description, 50) }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="price-display">{{ number_format($item->product->price, 0) }} درهم</span>
                                            </td>
                                            <td>
                                                <div class="quantity-controls">
                                                    <form method="POST" action="{{ route('cart.update', $item->product_id) }}" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                                        <button type="submit" class="quantity-btn" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </form>

                                                    <input type="text" value="{{ $item->quantity }}" class="quantity-input" readonly>

                                                    <form method="POST" action="{{ route('cart.update', $item->product_id) }}" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                                        <button type="submit" class="quantity-btn">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="total-display">{{ number_format($item->quantity * $item->product->price, 0) }} درهم</span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <form method="POST" action="{{ route('cart.remove', $item->product_id) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-remove"
                                                                onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
                                                            <i class="fas fa-trash me-1"></i>حذف
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h4 class="mb-4 text-center">
                            <i class="fas fa-calculator me-2"></i>ملخص الطلب
                        </h4>

                        <div class="summary-row">
                            <span>عدد المنتجات:</span>
                            <span>{{ $cartData->cartItems->count() }}</span>
                        </div>

                        <div class="summary-row">
                            <span>المجموع الكلي:</span>
                            <span class="total-display">{{ number_format($total, 0) }} درهم</span>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('orders.checkout') }}" class="btn btn-checkout">
                                <i class="fas fa-credit-card me-2"></i>متابعة للدفع
                            </a>
                        </div>

                        <div class="mt-3">
                            <div class="d-flex gap-2">
                                <form method="POST" action="{{ route('cart.clear') }}" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-clear w-100"
                                            onclick="return confirm('هل أنت متأكد من تفريغ السلة؟')">
                                        <i class="fas fa-trash me-2"></i>تفريغ السلة
                                    </button>
                                </form>
                                <a href="{{ route('products.index') }}" class="btn btn-continue flex-fill">
                                    <i class="fas fa-shopping-bag me-2"></i>متابعة التسوق
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h3>سلة التسوق فارغة</h3>
                <p>لم تقم بإضافة أي منتجات إلى السلة بعد</p>
                <a href="{{ route('products.index') }}" class="btn-start-shopping">
                    <i class="fas fa-shopping-bag me-2"></i>ابدأ التسوق الآن
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
