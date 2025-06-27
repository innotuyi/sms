@extends('layouts.master')
@section('page_title', 'Add New School')

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Add New School</h6>
            <div class="header-elements">
                <a href="{{ route('super_admin.schools.index') }}" class="btn btn-primary">Back to Schools List</a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('super_admin.schools.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <h5>School Information</h5>
                        <div class="form-group">
                            <label>School Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>School Code <span class="text-danger">*</span></label>
                            <input type="text" name="school_code" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Address <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5>School Admin Information</h5>
                        <div class="form-group">
                            <label>Admin Name <span class="text-danger">*</span></label>
                            <input type="text" name="admin_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Admin Email <span class="text-danger">*</span></label>
                            <input type="email" name="admin_email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Admin Phone <span class="text-danger">*</span></label>
                            <input type="text" name="admin_phone" class="form-control" required>
                        </div>

                        <div class="alert alert-info">
                            <p><strong>Note:</strong> The default password for the admin account will be: <strong>admin123</strong></p>
                            <p>The admin should change this password after first login.</p>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Create School and Admin <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection 