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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'mobil_id' => 'required|integer',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'wilayah' => 'required|string',
        ]);
    
        // Simpan data ke database
        Peminjaman::create($validated);
    
        return redirect()->back()->with('success', 'Peminjaman berhasil disimpan');
    }

    public function hitung()
    {
        // Menggunakan query builder Laravel untuk menghitung jumlah data
        $totalMobil = DB::table('mobil')->where('status', 'Ada')->count();
        $totalPeminjam = DB::table('peminjaman')->count(); 
        
        // Mengirimkan data ke view
        return view('dashboard', [
            'totalMobil' => $totalMobil,
            'totalPeminjam' => $totalPeminjam
        ]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function returnMobil(Request $request, $id)
    {

        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'tanggal_pengembalian' => 'required|date',
            'kondisiMobil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kondisiBensin' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsiKondisi' => 'nullable|string',
            'mobil_id' => 'required|exists:mobil,id',
        ]);
    
        DB::transaction(function () use ($request, $id) {
            // Ambil data peminjaman
            $peminjaman = Peminjaman::findOrFail($id);
    
            // Simpan file kondisi terakhir mobil jika ada
            $kondisiMobilPath = null;
            $kondisiBensinPath = null;
        
            if ($request->hasFile('kondisi_fisik')) {
                $file = $request->file('kondisi_fisik');
                $kondisiMobilPath = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $kondisiMobilPath); // Move to public/img
            }
        
            if ($request->hasFile('bensin')) {
                $file = $request->file('bensin');
                $kondisiBensinPath = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $kondisiBensinPath); // Move to public/img
            }
    
            // Pindahkan data ke tabel pengembalian
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
    
            // Ubah status mobil menjadi "Ada"
            $mobil = Mobil::findOrFail($request->mobil_id);
            $mobil->update([
                'status' => 'Ada',
            ]);
    
            // Hapus data dari tabel peminjaman
            $peminjaman->delete();
        });
    return redirect('home');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
