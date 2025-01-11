@extends('layouts.master')

@section('page_title', 'Manage Bus Attendance')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Bus Attendance</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#attendance-list" class="nav-link active" data-toggle="tab">Attendance List</a></li>
            <li class="nav-item"><a href="#add-attendance" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Add Attendance</a></li>
        </ul>

        <div class="tab-content">
            {{-- Attendance List --}}
            <div class="tab-pane fade show active" id="attendance-list">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Student Name</th>
                            <th>Route</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Present</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($busAttendances as $attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attendance->student_name ?? 'N/A' }}</td> <!-- Display student name -->
                                <td>{{ $attendance->route_name ?? 'N/A' }}</td> <!-- Display route name -->
                                <td>{{ $attendance->date }}</td>
                                <td>{{ $attendance->time }}</td>
                                <td>{{ $attendance->present ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('bus_attendance.edit', $attendance->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('bus_attendance.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Add Attendance --}}
            <div class="tab-pane fade" id="add-attendance">
                <form action="{{ route('bus_attendance.store') }}" method="POST">
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
                        <label for="route_id">Route</label>
                        <select name="route_id" id="route_id" class="form-control" required>
                            <option value="">Select Route</option>
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->route_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="time" name="time" id="time" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="present">Present</label>
                        <select name="present" id="present" class="form-control" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Record Attendance</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
