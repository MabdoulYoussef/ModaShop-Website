<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Moda2Shop - متجر ملابس عربية عالية الجودة">

	<!-- title -->
	<title>Moda2Shop - متجر الملابس العربية</title>

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
	<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

	<!-- Shop Layout Specific Styles -->
	<style>
		body {
			font-family: 'Noto Sans Arabic', 'Open Sans', sans-serif;
			direction: rtl;
			text-align: right;
			background: white;
			color: #333;
		}

		.arabic-text {
			font-family: 'Noto Sans Arabic', sans-serif;
			direction: rtl;
		}

		/* Header Styles - Golden background */
		.top-header-area {
			background: #ceb57f;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
		}

		.main-menu ul li a {
			color: white !important;
			font-weight: 600;
		}

		.main-menu ul li a:hover {
			color: #f0f0f0 !important;
		}

		/* Center navigation menu */
		.main-menu {
			text-align: center;
		}

		.main-menu ul {
			display: flex;
			justify-content: center;
			align-items: center;
			list-style: none;
			margin: 0;
			padding: 0;
		}

		.main-menu ul li {
			margin: 0 15px;
		}

		.main-menu ul li a {
			text-decoration: none;
			padding: 10px 15px;
			display: block;
		}

		/* Main Content Area */
		.shop-content {
			background: white;
			color: #333;
			margin: 20px auto;
			padding: 40px;
			padding-top: 60px;
			border-radius: 10px;
			min-height: 80vh;
		}

		/* Page Title */
		.page-title {
			text-align: center;
			margin: 5px 0 10px 0;
			padding: 5px 2px;
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

		/* Product/Category Cards */
		.shop-card {
			background: white;
			border-radius: 10px;
			padding: 20px;
			margin-bottom: 30px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
			transition: all 0.3s ease;
			border: 1px solid #eee;
		}

		.shop-card:hover {
			transform: translateY(-2px);
			box-shadow: 0 5px 20px rgba(0,0,0,0.15);
		}

		.shop-card h3 {
			color: #ceb57f;
			font-weight: 700;
			margin-bottom: 15px;
		}

		.shop-card .price {
			color: #8b6f3f;
			font-weight: 600;
			font-size: 1.2rem;
		}

		/* Buttons */
		.shop-btn {
			background: #ceb57f;
			color: white;
			border: none;
			padding: 12px 25px;
			border-radius: 5px;
			font-weight: 600;
			transition: all 0.3s ease;
			text-decoration: none;
			display: inline-block;
		}

		.shop-btn:hover {
			background: #8b6f3f;
			color: white;
		}

		/* Breadcrumb */
		.breadcrumb-nav {
			background: white;
			color: #333;
			padding: 15px 25px;
			border-radius: 5px;
			margin-bottom: 20px;
		}

		.breadcrumb-nav a {
			color: #ceb57f;
			text-decoration: none;
			font-weight: 600;
		}

		.breadcrumb-nav a:hover {
			color: #8b6f3f;
		}

		/* Footer */
		.shop-footer {
			background: white;
			color: #333;
			margin-top: 40px;
			padding: 30px;
			text-align: center;
			border-radius: 10px;
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
			color: #ceb57f;
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

		/* Large Desktop Monitors: 1440px+ */
		@media (min-width: 1440px) {
			.shop-content {
				margin: 30px auto;
				padding: 60px;
				max-width: 1400px;
			}

			.page-title h1 {
				font-size: 3rem;
			}

			.main-menu ul li {
				margin: 0 25px;
			}

			.main-menu ul li a {
				padding: 15px 20px;
				font-size: 1.1rem;
			}
		}


		/* Large Laptops and Desktops: 1440px - 1920px */
		@media (min-width: 1440px) and (max-width: 1919px) {
			.shop-content {
				margin: 12px auto;
				padding: 25px;
				max-width: 1300px;
			}

			.page-title h1 {
				font-size: 2.3rem;
			}

			.main-menu ul li {
				margin: 0 18px;
			}

			.main-menu ul li a {
				padding: 8px 14px;
				font-size: 1.1rem;
			}

			.header-icons a {
				width: 38px;
				height: 38px;
				font-size: 1.2rem;
			}

			.logo img {
				max-height: 55px;
			}

			.top-header-area .row {
				padding: 10px 0;
			}
		}

		/* MacBook Pro 15" and Medium Laptops: 1200px - 1366px */
		@media (min-width: 1200px) and (max-width: 1366px) {
			.shop-content {
				margin: 15px auto;
				padding: 30px;
				max-width: 1100px;
			}

			.page-title h1 {
				font-size: 2.2rem;
			}

			.main-menu ul li {
				margin: 0 12px;
			}

			.main-menu ul li a {
				padding: 8px 12px;
				font-size: 0.9rem;
			}
		}

		/* Larger Laptops: 1367px - 1440px */
		@media (min-width: 1367px) and (max-width: 1440px) {
			.shop-content {
				margin: 18px auto;
				padding: 35px;
				max-width: 1200px;
			}

			.page-title h1 {
				font-size: 2.4rem;
			}

			.main-menu ul li {
				margin: 0 15px;
			}

			.main-menu ul li a {
				padding: 10px 15px;
				font-size: 0.95rem;
			}

			.header-icons a {
				width: 35px;
				height: 35px;
				font-size: 1.1rem;
			}
		}

		/* MacBook Air/Pro 13" and Small Laptops: 1024px - 1200px */
		@media (min-width: 1024px) and (max-width: 1200px) {
			.shop-content {
				margin: 15px auto;
				padding: 25px;
				max-width: 980px;
			}

			.page-title h1 {
				font-size: 2rem;
			}

			.main-menu ul li {
				margin: 0 10px;
			}

			.main-menu ul li a {
				padding: 6px 10px;
				font-size: 0.85rem;
			}

			.header-icons a {
				width: 35px;
				height: 35px;
				font-size: 1.1rem;
			}
		}

		/* Desktop: 992px - 1024px */
		@media (min-width: 992px) and (max-width: 1024px) {
			.shop-content {
				margin: 20px auto;
				padding: 35px;
				max-width: 960px;
			}

			.page-title h1 {
				font-size: 2.3rem;
			}

			.main-menu ul li {
				margin: 0 12px;
			}

			.main-menu ul li a {
				padding: 10px 12px;
				font-size: 0.9rem;
			}
		}

		/* Tablet Responsive */
		@media (max-width: 768px) {
			.shop-content {
				margin: 10px;
				padding: 20px;
			}

			.page-title h1 {
				font-size: 2rem;
			}

			.admin-login {
				margin: 0 5px;
				padding: 6px;
			}

			.main-menu ul {
				flex-direction: column;
				gap: 10px;
			}

			.main-menu ul li {
				margin: 0;
			}
		}

		/* Mobile Responsive */
		@media (max-width: 576px) {
			.page-title {
				margin: 20px 0 40px 0;
				padding: 30px 15px;
			}

			.page-title h1 {
				font-size: 1.8rem;
			}

			.header-icons {
				gap: 5px;
			}

			.header-icons a {
				width: 30px;
				height: 30px;
				font-size: 1rem;
			}
		}

		/* Product Card Styling - Responsive Design */
		.shop-card {
			width: 100% !important;
			max-width: 350px !important;
			height: auto !important;
			min-height: 550px !important;
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

		.shop-card:hover {
			transform: translateY(-5px) !important;
			box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
		}

		.shop-card .product-image {
			width: 100% !important;
			height: 400px !important;
			overflow: hidden !important;
			position: relative !important;
		}

		.shop-card .product-image img {
			width: 100% !important;
			height: 100% !important;
			object-fit: cover !important;
			transition: transform 0.3s ease !important;
		}

		.shop-card:hover .product-image img {
			transform: scale(1.05) !important;
		}

		.shop-card h3 {
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

		.shop-card .price {
			padding: 0 20px 15px 20px !important;
			font-size: 1rem !important;
			color: #ceb57f !important;
			font-weight: 700 !important;
			margin: 0 !important;
			text-align: center !important;
		}

		.shop-card .shop-btn {
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

		.shop-card .shop-btn:hover {
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
			.shop-card {
				width: 95% !important;
				max-width: 420px !important;
				height: auto !important;
				min-height: 520px !important;
			}

			.shop-card .product-image {
				height: 370px !important;
			}

			.shop-card h3 {
				font-size: 1rem !important;
				height: 50px !important;
				padding: 10px 15px 5px 15px !important;
			}

			.shop-card .price {
				padding: 0 15px 10px 15px !important;
				font-size: 0.9rem !important;
			}

			.shop-card .shop-btn {
				margin: 0 15px 15px 15px !important;
				padding: 10px 15px !important;
				font-size: 0.8rem !important;
			}
		}

		@media (max-width: 480px) {
			.shop-card {
				width: 98% !important;
				max-width: 400px !important;
				height: auto !important;
				min-height: 470px !important;
			}

			.shop-card .product-image {
				height: 320px !important;
			}

			.shop-card h3 {
				font-size: 0.9rem !important;
				height: 45px !important;
				padding: 8px 12px 5px 12px !important;
			}

			.shop-card .price {
				padding: 0 12px 8px 12px !important;
				font-size: 0.85rem !important;
			}

			.shop-card .shop-btn {
				margin: 0 12px 12px 12px !important;
				padding: 8px 12px !important;
				font-size: 0.75rem !important;
			}
		}

		/* Fix header overlap issue on large screens */
		body {
			padding-top: 120px; /* Adjust based on your header height */
		}

		@media (max-width: 991px) {
			body {
				padding-top: 90px; /* Slightly smaller for tablets */
			}
		}

		/* Improve layout centering on 1920×1080 */
		@media (min-width: 1600px) {
			.container {
				max-width: 1400px;
			}
		}

		/* Responsive Design for Product Cards */

		/* Desktop (1200px+) */
		@media (min-width: 1200px) {
			.shop-card {
				max-width: 380px !important;
				min-height: 580px !important;
			}

			.shop-card .product-image {
				height: 450px !important;
			}
		}

		/* Tablet (768px - 1199px) */
		@media (min-width: 768px) and (max-width: 1199px) {
			.shop-card {
				max-width: 350px !important;
				min-height: 550px !important;
			}

			.shop-card .product-image {
				height: 400px !important;
			}
		}

		/* Mobile (480px - 767px) */
		@media (min-width: 480px) and (max-width: 767px) {
			.shop-card {
				max-width: 320px !important;
				min-height: 500px !important;
			}

			.shop-card .product-image {
				height: 350px !important;
			}
		}

		/* Small Mobile (320px - 479px) */
		@media (max-width: 479px) {
			.shop-card {
				max-width: 300px !important;
				min-height: 480px !important;
			}

			.shop-card .product-image {
				height: 320px !important;
			}
		}
	</style>

	@yield('styles')
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
							<img src="{{ asset('assets/img/logo2.png') }}" alt="Moda2Shop">
						</a>
					</div>
				</div>
				<div class="col-lg-8 col-4">
					<!-- menu start -->
					<nav class="main-menu text-center">
						<ul class="d-flex justify-content-center" id="main-nav">
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
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>البحث عن:</h3>
							<input type="text" placeholder="الكلمات المفتاحية">
							<button type="submit">بحث <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->

	<!-- Main Content -->
	<div class="container">
		<div class="shop-content">
			@yield('content')
		</div>
	</div>

	<!-- Footer -->
	<div class="container">
		<div class="shop-footer">
			<div class="row">
				<div class="col-12">
					<p class="arabic-text">جميع الحقوق محفوظة &copy; 2024 - <a href="{{ route('home') }}" style="color: #ceb57f;">Moda2Shop</a><br>
						متجر الملابس العربية العصرية
					</p>
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank" style="color: #ceb57f;"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank" style="color: #ceb57f;"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank" style="color: #ceb57f;"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank" style="color: #ceb57f;"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank" style="color: #ceb57f;"><i class="fab fa-youtube"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

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
