<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Supplier;

class GeneralController extends Controller
{
    // List suppliers
    public function listSuppliers()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function toggleSupplierStatus($id)
    {
        $supplier = Supplier::findOrFail($id);

        // Toggle the status
        $supplier->status = $supplier->status === 'blocked' ? 'unblocked' : 'blocked';
        $supplier->save();

        return back()->with('successfully', 'Supplier status updated successfully.');
    }
    public function showSupplierDetails($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.show', compact('seller'));
    }

    public function listCustomers()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }
}
