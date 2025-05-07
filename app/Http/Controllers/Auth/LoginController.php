<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended($this->redirectTo());
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput()->with('error', 'Invalid login credentials.');
    }

    public function showLoginForm()
    {
        return view('users.login'); // Adjust view name to match your file location
    }

    protected function redirectTo()
    {
        if (Auth::user()->role === 'admin') {
            return '/admin'; // Redirect admin users
        }

        return '/'; // Redirect regular users
    }
}
