<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $cart = $user->cart()->with('cartItems.product')->first();
        if (!$cart) {
            $cart = Cart::create(['user_id' => $user->id]);
        }
        return response()->json($cart->load('cartItems.product'));
    }

    // Add item to cart
    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $user = Auth::user();
        $cart = $user->cart()->firstOrCreate(['user_id' => $user->id]);
        $item = $cart->cartItems()->where('product_id', $validated['product_id'])->first();
        if ($item) {
            $item->quantity += $validated['quantity'];
            $item->save();
        } else {
            $cart->cartItems()->create($validated);
        }
        return response()->json(['message' => 'Item added to cart']);
    }

    // Update cart item quantity
    public function updateItem(Request $request, $itemId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $user = Auth::user();
        $cartItem = $user->cart->cartItems()->findOrFail($itemId);
        $cartItem->update($validated);
        return response()->json(['message' => 'Cart updated']);
    }

    // Remove item from cart
    public function removeItem($itemId)
    {
        $user = Auth::user();
        $cartItem = $user->cart->cartItems()->findOrFail($itemId);
        $cartItem->delete();
        return response()->json(['message' => 'Item removed from cart']);
    }

    // Clear the cart
    public function clear()
    {
        $user = Auth::user();
        $user->cart->cartItems()->delete();
        return response()->json(['message' => 'Cart cleared']);
    }
}
