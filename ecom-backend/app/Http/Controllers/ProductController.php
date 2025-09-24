<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        $product = Product::with(['category'])->find($id);

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
        return view('admin.products.create', compact('categories'));
    }

    // Store a new product
    public function store(Request $request)
    {
        \Log::info('Product Store Request:', [
            'has_file' => $request->hasFile('image'),
            'file_name' => $request->hasFile('image') ? $request->file('image')->getClientOriginalName() : 'No file',
            'all_data' => $request->all()
        ]);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'nullable|exists:categories,id',
                'size' => 'nullable|string|max:255',
                'sizes' => 'nullable|array',
                'sizes.*' => 'string|in:XS,S,M,L,XL,XXL,XXXL',
                'predefined_colors' => 'nullable|array',
                'predefined_colors.*' => 'string|max:255',
                'custom_colors' => 'nullable|array',
                'custom_colors.*' => 'nullable|string|max:255',
                'colors' => 'nullable|string', // JSON string from JavaScript
                'stock' => 'required|integer|min:0',
                'is_featured' => 'nullable|boolean',
                'is_recommended' => 'nullable|boolean',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Product validation failed:', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('storage/products');

            // Ensure directory exists
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);
            $validated['image'] = 'products/' . $imageName;

            \Log::info('Product image uploaded successfully:', [
                'original_name' => $image->getClientOriginalName(),
                'saved_as' => $imageName,
                'path' => $validated['image']
            ]);
        }

        // Handle colors - combine predefined and custom colors
        if ($request->has('colors')) {
            // Colors come as JSON string from JavaScript
            $validated['colors'] = json_decode($request->colors, true);
        } else {
            // Fallback: combine predefined and custom colors manually
            $predefinedColors = $request->input('predefined_colors', []);
            $customColors = array_filter($request->input('custom_colors', []), function($value) {
                return !is_null($value) && trim($value) !== '';
            });
            $validated['colors'] = array_merge($predefinedColors, $customColors);
        }

        \Log::info('Creating product with validated data:', $validated);

        $product = Product::create($validated);

        \Log::info('Product created successfully:', [
            'product_id' => $product->id,
            'product_name' => $product->name
        ]);

        // Clear homepage cache when new product is added
        Cache::forget('homepage_featured_products');
        Cache::forget('homepage_latest_products');
        Cache::forget('homepage_categories');
        Cache::forget('admin_dashboard_stats');

        return redirect()->route('admin.products.index')
                        ->with('success', 'تم إنشاء المنتج بنجاح');
    }

    // Show edit product form
    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        // Debug: Log request data
        \Log::info('Product Update Request:', [
            'has_file' => $request->hasFile('image'),
            'file_name' => $request->hasFile('image') ? $request->file('image')->getClientOriginalName() : 'No file',
            'all_data' => $request->all()
        ]);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'size' => 'nullable|string|max:255',
            'sizes' => 'nullable|array',
            'sizes.*' => 'string|in:XS,S,M,L,XL,XXL,XXXL',
            'predefined_colors' => 'nullable|array',
            'predefined_colors.*' => 'string|max:255',
            'custom_colors' => 'nullable|array',
            'custom_colors.*' => 'string|max:255',
            'colors' => 'nullable|string', // JSON string from JavaScript
            'stock' => 'sometimes|required|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'is_recommended' => 'nullable|boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                unlink(public_path('storage/' . $product->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/products'), $imageName);
            $validated['image'] = 'products/' . $imageName;

            \Log::info('Image uploaded successfully:', ['path' => $validated['image']]);
        } else {
            \Log::info('No image file in request');
        }

        // Handle colors - combine predefined and custom colors
        if ($request->has('colors')) {
            // Colors come as JSON string from JavaScript
            $validated['colors'] = json_decode($request->colors, true);
        } else {
            // Fallback: combine predefined and custom colors manually
            $predefinedColors = $request->input('predefined_colors', []);
            $customColors = array_filter($request->input('custom_colors', []), function($value) {
                return !is_null($value) && trim($value) !== '';
            });
            $validated['colors'] = array_merge($predefinedColors, $customColors);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
                        ->with('success', 'تم تحديث المنتج بنجاح');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                        ->with('success', 'تم حذف المنتج بنجاح');
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
