<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\Mobil;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['peminjaman'] = Peminjaman::all();
        return view('peminjaman.index', ($data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    // Misalkan `mobil_id` dikirim sebagai parameter query (?mobil_id=1)
    $mobil_id = $request->query('mobil_id');
    
    // Ambil data peminjaman terakhir dari user yang login dan mobil tertentu
    $peminjaman = Peminjaman::where('user_id', Auth::id())
                            ->where('mobil_id', $mobil_id)
                            ->orderBy('created_at', 'desc')
                            ->first();
                            
    return view('peminjaman.create', compact('peminjaman'));
}

public function store(Request $request)
{
    // Validasi input jika diperlukan
    $request->validate([
        'mobil_id' => 'required|integer',
    ]);

    // Cari data peminjaman berdasarkan user_id dan mobil_id
    $peminjaman = Peminjaman::where('user_id', Auth::id())
                            ->where('mobil_id', $request->input('mobil_id'))
                            ->first();

    if ($peminjaman) {
        // Hapus data peminjaman
        $peminjaman->delete();

        // Perbarui status mobil menjadi "Ada"
        $mobil = Mobil::find($request->input('mobil_id'));
        if ($mobil) {
            $mobil->status = 'Ada';
            $mobil->save();
        }
    }

    // Redirect atau kembalikan respon sesuai kebutuhan
    return redirect()->route('peminjaman.index')->with('success', 'Mobil berhasil dikembalikan dan status diperbarui.');
}

public function returnMobil(Request $request)
{
    // Validasi input jika diperlukan
    $request->validate([
        'mobil_id' => 'required|integer',
        'kondisiMobil' => 'nullable|image', // Validasi untuk file gambar kondisi mobil
        'kondisiBensin' => 'nullable|image', // Validasi untuk file gambar kondisi bensin
        'deskripsiKondisi' => 'nullable|string',
    ]);

    // Cari data peminjaman berdasarkan user_id dan mobil_id
    $peminjaman = Peminjaman::where('user_id', Auth::id())
                            ->where('mobil_id', $request->input('mobil_id'))
                            ->first();

    if ($peminjaman) {
        // Hapus data peminjaman
        $peminjaman->delete();

        // Perbarui status mobil menjadi "Ada"
        $mobil = Mobil::find($request->input('mobil_id'));
        if ($mobil) {
            $mobil->status = 'Ada';
            $mobil->save();
        }

        // Menangani upload gambar jika ada
        if ($request->hasFile('kondisiMobil')) {
            $file = $request->file('kondisiMobil');
            // Simpan gambar dan lakukan tindakan sesuai kebutuhan
        }

        if ($request->hasFile('kondisiBensin')) {
            $file = $request->file('kondisiBensin');
            // Simpan gambar dan lakukan tindakan sesuai kebutuhan
        }
    }

    // Redirect atau kembalikan respon sesuai kebutuhan
    return redirect()->route('peminjaman.index')->with('success', 'Mobil berhasil dikembalikan dan status diperbarui.');
}

   public function pinjam(){
    $peminjamans = Peminjaman::with(['mobil', 'user'])->get(); // Include user data in the query
        
    return view('home', [
        'peminjamans' => $peminjamans,
        'totalMobil' => Mobil::where('status', 'Dipinjam')->count(),
        'totalPeminjam' => $peminjamans->count(),
    ]);
   }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
