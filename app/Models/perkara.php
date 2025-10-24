<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perkara extends Model
{
    use HasFactory;

    protected $table = 'perkara';

    protected $fillable = [
        'namaPihak',
        'tanggal_sidang',
        'noPerkara',
        'sidang_Keliling',
        'jenisPerkara',
        'ruangan_sidang',
        'agenda',
    ];

    protected $casts = [
        'tanggal_sidang' => 'datetime'
    ];
}
