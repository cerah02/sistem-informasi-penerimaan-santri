<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id', 'santri_id');
    }
    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'ujian_id');
    }
}
