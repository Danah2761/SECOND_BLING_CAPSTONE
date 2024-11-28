<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Authenticator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticatorController extends Controller
{
    /**
     * Display a listing of the authenticators.
     */
    public function index()
    {
        $authenticators = Authenticator::all();
        return view('admin.authenticators.index', compact('authenticators'));
    }

    /**
     * Show the form for creating a new authenticator.
     */
    public function create()
    {
        return view('admin.authenticators.create');
    }

    /**
     * Store a newly created authenticator in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:authenticators,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|regex:/^05\d{8}$/',
            'id_number' => 'required|digits:10|unique:authenticators,id_number',
            'address' => 'nullable|string|max:255'
        ]);

        $data = $request->all();
        $data['admin_id'] = auth('admin')->user()->admin_id;
        $data['password'] = Hash::make($request->password); // Hashing the password

        Authenticator::create($data);

        return redirect()->route('admin.authenticators.index')->with('success', 'Authenticator created successfully.');
    }

    /**
     * Display the specified authenticator.
     */
    public function show(Authenticator $authenticator)
    {
        return view('authenticators.show', compact('authenticator'));
    }

    /**
     * Show the form for editing the specified authenticator.
     */
    public function edit(Authenticator $authenticator)
    {
        return view('admin.authenticators.edit', compact('authenticator'));
    }

    /**
     * Update the specified authenticator in storage.
     */
    public function update(Request $request, Authenticator $authenticator)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:authenticators,email,' . $authenticator->authenticator_id.',authenticator_id',
            'password' => 'nullable|string|min:8',
            'phone' => 'required|regex:/^05\d{8}$/',
            'id_number' => 'required|digits:10|unique:authenticators,id_number,' . $authenticator->authenticator_id.',authenticator_id',
            'address' => 'nullable|string|max:255'
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        $data['admin_id'] = auth('admin')->user()->admin_id;

        $authenticator->update($data);

        return redirect()->route('admin.authenticators.index')->with('success', 'Authenticator updated successfully.');
    }

    /**
     * Remove the specified authenticator from storage.
     */
    public function destroy(Authenticator $authenticator)
    {
        $authenticator->delete();

        return redirect()->route('admin.authenticators.index')->with('success', 'Authenticator deleted successfully.');
    }
}
