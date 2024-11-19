<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log
use Illuminate\Http\Request;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function store(Request $request)
    {

        // Log data yang diterima
        // Log::info('Data yang diterima di store:', $request->all());
        // dd($request->all());
        // Validasi data yang diterima
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'tanggal_pengembalian' => 'required|date',
            'kondisiMobil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kondisiBensin' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsiKondisi' => 'nullable|string',
            'mobil_id' => 'required|exists:mobil,id',
        ]);

        // Menyimpan file jika diupload
        $kondisiMobilPath = $request->hasFile('kondisiMobil')
            ? $request->file('kondisiMobil')->store('kondisi_mobil')
            : null;
        $kondisiBensinPath = $request->hasFile('kondisiBensin')
            ? $request->file('kondisiBensin')->store('kondisi_bensin')
            : null;

        // Simpan data ke database
        Pengembalian::create([
            'nama_mobil' => $request->nama_mobil,
            'plat_nomor' => $request->plat_nomor,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'kondisi_fisik' => $kondisiMobilPath,
            'bensin' => $kondisiBensinPath,
            'deskripsi' => $request->deskripsiKondisi,
            'mobil_id' => $request->mobil_id,
            'user_id' => Auth::id(),
        ]);

        // Redirect ke halaman home dengan pesan sukses
        return redirect()->route('/')->with('success', 'Mobil berhasil dikembalikan.');

    }
    public function index()
{
    $pengembalians = Pengembalian::all();

    return view('home', compact('pengembalians'));
}

}
