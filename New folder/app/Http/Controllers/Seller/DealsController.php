<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealsController extends Controller
{
    public function index()
    {
        $supplier = Auth::guard('seller')->user();

        // Get deals where seller has products in the deal
        $deals = Deal::whereHas('dealItems.product', function ($query) use ($supplier) {
            $query->where('seller_id', $supplier->seller_id);
        })->with('customer', 'dealItems.product')->get();

        return view('seller.deals.index', compact('deals'));
    }

    public function show($id)
    {
        $deal = Deal::with('customer', 'dealItems.product')->findOrFail($id);
        return view('seller.deals.show', compact('deal'));
    }

    public function changeStatus(Request $request, $id)
    {
        $deal = Deal::findOrFail($id);
        $request->validate([
            'deal_status' => 'required|in:pending,shipped,delivered,canceled',
        ]);
        $deal->deal_status = $request->deal_status;
        $deal->save();
        return redirect()->route('seller.deals.index')->with('successfully', 'Deal status updated successfully.');
    }
}
