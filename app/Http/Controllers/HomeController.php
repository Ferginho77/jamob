<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Pemeliharaan;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Log; // Import Log
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Wilayah;

class HomeController extends Controller
{
    public function home()
    {
        
        $peminjamans = Peminjaman::where('user_id', auth()->id())
        ->with('mobil', 'user')
        ->get(); 
        return view('home', compact('peminjamans'));
    }

    public function dashboard()
    {
        $pengembalians = Pengembalian::all();

        $totalMobil = DB::table('mobil')->where('status', 'Ada')->count();
        $totalPeminjam = DB::table('peminjaman')->count();
        $totalPemeliharaan = DB::table('pemeliharaan')->count();

        return view('dashboard', compact('pengembalians'),
        [
            'totalMobil' => $totalMobil,
            'totalPeminjam' => $totalPeminjam,
            'totalPemeliharaan' => $totalPemeliharaan
        ]);

    }


    public function peminjaman()
    {
        $data['mobils'] = Mobil::with('user')->get(); 
        return view('peminjaman', $data);
    }
    public function pemeliharaan()
    {
       $pemeliharaans = Pemeliharaan::all();
        return view('pemeliharaan', compact('pemeliharaans'));
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
