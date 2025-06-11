<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TestimoniController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimoni::with('user');

        // Sorting logic
        switch ($request->get('sort')) {
            case 'highest_rating':
                $query->orderBy('rate', 'desc');
                break;
            case 'lowest_rating':
                $query->orderBy('rate', 'asc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->latest();
        }

        $testimonis = $query->paginate(10);

        if (auth()->user()->role === 'admin') {
            return view('admins.testimoni.index', compact('testimonis'));
        }

        return view('users.testimoni.index', compact('testimonis'));
    }

    public function create()
    {
        return view('users.testimoni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rate' => 'required|integer|min:1|max:5',
            'deskripsi' => 'required|string|max:1000',
            'gambar_testimoni' => 'nullable|image|mimes:jpg,jpeg,png|max:5000',
        ]);

        $data = $request->only(['rate', 'deskripsi']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('gambar_testimoni')) {
            $data['gambar_testimoni'] = $request->file('gambar_testimoni')->store('testimoni', 'public');
        }

        Testimoni::create($data);

        return redirect()->route('user.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $testimoni = Testimoni::where('user_id', Auth::id())
            ->where('testimoni_id', $id)
            ->firstOrFail();

        return view('users.testimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rate' => 'required|integer|min:1|max:5',
            'deskripsi' => 'required|string|max:1000',
            'gambar_testimoni' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $testimoni = Testimoni::where('user_id', Auth::id())->findOrFail($id);

        $data = $request->only(['rate', 'deskripsi']);

        if ($request->hasFile('gambar_testimoni')) {
            $data['gambar_testimoni'] = $request->file('gambar_testimoni')->store('testimoni', 'public');
        }

        $testimoni->update($data);

        return redirect()->route('user.testimoni.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $testimoni = Testimoni::findOrFail($id);

        // Jika user biasa, pastikan dia hanya bisa hapus miliknya
        if (auth()->user()->role !== 'admin' && $testimoni->user_id !== auth()->id()) {
            abort(403);
        }

        $testimoni->delete();

        $route = auth()->user()->role === 'admin' ? 'admins.testimoni.index' : 'user.testimoni.index';

        return redirect()->route($route)->with('success', 'Testimoni berhasil dihapus.');
    }


}
