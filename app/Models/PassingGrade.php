<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassingGrade extends Model
{

    protected $fillable = [
        'jenjang',
        'passing_grade',
    ];

}
