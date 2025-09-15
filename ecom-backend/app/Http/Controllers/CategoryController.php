<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // List all categories with product count
    public function index()
    {
        $categories = Category::withCount('products')
                             ->orderBy('name')
                             ->get();

        return view('categories.index', compact('categories'));
    }

    // Show a single category with products
    public function show(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            abort(404, 'Category not found');
        }

        // Get products in this category with pagination
        $products = Product::where('category_id', $id)
                          ->where('stock', '>', 0)
                          ->with('category')
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);

        return view('categories.show', compact('category', 'products'));
    }

    // Show category by slug
    public function showBySlug($slug)
    {
        $category = Category::where('slug', $slug)
                           ->with(['products' => function($query) {
                               $query->where('stock', '>', 0);
                           }])
                           ->withCount('products')
                           ->first();

        if (!$category) {
            abort(404, 'Category not found');
        }

        return view('categories.show', compact('category'));
    }

    // Show create category form (admin)
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a new category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/img/categories'), $imageName);
            $validated['image'] = 'categories/' . $imageName;
        }

        $category = Category::create($validated);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'تم إنشاء الفئة بنجاح');
    }

    // Show edit category form
    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            abort(404, 'Category not found');
        }

        return view('admin.categories.edit', compact('category'));
    }

    // Update a category
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            abort(404, 'Category not found');
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && file_exists(public_path('assets/img/' . $category->image))) {
                unlink(public_path('assets/img/' . $category->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/img/categories'), $imageName);
            $validated['image'] = 'categories/' . $imageName;
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'تم تحديث الفئة بنجاح');
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            abort(404, 'Category not found');
        }

        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                            ->with('error', 'لا يمكن حذف فئة تحتوي على منتجات');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
                        ->with('success', 'تم حذف الفئة بنجاح');
    }
}
