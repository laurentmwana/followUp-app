<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliberation extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'student_id',
        'semester_id',
        'year_id',
        'mca',
        'mcb',
        'tn',
        'tnp',
        'pourcent',
        'level_id'
    ];
}
