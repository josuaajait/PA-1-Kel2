<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageCustomerController extends Controller
{
    // Tampilkan semua customer (role user)
    public function index()
    {
        // Ambil data user dengan role 'customer', paginasi 10 data per halaman
        $customers = User::where('role', 'customer')->paginate(10);

        // Kirim ke view
        return view('admins.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('auth.register');
    }
    // Form edit customer
    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('admins.customers.edit', compact('customer'));
    }

    // Update data customer
    public function update(Request $request, $id)
    {
        $customer = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $customer->id,
            'no_hp' => 'required|string|max:20',
        ]);

        $customer->update($request->only('nama', 'email'));

        return redirect()->route('admins.customers.index')->with('success', 'Profil customer berhasil diperbarui.');
    }

}
