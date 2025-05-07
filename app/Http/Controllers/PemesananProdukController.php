<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Produk;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::paginate(10); // Fetch paginated pemesanans
        return view('admins.adminPemesanan', compact('pemesanans')); // Pass $pemesanans to the view
    }

    public function create()
    {
        $products = Produk::all(); // Fetch all products from the database
        return view('users.pemesanan_create', compact('products'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'total_harga' => 'required',
            'jumlah' => 'required|integer',
            'status' => 'required|in:pending,diproses,dikirim,selesai'
        ]);
    
        // Create the order
        Pemesanan::create($request->all());
    
        // Redirect to the pemesanan list with a success message
        return redirect()->route('users.pemesanan')
            ->with('success', 'Pemesanan created successfully.');
    }
    
    public function show(Pemesanan $pemesanan)
    {
        return view('pemesanans.show', compact('pemesanan'));
    }

    public function edit(Pemesanan $pemesanan)
    {
        return view('pemesanans.edit', compact('pemesanan'));
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'total_harga' => 'required',
            'jumlah' => 'required|integer',
            'status' => 'required|in:pending,diproses,dikirim,selesai'
        ]);

        $pemesanan->update($request->all());

        return redirect()->route('pemesanans.index')
            ->with('success', 'Pemesanan updated successfully.');
    }

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();

        return redirect()->route('pemesanans.index')
            ->with('success', 'Pemesanan deleted successfully.');
    }
}