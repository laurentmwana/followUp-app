<?php

namespace App\Models;

use App\Models\Deliberated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Annual extends Model
{
    use HasFactory;

    protected $fillable = [
        'year_id',
        'level_id',
        'pv'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
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
