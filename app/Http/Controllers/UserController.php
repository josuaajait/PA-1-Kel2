<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;



class UserController extends Controller
{
    // CRUD methods (index, create, store, show, edit, update, destroy) - seperti sebelumnya

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
    $request->validate([
        'nama' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:13', // Validasi phone
    ]);

    $user = User::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'customer',
        'password' => bcrypt($request->password),
        'no_hp' => $request->no_hp, 
    ]);

    Auth::login($user);

    return redirect()->intended('/login'); // Redirect ke halaman login setelah registrasi
    }

    public function editProfil()
    {
        $user = auth()->user();
        return view('users.edit_profil', compact('user'));
    }

        public function updateProfil(Request $request)
        {
            
            $user = auth()->user();
            $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
                'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            ]);

            $user = \App\Models\User::find(auth()->user()->user_id);

            $user->fill([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
            ]);

            $user->save();

            return redirect()->route('user.profil')->with('success', 'Profil berhasil diperbarui.');
        }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); // Cegah session fixation

        // Cek role user dan redirect sesuai peran
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admins.adminDashboard');
        } else {
            return redirect()->route('home');
        }
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect ke halaman utama
    }

    public function profil()
    {
        $user = auth()->user(); // ambil user yang sedang login
        return view('users.profil', compact('user'));
    }

}