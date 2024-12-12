<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FuelDelivery extends Model
{
    protected $fillable = [
        'fuel_tank_id',
        'amount',
    ];

    protected $casts = [
        'delivery_date' => 'datetime',
    ];

    public function fuelTank(): BelongsTo
    {
        return $this->belongsTo(FuelTank::class);
    }
}
