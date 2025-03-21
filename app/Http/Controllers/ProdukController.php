<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Produk::class, 'produk');
    }

    public function index()
    {
        $produks = Produk::all(); // Fetch all products from the database
        $user = auth()->user(); // Get the logged-in user

        if ($user && $user->role === 'admin') {
            return view('admins.adminProduk', compact('produks')); // Admin view
        } else {
            return view('users.produk', compact('produks')); // User view
        }
    }

    public function adminIndex()
    {
        $produks = Produk::all();
        return view('admins.adminProduk', compact('produks'));
    }

    public function show(Produk $produk)
    {
        return view('admins.produk_detail', compact('produk'));
    }

    public function create()
    {
        return view('admins.produk_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/produk_images', $imageName);
        } else {
            $imageName = 'default.jpg'; // Fallback image
        }

        Produk::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName, // Store only filename
        ]);

        return redirect()->route('admins.produk');
    }

    public function edit(Produk $produk)
    {
        return view('admins.produk_edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produk_images', 'public');
            $data['image'] = $imagePath;
        }

        $produk->update($data);

        return redirect()->route('admins.produk')->with('success', 'Product updated successfully.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('admins.produk')->with('success', 'Product deleted successfully.');
    }
}

