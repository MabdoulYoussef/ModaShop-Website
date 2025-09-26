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
            'has_files' => $request->hasFile('images'),
            'files_count' => $request->hasFile('images') ? count($request->file('images')) : 0,
            'all_data' => $request->all()
        ]);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'images' => 'required|array|min:1',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
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
                'is_monthly_offer' => 'nullable|boolean',
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

        // Handle multiple images upload
        $uploadedImages = [];
        if ($request->hasFile('images')) {
            $imagePath = public_path('assets/img/products');

            // Ensure directory exists
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0755, true);
            }

            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($imagePath, $imageName);
                $uploadedImages[] = 'products/' . $imageName;

                \Log::info('Image uploaded:', [
                    'original_name' => $image->getClientOriginalName(),
                    'saved_name' => $imageName,
                    'path' => 'products/' . $imageName
                ]);
            }
        }

        // Set the first image as the main image for backward compatibility
        $mainImage = !empty($uploadedImages) ? $uploadedImages[0] : null;
        $validated['image'] = $mainImage;
        $validated['images'] = $uploadedImages;

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
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'removed_image_indexes' => 'nullable|array',
            'removed_image_indexes.*' => 'integer|min:0',
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
            'is_monthly_offer' => 'nullable|boolean',
        ]);

        // Handle image removal and upload
        $existingImages = $product->images ?? [];
        $removedIndexes = $request->input('removed_image_indexes', []);

        // Remove deleted images from existing images array
        if (!empty($removedIndexes)) {
            // Sort indexes in descending order to avoid index shifting issues
            rsort($removedIndexes);

            foreach ($removedIndexes as $index) {
                if (isset($existingImages[$index])) {
                    // Delete file from storage
                    $imagePath = public_path('assets/img/' . $existingImages[$index]);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                        \Log::info('Deleted image file:', ['path' => $imagePath]);
                    }

                    // Remove from array
                    unset($existingImages[$index]);
                }
            }

            // Re-index array to remove gaps
            $existingImages = array_values($existingImages);
            \Log::info('Removed images:', ['indexes' => $removedIndexes, 'remaining_count' => count($existingImages)]);
        }

        // Handle new images upload
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            $imagePath = public_path('assets/img/products');

            // Ensure directory exists
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0755, true);
            }

            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($imagePath, $imageName);
                $uploadedImages[] = 'products/' . $imageName;
            }

            // Combine remaining existing images with new ones
            $allImages = array_merge($existingImages, $uploadedImages);

            $validated['images'] = $allImages;
            $validated['image'] = $allImages[0]; // Set first image as main image for backward compatibility

            \Log::info('Multiple images uploaded successfully:', ['count' => count($uploadedImages), 'paths' => $uploadedImages]);
        } else {
            // No new images uploaded, just update with remaining existing images
            $validated['images'] = $existingImages;
            if (!empty($existingImages)) {
                $validated['image'] = $existingImages[0]; // Set first image as main image
            }
            \Log::info('No new images uploaded, updated existing images only');
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
