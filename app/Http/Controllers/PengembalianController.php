<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'mobil_id' => 'required|exists:mobil,id',
            'nama_mobil' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'tanggal_pengembalian' => 'required|date',
            'kondisiMobil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kondisiBensin' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsiKondisi' => 'nullable|string',
        ]);

        // Menyimpan file jika diupload
        $kondisiMobilPath = null;
        $kondisiBensinPath = null;

        if ($request->hasFile('kondisiMobil')) {
            $kondisiMobilPath = $request->file('kondisiMobil')->store('kondisi_mobil');
        }

        if ($request->hasFile('kondisiBensin')) {
            $kondisiBensinPath = $request->file('kondisiBensin')->store('kondisi_bensin');
        }

        // Membuat objek baru dari model Pengembalian
        $pengembalian = new Pengembalian();
        $pengembalian->user_id = Auth::id(); // Menggunakan Auth untuk mendapatkan ID pengguna yang sedang login
        $pengembalian->mobil_id = $request->mobil_id;
        $pengembalian->nama_mobil = $request->nama_mobil;
        $pengembalian->plat_nomor = $request->plat_nomor;
        $pengembalian->tanggal_pengembalian = $request->tanggal_pengembalian; // Tambahkan ini
        $pengembalian->kondisi_fisik = $kondisiMobilPath;
        $pengembalian->bensin = $kondisiBensinPath;
        $pengembalian->deskripsi = $request->deskripsiKondisi;

        // Simpan data ke database
        $pengembalian->save();

        // Redirect atau memberikan respon
        return redirect()->back()->with('success', 'Mobil berhasil dikembalikan.');
    }
}
