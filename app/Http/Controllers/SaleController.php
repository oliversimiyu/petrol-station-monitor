<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\FuelTank;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fuel_tank_id' => 'required|exists:fuel_tanks,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'nullable|string',
            'transaction_reference' => 'nullable|string',
        ]);

        $fuelTank = FuelTank::findOrFail($validated['fuel_tank_id']);

        // Check if there's enough fuel
        if ($fuelTank->current_level < $validated['amount']) {
            return back()->with('error', 'Not enough fuel in tank');
        }

        // Add user_id to validated data
        $validated['user_id'] = auth()->id();

        // Create sale record
        Sale::create($validated);

        // Update tank level
        $fuelTank->current_level -= $validated['amount'];
        $fuelTank->save();

        // Check if tank is below minimum level
        if ($fuelTank->current_level <= $fuelTank->minimum_level) {
            session()->flash('warning', "Tank {$fuelTank->name} is below minimum level!");
        }

        return redirect()->route('dashboard')->with('success', 'Sale recorded successfully');
    }
}
