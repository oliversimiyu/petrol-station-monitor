<?php

namespace Database\Seeders;

use App\Models\FuelTank;
use Illuminate\Database\Seeder;

class FuelTankSeeder extends Seeder
{
    public function run(): void
    {
        $tanks = [
            [
                'name' => 'Tank 1',
                'fuel_type' => 'Petrol',
                'capacity' => 20000,
                'current_level' => 15000,
                'minimum_level' => 2000,
            ],
            [
                'name' => 'Tank 2',
                'fuel_type' => 'Diesel',
                'capacity' => 30000,
                'current_level' => 10000,
                'minimum_level' => 3000,
            ],
            [
                'name' => 'Tank 3',
                'fuel_type' => 'Premium Petrol',
                'capacity' => 15000,
                'current_level' => 1800,
                'minimum_level' => 2000,
            ],
        ];

        foreach ($tanks as $tank) {
            FuelTank::create($tank);
        }
    }
}
