<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart for all customers (session-based only)
     *
     * This function loads the cart from session for all customers
     * No authentication required - open to all customers
     */
    public function index()
    {
        $sessionCart = session('cart', []);
        $cartData = null;
        $total = 0;

        if (!empty($sessionCart)) {
            // Convert session cart to view-friendly format
            $cartData = $this->convertSessionCartToView($sessionCart);
            $total = $this->calculateSessionCartTotal($sessionCart);
        }

        return view('cart.index', compact('cartData', 'total'));
    }

    /**
     * Add item to cart (session-based only)
     *
     * This function:
     * 1. Validates the request (product exists, quantity is valid)
     * 2. Checks stock availability
     * 3. Adds to session cart
     *
     * No login required - open to all customers
     */
    public function addItem(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        // Check product stock
        $product = Product::find($validated['product_id']);
        if ($product->stock < $validated['quantity']) {
            return back()->with('error', 'Insufficient stock. Available: ' . $product->stock);
        }

        // Add to session cart
        $sessionCart = session('cart', []);
        $productId = $validated['product_id'];
        $quantity = $validated['quantity'];

        if (isset($sessionCart[$productId])) {
            // Update existing item in session
            $newQuantity = $sessionCart[$productId]['quantity'] + $quantity;

            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Total quantity exceeds available stock');
            }

            $sessionCart[$productId]['quantity'] = $newQuantity;
            $message = 'Cart item quantity updated';
        } else {
            // Add new item to session
            $sessionCart[$productId] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'size' => $product->size,
                    'description' => $product->description
                ]
            ];
            $message = 'Item added to cart';
        }

        // Save updated session cart
        session(['cart' => $sessionCart]);

        return redirect()->route('cart.index')->with('success', $message);
    }

    /**
     * Update cart item quantity (session-based only)
     *
     * This function:
     * 1. Validates the new quantity
     * 2. Checks stock availability
     * 3. Updates session cart item
     *
     * No login required - open to all customers
     */
    public function updateItem(Request $request, $itemId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $sessionCart = session('cart', []);

        if (!isset($sessionCart[$itemId])) {
            return back()->with('error', 'Item not found in cart');
        }

        // Check stock
        $product = Product::find($itemId);
        if ($validated['quantity'] > $product->stock) {
            return back()->with('error', 'Quantity exceeds available stock');
        }

        $sessionCart[$itemId]['quantity'] = $validated['quantity'];
        session(['cart' => $sessionCart]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
    }

    /**
     * Remove item from cart (session-based only)
     *
     * This function removes item from session cart
     * No login required - open to all customers
     */
    public function removeItem($itemId)
    {
        $sessionCart = session('cart', []);

        if (isset($sessionCart[$itemId])) {
            unset($sessionCart[$itemId]);
            session(['cart' => $sessionCart]);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }

    /**
     * Clear the entire cart (session-based only)
     *
     * This function clears all items from session cart
     * No login required - open to all customers
     */
    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully');
    }

    /**
     * Calculate total for session cart items
     *
     * This helper function calculates the total price for cart items
     * stored in session
     */
    private function calculateSessionCartTotal($sessionCart): float
    {
        $total = 0;
        foreach ($sessionCart as $item) {
            $total += $item['quantity'] * $item['product']['price'];
        }
        return $total;
    }

    /**
     * Convert session cart to view-friendly format
     *
     * This helper function converts the session cart array
     * to a format that matches the database cart structure
     * so the view can handle it consistently
     */
    private function convertSessionCartToView($sessionCart)
    {
        $cartItems = collect();

        foreach ($sessionCart as $productId => $item) {
            $cartItems->push((object) [
                'id' => $productId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'product' => (object) $item['product']
            ]);
        }

        return (object) [
            'cartItems' => $cartItems
        ];
    }
}
