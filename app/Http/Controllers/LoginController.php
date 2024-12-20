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
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
{
    // Validasi input
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ], [
        'username.required' => 'Username Wajib Diisi.',
        'password.required' => 'Password Wajib Diisi.',
    ]);

    // Cek kredensial menggunakan Auth::attempt
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user(); // Ambil pengguna yang login

        // Redirect berdasarkan role pengguna
        if ($user->role == 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role == 'karyawan') {
            return redirect()->route('home');
        } else {
            return redirect('/')->withErrors('Role tidak valid.')->withInput();
        }
    } else {
        // Kredensial salah
        return redirect('/')
            ->withErrors('Username atau Password salah.')
            ->withInput();
    }
}

       public function logout(Request $request)
    {
        Auth::logout(); 
        return redirect('');
    }

}
