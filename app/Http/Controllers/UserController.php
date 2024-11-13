<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
   public function index(){
    $data['users'] = User::where('role','karyawan')->get();
    return view('user.index', compact('data'));
   }
}
