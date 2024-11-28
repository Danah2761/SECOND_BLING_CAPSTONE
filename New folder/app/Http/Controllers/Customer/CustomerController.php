<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function showLoginForm()
    {
        auth('admin')->logout();
        auth('authen')->logout();
        auth('customer')->logout();
        auth('seller')->logout();
        return view('customer.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
            return redirect()->route('products.index');
        } else {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
                'failed' => 'Invalid email or password.',
            ])->withInput();
        }
    }

    public function showRegisterForm()
    {
        return view('customer.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customer',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'phone' => ['required', 'regex:/^(05|9665)[0-9]{8}$/'],
            'address' => 'required',
        ], [
            'phone.regex' => 'The phone number must be a valid phone number starting with 05 or +9665.',
        ]);
        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        Auth::guard('customer')->login($customer);
        return redirect()->route('customer.dashboard');
    }

    public function showProfile()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customer,email,' . $customer->customer_id.',customer_id',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $customer->update($request->only('first_name', 'last_name', 'email', 'phone', 'address'));

        return back()->with('successfully', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $customer = Auth::guard('customer')->user();

        if (!Hash::check($request->current_password, $customer->password)) {
            return back()->with('failed' , 'Current password is incorrect.');
        }

        $customer->update(['password' => Hash::make($request->password)]);

        return back()->with('successfully', 'Password updated successfully.');
    }

    public function logout()
    {
        auth('admin')->logout();
        auth('authen')->logout();
        auth('customer')->logout();
        auth('seller')->logout();
        return redirect()->route('mainHome')->with('successfully', 'logout successfully');
    }
}
