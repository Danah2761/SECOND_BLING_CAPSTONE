<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\Product;
use App\Models\Review;
use App\Models\Seller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    public function home()
    {
        $supplierId = auth('seller')->user()->seller_id;
        $totalProducts = Product::where('seller_id', $supplierId)->count();
        $totalDeals = Deal::where('seller_id', $supplierId)->count();
        $totalRevenue = Deal::where('seller_id', $supplierId)->sum('total_price');
        $totalReviews = Review::whereHas('product', function ($query) use ($supplierId) {
            $query->where('seller_id', $supplierId);
        })->count();
        $monthlyOrders = Deal::selectRaw('MONTH(deal_date) as month, SUM(total_price) as total_orders')
            ->where('seller_id', $supplierId)
            ->groupBy('month')
            ->get();
        return view('seller.home', compact('totalDeals', 'totalRevenue', 'monthlyOrders', 'totalProducts', 'totalReviews'));
    }

    public function topSellingProducts()
    {
        $supplierId = auth('seller')->user()->seller_id;
        $topProducts = Product::select('product.product_name', 'product.product_id', DB::raw('COUNT(deal_item.deal_item_id) as total_sales'), DB::raw('SUM(deal_item.price) as total_revenue'))
            ->join('deal_item', 'product.product_id', '=', 'deal_item.product_id')
            ->join('deal', 'deal.deal_id', '=', 'deal_item.deal_id')
            ->where('product.seller_id', $supplierId)
            ->groupBy('product.product_id', 'product.product_name')
            ->orderBy('total_sales', 'DESC')
            ->limit(10)
            ->get();
        return view('seller.top_selling_products', compact('topProducts'));
    }


    public function showLoginForm()
    {
        auth('admin')->logout();
        auth('authen')->logout();
        auth('customer')->logout();
        auth('seller')->logout();
        return view('seller.auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Check if the seller exists and is blocked
        $seller = Supplier::where('email', $request->email)->first();
        if ($seller && $seller->status == 'blocked') {
            return back()->withInput()->withErrors(['email' => 'Your account is blocked. Please contact support.']);
        }
        if (Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('seller.home');
        }

        return back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }

    // Show register form
    public function showRegisterForm()
    {
        return view('seller.auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:seller,email',
            'password' => 'required|confirmed|min:8',
            'company_phone' => 'nullable|regex:/^05\d{8}$/',
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:255',
        ]);

        Supplier::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_phone' => $request->company_phone,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
        ]);

        return redirect()->route('seller.login')->with('successfully', 'Registration successful! Please login.');
    }

    // Logout
    public function logout()
    {
        auth('admin')->logout();
        auth('authen')->logout();
        auth('customer')->logout();
        auth('seller')->logout();
        return redirect()->route('mainHome');
    }

    // Show profile
    public function showProfile()
    {
        $supplier = Auth::guard('seller')->user();
        return view('seller.profile', compact('supplier'));
    }

    public function updateProfile(Request $request)
    {
        // Get the authenticated supplier
        $supplier = Auth::guard('seller')->user();

        // Validate the request data
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:seller,email,' . $supplier->seller_id . ',seller_id',
            'company_name' => 'required|string|max:255',
            'company_phone' => 'required|regex:/^05\d{8}$/',
            'company_address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the supplier's profile information
        $supplier->update([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'company_phone' => $request->company_phone,
            'company_address' => $request->company_address,
        ]);

        // If password is provided, update it
        if ($request->filled('password')) {
            $supplier->password = Hash::make($request->password);
            $supplier->save();
        }

        // Redirect back with a success message
        return back()->with('successfully', 'Profile updated successfully.');
    }

    // Show forgot password form
    public function showForgotPasswordForm()
    {
        return view('seller.auth.forgot_password');
    }
}
