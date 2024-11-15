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
Route::get('/home', [MobilController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'home']);
Route::get('/peminjamans', [HomeController::class, 'detail'])->name('detail');
Route::post('/pinjam-mobil', [HomeController::class, 'pinjamMobil'])->name('pinjamMobil');
Route::get('/wilayah', [HomeController::class, 'index']);

// USER
Route::get('/users', [UserController::class, 'index'])->middleware('auth');

// Route untuk login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'create'])->middleware('guest')->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk dashboard admin
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth'); // Hanya satu rute untuk dashboard
Route::get('/peminjaman', [HomeController::class, 'peminjaman'])->name('peminjaman')->middleware('auth'); 
Route::get('/permintaan', [HomeController::class, 'permintaan'])->name('permintaan')->middleware('auth'); 
Route::get('/home', [PeminjamanController::class, 'index'])->name('home'); 


// Route untuk mobil
Route::get('/mobil', [HomeController::class, 'mobil'])->middleware('auth')->name('mobil');

// PEINJAMAN
Route::post('/peminjaman/return', [PengembalianController::class, 'store'])->name('peminjaman.return');