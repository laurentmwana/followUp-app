<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'semester_id',
        'note',
        'course_id',
        'student_id',
        'year_id',
        'np',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }


    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }
}
