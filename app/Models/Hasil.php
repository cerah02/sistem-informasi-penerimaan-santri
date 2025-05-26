<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;
    protected $fillable = [
        'santri_id',
        'ujian_id',
        'jumlah_soal',
        'jawaban_benar',
        'jawaban_salah',
        'total_nilai_kategori',
        'keterangan',
    ];
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }
    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'ujian_id');
    }
}
