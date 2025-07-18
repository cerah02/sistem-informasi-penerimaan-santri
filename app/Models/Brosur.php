<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brosur extends Model
{
    use HasFactory;

    protected $table = 'brosur';

    protected $fillable = ['foto_brosur', 'jenjang_pendidikan'];
}
