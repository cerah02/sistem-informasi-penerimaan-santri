<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Soal extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
    public function jawabans()
    {
        return $this->hasMany(Jawaban::class, 'soal_id');
    }
}
