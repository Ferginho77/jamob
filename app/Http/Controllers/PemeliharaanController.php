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
            'mobil_id' => 'required|exists:mobil,id',
            'deskripsi' => 'required|string',
        ]);

        Pemeliharaan::create([
            'mobil_id' => $request->mobil_id,
            'deskripsi' => $request->deskripsi,
        ]);

        $mobil = Mobil::findOrFail($request->mobil_id);
        $mobil->update([
            'status' => 'Rusak',
        ]);

        return redirect('mobil')->with('success', 'Data pemeliharaan berhasil ditambahkan.');
    }


public function selesaikan(Request $request){
       $request->validate([
        'mobil_id' => 'required|exists:mobil,id',
    ]);

    Mobil::where('id', $request->mobil_id)
        ->update(['status' => 'Ada']);

    Pemeliharaan::where('mobil_id', $request->mobil_id)->delete();
    return redirect()->back();

    }

}
