<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman'; // pakai nama tabel sesuai migration

    protected $fillable = [
        'judul',
        'konten',
        'tanggal_rilis',
        'is_active',
    ];

    protected $casts = [
        'tanggal_rilis' => 'datetime',
        'is_active' => 'boolean',
    ];
}
