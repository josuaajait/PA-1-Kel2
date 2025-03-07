<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modifikasi;

class ModifikasiController extends Controller
{
    public function index()
    {
        $modifikasis = Modifikasi::paginate(10);
        return view('modifikasis.index', compact('modifikasis'));
    }

    public function create()
    {
        return view('modifikasis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'nama' => 'required',
            'email' => 'required|email',
            'nomor_telepon' => 'required',
            'alamat' => 'required',
            'jenis_pakaian' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
            'modifikasi' => 'required',
            'status' => 'required|in:pending,diproses,dikirim,selesai',
        ]);

        Modifikasi::create($request->all());

        return redirect()->route('modifikasis.index')
            ->with('success', 'Modifikasi created successfully.');
    }

    public function show(Modifikasi $modifikasi)
    {
        return view('modifikasis.show', compact('modifikasi'));
    }

    public function edit(Modifikasi $modifikasi)
    {
        return view('modifikasis.edit', compact('modifikasi'));
    }

    public function update(Request $request, Modifikasi $modifikasi)
    {
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'nama' => 'required',
            'email' => 'required|email',
            'nomor_telepon' => 'required',
            'alamat' => 'required',
            'jenis_pakaian' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
            'modifikasi' => 'required',
            'status' => 'required|in:pending,diproses,dikirim,selesai',
        ]);

        $modifikasi->update($request->all());

        return redirect()->route('modifikasis.index')
            ->with('success', 'Modifikasi updated successfully.');
    }

    public function destroy(Modifikasi $modifikasi)
    {
        $modifikasi->delete();

        return redirect()->route('modifikasis.index')
            ->with('success', 'Modifikasi deleted successfully.');
    }
}
