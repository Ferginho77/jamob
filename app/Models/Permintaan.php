<?php

namespace App\Models;
use App\Models\User;
use App\Models\Mobil;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;
    protected $table = 'permintaan';
    protected $fillable = [
        'user_id',
        'mobil_id',
        'nomor_sppd',
        'tanggal_peminjaman',
        'deskripsi',
        'tujuan',
    ];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');


}
public function mobil()
{
    return $this->belongsTo(Mobil::class);
}
}
