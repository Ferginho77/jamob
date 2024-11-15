<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'id_mobil', 
        'user_id', 
        'created_at',
        'updated_at', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }
     
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id');
    }
}
