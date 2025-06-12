<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PemesananJahitan;
use App\Models\PemesananProduk;
use App\Models\ModifikasiJahitan;

class RiwayatPemesananController extends Controller
{
        public function index()
        {

            $user = Auth::user();
            $user_id = $user->user_id; // akses kolom primary key yang benar
            

            if ($user->role === 'admin') {
                $pemesananJahitans = PemesananJahitan::orderBy('created_at', 'desc')->paginate(8);
                $pemesananProduks = PemesananProduk::orderBy('created_at', 'desc')->paginate(8);
                $pemesananModifikasis = ModifikasiJahitan::orderBy('created_at', 'desc')->paginate(8);

                return view('admins.riwayat_pemesanan.index', compact(
                    'pemesananJahitans',
                    'pemesananProduks',
                    'pemesananModifikasis'
                ));
            } else {
                $pemesananJahitans = PemesananJahitan::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(8);
                $pemesananProduks = PemesananProduk::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(8);
                $pemesananModifikasis = ModifikasiJahitan::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(8);


                return view('users.riwayat_pemesanan.index', compact(
                    'pemesananJahitans',
                    'pemesananProduks',
                    'pemesananModifikasis'
                ));
            }

            }
}
