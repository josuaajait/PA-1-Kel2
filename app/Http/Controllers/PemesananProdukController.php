<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananProduk;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class PemesananProdukController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $pemesananJahitan = PemesananProduk::with(['user', 'produk'])->paginate(10);
            return view('admins.pemesanan_jahitan.index', compact('pemesananJahitan'));
        }

        $pemesananJahitan = PemesananProduk::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        return view('users.pemesanan_produk.pemesanan_produk', compact('pemesananJahitan'));
    }

    public function create()
    {
        $produks = Produk::all();

        if (Auth::user()->role === 'admin') {
            return view('admins.pemesanan_produk.create', compact('produks'));
        } else {
            return view('users.pemesanan_produk.pemesanan_create', compact('produks'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
        ]);

        PemesananProduk::create([
            'user_id' => Auth::id(),
            'produk_id' => $request->produk_id,
            'status' => 'pending',
        ]);

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admins.pemesanan-produk.index')
                ->with('success', 'Pemesanan produk berhasil ditambahkan.');
        } else {
            return redirect()->route('user.produk.index')
                ->with('success', 'Pemesanan produk berhasil ditambahkan.');
        }
    }

    public function show($id)
    {
        $pemesananProduk = PemesananProduk::with(['produk', 'user'])->findOrFail($id);
        return view('admins.pemesanan_produk.show', compact('pemesananProduk'));
    }

    public function edit($id)
    {
        $pemesananProduk = PemesananProduk::with(['produk', 'user'])->findOrFail($id);
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

    public function destroy(PemesananProduk $pemesananProduk)
    {
        $pemesananProduk->delete();

        return redirect()->route('admins.pemesanan-produk.index')
            ->with('success', 'Pemesanan berhasil dihapus.');
    }
}
