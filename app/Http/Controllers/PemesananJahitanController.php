<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananJahitan;
use Illuminate\Support\Facades\Auth;
use App\Models\UkuranPakaian;
use Illuminate\Support\Str;

class PemesananJahitanController extends Controller
{
    // Tampilkan daftar pemesanan jahitan (admin)
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $pemesananJahitan = PemesananJahitan::paginate(8);
            return view('admins.pemesanan_jahitan.index', compact('pemesananJahitan'));
        }

        // User hanya melihat data miliknya
        $pemesananJahitan = PemesananJahitan::where('user_id', Auth::id())->get();
        return view('users.pemesanan_jahitan.pemesanan_jahitan', compact('pemesananJahitan'));
    }

    // Form create pemesanan jahitan (user/admin)
    public function create()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return view('admins.pemesanan_jahitan.create');
            } else {
                return view('users.pemesanan_jahitan.pemesanan_jahitan');
            }
        } else {
            // Guest (belum login)
            return view('users.pemesanan_jahitan.pemesanan_jahitan');
        }
    }


    // Simpan data pemesanan baru

    public function store(Request $request)
    {
        $request->validate([
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:13',
        'alamat' => 'required|string',
        'jenis_pakaian' => 'required|string',
        'bahan' => 'required|string',
        'warna' => 'required|string',
        'referensi_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        'bukti_pembayaran_lunas' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        'bukti_pembayaran_uang_muka' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',

        // Validasi ukuran pakaian
        'lingkar_dada' => 'numeric',
        'lingkar_pinggang' => 'numeric',
        'lingkar_pinggul' => 'numeric', // ← tambahkan ini
        'panjang_baju' => ['nullable', 'numeric', function ($attribute, $value, $fail) use ($request) {
        if (in_array(strtolower($request->jenis_pakaian), ['gaun', 'kebaya']) && (!$value || $value <= 0)) {
            $fail('Panjang Baju wajib diisi untuk jenis pakaian Gaun atau Kebaya.');
        }
        }],
        'panjang_lengan' => 'numeric',
        'lebar_bahu' => 'numeric',
        'lingkar_lengan' => 'numeric',
        'lingkar_pergelangan' => 'numeric',
        'tinggi_badan' => 'numeric',
        ], [
        // Pesan error untuk data umum
        'nama.required' => 'Nama wajib diisi.',
        'no_hp.required' => 'Nomor HP wajib diisi.',
        'no_hp.max' => 'Nomor HP maksimal 13 karakter.',
        'alamat.required' => 'Alamat wajib diisi.',
        'jenis_pakaian.required' => 'Jenis pakaian wajib diisi.',
        'bahan.required' => 'Bahan wajib diisi.',
        'warna.required' => 'Warna wajib diisi.',

        // Pesan error untuk file
        'referensi_gambar.image' => 'Referensi gambar harus berupa file gambar.',
        'referensi_gambar.mimes' => 'Referensi gambar harus berformat jpeg, png, atau jpg.',
        'referensi_gambar.max' => 'Ukuran referensi gambar maksimal 5MB.',
        'bukti_pembayaran_lunas.image' => 'Bukti pembayaran lunas harus berupa file gambar.',
        'bukti_pembayaran_lunas.mimes' => 'Bukti pembayaran lunas harus berformat jpeg, png, atau jpg.',
        'bukti_pembayaran_lunas.max' => 'Ukuran bukti pembayaran lunas maksimal 5MB.',
        'bukti_pembayaran_uang_muka.image' => 'Bukti pembayaran uang muka harus berupa file gambar.',
        'bukti_pembayaran_uang_muka.mimes' => 'Bukti pembayaran uang muka harus berformat jpeg, png, atau jpg.',
        'bukti_pembayaran_uang_muka.max' => 'Ukuran bukti pembayaran uang muka maksimal 5MB.',

        // Pesan error untuk ukuran pakaian
        'lingkar_dada.numeric' => 'Lingkar dada harus berupa angka.',
        'lingkar_pinggang.numeric' => 'Lingkar pinggang harus berupa angka.',
        'lingkar_pinggul.numeric' => 'Lingkar pinggul harus berupa angka.',
        'panjang_baju.numeric' => 'Panjang baju harus berupa angka.',

        'lebar_bahu.numeric' => 'Lebar bahu harus berupa angka.',
        'lingkar_lengan.numeric' => 'Lingkar lengan harus berupa angka.',
        'lingkar_pergelangan.numeric' => 'Lingkar pergelangan harus berupa angka.',
        'tinggi_badan.numeric' => 'Tinggi badan harus berupa angka.',
    ]);

        // Format nomor HP
        $rawHp = preg_replace('/[^0-9]/', '', $request->no_hp);

        if (Str::startsWith($rawHp, '0')) {
            $rawHp = '62' . substr($rawHp, 1);
        } elseif (Str::startsWith($rawHp, '620')) {
            $rawHp = '62' . substr($rawHp, 3);
        } elseif (!Str::startsWith($rawHp, '62')) {
            $rawHp = '62' . $rawHp;
        }

         // Ambil data umum
        $data = $request->only(['nama', 'alamat', 'jenis_pakaian', 'bahan', 'warna']);
        $data['no_hp'] = $rawHp; // ← sudah diformat
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        // Upload file
        if ($request->hasFile('referensi_gambar')) {
            $data['referensi_gambar'] = $request->file('referensi_gambar')->store('referensi_gambar', 'public');
        }
        if ($request->hasFile('bukti_pembayaran_lunas')) {
            $data['bukti_pembayaran_lunas'] = $request->file('bukti_pembayaran_lunas')->store('bukti_pembayaran_lunas', 'public');
        }
        if ($request->hasFile('bukti_pembayaran_uang_muka')) {
            $data['bukti_pembayaran_uang_muka'] = $request->file('bukti_pembayaran_uang_muka')->store('bukti_pembayaran_uang_muka', 'public');
        }

        // Simpan ke pemesanan_jahitans
        $pemesanan = PemesananJahitan::create($data);

        // Simpan ukuran ke tabel ukuran_pakaian
        UkuranPakaian::create([
            'pemesanan_jahitan_id' => $pemesanan->pemesanan_jahitan_id,
            'lingkar_dada' => $request->input('lingkar_dada'),
            'lingkar_pinggang' => $request->input('lingkar_pinggang'),
            'lingkar_pinggul' => $request->input('lingkar_pinggul'),
            'panjang_baju' => $request->input('panjang_baju'),
            'panjang_lengan' => $request->input('panjang_lengan'),
            'lebar_bahu' => $request->input('lebar_bahu'),
            'lingkar_lengan' => $request->input('lingkar_lengan'),
            'lingkar_pergelangan' => $request->input('lingkar_pergelangan'),
            'tinggi_badan' => $request->input('tinggi_badan'),
        ]);

        return redirect()->route(Auth::user()->role === 'admin' ? 'admins.pemesanan-jahitan.index' : 'user.pemesanan_jahitan.create')
            ->with('success', 'Pesanan Diproses.');
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
            'no_hp' => 'required|string|max:13',
            'alamat' => 'required|string',
            'jenis_pakaian' => 'required|string',
            'bahan' => 'required|string',
            'warna' => 'required|string',
            'status' => 'required|in:pending,diproses,dibatalkan,selesai',
            'referensi_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = $request->only([
            'nama', 'no_hp', 'alamat', 'jenis_pakaian', 'bahan', 'warna', 'status'
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
