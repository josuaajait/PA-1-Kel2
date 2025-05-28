<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananJahitan;
use Illuminate\Support\Facades\Auth;

class PemesananJahitanController extends Controller
{
    // Tampilkan daftar pemesanan jahitan (admin)
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $pemesananJahitan = PemesananJahitan::paginate(10);
            return view('admins.pemesanan_jahitan.index', compact('pemesananJahitan'));
        }

        // User hanya melihat data miliknya
        $pemesananJahitan = PemesananJahitan::where('user_id', Auth::id())->get();
        return view('users.pemesanan_jahitan.pemesanan_jahitan', compact('pemesananJahitan'));
    }

    // Form create pemesanan jahitan (user/admin)
    public function create()
    {
        if (Auth::user()->role === 'admin') {
            return view('admins.pemesanan_jahitan.create');
        } else {
            return view('users.pemesanan_jahitan.pemesanan_jahitan');
        }
    }

    // Simpan data pemesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jenis_pakaian' => 'required|string',
            'bahan' => 'required|string',
            'warna' => 'required|string',
            'ukuran' => 'required|string',
            'referensi_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = $request->only([
            'nama', 'no_hp', 'alamat', 'jenis_pakaian', 'bahan', 'warna', 'ukuran'
        ]);
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        if ($request->hasFile('referensi_gambar')) {
            $data['referensi_gambar'] = $request->file('referensi_gambar')->store('referensi_gambar', 'public');
        }

        PemesananJahitan::create($data);

        return redirect()->route(Auth::user()->role === 'admin' ? 'admins.pemesanan-jahitan.index' : 'user.pemesanan_jahitan.create')
            ->with('success', 'Pemesanan jahitan berhasil ditambahkan.');
    }

    // Tampilkan detail pemesanan jahitan
    public function show($id)
    {
        $pemesananJahitan = PemesananJahitan::findOrFail($id);
        return view('admins.pemesanan_jahitan.show', compact('pemesananJahitan'));
    }

    // Form edit pemesanan jahitan
    public function edit($id)
    {
        $pemesananJahitan = PemesananJahitan::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $pemesananJahitan->user_id !== Auth::id()) {
            abort(403);
        }

        $view = Auth::user()->role === 'admin' ? 'admins.pemesanan_jahitan.edit' : 'users.pemesanan_jahitan.edit';

        return view($view, compact('pemesananJahitan'));
    }

    // Update data pemesanan jahitan
    public function update(Request $request, $id)
    {
        $pemesananJahitan = PemesananJahitan::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $pemesananJahitan->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jenis_pakaian' => 'required|string',
            'bahan' => 'required|string',
            'warna' => 'required|string',
            'ukuran' => 'required|string',
            'status' => 'required|in:pending,selesai',
            'referensi_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = $request->only([
            'nama', 'no_hp', 'alamat', 'jenis_pakaian', 'bahan', 'warna', 'ukuran', 'status'
        ]);

        if ($request->hasFile('referensi_gambar')) {
            $data['referensi_gambar'] = $request->file('referensi_gambar')->store('referensi_gambar', 'public');
        }

        $pemesananJahitan->update($data);

        return redirect()->route(Auth::user()->role === 'admin' ? 'admins.pemesanan-jahitan.index' : 'user.pemesanan-jahitan.index')
            ->with('success', 'Pemesanan berhasil diperbarui.');
    }

    // Hapus pemesanan jahitan
    public function destroy($id)
    {
        $pemesananJahitan = PemesananJahitan::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $pemesananJahitan->user_id !== Auth::id()) {
            abort(403);
        }

        $pemesananJahitan->delete();

        return redirect()->route(Auth::user()->role === 'admin' ? 'admins.pemesanan-jahitan.index' : 'user.pemesanan-jahitan.index')
            ->with('success', 'Pemesanan berhasil dihapus.');
    }
}
