<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Mobil;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = [
        'user_id',
        'mobil_id',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'tujuan', 
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
