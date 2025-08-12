<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;

class HomeController extends Controller
{
    // Homepage with featured products and categories
    public function index()
    {
        $featuredProducts = Product::where('stock', '>', 0)
                                  ->inRandomOrder()
                                  ->take(6)
                                  ->with('category')
                                  ->get();

        $categories = Category::withCount('products')
                             ->orderBy('products_count', 'desc')
                             ->take(8)
                             ->get();

        $latestProducts = Product::where('stock', '>', 0)
                                ->latest()
                                ->take(8)
                                ->with('category')
                                ->get();

        $testimonials = Review::where('is_approved', true)
                             ->with('user:id,name')
                             ->inRandomOrder()
                             ->take(3)
                             ->get();

                return view('welcome', compact(
            'featuredProducts',
            'categories',
            'latestProducts',
            'testimonials'
        ));
    }

    // About page
    public function about()
    {
        return view('welcome'); // Temporarily use welcome view
    }

    // Contact page
    public function contact()
    {
        return view('welcome'); // Temporarily use welcome view
    }

    // Shop page (main products listing)
    public function shop()
    {
        $products = Product::where('stock', '>', 0)
                          ->with('category')
                          ->latest()
                          ->paginate(12);

        $categories = Category::withCount('products')->get();

        return view('welcome', compact('products', 'categories')); // Temporarily use welcome view
    }

    // Privacy policy page
    public function privacy()
    {
        return view('welcome'); // Temporarily use welcome view
    }

    // Terms of service page
    public function terms()
    {
        return view('welcome'); // Temporarily use welcome view
    }
}
