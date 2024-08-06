<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'firstname',
        'phone',
        'sex',
    ];

    public function levels(): BelongsToMany
    {
        return $this->belongsToMany(Level::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
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
