@extends('layouts.master')
@section('page_title', 'Manage Visiting Schedule')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Visiting Schedule</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        @if(Qs::userIsTeamSA())
        <div class="text-right mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addScheduleModal">
                <i class="fas fa-plus mr-2"></i> Add New Schedule
            </button>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table datatable-button-html5-columns">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Visiting Date</th>
                        <th>Time</th>
                        <th>Special Instructions</th>
                        @if(Qs::userIsTeamSA())
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->month }}</td>
                            <td>{{ $schedule->visiting_date->format('l, F j, Y') }}</td>
                            <td>{{ $schedule->start_time->format('g:i A') }} - {{ $schedule->end_time->format('g:i A') }}</td>
                            <td>{{ $schedule->special_instructions ?? 'N/A' }}</td>
                            @if(Qs::userIsTeamSA())
                            <td>
                                <div class="list-icons">
                                    <button class="btn btn-info btn-sm" onclick="editSchedule({{ $schedule->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('visiting-schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(Qs::userIsTeamSA())
<!-- Add Schedule Modal -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('visiting-schedules.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Visiting Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="month">Month:</label>
                        <input type="text" name="month" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="visiting_date">Visiting Date:</label>
                        <input type="date" name="visiting_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time:</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time:</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="special_instructions">Special Instructions:</label>
                        <textarea name="special_instructions" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Schedule Modal -->
<div class="modal fade" id="editScheduleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editScheduleForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Visiting Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_month">Month:</label>
                        <input type="text" name="month" id="edit_month" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_visiting_date">Visiting Date:</label>
                        <input type="date" name="visiting_date" id="edit_visiting_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_start_time">Start Time:</label>
                        <input type="time" name="start_time" id="edit_start_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_end_time">End Time:</label>
                        <input type="time" name="end_time" id="edit_end_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_special_instructions">Special Instructions:</label>
                        <textarea name="special_instructions" id="edit_special_instructions" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection

@section('page_scripts')
<script>
    function editSchedule(id) {
        // Fetch schedule data and populate the edit form
        $.get(`/school-info/visiting-schedules/${id}/edit`, function(schedule) {
            $('#editScheduleForm').attr('action', `/school-info/visiting-schedules/${id}`);
            $('#edit_month').val(schedule.month);
            $('#edit_visiting_date').val(schedule.visiting_date);
            $('#edit_start_time').val(schedule.start_time);
            $('#edit_end_time').val(schedule.end_time);
            $('#edit_special_instructions').val(schedule.special_instructions);
            $('#editScheduleModal').modal('show');
        });
    }
</script>
@endsection 