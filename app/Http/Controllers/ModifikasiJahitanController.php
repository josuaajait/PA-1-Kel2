<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModifikasiJahitan;
use App\Models\PemesananJahitan;
use App\Models\PemesananProduk;
use App\Models\Produk;

class ModifikasiJahitanController extends Controller
{
    // Menerapkan middleware ke semua method di controller ini
    // Mengikuti contoh, user biasa tidak bisa akses CRUD admin ini

    /**
     * Admin - Menampilkan daftar semua modifikasi jahitan. (READ - List)
     */
    public function index()
    {
        $pemesananProduk = PemesananProduk::where('status', 'selesai')->get();
        $pemesananJahitans = PemesananJahitan::where('status', 'selesai')->get();
        $daftarModifikasiJahitan = ModifikasiJahitan::orderBy('created_at', 'desc')->paginate(10); // Urutkan dari terbaru

        // Kirim data ke view admin
        return view('admins.modifikasi_jahitan.index', compact(
            'pemesananProduk',
            'pemesananJahitans',
            'daftarModifikasiJahitan' // ✅ tambahkan ini
        ));
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

        // Validasi bahwa type dan id tersedia
        if ($type === 'produk' && $id) {
            $data = PemesananProduk::with('produks')->where('pemesanan_produk_id', $id)->firstOrFail();
        } elseif ($type === 'jahitan' && $id) {
            $data = PemesananJahitan::where('pemesanan_jahitan_id', $id)->firstOrFail();
        } else {
            // Redirect atau tampilkan error jika tidak valid
            return redirect()->back()->with('error', 'Data pemesanan tidak ditemukan.');
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
            // validasi salah satu id yang harus ada
            'pemesanan_produk_id' => 'nullable|exists:pemesanan_produks,pemesanan_produk_id',
            'pemesanan_jahitan_id' => 'nullable|exists:pemesanan_jahitans,pemesanan_jahitan_id',
            'catatan' => 'required|string',
        ]);

            $nama = '';
            $jenis = '';
            $userId = auth()->id();

            if ($request->filled('pemesanan_produk_id')) {
                $pemesanan = PemesananProduk::findOrFail($request->pemesanan_produk_id);
                $nama = $pemesanan->nama;
                $jenis = $pemesanan->jenis_pakaian;
            } elseif ($request->filled('pemesanan_jahitan_id')) {
                $pemesanan = PemesananJahitan::findOrFail($request->pemesanan_jahitan_id);
                $nama = $pemesanan->nama;
                $jenis = $pemesanan->jenis_pakaian;
            } else {
                return back()->withErrors('Pemesanan tidak valid.');
            }

         ModifikasiJahitan::create([
        'user_id' => $userId,
        'nama' => $nama,
        'jenis_pakaian' => $jenis,
        'catatan' => $request->catatan,
        'pemesanan_produk_id' => $request->pemesanan_produk_id,
        'pemesanan_jahitan_id' => $request->pemesanan_jahitan_id,
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
            $userId = auth()->id();

            $pemesananProduks = PemesananProduk::where('user_id', $userId)
                ->where('status', 'selesai')
                ->get();

            $pemesananJahitans = PemesananJahitan::where('user_id', $userId)
                ->where('status', 'selesai')
                ->get();

            return view('users.modifikasi_jahitan.create', compact('pemesananProduks', 'pemesananJahitans'));
        }



                // Untuk menyimpan data dari user
        public function storeCustomer(Request $request)
        {
            $request->validate([
                'pemesanan' => 'required|string',
                'catatan' => 'required|string',
            ]);

            list($tipe, $id) = explode('|', $request->pemesanan);

            if ($tipe === 'produk') {
                $pemesanan = PemesananProduk::findOrFail($id);
                $pemesananProdukId = $id;
                $pemesananJahitanId = null;
            } elseif ($tipe === 'jahitan') {
                $pemesanan = PemesananJahitan::findOrFail($id);
                $pemesananJahitanId = $id;
                $pemesananProdukId = null;
            } else {
                return back()->withErrors(['Pemesanan tidak valid.']);
            }

            ModifikasiJahitan::create([
                'user_id' => auth()->id(),
                'nama' => $pemesanan->nama,
                'jenis_pakaian' => $pemesanan->jenis_pakaian,
                'catatan' => $request->catatan,
                'pemesanan_produk_id' => $pemesananProdukId,
                'pemesanan_jahitan_id' => $pemesananJahitanId,
            ]);

            return redirect()->back()->with('success', 'Pengajuan modifikasi berhasil dikirim.');
        }

}
