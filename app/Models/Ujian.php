<?php

namespace App\Models;

use Carbon\Carbon;
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
    public function getStatusAttribute()
    {
        $now = Carbon::now('Asia/Jakarta'); // Gunakan waktu Indonesia

        $mulai = Carbon::parse($this->tanggal_mulai, 'Asia/Jakarta');
        $selesai = Carbon::parse($this->tanggal_selesai, 'Asia/Jakarta');

        if ($now->lt($mulai)) {
            return 'Belum Mulai';
        } elseif ($now->between($mulai, $selesai)) {
            return 'Sedang Berlangsung';
        } else {
            return 'Selesai';
        }
    }
}
