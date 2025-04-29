<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
        public function profil()
    {
        $user = auth()->user();
        return view('users.profil', compact('user'));
    }

}
