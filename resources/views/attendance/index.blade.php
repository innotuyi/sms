@extends('layouts.master')
@section('page_title', 'Manage Attendance')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage Attendance</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-attendance" class="nav-link active" data-toggle="tab">Attendance Records</a></li>
                <li class="nav-item"><a href="#new-attendance" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Add Attendance</a></li>
            </ul>

            <div class="tab-content">
                {{-- Attendance Records --}}
                <div class="tab-pane fade show active" id="all-attendance">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Student Name</th>
                                <th>Attendance Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attendance->student_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d-m-Y') }}</td>
                                    <td>{{ ucfirst($attendance->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Add Attendance --}}
                <div class="tab-pane fade" id="new-attendance">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info border-0 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                <span>You are adding attendance for the section: <strong>{{ $section->name }}</strong></span>
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('attendance.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="section_id" value="{{ $section->id }}">
                
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Present</th>
                                            <th>Absent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $student->name }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <input 
                                                            class="form-check-input" 
                                                            type="radio" 
                                                            name="attendance[{{ $student->id }}]" 
                                                            value="present" 
                                                            required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <input 
                                                            class="form-check-input" 
                                                            type="radio" 
                                                            name="attendance[{{ $student->id }}]" 
                                                            value="absent" 
                                                            required>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                
                                <button type="submit" class="btn btn-primary">Submit Attendance</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <style>
                
                
                        </div>
        </div>
    </div>
    
.table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    /* Centering content within table cells */
    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }

    /* Ensuring radio buttons are aligned in the center of the cell */
    .d-flex {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Optional: Adjust the size of the radio buttons */
    .form-check-input {
        width: 20px;
        height: 20px;
        margin: 0;
    }

    /* Add spacing between radio buttons and text */
    .form-check-label {
        margin-left: 5px;
    }

    /* Optional: Style for the submit button */
    .btn {
        margin-top: 20px;
    }
</style>



@endsection

