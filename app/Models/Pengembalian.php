<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Mobil;
use App\Models\Peminjaman;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $fillable = [
        'nama_mobil',
        'plat_nomor',
        'tanggal_pengembalian',
        'kondisi_fisik',
        'bensin',
        'deskripsi', 
        'mobil_id', 
        'user_id', 
        'created_at',
        'updated_at', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
     
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id');
    }
}
