<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'firstname',
        'phone',
        'sex',
        'happy'
    ];

    public function levels(): BelongsToMany
    {
        return $this->belongsToMany(Level::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function deliberateds(): HasMany
    {
        return $this->hasMany(Deliberated::class);
    }

    public function choice(): HasOne
    {
        return $this->hasOne(Choice::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
