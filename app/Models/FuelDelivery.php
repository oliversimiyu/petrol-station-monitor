<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FuelDelivery extends Model
{
    protected $fillable = [
        'fuel_tank_id',
        'amount',
        'supplier',
        'delivery_note_number',
        'delivery_date',
    ];

    protected $casts = [
        'delivery_date' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function fuelTank(): BelongsTo
    {
        return $this->belongsTo(FuelTank::class);
    }
}
