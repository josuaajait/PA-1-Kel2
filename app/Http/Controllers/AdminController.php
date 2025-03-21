<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        return view('admins.adminDashboard'); // Create this view next
    }

    public function produk()
    {
        $produks = Produk::all(); // Fetch all products from the database
        return view('admins.adminProduk', compact('produks'));
    }

    public function create()
    {
        return view('admins.tambahproduk');
    }

    // Handle the form submission
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload Image
        $imagePath = $request->file('image')->store('produk_images', 'public');

        Produk::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath
        ]);

        return redirect()->route('admins.adminProduk')->with('success', 'Produk berhasil ditambahkan!');
    }
}
