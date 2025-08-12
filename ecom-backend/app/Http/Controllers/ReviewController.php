<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Show create review form
    public function create($productId)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to write a review');
        }

        $product = Product::findOrFail($productId);

        // Check if user already reviewed this product
        $existingReview = $user->reviews()->where('product_id', $productId)->first();

        if ($existingReview) {
            return redirect()->route('products.show', $productId)
                            ->with('error', 'You have already reviewed this product');
        }

        return view('reviews.create', compact('product'));
    }

    // Store a new review
    public function store(Request $request, $productId)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to write a review');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        // Check if user already reviewed this product
        $existingReview = $user->reviews()->where('product_id', $productId)->first();

        if ($existingReview) {
            return redirect()->route('products.show', $productId)
                            ->with('error', 'You have already reviewed this product');
        }

        $review = Review::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false, // Admin approval required
        ]);

        return redirect()->route('products.show', $productId)
                        ->with('success', 'Review submitted successfully! It will be visible after approval.');
    }

    // Show edit review form
    public function edit($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to edit review');
        }

        $review = $user->reviews()->with('product')->findOrFail($id);

        return view('reviews.edit', compact('review'));
    }

    // Update a review
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to edit review');
        }

        $review = $user->reviews()->findOrFail($id);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        $review->update([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false, // Reset approval status on update
        ]);

        return redirect()->route('products.show', $review->product_id)
                        ->with('success', 'Review updated successfully! It will be visible after approval.');
    }

    // Delete a review
    public function destroy($id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to delete review');
        }

        $review = $user->reviews()->findOrFail($id);
        $productId = $review->product_id;

        $review->delete();

        return redirect()->route('products.show', $productId)
                        ->with('success', 'Review deleted successfully');
    }

    // Show user's reviews
    public function myReviews()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your reviews');
        }

        $reviews = $user->reviews()
                        ->with('product')
                        ->latest()
                        ->paginate(10);

        return view('reviews.my-reviews', compact('reviews'));
    }

    // Show all reviews for a product
    public function productReviews($productId)
    {
        $product = Product::findOrFail($productId);

        $reviews = $product->reviews()
                           ->where('is_approved', true)
                           ->with('user:id,name')
                           ->latest()
                           ->paginate(10);

        return view('reviews.product-reviews', compact('product', 'reviews'));
    }
}
