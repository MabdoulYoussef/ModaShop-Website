<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/featured', [ProductController::class, 'featured'])->name('products.featured');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/slug/{slug}', [CategoryController::class, 'showBySlug'])->name('categories.showBySlug');

// Cart routes (no authentication required - session-based)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addItem'])->name('cart.add');
Route::put('/cart/{itemId}', [CartController::class, 'updateItem'])->name('cart.update');
Route::delete('/cart/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

// Guest checkout routes (no authentication required)
Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');

// Order routes (public - customers can view orders by phone)
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

// Review routes (no authentication required - customers provide info)
Route::get('/products/{productId}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/products/{productId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Admin authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
});

// Admin routes (protected by admin authentication)
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Admin logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/change-password', [AuthController::class, 'showChangePassword'])->name('profile.change-password');
    Route::put('/profile/change-password', [AuthController::class, 'changePassword'])->name('profile.change-password.update');

    // Orders management
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{id}', [AdminController::class, 'showOrder'])->name('orders.show');
    Route::put('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.update-status');

    // Customers management (instead of users)
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers.index');
    Route::get('/customers/{id}', [AdminController::class, 'showCustomer'])->name('customers.show');

    // Products management
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Categories management
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Reviews management
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews.index');
    Route::put('/reviews/{id}/status', [AdminController::class, 'updateReviewStatus'])->name('reviews.update-status');

    // Sales and analytics
    Route::get('/sales', [AdminController::class, 'sales'])->name('sales.index');
    Route::get('/low-stock', [AdminController::class, 'lowStock'])->name('low-stock.index');
});
