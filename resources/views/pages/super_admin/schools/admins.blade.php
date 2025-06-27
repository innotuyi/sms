@extends('layouts.master')
@section('page_title', 'School Admins')

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">All School Admins</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>School</th>
                        <th>School Code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $i => $admin)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>{{ $admin->school->school_name ?? 'N/A' }}</td>
                            <td>{{ $admin->school->school_code ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection 