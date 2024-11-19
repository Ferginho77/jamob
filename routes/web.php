<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

// Route untuk halaman home
Route::get('/', [LoginController::class, 'login']);

// Rute untuk detail peminjaman
Route::get('/peminjamans', [HomeController::class, 'detail'])->name('detail');
Route::get('/home', [PeminjamanController::class, 'pinjam'])->name('home')->middleware('auth');

// USER
Route::get('/users', [UserController::class, 'index'])->middleware('auth');

// Route untuk login dan logout
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'create'])->middleware('guest')->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Route untuk dashboard admin
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/peminjaman', [HomeController::class, 'peminjaman'])->name('peminjaman')->middleware('auth');
Route::get('/permintaan', [HomeController::class, 'permintaan'])->name('permintaan')->middleware('auth');

// Route untuk pengembalian mobil
Route::post('/pengembalian/store', [PengembalianController::class, 'store'])->name('pengembalian.store');
Route::get('/home', [PengembalianController::class, 'index'])->name('home');

// Route untuk daftar mobil
Route::get('/mobil', [HomeController::class, 'mobil'])->middleware('auth')->name('mobil');
