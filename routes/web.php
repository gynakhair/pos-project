<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 

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
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('/admin/kasir', [AdminController::class, 'kasir'])->middleware('userAkses:kasir');
    Route::resource('/produk', ProductController::class);
    Route::get('/transaksi', [AdminController::class, 'laporan'])->middleware('auth');
    Route::resource('/users', UserController::class)->middleware('userAkses:admin');
    Route::get('/kasir', [TransaksiController::class, 'index'])->middleware('userAkses:kasir');
    Route::post('/kasir/simpan', [TransaksiController::class, 'store'])->name('kasir.store');
    Route::get('/logout', [AdminController::class, 'logout']);
});

Route::middleware(['auth', 'userAkses:kasir'])->group(function () {
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/create', [App\Http\Controllers\TransaksiController::class, 'create']);
    Route::post('/transaksi/store', [App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/riwayat', [TransaksiController::class, 'riwayat'])->name('transaksi.riwayat');
    Route::post('/produk/{id}/tambah-stok', [ProductController::class, 'tambahStok'])->name('produk.tambahStok');
});


// Jika tetap ingin pakai Auth::routes (untuk route default register/login/password reset)
Auth::routes();
