@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5 arabic-text">منتجاتنا</h1>
        </div>
    </div>

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
