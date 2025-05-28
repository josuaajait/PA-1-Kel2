<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModifikasiJahitan;
use App\Models\PemesananJahitan;
use App\Models\PemesananProduk;

class ModifikasiJahitanController extends Controller
{
    // Menerapkan middleware ke semua method di controller ini
    // Mengikuti contoh, user biasa tidak bisa akses CRUD admin ini

    /**
     * Admin - Menampilkan daftar semua modifikasi jahitan. (READ - List)
     */
    public function index()
    {
        $pemesananProduk = PemesananProduk::all(); // atau paginate, filter, dll
        $pemesananJahitan = PemesananJahitan::all(); // atau paginate, filter, dll  

        $daftarModifikasiJahitan = ModifikasiJahitan::orderBy('created_at', 'desc')->paginate(10); // Urutkan dari terbaru
        // Kirim data ke view admin
        return view('admins.modifikasi_jahitan.index', compact('pemesananProduk', 'pemesananJahitan')); // Sesuaikan path view
    }

    /**
     * Admin - Menampilkan form untuk membuat modifikasi jahitan baru. (CREATE - Form)
     * Kita buat method create terpisah untuk admin
     */
    public function create(Request $request)
    {
        $type = $request->query('type'); // produk atau jahitan
        $id = $request->query('id');

        $pemesananProduk = PemesananProduk::where('status', 'selesai')->get();
        $pemesananJahitan = PemesananJahitan::where('status', 'selesai')->get();

        // Ambil data spesifik berdasarkan type dan id untuk prefill form (jika perlu)
        if ($type === 'produk') {
            $data = PemesananProduk::findOrFail($id);
        } elseif ($type === 'jahitan') {
            $data = PemesananJahitan::findOrFail($id);
        } else {
            abort(404);
        }

        return view('admins.modifikasi_jahitan.create', compact('pemesananProduk', 'pemesananJahitan', 'data', 'type'));
    }



    /**
     * Admin - Menyimpan modifikasi jahitan baru ke database. (CREATE - Save)
     * Kita buat method store terpisah untuk admin
     */
    public function store(Request $request)
    {
        $request->validate([
            'pemesanan_id' => 'required',
            'catatan' => 'required|string',
        ]);

        [$type, $id] = explode('-', $request->pemesanan_id);

        if ($type === 'produk') {
            $pemesanan = PemesananProduk::findOrFail($id);
            $nama = $pemesanan->nama;
            $jenis = $pemesanan->nama_produk;
        } else {
            $pemesanan = PemesananJahitan::findOrFail($id);
            $nama = $pemesanan->nama;
            $jenis = $pemesanan->jenis_pakaian;
        }

        ModifikasiJahitan::create([
            'user_id' => auth()->id(),  // Jangan lupa isi user_id
            'nama' => $nama,
            'jenis_pakaian' => $jenis,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admins.modifikasi-jahitan.index')->with('success', 'Data modifikasi berhasil disimpan.');
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

        // Untuk menampilkan form create (view)
        public function createCustomer()
        {
            return view('users.modifikasi_jahitan.create');
        }

        // Untuk menyimpan data dari user
        public function storeCustomer(Request $request)
        {
            $request->validate([
                'nama' => 'required|string|max:255',
                'jenis_pakaian' => 'required|string|max:255',
                'catatan' => 'required|string',
            ]);

            ModifikasiJahitan::create([
                'user_id' => auth()->id(),
                'nama' => $request->nama,
                'jenis_pakaian' => $request->jenis_pakaian,
                'catatan' => $request->catatan,
            ]);

            return redirect()->back()->with('success', 'Pengajuan modifikasi berhasil dikirim.');
        }


}
