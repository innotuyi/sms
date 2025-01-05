@extends('layouts.master')

@section('page_title', 'Manage Transportation')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Transportation</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-vehicles" class="nav-link active" data-toggle="tab">Vehicles List</a></li>
            <li class="nav-item"><a href="#new-vehicle" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Add Vehicle</a></li>
        </ul>

        <div class="tab-content">
            {{-- Vehicles List --}}
            <div class="tab-pane fade show active" id="all-vehicles">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Vehicle Name</th>
                            <th>License Plate</th>
                            <th>Driver</th>
                            <th>Capacity</th>
                            <th>Route</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $vehicle)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vehicle->name }}</td>
                                <td>{{ $vehicle->license_plate }}</td>
                                <td>{{ $vehicle->driver }}</td>
                                <td>{{ $vehicle->capacity }}</td>
                                <td>{{ $vehicle->route }}</td>
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
            <div class="tab-pane fade" id="new-vehicle">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('vehicles.store') }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label for="name">Vehicle Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="license_plate">License Plate</label>
                                <input type="text" name="license_plate" class="form-control" id="license_plate" value="{{ old('license_plate') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="driver">Driver Name</label>
                                <input type="text" name="driver" class="form-control" id="driver" value="{{ old('driver') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="capacity">Capacity</label>
                                <input type="number" name="capacity" class="form-control" id="capacity" value="{{ old('capacity') }}" required min="1">
                            </div>

                            <div class="form-group">
                                <label for="route">Route</label>
                                <input type="text" name="route" class="form-control" id="route" value="{{ old('route') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description (optional)</label>
                                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Vehicle</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
