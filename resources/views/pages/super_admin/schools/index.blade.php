@extends('layouts.master')
@section('page_title', 'Manage Schools')

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Schools List</h6>
            <div class="header-elements">
                <a href="{{ route('super_admin.schools.create') }}" class="btn btn-primary">Add New School</a>
            </div>
        </div>

        <div class="card-body">
            @if(session('flash_success'))
                <div class="alert alert-success">
                    {{ session('flash_success') }}
                </div>
            @endif

            <table class="table datatable-button-html5-basic">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>School Name</th>
                        <th>School Code</th>
                        <th>Email</th>
                        <th>Admin Name</th>
                        <th>Admin Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schools as $school)
                        <tr>
                            <td>{{ $school->id ?? 'N/A' }}</td>
                            <td>{{ $school->school_name ?? 'N/A' }}</td>
                            <td>{{ $school->school_code }}</td>
                            <td>{{ $school->email }}</td>
                            <td>{{ $school->admin->name ?? 'N/A' }}</td>
                            <td>{{ $school->admin->email ?? 'N/A' }}</td>
                            <td>
                                <span class="badge badge-{{ $school->is_active ? 'success' : 'danger' }}">
                                    {{ $school->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if($school->id)
                                                <a href="{{ route('super_admin.schools.edit', $school->id) }}" class="dropdown-item">
                                                    <i class="icon-pencil"></i> Edit
                                                </a>
                                                <a href="{{ route('super_admin.schools.toggle-status', $school->id) }}" class="dropdown-item">
                                                    <i class="icon-{{ $school->is_active ? 'cross' : 'check' }}"></i>
                                                    {{ $school->is_active ? 'Deactivate' : 'Activate' }}
                                                </a>
                                                <a href="{{ route('super_admin.schools.reset-admin-password', $school->id) }}" class="dropdown-item">
                                                    <i class="icon-key"></i> Reset Admin Password
                                                </a>
                                            @else
                                                <a class="dropdown-item disabled" title="School record incomplete">
                                                    <i class="icon-pencil"></i> Edit (Unavailable)
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection 