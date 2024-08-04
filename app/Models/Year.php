<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Year extends Model
{
    use HasFactory;

    protected $fillable  = ['start', 'end', 'state'];

    public function levels(): HasMany
    {
        return $this->hasMany(Level::class);
    }
}
