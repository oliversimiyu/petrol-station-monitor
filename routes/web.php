<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\FuelDeliveryController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\FuelTankController;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::post('/deliveries', [FuelDeliveryController::class, 'store'])->name('deliveries.store');
    Route::resource('fuel-tanks', FuelTankController::class);
});

// Authentication routes
Auth::routes();
