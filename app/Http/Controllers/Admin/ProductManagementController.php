<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;




class ProductManagementController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::all();
    $query = Product::query();

    if ($request->has('category') && $request->category != 'all') {
        $query->where('category_id', $request->category);
    }

    $products = $query->paginate(10);

    return view('pages.admin.admin_product_page', compact('products', 'categories'));
}

    public function create()
{
    $categories = Category::all(); // Fetch all categories
    return view('pages.admin.create_product', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'colour' => 'nullable|string',
        'description' => 'nullable|string',
        'mens' => 'required|boolean',
        'stock' => 'required|integer|min:0',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    $product = Product::create($request->except('images'));

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            // Generate a unique file name using UUID
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/productImage'), $imageName);

            // Store the image in `product_images` table
            ProductImage::create([
                'product_id' => $product->id,
                'image_name' => $imageName,
            ]);
        }
    }

    return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
}

    public function edit(Product $product)
{
    return view('pages.admin.edit_product', compact('product'));
}



    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
{
    ProductImage::where('product_id', $product->id)->delete();

    $product->delete();

    return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
}
}