<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::paginate(8); // Ambil 8 data per halaman
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return view('admins.produk.index', compact('produks'));
        } else {
            return view('users.produk.produk', compact('produks'));
        }
    }


    public function show(Produk $produk)
    {
        $user = Auth::user();
            return view('admins.produk.show', compact('produk'));
        
    }

    public function create()
    {
        $this->authorizeAdmin(); // hanya admin boleh akses
        return view('admins.produk.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin(); // hanya admin boleh akses

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_pakaian'=>'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:tersedia,tidak tersedia',
            'ukuran' => 'nullable|string',
            'warna' => 'nullable|string',
            'bahan' => 'nullable|string',
        ]);

        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('public/produk_images', $filename);
            $validated['gambar'] = $filename;
        }

        $validated['user_id'] = Auth::id(); // Simpan id pembuat produk

        Produk::create($validated);
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');

    }

    public function edit(Produk $produk)
    {
        $this->authorizeAdmin(); // hanya admin boleh akses
        return view('admins.produk.edit', compact('produk'));
    }

public function update(Request $request, Produk $produk)
{
    $this->authorizeAdmin(); // Pastikan user admin

    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'jenis_pakaian'=>'required|string',
        'harga' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'status' => 'required|in:tersedia,tidak tersedia',
        'ukuran' => 'nullable|string',
        'warna' => 'nullable|string',
        'bahan' => 'nullable|string',
    ]);

    if ($request->hasFile('gambar')) {
    $filename = time() . '.' . $request->gambar->extension();
    $request->gambar->storeAs('public/produk_images', $filename);
    $validated['gambar'] = $filename; // pastikan hanya nama file, tanpa folder 'produk_images/' jika di DB memang hanya nama filenya

    // Hapus gambar lama jika ada
    if ($produk->gambar) {
        Storage::delete('public/produk_images/' . $produk->gambar);
    }
    }

    $produk->update($validated);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function destroy(Produk $produk)
    {
        $this->authorizeAdmin(); // hanya admin boleh akses

        $produk->delete();

        return redirect()->route('admins.produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Membatasi akses hanya untuk admin
     */
    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
    }

    /* Fitur search produk
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $produks = Produk::where('nama', 'like', '%' . $query . '%')
            ->orWhere('jenis_pakaian', 'like', '%' . $query . '%')
            ->orWhere('deskripsi', 'like', '%' . $query . '%')
            ->paginate(8);

        return view('users.produk.produk', compact('produks'));
    }
    public function filter(Request $request)
    {
        $jenis_pakaian = $request->input('jenis_pakaian');
        $status = $request->input('status');

        $query = Produk::query();

        if ($jenis_pakaian) {
            $query->where('jenis_pakaian', $jenis_pakaian);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $produks = $query->paginate(8);

        return view('users.produk.produk', compact('produks'));
    }
}
