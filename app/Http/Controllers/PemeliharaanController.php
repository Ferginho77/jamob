<?php

namespace App\Http\Controllers;

use App\Models\Pemeliharaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Whoops\Run;

class PemeliharaanController extends Controller
{
    public function create(Request $request){

         $request->validate([
            'kondisi_fisik' => 'required|string',
            'bensin' => 'required|string',
            'deskripsi' => 'required|string',
            'mobil_id' => 'required|exists:mobil,id',
        ]);

        Pemeliharaan::create([
            'kondisi_fisik' => $request->kondisi_fisik,
            'bensin' => $request->bensin,
            'deskripsi' => $request->deskripsi,
            'mobil_id' => $request->mobil_id,
        ]);

        return redirect()->back();
    }
}
