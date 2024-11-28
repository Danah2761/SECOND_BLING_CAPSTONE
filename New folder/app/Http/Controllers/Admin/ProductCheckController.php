<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductCheckController extends Controller
{
    public function products()
    {
        $products = Product::where('authenticity_certificate', 1)->with('category', 'checked')->get();
        return view('admin.products_check.products', compact('products'));
    }
    public function index()
    {
        $products = Product::whereHas('deals', function ($query)  {
            $query->where('deal_status', 'pending');
        })->with('category', 'checked')->get();
        return view('admin.products_check.index', compact('products'));
    }

    public function checkProduct($id)
    {
        $product = Product::with('checked', 'category')->findOrFail($id);
        return view('admin.products_check.check', compact('product'));
    }

    public function updateStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $check = ProductAuthentication::updateOrCreate(
            ['product_id' => $product->product_id],
            [
                'authentication_date' => now(),
                'authenticity_status' => $request->authenticity_status,
                'authenticator_id' => auth('authen')->user()->authenticator_id,
                'notes' => $request->notes,
            ]
        );
        if ($request->authenticity_status == 'valid') {
            $product->update([
               'authenticity_certificate' => 1,
            ]);
        }

        return redirect()->route('admin.products_check.index')->with('successfully', 'Product status updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->back()->with('successfully', 'Product deleted successfully.');
    }
}
