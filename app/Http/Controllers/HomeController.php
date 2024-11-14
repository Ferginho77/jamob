<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Wilayah;

class HomeController extends Controller
{
    public function home()
    {
        // Mengambil data mobil yang statusnya 'ada' dan data lainnya
        $data['mobils'] = Mobil::with('user')->get(); // Mengambil mobil beserta user
        $data['wilayah'] = Wilayah::orderBy('kantor_wilayah', 'asc')->get();
        return view('home', $data);
    }

    public function dashboard()
    {
        $peminjamans = Peminjaman::with(['mobil', 'user'])->get(); // Include user data in the query
        
        return view('dashboard', [
            'peminjamans' => $peminjamans,
            'totalMobil' => Mobil::where('status', 'Ada')->count(),
            'totalPeminjam' => $peminjamans->count(),
        ]);
    }
    

    public function peminjaman()
    {
        $data['mobils'] = Mobil::with('user')->get(); // Mengambil mobil beserta user
        return view('peminjaman', $data); 
    }

    public function index()
    {
        // Mengambil data yang diurutkan berdasarkan kantor_wilayah
        $data = Wilayah::orderBy('kantor_wilayah', 'asc')->get();
        
        // Mengirimkan data ke view home.blade.php
        return view('home', compact('data'));
    }

    public function mobil()
    {
        $data['mobils'] = Mobil::with('user')->get(); // Mengambil mobil beserta user
        return view('mobil', $data); 
    }

    public function permintaan(){
        return view('permintaan');
    }
}