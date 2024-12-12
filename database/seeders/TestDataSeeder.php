<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\FuelDelivery;
use App\Models\FuelTank;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        $tanks = FuelTank::all();
        
        // Generate sales for the last 30 days
        foreach ($tanks as $tank) {
            for ($i = 0; $i < 30; $i++) {
                $date = Carbon::now()->subDays($i);
                
                // Random number of sales per day (1-5)
                $salesCount = rand(1, 5);
                
                for ($j = 0; $j < $salesCount; $j++) {
                    Sale::create([
                        'fuel_tank_id' => $tank->id,
                        'amount' => rand(100, 1000),
                        'created_at' => $date->copy()->addHours(rand(0, 23)),
                    ]);
                }
            }
        }

        // Generate deliveries for the last 30 days
        foreach ($tanks as $tank) {
            for ($i = 0; $i < 4; $i++) { // One delivery per week approximately
                FuelDelivery::create([
                    'fuel_tank_id' => $tank->id,
                    'amount' => rand(2000, 5000),
                    'created_at' => Carbon::now()->subDays(rand(0, 30)),
                ]);
            }
        }
    }
}
