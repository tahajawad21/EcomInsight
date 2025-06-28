<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Fetch all products
    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Add a new product (for adding products with details and images)
    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'available' => 'required|boolean',
            'is_featured' => 'boolean',
            'stock' => 'required|integer|min:0',
            'brand_id' => 'nullable|integer',  // ✅ Use plain string
            'subcategory_id' => 'nullable|integer',
           
        ]);
    
        $imagePath = $request->file('image')->store('product_images', 'public');
    
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'available' => $request->boolean('available'),
            'is_featured' => $request->boolean('is_featured'),
            'stock' => $request->stock,
            'brand_id' => $request->brand_id,  // ✅ Save brand string
            'subcategory_id' => $request->subcategory_id,
            'latitude' => 31.4694,
            'longitude' => 74.2728,
        ]);
    
        return response()->json(['product' => $product, 'message' => 'Product added successfully']);
    }
    


    public function updateProduct(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'discount_price' => 'nullable|numeric',
        'available' => 'required|boolean',
        'is_featured' => 'boolean',
        'stock' => 'required|integer|min:0',
        'brand_id' => 'nullable|integer',  // ✅ Use string, not brand_id
        'subcategory_id' => 'nullable|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $product->image = $request->file('image')->store('product_images', 'public');
    }

    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'discount_price' => $request->discount_price,
        'available' => $request->boolean('available'),
        'is_featured' => $request->boolean('is_featured'),
        'stock' => $request->stock,
        'brand_id' => $request->brand_id,  // ✅ Update brand string
        'subcategory_id' => $request->subcategory_id,
        'image' => $product->image,
    ]);

    return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
}

    



    public function deleteProduct($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return response()->json(['message' => 'Product deleted successfully']);
}

}    
