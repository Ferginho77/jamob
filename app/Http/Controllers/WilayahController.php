<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        // Mengambil data wilayah yang diurutkan berdasarkan 'kantor_wilayah'
        $data = Wilayah::orderBy('kantor_wilayah', 'asc')->get();
    
        // Mengirimkan data ke view
        return view('wilayah.index', compact('data'));
    }
    
}
