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
	<link rel="shortcut icon" type="image/png" href="assets/img/logo.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=Playwrite+AU+QLD:wght@100..400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">

	<!-- Arabic fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

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
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->

						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="#">الرئيسية</a>
									<ul class="sub-menu">
										<li><a href="index.html">الصفحة الرئيسية</a></li>
										<li><a href="index_2.html">الصفحة المتحركة</a></li>
									</ul>
								</li>
								<li><a href="about.html">من نحن</a></li>
								<li><a href="#">الصفحات</a>
									<ul class="sub-menu">
										<li><a href="404.html">صفحة 404</a></li>
										<li><a href="about.html">من نحن</a></li>
										<li><a href="cart.html">سلة التسوق</a></li>
										<li><a href="checkout.html">إتمام الطلب</a></li>
										<li><a href="contact.html">اتصل بنا</a></li>
										<li><a href="news.html">الأخبار</a></li>
										<li><a href="shop.html">المتجر</a></li>
									</ul>
								</li>
								<li><a href="news.html">الأخبار</a>
									<ul class="sub-menu">
										<li><a href="news.html">الأخبار</a></li>
										<li><a href="single-news.html">خبر واحد</a></li>
									</ul>
								</li>
								<li><a href="contact.html">اتصل بنا</a></li>
								<li><a href="shop.html">المتجر</a>
									<ul class="sub-menu">
										<li><a href="shop.html">المتجر</a></li>
										<li><a href="checkout.html">إتمام الطلب</a></li>
										<li><a href="single-product.html">منتج واحد</a></li>
										<li><a href="cart.html">سلة التسوق</a></li>
									</ul>
								</li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="cart.html"><i class="fas fa-shopping-cart"></i></a>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
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
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>

</body>
</html>

