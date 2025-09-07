@extends('layouts.shop')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-nav">
    <a href="{{ route('home') }}">الرئيسية</a> /
    <a href="{{ route('categories.index') }}">فئات المنتجات</a> /
    <span>{{ $category->name }}</span>
</div>
    <!-- Category Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="category-header text-center">
                <div class="category-icon mb-3">
                    @switch($category->name)
                        @case('ملابس رجالية')
                            <i class="fas fa-tshirt"></i>
                            @break
                        @case('ملابس نسائية')
                            <i class="fas fa-female"></i>
                            @break
                        @case('أحذية')
                            <i class="fas fa-shoe-prints"></i>
                            @break
                        @case('حقائب')
                            <i class="fas fa-shopping-bag"></i>
                            @break
                        @case('إكسسوارات')
                            <i class="fas fa-gem"></i>
                            @break
                        @default
                            <i class="fas fa-tags"></i>
                    @endswitch
                </div>
                <h1 class="arabic-text">{{ $category->name }}</h1>
                <p class="text-muted">{{ $products->count() }} منتج متاح</p>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-product-item" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                        <div class="product-image">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img src="{{ asset('assets/img/products/' . $product->image) }}"
                                     alt="{{ $product->name }}">
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
                <div class="alert-empty-cart">
                    <i class="fas fa-box-open"></i>
                    <h4>لا توجد منتجات في هذه الفئة</h4>
                    <p>جاري إضافة منتجات جديدة قريباً</p>
                    <a href="{{ route('categories.index') }}" class="btn">العودة للفئات</a>
                </div>
            </div>
        </div>
    @endif

    <!-- Navigation -->
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a href="{{ route('categories.index') }}" class="bordered-btn me-3">
                <i class="fas fa-arrow-left"></i> العودة للفئات
            </a>
            <a href="{{ route('products.index') }}" class="boxed-btn">
                <i class="fas fa-th"></i> جميع المنتجات
            </a>
        </div>
    </div>
</div>

<style>
.category-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 40px 20px;
    border-radius: 15px;
    margin-bottom: 30px;
    border: 2px solid #ad8f53;
}

.category-header .category-icon i {
    font-size: 4rem;
    color: #ad8f53;
    display: block;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.category-header:hover .category-icon i {
    color: #8b6f3f;
    transform: scale(1.1);
}

.category-header h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    color: #333;
    font-weight: bold;
}

.category-header p {
    font-size: 1.2rem;
    color: #666;
    margin: 0;
}

/* Responsive adjustments */
@media only screen and (max-width: 767.96px) {
    .category-header h1 {
        font-size: 2rem;
    }

    .category-header .category-icon i {
        font-size: 3rem;
    }

    .category-header p {
        font-size: 1rem;
    }
}

@media only screen and (max-width: 575.96px) {
    .category-header {
        padding: 30px 15px;
    }

    .category-header h1 {
        font-size: 1.8rem;
    }

    .category-header .category-icon i {
        font-size: 2.5rem;
    }
}
</style>
@endsection
