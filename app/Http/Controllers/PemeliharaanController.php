<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pemeliharaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Whoops\Run;

class PemeliharaanController extends Controller
{
    public function create(Request $request)
{
    $request->validate([
        'kondisi_fisik' => 'required|string',
        'bensin' => 'required|string',
        'deskripsi' => 'required|string',
        'mobil_id' => 'required|exists:mobil,id',
    ]);

    $kondisiFisikFileName = basename($request->kondisi_fisik);
    $bensinFileName = basename($request->bensin);

    Pemeliharaan::create([
        'kondisi_fisik' => $kondisiFisikFileName,
        'bensin' => $bensinFileName,
        'deskripsi' => $request->deskripsi,
        'mobil_id' => $request->mobil_id,
    ]);

    $mobil = Mobil::findOrFail($request->mobil_id);
    $mobil->update([
        'status' => 'Rusak',
    ]);

    return redirect()->back();
}

public function selesaikan(Request $request){
       // Validasi input
       $request->validate([
        'mobil_id' => 'required|exists:mobils,id', // Pastikan ID mobil valid
    ]);

    // Temukan mobil berdasarkan ID
    $mobil = Mobil::findOrFail($request->mobil_id);

    // Perbarui status menjadi 'Ada'
    if ($mobil->status === 'Rusak') {
        $mobil->update(['status' => 'Ada']);
    }

    // Redirect dengan pesan sukses
    return response()->json([
        'success' => true,
        'message' => 'Status berhasil diubah menjadi Ada.',
    ]);

}

}
