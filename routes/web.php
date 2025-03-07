<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModifikasiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layout.main');
});

Route::get('/about', function () {
    return view('users.about');
});

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

Route::get('/pemesanan', function () {
    return view('users.pemesanan');
});

Route::get('/register', function () {
    return view('users.register');
});

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('users.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/admin', function () {
    return view('admins.adminDashboard');
});

Route::get('/admin/profile', function () {
    return view('admins.adminProfile');
});

Route::get('/admin/login', function () {
    return view('admins.adminLogin');
});

Route::get('/admin/signup', function () {
    return view('admins.adminSignUp');
});

Route::get('/admin/pemesanan', function () {
    return view('admins.adminPemesanan');
});

Route::get('/admin/modifikasi', function () {
    return view('admins.adminModifikasi');
});

Route::resource('modifikasis', ModifikasiController::class);