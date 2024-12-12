@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row g-3 my-2">
        <!-- Overview Cards -->
        <div class="col-md-4">
            <div class="p-card h-100">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="d-block text-uppercase fs-sm fw-semibold text-muted mb-1">Total Sales Today</span>
                        <span class="d-block fs-4 fw-bold text-dark mb-1">Ksh {{ number_format($totalSales, 2) }}</span>
                    </div>
                    <div class="p-card-icon bg-primary-soft">
                        <i class="fas fa-cash-register"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-card h-100">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="d-block text-uppercase fs-sm fw-semibold text-muted mb-1">Deliveries Today</span>
                        <span class="d-block fs-4 fw-bold text-dark mb-1">{{ $totalDeliveries }}</span>
                    </div>
                    <div class="p-card-icon bg-success-soft">
                        <i class="fas fa-truck-moving"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-card h-100">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="d-block text-uppercase fs-sm fw-semibold text-muted mb-1">Active Tanks</span>
                        <span class="d-block fs-4 fw-bold text-dark mb-1">{{ $activeTanks }}</span>
                    </div>
                    <div class="p-card-icon bg-info-soft">
                        <i class="fas fa-gas-pump"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fuel Tanks Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-gas-pump me-2"></i>Fuel Tanks Status
                        </h5>
                        <span class="badge bg-primary">
                            <i class="fas fa-chart-line me-1"></i>Live Status
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach($fuelTanks as $tank)
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-gas-pump me-2"></i>{{ $tank->name }}
                                        </h5>
                                        @php
                                            $percentage = ($tank->current_level / $tank->capacity) * 100;
                                            $statusClass = $percentage <= 20 ? 'danger' : ($percentage <= 40 ? 'warning' : 'success');
                                            $statusIcon = $percentage <= 20 ? 'fas fa-exclamation-triangle' : 
                                                       ($percentage <= 40 ? 'fas fa-exclamation' : 'fas fa-check-circle');
                                        @endphp
                                        <span class="badge bg-{{ $statusClass }}">
                                            <i class="{{ $statusIcon }} me-1"></i>
                                            {{ number_format($percentage, 1) }}%
                                        </span>
                                    </div>
                                    <h6 class="text-muted mb-3">
                                        <i class="fas fa-oil-can me-2"></i>{{ $tank->fuel_type }}
                                    </h6>
                                    
                                    <div class="progress mb-3" style="height: 10px;">
                                        <div class="progress-bar bg-{{ $statusClass }}" 
                                             role="progressbar" 
                                             style="width: {{ $percentage }}%" 
                                             aria-valuenow="{{ $percentage }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                    
                                    <div class="small text-muted mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span><i class="fas fa-tachometer-alt me-2"></i>Current Level:</span>
                                            <span>{{ number_format($tank->current_level) }} L</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1">
                                            <span><i class="fas fa-flask me-2"></i>Capacity:</span>
                                            <span>{{ number_format($tank->capacity) }} L</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span><i class="fas fa-level-down-alt me-2"></i>Minimum Level:</span>
                                            <span>{{ number_format($tank->minimum_level) }} L</span>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recordSaleModal{{ $tank->id }}">
                                            <i class="fas fa-cart-plus me-2"></i>Record Sale
                                        </button>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#recordDeliveryModal{{ $tank->id }}">
                                            <i class="fas fa-truck-loading me-2"></i>Record Delivery
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Section -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-receipt me-2"></i>Recent Sales
                    </h5>
                    <span class="badge bg-primary">
                        <i class="fas fa-clock me-1"></i>Last 5 Transactions
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-gas-pump me-2"></i>Tank</th>
                                    <th><i class="fas fa-fill-drip me-2"></i>Amount</th>
                                    <th><i class="fas fa-calendar-alt me-2"></i>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                <tr>
                                    <td>{{ $sale->fuelTank->name }}</td>
                                    <td>{{ number_format($sale->amount) }} L</td>
                                    <td>{{ $sale->created_at->format('M d, H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-truck-loading me-2"></i>Recent Deliveries
                    </h5>
                    <span class="badge bg-success">
                        <i class="fas fa-clock me-1"></i>Last 5 Deliveries
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-gas-pump me-2"></i>Tank</th>
                                    <th><i class="fas fa-fill-drip me-2"></i>Amount</th>
                                    <th><i class="fas fa-calendar-alt me-2"></i>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentDeliveries as $delivery)
                                <tr>
                                    <td>{{ $delivery->fuelTank->name }}</td>
                                    <td>{{ number_format($delivery->amount) }} L</td>
                                    <td>{{ $delivery->created_at->format('M d, H:i') }}</td>
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

<!-- Sale Modals -->
@foreach($fuelTanks as $tank)
<div class="modal fade" id="recordSaleModal{{ $tank->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-cart-plus me-2"></i>Record Sale - {{ $tank->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('sales.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="fuel_tank_id" value="{{ $tank->id }}">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-fill-drip me-2"></i>Amount (Liters)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-gas-pump"></i></span>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                   name="amount" required min="1" step="0.01"
                                   max="{{ $tank->current_level }}"
                                   value="{{ old('amount') }}">
                            <span class="input-group-text">L</span>
                        </div>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>Maximum available: {{ number_format($tank->current_level) }} L
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-money-bill me-2"></i>Payment Method
                        </label>
                        <select class="form-select @error('payment_method') is-invalid @enderror" name="payment_method">
                            <option value="">Select payment method</option>
                            <option value="cash">Cash</option>
                            <option value="mpesa">M-PESA</option>
                            <option value="card">Card</option>
                            <option value="other">Other</option>
                        </select>
                        @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-receipt me-2"></i>Transaction Reference
                        </label>
                        <input type="text" class="form-control @error('transaction_reference') is-invalid @enderror" 
                               name="transaction_reference" 
                               placeholder="Enter transaction reference (optional)"
                               value="{{ old('transaction_reference') }}">
                        @error('transaction_reference')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>Optional: Enter M-PESA code or receipt number
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Record Sale
                    </button>
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
                <h5 class="modal-title">
                    <i class="fas fa-truck-loading me-2"></i>Record Delivery - {{ $tank->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('deliveries.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="fuel_tank_id" value="{{ $tank->id }}">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-fill-drip me-2"></i>Amount (Liters)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-gas-pump"></i></span>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                   name="amount" required min="1" step="0.01"
                                   max="{{ $tank->capacity - $tank->current_level }}"
                                   value="{{ old('amount') }}">
                            <span class="input-group-text">L</span>
                        </div>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>Maximum capacity remaining: {{ number_format($tank->capacity - $tank->current_level) }} L
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Close
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Record Delivery
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .table th i {
        color: #6c757d;
    }
    .p-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .p-card-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-size: 18px;
        color: #fff;
    }
    .bg-primary-soft {
        background-color: #cce5ff;
    }
    .bg-success-soft {
        background-color: #c6efce;
    }
    .bg-info-soft {
        background-color: #cff5ff;
    }
</style>
@endpush
