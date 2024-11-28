<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use UploadFile;
    public function checking()
    {
        // Get products by the authenticated seller
        $products = Product::whereHas('deals', function ($query)  {
            $query->where('deal_status', 'pending');
        })->where('seller_id', auth('seller')->user()->seller_id)->get();
        return view('seller.products.checking', compact('products'));
    }
    public function index()
    {
        // Get products by the authenticated seller
        $products = Product::where('seller_id', auth('seller')->user()->seller_id)->get();
        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        // Load categories for the select box
        $categories = Category::all();
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate product data
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Upload image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->upload($request->image);
        }

        // Create a new product for the authenticated supplier
        Product::create([
            'seller_id' => auth('seller')->user()->seller_id,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'image' => $imagePath,
            'authenticity_certificate' => 0,
        ]);

        return redirect()->route('seller.products.index')->with('successfully', 'Product created successfully.');
    }



    public function edit(Product $product)
    {
        // Ensure the product belongs to the authenticated supplier
        if ($product->seller_id != auth('seller')->user()->seller_id) {
            return redirect()->route('seller.products.index')->with('failed', 'Unauthorized access.');
        }

        $categories = Category::all();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        // Ensure the product belongs to the authenticated supplier
        if ($product->seller_id != auth('seller')->user()->seller_id) {
            return redirect()->route('seller.products.index')->with('failed', 'Unauthorized access.');
        }

        // Validate product data
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Upload new image if provided
        if ($request->hasFile('image')) {
            $imagePath = $this->upload($request->image);
        } else {
            $imagePath = $product->image;
        }

        // Update product
        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'image' => $imagePath,
        ]);

        return redirect()->route('seller.products.index')->with('successfully', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Ensure the product belongs to the authenticated supplier
        if ($product->seller_id != auth('seller')->user()->seller_id) {
            return redirect()->route('seller.products.index')->with('failed', 'Unauthorized access.');
        }

        // Delete product image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete product
        $product->delete();
        return redirect()->route('seller.products.index')->with('successfully', 'Product deleted successfully.');
    }
}
