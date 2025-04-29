<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModifikasiJahitan; // Ganti model ke ModifikasiJahitan
// use Illuminate\Support\Facades\Auth; // Tidak diperlukan jika hanya admin

class ModifikasiJahitanController extends Controller
{
    // Menerapkan middleware ke semua method di controller ini
    // Mengikuti contoh, user biasa tidak bisa akses CRUD admin ini
    public function __construct()
    {
        $this->middleware('auth'); // Semua harus login
        $this->middleware('admin'); // Semua method ini hanya untuk admin
    }

    /**
     * Admin - Menampilkan daftar semua modifikasi jahitan. (READ - List)
     */
    public function index()
    {
        // Ambil data modifikasi jahitan dengan pagination
        $daftarModifikasiJahitan = ModifikasiJahitan::orderBy('created_at', 'desc')->paginate(10); // Urutkan dari terbaru
        // Kirim data ke view admin
        return view('admins.modifikasi_jahitan.index', compact('daftarModifikasiJahitan')); // Sesuaikan path view
    }

    /**
     * Admin - Menampilkan form untuk membuat modifikasi jahitan baru. (CREATE - Form)
     * Kita buat method create terpisah untuk admin
     */
    public function create()
    {
        // Tampilkan view form tambah modifikasi jahitan untuk admin
        return view('admins.modifikasi_jahitan.create'); // Sesuaikan path view
    }

    /**
     * Admin - Menyimpan modifikasi jahitan baru ke database. (CREATE - Save)
     * Kita buat method store terpisah untuk admin
     */
    public function store(Request $request)
    {
        // Validasi input data dari form admin
        $validatedData = $request->validate([
            'nama'          => 'required|string|max:255',
            'catatan'       => 'nullable|string', // Catatan boleh kosong
            'jenis_pakaian' => 'required|string|max:255',
        ]);

        // Buat record baru di database
        ModifikasiJahitan::create($validatedData);

        // Redirect ke halaman index admin dengan pesan sukses
        return redirect()
            ->route('admins.modifikasi-jahitan.index') // Sesuaikan nama route
            ->with('success', 'Data Modifikasi Jahitan berhasil ditambahkan!');
    }

    /**
     * Admin - Menampilkan detail spesifik modifikasi jahitan. (READ - Detail)
     */
    public function show($id)
    {
        // Cari data berdasarkan ID, error jika tidak ketemu
        $modifikasiJahitan = ModifikasiJahitan::findOrFail($id);
        // Tampilkan view detail
        return view('admins.modifikasi_jahitan.show', compact('modifikasiJahitan')); // Sesuaikan path view
    }

    /**
     * Admin - Menampilkan form untuk mengedit modifikasi jahitan. (UPDATE - Form)
     */
    public function edit($id)
    {
        // Cari data berdasarkan ID
        $modifikasiJahitan = ModifikasiJahitan::findOrFail($id);
        // Tampilkan view form edit dengan data yang ada
        return view('admins.modifikasi_jahitan.edit', compact('modifikasiJahitan')); // Sesuaikan path view
    }

    /**
     * Admin - Memperbarui data modifikasi jahitan di database. (UPDATE - Save)
     */
    public function update(Request $request, $id)
    {
        // Validasi input data dari form edit
        $validatedData = $request->validate([
            'nama'          => 'required|string|max:255',
            'catatan'       => 'nullable|string',
            'jenis_pakaian' => 'required|string|max:255',
        ]);

        // Cari data yang akan diupdate
        $modifikasiJahitan = ModifikasiJahitan::findOrFail($id);
        // Update data
        $modifikasiJahitan->update($validatedData);

        // Redirect ke halaman index admin dengan pesan sukses
        return redirect()
            ->route('admins.modifikasi-jahitan.index') // Sesuaikan nama route
            ->with('success', 'Data Modifikasi Jahitan berhasil diperbarui!');
    }

    /**
     * Admin - Menghapus data modifikasi jahitan dari database. (DELETE)
     */
    public function destroy($id)
    {
        // Cari data yang akan dihapus
        $modifikasiJahitan = ModifikasiJahitan::findOrFail($id);
        // Hapus data
        $modifikasiJahitan->delete();

        // Redirect ke halaman index admin dengan pesan sukses
        return redirect()
            ->route('admins.modifikasi-jahitan.index') // Sesuaikan nama route
            ->with('success', 'Data Modifikasi Jahitan berhasil dihapus!');
    }
}
