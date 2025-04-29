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
        $role = auth()->check() ? auth()->user()->role : 'guest';
        return view('users.pemesanan_jahitan', compact('role'));
    }
    
    // User-facing store
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
            'jenis'   => 'required|string|in:Kemeja,Gaun,Kebaya',
            'bahan'   => 'required|string|in:Brokat,Renda,Katun,Linen,Flanel',
            'warna'   => 'required|string|max:255',
            'ukuran'  => 'required|string',
        ]);
    
        $order = JahitanOrder::create($data);
    
        if ($request->ajax()) {
            // always JSON untuk AJAX (user)
            return response()->json(['success' => 'Pemesanan berhasil!']);
        }
    
        // normal POST (admin)
        return redirect()
            ->route('admins.pemesanan-jahitan.index')
            ->with('success', 'Order created successfully!');
    }
    

    // Admin - List all orders
    public function index()
    {
        $pemesananJahitan = JahitanOrder::paginate(10); // Pakai paginate
        return view('admins.adminPemesananJahitan', compact('pemesananJahitan'));
    }

    // Admin - Show detail
    public function show($id)
    {
        $pemesananJahitan = JahitanOrder::findOrFail($id);
        return view('admins.pemesanan_jahitan_detail', compact('pemesananJahitan'));
    }

    // Admin - Edit order form
    public function edit($id)

    {
        $pemesananJahitan = JahitanOrder::findOrFail($id);
        return view('admins.pemesanan_jahitan_edit', compact('pemesananJahitan'));
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

        return redirect()->route('pemesanan-jahitan.index')->with('success', 'Order updated successfully!');
    }

    // Admin - Delete order
    public function destroy($id)
    {
        $order = JahitanOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('pemesanan-jahitan.index')->with('success', 'Order deleted successfully!');
    }
}
