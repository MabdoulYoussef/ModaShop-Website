@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6">
            <!-- Product Image -->
            <div class="single-product-img">
                <img src="{{ asset('assets/img/products/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="img-fluid">
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
                            <div class="col-md-4">
                                <label for="quantity" class="form-label">الكمية:</label>
                                <select name="quantity" id="quantity" class="form-select" required>
                                    @for($i = 1; $i <= min(10, $product->stock); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="cart-btn btn-lg w-100">
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    أضف إلى السلة
                                </button>
                            </div>
                        </div>
                    </form>
                @endif

                <!-- Product Actions -->
                <div class="product-actions">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-2"></i>
                        العودة للمنتجات
                    </a>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-shopping-cart me-2"></i>
                        عرض السلة
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>التقييمات</h3>
                </div>
                <div class="card-body">
                    @if($product->reviews->count() > 0)
                        @foreach($product->reviews->where('is_approved', true) as $review)
                            <div class="review-item border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $review->customer->firstname }} {{ $review->customer->lastname }}</h6>
                                        <div class="stars mb-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <p class="text-muted">{{ $review->comment }}</p>
                                    </div>
                                    <small class="text-muted">{{ $review->created_at->format('Y-m-d') }}</small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">لا توجد تقييمات لهذا المنتج بعد.</p>
                    @endif

                    <!-- Add Review Button -->
                    <div class="mt-3">
                        <a href="{{ route('reviews.create', $product->id) }}" class="cart-btn">
                            <i class="fas fa-star me-2"></i>
                            أضف تقييمك
                        </a>
                    </div>
                </div>
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
    display: inline-block;
    background-color: #ad8f53;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.cart-btn:hover {
    background-color: #8b6f3f;
    color: #fff;
    text-decoration: none;
}

.cart-btn i {
    margin-right: 5px;
}

.product-actions {
    margin-top: 30px;
}

.product-actions .btn {
    border-radius: 5px;
    padding: 10px 20px;
    font-weight: 500;
}

.review-item:last-child {
    border-bottom: none !important;
}

.stars {
    font-size: 1.1rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .single-product-content h3 {
        font-size: 18px;
    }

    .single-product-content p.single-product-pricing {
        font-size: 24px;
    }
}
</style>
@endsection
