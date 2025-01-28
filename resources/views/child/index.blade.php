@extends('layouts.master')

@section('page_title', 'Manage Child Applications')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Child Applications</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-applications" class="nav-link active" data-toggle="tab">Applications List</a></li>
            <li class="nav-item"><a href="#new-application" class="nav-link" data-toggle="modal" data-target="#addApplicationModal"><i class="icon-plus2"></i> Add Application</a></li>
        </ul>

        <div class="tab-content">
            {{-- Applications List --}}
            <div class="tab-pane fade show active" id="all-applications">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Child Name</th>
                            <th>Category</th>
                            <th>Marks Percentage</th>
                            <th>Parent Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $application->child_full_name }}</td>
                                <td>{{ $application->category }}</td>
                                <td>{{ $application->marks_percentage }}%</td>
                                <td>{{ $application->parent_full_name }}</td>
                                <td>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editApplicationModal" data-application="{{ $application }}">Edit</a>
                                    <form action="{{ route('child-applications.destroy', $application->id) }}" method="POST" style="display:inline;">
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
        </div>
    </div>
</div>

{{-- Add Application Modal --}}
<div class="modal fade" id="addApplicationModal" tabindex="-1" role="dialog" aria-labelledby="addApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('child-applications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addApplicationModalLabel">Add New Application</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="child_full_name">Child Full Name</label>
                        <input type="text" name="child_full_name" class="form-control" id="child_full_name" value="{{ old('child_full_name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select name="category" class="form-control" id="category" required>
                            <option value="">Select Category</option>
                            <option value="ordinary">Ordinary Level</option>
                            <option value="advanced">Advanced Level</option>
                        </select>
                    </div>
                      <div class="form-group" id="optionContainer" style="display: none;"> 
                                <label for="option">Select Option:</label>
                                <select class="form-control" id="option" name="option">
                                    <option value="">Select Option</option>
                                    <option value="physics-chemistry-mathematics">Physics-Chemistry-Mathematics</option>
                                    <option value="mathematics-chemistry-biology">Mathematics-Chemistry-Biology</option>
                                    <option value="mathematics-physics-geography">Mathematics-Physics-Geography</option>
                                    <option value="physics-chemistry-biology">Physics-Chemistry-Biology</option> 
                                </select>
                            </div>

                    <div class="form-group">
                        <label for="marks_percentage">Marks Percentage</label>
                        <input type="number" name="marks_percentage" class="form-control" id="marks_percentage" value="{{ old('marks_percentage') }}" required min="0" max="100">
                    </div>

                    <div class="form-group">
                        <label for="marks_attachment">Marks Attachment (Optional)</label>
                        <input type="file" name="marks_attachment" class="form-control" id="marks_attachment">
                    </div>

                    <div class="form-group">
                        <label for="parent_full_name">Parent Full Name</label>
                        <input type="text" name="parent_full_name" class="form-control" id="parent_full_name" value="{{ old('parent_full_name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="parent_email">Parent Email</label>
                        <input type="email" name="parent_email" class="form-control" id="parent_email" value="{{ old('parent_email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="parent_phone">Parent Phone</label>
                        <input type="text" name="parent_phone" class="form-control" id="parent_phone" value="{{ old('parent_phone') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Application</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Application Modal --}}
<div class="modal fade" id="editApplicationModal" tabindex="-1" role="dialog" aria-labelledby="editApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editApplicationModalLabel">Edit Application</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_child_full_name">Child Full Name</label>
                        <input type="text" name="child_full_name" class="form-control" id="edit_child_full_name" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_category">Category</label>
                        <input type="text" name="category" class="form-control" id="edit_category" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_marks_percentage">Marks Percentage</label>
                        <input type="number" name="marks_percentage" class="form-control" id="edit_marks_percentage" required min="0" max="100">
                    </div>

                    <div class="form-group">
                        <label for="edit_marks_attachment">Marks Attachment (Optional)</label>
                        <input type="file" name="marks_attachment" class="form-control" id="edit_marks_attachment">
                    </div>

                    <div class="form-group">
                        <label for="edit_parent_full_name">Parent Full Name</label>
                        <input type="text" name="parent_full_name" class="form-control" id="edit_parent_full_name" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_parent_email">Parent Email</label>
                        <input type="email" name="parent_email" class="form-control" id="edit_parent_email" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_parent_phone">Parent Phone</label>
                        <input type="text" name="parent_phone" class="form-control" id="edit_parent_phone" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Application</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Edit Application Modal
    $('#editApplicationModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var application = button.data('application'); 

        var modal = $(this);
        modal.find('#editForm').attr('action', '/child-applications/' + application.id);
        modal.find('#edit_child_full_name').val(application.child_full_name);
        modal.find('#edit_category').val(application.category);
        modal.find('#edit_marks_percentage').val(application.marks_percentage);
        modal.find('#edit_parent_full_name').val(application.parent_full_name);
        modal.find('#edit_parent_email').val(application.parent_email);
        modal.find('#edit_parent_phone').val(application.parent_phone);
    });
</script>
@endsection
