@extends('layouts.shop')

@section('content')
<!-- Page Title -->
<div class="page-title">
    <h1 class="arabic-text">منتجاتنا</h1>
    <p class="arabic-text">اكتشف مجموعتنا المتنوعة من الملابس العربية العصرية</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumb-nav">
    <a href="{{ route('home') }}">الرئيسية</a> /
    <a href="{{ route('products.index') }}">منتجاتنا</a>
</div>

    @if($products->count() > 0)
        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-product-item" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                        <div class="product-image">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img src="/assets/img/{{ $product->image }}"
                                     alt="{{ $product->name }}"
                                     onload="this.nextElementSibling.style.display='none';"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="product-placeholder" style="display: none; width: 100%; height: 200px; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="font-size: 3rem; color: #ad8f53;"></i>
                                </div>
                            </a>
                        </div>
                        <h3 class="arabic-text">{{ $product->name }}</h3>
                        <p class="product-price">
                            <span>السعر</span>
                            {{ number_format($product->price, 0) }} درهم مغربي
                        </p>
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline" onclick="event.stopPropagation();">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="cart-btn">
                                    <i class="fas fa-shopping-cart"></i> أضف إلى السلة
                                </button>
                            </form>
                        @else
                            <span class="cart-btn" style="background-color: #ccc; cursor: not-allowed;">
                                <i class="fas fa-times"></i> غير متوفر
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="row">
            <div class="col-12 text-center">
                <div class="empty-products">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h3>لا توجد منتجات متاحة حالياً</h3>
                    <p class="text-muted">يرجى العودة لاحقاً</p>
                </div>
            </div>
        </div>
    @endif
<style>
.page-title {
    text-align: center;
    margin: 5px 0 10px 0;
    padding: 5px 2px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
    position: relative;
    overflow: hidden;

}
.page-title h1 {
    font-size: 2.5rem;
    margin-bottom: 5px;
    color: #333;
}
.page-title p {
    font-size: 1.2rem;
    color: #666;
    margin: 0;
}

/* Product Card Styling */
.single-product-item {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    text-align: center;
    overflow: hidden;
    position: relative;
    transition: transform 0.35s ease, box-shadow 0.35s ease;
    cursor: pointer;
    margin-bottom: 30px;
    -webkit-box-shadow: 0 0 20px #e4e4e4;
    box-shadow: 0 0 20px #e4e4e4;
    padding-bottom: 50px;
    border-radius: 25px;
}

.single-product-item:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 35px rgba(0, 0, 0, 0.15);
}

.single-product-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* Product Image Styling */
.product-image {
    position: relative;
    overflow: hidden;
    border-radius: 20px 20px 0 0;
    margin: 0;
    padding: 0;
    height: auto;
    min-height: 200px;
}

.product-image img {
    width: 100%;
    height: auto;
    object-fit: contain;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    display: block;
}

.single-product-item:hover .product-image img {
    transform: scale(1.08);
    filter: brightness(1.08);
}

.product-image::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(180, 139, 87, 0.15);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.single-product-item:hover .product-image::after {
    opacity: 1;
}

/* Product Content Styling */
.single-product-item h3 {
    font-size: 1.25rem;
    margin-top: 15px;
    margin-bottom: 10px;
    font-weight: bold;
    transition: color 0.3s ease;
}

.single-product-item:hover h3 {
    color: #b48b57;
}

.product-price {
    font-size: 1.1rem;
    color: #ad8f53;
    font-weight: 600;
    margin-bottom: 20px;
    padding: 0 20px;
}

.product-price span {
    color: #666;
    font-weight: 500;
}

/* Cart Button Styling */
.cart-btn {
    background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    margin: 0 20px 20px 20px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    text-decoration: none;
}

.cart-btn:hover {
    background: linear-gradient(135deg, #8b6f3f 0%, #6d5a3a 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(173, 143, 83, 0.3);
    text-decoration: none;
}

.cart-btn i {
    font-size: 16px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .single-product-item {
        margin-bottom: 20px;
    }

    .product-image {
        height: 200px;
    }

    .single-product-item h3 {
        font-size: 1.2rem;
    }

    .product-price {
        font-size: 1rem;
    }
}

</style>
@endsection

