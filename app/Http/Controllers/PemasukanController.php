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

        // Pemesanan Produk
        foreach ($produkSelesai as $pp) {
            $semuaPemasukan->push([
                'tanggal' => $pp->updated_at,
                'sumber' => 'Pemesanan Produk',
                'keterangan' => 'Penjualan Produk: ' . ($pp->jenis_pakaian ?? 'Jenis Pakaian Tidak Diketahui'),
                'nama_pelanggan' => $pp->nama,
                'jumlah' => $pp->total_harga,
            ]);
        }

        // Pemesanan Jahitan
        foreach ($jahitan as $pj) {
            $jumlah = 0;

            if ($pj->status === 'diproses') {
                $jumlah = 100000;
            } elseif ($pj->status === 'selesai') {
                $jumlah = 300000;
            }

            $semuaPemasukan->push([
                'tanggal' => $pj->updated_at,
                'sumber' => 'Pemesanan Jahitan',
                'keterangan' => 'Jasa Jahit: ' . $pj->jenis_pakaian . ' (' . $pj->status . ')',
                'nama_pelanggan' => $pj->nama,
                'jumlah' => $jumlah,
            ]);
        }

        // Sort dan paginate
        $pemasukanTerurut = $semuaPemasukan->sortByDesc('tanggal');
        $totalPemasukan = $pemasukanTerurut->sum('jumlah');
        $pemasukanBulanIni = $pemasukanTerurut->where('tanggal', '>=', now()->startOfMonth())->sum('jumlah');
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