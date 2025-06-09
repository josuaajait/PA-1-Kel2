<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananProduk;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PemesananProdukController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $produks = Produk::all();
            $pemesananProduks = PemesananProduk::with(['user', 'produks'])->paginate(8);

            return view('admins.pemesanan_produk.index', compact('produks', 'pemesananProduks'));
        }

        $produks = Produk::all(); // ✅ tambahkan ini
        $pemesananProduks = PemesananProduk::with('produks')
            ->where('user_id', Auth::id())
            ->get();

        return view('users.pemesanan_produk.pemesanan_create', compact('pemesananProduks', 'produks'));
    }


    public function create()
    {
        $produks = Produk::all();
        return view('admins.pemesanan_produk.create', compact('produks'));
    }

    public function createWithProduk($produkId)
    {
        $produk = Produk::findOrFail($produkId);
        $produks = Produk::all();

        return view('users.pemesanan_produk.pemesanan_create', compact('produk', 'produks'));
    }



    public function store(Request $request)
    {
        
        $request->validate([
            'produk_id' => 'required|exists:produks,produk_id',
            'nama' => 'required|string',
            'email' => 'required|email',
            'nomor_telepon' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        
        // Buat pemesanan baru dengan status default 'pending'
        $pemesanan = PemesananProduk::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'status' => 'diproses',  // default pending
            'user_id' => auth()->id(),
            'total_harga' => $produk->harga,
            'jenis_pakaian' => $produk->jenis_pakaian,
        ]);

        // Attach produk ke pemesanan lewat pivot
        $pemesanan->produks()->attach($produk->produk_id, [
        ]);
       
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admins.pemesanan-produk.index')
                ->with('success', 'Pemesanan produk berhasil ditambahkan dengan status pending.');
        } else {
            return redirect()->route('user.pemesanan-produk.index')
                ->with('success', 'Pesanan diproses.');
        }

    }



    public function show($id)
    {
        $pemesananProduk = PemesananProduk::with(['produks', 'user'])->findOrFail($id);
        return view('admins.pemesanan_produk.show', compact('pemesananProduk'));
    }

    public function edit($id)
    {
        $pemesananProduk = PemesananProduk::with(['produks', 'user'])->findOrFail($id);
        return view('admins.pemesanan_produk.edit', compact('pemesananProduk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,dikirim,selesai,batal',
        ]);

        $pemesananProduk = PemesananProduk::findOrFail($id);
        $pemesananProduk->status = $request->status;
        $pemesananProduk->save();

        return redirect()->route('admins.pemesanan-produk.index')
            ->with('success', 'Pemesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemesananProduk = PemesananProduk::findOrFail($id);
        $pemesananProduk->produks()->detach();
        $pemesananProduk->delete();

        return redirect()->route('admins.pemesanan-produk.index')
            ->with('success', 'Pemesanan berhasil dihapus.');
    }

}
