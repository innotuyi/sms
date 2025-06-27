@extends('layouts.master')
@section('page_title', 'Manage Feeding Timetable')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Feeding Timetable</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <div class="text-right mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTimetableModal">
                <i class="fas fa-plus mr-2"></i> Add New Entry
            </button>
        </div>

        <div class="table-responsive">
            <table class="table datatable-button-html5-columns">
                <thead>
                    <tr>
                        <th>Day of Week</th>
                        <th>Morning Meal</th>
                        <th>Lunch Meal</th>
                        <th>Dinner Meal</th>
                        <th>Special Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($timetables as $timetable)
                        <tr>
                            <td>{{ $timetable->day_of_week }}</td>
                            <td>{{ $timetable->morning_meal }}</td>
                            <td>{{ $timetable->lunch_meal }}</td>
                            <td>{{ $timetable->dinner_meal }}</td>
                            <td>{{ $timetable->special_notes ?? 'N/A' }}</td>
                            <td>
                                <div class="list-icons">
                                    <button class="btn btn-info btn-sm" onclick="editTimetable({{ $timetable->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('feeding-timetables.destroy', $timetable->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Timetable Modal -->
<div class="modal fade" id="addTimetableModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('feeding-timetables.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Feeding Timetable Entry</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="day_of_week">Day of Week:</label>
                        <select name="day_of_week" class="form-control" required>
                            <option value="">Select Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="morning_meal">Morning Meal:</label>
                        <input type="text" name="morning_meal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="lunch_meal">Lunch Meal:</label>
                        <input type="text" name="lunch_meal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="dinner_meal">Dinner Meal:</label>
                        <input type="text" name="dinner_meal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="special_notes">Special Notes:</label>
                        <textarea name="special_notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Timetable Modal -->
<div class="modal fade" id="editTimetableModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editTimetableForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Feeding Timetable Entry</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_day_of_week">Day of Week:</label>
                        <select name="day_of_week" id="edit_day_of_week" class="form-control" required>
                            <option value="">Select Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_morning_meal">Morning Meal:</label>
                        <input type="text" name="morning_meal" id="edit_morning_meal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_lunch_meal">Lunch Meal:</label>
                        <input type="text" name="lunch_meal" id="edit_lunch_meal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_dinner_meal">Dinner Meal:</label>
                        <input type="text" name="dinner_meal" id="edit_dinner_meal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_special_notes">Special Notes:</label>
                        <textarea name="special_notes" id="edit_special_notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function editTimetable(id) {
        // Fetch timetable data and populate the edit form
        $.get(`/feeding-timetables/${id}/edit`, function(timetable) {
            $('#editTimetableForm').attr('action', `/feeding-timetables/${id}`);
            $('#edit_day_of_week').val(timetable.day_of_week);
            $('#edit_morning_meal').val(timetable.morning_meal);
            $('#edit_lunch_meal').val(timetable.lunch_meal);
            $('#edit_dinner_meal').val(timetable.dinner_meal);
            $('#edit_special_notes').val(timetable.special_notes);
            $('#editTimetableModal').modal('show');
        });
    }
</script>
@endsection 