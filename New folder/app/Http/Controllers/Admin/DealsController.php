<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealsController extends Controller
{
    public function index()
    {

        $deals = Deal::with('customer', 'dealItems.product')->get();
        return view('admin.deals.index', compact('deals'));
    }

    public function show($id)
    {
        $deal = Deal::with('customer', 'dealItems.product')->findOrFail($id);
        return view('admin.deals.show', compact('deal'));
    }

    public function changeStatus(Request $request, $id)
    {
        $deal = Deal::findOrFail($id);
        $request->validate([
            'deal_status' => 'required|in:pending,shipped,delivered,canceled',
        ]);
        $deal->deal_status = $request->deal_status;
        $deal->save();
        return redirect()->route('admin.deals.index')->with('successfully', 'Deal status updated successfully.');
    }
}
