<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Duck extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the breaths for the duck.
     */
    public function breathes(): HasMany
    {
        return $this->hasMany(Breath::class);
    }

    /**
     * Get the walks for the duck.
     */
    public function walks(): HasMany
    {
        return $this->hasMany(Walk::class);
    }

    /**
     * Get the eats for the duck.
     */
    public function eats(): HasMany
    {
        return $this->hasMany(Eat::class);
    }
}
