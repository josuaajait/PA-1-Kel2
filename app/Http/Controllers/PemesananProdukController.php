<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class PemesananProdukController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'product')->latest()->get();
        return view('admins.pemesanan_produk', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('user', 'product')->findOrFail($id);
        return view('admins.pemesanan_detail', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('pemesanan.produk')->with('success', 'Pesanan berhasil dihapus.');
    }
}
