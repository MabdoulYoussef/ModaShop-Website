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
            'size' => 'nullable|string',
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
        $selectedSize = $validated['size'] ?? '';

        // Create unique cart key for product + size combination
        $cartKey = $productId . '_' . $selectedSize;

        if (isset($sessionCart[$cartKey])) {
            // Update existing item in session
            $newQuantity = $sessionCart[$cartKey]['quantity'] + $quantity;

            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Total quantity exceeds available stock');
            }

            $sessionCart[$cartKey]['quantity'] = $newQuantity;
            $message = 'Cart item quantity updated';
        } else {
            // Add new item to session
            $sessionCart[$cartKey] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'selected_size' => $selectedSize,
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'size' => $product->size, // Keep original for reference
                    'selected_size' => $selectedSize, // Store the selected size
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
    public function updateItem(Request $request, $cartKey)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $sessionCart = session('cart', []);

        if (!isset($sessionCart[$cartKey])) {
            return back()->with('error', 'Item not found in cart');
        }

        // Get the product ID from the cart item
        $productId = $sessionCart[$cartKey]['product_id'];

        // Check stock
        $product = Product::find($productId);
        if ($validated['quantity'] > $product->stock) {
            return back()->with('error', 'Quantity exceeds available stock');
        }

        $sessionCart[$cartKey]['quantity'] = $validated['quantity'];
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

        foreach ($sessionCart as $cartKey => $item) {
            $cartItems->push((object) [
                'id' => $cartKey, // This is now the cart key (productId_size)
                'cart_key' => $cartKey, // Store the cart key for removal
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'selected_size' => $item['selected_size'] ?? '',
                'product' => (object) $item['product']
            ]);
        }

        return (object) [
            'cartItems' => $cartItems
        ];
    }
}
