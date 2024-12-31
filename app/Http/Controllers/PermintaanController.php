<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Peminjaman;
use App\Models\Permintaan;

use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'mobil_id' => 'required|exists:mobil,id',
            'nomor_sppd' => 'required|string',
            'tanggal_peminjaman' => 'required|string',
            'deskripsi' => 'required|string',
            'tujuan' => 'required|string',
        ]);

        Permintaan::create([
            'user_id' => $request->user_id,
            'mobil_id' => $request->mobil_id,
            'nomor_sppd' => $request->nomor_sppd,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'deskripsi' => $request->deskripsi,
            'tujuan' => $request->tujuan,
        ]);

        return redirect('permintaan');
    }



    public function approve($id)
{
    $permintaan = Permintaan::findOrFail($id);

    Peminjaman::create([
        'user_id' => $permintaan->user_id,
        'mobil_id' => $permintaan->mobil_id,
        'nomor_sppd' => $permintaan->nomor_sppd,
        'tanggal_peminjaman' => $permintaan->tanggal_peminjaman,
        'deskripsi' => $permintaan->deskripsi,
        'tujuan' => $permintaan->tujuan,
    ]);

    $mobil = Mobil::findOrFail($permintaan->mobil_id);
    $mobil->status = 'Dipinjam';  
    $mobil->save(); 

    $permintaan->delete();

    return redirect()->route('permintaan')->with('success', 'Data berhasil dipindahkan ke tabel peminjaman dan status mobil diperbarui.');
}

public function delete($id)
{
    $permintaan = Permintaan::findOrFail($id);
    $permintaan->delete();

    return redirect()->route('permintaan')->with('success', 'Data berhasil dihapus.');
}

}
