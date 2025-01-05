@extends('layouts.master')

@section('page_title', 'Manage Vehicles')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Vehicles</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#vehicles-list" class="nav-link active" data-toggle="tab">Vehicles List</a></li>
            <li class="nav-item"><a href="#add-vehicle" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Add Vehicle</a></li>
        </ul>

        <div class="tab-content">
            {{-- Vehicles List --}}
            <div class="tab-pane fade show active" id="vehicles-list">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Vehicle Number</th>
                            <th>Driver Name</th>
                            <th>Driver Phone</th>
                            <th>Capacity</th>
                            <th>Vehicle Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $vehicle)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vehicle->vehicle_number }}</td>
                                <td>{{ $vehicle->driver_name }}</td>
                                <td>{{ $vehicle->driver_phone }}</td>
                                <td>{{ $vehicle->capacity }}</td>
                                <td>{{ $vehicle->vehicle_type }}</td>
                                <td>
                                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Add Vehicle --}}
            <div class="tab-pane fade" id="add-vehicle">
                <form action="{{ route('vehicles.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="vehicle_number">Vehicle Number</label>
                        <input type="text" name="vehicle_number" class="form-control" id="vehicle_number" required>
                    </div>

                    <div class="form-group">
                        <label for="driver_name">Driver Name</label>
                        <input type="text" name="driver_name" class="form-control" id="driver_name" required>
                    </div>

                    <div class="form-group">
                        <label for="driver_phone">Driver Phone</label>
                        <input type="text" name="driver_phone" class="form-control" id="driver_phone" required>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="number" name="capacity" class="form-control" id="capacity" required>
                    </div>

                    <div class="form-group">
                        <label for="vehicle_type">Vehicle Type</label>
                        <input type="text" name="vehicle_type" class="form-control" id="vehicle_type" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Vehicle</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
