<?php

namespace App\Http\Controllers;

use App\Models\FuelTank;
use App\Models\Sale;
use App\Models\FuelDelivery;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fuelTanks = FuelTank::all();
        $recentSales = Sale::with('fuelTank')
            ->latest()
            ->take(5)
            ->get();
        $recentDeliveries = FuelDelivery::with('fuelTank')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('fuelTanks', 'recentSales', 'recentDeliveries'));
    }
}
