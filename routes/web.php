<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PemesananProdukController;
use App\Http\Controllers\PemesananController; // Asumsi ini untuk user
use App\Http\Controllers\PemesananJahitanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController; // Pastikan ini di-import
use App\Http\Controllers\ManageCustomerController;
use App\Http\Controllers\ModifikasiJahitanController;
use App\Http\Controllers\RiwayatPemesananController;
use App\Models\ModifikasiJahitan;

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');

    Route::get('/home', function () {
        return view('users.home');
    });

});



Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admins.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('adminDashboard');

    Route::get('/profile', [AdminController::class, 'profile'])->name('adminProfile');

    // Produk management (Admin)
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index'); 
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // Pemesanan Produk management (Admin)
    Route::get('/pemesanan-produk', [PemesananProdukController::class, 'index'])->name('pemesanan-produk.index');
    Route::get('/pemesanan-produk/create', [PemesananProdukController::class, 'create'])->name('pemesanan-produk.create');
    Route::post('/pemesanan-produk', [PemesananProdukController::class, 'store'])->name('pemesanan-produk.store');
    Route::get('/pemesanan-produk/{id}/edit', [PemesananProdukController::class, 'edit'])->name('pemesanan-produk.edit');
    Route::put('/pemesanan-produk/{id}', [PemesananProdukController::class, 'update'])->name('pemesanan-produk.update');
    Route::delete('/pemesanan-produk/{id}', [PemesananProdukController::class, 'destroy'])->name('pemesanan-produk.destroy');
    Route::get('/pemesanan-produk/{id}', [PemesananProdukController::class, 'show'])->name('pemesanan-produk.show');


    // Pemesanan Jahitan management (Admin)
    Route::get('/pemesanan-jahitan', [PemesananJahitanController::class, 'index'])->name('pemesanan-jahitan.index');
    Route::get('/pemesanan-jahitan/create', [PemesananJahitanController::class, 'create'])->name('pemesanan-jahitan.create'); // Pastikan ini create form admin
    Route::post('/pemesanan-jahitan', [PemesananJahitanController::class, 'store'])->name('pemesanan-jahitan.store'); // Pastikan ini store dari admin
    Route::get('/pemesanan-jahitan/{id}', [PemesananJahitanController::class, 'show'])->name('pemesanan-jahitan.show');
    Route::get('/pemesanan-jahitan/{id}/edit', [PemesananJahitanController::class, 'edit'])->name('pemesanan-jahitan.edit');
    Route::put('/pemesanan-jahitan/{id}', [PemesananJahitanController::class, 'update'])->name('pemesanan-jahitan.update');
    Route::delete('/pemesanan-jahitan/{id}', [PemesananJahitanController::class, 'destroy'])->name('pemesanan-jahitan.destroy');
    Route::get('/pemesanan-jahitan/{id}', [PemesananJahitanController::class, 'show'])->name('pemesanan-jahitan.show');

    Route::get('/customers', [ManageCustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}/edit', [ManageCustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [ManageCustomerController::class, 'update'])->name('customers.update');
    
    // Route untuk riwayat seluruh pemesanan
    Route::get('/riwayat-pemesanan', [RiwayatPemesananController::class, 'index'])->name('riwayatpemesanan.history');

    // ==================== CRUD MODIFIKASI JAHITAN (ADMIN) ====================
    Route::resource('modifikasi-jahitan', ModifikasiJahitanController::class);
    // ==================== AKHIR CRUD MODIFIKASI JAHITAN (ADMIN) ====================

    // ==================== CRUD ABOUT US (ADMIN) ====================
    Route::get('/about', [AboutUsController::class, 'index'])->name('about.index');
    Route::get('/about/create', [AboutUsController::class, 'create'])->name('about.create');
    Route::get('/about/{id}', [AboutUsController::class, 'detail'])->name('about.detail');
    Route::post('/about', [AboutUsController::class, 'store'])->name('about.store');
    Route::get('/about/{id}/edit', [AboutUsController::class, 'edit'])->name('about.edit');
    Route::put('/about/{id}', [AboutUsController::class, 'update'])->name('about.update');
    Route::delete('/about/{id}', [AboutUsController::class, 'destroy'])->name('about.destroy');
    Route::post('/about/{id}/activate', [AboutUsController::class, 'activate'])->name('about.activate');
    // ==================== AKHIR CRUD ABOUT US (ADMIN) ====================
}); // Akhir dari group middleware admin

// ==================== USER ROUTES ====================
Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

    // Profil User
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::get('/profil/edit', [UserController::class, 'editProfil'])->name('profil.editProfil');
    Route::put('/profil/update', [UserController::class, 'updateProfil'])->name('profil.updateProfil');

    // Pemesanan produk (User)
    Route::get('/pemesanan-produk', [PemesananProdukController::class, 'index'])->name('pemesanan-produk.index');
    Route::get('/pemesanan-produk/create/{produkId}', [PemesananProdukController::class, 'createWithProduk'])
    ->name('pemesanan-produk.create');
    Route::post('/pemesanan-produk', [PemesananProdukController::class, 'store'])->name('pemesanan-produk.store');

    // Untuk customer
    Route::get('/pemesanan-jahitan', [PemesananJahitanController::class, 'create'])->name('pemesanan_jahitan.create');
    Route::post('/pemesanan-jahitan', [PemesananJahitanController::class, 'store'])->name('pemesanan_jahitan.store');

    // Menampilkan versi lengkap, hanya untuk user login
    Route::get('/about/full', [AboutUsController::class, 'full'])->name('about.full');


    // Modifikasi Jahitan (User)
    Route::get('/modifikasi-jahitan/create', [ModifikasiJahitanController::class, 'createCustomer'])->name('modifikasi-jahitan.create');
    Route::post('/modifikasi-jahitan/store', [ModifikasiJahitanController::class, 'storeCustomer'])->name('modifikasi-jahitan.store');


    Route::get('/riwayat-pemesanan', [RiwayatPemesananController::class, 'index'])->name('user.riwayat-pemesanan.index');



}); // Akhir dari group middleware user

// ==================== PUBLIC ROUTES ====================
// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Us (Public)
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.index');

// Produk (Public)
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

// Form pemesanan jahitan (Public)
Route::get('/pemesanan-jahitan', [PemesananJahitanController::class, 'create'])->name('pemesanan_jahitan.create');

// ==================== AUTH ROUTES ====================
// Register
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');