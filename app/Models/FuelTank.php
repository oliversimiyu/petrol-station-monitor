<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FuelTank extends Model
{
    protected $fillable = [
        'name',
        'fuel_type',
        'capacity',
        'current_level',
        'minimum_level',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(FuelDelivery::class);
    }
}
