@extends('layouts.master')

@section('page_title', 'Child Permissions')

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Child Permission Requests</h6>
        </div>

        <div class="card-body">
            @if(empty($permissions))
                <p class="text-center">No permission requests found for your children.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Child</th>
                            <th>Reason</th>
                            <th>Request Date</th>
                            <th>Status</th>
                            <th>Days with Parent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $index => $request)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $request->student_name }}</td>
                                <td>{{ $request->reason }}</td>
                                <td>{{ \Carbon\Carbon::parse($request->request_date)->format('d-m-Y H:i') }}</td>
                                <td>
                                    @if($request->status === 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($request->status === 'approved')
                                        <span class="badge badge-success">Approved</span>
                                    @elseif($request->status === 'rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if($request->status === 'approved')
                                        {{ $request->days_with_parent }} Days
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
