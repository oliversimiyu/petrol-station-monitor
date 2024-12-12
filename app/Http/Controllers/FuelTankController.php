<?php

namespace App\Http\Controllers;

use App\Models\FuelTank;
use Illuminate\Http\Request;

class FuelTankController extends Controller
{
    public function index()
    {
        $fuelTanks = FuelTank::with(['sales', 'deliveries'])->get();
        return view('fuel-tanks.index', compact('fuelTanks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'capacity' => 'required|numeric|min:0',
            'current_level' => 'required|numeric|min:0',
            'minimum_level' => 'required|numeric|min:0',
        ]);

        FuelTank::create($validated);
        return redirect()->route('fuel-tanks.index')->with('success', 'Fuel tank created successfully');
    }

    public function update(Request $request, FuelTank $fuelTank)
    {
        $validated = $request->validate([
            'current_level' => 'required|numeric|min:0',
            'minimum_level' => 'required|numeric|min:0',
        ]);

        $fuelTank->update($validated);
        return redirect()->route('fuel-tanks.index')->with('success', 'Fuel tank updated successfully');
    }

    public function destroy(FuelTank $fuelTank)
    {
        $fuelTank->delete();
        return redirect()->route('fuel-tanks.index')->with('success', 'Fuel tank deleted successfully');
    }
}
