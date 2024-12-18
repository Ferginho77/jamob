<?php

namespace App\Http\Controllers;

use App\Models\Pemeliharaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Whoops\Run;

class PemeliharaanController extends Controller
{
    public function create(Request $request,){
       
         $request->validate([
            'kondisi_fisik' => 'required|url',
            'bensin' => 'required|url',
            'deskripsi' => 'required|string',
            'mobil_id' => 'required|exists:mobil,id',
        ]);

        Pemeliharaan::create([
            'kondisi_fisik' => $request->kondisi_fisik,
            'bensin' => $request->bensin,
            'mobil_id' => $request->mobil_id,
        ]);
        
        return redirect()->back()->with('success', 'Pemeliharaan berhasil dibuat!');
    }
}
