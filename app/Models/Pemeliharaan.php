<?php

namespace App\Models;
use App\Models\Mobil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    use HasFactory;
    protected $table = 'pemeliharaan';
    protected $fillable = [
        'deskripsi',
        'mobil_id',
        'created_at',
        'updated_at',
    ];
    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
