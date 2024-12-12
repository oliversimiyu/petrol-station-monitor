@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="mb-4">Petrol Station Dashboard</h1>
            
            <!-- Fuel Tanks Overview -->
            <div class="row mb-4">
                @foreach($fuelTanks as $tank)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tank->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $tank->fuel_type }}</h6>
                            
                            <div class="progress mb-3">
                                @php
                                    $percentage = ($tank->current_level / $tank->capacity) * 100;
                                    $colorClass = $percentage <= 20 ? 'bg-danger' : ($percentage <= 40 ? 'bg-warning' : 'bg-success');
                                @endphp
                                <div class="progress-bar {{ $colorClass }}" role="progressbar" 
                                     style="width: {{ $percentage }}%" 
                                     aria-valuenow="{{ $percentage }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                    {{ number_format($percentage, 1) }}%
                                </div>
                            </div>
                            
                            <p class="card-text">
                                Current Level: {{ number_format($tank->current_level) }} L<br>
                                Capacity: {{ number_format($tank->capacity) }} L<br>
                                Minimum Level: {{ number_format($tank->minimum_level) }} L
                            </p>
                            
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recordSaleModal{{ $tank->id }}">
                                    Record Sale
                                </button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#recordDeliveryModal{{ $tank->id }}">
                                    Record Delivery
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Recent Activities -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Recent Sales
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tank</th>
                                        <th>Amount (L)</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentSales as $sale)
                                    <tr>
                                        <td>{{ $sale->fuelTank->name }}</td>
                                        <td>{{ number_format($sale->amount) }} L</td>
                                        <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Recent Deliveries
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tank</th>
                                        <th>Amount (L)</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentDeliveries as $delivery)
                                    <tr>
                                        <td>{{ $delivery->fuelTank->name }}</td>
                                        <td>{{ number_format($delivery->amount) }} L</td>
                                        <td>{{ $delivery->created_at->format('Y-m-d H:i') }}</td>
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
</div>

<!-- Sale Modals -->
@foreach($fuelTanks as $tank)
<div class="modal fade" id="recordSaleModal{{ $tank->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record Sale - {{ $tank->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('sales.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="fuel_tank_id" value="{{ $tank->id }}">
                    <div class="mb-3">
                        <label class="form-label">Amount (Liters)</label>
                        <input type="number" class="form-control" name="amount" required min="1" max="{{ $tank->current_level }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Record Sale</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Delivery Modals -->
@foreach($fuelTanks as $tank)
<div class="modal fade" id="recordDeliveryModal{{ $tank->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record Delivery - {{ $tank->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('deliveries.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="fuel_tank_id" value="{{ $tank->id }}">
                    <div class="mb-3">
                        <label class="form-label">Amount (Liters)</label>
                        <input type="number" class="form-control" name="amount" required min="1" max="{{ $tank->capacity - $tank->current_level }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Record Delivery</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
