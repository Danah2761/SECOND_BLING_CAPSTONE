<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\ProductAuthentication;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReportAdminController extends Controller
{
    // Sales Summary Report
    public function salesSummary()
    {
        $salesData = Deal::selectRaw("DATE_FORMAT(deal_date, '%Y-%m') as month, COUNT(deal_id) as total_deals, SUM(total_price) as total_revenue")
            ->groupBy('month')
            ->get();

        return view('admin.reports.sales_summary', compact('salesData'));
    }

    // Product Authentication Status Report
    public function productAuthenticationStatus()
    {
        $authStatusData = ProductAuthentication::selectRaw("authenticity_status, COUNT(authentication_id) as total")
            ->groupBy('authenticity_status')
            ->get();

        return view('admin.reports.product_auth_status', compact('authStatusData'));
    }

    // Supplier Performance Report
    public function supplierPerformance()
    {
        $supplierData = Supplier::with(['products', 'deals', 'products.reviews', 'products.checked'])->get()
            ->map(function ($supplier) {
                $totalProducts = $supplier->products->count();
                $validProducts = $supplier->products->filter(function ($product) {
                    return $product->checked && $product->checked->authenticity_status === 'valid';
                })->count();

                return [
                    'supplier_name' => $supplier->fullName,
                    'total_deals' => $supplier->deals->count(),
                    'average_product_rating' => $supplier->products->count() > 0
                        ? round($supplier->products->pluck('reviews')->flatten()->avg('rating'), 2)
                        : 0,
                    'valid_auth_percentage' => $totalProducts > 0
                        ? round(($validProducts / $totalProducts) * 100, 2)
                        : 0,
                ];
            });

        return view('admin.reports.supplier_performance', compact('supplierData'));
    }

}
?>
