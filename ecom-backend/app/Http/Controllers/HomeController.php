<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    // Homepage with featured products and categories
    public function index()
    {
        // Cache featured products for 1 hour
        $featuredProducts = Cache::remember('homepage_featured_products', 3600, function () {
            return Product::where('stock', '>', 0)
                          ->inRandomOrder()
                          ->take(6)
                          ->with('category')
                          ->get();
        });

        // Cache categories for 2 hours
        $categories = Cache::remember('homepage_categories', 7200, function () {
            return Category::withCount('products')
                           ->orderBy('products_count', 'desc')
                           ->take(8)
                           ->get();
        });

        // Cache latest products for 30 minutes
        $latestProducts = Cache::remember('homepage_latest_products', 1800, function () {
            return Product::where('stock', '>', 0)
                          ->latest()
                          ->take(8)
                          ->with('category')
                          ->get();
        });

        return view('home.index', compact(
            'featuredProducts',
            'categories',
            'latestProducts'
        ));
    }

    // About page
    public function about()
    {
        return view('home.about'); // Temporarily use home.about view
    }

    // Contact page
    public function contact()
    {
        return view('home.contact');
    }

    // Handle contact form submission
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Here you can add email sending logic
        // For now, we'll just store it in session and show success message

        // TODO: Add email notification to admin
        // Mail::to('support@modashop.com')->send(new ContactFormMail($validated));

        return redirect()->route('contact')
                        ->with('success', 'شكراً لك! تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.');
    }

    // Shop page (main products listing)
    public function shop()
    {
        $products = Product::where('stock', '>', 0)
                          ->with('category')
                          ->latest()
                          ->paginate(12);

        $categories = Category::withCount('products')->get();

        return view('products.index', compact('products', 'categories'));
    }

    // Privacy policy page
    public function privacy()
    {
        return view('home.privacy');
    }

    // Terms of service page
    public function terms()
    {
        return view('home.terms');
    }
}
