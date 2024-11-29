<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MobilController;

// Route utama
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');

// Route untuk login dan logout
Route::post('/', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Redirect dari /home ke /dashboard
Route::get('/home', function () {
    return redirect('/dashboard');
})->middleware('auth')->name('home');

// Route untuk dashboard admin
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');
// Route::get('/dashboard', [MobilController::class, 'hitung'])->name('dashboard')->middleware('auth');

//route home
Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware('auth');
// Route untuk peminjaman
Route::get('/peminjaman', [HomeController::class, 'peminjaman'])->name('peminjaman')->middleware('auth');
Route::get('/peminjaman/home', [PeminjamanController::class, 'pinjam'])->name('peminjaman.home')->middleware('auth');

// Route untuk permintaan
Route::get('/permintaan', [HomeController::class, 'permintaan'])->name('permintaan')->middleware('auth');

// Roure untuk pemeliharaan
Route::get('/pemeliharaan', [HomeController::class, 'pemeliharaan'])->name('pemeliharaan')->middleware('auth');

// Route untuk pengembalian mobil
Route::post('/mobil-kembali/{peminjamanId}', [MobilController::class, 'returnMobil'])->name('mobil.kembali');

// Route untuk daftar mobil
Route::get('/mobil', [HomeController::class, 'mobil'])->middleware('auth')->name('mobil');
