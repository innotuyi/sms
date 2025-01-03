@extends('layouts.master')

@section('page_title', 'Manage Leaves')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Leaves</h6>
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-leaves" class="nav-link active" data-toggle="tab">Leaves List</a></li>
            <li class="nav-item"><a href="#new-leave" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Add Leave</a></li>
        </ul>

        <div class="tab-content">
            {{-- Leaves List --}}
            <div class="tab-pane fade show active" id="all-leaves">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Employee</th>
                            <th>Type</th>
                            <th>Reason</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaves as $leave)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $leave->user_name }}</td>
                                <td>{{ $leave->type }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>{{ $leave->status }}</td>
                                <td>
                                    <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Add Leave --}}
            <div class="tab-pane fade" id="new-leave">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('leaves.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="user_id">Employee</label>
                                <input type="number" name="user_id" class="form-control" id="user_id" required>
                            </div>

                            <div class="form-group">
                                <label for="type">Leave Type</label>
                                <select name="type" class="form-control" id="type" required>
                                    <option value="Sick">Sick</option>
                                    <option value="Annual">Annual</option>
                                    <option value="Maternity">Maternity</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="reason">Reason</label>
                                <textarea name="reason" class="form-control" id="reason" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="start_date" required>
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="end_date" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Leave</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
