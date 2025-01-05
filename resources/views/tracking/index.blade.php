@extends('layouts.master')

@section('page_title', 'Manage Vehicle Tracking')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Vehicle Tracking</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#tracked-vehicles" class="nav-link active" data-toggle="tab">Tracked Vehicles</a></li>
            <li class="nav-item"><a href="#update-tracking" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Update Tracking Data</a></li>
        </ul>

        <div class="tab-content">
            {{-- Tracked Vehicles List --}}
            <div class="tab-pane fade show active" id="tracked-vehicles">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Vehicle ID</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trackedVehicles as $vehicle)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vehicle->id }}</td>
                                <td>{{ $vehicle->location }}</td>
                                <td>{{ $vehicle->status }}</td>
                                <td>{{ $vehicle->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Update Tracking Data --}}
            <div class="tab-pane fade" id="update-tracking">
                <form action="{{ route('tracking.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="vehicle_id">Vehicle ID</label>
                        <input type="text" name="vehicle_id" class="form-control" id="vehicle_id" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control" id="location" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Tracking</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
