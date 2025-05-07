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
        $produks = Produk::all();
        $user = auth()->user();

        if ($user && $user->role === 'admin') {
            return view('admins.adminProduk', compact('produks'));
        } else {
            return view('users.produk', compact('produks'));
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
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,tidak tersedia',
            'ukuran' => 'nullable|string',
            'warna' => 'nullable|string',
            'bahan' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('public/produk_images', $filename);
            $data['gambar'] = $filename;
        }

        Produk::create($data);

        return redirect()->route('admins.produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('admins.produk_edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,tidak tersedia',
            'ukuran' => 'nullable|string',
            'warna' => 'nullable|string',
            'bahan' => 'nullable|string',
        ]);

        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('public/produk_images', $filename);
            $data['gambar'] = $filename;
        }

        $produk->update($data);

        return redirect()->route('admins.produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('admins.produk')->with('success', 'Produk berhasil dihapus.');
    }
}