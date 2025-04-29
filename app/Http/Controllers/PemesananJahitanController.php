<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JahitanOrder;
use Illuminate\Support\Facades\Auth;

class PemesananJahitanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store']);
        $this->middleware('admin')->only(['index', 'edit', 'update', 'destroy', 'show']);
    }

    // User-facing create form
    public function create()
    {
        return view('users.pemesanan_jahitan');
    }

    // User-facing store
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'jenis' => 'required|string|in:Kemeja,Gaun,Kebaya',
            'bahan' => 'required|string|in:Brokat,Renda,Katun,Linen,Flanel',
            'warna' => 'required|string|max:255',
            'ukuran' => 'required|string',
        ]);

        $order = new JahitanOrder($validatedData);
        $order->save();

        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('pemesanan-jahit.index')->with('success', 'Order created successfully!');
        } else {
            return response()->json(['success' => 'Pemesanan berhasil!']);
        }
    }

    // Admin - List all orders
    public function index()
    {
        $pemesananJahit = JahitanOrder::paginate(10); // Pakai paginate
        return view('admins.adminPemesananJahitan', compact('pemesananJahit'));
    }

    // Admin - Show detail
    public function show($id)
    {
        $pemesananJahitan = JahitanOrder::findOrFail($id);
        return view('admins.pemesanan_jahitan_show', compact('pemesananJahitan'));
    }

    // Admin - Edit order form
    public function edit($id)
    {
        $order = JahitanOrder::findOrFail($id);
        return view('admins.jahitan_edit', compact('order'));
    }

    // Admin - Update order
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'jenis' => 'required|string|in:Kemeja,Gaun,Kebaya',
            'bahan' => 'required|string|in:Brokat,Renda,Katun,Linen,Flanel',
            'warna' => 'required|string|max:255',
            'ukuran' => 'required|string',
        ]);

        $order = JahitanOrder::findOrFail($id);
        $order->update($validatedData);

        return redirect()->route('pemesanan-jahit.index')->with('success', 'Order updated successfully!');
    }

    // Admin - Delete order
    public function destroy($id)
    {
        $order = JahitanOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('pemesanan-jahitan.index')->with('success', 'Order deleted successfully!');
    }
}
