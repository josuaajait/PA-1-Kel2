<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananJahitanController extends Controller
{
    public function rincianUkuran(Request $request)
    {
        // Handle size details logic here
        // ...

        return view('users.rincian_ukuran', compact('request'));
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

        return redirect()->route('users.pemesanan')
            ->with('success', 'Pemesanan created successfully.');
    }
}
