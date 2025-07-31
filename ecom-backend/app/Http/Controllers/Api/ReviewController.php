<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Get reviews for a product
    public function index($productId)
    {
        $reviews = Review::where('product_id', $productId)
                        ->where('is_approved', true)
                        ->with('user')
                        ->get();
        return response()->json($reviews);
    }

    // Add a review
    public function store(Request $request, $productId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);
        $user = Auth::user();
        $existingReview = Review::where('user_id', $user->id)
                               ->where('product_id', $productId)
                               ->first();
        if ($existingReview) {
            return response()->json(['message' => 'You have already reviewed this product'], 400);
        }
        $review = Review::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false,
        ]);
        return response()->json($review, 201);
    }

    // Update review (only own review)
    public function update(Request $request, $reviewId)
    {
        $user = Auth::user();
        $review = Review::where('user_id', $user->id)->findOrFail($reviewId);
        $validated = $request->validate([
            'rating' => 'sometimes|integer|min:1|max:5',
            'comment' => 'sometimes|string|max:1000',
        ]);
        $review->update($validated);
        return response()->json($review);
    }

    // Delete review (only own review)
    public function destroy($reviewId)
    {
        $user = Auth::user();
        $review = Review::where('user_id', $user->id)->findOrFail($reviewId);
        $review->delete();
        return response()->json(['message' => 'Review deleted']);
    }
}
