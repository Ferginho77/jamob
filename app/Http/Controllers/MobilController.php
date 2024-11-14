<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
    {
        // Mengambil semua mobil dari database
        $data['mobil'] = Mobil::all();
        return view('mobil.index', ($data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
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
