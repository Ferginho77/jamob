<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $table = 'mobil';
    protected $fillable = [
        'nama_mobil',
        'plat_nomor',
        'warna',
        'status',
        'gambar',
        'created_at',
        'updated_at', 
    ];
    
    public function peminjaman()
    {
        return $this->hasOne(Peminjaman::class);
    }
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mobil()
{
    return $this->belongsTo(Mobil::class);
}
}
