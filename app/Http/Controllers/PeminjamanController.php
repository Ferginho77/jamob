<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\Mobil;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where('user_id', auth()->id())
        ->with('mobil') // Include data mobil
        ->get();

    // Kembali ke view 'home' dan kirim data peminjaman
    return view('home', compact('peminjamans'));
    }



     public function pinjam()
     {
         $peminjamans = Peminjaman::with(['mobil', 'user'])->get();

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
