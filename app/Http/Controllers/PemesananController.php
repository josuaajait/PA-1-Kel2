<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::paginate(10);
        return view('admins.adminPemesanan', compact('pemesanans'));
    }

    public function create()
    {
        return view('pemesanans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_pakaian_id' => 'required|exists:jenis_pakaians,id',
            'nama' => 'required',
            'email' => 'required|email',
            'nomor_telepon' => 'required',
            'alamat' => 'required',
            'jumlah' => 'required|integer',
            'status' => 'required|in:pending,diproses,dikirim,selesai',
        ]);

        Pemesanan::create($request->all());

        return redirect()->route('pemesanans.index')
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
            'jenis_pakaian_id' => 'required|exists:jenis_pakaians,id',
            'nama' => 'required',
            'email' => 'required|email',
            'nomor_telepon' => 'required',
            'alamat' => 'required',
            'jumlah' => 'required|integer',
            'status' => 'required|in:pending,diproses,dikirim,selesai',
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
