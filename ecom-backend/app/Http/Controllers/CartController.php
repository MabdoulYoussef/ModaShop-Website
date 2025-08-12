<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Get the authenticated user's cart
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your cart');
        }

        $cart = $user->cart()->with('cartItems.product')->first();

        if (!$cart) {
            $cart = Cart::create(['user_id' => $user->id]);
        }

        $cartData = $cart->load('cartItems.product');
        $total = $this->calculateCartTotal($cart->cartItems);

        return view('cart.index', compact('cartData', 'total'));
    }

    // Add item to cart
    public function addItem(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart');
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        // Check product stock
        $product = Product::find($validated['product_id']);
        if ($product->stock < $validated['quantity']) {
            return back()->with('error', 'Insufficient stock. Available: ' . $product->stock);
        }

        $cart = $user->cart()->firstOrCreate(['user_id' => $user->id]);

        $existingItem = $cart->cartItems()
                            ->where('product_id', $validated['product_id'])
                            ->first();

        if ($existingItem) {
            $newQuantity = $existingItem->quantity + $validated['quantity'];

            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Total quantity exceeds available stock');
            }

            $existingItem->update(['quantity' => $newQuantity]);
            $message = 'Cart item quantity updated';
        } else {
            $cart->cartItems()->create($validated);
            $message = 'Item added to cart';
        }

        return redirect()->route('cart.index')->with('success', $message);
    }

    // Update cart item quantity
    public function updateItem(Request $request, $itemId)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to update cart');
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $cartItem = $user->cart->cartItems()->findOrFail($itemId);

        // Check stock
        if ($validated['quantity'] > $cartItem->product->stock) {
            return back()->with('error', 'Quantity exceeds available stock');
        }

        $cartItem->update($validated);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
    }

    // Remove item from cart
    public function removeItem($itemId)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to remove items');
        }

        $cartItem = $user->cart->cartItems()->findOrFail($itemId);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }

    // Clear the cart
    public function clear()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to clear cart');
        }

        $user->cart->cartItems()->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully');
    }

    // Calculate cart total
    private function calculateCartTotal($cartItems): float
    {
        return $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        });
    }
}
