@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">Fuel Tanks</h2>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addTankModal">
                        Add New Tank
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Fuel Type</th>
                                    <th>Capacity</th>
                                    <th>Current Level</th>
                                    <th>Minimum Level</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fuelTanks as $tank)
                                <tr>
                                    <td>{{ $tank->name }}</td>
                                    <td>{{ $tank->fuel_type }}</td>
                                    <td>{{ number_format($tank->capacity, 2) }} L</td>
                                    <td>{{ number_format($tank->current_level, 2) }} L</td>
                                    <td>{{ number_format($tank->minimum_level, 2) }} L</td>
                                    <td>
                                        @if($tank->current_level <= $tank->minimum_level)
                                            <span class="badge badge-danger">Low</span>
                                        @else
                                            <span class="badge badge-success">Normal</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#updateTankModal-{{ $tank->id }}">
                                            Update Level
                                        </button>
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

<!-- Add Tank Modal -->
<div class="modal fade" id="addTankModal" tabindex="-1" role="dialog" aria-labelledby="addTankModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('fuel-tanks.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTankModalLabel">Add New Fuel Tank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fuel Type</label>
                        <input type="text" name="fuel_type" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Capacity (L)</label>
                        <input type="number" name="capacity" class="form-control" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label>Current Level (L)</label>
                        <input type="number" name="current_level" class="form-control" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label>Minimum Level (L)</label>
                        <input type="number" name="minimum_level" class="form-control" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Tank</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($fuelTanks as $tank)
<!-- Update Tank Modal -->
<div class="modal fade" id="updateTankModal-{{ $tank->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('fuel-tanks.update', $tank) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Update {{ $tank->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Current Level (L)</label>
                        <input type="number" name="current_level" class="form-control" step="0.01" value="{{ $tank->current_level }}" required>
                    </div>
                    <div class="form-group">
                        <label>Minimum Level (L)</label>
                        <input type="number" name="minimum_level" class="form-control" step="0.01" value="{{ $tank->minimum_level }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
