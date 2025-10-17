<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ModaShop - متجر ملابس عربية عالية الجودة">

	<!-- title -->
	<title>ModaShop - متجر الملابس العربية</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&family=Cairo:wght@400;700&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=Playwrite+AU+QLD:wght@100..400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">

	<!-- Arabic fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
	<!-- main style -->
	<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
	<!-- responsive -->

	<!-- Basic RTL Support -->
	<style>
		body {
			font-family: 'Noto Sans Arabic', 'Open Sans', sans-serif;
			direction: rtl;
			text-align: right;
		}

		.arabic-text {
			font-family: 'Noto Sans Arabic', sans-serif;
			direction: rtl;
		}

		/* Header Icons Container */
		.header-icons {
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 7px;
		}

		/* Common styles for all header icons */
		.header-icons a {
			color: white;
			font-size: 1.2rem;
			transition: all 0.3s ease;
			text-decoration: none;
			display: flex;
			align-items: center;
			justify-content: center;
			width: 40px;
			height: 40px;
			border-radius: 50%;
			background: rgba(255,255,255,0.1);
		}

		.header-icons a:hover {
			color: #f0f0f0;
			background: rgba(255,255,255,0.2);
			transform: scale(1.1);
			text-decoration: none;
		}

		.header-icons a i {
			display: block;
			line-height: 1;
		}

		/* Specific icon styles */
		.shopping-cart,
		.search-bar-icon,
		.tracking-icon,
		.admin-login {
			/* Inherits from .header-icons a */
		}

		.hero-text-tablecell .subtitle {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		/* Mobile responsive */
		@media (max-width: 768px) {
			.hero-text-tablecell h1 {
				font-size: 2.5rem;
			}

			.hero-text-tablecell .subtitle {
				font-size: 1.2rem;
			}
		}

		/* Tablet responsive */
		@media (min-width: 769px) and (max-width: 1024px) {
			.hero-text-tablecell h1 {
				font-size: 2.8rem;
			}

			.hero-text-tablecell .subtitle {
				font-size: 1.1rem;
			}

			.main-menu ul li {
				margin: 0 10px;
			}

			.main-menu ul li a {
				padding: 10px 12px;
				font-size: 0.95rem;
			}
		}

		/* 15.6" Laptop specific fixes */
		@media (min-width: 1366px) and (max-width: 1920px) {
			.hero-text-tablecell {
				padding: 0 40px;
			}

			.hero-text-tablecell h1 {
				font-size: 2.8rem;
				line-height: 1.3;
			}

			.hero-text-tablecell .subtitle {
				font-size: 1.1rem;
				margin-bottom: 1.5rem;
			}

			.hero-btns {
				margin-top: 2rem;
			}

			.hero-btns a {
				padding: 12px 25px;
				font-size: 1rem;
				margin: 0 8px;
			}

			/* Ensure proper spacing for features */
			.list-box {
				margin-bottom: 20px;
			}

			.list-box .content h3 {
				font-size: 1.1rem;
			}

			.list-box .content p {
				font-size: 0.9rem;
			}
		}

		/* Center main menu in header */
		.main-menu {
			display: flex;
			justify-content: center;
		}
		.main-menu ul {
			display: flex;
			justify-content: center;
			width: 100%;
			padding: 0;
			margin: 0;
		}
		.main-menu ul li {
			float: none;
		}

		/* Mobile Hamburger Menu Styles */
		.mobile-menu-toggle {
			display: none;
		}

		.hamburger-btn {
			background: none;
			border: none;
			cursor: pointer;
			padding: 8px;
			display: flex;
			flex-direction: column;
			justify-content: space-around;
			width: 30px;
			height: 30px;
		}

		.hamburger-btn span {
			display: block;
			height: 3px;
			width: 100%;
			background: white;
			border-radius: 2px;
			transition: all 0.3s ease;
		}

		.hamburger-btn.active span:nth-child(1) {
			transform: rotate(45deg) translate(6px, 6px);
		}

		.hamburger-btn.active span:nth-child(2) {
			opacity: 0;
		}

		.hamburger-btn.active span:nth-child(3) {
			transform: rotate(-45deg) translate(6px, -6px);
		}

		.mobile-menu {
			display: none;
			background: rgba(0, 0, 0, 0.95);
			position: absolute;
			top: 100%;
			left: 0;
			right: 0;
			z-index: 1000;
			padding: 20px 0;
		}

		.mobile-menu ul {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		.mobile-menu ul li {
			text-align: center;
			padding: 15px 0;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
		}

		.mobile-menu ul li:last-child {
			border-bottom: none;
		}

		.mobile-menu ul li a {
			color: white;
			text-decoration: none;
			font-size: 1.2rem;
			font-weight: 500;
			transition: color 0.3s ease;
		}

		.mobile-menu ul li a:hover {
			color: #ad8f53;
		}

		/* Responsive breakpoints for hamburger menu */
		@media (max-width: 991px) {
			.mobile-menu-toggle {
				display: block;
			}

			.main-menu {
				display: none;
			}

			.header-icons {
				display: none;
			}
		}

		@media (min-width: 992px) {
			.mobile-menu {
				display: none !important;
			}
		}

		/* Product Card Styling - Same as Product Page */
		.single-product-item {
			width: 320px !important;
			height: auto !important;
			min-height: 580px !important;
			margin: 0 auto 30px auto !important;
			background: white !important;
			border-radius: 15px !important;
			box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
			transition: all 0.3s ease !important;
			overflow: hidden !important;
			position: relative !important;
			display: flex !important;
			flex-direction: column !important;
		}

		.single-product-item:hover {
			transform: translateY(-5px) !important;
			box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
		}

		.single-product-item .product-image {
			width: 100% !important;
			height: 450px !important;
			overflow: hidden !important;
			position: relative !important;
		}

		.single-product-item .product-image img {
			width: 100% !important;
			height: 100% !important;
			object-fit: cover !important;
			transition: transform 0.3s ease !important;
		}

		.single-product-item:hover .product-image img {
			transform: scale(1.05) !important;
		}

		.single-product-item h3 {
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

		.single-product-item .product-price {
			padding: 0 20px 15px 20px !important;
			font-size: 1rem !important;
			color: #ceb57f !important;
			font-weight: 700 !important;
			margin: 0 !important;
			text-align: center !important;
		}

		.single-product-item .cart-btn {
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
		}

		.single-product-item .cart-btn:hover {
			background: linear-gradient(45deg, #ad8f53, #ceb57f) !important;
			transform: translateY(-2px) !important;
			box-shadow: 0 5px 15px rgba(206, 181, 127, 0.4) !important;
			color: white !important;
			text-decoration: none !important;
		}

		/* Center product cards in their containers */
		.col-lg-4.col-md-6.text-center {
			display: flex !important;
			justify-content: center !important;
			margin-bottom: 30px !important;
		}

		/* Responsive adjustments */
		@media (max-width: 768px) {
			.single-product-item {
				width: 95% !important;
				max-width: 420px !important;
				height: auto !important;
				min-height: 520px !important;
			}

			.single-product-item .product-image {
				height: 370px !important;
			}

			.single-product-item h3 {
				font-size: 1rem !important;
				height: 50px !important;
				padding: 10px 15px 5px 15px !important;
			}

			.single-product-item .product-price {
				padding: 0 15px 10px 15px !important;
				font-size: 0.9rem !important;
			}

			.single-product-item .cart-btn {
				margin: 0 15px 15px 15px !important;
				padding: 10px 15px !important;
				font-size: 0.8rem !important;
			}
		}

		@media (max-width: 480px) {
			.single-product-item {
				width: 98% !important;
				max-width: 400px !important;
				height: auto !important;
				min-height: 470px !important;
			}

			.single-product-item .product-image {
				height: 320px !important;
			}

			.single-product-item h3 {
				font-size: 0.9rem !important;
				height: 45px !important;
				padding: 8px 12px 5px 12px !important;
			}

			.single-product-item .product-price {
				padding: 0 12px 8px 12px !important;
				font-size: 0.85rem !important;
			}

			.single-product-item .cart-btn {
				margin: 0 12px 12px 12px !important;
				padding: 8px 12px !important;
				font-size: 0.75rem !important;
			}
		}

		/* FORCE PRODUCT CARD STYLING - MAXIMUM SPECIFICITY */
		.product-section .single-product-item {
			width: 320px !important;
			height: auto !important;
			min-height: 580px !important;
			margin: 0 auto 30px auto !important;
			background: white !important;
			border-radius: 15px !important;
			box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
			transition: all 0.3s ease !important;
			overflow: hidden !important;
			position: relative !important;
			display: flex !important;
			flex-direction: column !important;
		}

		/* MOBILE OVERRIDE FOR PRODUCT SECTION */
		@media (max-width: 768px) {
			.product-section .single-product-item {
				width: 95% !important;
				max-width: 420px !important;
			}
		}

		@media (max-width: 480px) {
			.product-section .single-product-item {
				width: 98% !important;
				max-width: 400px !important;
			}
		}

		.product-section .single-product-item .product-image {
			width: 100% !important;
			height: 450px !important;
			overflow: hidden !important;
			position: relative !important;
		}

		.product-section .single-product-item .product-image img {
			width: 100% !important;
			height: 100% !important;
			object-fit: cover !important;
			transition: transform 0.3s ease !important;
		}

		.product-section .single-product-item h3 {
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

		.product-section .single-product-item .product-price {
			padding: 0 20px 15px 20px !important;
			font-size: 1rem !important;
			color: #ceb57f !important;
			font-weight: 700 !important;
			margin: 0 !important;
			text-align: center !important;
		}

		.product-section .single-product-item .cart-btn {
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
		}

		.product-section .col-lg-4.col-md-6.text-center {
			display: flex !important;
			justify-content: center !important;
			margin-bottom: 30px !important;
		}
	</style>

</head>
<body>

	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-2 col-4 text-center">
					<!-- logo -->
					<div class="site-logo">
						<a href="{{ route('home') }}">
							<img src="{{ asset('assets/img/logo2.png') }}" alt="ModaShop">
						</a>
					</div>
				</div>
				<div class="col-lg-8 col-4">
					<!-- menu start -->
					<nav class="main-menu">
						<ul id="main-nav">
							<li><a href="{{ route('home') }}">الرئيسية</a></li>
							<li><a href="{{ route('about') }}">من نحن</a></li>
							<li><a href="{{ route('products.index') }}">منتجاتنا</a></li>
							<li><a href="{{ route('categories.index') }}">فئات</a></li>
							<li><a href="{{ route('contact') }}">اتصل بنا</a></li>
						</ul>
					</nav>
					<!-- menu end -->
				</div>
				<div class="col-lg-2 col-4 text-center">
					<!-- header icons -->
					<div class="header-icons">
						<a class="shopping-cart" href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i></a>
						<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<a class="tracking-icon" href="{{ route('tracking.index') }}" title="تتبع الطلب"><i class="fas fa-truck"></i></a>
						<a class="admin-login" href="{{ route('admin.login') }}" title="تسجيل دخول المدير"><i class="fas fa-user-shield"></i></a>
					</div>
					<!-- Mobile hamburger menu button -->
					<div class="mobile-menu-toggle">
						<button class="hamburger-btn" onclick="toggleMobileMenu()">
							<span></span>
							<span></span>
							<span></span>
						</button>
					</div>
				</div>
			</div>
			<!-- Mobile menu -->
			<div class="mobile-menu" id="mobile-menu">
				<ul>
					<li><a href="{{ route('home') }}">الرئيسية</a></li>
					<li><a href="{{ route('about') }}">من نحن</a></li>
					<li><a href="{{ route('products.index') }}">منتجاتنا</a></li>
					<li><a href="{{ route('categories.index') }}">فئات</a></li>
					<li><a href="{{ route('contact') }}">اتصل بنا</a></li>
				</ul>
			</div>
			<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-times"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<div class="search-header">
								<h3>ابحث عن منتجاتك المفضلة</h3>
								<p>اكتشف مجموعة واسعة من الملابس العربية العصرية</p>
							</div>
							<form action="{{ route('products.search') }}" method="GET" class="search-form">
								<div class="search-input-group">
									<input type="text" name="q" placeholder="مثال: فستان نسائي أنيق" class="search-input" autocomplete="off">
									<button type="submit" class="search-btn">
										<i class="fas fa-search"></i>
										<span>بحث</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->





    @yield('content')





<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title arabic-text">من نحن</h2>
						<p class="arabic-text">متجر ModaShop متخصص في الملابس العربية العصرية والأنيقة. نقدم أفضل الجودات والأسعار المناسبة لعملائنا الكرام.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title arabic-text">تواصل معنا</h2>
						<ul>
							<li class="arabic-text">شارع الملك فهد، الرياض، المملكة العربية السعودية</li>
							<li>support@modashop.com</li>
							<li>+966 50 123 4567</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title arabic-text">الصفحات</h2>
						<ul>
							<li><a href="index.html" class="arabic-text">الرئيسية</a></li>
							<li><a href="about.html" class="arabic-text">من نحن</a></li>
							<li><a href="services.html" class="arabic-text">المتجر</a></li>
							<li><a href="news.html" class="arabic-text">الأخبار</a></li>
							<li><a href="contact.html" class="arabic-text">اتصل بنا</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title arabic-text">اشترك معنا</h2>
						<p class="arabic-text">اشترك في قائمتنا البريدية للحصول على أحدث التحديثات والعروض.</p>
						<form action="index.html">
							<input type="email" placeholder="البريد الإلكتروني">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p class="arabic-text">جميع الحقوق محفوظة &copy; 2024 - <a href="#">ModaShop</a><br>
						متجر الملابس العربية العصرية
					</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-youtube"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->

	<!-- jquery -->
	<script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
	<!-- bootstrap -->
	<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<!-- count down -->
	<script src="{{ asset('assets/js/jquery.countdown.js') }}"></script>
	<!-- isotope -->
	<script src="{{ asset('assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
	<!-- waypoints -->
	<script src="{{ asset('assets/js/waypoints.js') }}"></script>
	<!-- owl carousel -->
	<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
	<!-- magnific popup -->
	<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
	<!-- mean menu -->
	<script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
	<!-- sticker js -->
	<script src="{{ asset('assets/js/sticker.js') }}"></script>
	<!-- main js -->
	<script src="{{ asset('assets/js/main.js') }}"></script>

	<!-- Mobile Menu Toggle Script -->
	<script>
		function toggleMobileMenu() {
			const mobileMenu = document.getElementById('mobile-menu');
			const hamburgerBtn = document.querySelector('.hamburger-btn');

			if (mobileMenu.style.display === 'block') {
				mobileMenu.style.display = 'none';
				hamburgerBtn.classList.remove('active');
			} else {
				mobileMenu.style.display = 'block';
				hamburgerBtn.classList.add('active');
			}
		}

		// Close mobile menu when clicking outside
		document.addEventListener('click', function(event) {
			const mobileMenu = document.getElementById('mobile-menu');
			const hamburgerBtn = document.querySelector('.hamburger-btn');
			const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');

			if (mobileMenu.style.display === 'block' &&
				!mobileMenu.contains(event.target) &&
				!mobileMenuToggle.contains(event.target)) {
				mobileMenu.style.display = 'none';
				hamburgerBtn.classList.remove('active');
			}
		});

		// Close mobile menu when window is resized to desktop
		window.addEventListener('resize', function() {
			if (window.innerWidth >= 992) {
				const mobileMenu = document.getElementById('mobile-menu');
				const hamburgerBtn = document.querySelector('.hamburger-btn');
				mobileMenu.style.display = 'none';
				hamburgerBtn.classList.remove('active');
			}
		});
	</script>

	<!-- Modern Search Bar Styles -->
	<style>
	/* Modern Search Bar Styles */
	.search-area {
		position: fixed !important;
		top: 0 !important;
		left: 0 !important;
		width: 100% !important;
		height: 100vh !important;
		background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 249, 250, 0.95)) !important;
		backdrop-filter: blur(15px) !important;
		z-index: 9999 !important;
		display: flex !important;
		align-items: center !important;
		justify-content: center !important;
		opacity: 0;
		visibility: hidden;
		transition: all 0.3s ease;
		margin: 0 !important;
		padding: 0 !important;
	}

	.search-area.search-active {
		opacity: 1;
		visibility: visible;
	}

	.close-btn {
		position: absolute;
		top: 30px;
		right: 30px;
		color: #000000;
		font-size: 2rem;
		cursor: pointer;
		transition: all 0.3s ease;
		z-index: 10000;
	}

	.close-btn:hover {
		color: #000000;
		transform: rotate(90deg);
	}

	.search-bar-tablecell {
		text-align: center !important;
		max-width: 800px !important;
		width: 100% !important;
		padding: 0 20px !important;
		margin: 0 !important;
		position: relative !important;
		top: auto !important;
		transform: none !important;
	}

	.search-header h3 {
		font-size: 3rem;
		font-weight: 700;
		color: #2c3e50;
		margin-bottom: 1rem;
		text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
	}

	.search-header p {
		font-size: 1.2rem;
		color: #666;
		margin-bottom: 3rem;
		font-weight: 300;
	}

	.search-input-group {
		position: relative;
		margin-bottom: 2rem;
	}

	.search-input {
		width: 100%;
		padding: 25px 30px;
		font-size: 0.7rem;
		border: none;
		border-radius: 50px;
		background: rgba(255,255,255,0.9);
		color: #333 !important;
		backdrop-filter: blur(10px);
		border: 2px solid rgba(206, 181, 127, 0.3);
		transition: all 0.3s ease;
		text-align: center;
		box-shadow: 0 4px 20px rgba(0,0,0,0.1);
		height: 70px;
	}

	.search-input:focus {
		outline: none;
		border-color: #ceb57f;
		background: rgba(255,255,255,0.95);
		box-shadow: 0 0 30px rgba(206, 181, 127, 0.3);
	}

	.search-input::placeholder {
		color: #999 !important;
		font-weight: 300;
	}

	.search-btn {
		position: absolute;
		right: 5px;
		top: 50%;
		transform: translateY(-50%);
		background: linear-gradient(45deg, #ceb57f, #ad8f53);
		border: none;
		padding: 15px 25px;
		border-radius: 45px;
		color: #fff;
		font-weight: 600;
		cursor: pointer;
		transition: all 0.3s ease;
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.search-btn:hover {
		background: linear-gradient(45deg, #ad8f53, #ceb57f);
		transform: translateY(-50%) scale(1.05);
		box-shadow: 0 5px 15px rgba(206, 181, 127, 0.4);
	}


	/* Override any existing search area styles */
	.search-area .search-bar {
		height: auto !important;
		display: block !important;
		width: 100% !important;
		margin: 0 !important;
		padding: 0 !important;
	}

	.search-area .search-bar div {
		height: auto !important;
		display: block !important;
	}

	.search-area div {
		height: auto !important;
	}

	/* Ensure proper centering */
	.search-area .container {
		height: 100vh !important;
		display: flex !important;
		align-items: center !important;
		justify-content: center !important;
		margin: 0 !important;
		padding: 0 !important;
	}

	.search-area .row {
		height: auto !important;
		margin: 0 !important;
		display: flex !important;
		align-items: center !important;
		justify-content: center !important;
	}

	.search-area .col-lg-12 {
		height: auto !important;
		margin: 0 !important;
		padding: 0 !important;
	}

	/* Responsive Design */
	@media (max-width: 768px) {
		.search-header h3 {
			font-size: 2rem;
		}

		.search-header p {
			font-size: 1rem;
		}

		.search-input {
			font-size: 1.1rem;
			padding: 15px 20px;
		}

		.search-btn {
			padding: 12px 20px;
			font-size: 0.9rem;
		}

		.close-btn {
			top: 20px;
			right: 20px;
			font-size: 1.5rem;
            color: #000000;
		}
	}

	@media (max-width: 576px) {
		.search-header h3 {
			font-size: 1.8rem;
		}

		.search-input {
			font-size: 1rem;
			padding: 12px 15px;
		}

		.search-btn {
			padding: 10px 15px;
			font-size: 0.8rem;
		}

		.tag {
			font-size: 0.8rem;
			padding: 6px 12px;
		}
	}
	</style>

	<!-- Search Bar JavaScript -->
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Search functionality
		const searchIcon = document.querySelector('.search-bar-icon');
		const searchArea = document.querySelector('.search-area');
		const closeBtn = document.querySelector('.close-btn');
		const searchInput = document.querySelector('.search-input');

		// Open search
		searchIcon.addEventListener('click', function(e) {
			e.preventDefault();
			searchArea.classList.add('search-active');
			document.body.style.overflow = 'hidden';
			setTimeout(() => {
				searchInput.focus();
			}, 300);
		});

		// Close search
		closeBtn.addEventListener('click', function() {
			searchArea.classList.remove('search-active');
			document.body.style.overflow = 'auto';
		});

		// Close on escape key
		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape' && searchArea.classList.contains('search-active')) {
				searchArea.classList.remove('search-active');
				document.body.style.overflow = 'auto';
			}
		});

		// Close on background click
		searchArea.addEventListener('click', function(e) {
			if (e.target === searchArea) {
				searchArea.classList.remove('search-active');
				document.body.style.overflow = 'auto';
			}
		});

		// Auto-submit on Enter
		searchInput.addEventListener('keypress', function(e) {
			if (e.key === 'Enter') {
				e.preventDefault();
				this.closest('form').submit();
			}
		});
	});
	</script>

</body>
</html>
