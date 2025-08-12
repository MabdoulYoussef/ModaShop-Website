<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List all products with pagination and filters
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->has('category_id')) {
            $query->where('category_id', $request->get('category_id'));
        }

        // Price range filter
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->get('min_price'));
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->get('max_price'));
        }

        // Stock filter
        if ($request->has('in_stock') && $request->get('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // Sort by
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 12);
        $products = $query->paginate($perPage);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // Show a single product
    public function show($id)
    {
        $product = Product::with(['category', 'reviews.user'])->find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        // Get related products
        $relatedProducts = Product::where('category_id', $product->category_id)
                                 ->where('id', '!=', $product->id)
                                 ->take(4)
                                 ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    // Get featured products for homepage
    public function featured()
    {
        $featuredProducts = Product::where('stock', '>', 0)
                                  ->inRandomOrder()
                                  ->take(6)
                                  ->with('category')
                                  ->get();

        return view('products.featured', compact('featuredProducts'));
    }

    // Show create product form (admin)
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Store a new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'size' => 'nullable|string|max:50',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($validated);

        return redirect()->route('products.show', $product->id)
                        ->with('success', 'Product created successfully');
    }

    // Show edit product form
    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'image' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'size' => 'nullable|string|max:50',
            'stock' => 'sometimes|required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.show', $product->id)
                        ->with('success', 'Product updated successfully');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        $product->delete();

        return redirect()->route('products.index')
                        ->with('success', 'Product deleted successfully');
    }

    // Search products
    public function search(Request $request)
    {
        $query = $request->get('q');

        $products = Product::where('name', 'like', "%{$query}%")
                          ->orWhere('description', 'like', "%{$query}%")
                          ->with('category')
                          ->paginate(12);

        return view('products.search', compact('products', 'query'));
    }
}
