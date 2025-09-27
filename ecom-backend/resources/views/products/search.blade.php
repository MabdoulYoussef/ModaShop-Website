@extends('layouts.master')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-nav">
    <a href="{{ route('home') }}">الرئيسية</a> /
    <span>نتائج البحث</span>
</div>

<!-- Search Results Section -->
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3>نتائج البحث عن: <span class="orange-text">"{{ $query }}"</span></h3>
                    <p class="arabic-text">تم العثور على {{ $products->total() }} منتج</p>
                </div>
            </div>
        </div>

        @if($products->count() > 0)
        <div class="row">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ $product->image ? '/assets/img/' . $product->image : '/assets/img/placeholder.jpg' }}"
                                 alt="{{ $product->name }}"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                 onload="this.style.display='block'; this.nextElementSibling.style.display='none';">
                            <div class="product-placeholder" style="display: none; width: 100%; height: 250px; background: #f8f9fa; border-radius: 8px; align-items: center; justify-content: center; flex-direction: column;">
                                <i class="fas fa-image" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                                <span style="color: #999; font-size: 0.9rem;">صورة غير متاحة</span>
                            </div>
                        </a>
                    </div>
                    <h3 class="arabic-text">{{ $product->name }}</h3>
                    <p class="product-price"><span>السعر</span> {{ number_format($product->price, 2) }} درهم مغربي</p>
                    <a href="{{ route('cart.add') }}" class="cart-btn"
                       onclick="event.preventDefault(); document.getElementById('add-to-cart-{{ $product->id }}').submit();">
                        <i class="fas fa-shopping-cart"></i> أضف إلى السلة
                    </a>
                    <form id="add-to-cart-{{ $product->id }}" action="{{ route('cart.add') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(['q' => $query])->links() }}
        </div>
        @else
        <div class="row">
            <div class="col-12 text-center">
                <div class="empty-state">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="arabic-text text-muted">لم يتم العثور على نتائج</h4>
                    <p class="arabic-text text-muted">جرب البحث بكلمات مختلفة أو تصفح جميع المنتجات</p>
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="boxed-btn">تصفح جميع المنتجات</a>
                        <a href="{{ route('home') }}" class="bordered-btn">العودة للرئيسية</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Search Suggestions -->
<div class="search-suggestions-section mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h4 class="arabic-text mb-4">جرب البحث عن:</h4>
                <div class="suggestion-tags">
                    <a href="{{ route('products.search', ['q' => 'فستان']) }}" class="tag">فستان</a>
                    <a href="{{ route('products.search', ['q' => 'قميص']) }}" class="tag">قميص</a>
                    <a href="{{ route('products.search', ['q' => 'بنطلون']) }}" class="tag">بنطلون</a>
                    <a href="{{ route('products.search', ['q' => 'جاكيت']) }}" class="tag">جاكيت</a>
                    <a href="{{ route('products.search', ['q' => 'حذاء']) }}" class="tag">حذاء</a>
                    <a href="{{ route('products.search', ['q' => 'أحذية']) }}" class="tag">أحذية</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
.empty-state {
    padding: 4rem 2rem;
}

.suggestion-tags-section {
    background: #f8f9fa;
    padding: 3rem 0;
}

.suggestion-tags {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
}

.suggestion-tags .tag {
    background: #ceb57f;
    color: #fff;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.suggestion-tags .tag:hover {
    background: #ad8f53;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(206, 181, 127, 0.3);
    color: #fff;
    text-decoration: none;
}

.section-title h3 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.section-title p {
    font-size: 1.1rem;
    color: #666;
}

@media (max-width: 768px) {
    .section-title h3 {
        font-size: 2rem;
    }

    .suggestion-tags .tag {
        padding: 8px 16px;
        font-size: 0.9rem;
    }
}
</style>
@endsection
