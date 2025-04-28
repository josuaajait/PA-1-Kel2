<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModifikasiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PemesananProdukController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PemesananJahitanController; // Add this line

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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admins.adminDashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admins.adminProfile');
    Route::get('/admin/pemesanan', [AdminController::class, 'pemesanan'])->name('admins.adminPemesanan');

    Route::get('/admin/modifikasi', [AdminController::class, 'modifikasi'])->name('admins.adminModifikasi');

     // Produk management
     Route::get('/admin/produk', [ProdukController::class, 'adminIndex'])->name('admins.produk');
     Route::get('/admin/produk/create', [ProdukController::class, 'create'])->name('admins.produk.create');
     Route::post('/admin/produk', [ProdukController::class, 'store'])->name('admins.produk.store');
     Route::get('/admin/produk/{produk}', [ProdukController::class, 'show'])->name('admins.produk.show');
     Route::get('/admin/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('admins.produk.edit');
     Route::put('/admin/produk/{produk}', [ProdukController::class, 'update'])->name('admins.produk.update');
     Route::delete('/admin/produk/{produk}', [ProdukController::class, 'destroy'])->name('admins.produk.destroy');

    Route::get('/admin/pemesanan-produk', [PemesananProdukController::class, 'index'])->name('pemesanan.produk');
    Route::get('/admin/pemesanan/{id}', [PemesananProdukController::class, 'show'])->name('pemesanan.show');
    Route::delete('/admin/pemesanan/{id}', [PemesananProdukController::class, 'destroy'])->name('pemesanan.destroy');

    // Pemesanan jahitan management
    Route::get('/admin/pemesanan-jahitan', [PemesananJahitanController::class, 'index'])->name('pemesanan-jahitan.index');
    Route::get('/admin/pemesanan-jahitan/create', [PemesananJahitanController::class, 'create'])->name('pemesanan-jahitan.create');
    Route::post('/admin/pemesanan-jahitan', [PemesananJahitanController::class, 'store'])->name('pemesanan-jahitan.store');
    Route::get('/admin/pemesanan-jahitan/{id}', [PemesananJahitanController::class, 'show'])->name('pemesanan-jahitan.show');
    Route::get('/admin/pemesanan-jahitan/{id}/edit', [PemesananJahitanController::class, 'edit'])->name('pemesanan-jahitan.edit');
    Route::put('/admin/pemesanan-jahitan/{id}', [PemesananJahitanController::class, 'update'])->name('pemesanan-jahitan.update');
    Route::delete('/admin/pemesanan-jahitan/{id}', [PemesananJahitanController::class, 'destroy'])->name('pemesanan-jahitan.destroy');

    
});

Route::middleware('role:user')->group(function () {
    // Produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('users.produk');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('users.produk.show');

    // Pemesanan produk
    Route::get('/pemesanan/create/{produk}', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');

    // Pemesanan jahitan
    Route::get('/pemesanan-jahitan', [PemesananJahitanController::class, 'create'])->name('pemesanan_jahitan.create');
    Route::post('/pemesanan-jahitan', [PemesananJahitanController::class, 'store'])->name('pemesanan_jahitan.store');


    // Route to display the form (GET request)
    Route::get('/pemesanan-jahitan', [PemesananJahitanController::class, 'create'])->name('pemesanan_jahitan.create');
    
    // Route to handle the form submission (POST request)
    Route::post('/pemesanan-jahitan', [PemesananJahitanController::class, 'store'])->name('pemesanan_jahitan.store');

});

// ==================== PUBLIC ROUTES ====================
// Landing page
Route::get('/', function () {
    return view('layout.main');
});

// About page
Route::get('/about', function () {
    return view('users.about');
});

// Produk public listing (non-login, optional)
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

// Modifikasi CRUD (resource)
Route::resource('modifikasis', ModifikasiController::class);

// ==================== AUTH ROUTES ====================
// Register
Route::get('/register', function () {
    return view('users.register');
});
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Login
Route::get('/login', function () {
    return view('users.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');