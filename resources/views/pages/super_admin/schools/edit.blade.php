@extends('layouts.master')
@section('page_title', 'Edit School')

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit School</h6>
            <div class="header-elements">
                <a href="{{ route('super_admin.schools.index') }}" class="btn btn-primary">Back to Schools List</a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('super_admin.schools.update', $school->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <h5>School Information</h5>
                        <div class="form-group">
                            <label>School Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $school->school_name }}" required>
                        </div>

                        <div class="form-group">
                            <label>School Code <span class="text-danger">*</span></label>
                            <input type="text" name="school_code" class="form-control" value="{{ $school->school_code }}" required>
                        </div>

                        <div class="form-group">
                            <label>Address <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" rows="3" required>{{ $school->address }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" value="{{ $school->phone_number }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ $school->email }}" required>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1" {{ $school->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$school->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update School</button>
                </div>
            </form>
            <hr>
            <h5>Add/Change School Admin</h5>
            <form action="{{ route('super_admin.schools.add-admin', $school->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Admin Name</label>
                    <input type="text" name="admin_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Admin Email</label>
                    <input type="email" name="admin_email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Admin Phone</label>
                    <input type="text" name="admin_phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Admin Username (optional)</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Add/Change Admin</button>
            </form>
        </div>
    </div>
@endsection 