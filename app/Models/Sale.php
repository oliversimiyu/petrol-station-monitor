<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'fuel_tank_id',
        'amount',
        'payment_method',
        'transaction_reference',
        'user_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function fuelTank(): BelongsTo
    {
        return $this->belongsTo(FuelTank::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
