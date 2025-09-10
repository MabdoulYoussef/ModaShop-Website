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
			background: #ceb57f;
			color: white;
			padding: 20px 30px;
			border-radius: 10px;
			margin-bottom: 30px;
			text-align: center;
		}

		.page-title h1 {
			font-size: 2.5rem;
			font-weight: 700;
			margin: 0;
		}

		.page-title p {
			font-size: 1.1rem;
			margin: 10px 0 0 0;
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

		/* Admin Login Icon */
		.admin-login {
			color: white;
			font-size: 1.2rem;
			margin: 0 10px;
			transition: all 0.3s ease;
			text-decoration: none;
			display: inline-block;
			padding: 8px;
			border-radius: 50%;
			background: rgba(255,255,255,0.1);
		}

		.admin-login:hover {
			color: #f0f0f0;
			background: rgba(255,255,255,0.2);
			transform: scale(1.1);
			text-decoration: none;
		}

		.admin-login i {
			display: block;
		}

		/* Mobile Responsive */
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
							<img src="{{ asset('assets/img/logo2.png') }}" alt="Moda2Shop">
						</a>
					</div>
				</div>
				<div class="col-lg-8 col-4">
					<!-- menu start -->
					<nav class="main-menu text-center">
						<ul class="d-flex justify-content-center">
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
						<a class="admin-login" href="{{ route('admin.login') }}" title="تسجيل دخول المدير"><i class="fas fa-user-shield"></i></a>
					</div>
				</div>
			</div>
			<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
			<div class="mobile-menu"></div>
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

</body>
</html>
