<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PemesananJahitan;
use App\Models\PemesananProduk;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PemasukanController extends Controller
{
    /**
     * Menampilkan laporan pemasukan dinamis dari sistem.
     */
    public function index()
    {
        $produkSelesai = PemesananProduk::where('status', 'selesai')->with('produks')->get();

        // Ambil semua jahitan dengan status 'diproses' dan 'selesai'
        $jahitan = PemesananJahitan::whereIn('status', ['diproses', 'selesai'])->get();

        $semuaPemasukan = new Collection();

        // Pemesanan Produk (diasumsikan lunas)
        foreach ($produkSelesai as $pp) {
            $semuaPemasukan->push([
                'tanggal' => $pp->updated_at,
                'sumber' => 'Pemesanan Produk',
                'keterangan' => 'Penjualan Produk: ' . ($pp->jenis_pakaian ?? 'Jenis Pakaian Tidak Diketahui'),
                'nama_pelanggan' => $pp->nama,
                'jumlah' => $pp->total_harga,
                'sisa_pembayaran' => 0, // Produk dianggap lunas
            ]);
        }

        // --- LOGIKA BARU UNTUK PEMESANAN JAHITAN ---

        // Definisikan biaya
        $hargaDp = 100000;
        $hargaTotalJahit = 300000; // Asumsi total biaya jahit
        $hargaPelunasan = $hargaTotalJahit - $hargaDp;

        foreach ($jahitan as $pj) {
            // 1. Tambahkan entri untuk Uang Muka (DP)
            // Setiap pesanan yang statusnya 'diproses' atau 'selesai' pasti sudah membayar DP.
            // Kita gunakan 'created_at' sebagai tanggal DP karena lebih stabil.
            $semuaPemasukan->push([
                'tanggal' => $pj->created_at, // Tanggal DP dianggap saat pesanan dibuat
                'sumber' => 'Pemesanan Jahitan',
                'keterangan' => 'Uang Muka (DP) Jahit: ' . $pj->jenis_pakaian,
                'nama_pelanggan' => $pj->nama,
                'jumlah' => $hargaDp,
                'sisa_pembayaran' => $hargaPelunasan, // Sisa setelah DP
            ]);

            // 2. Jika status sudah 'selesai', tambahkan entri untuk Pelunasan
            if ($pj->status === 'selesai') {
                $semuaPemasukan->push([
                    'tanggal' => $pj->updated_at, // Tanggal pelunasan saat status diubah jadi 'selesai'
                    'sumber' => 'Pemesanan Jahitan',
                    'keterangan' => 'Pelunasan Jahit: ' . $pj->jenis_pakaian,
                    'nama_pelanggan' => $pj->nama,
                    'jumlah' => $hargaPelunasan,
                    'sisa_pembayaran' => 0, // Setelah pelunasan, sisa 0
                ]);
            }
        }

        // --- AKHIR LOGIKA BARU UNTUK PEMESANAN JAHITAN ---
        // Sort dan paginate
        $pemasukanTerurut = $semuaPemasukan->sortByDesc('tanggal');
        $totalPemasukan = $pemasukanTerurut->sum('jumlah');
        $pemasukanBulanIni = $pemasukanTerurut->where('tanggal', '>=', now()->startOfMonth())->sum('jumlah');
        // totalTransaksi sekarang akan menghitung setiap DP dan Pelunasan sebagai transaksi terpisah
        $totalTransaksi = $pemasukanTerurut->count();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentPageItems = $pemasukanTerurut->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($pemasukanTerurut), $perPage);
        $paginatedItems->setPath(request()->url());

        return view('admins.pemasukan.index', [
            'pemasukans' => $paginatedItems,
            'totalPemasukan' => $totalPemasukan,
            'pemasukanBulanIni' => $pemasukanBulanIni,
            'totalTransaksi' => $totalTransaksi,
        ]);
    }
}
