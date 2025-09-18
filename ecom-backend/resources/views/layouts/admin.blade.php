<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Moda2Shop Admin Panel - لوحة تحكم المدير">

	<!-- title -->
	<title>@yield('title', 'لوحة تحكم المدير') - Moda2Shop</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">

	<!-- Optimized fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700&display=swap" rel="stylesheet">

	<!-- fontawesome -->
	<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
	<!-- main style -->
	<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

	<!-- Admin Panel Specific Styles -->
	<style>
		body {
			font-family: 'Noto Sans Arabic', 'Open Sans', sans-serif;
			direction: rtl;
			text-align: right;
			background: #f8f9fa;
			color: #333;
		}

		/* Admin Header */
		.admin-header {
			background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%);
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
			padding: 15px 0;
			position: sticky;
			top: 0;
			z-index: 1000;
		}

		.admin-header .container {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.admin-logo {
			color: white;
			font-size: 1.5rem;
			font-weight: 700;
			text-decoration: none;
		}

		.admin-logo:hover {
			color: #f0f0f0;
			text-decoration: none;
		}

		.admin-nav {
			display: flex;
			gap: 20px;
			align-items: center;
		}

		.admin-nav a {
			color: white;
			text-decoration: none;
			padding: 8px 15px;
			border-radius: 5px;
			transition: all 0.3s ease;
			font-weight: 500;
		}

		.admin-nav a:hover {
			background: rgba(255,255,255,0.2);
			color: white;
			text-decoration: none;
		}

		.admin-nav a.active {
			background: rgba(255,255,255,0.3);
		}

		.admin-user {
			color: white;
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.admin-user .btn {
			background: rgba(255,255,255,0.2);
			border: 1px solid rgba(255,255,255,0.3);
			color: white;
			padding: 5px 15px;
			border-radius: 5px;
			text-decoration: none;
			font-size: 0.9rem;
		}

		.admin-user .btn:hover {
			background: rgba(255,255,255,0.3);
			color: white;
		}

		/* Admin Sidebar */
		.admin-sidebar {
			background: white;
			min-height: calc(100vh - 80px);
			box-shadow: 2px 0 10px rgba(0,0,0,0.1);
			padding: 20px 0;
		}

		.admin-sidebar .nav-link {
			color: #333;
			padding: 12px 20px;
			border-radius: 0;
			border-right: 3px solid transparent;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.admin-sidebar .nav-link:hover {
			background: #f8f9fa;
			color: #ceb57f;
			border-right-color: #ceb57f;
		}

		.admin-sidebar .nav-link.active {
			background: #ceb57f;
			color: white;
			border-right-color: #8b6f3f;
		}

		.admin-sidebar .nav-link i {
			width: 20px;
			text-align: center;
		}

		/* Main Content */
		.admin-content {
			background: white;
			min-height: calc(100vh - 80px);
			padding: 30px;
		}

		.admin-content .page-header {
			background: linear-gradient(135deg, #ceb57f 0%, #8b6f3f 100%);
			color: white;
			padding: 20px 30px;
			border-radius: 10px;
			margin-bottom: 30px;
		}

		.admin-content .page-header h1 {
			font-size: 2rem;
			font-weight: 700;
			margin: 0;
            color: white;

		}

		.admin-content .page-header p {
			font-size: 1rem;
			margin: 5px 0 0 0;
			opacity: 0.9;
            color: white;

		}

		/* Cards */
		.admin-card {
			background: white;
			border-radius: 10px;
			padding: 25px;
			margin-bottom: 25px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
			border: 1px solid #eee;
		}

		.admin-card .card-header {
			background: #f8f9fa;
			border-bottom: 1px solid #eee;
			padding: 15px 25px;
			margin: -25px -25px 20px -25px;
			border-radius: 10px 10px 0 0;
		}

		.admin-card .card-header h5 {
			color: #ceb57f;
			font-weight: 700;
			margin: 0;
		}

		/* Stats Cards */
		.stats-card {
			background: white;
			border-radius: 10px;
			padding: 25px;
			text-align: center;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
			border-left: 4px solid #ceb57f;
			transition: all 0.3s ease;
		}

		.stats-card:hover {
			transform: translateY(-2px);
			box-shadow: 0 5px 20px rgba(0,0,0,0.15);
		}

		.stats-card .stats-icon {
			font-size: 2.5rem;
			color: #ceb57f;
			margin-bottom: 15px;
		}

		.stats-card .stats-number {
			font-size: 2rem;
			font-weight: 700;
			color: #333;
			margin-bottom: 5px;
		}

		.stats-card .stats-label {
			color: #666;
			font-size: 0.9rem;
			font-weight: 500;
		}

		/* Buttons */
		.btn-admin {
			background: #ceb57f;
			color: white;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			font-weight: 600;
			transition: all 0.3s ease;
			text-decoration: none;
			display: inline-block;
		}

		.btn-admin:hover {
			background: #8b6f3f;
			color: white;
			text-decoration: none;
		}

		.btn-admin-outline {
			background: transparent;
			color: #ceb57f;
			border: 2px solid #ceb57f;
			padding: 8px 18px;
			border-radius: 5px;
			font-weight: 600;
			transition: all 0.3s ease;
			text-decoration: none;
			display: inline-block;
		}

		.btn-admin-outline:hover {
			background: #ceb57f;
			color: white;
			text-decoration: none;
		}

		/* Tables */
		.admin-table {
			background: white;
			border-radius: 10px;
			overflow: hidden;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
		}

		.admin-table table {
			margin: 0;
		}

		.admin-table thead th {
			background: #ceb57f;
			color: white;
			border: none;
			padding: 15px;
			font-weight: 600;
		}

		.admin-table tbody td {
			padding: 15px;
			border-bottom: 1px solid #eee;
			vertical-align: middle;
		}

		.admin-table tbody tr:hover {
			background: #f8f9fa;
		}

		/* Badges */
		.badge-admin {
			padding: 6px 12px;
			border-radius: 20px;
			font-size: 0.8rem;
			font-weight: 600;
		}

		.badge-pending { background: #ffc107; color: #000; }
		.badge-processing { background: #17a2b8; color: white; }
		.badge-shipped { background: #007bff; color: white; }
		.badge-delivered { background: #28a745; color: white; }
		.badge-cancelled { background: #dc3545; color: white; }

		/* Responsive */
		@media (max-width: 768px) {
			.admin-content {
				padding: 15px;
			}

			.admin-nav {
				flex-direction: column;
				gap: 10px;
			}

			.admin-sidebar {
				min-height: auto;
			}
		}

		/* Alerts */
		.alert-admin {
			border-radius: 10px;
			border: none;
			padding: 15px 20px;
			margin-bottom: 20px;
		}

		.alert-success {
			background: #d4edda;
			color: #155724;
		}

		.alert-danger {
			background: #f8d7da;
			color: #721c24;
		}

		.alert-warning {
			background: #fff3cd;
			color: #856404;
		}

		.alert-info {
			background: #d1ecf1;
			color: #0c5460;
		}

		/* Form Select Styling */
		.form-select {
			background: white;
			border: 2px solid #e9ecef;
			border-radius: 8px;
			padding: 12px 16px;
			font-size: 14px;
			font-weight: 500;
			color: #495057;
			transition: all 0.3s ease;
			box-shadow: 0 2px 4px rgba(0,0,0,0.05);
			appearance: none;
			background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
			background-position: right 12px center;
			background-repeat: no-repeat;
			background-size: 16px;
			padding-right: 40px;
		}

		.form-select:focus {
			border-color: #ceb57f;
			box-shadow: 0 0 0 3px rgba(206, 181, 127, 0.1);
			outline: none;
		}

		.form-select:hover {
			border-color: #ceb57f;
		}

		.form-select option {
			padding: 8px 12px;
			font-weight: 500;
		}

		.form-select option:checked {
			background: #ceb57f;
			color: white;
		}

		/* Form Control Admin (Alternative styling) */
		.form-control-admin {
			background: white;
			border: 2px solid #e9ecef;
			border-radius: 8px;
			padding: 12px 16px;
			font-size: 14px;
			font-weight: 500;
			color: #495057;
			transition: all 0.3s ease;
			box-shadow: 0 2px 4px rgba(0,0,0,0.05);
		}

		.form-control-admin:focus {
			border-color: #ceb57f;
			box-shadow: 0 0 0 3px rgba(206, 181, 127, 0.1);
			outline: none;
		}

		.form-control-admin:hover {
			border-color: #ceb57f;
		}

		/* Form Label Styling */
		.form-label {
			font-weight: 600;
			color: #495057;
			margin-bottom: 8px;
			font-size: 14px;
		}
	</style>
</head>
<body>
	<!-- Admin Header -->
	<div class="admin-header">
		<div class="container">
			<a href="{{ route('admin.dashboard') }}" class="admin-logo">
				<i class="fas fa-crown"></i> Moda2Shop Admin
			</a>

			<div class="admin-nav">
				<a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
					<i class="fas fa-tachometer-alt"></i> لوحة التحكم
				</a>
				<a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
					<i class="fas fa-box"></i> المنتجات
				</a>
				<a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
					<i class="fas fa-shopping-cart"></i> الطلبات
				</a>
				<a href="{{ route('admin.customers.index') }}" class="{{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
					<i class="fas fa-users"></i> العملاء
				</a>
				<a href="{{ route('home') }}" target="_blank">
					<i class="fas fa-external-link-alt"></i> الموقع
				</a>
			</div>

			<div class="admin-user">
				<span>{{ Auth::guard('admin')->user()->name }}</span>
				<form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
					@csrf
					<button type="submit" class="btn">
						<i class="fas fa-sign-out-alt"></i> خروج
					</button>
				</form>
			</div>
		</div>
	</div>

	<!-- Main Content -->
	<div class="container-fluid">
		<div class="row">
			<!-- Sidebar -->
			<div class="col-md-3 col-lg-2">
				<div class="admin-sidebar">
					<nav class="nav flex-column">
						<a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
							<i class="fas fa-tachometer-alt"></i> لوحة التحكم
						</a>
						<a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
							<i class="fas fa-box"></i> إدارة المنتجات
						</a>
						<a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
							<i class="fas fa-shopping-cart"></i> إدارة الطلبات
						</a>
						<a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
							<i class="fas fa-users"></i> إدارة العملاء
						</a>
						<a class="nav-link {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}" href="{{ route('admin.sales.index') }}">
							<i class="fas fa-chart-line"></i> التقارير والمبيعات
						</a>
						<a class="nav-link {{ request()->routeIs('admin.low-stock.*') ? 'active' : '' }}" href="{{ route('admin.low-stock.index') }}">
							<i class="fas fa-exclamation-triangle"></i> مخزون منخفض
						</a>
					</nav>
				</div>
			</div>

			<!-- Main Content Area -->
			<div class="col-md-9 col-lg-10">
				<div class="admin-content">
					<!-- Page Header -->
					<div class="page-header">
						<h1>@yield('page-title', 'لوحة التحكم')</h1>
						<p>@yield('page-description', 'مرحباً بك في لوحة تحكم Moda2Shop')</p>
					</div>

					<!-- Flash Messages -->
					@if(session('success'))
						<div class="alert alert-success alert-admin">
							<i class="fas fa-check-circle"></i> {{ session('success') }}
						</div>
					@endif

					@if(session('error'))
						<div class="alert alert-danger alert-admin">
							<i class="fas fa-exclamation-circle"></i> {{ session('error') }}
						</div>
					@endif

					@if(session('warning'))
						<div class="alert alert-warning alert-admin">
							<i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
						</div>
					@endif

					@if(session('info'))
						<div class="alert alert-info alert-admin">
							<i class="fas fa-info-circle"></i> {{ session('info') }}
						</div>
					@endif

					<!-- Page Content -->
					@yield('content')
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
	<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/main.js') }}"></script>

	@yield('scripts')
</body>
</html>
