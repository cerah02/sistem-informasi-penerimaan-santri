<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Total_Hasil extends Model
{
    protected $table = 'total_hasils';
    use HasFactory;
    protected $guarded = ["id"];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id', 'id');
    }
}
