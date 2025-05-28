<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PemesananJahitan;
use App\Models\PemesananProduk;

class RiwayatPemesananController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin melihat semua riwayat pemesanan jahitan dan produk
            $pemesananJahitans = PemesananJahitan::orderBy('created_at', 'desc')->paginate(10);
            $pemesananProduks = PemesananProduk::orderBy('created_at', 'desc')->paginate(10);

            return view('admins.riwayat_pemesanan.index', compact('pemesananJahitans', 'pemesananProduks'));
        } else {
            // User melihat riwayat milik dirinya sendiri
            $pemesananJahitans = PemesananJahitan::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
            $pemesananProduks = PemesananProduk::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

            return view('users.riwayat_pemesanan.index', compact('pemesananJahitans', 'pemesananProduks'));
        }
    }
}
