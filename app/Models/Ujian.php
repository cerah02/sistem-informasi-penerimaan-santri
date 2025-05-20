<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function soal()
    {
        return $this->hasMany(Soal::class, 'ujian_id', 'id');
    }
    public function soals()
    {
        return $this->hasMany(Soal::class, 'ujian_id');
    }

    public function hasils()
    {
        return $this->hasMany(Hasil::class, 'ujian_id');
    }
}
