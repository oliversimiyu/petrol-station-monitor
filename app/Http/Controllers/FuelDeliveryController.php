<?php

namespace App\Http\Controllers;

use App\Models\FuelDelivery;
use App\Models\FuelTank;
use Illuminate\Http\Request;

class FuelDeliveryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fuel_tank_id' => 'required|exists:fuel_tanks,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $fuelTank = FuelTank::findOrFail($validated['fuel_tank_id']);

        // Check if delivery would exceed capacity
        if ($fuelTank->current_level + $validated['amount'] > $fuelTank->capacity) {
            return back()->with('error', 'Delivery would exceed tank capacity');
        }

        // Create delivery record
        FuelDelivery::create($validated);

        // Update tank level
        $fuelTank->current_level += $validated['amount'];
        $fuelTank->save();

        return redirect()->route('dashboard')->with('success', 'Delivery recorded successfully');
    }
}
