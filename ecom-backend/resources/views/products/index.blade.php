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
                <div class="col-lg-4 col-md-6 text-center mb-4">
                    <div class="shop-card" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                        <div class="product-image mb-3">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/placeholder.jpg') }}"
                                     alt="{{ $product->name }}" class="img-fluid" style="border-radius: 10px;">
                            </a>
                        </div>
                        <h3 class="arabic-text">{{ $product->name }}</h3>
                        <p class="price">
                            {{ number_format($product->price, 0) }} درهم مغربي
                        </p>
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline" onclick="event.stopPropagation();">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="shop-btn">
                                    <i class="fas fa-shopping-cart"></i> أضف إلى السلة
                                </button>
                            </form>
                        @else
                            <span class="shop-btn" style="background-color: #ccc; cursor: not-allowed;">
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
</div>
@endsection
