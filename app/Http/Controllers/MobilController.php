<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::where('user_id', auth()->id())
        ->where('status', 'Dipinjam')
        ->get();

        return view('mobil.index', compact('mobils'));
    }


    public function hitung()
    {
        $totalMobil = DB::table('mobil')->where('status', 'Ada')->count();
        $totalPeminjam = DB::table('peminjaman')->count();

        return view('dashboard', [
            'totalMobil' => $totalMobil,
            'totalPeminjam' => $totalPeminjam
        ]);
    }


    public function returnMobil(Request $request, $id)
    {

        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'tanggal_pengembalian' => 'required|date',
            'kondisiMobil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kondisiBensin' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsiKondisi' => 'nullable|string',
            'location' => 'required|nullable|string',
            'mobil_id' => 'required|exists:mobil,id',
        ]);

        DB::transaction(function () use ($request, $id) {

            $peminjaman = Peminjaman::findOrFail($id);

            $kondisiMobilPath = null;
            $kondisiBensinPath = null;

            if ($request->hasFile('kondisi_fisik')) {
                $file = $request->file('kondisi_fisik');
                $kondisiMobilPath = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $kondisiMobilPath);
            }

            if ($request->hasFile('bensin')) {
                $file = $request->file('bensin');
                $kondisiBensinPath = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $kondisiBensinPath);
            }


            Pengembalian::create([
            'nama_mobil' => $request->nama_mobil,
            'plat_nomor' => $request->plat_nomor,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'kondisi_fisik' => $kondisiMobilPath,
            'bensin' => $kondisiBensinPath,
            'deskripsi' => $request->deskripsiKondisi,
            'location' => $request->location,
            'mobil_id' => $request->mobil_id,
            'user_id' => Auth::id(),
            ]);


            $mobil = Mobil::findOrFail($request->mobil_id);
            $mobil->update([
                'status' => 'Ada',
            ]);

            $peminjaman->delete();
        });
    return redirect('home')->withErrors('Mohon Aktifkan Lokasi Anda');
    }

    public function TambahMobil(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $gambar = null;

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $gambar = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $gambar);
            }

            Mobil::create([
                'nama_mobil' => $request->nama_mobil,
                'plat_nomor' => $request->plat_nomor,
                'warna' => $request->warna,
                'gambar' => $gambar,
                'status' => 'Ada',
            ]);
        });

        return redirect('mobil')->with('success', 'Data mobil berhasil ditambahkan.');
    }

    public function nonaktif(Request $request)
{
    try {
        $mobil = Mobil::findOrFail($request->mobil_id);
        $mobil->status = $mobil->status === 'Ada' ? 'NonAktif' : 'Ada';
        $mobil->save();

        return response()->json([
            'success' => true,
            'new_status' => $mobil->status,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500); // HTTP 500 Internal Server Error
    }
}



}
