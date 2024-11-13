<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;
    protected $table = 'wilayah';
    protected $fillable = [
        'id',
        'kantor_wilayah',
        'daerah',
        'created_at',
        'updated_at', 
    ];

}