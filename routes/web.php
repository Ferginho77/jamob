<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PemeliharaanController;
use App\Http\Controllers\PermintaanController;
use GuzzleHttp\Middleware;

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
Route::post('/create-permintaan', [PermintaanController::class, 'create'])->middleware('auth')->name('create.permintaan');
Route::post('/permintaan/approve/{id}', [PermintaanController::class, 'approve'])->name('permintaan.approve');
Route::delete('/permintaan/delete/{id}', [PermintaanController::class, 'delete'])->name('permintaan.delete');

// Roure untuk pemeliharaan
Route::get('/pemeliharaan', [HomeController::class, 'pemeliharaan'])->name('pemeliharaan')->middleware('auth');
Route::post('/pemeliharaan', [PemeliharaanController::class, 'create'])->middleware('auth')->name('pemeliharaan');
Route::post('/selesaikan', [PemeliharaanController::class, 'selesaikan'])->name('selesaikan');

// Route untuk pengembalian mobil
Route::post('/mobil-kembali/{peminjamanId}', [MobilController::class, 'returnMobil'])->name('mobil.kembali');

// Route untuk daftar mobil
Route::get('/mobil', [HomeController::class, 'mobil'])->middleware('auth')->name('mobil');
Route::post('/tambah-mobil', [MobilController::class, 'TambahMobil'])->middleware('auth')->name('tambah.mobil');
Route::post('/nonaktif', [MobilController::class, 'nonaktif'])->middleware('auth')->name('nonaktif');
