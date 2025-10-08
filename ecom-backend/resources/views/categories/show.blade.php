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
        <div class="row products-container">
            @foreach($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-6 text-center mb-5">
                    <div class="category-product-card" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
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
                            {{ number_format($product->price, 2) }} درهم مغربي
                        </p>
                        @if($product->stock > 0)
                            <a href="{{ route('products.show', $product->id) }}" class="category-cart-btn" onclick="event.stopPropagation();">
                                <i class="fas fa-eye"></i> عرض المنتج
                            </a>
                        @else
                            <span class="category-cart-btn" style="background-color: #ccc; cursor: not-allowed;">
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
/* Products Container */
.products-container {
    margin: 40px 0;
    padding: 0 20px;
}

/* Category Product Cards - Same as Product Page */
.category-product-card {
    width: 300px !important;
    height: 600px !important;
    margin: 0 auto 30px auto !important;
    background: white !important;
    border-radius: 15px !important;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
    transition: all 0.3s ease !important;
    overflow: hidden !important;
    position: relative !important;
    display: flex !important;
    flex-direction: column !important;
    cursor: pointer !important;
}

.category-product-card:hover {
    transform: translateY(-5px) !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

.category-product-card .product-image {
    width: 100% !important;
    height: 450px !important;
    overflow: hidden !important;
    position: relative !important;
}

.category-product-card .product-image img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    transition: transform 0.3s ease !important;
}

.category-product-card:hover .product-image img {
    transform: scale(1.05) !important;
}

.category-product-card h3 {
    padding: 15px 20px 10px 20px !important;
    font-size: 1.1rem !important;
    font-weight: 600 !important;
    color: #333 !important;
    margin: 0 !important;
    line-height: 1.4 !important;
    height: 60px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center !important;
}

.category-product-card .product-price {
    padding: 0 20px 15px 20px !important;
    font-size: 1rem !important;
    color: #ceb57f !important;
    font-weight: 700 !important;
    margin: 0 !important;
    text-align: center !important;
}

.category-product-card .category-cart-btn {
    margin: 0 20px 20px 20px !important;
    padding: 12px 20px !important;
    background: linear-gradient(45deg, #ceb57f, #ad8f53) !important;
    color: white !important;
    border: none !important;
    border-radius: 25px !important;
    font-size: 0.9rem !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    transition: all 0.3s ease !important;
    cursor: pointer !important;
    width: calc(100% - 40px) !important;
}

.category-product-card .category-cart-btn:hover {
    background: linear-gradient(45deg, #ad8f53, #ceb57f) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(206, 181, 127, 0.4) !important;
    color: white !important;
    text-decoration: none !important;
}

/* Center product cards in their containers */
.col-lg-4.col-md-6.col-sm-6.text-center {
    display: flex !important;
    justify-content: center !important;
    margin-bottom: 30px !important;
}

/* Category Header */
.category-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 20px 10px;
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
@media (max-width: 768px) {
    .category-product-card {
        width: 300px !important;
        height: 600px !important;
    }

    .category-product-card .product-image {
        height: 450px !important;
    }

    .category-product-card h3 {
        font-size: 1rem !important;
        height: 60px !important;
    }

    .products-container {
        padding: 0 10px;
    }
}

@media (max-width: 480px) {
    .category-product-card {
        width: 300px !important;
        height: 600px !important;
    }

    .category-product-card .product-image {
        height: 450px !important;
    }

    .category-product-card h3 {
        font-size: 0.9rem !important;
        height: 60px !important;
    }
}

/* Original Category Header Responsive */
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
        padding: 15px 8px;
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
