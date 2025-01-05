@extends('layouts.master')

@section('page_title', 'Manage Student Transport')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Student Transport</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#transport-list" class="nav-link active" data-toggle="tab">Transport List</a></li>
            <li class="nav-item"><a href="#add-transport" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Assign Transport</a></li>
        </ul>

        <div class="tab-content">
            {{-- Transport List --}}
            <div class="tab-pane fade show active" id="transport-list">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Student Name</th>
                            <th>Vehicle</th>
                            <th>Route</th>
                            <th>Assigned Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentTransports as $transport)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transport->student_name }}</td>
                                <td>{{ $transport->vehicle_name }}</td>
                                <td>{{ $transport->route_name }}</td>
                                <td>{{ $transport->created_at }}</td>
                                <td>
                                    <form action="{{ route('student_transports.destroy', $transport->id) }}" method="POST" style="display:inline;">
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

            {{-- Add Transport --}}
            <div class="tab-pane fade" id="add-transport">
                <form action="{{ route('student_transports.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="student_id">Student</label>
                        <select name="student_id" id="student_id" class="form-control" required>
                            <option value="">Select Student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->student_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vehicle_id">Vehicle</label>
                        <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                            <option value="">Select Vehicle</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="route_id">Route</label>
                        <select name="route_id" id="route_id" class="form-control" required>
                            <option value="">Select Route</option>
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->route_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Assign Transport</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
