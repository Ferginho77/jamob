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
        $peminjamans = Peminjaman::where('user_id', auth()->id())
        ->with('mobil') // Include data mobil
        ->get();

    // Kembali ke view 'home' dan kirim data peminjaman
    return view('home', compact('peminjamans'));
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


     public function pinjam()
     {
         // Ambil data hanya dari tabel peminjaman
         $peminjamans = Peminjaman::with(['mobil', 'user'])->get(); // Include user data in the query
        
        return view('/', compact('peminjamans'));
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
