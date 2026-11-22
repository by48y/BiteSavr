<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Mitra;
use Illuminate\Support\Facades\Route;

// ========================================================
// HALAMAN PUBLIK (Pelanggan / tamu)
// ========================================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [HomeController::class, 'katalog'])->name('katalog');

// ========================================================
// AUTENTIKASI
// ========================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ========================================================
// PESANAN & STRUK PELANGGAN
// ========================================================
Route::middleware('auth')->group(function () {
    Route::get('/pesanan', [\App\Http\Controllers\OrderController::class, 'index'])->name('pesanan.index');
    Route::post('/pesanan', [\App\Http\Controllers\OrderController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/{kode}', [\App\Http\Controllers\OrderController::class, 'show'])->name('pesanan.show');
});

// ========================================================
// DASHBOARD ADMIN
// ========================================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Kelola Mitra
    Route::patch('mitra/{mitra}/status', [Admin\MitraController::class, 'updateStatus'])->name('mitra.updateStatus');
    Route::resource('mitra', Admin\MitraController::class)->except(['show']);

    // Kelola User
    Route::resource('users', Admin\UserController::class)->except(['show']);

    // Kelola Produk (read-only dari sisi admin, mitra yang input)
    Route::get('products', [Admin\ProductController::class, 'index'])->name('products.index');

    // Kelola Transaksi
    Route::get('transactions', [Admin\TransactionController::class, 'index'])->name('transactions.index');
});

// ========================================================
// DASHBOARD MITRA
// ========================================================
Route::prefix('mitra-dashboard')->name('mitra.')->middleware(['auth', 'role:mitra_manager,mitra_staff'])->group(function () {
    Route::get('/', [Mitra\DashboardController::class, 'index'])->name('dashboard');

    // Produk Surplus
    Route::resource('products', Mitra\ProductController::class)->except(['show']);

    // Transaksi
    Route::get('transactions', [Mitra\TransactionController::class, 'index'])->name('transactions.index');
    Route::patch('transactions/{transaction}/status', [Mitra\TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');

    // Laporan Penjualan
    Route::get('reports', [Mitra\ReportController::class, 'index'])->name('reports.index');

    // Profil Usaha
    Route::get('profile', [Mitra\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [Mitra\ProfileController::class, 'update'])->name('profile.update');
});

// ========================================================
// REDIRECT LAMA (backward compat)
// ========================================================
Route::redirect('/dashboard', '/admin')->middleware('auth');
