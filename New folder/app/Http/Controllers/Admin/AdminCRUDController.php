<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminCRUDController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:admin',
            'password' => 'required|min:6',
            'phone' => 'required|regex:/^05\d{8}$/',
            'role' => 'required'
        ]);

        $admin = new Admin();
        $admin->fill($request->all());
        $admin->password = bcrypt($request->password);
        $admin->save();

        return redirect()->route('admin.admins.index')->with('successfully', 'Admin created successfully.');
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email,' . $admin->admin_id.',admin_id',
            'phone' => 'required|regex:/^05\d{8}$/',
            'role' => 'required',
            'password' => 'nullable|min:6|confirmed',
        ]);
        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        $admin->update($data);
        return redirect()->route('admin.admins.index')->with('successfully', 'Admin updated successfully.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('successfully', 'Admin deleted successfully.');
    }
}
