<?php

namespace App\Http\Controllers;

use App\Models\FuelTank;
use App\Models\Sale;
use App\Models\FuelDelivery;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get all fuel tanks
        $fuelTanks = FuelTank::all();

        // Calculate total sales for today
        $today = Carbon::today();
        $totalSales = Sale::whereDate('created_at', $today)->sum('amount');

        // Get total deliveries for today
        $totalDeliveries = FuelDelivery::whereDate('created_at', $today)->count();

        // Get recent sales with fuel tank relationship
        $recentSales = Sale::with('fuelTank')
            ->latest()
            ->take(5)
            ->get();

        // Get recent deliveries with fuel tank relationship
        $recentDeliveries = FuelDelivery::with('fuelTank')
            ->latest()
            ->take(5)
            ->get();

        // Calculate total active tanks
        $activeTanks = $fuelTanks->where('status', 'active')->count();

        return view('dashboard', compact(
            'fuelTanks',
            'recentSales',
            'recentDeliveries',
            'totalSales',
            'totalDeliveries',
            'activeTanks'
        ));
    }
}
