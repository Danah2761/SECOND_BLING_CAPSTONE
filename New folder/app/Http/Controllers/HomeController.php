<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function mainHome()
    {
        return view('customer.home_1');
    }
    public function home(Request $request)
    {
        $query = Product::with('category', 'seller');

        // Filter by category if a category is selected
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by search keyword if provided
        if ($request->has('keyword') && $request->keyword) {
            $query->where('product_name', 'like', '%' . $request->keyword . '%');
        }

        $products = $query->get();

        return view('customer.home', compact('products'));
    }


    public function products(Request $request)
    {
        $query = Product::with('category', 'seller', 'reviews');
        $categories = Category::all();

        if ($request->filled('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('keyword') && $request->keyword) {
            $query->where('product_name', 'like', '%' . $request->keyword . '%');
        }
        if ($request->filled('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }
        if ($request->filled('stars') && $request->stars) {
            $query->whereHas('reviews', function ($q) use ($request) {
                $q->havingRaw('AVG(rating) >= ?', [$request->stars]);
            });
        }
        // Sort by price
        if ($request->filled('sort')) {
            if ($request->sort == 'price_low_high') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_high_low') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->get();
        return view('customer.products', compact('products', 'categories'));
    }


    public function showProduct($product_id)
    {
        $product = Product::with('category', 'seller')->findOrFail($product_id);
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->take(4)
            ->get();

        return view('customer.product_details', compact('product', 'similarProducts'));
    }

}
