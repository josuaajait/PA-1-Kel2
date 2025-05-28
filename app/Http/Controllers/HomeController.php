<?php

namespace App\Http\Controllers;
use App\Models\Produk;  

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $produks = Produk::all();  // Atau pakai paginate sesuai kebutuhan
    return view('users.home', compact('produks'));
}

}
