<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\FuelTank;
use App\Models\FuelDelivery;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Daily sales for the last 7 days
        $dailySales = Sale::select(
            DB::raw('date(created_at) as date'),
            DB::raw('SUM(amount) as total_amount')
        )
            ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Monthly sales trend
        $monthlySales = Sale::select(
            DB::raw('strftime("%Y", created_at) as year'),
            DB::raw('strftime("%m", created_at) as month'),
            DB::raw('SUM(amount) as total_amount')
        )
            ->whereBetween('created_at', [Carbon::now()->subMonths(6), Carbon::now()])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($sale) {
                $sale->month_name = Carbon::createFromDate($sale->year, $sale->month, 1)->format('F Y');
                return $sale;
            });

        // Stock levels
        $stockLevels = FuelTank::select([
            'id',
            'name',
            'fuel_type',
            'capacity',
            'current_level',
            'minimum_level',
            DB::raw('CAST(current_level AS FLOAT) / capacity * 100 as level_percentage'),
            DB::raw('CAST((capacity - current_level) AS FLOAT) / capacity * 100 as space_percentage')
        ])->get();

        // Consumption rate (average daily consumption for each tank)
        $consumptionRates = Sale::select(
            'fuel_tank_id',
            DB::raw('AVG(amount) as avg_daily_consumption')
        )
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
            ->groupBy('fuel_tank_id')
            ->get()
            ->keyBy('fuel_tank_id');

        // Calculate days until empty for each tank
        foreach ($stockLevels as $tank) {
            $dailyConsumption = $consumptionRates->get($tank->id)?->avg_daily_consumption ?? 0;
            $tank->days_until_empty = $dailyConsumption > 0 
                ? round($tank->current_level / $dailyConsumption)
                : null;
        }

        // Get delivery statistics
        $deliveryStats = FuelDelivery::select(
            'fuel_tank_id',
            DB::raw('COUNT(*) as delivery_count'),
            DB::raw('AVG(amount) as avg_delivery_amount'),
            DB::raw('MAX(created_at) as last_delivery')
        )
            ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
            ->groupBy('fuel_tank_id')
            ->get()
            ->keyBy('fuel_tank_id');

        return view('analytics.index', compact(
            'dailySales',
            'monthlySales',
            'stockLevels',
            'consumptionRates',
            'deliveryStats'
        ));
    }
}
