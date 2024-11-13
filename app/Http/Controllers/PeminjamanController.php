<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
           // Validasi input
        $request->validate([
            'user_id' => 'required|integer',
            'mobil_id' => 'required|integer',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_peminjaman',
            'tujuan' => 'required|string|max:255', // Ubah validasi untuk kolom 'tujuan'
        ]);

        // Simpan data ke database
        Peminjaman::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Peminjaman berhasil ditambahkan.');
    }
    // public function tampilkanJumlahData()
    // {
    //     // Menggunakan query builder Laravel langsung untuk menghitung data
    //     $totalData = DB::table('peminjaman')->count(); // Ganti 'peminjaman' dengan nama tabel yang benar
    
    //     // Mengirimkan data ke view
    //     return view('dashboard', ['totalData' => $totalData]);
    // }
    
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
