@extends( 'Layouts.master')

@section( 'content')
	<!-- hero area -->
	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row align-items-center">
				<!-- Text -->
				<div class="col-lg-6">
					<div class="hero-text-tablecell">
						<p class="subtitle arabic-text" style="font-family: 'Tajawal', 'Cairo', sans-serif; font-weight:700;" data-aos="fade-up" data-aos-delay="200">
							ملابس ذات جودة عالية
						</p>
						<p class="arabic-text" style="font-family: 'Tajawal', 'Cairo', sans-serif; font-weight:600; font-size:2rem; color:#96783d; margin-bottom: 1.5rem;" data-aos="fade-up" data-aos-delay="300">أزياء راقية تواكب أحدث الصيحات</p>
						<div style="height: 2.5rem;"></div> <!-- vertical spacing -->
						<div class="hero-btns" data-aos="fade-up" data-aos-delay="400">
							<a href="{{ route('shop') }}" class="boxed-btn btn">المجموعة</a>
							<a href="/contact" class="bordered-btn btn">اتصل بنا</a>
						</div>
					</div>
				</div>

				<!-- Image -->
				<div class="col-lg-6 text-center">
					<div class="hero-img" style="margin-bottom: 2rem;" data-aos="fade-up" data-aos-delay="200">
						<img src="assets/img/BANNER3m.png" alt="عرض المنتجات" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->



	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-shipping-fast"></i>
						</div>
						<div class="content">
							<h3 class="arabic-text">شحن مجاني</h3>
							<p class="arabic-text">لجميع الطلبات</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-phone-volume"></i>
						</div>
						<div class="content">
							<h3 class="arabic-text">دعم 24/7</h3>
							<p class="arabic-text">احصل على الدعم طوال اليوم</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
							<i class="fas fa-sync"></i>
						</div>
						<div class="content">
							<h3 class="arabic-text">إرجاع المنتج</h3>
							<p class="arabic-text">يمكنك إرجاعه خلال يوم واحد إذا لم يعجبك!</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end features list section -->

	<!-- product section -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">منتجاتنا</span> المميزة</h3>
						<p class="arabic-text">اكتشف مجموعتنا المتنوعة من الملابس العربية العصرية والأنيقة</p>
					</div>
				</div>
			</div>

			@if(isset($featuredProducts) && $featuredProducts->count() > 0)
			<div class="row">
				@foreach($featuredProducts as $product)
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
			@else
			<div class="row">
				<div class="col-12 text-center">
					<div class="empty-state">
						<i class="fas fa-box-open fa-3x text-muted mb-3"></i>
						<h4 class="arabic-text text-muted">لا توجد منتجات متاحة حالياً</h4>
						<p class="arabic-text text-muted">سيتم إضافة المنتجات قريباً</p>
						<p class="arabic-text text-muted small">يرجى المحاولة مرة أخرى لاحقاً</p>
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
	<!-- end product section -->


	<!-- cart banner section -->
	@if($monthlyOfferProduct)
	<section class="cart-banner pt-100 pb-100">
		<div class="container">
			<div class="row clearfix">
				<!--Image Column-->
				<div class="image-column col-lg-6">
					<div class="image">
						<div class="price-box">
							<div class="inner-price">
								<span class="price">
									<strong>30%</strong> <br>
									خصم
								</span>
							</div>
						</div>
						@if($monthlyOfferProduct->images && count($monthlyOfferProduct->images) > 0)
							<img src="/assets/img/{{ $monthlyOfferProduct->images[0] }}" alt="{{ $monthlyOfferProduct->name }}" style="width: 420px !important; height: 700px !important; object-fit: cover !important; border-radius: 20px !important;">
						@else
							<img src="/assets/img/{{ $monthlyOfferProduct->image }}" alt="{{ $monthlyOfferProduct->name }}" style="width: 420px !important; height: 700px !important; object-fit: cover !important; border-radius: 20px !important; ">
						@endif
					</div>
				</div>
				<!--Content Column-->
				<div class="content-column col-lg-6">
					<h3><span class="orange-text">عرض الشهر</span></h3>
					<h4 class="arabic-text product-name" style="font-size: 2.2rem !important; font-weight: 500 !important; color: #3d2e03 !important; margin-bottom: 1rem !important; text-shadow: 1px 1px 2px rgba(0,0,0,0.1) !important;">{{ $monthlyOfferProduct->name }}</h4>
					<div class="text arabic-text product-description" style="font-size: 1.1rem !important; line-height: 1.6 !important; color: #666 !important; margin-bottom: 1.5rem !important;">{{ $monthlyOfferProduct->description }}</div>
					<div class="price-display mb-3">
						<span class="current-price" style="font-size: 1.4rem !important; font-weight: 900 !important; color: #64490d !important; background: linear-gradient(45deg, #644e1f, #765107) !important; -webkit-background-clip: text !important; -webkit-text-fill-color: transparent !important; background-clip: text !important; text-shadow: 1px 1px 2px rgba(0,0,0,0.1) !important;">{{ number_format($monthlyOfferProduct->price, 2) }} درهم مغربي</span>
					</div>
					<!--Countdown Timer-->
					<div class="time-counter">
						<div class="time-countdown clearfix" data-countdown="2025-01-25">
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>أيام</div>
							</div>
							<div class="counter-column">
								<div class="inner">
									<span class="count">00</span>ساعات</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>دقائق</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>ثواني</div>
							</div>
						</div>
					</div>
					<form action="{{ route('cart.add') }}" method="POST" class="d-inline">
						@csrf
						<input type="hidden" name="product_id" value="{{ $monthlyOfferProduct->id }}">
						<input type="hidden" name="quantity" value="1">
						<button type="submit" class="cart-btn mt-3">
							<i class="fas fa-shopping-cart"></i> أضف إلى السلة
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	@endif
	<!-- end cart banner section -->


	<!-- advertisement section -->
	<div class="abt-section mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="abt-bg">
						<a href="https://www.youtube.com/watch?v=DBLlFWYcIGQ"></a>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="abt-text">
						<p class="top-sub arabic-text">منذ عام 2019</p>
						<h2 class="arabic-text">نحن <span class="orange-text">ModaShop</span></h2>
						<p class="arabic-text">متجر متخصص في الملابس العربية العصرية والأنيقة. نقدم أفضل الجودات والأسعار المناسبة لعملائنا الكرام.</p>
						<p class="arabic-text">نحن نؤمن بأن كل امرأة تستحق أن تبدو جميلة وأنيقة. لذلك نحرص على تقديم أحدث التصاميم وأفضل الخامات.</p>
						<a href="{{ route('about') }}" class="boxed-btn mt-4">اعرف المزيد</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end advertisement section -->

	<!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="assets/img/company-logos/1.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/2.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/3.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/4.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/5.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end logo carousel -->
@endsection

