<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //validasi form
        $credentials = $request->validate([
            'username' => ['required', 'exists:users,username'],
            'password' => ['required'],
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            
            $level = Auth::user()->role; // Pastikan role yang benar diambil
    
            // Debugging
            \Log::info('User logged in:', ['username' => Auth::user()->username, 'role' => $level]);
    
            if ($level == 'admin') {
                return redirect()->intended('/dashboard'); // Pastikan ini mengarah ke dashboard
            } else {
                return redirect()->intended('/'); // Atau ke halaman lain sesuai kebutuhan
            }
        } 
        
        return back()->withErrors([
            'username' => 'Username tidak terdaftar',
            'password' => 'Password Salah',
        ])->onlyInput('username');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function logout(Request $request)
    {
        Auth::logout(); // Proses logout
    
        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerasi token CSRF
    
        return redirect('/login'); // Arahkan kembali ke halaman login
    }
    
}
