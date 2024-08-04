<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'alias'];

    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }

    public function levels(): HasMany
    {
        return $this->hasMany(Level::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
