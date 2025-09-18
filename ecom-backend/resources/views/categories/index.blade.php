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
                                @if($category->image)
                                    <img src="{{ asset('assets/img/' . $category->image) }}"
                                         alt="{{ $category->name }}"
                                         class="category-image">
                                @else
                                    <div class="category-placeholder">
                                        <i class="fas fa-image" style="font-size: 4rem; color: #ad8f53;"></i>
                                    </div>
                                @endif
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
/* Modern Category Cards */
.shop-card {
    background: white;
    border-radius: 20px;
    padding: 0;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    cursor: pointer;
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
}

.shop-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 60px rgba(173, 143, 83, 0.25);
    border-color: rgba(173, 143, 83, 0.3);
}

.shop-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.shop-card:hover::before {
    opacity: 1;
}

/* Category Image Styling */
.product-image {
    position: relative;
    overflow: hidden;
    border-radius: 20px 20px 0 0;
    margin: 0;
    padding: 0;
    height: 250px;
}

.category-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.shop-card:hover .category-image {
    transform: scale(1.08);
}

.category-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.category-placeholder::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(173, 143, 83, 0.1) 50%, transparent 70%);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.category-placeholder i {
    font-size: 4rem;
    color: #ad8f53;
    z-index: 1;
    position: relative;
}

/* Category Content */
.shop-card h3 {
    font-family: 'Tajawal', 'Cairo', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 20px 20px 10px 20px;
    transition: color 0.3s ease;
    line-height: 1.3;
}

.shop-card:hover h3 {
    color: #ad8f53;
}

.shop-card .price {
    font-size: 1rem;
    color: #7f8c8d;
    margin: 0 20px 20px 20px;
    font-weight: 500;
}

.shop-card .price span {
    color: #ad8f53;
    font-weight: 700;
}

/* Action Button */
.shop-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    margin: 0 20px 25px 20px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(173, 143, 83, 0.3);
    border: none;
    width: calc(100% - 40px);
}

.shop-btn:hover {
    background: linear-gradient(135deg, #8b6f3f 0%, #6d5530 100%);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(173, 143, 83, 0.4);
}

.shop-btn i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.shop-btn:hover i {
    transform: translateX(-3px);
}

/* Page Title Styling */
.page-title {
    text-align: center;
    margin: 40px 0 60px 0;
    padding: 40px 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}

.page-title::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
}

.page-title h1 {
    font-family: 'Tajawal', 'Cairo', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
}

.page-title p {
    font-size: 1.1rem;
    color: #7f8c8d;
    margin: 0;
}

/* Breadcrumb Styling */
.breadcrumb-nav {
    margin: 20px 0 40px 0;
    padding: 15px 0;
}

.breadcrumb-nav a {
    color: #ad8f53;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.breadcrumb-nav a:hover {
    color: #8b6f3f;
    text-decoration: none;
}

.breadcrumb-nav span {
    color: #7f8c8d;
    margin: 0 8px;
}

/* Back Button Styling */
.bordered-btn {
    display: inline-flex;
    align-items: center;
    background: transparent;
    color: #ad8f53;
    border: 2px solid #ad8f53;
    padding: 15px 30px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    margin-top: 40px;
}

.bordered-btn:hover {
    background: #ad8f53;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(173, 143, 83, 0.3);
}

.bordered-btn i {
    margin-right: 8px;
    transition: transform 0.3s ease;
}

.bordered-btn:hover i {
    transform: translateX(-3px);
}

/* Empty State */
.alert-empty-cart {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
}

.alert-empty-cart i {
    font-size: 4rem;
    color: #ad8f53;
    margin-bottom: 20px;
}

.alert-empty-cart h4 {
    font-family: 'Tajawal', 'Cairo', sans-serif;
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 15px;
}

.alert-empty-cart p {
    color: #7f8c8d;
    margin-bottom: 25px;
}

.alert-empty-cart .btn {
    background: linear-gradient(135deg, #ad8f53 0%, #8b6f3f 100%);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.alert-empty-cart .btn:hover {
    background: linear-gradient(135deg, #8b6f3f 0%, #6d5530 100%);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title h1 {
        font-size: 2rem;
    }

    .shop-card {
        margin-bottom: 30px;
    }

    .product-image {
        height: 200px;
    }

    .shop-card h3 {
        font-size: 1.3rem;
    }
}

@media (max-width: 576px) {
    .page-title {
        margin: 20px 0 40px 0;
        padding: 30px 15px;
    }

    .page-title h1 {
        font-size: 1.8rem;
    }

    .product-image {
        height: 180px;
    }

    .shop-card h3 {
        font-size: 1.2rem;
        margin: 15px 15px 8px 15px;
    }

    .shop-card .price {
        margin: 0 15px 15px 15px;
    }

    .shop-btn {
        margin: 0 15px 20px 15px;
        width: calc(100% - 30px);
        padding: 10px 20px;
    }
}
</style>
@endsection
