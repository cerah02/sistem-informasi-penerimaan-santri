<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Santri extends Model
{
    use HasFactory;
    use Notifiable;

    protected $guarded = ["id"];

    public function dokumen()
    {
        return $this->hasOne(Dokumen::class, 'santri_id', 'id');
    }
    public function ortu()
    {
        return $this->hasOne(Ortu::class, 'santri_id', 'id');
    }
    public function kesehatan()
    {
        return $this->hasOne(Kesehatan::class, 'santri_id', 'id');
    }
    public function bantuan()
    {
        return $this->hasOne(Bantuan::class, 'santri_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function hasil()
    {
        return $this->hasMany(Hasil::class, 'santri_id');
    }
}
