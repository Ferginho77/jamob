<?php

namespace App\Http\Controllers;




use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Wilayah;

class HomeController extends Controller
{
    public function home(){
          // Mengambil data mobil yang statusnya 'ada' dan data lainnya
          $data['mobils'] = Mobil::all(); 
          $data['mobils'] = Mobil::with('user')->get();
          $data['peminjamans'] = Peminjaman::all();
          $data['wilayah'] = Wilayah::orderBy('kantor_wilayah', 'asc')->get();
          return view('home', $data);
    }
    public function dashboard()
    {
        $peminjamans  = Peminjaman::all();
        var_dump($peminjamans);
        exit;
        return view('dashboard', compact('peminjamans'));

       
    }
    

    
    
    public function pemeliharaan(){
    
    return view('pemeliharaan'); 
}

// public function detail(){
//     $data['mobils'] = Mobil::where('status', 'ada')->get(); 
//     $data['peminjamans'] = Peminjaman::all();
//     $data['mobilAda'] = Mobil::where('status', 'Ada')->count();
//     $data['mobilDipakai'] = Mobil::where('status', 'Sedang Dipakai')->count(); 
//     return view('mobil', $data);
// }
    public function index()
    {
        // Mengambil data yang diurutkan berdasarkan kantor_wilayah
        $data = Wilayah::orderBy('kantor_wilayah', 'asc')->get();
        
        // Mengirimkan data ke view home.blade.php
        return view('home', compact('data'));
    }

    public function mobil()
{
    $data['mobils'] = Mobil::all(); 
    $data['mobils'] = Mobil::with('user')->get();
    return view('mobil', $data); 
}

}
