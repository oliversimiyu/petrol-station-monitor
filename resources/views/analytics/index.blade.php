@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Analytics Dashboard</h1>

    <div class="row mb-4">
        <!-- Stock Levels -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Current Stock Levels
                </div>
                <div class="card-body">
                    <canvas id="stockLevelsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Daily Sales Trend -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Daily Sales (Last 7 Days)
                </div>
                <div class="card-body">
                    <canvas id="dailySalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Monthly Sales Trend -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Monthly Sales Trend
                </div>
                <div class="card-body">
                    <canvas id="monthlySalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tank Analysis -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tank Analysis
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tank</th>
                                    <th>Current Level</th>
                                    <th>Capacity Usage</th>
                                    <th>Avg. Daily Consumption</th>
                                    <th>Days Until Empty</th>
                                    <th>Deliveries (30 days)</th>
                                    <th>Last Delivery</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stockLevels as $tank)
                                <tr>
                                    <td>{{ $tank->name }} ({{ $tank->fuel_type }})</td>
                                    <td>{{ number_format($tank->current_level) }} L</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar {{ $tank->level_percentage < 20 ? 'bg-danger' : ($tank->level_percentage < 40 ? 'bg-warning' : 'bg-success') }}"
                                                role="progressbar"
                                                style="width: {{ $tank->level_percentage }}%">
                                                {{ number_format($tank->level_percentage, 1) }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ number_format($consumptionRates->get($tank->id)?->avg_daily_consumption ?? 0, 1) }} L</td>
                                    <td>
                                        @if($tank->days_until_empty)
                                            <span class="{{ $tank->days_until_empty < 7 ? 'text-danger' : 'text-success' }}">
                                                {{ $tank->days_until_empty }} days
                                            </span>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($deliveryStats->get($tank->id))
                                            {{ $deliveryStats->get($tank->id)->delivery_count }}
                                            (avg: {{ number_format($deliveryStats->get($tank->id)->avg_delivery_amount) }} L)
                                        @else
                                            No deliveries
                                        @endif
                                    </td>
                                    <td>
                                        @if($deliveryStats->get($tank->id)?->last_delivery)
                                            {{ Carbon\Carbon::parse($deliveryStats->get($tank->id)->last_delivery)->diffForHumans() }}
                                        @else
                                            Never
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Stock Levels Chart
    new Chart(document.getElementById('stockLevelsChart'), {
        type: 'bar',
        data: {
            labels: @json($stockLevels->pluck('name')),
            datasets: [{
                label: 'Current Level (L)',
                data: @json($stockLevels->pluck('current_level')),
                backgroundColor: @json($stockLevels->map(function($tank) {
                    $percentage = $tank->level_percentage;
                    return $percentage < 20 ? '#dc3545' : ($percentage < 40 ? '#ffc107' : '#28a745');
                })),
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Daily Sales Chart
    new Chart(document.getElementById('dailySalesChart'), {
        type: 'line',
        data: {
            labels: @json($dailySales->pluck('date')),
            datasets: [{
                label: 'Daily Sales (L)',
                data: @json($dailySales->pluck('total_amount')),
                borderColor: '#0d6efd',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Monthly Sales Chart
    new Chart(document.getElementById('monthlySalesChart'), {
        type: 'bar',
        data: {
            labels: @json($monthlySales->pluck('month_name')),
            datasets: [{
                label: 'Monthly Sales (L)',
                data: @json($monthlySales->pluck('total_amount')),
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush
