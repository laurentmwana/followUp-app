<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'alias', 'programme_id'];

    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function deliberations(): HasMany
    {
        return $this->hasMany(Deliberation::class);
    }

    public function redos(): HasMany
    {
        return $this->hasMany(Redo::class);
    }


    public function capitalizes(): HasMany
    {
        return $this->hasMany(Capitalize::class);
    }
}
