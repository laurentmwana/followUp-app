<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'firstname',
        'phone',
        'email',
        'sex',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
