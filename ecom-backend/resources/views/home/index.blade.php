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
						<p class="arabic-text"
   style="font-family: 'Tajawal', 'Cairo', sans-serif; font-weight:600; font-size:2rem; color:#96783d; margin-bottom: 1.5rem;"
   data-aos="fade-up" data-aos-delay="300">
	أزياء راقية تواكب أحدث الصيحات
</p>
						<div style="height: 2.5rem;"></div> <!-- vertical spacing -->
						<div class="hero-btns" data-aos="fade-up" data-aos-delay="400">
							<a href="{{ route('shop') }}" class="boxed-btn btn">المجموعة</a>
							<a href="{{ route('contact') }}" class="bordered-btn btn">اتصل بنا</a>
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
								<img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/placeholder.jpg') }}"
									 alt="{{ $product->name }}">
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
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/1.jpg" alt="عباية كلاسيكية"></a>
						</div>
						<h3 class="arabic-text">عباية كلاسيكية</h3>
						<p class="product-price"><span>السعر</span> 249درهم مغربي</p>
						<a href="#" class="cart-btn"><i class="fas fa-shopping-cart"></i> أضف إلى السلة</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/2.jpg" alt="عباية عصرية"></a>
						</div>
						<h3 class="arabic-text">عباية عصرية</h3>
						<p class="product-price"><span>السعر</span>349درهم مغربي</p>
						<a href="#" class="cart-btn"><i class="fas fa-shopping-cart"></i> أضف إلى السلة</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/3.jpg" alt="عباية أنيقة"></a>
						</div>
						<h3 class="arabic-text">عباية أنيقة</h3>
						<p class="product-price"><span>السعر</span> 349درهم مغربي</p>
						<a href="#" class="cart-btn"><i class="fas fa-shopping-cart"></i> أضف إلى السلة</a>
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
	<!-- end product section -->

	@if(isset($categories) && $categories->count() > 0)
	<!-- categories section -->
	<div class="categories-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">تسوق حسب</span> الفئة</h3>
						<p class="arabic-text">اكتشف مجموعتنا المتنوعة من الفئات</p>
					</div>
				</div>
			</div>

			<div class="row">
				@foreach($categories as $category)
				<div class="col-lg-3 col-md-6 text-center mb-4">
					<div class="category-item">
						<div class="category-icon">
							<i class="fas fa-tshirt"></i>
						</div>
						<h4 class="arabic-text">{{ $category->name }}</h4>
						<p class="arabic-text">{{ $category->products_count }} منتج</p>
						<a href="{{ route('categories.show', $category->id) }}" class="category-btn">
							<i class="fas fa-arrow-left"></i> تصفح
						</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- end categories section -->
	@endif

	<!-- cart banner section -->
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
						<img src="assets/img/8.jpg" alt="عرض خاص">
					</div>
				</div>
				<!--Content Column-->
				<div class="content-column col-lg-6">
					<h3><span class="orange-text">عرض الشهر</span></h3>
					<h4 class="arabic-text">عباية مميزة</h4>
					<div class="text arabic-text">اكتشف مجموعتنا المميزة من العبايات الأنيقة والعصرية. جودة عالية وأسعار منافسة مع خصم خاص هذا الشهر</div>
					<!--Countdown Timer-->
					<div class="time-counter">
						<div class="time-countdown clearfix" data-countdown="2025-10-01">
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
					<a href="cart.html" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> أضف إلى السلة</a>
				</div>
			</div>
		</div>
	</section>
	<!-- end cart banner section -->

	<!-- testimonail-section -->
	<div class="testimonail-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
						@if(isset($testimonials) && $testimonials->count() > 0)
							@foreach($testimonials as $review)
							<div class="single-testimonial-slider">
								<div class="client-avater">
									<img src="assets/img/avaters/hijab.jpg" alt="{{ $review->user->name }}">
								</div>
								<div class="client-meta">
									<h3 class="arabic-text">{{ $review->user->name }} <span>عميلة سعيدة</span></h3>
									<p class="testimonial-body arabic-text">
										"{{ $review->comment }}"
									</p>
									<div class="last-icon">
										<i class="fas fa-quote-right"></i>
									</div>
								</div>
							</div>
							@endforeach
						@else
							<div class="single-testimonial-slider">
								<div class="client-avater">
									<img src="assets/img/avaters/hijab.jpg" alt="عميلة سعيدة">
								</div>
								<div class="client-meta">
									<h3 class="arabic-text">سارة حكيم <span>عميلة دائمة</span></h3>
									<p class="testimonial-body arabic-text">
										"أشكر متجر ModaShop على الجودة العالية والخدمة المميزة. العبايات جميلة جداً والأسعار مناسبة"
									</p>
									<div class="last-icon">
										<i class="fas fa-quote-right"></i>
									</div>
								</div>
							</div>
							<div class="single-testimonial-slider">
								<div class="client-avater">
									<img src="assets/img/avaters/hijab2.jpg" alt="عميلة راضية">
								</div>
								<div class="client-meta">
									<h3 class="arabic-text">فاطمة أحمد <span>عميلة جديدة</span></h3>
									<p class="testimonial-body arabic-text">
										"تجربتي مع ModaShop كانت رائعة. الشحن سريع والمنتجات مطابقة للصور تماماً"
									</p>
									<div class="last-icon">
										<i class="fas fa-quote-right"></i>
									</div>
								</div>
							</div>
							<div class="single-testimonial-slider">
								<div class="client-avater">
									<img src="assets/img/avaters/hijab3.jpg" alt="عميلة مخلصة">
								</div>
								<div class="client-meta">
									<h3 class="arabic-text">مريم علي <span>عميلة منذ 3 سنوات</span></h3>
									<p class="testimonial-body arabic-text">
										"أشتري من ModaShop منذ سنوات وأشعر بالثقة دائماً. الجودة لا تتغير والأسعار معقولة"
									</p>
									<div class="last-icon">
										<i class="fas fa-quote-right"></i>
									</div>
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end testimonail-section -->

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

