<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Show create review form
     *
     * This function displays the review form for any customer
     * No authentication required - customers can leave reviews
     */
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('reviews.create', compact('product'));
    }

    /**
     * Store a new review
     *
     * This function:
     * 1. Validates review data and customer information
     * 2. Creates or finds customer by phone number
     * 3. Creates review linked to customer
     * 4. Requires admin approval before display
     *
     * No authentication required - customers can leave reviews
     */
    public function store(Request $request, $productId)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        $product = Product::findOrFail($productId);

        // Create or find customer by phone number
        $customer = Customer::findOrCreateByPhone(
            $validated['phone'],
            $validated['firstname'],
            $validated['lastname'],
            $validated['city']
        );

        // Check if customer already reviewed this product
        $existingReview = $customer->reviews()->where('product_id', $productId)->first();

        if ($existingReview) {
            return redirect()->route('products.show', $productId)
                            ->with('error', 'You have already reviewed this product');
        }

        $review = Review::create([
            'customer_id' => $customer->id,
            'product_id' => $productId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false, // Admin approval required
        ]);

        return redirect()->route('products.show', $productId)
                        ->with('success', 'Review submitted successfully! It will be visible after approval.');
    }

    /**
     * Show edit review form
     *
     * This function allows customers to edit their reviews
     * by providing their phone number for verification
     */
    public function edit($id)
    {
        $review = Review::with('product')->findOrFail($id);
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update a review
     *
     * This function:
     * 1. Validates customer phone number
     * 2. Finds customer and their review
     * 3. Updates review if customer matches
     *
     * No authentication required - uses phone verification
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        $review = Review::with('customer')->findOrFail($id);

        // Verify customer owns this review
        if ($review->customer->phone !== $validated['phone']) {
            return back()->with('error', 'Phone number does not match this review');
        }

        $review->update([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false, // Reset approval status for edited review
        ]);

        return redirect()->route('products.show', $review->product_id)
                        ->with('success', 'Review updated successfully! It will be visible after approval.');
    }

    /**
     * Delete a review
     *
     * This function:
     * 1. Validates customer phone number
     * 2. Finds customer and their review
     * 3. Deletes review if customer matches
     *
     * No authentication required - uses phone verification
     */
    public function destroy(Request $request, $id)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        $review = Review::with('customer')->findOrFail($id);

        // Verify customer owns this review
        if ($review->customer->phone !== $validated['phone']) {
            return back()->with('error', 'Phone number does not match this review');
        }

        $productId = $review->product_id;
        $review->delete();

        return redirect()->route('products.show', $productId)
                        ->with('success', 'Review deleted successfully');
    }
}
