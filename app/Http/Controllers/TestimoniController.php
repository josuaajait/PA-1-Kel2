<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\PemesananProduk;
use App\Models\PemesananJahitan;
use App\Models\ModifikasiJahitan;

class TestimoniController extends Controller
{

    public function index(Request $request)
    {
        $query = Testimoni::with('user');

    // Sorting logic
    switch ($request->get('sort')) {
        case 'highest_rating':
            $query->orderBy('rate', 'desc');
            break;
        case 'lowest_rating':
            $query->orderBy('rate', 'asc');
            break;
        case 'oldest':
            $query->orderBy('created_at', 'asc');
            break;
        default:
            $query->latest();
    }

    $testimonis = $query->paginate(10);

    // Ambil riwayat pemesanan user untuk tombol "Ulas"
    $userId = auth()->id();
    $pemesananProduks = PemesananProduk::where('user_id', $userId)->with('produk')->get();
    $pemesananJahitans = PemesananJahitan::where('user_id', $userId)->get();
    $modifikasiJahitans = ModifikasiJahitan::where('user_id', $userId)->get();

    if (auth()->user()->role === 'admin') {
        return view('admins.testimoni.index', compact('testimonis'));
    }

    return view('users.testimoni.index', compact('testimonis', 'pemesananProduks', 'pemesananJahitans', 'modifikasiJahitans'));
    }

    public function create(Request $request)
    {
        $data = [
            'pemesananProdukId' => $request->pemesanan_produk_id,
            'pemesananJahitanId' => $request->pemesanan_jahitan_id,
            'modifikasiJahitanId' => $request->modifikasi_jahitan_id,
        ];
        return view('users.testimoni.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'rate' => 'required|integer|min:1|max:5',
            'deskripsi' => 'required|string|max:1000',
            'gambar_testimoni' => 'nullable|image|mimes:jpg,jpeg,png|max:5000',

            'pemesanan_jahitan_id' => 'nullable|exists:pemesanan_jahitans,pemesanan_jahitan_id',
            'pemesanan_produk_id' => 'nullable|exists:pemesanan_produks,pemesanan_produk_id',
            'modifikasi_jahitan_id' => 'nullable|exists:modifikasi_jahitans,modifikasi_jahitan_id',
        ]);
        Log::info('Validasi berhasil lanjut ke simpan data');   
        // Validasi tambahan: hanya satu dari tiga ID yang boleh diisi
        $count = collect([
            $request->pemesanan_jahitan_id,
            $request->pemesanan_produk_id,
            $request->modifikasi_jahitan_id,
        ])->filter()->count();

        if ($count !== 1) {
            return back()->withInput()->withErrors([
                'relasi' => 'Harap isi salah satu dari Pemesanan Jahitan, Pemesanan Produk, atau Modifikasi Jahitan.',
            ]);
        }

        $data = $request->only([
            'rate', 
            'deskripsi', 
            'pemesanan_jahitan_id', 
            'pemesanan_produk_id', 
            'modifikasi_jahitan_id'
        ]);


        $data['user_id'] = Auth::id();

        if ($request->hasFile('gambar_testimoni')) {
            $data['gambar_testimoni'] = $request->file('gambar_testimoni')->store('testimoni', 'public');
        }

        Testimoni::create($data);
        
        return redirect()->route('user.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');

    }


    public function edit($id)
    {
        $testimoni = Testimoni::where('user_id', Auth::id())
                            ->where('testimoni_id', $id)
                            ->firstOrFail();

        return view('users.testimoni.edit', compact('testimoni'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'rate' => 'required|integer|min:1|max:5',
            'deskripsi' => 'required|string|max:1000',
            'gambar_testimoni' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'pemesanan_jahitan_id' => 'nullable|exists:pemesanan_jahitans,pemesanan_jahitans_id',
            'pemesanan_produk_id' => 'nullable|exists:pemesanan_produks,pemesanan_produks_id',
            'modifikasi_jahitan_id' => 'nullable|exists:modifikasi_jahitans,modifikasi_jahitans_id',
        ]);

        // Pastikan hanya satu relasi yang dipilih
        $count = collect([
            $request->pemesanan_jahitan_id,
            $request->pemesanan_produk_id,
            $request->modifikasi_jahitan_id,
        ])->filter()->count();

        if ($count !== 1) {
            return back()->withInput()->withErrors([
                'relasi' => 'Harap isi salah satu dari Pemesanan Jahitan, Pemesanan Produk, atau Modifikasi Jahitan.',
            ]);
        }

        $testimoni = Testimoni::where('user_id', Auth::id())->findOrFail($id);

        $data = $request->only([
            'rate',
            'deskripsi',
            'pemesanan_jahitan_id',
            'pemesanan_produk_id',
            'modifikasi_jahitan_id'
        ]);

        if ($request->hasFile('gambar_testimoni')) {
            $data['gambar_testimoni'] = $request->file('gambar_testimoni')->store('testimoni', 'public');
        }

        $testimoni->update($data);

        return redirect()->route('user.testimoni.index')->with('success', 'Testimoni berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $testimoni = Testimoni::where('user_id', Auth::id())->findOrFail($id);
        $testimoni->delete();

        return redirect()->route('user.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
