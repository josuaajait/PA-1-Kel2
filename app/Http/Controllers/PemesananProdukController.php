<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananProduk;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class PemesananProdukController extends Controller
{
    // Tampilkan daftar pemesanan produk (admin)
    public function index()
    {
            if (Auth::user()->role === 'admin') {
            $pemesananJahitan = PemesananProduk::paginate(10);
            return view('admins.pemesanan_jahitan.index', compact('pemesananJahitan'));
        }

        // User hanya melihat data miliknya
        $pemesananJahitan = PemesananProduk::where('user_id', Auth::id())->get();
        return view('users.pemesanan_produk.pemesanan_produk', compact('pemesananJahitan'));
    }

    // Form create pemesanan (user/admin)
    public function create()
    {
        $produks = Produk::all();

        if (auth()->user()->role === 'admin') {
            return view('admins.pemesanan_produk.create', compact('produks'));
        } else {
            return view('users.pemesanan_produk.pemesanan_create', compact('produks'));
        }
    }

    // Simpan data pemesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $totalHarga = $produk->harga * $request->jumlah;

        $data = [
            'user_id' => auth()->id(),
            'produk_id' => $produk->id,
            'jenis_pakaian' => $produk->jenis_pakaian,
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ];

        PemesananProduk::create($data);

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admins.pemesanan-produk.index')
                ->with('success', 'Pemesanan produk berhasil ditambahkan.');
        } else {
            return redirect()->route('user.produk.index')
                ->with('success', 'Pemesanan produk berhasil ditambahkan.');
        }

    }

    // Tampilkan detail pemesanan
    public function show($id)
    {
        $pemesananProduk = PemesananProduk::with('produk')->findOrFail($id);
        return view('admins.pemesanan_produk.show', compact('pemesananProduk'));
    }

    // Form edit pesanan
    public function edit($id)
    {
        $pemesananProduk = PemesananProduk::findOrFail($id);
        return view('admins.pemesanan_produk.edit', compact('pemesananProduk'));
    }

    // Update data pesanan
    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email',
        'nomor_telepon' => 'required|string|max:20',
        'alamat' => 'required|string',
        'jumlah' => 'required|integer|min:1',
        'status' => 'required|in:pending,diproses,dikirim,selesai,batal'
    ]);

    $pemesananProduk = PemesananProduk::with('produk')->findOrFail($id);

    if (!$pemesananProduk->produk) {
        return redirect()->back()->withErrors('Produk terkait tidak ditemukan.');
    }

    $pemesananProduk->nama = $request->nama;
    $pemesananProduk->email = $request->email;
    $pemesananProduk->nomor_telepon = $request->nomor_telepon;
    $pemesananProduk->alamat = $request->alamat;
    $pemesananProduk->jumlah = $request->jumlah;
    $pemesananProduk->status = $request->status;
    $pemesananProduk->total_harga = $request->jumlah * $pemesananProduk->produk->harga;

    $pemesananProduk->save();

    return redirect()->route('admins.pemesanan-produk.index')->with('success', 'Pemesanan berhasil diperbarui.');
}


    // Hapus pesanan
    public function destroy(PemesananProduk $pemesananProduk)
    {
        $pemesananProduk->delete();

        return redirect()->route('admins.pemesanan-produk.index')
            ->with('success', 'Pemesanan berhasil dihapus.');
    }
}
