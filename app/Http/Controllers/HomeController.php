<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
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
        // Mengambil data mobil yang statusnya 'ada' dan data lain
        $peminjamans = Peminjaman::where('user_id', auth()->id())
        ->with('mobil', 'user')
        ->get(); // Mengambil mobil beserta user
        return view('home', compact('peminjamans'));
    }

    public function dashboard()
    {
        $pengembalians = Pengembalian::all();
        
        $totalMobil = DB::table('mobil')->where('status', 'Ada')->count();
        $totalPeminjam = DB::table('peminjaman')->count(); 

        return view('dashboard', compact('pengembalians'),
        [
            'totalMobil' => $totalMobil,
            'totalPeminjam' => $totalPeminjam
        ]);

    }


    public function peminjaman()
    {
        $data['mobils'] = Mobil::with('user')->get(); // Mengambil mobil beserta user
        return view('peminjaman', $data);
    }
    public function pemeliharaan()
    {
        $data['mobils'] = Mobil::get(); // Mengambil mobil
        return view('pemeliharaan', $data);
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
