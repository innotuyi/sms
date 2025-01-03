@extends('layouts.master')

@section('page_title', 'Permission Requests')

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Permission Requests</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <table class="table datatable-button-html5-columns">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Student</th>
                        <th>Reason</th>
                        <th>Request Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $request)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $request->student_name }}</td>
                            <td>{{ $request->reason }}</td>
                            <td>{{ $request->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                @if($request->status === 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($request->status === 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($request->status === 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($request->status === 'pending')
                                    <!-- Approve/Reject Form -->
                                    <form action="{{ route('permissions.update', $request->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        
                                        <!-- Input for days with parent -->
                                        <div class="form-group">
                                        <input type="number" name="days_with_parent" class="form-control form-control-sm" placeholder="Days with Parent"  min="1">
                                        </div>
                                        
                                        <button type="submit" name="status" value="approved" class="btn btn-success btn-sm">Approve</button>
                                        <button type="submit" name="status" value="rejected" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                @elseif($request->status === 'approved')
                                    <button class="btn btn-success btn-sm" disabled>Approved</button>
                                @elseif($request->status === 'rejected')
                                    <button class="btn btn-danger btn-sm" disabled>Rejected</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
