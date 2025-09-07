@extends('layouts.shop')

@section('content')
<!-- Page Title -->
<div class="page-title">
    <h1 class="arabic-text">فئات المنتجات</h1>
    <p class="arabic-text">تصفح منتجاتنا حسب الفئات المختلفة</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumb-nav">
    <a href="{{ route('home') }}">الرئيسية</a> /
    <a href="{{ route('categories.index') }}">فئات المنتجات</a>
</div>

    @if($categories->count() > 0)
        <div class="row">
            @foreach($categories as $category)
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="shop-card" onclick="window.location.href='{{ route('categories.show', $category->id) }}'">
                        <div class="product-image mb-3">
                            <a href="{{ route('categories.show', $category->id) }}">
                                @switch($category->name)
                                    @case('ملابس رجالية')
                                        <i class="fas fa-tshirt" style="font-size: 4rem; color: #ad8f53;"></i>
                                        @break
                                    @case('ملابس نسائية')
                                        <i class="fas fa-female" style="font-size: 4rem; color: #ad8f53;"></i>
                                        @break
                                    @case('أحذية')
                                        <i class="fas fa-shoe-prints" style="font-size: 4rem; color: #ad8f53;"></i>
                                        @break
                                    @case('حقائب')
                                        <i class="fas fa-shopping-bag" style="font-size: 4rem; color: #ad8f53;"></i>
                                        @break
                                    @case('إكسسوارات')
                                        <i class="fas fa-gem" style="font-size: 4rem; color: #ad8f53;"></i>
                                        @break
                                    @default
                                        <i class="fas fa-tags" style="font-size: 4rem; color: #ad8f53;"></i>
                                @endswitch
                            </a>
                        </div>
                        <h3 class="arabic-text">{{ $category->name }}</h3>
                        <p class="price">
                            {{ $category->products_count ?? 0 }} منتج
                        </p>
                        <a href="{{ route('categories.show', $category->id) }}" class="shop-btn">
                            <i class="fas fa-eye"></i> عرض المنتجات
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row">
            <div class="col-12 text-center">
                <div class="alert-empty-cart">
                    <i class="fas fa-folder-open"></i>
                    <h4>لا توجد فئات متاحة حالياً</h4>
                    <p>يرجى العودة لاحقاً</p>
                    <a href="{{ route('products.index') }}" class="btn">عرض جميع المنتجات</a>
                </div>
            </div>
        </div>
    @endif

    <!-- Back to Products -->
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a href="{{ route('products.index') }}" class="bordered-btn">
                <i class="fas fa-arrow-left"></i> عرض جميع المنتجات
            </a>
        </div>
    </div>
</div>

<style>
.category-icon-large {
    font-size: 8rem;
    color: #ad8f53;
    display: block;
    margin: 20px 0;
    transition: all 0.3s ease;
}

.single-product-item:hover .category-icon-large {
    color: #8b6f3f;
    transform: scale(1.1);
}

.single-product-item {
    cursor: pointer;
}

.single-product-item .product-image {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.single-product-item:hover .product-image {
    background: linear-gradient(135deg, #ad8f53, #8b6f3f);
}

.single-product-item:hover .product-image .category-icon-large {
    color: white;
}

.single-product-item h3 {
    font-size: 1.4rem;
    margin-top: 15px;
    margin-bottom: 10px;
    font-weight: bold;
    transition: color 0.3s ease;
}

.single-product-item:hover h3 {
    color: #b48b57;
}

.single-product-item .product-price {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 15px;
}

.single-product-item .product-price span {
    color: #ad8f53;
    font-weight: bold;
    margin-left: 5px;
}

.single-product-item .cart-btn {
    width: 100%;
    text-align: center;
}

/* Responsive adjustments */
@media only screen and (max-width: 767.96px) {
    .category-icon-large {
        font-size: 6rem;
    }

    .single-product-item h3 {
        font-size: 1.2rem;
    }
}

@media only screen and (max-width: 575.96px) {
    .category-icon-large {
        font-size: 5rem;
    }
}
</style>
@endsection
