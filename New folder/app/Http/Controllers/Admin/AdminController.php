<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\Product;
use App\Models\Review;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function home()
    {
        // Count of categories
        $categoryCount = Category::count();

        // Count of valid products
        $validProductsCount = Product::where('authenticity_certificate', 1)->count();

        // Count of invalid products
        $invalidProductsCount = Product::where('authenticity_certificate', 0)->count();

        // Count of reviews
        $reviewCount = Review::count();

        // Count of suppliers
        $supplierCount = Supplier::count();

        // Count of deals
        $dealCount = Deal::count();

        // Count of customers
        $customerCount = Customer::count();

        // Deal activities (last 7 days)
        $dealActivityData = [];
        $labels = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $dealActivityData[] = Deal::whereDate('deal_date', $date)->count();
            $labels[] = $date->format('M d');
        }

        return view('admin.home', compact(
            'categoryCount',
            'validProductsCount',
            'invalidProductsCount',
            'reviewCount',
            'supplierCount',
            'dealCount',
            'customerCount',
            'dealActivityData',
            'labels'
        ));
    }

    public function showLoginForm()
    {
        auth('admin')->logout();
        auth('authen')->logout();
        auth('customer')->logout();
        auth('seller')->logout();
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'role' => 'required|in:admin,authenticator',
        ]);
        $guard = $request->role === 'admin' ? 'admin' : 'authen';

        if (Auth::guard($guard)->attempt($request->only('email', 'password'))) {
            if ($guard === 'admin') {
                return redirect()->route('admin.home')->with('successfully', 'Welcome back Admin');
            } else {
                return redirect()->route('admin.home')->with('successfully', 'Welcome back Authenticator');
            }
        }
        return back()->withErrors([
            'email' => 'Invalid credentials.',
            'failed' => 'Invalid credentials.',
        ])->withInput();
    }

    public function logout()
    {
        auth('admin')->logout();
        auth('authen')->logout();
        auth('customer')->logout();
        auth('seller')->logout();
        return redirect()->route('mainHome')->with('successfully', 'Logout successfully');
    }


    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot_password');
    }


    public function showProfileData()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }
    public function showAuthenticatorProfile()
    {
        $authenticator  = Auth::guard('authen')->user();
        return view('admin.authentactor_profile', compact('authenticator'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email,' . Auth::guard('admin')->id().',admin_id',
            'password' => 'nullable|min:6|confirmed',
            'phone' => 'required|regex:/^05\d{8}$/',
        ]);

        $admin = Auth::guard('admin')->user();
        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        $admin->update($data);
        return back()->with('successfully', 'Profile updated successfully.');
    }
    public function updateProfileAuthenticator(Request $request)
    {
        $authenticator  = Auth::guard('authen')->user();
        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:authenticators,email,' . $authenticator->authenticator_id . ',authenticator_id',
            'password' => 'nullable|string|min:8',
            'phone' => 'required|regex:/^05\d{8}$/',
            'id_number' => 'required|digits:10|unique:authenticators,id_number,' . $authenticator->authenticator_id . ',authenticator_id',
            'address' => 'nullable|string|max:255'
        ]);
        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        $authenticator->update($data);
        return back()->with('successfully', 'Profile updated successfully.');
    }
}
