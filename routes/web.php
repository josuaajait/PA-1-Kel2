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
});

Route::middleware('role:user')->group(function () {
    Route::get('/produk', [ProdukController::class, 'index'])->name('users.produk');
    Route::get('/pemesanan', [PemesananProdukController::class, 'index'])->name('users.pemesanan');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('users.produk.show');
    Route::get('/pemesanan/create/{produk}', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    Route::post('/pemesanan/ukuran', [PemesananJahitanController::class, 'rincianUkuran'])->name('users.rincian_ukuran');
});

Route::get('/cart', function () {
    $cart = Session::get('cart', []);
    return view('cart', compact('cart'));
})->name('cart.index');

Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');

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

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::resource('modifikasis', ModifikasiController::class);
