<?php

namespace App\Http\Controllers;
use App\Models\Produk;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::orderBy('created_at', 'desc')->take(4)->get();
        return view('users.home', compact('produks'));
    }

}
