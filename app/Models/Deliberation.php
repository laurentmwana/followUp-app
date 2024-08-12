<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deliberation extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester_id',
        'year_id',
        'level_id'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function deliberateds(): HasMany
    {
        return $this->hasMany(Deliberated::class);
    }
}
