<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Pemeliharaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;

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
    public function mobil()
    {
        $data['mobils'] = Mobil::with('user')->get();
        return view('mobil', $data);
    }

    public function permintaan()
    {
        $users = User::all();
        $mobils = Mobil::all();
        $permintaans = Permintaan::with('user')->get();
        return view('permintaan', compact('users', 'mobils', 'permintaans'));
    }

}
