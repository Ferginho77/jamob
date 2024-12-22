<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log
use Illuminate\Http\Request;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function index()
{
    $pengembalians = Pengembalian::all();

    return view('dashboard', compact('pengembalians'));
}

}
