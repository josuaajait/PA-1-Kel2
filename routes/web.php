<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController; // Pastikan namespace ini benar
use App\Http\Controllers\Auth\LogoutController; // Pastikan namespace ini benar
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController; // Pastikan controller ini ada jika digunakan
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PemesananProdukController;
use App\Http\Controllers\PemesananController; // Asumsi ini untuk user
use App\Http\Controllers\PemesananJahitanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModifikasiJahitanController; // Pastikan ini di-import


Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admins.adminDashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admins.adminProfile');
    Route::get('/admin/pemesanan', [AdminController::class, 'pemesanan'])->name('admins.adminPemesanan');
    Route::get('/admin/modifikasi', [AdminController::class, 'modifikasi'])->name('admins.adminModifikasi');


     // Produk management
     Route::get('/admin/produk', [ProdukController::class, 'adminIndex'])->name('admins.produk'); // Pastikan method adminIndex ada
     Route::get('/admin/produk/create', [ProdukController::class, 'create'])->name('admins.produk.create');
     Route::post('/admin/produk', [ProdukController::class, 'store'])->name('admins.produk.store');
     Route::get('/admin/produk/{produk}', [ProdukController::class, 'show'])->name('admins.produk.show');
     Route::get('/admin/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('admins.produk.edit');
     Route::put('/admin/produk/{produk}', [ProdukController::class, 'update'])->name('admins.produk.update');
     Route::delete('/admin/produk/{produk}', [ProdukController::class, 'destroy'])->name('admins.produk.destroy');

    // Pemesanan Produk management (Admin)
    Route::get('/admin/pemesanan-produk', [PemesananProdukController::class, 'index'])->name('pemesanan.produk'); // Nama route mungkin perlu disesuaikan ke admins.pemesanan-produk.index
    Route::get('/admin/pemesanan/{id}', [PemesananProdukController::class, 'show'])->name('pemesanan.show'); // Nama route mungkin perlu disesuaikan ke admins.pemesanan-produk.show
    Route::delete('/admin/pemesanan/{id}', [PemesananProdukController::class, 'destroy'])->name('pemesanan.destroy'); // Nama route mungkin perlu disesuaikan ke admins.pemesanan-produk.destroy

    // Pemesanan Jahitan management (Admin)
    Route::get('/admin/pemesanan-jahitan', [PemesananJahitanController::class, 'index'])->name('admins.pemesanan-jahitan.index');
    Route::get('/admin/pemesanan-jahitan/create', [PemesananJahitanController::class, 'create'])->name('admins.pemesanan-jahitan.create'); // Pastikan ini create form admin
    Route::post('/admin/pemesanan-jahitan', [PemesananJahitanController::class, 'store'])->name('admins.pemesanan-jahitan.store'); // Pastikan ini store dari admin
    Route::get('/admin/pemesanan-jahitan/{id}', [PemesananJahitanController::class, 'show'])->name('admins.pemesanan-jahitan.show');
    Route::get('/admin/pemesanan-jahitan/{id}/edit', [PemesananJahitanController::class, 'edit'])->name('admins.pemesanan-jahitan.edit');
    Route::put('/admin/pemesanan-jahitan/{id}', [PemesananJahitanController::class, 'update'])->name('admins.pemesanan-jahitan.update');
    Route::delete('/admin/pemesanan-jahitan/{id}', [PemesananJahitanController::class, 'destroy'])->name('admins.pemesanan-jahitan.destroy');

    // ==================== CRUD MODIFIKASI JAHITAN (ADMIN) ====================
    Route::get('/admin/modifikasi-jahitan', [ModifikasiJahitanController::class, 'index'])->name('admins.modifikasi-jahitan.index');
    Route::get('/admin/modifikasi-jahitan/create', [ModifikasiJahitanController::class, 'create'])->name('admins.modifikasi-jahitan.create');
    Route::post('/admin/modifikasi-jahitan', [ModifikasiJahitanController::class, 'store'])->name('admins.modifikasi-jahitan.store');
    Route::get('/admin/modifikasi-jahitan/{id}', [ModifikasiJahitanController::class, 'show'])->name('admins.modifikasi-jahitan.show');
    Route::get('/admin/modifikasi-jahitan/{id}/edit', [ModifikasiJahitanController::class, 'edit'])->name('admins.modifikasi-jahitan.edit');
    Route::put('/admin/modifikasi-jahitan/{id}', [ModifikasiJahitanController::class, 'update'])->name('admins.modifikasi-jahitan.update');
    Route::delete('/admin/modifikasi-jahitan/{id}', [ModifikasiJahitanController::class, 'destroy'])->name('admins.modifikasi-jahitan.destroy');
    // ==================== AKHIR CRUD MODIFIKASI JAHITAN (ADMIN) ====================


}); // Akhir dari group middleware admin

// Anda memiliki middleware role:user di sini, pastikan middleware 'role' terdaftar dan berfungsi
Route::middleware('role:user')->group(function () {
    // Produk (User)
    Route::get('/produk', [ProdukController::class, 'index'])->name('users.produk');
    // Anda punya route '/produk' di sini dan di public. Pastikan tidak konflik atau salah satunya dihapus/diubah.
    // Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('users.produk.show'); // User bisa lihat detail produk

    // Pemesanan produk (User)
    Route::get('/pemesanan/create/{produk}', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');

    // Pemesanan jahitan (User)
    // Cukup satu definisi untuk GET dan satu untuk POST
    Route::get('/pemesanan-jahitan', [PemesananJahitanController::class, 'create'])->name('pemesanan_jahitan.create'); // Tampilkan form ke user
    Route::post('/pemesanan-jahitan', [PemesananJahitanController::class, 'store'])->name('pemesanan_jahitan.store'); // Proses simpan dari user

    // Tidak perlu duplikat route pemesanan jahitan di sini
    // // Route to display the form (GET request)
    // Route::get('/pemesanan-jahitan', [PemesananJahitanController::class, 'create'])->name('pemesanan_jahitan.create');
    // // Route to handle the form submission (POST request)
    // Route::post('/pemesanan-jahitan', [PemesananJahitanController::class, 'store'])->name('pemesanan_jahitan.store');

}); // Akhir dari group middleware user

// ==================== PUBLIC ROUTES ====================
// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');


// About page
Route::get('/about', function () {
    return view('users.about'); // Pastikan view ini ada
})->name('about'); // Beri nama route jika perlu

// Produk public listing (non-login, optional)
// Hati-hati, ini duplikat dengan route /produk di middleware user. Pilih salah satu atau bedakan URLnya.
// Jika ini untuk public (non-login), mungkin URLnya bisa /katalog-produk atau semacamnya.
// Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

// Ada route resource 'modifikasis' di public, ini akan konflik dengan route admin jika controllernya sama.
// Jika ModifikasiController berbeda dari ModifikasiJahitanController, tidak masalah.
// Jika sama, route resource ini harus dihapus atau dipindahkan ke dalam middleware admin.
// Hapus jika tidak digunakan: Route::resource('modifikasis', ModifikasiController::class);

// ==================== AUTH ROUTES ====================
// Register
Route::get('/register', function () {
    return view('users.register'); // Pastikan view ini ada
})->middleware('guest')->name('register.form'); // Tambah middleware guest & nama route
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest')->name('register');

// Login
Route::get('/login', function () {
    return view('users.login'); // Pastikan view ini ada
})->middleware('guest')->name('login'); // Tambah middleware guest
// Nama route untuk POST login sebaiknya berbeda atau hapus name() dari GET login
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.post');

// Logout
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout'); // Logout hanya untuk yg sudah login
