@extends('layouts.shop')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-nav">
    <a href="{{ route('home') }}">الرئيسية</a> /
    <a href="{{ route('products.index') }}">منتجاتنا</a> /
    <span>{{ $product->name }}</span>
</div>
    <div class="row">
        <div class="col-lg-6">
            <!-- Product Image -->
            <div class="single-product-img">
                <img src="/assets/img/{{ $product->image }}"
                     alt="{{ $product->name }}"
                     class="img-fluid"
                     onload="this.nextElementSibling.style.display='none';"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="product-placeholder" style="display: none; width: 100%; height: 400px; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-image" style="font-size: 4rem; color: #ad8f53;"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Product Details -->
            <div class="single-product-content">
                <h3 class="arabic-text">{{ $product->name }}</h3>

                @if($product->category)
                    <div class="product-category mb-3">
                        <span class="badge" style="background-color: #ad8f53; color: white; padding: 8px 15px; border-radius: 20px;">
                            {{ $product->category->name }}
                        </span>
                    </div>
                @endif

                <p class="single-product-pricing">
                    {{ number_format($product->price, 0) }} درهم مغربي
                </p>

                <p class="product-description">
                    {{ $product->description }}
                </p>

                <div class="product-stock mb-4">
                    <h5>المخزون:</h5>
                    @if($product->stock > 0)
                        <span class="text-success">
                            <i class="fas fa-check-circle me-1"></i>
                            متوفر ({{ $product->stock }} قطعة)
                        </span>
                    @else
                        <span class="text-danger">
                            <i class="fas fa-times-circle me-1"></i>
                            غير متوفر
                        </span>
                    @endif
                </div>

                @if($product->stock > 0)
                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="row">
                            @if($product->size)
                                <div class="col-md-6">
                                    <label for="size" class="quantity-label">المقاس:</label>
                                    <select name="size" id="size" class="quantity-select" required>
                                        <option value="">اختر المقاس</option>
                                        @php
                                            $availableSizes = explode(',', $product->size);
                                        @endphp
                                        @foreach($availableSizes as $size)
                                            <option value="{{ trim($size) }}">{{ trim($size) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <label for="quantity" class="quantity-label">الكمية:</label>
                                <select name="quantity" id="quantity" class="quantity-select" required>
                                    @for($i = 1; $i <= min(10, $product->stock); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button type="submit" class="cart-btn btn-lg w-100">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>أضف إلى السلة</span>
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('products.index') }}" class="btn-back-to-products btn-lg w-100">
                                    <i class="fas fa-arrow-right"></i>
                                    <span>العودة للمنتجات</span>
                                </a>
                            </div>
                        </div>
                    </form>
                @else
                    <!-- Product Actions for out of stock -->
                    <div class="product-actions mt-4">
                        <a href="{{ route('products.index') }}" class="btn-back-to-products">
                            <i class="fas fa-arrow-right me-2"></i>
                            العودة للمنتجات
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

<style>
.single-product-img {
    text-align: center;
    padding: 20px;
}

.single-product-img img {
    border-radius: 5px;
    -webkit-box-shadow: 0 0 20px #ddd;
    box-shadow: 0 0 20px #ddd;
    max-width: 100%;
    height: auto;
}

.single-product-content {
    padding: 20px;
}

.single-product-content h3 {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
}

.single-product-content p.single-product-pricing {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #ad8f53;
    line-height: inherit;
}

.single-product-content p.product-description {
    font-size: 15px;
    color: #555;
    line-height: 1.8;
    margin-bottom: 20px;
}

.cart-btn {
    font-family: 'Poppins', sans-serif;
    background-color: #ad8f53;
    color: #fff;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    text-align: center;
    padding: 15px 20px;
    font-weight: 600;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    min-height: 50px;
}

.cart-btn:hover {
    background-color: #8b6f3f;
    color: #fff;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(173, 143, 83, 0.3);
}

.cart-btn i {
    font-size: 18px;
}

.product-actions {
    margin-top: 30px;
}

.product-actions .btn {
    border-radius: 5px;
    padding: 10px 20px;
    font-weight: 500;
}

.btn-back-to-products {
    font-family: 'Poppins', sans-serif;
    background-color: #6c757d;
    color: #fff;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    text-align: center;
    padding: 15px 20px;
    font-weight: 600;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    min-height: 50px;
}

.btn-back-to-products:hover {
    background-color: #5a6268;
    color: #fff;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
}

.btn-back-to-products i {
    font-size: 18px;
}

/* Quantity Label Styling */
.quantity-label {
    font-family: 'Tajawal', 'Cairo', sans-serif;
    font-weight: 600;
    font-size: 16px;
    color: #333;
    margin-bottom: 8px;
    display: block;
    text-align: right;
}

/* Quantity Select Styling */
.quantity-select {
    width: 100%;
    padding: 8px 12px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    background: white;
    font-family: 'Tajawal', 'Cairo', sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: #333;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 12px center;
    background-repeat: no-repeat;
    background-size: 16px;
    padding-right: 40px;
}

.quantity-select:focus {
    outline: none;
    border-color: #ad8f53;
    box-shadow: 0 0 0 3px rgba(173, 143, 83, 0.1);
}

.quantity-select:hover {
    border-color: #ad8f53;
    box-shadow: 0 4px 12px rgba(173, 143, 83, 0.15);
}

.quantity-select option {
    padding: 8px 12px;
    font-weight: 600;
    color: #333;
}


/* Responsive adjustments */
@media (max-width: 768px) {
    .single-product-content h3 {
        font-size: 18px;
    }

    .single-product-content p.single-product-pricing {
        font-size: 24px;
    }

    .cart-btn {
        margin-left: 0;
        margin-bottom: 0;
    }

    .btn-back-to-products {
        margin-left: 0;
    }

    .quantity-select {
        width: 100%;
        margin-bottom: 15px;
    }

    .d-flex.gap-3 {
        flex-direction: column;
        gap: 1rem !important;
    }
}
</style>
@endsection
