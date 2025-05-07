<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    // Admin: Tampilkan semua entri untuk dikelola
    public function index()
{
    // Sebelumnya menggunakan get(), yang mengembalikan koleksi biasa
    // $aboutUs = AboutUs::all();

    // Gunakan paginate() untuk mendapatkan objek paginated
    $aboutUs = AboutUs::paginate(10); // Atur jumlah per halaman (contoh: 10)

    return view('admins.aboutus.adminaboutus', compact('aboutUs'));
}


    // Admin: Form tambah data
    public function create()
    {
        return view('admins.aboutus.create');
    }

    // Admin: Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'sejarah' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        AboutUs::create([
            'deskripsi' => $request->deskripsi,
            'sejarah' => $request->sejarah,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('about.create')->with('success', 'Data berhasil ditambahkan.');
    }

    // Admin: Form edit data
    public function edit($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('admins.aboutus.edit', compact('aboutUs'));
    }

    // Admin: Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'sejarah' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->update([
            'deskripsi' => $request->deskripsi,
            'sejarah' => $request->sejarah,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('about.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Admin: Hapus data
    public function destroy($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->delete();
        return redirect()->route('about.index')->with('success', 'Data berhasil dihapus.');
    }

    // User: Tampilkan About Us aktif
    public function detail($id)
    {
        $aboutUs = AboutUs::find($id); // Mengambil data berdasarkan ID

    if (!$aboutUs) {
            // Jika data tidak ditemukan, arahkan ke halaman 404 atau tampilkan pesan error
            return redirect()->route('about.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('admins.aboutus.detail', compact('aboutUs')); // Mengirimkan data ke view
    }

    public function activate($id)
    {
        AboutUs::query()->update(['is_active' => false]); // Nonaktifkan semua
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->is_active = true;
        $aboutUs->save();

        return redirect()->route('about.index')->with('success', 'Template berhasil diaktifkan.');
    }

    // User: Tampilkan hanya data yang aktif
    // Di dalam AboutUsController
    public function showActive()
    {
        $aboutUs = AboutUs::where('is_active', true)->first(); // Ambil yang aktif saja
        return view('users.aboutus.show', compact('aboutUs'));
    }



}

