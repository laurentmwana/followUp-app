<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deliberated extends Model
{
    use HasFactory;

    protected $fillable = [
        'mca',
        'mcb',
        'mab',
        'total',
        'deliberation_id',
        'annual_id',
        'student_id',
        'pourcent',
        'tn',
        'tncc',
        'ncc',
        'tnp',
        'validated',
        'decision'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function deliberation(): BelongsTo
    {
        return $this->belongsTo(Deliberation::class);
    }
}
