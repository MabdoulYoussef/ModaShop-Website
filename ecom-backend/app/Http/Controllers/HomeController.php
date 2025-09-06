<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

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
                             ->with('customer:id,firstname,lastname')
                             ->inRandomOrder()
                             ->take(3)
                             ->get();

                return view('home.index', compact(
            'featuredProducts',
            'categories',
            'latestProducts',
            'testimonials'
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
