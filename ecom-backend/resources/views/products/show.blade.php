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
            <!-- Product Images -->
            <div class="single-product-img">
                @if($product->images && count($product->images) > 0)
                    <!-- Main Image Display -->
                    <div class="main-image-container mb-3 position-relative">
                        @if(count($product->images) > 1)
                            <!-- Navigation Arrows -->
                            <button class="image-nav-btn image-nav-prev" onclick="previousImage()" title="الصورة السابقة">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="image-nav-btn image-nav-next" onclick="nextImage()" title="الصورة التالية">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        @endif

                        <img id="mainProductImage"
                             src="/assets/img/{{ $product->images[0] }}"
                             alt="{{ $product->name }}"
                             class="img-fluid main-product-image"
                             onload="this.nextElementSibling.style.display='none';"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="product-placeholder" style="display: none; width: 100%; height: 400px; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image" style="font-size: 4rem; color: #ad8f53;"></i>
                        </div>

                        @if(count($product->images) > 1)
                            <!-- Image Counter -->
                            <div class="image-counter">
                                <span id="currentImageNumber">1</span> / <span id="totalImages">{{ count($product->images) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail Images -->
                    @if(count($product->images) > 1)
                        <div class="thumbnail-images">
                            <div class="row">
                                @foreach($product->images as $index => $image)
                                    <div class="col-3 mb-2">
                                        <img src="/assets/img/{{ $image }}"
                                             alt="{{ $product->name }} - صورة {{ $index + 1 }}"
                                             class="img-fluid thumbnail-image {{ $index === 0 ? 'active' : '' }}"
                                             onclick="changeMainImage('/assets/img/{{ $image }}', this)"
                                             style="cursor: pointer; border: 2px solid #ddd; border-radius: 5px; transition: all 0.3s ease;"
                                             onerror="this.style.display='none';">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Fallback to single image -->
                    <img src="/assets/img/{{ $product->image }}"
                         alt="{{ $product->name }}"
                         class="img-fluid"
                         onload="this.nextElementSibling.style.display='none';"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="product-placeholder" style="display: none; width: 100%; height: 400px; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image" style="font-size: 4rem; color: #ad8f53;"></i>
                    </div>
                @endif
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

/* Multiple Images Styling */
.main-image-container {
    position: relative;
}

.main-product-image {
    border-radius: 5px;
    -webkit-box-shadow: 0 0 20px #ddd;
    box-shadow: 0 0 20px #ddd;
    width: 100%;
    height: 400px;
    object-fit: cover;
    object-position: center;
    display: block;
}

/* Navigation Arrows */
.image-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.95);
    color: #ad8f53;
    border: 2px solid #ad8f53;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
    backdrop-filter: blur(5px);
}

.image-nav-btn:hover {
    background: #ad8f53;
    color: white;
    transform: translateY(-50%) scale(1.05);
    box-shadow: 0 4px 15px rgba(173, 143, 83, 0.4);
}

.image-nav-btn:active {
    transform: translateY(-50%) scale(0.95);
}

.image-nav-prev {
    left: 21px;
}

.image-nav-next {
    right: 1px;
}

/* Image Counter */
.image-counter {
    position: absolute;
    bottom: 15px;
    right: 15px;
    background: rgba(173, 143, 83, 0.9);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 13px;
    font-weight: 600;
    z-index: 10;
    backdrop-filter: blur(5px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.thumbnail-image {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
}

.thumbnail-image:hover {
    border-color: #ad8f53 !important;
    transform: scale(1.05);
}

.thumbnail-image.active {
    border-color: #ad8f53 !important;
    border-width: 3px !important;
}

.thumbnail-images {
    margin-top: 15px;
}

.thumbnail-images .col-3 {
    padding: 0 5px;
}

@media (max-width: 768px) {
    .main-product-image {
        height: 300px;
    }

    .thumbnail-image {
        height: 60px;
    }
}
</style>

<script>
let currentImageIndex = 0;
const productImages = @json($product->images ?? []);

function changeMainImage(imageSrc, thumbnailElement) {
    // Update main image
    const mainImage = document.getElementById('mainProductImage');
    if (mainImage) {
        mainImage.src = imageSrc;
    }

    // Update active thumbnail
    const thumbnails = document.querySelectorAll('.thumbnail-image');
    thumbnails.forEach(thumb => thumb.classList.remove('active'));
    thumbnailElement.classList.add('active');

    // Update current index
    const thumbnailIndex = Array.from(thumbnails).indexOf(thumbnailElement);
    if (thumbnailIndex !== -1) {
        currentImageIndex = thumbnailIndex;
        updateImageCounter();
    }
}

function nextImage() {
    if (productImages.length > 1) {
        currentImageIndex = (currentImageIndex + 1) % productImages.length;
        updateMainImage();
    }
}

function previousImage() {
    if (productImages.length > 1) {
        currentImageIndex = (currentImageIndex - 1 + productImages.length) % productImages.length;
        updateMainImage();
    }
}

function updateMainImage() {
    const mainImage = document.getElementById('mainProductImage');
    if (mainImage && productImages[currentImageIndex]) {
        mainImage.src = '/assets/img/' + productImages[currentImageIndex];
    }

    // Update active thumbnail
    const thumbnails = document.querySelectorAll('.thumbnail-image');
    thumbnails.forEach(thumb => thumb.classList.remove('active'));
    if (thumbnails[currentImageIndex]) {
        thumbnails[currentImageIndex].classList.add('active');
    }

    updateImageCounter();
}

function updateImageCounter() {
    const currentNumber = document.getElementById('currentImageNumber');
    if (currentNumber) {
        currentNumber.textContent = currentImageIndex + 1;
    }
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (productImages.length > 1) {
        if (e.key === 'ArrowLeft') {
            previousImage();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        }
    }
});

// Initialize counter on page load
document.addEventListener('DOMContentLoaded', function() {
    updateImageCounter();
});
</script>
@endsection
