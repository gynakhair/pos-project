<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;

// Route untuk guest (belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

// Redirect /home ke /admin
Route::get('/home', function () {
    return redirect('/admin');
});

// Route untuk user yang sudah login
Route::middleware(['auth'])->group(function () {

    // ===== DASHBOARD & ROLE =====
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('/admin/kasir', [AdminController::class, 'kasir'])->middleware('userAkses:kasir');

    // ===== PRODUK (CRUD) =====
    Route::resource('/produk', ProductController::class);
    Route::post('/produk/{id}/tambah-stok', [ProductController::class, 'tambahStok'])->name('produk.tambahStok');

    // ===== USER MANAGEMENT =====
    Route::resource('/users', UserController::class)->middleware('userAkses:admin');

    // ===== TRANSAKSI =====
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create')->middleware('userAkses:kasir');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store')->middleware('userAkses:kasir');
    Route::get('/transaksi/riwayat', [TransaksiController::class, 'riwayat'])->name('transaksi.riwayat')->middleware('userAkses:kasir');

    // (Opsional) halaman kasir awal
    Route::get('/kasir', [TransaksiController::class, 'create'])->name('kasir.index')->middleware('userAkses:kasir');

    // ===== ADMIN LAPORAN (JIKA ADA) =====
    Route::get('/transaksi', [AdminController::class, 'laporan'])->middleware('userAkses:admin');

    // ===== LOGOUT =====
    Route::get('/logout', [AdminController::class, 'logout']);
});

// Auth bawaan Laravel
Auth::routes();
