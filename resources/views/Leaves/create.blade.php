@extends('layouts.master')

@section('page_title', 'Request Leave')

@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="card-title">Request Leave</h6>
    </div>

    <div class="card-body">
        <form action="{{ route('leaves.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="leave_type">Leave Type</label>
                <input type="text" name="leave_type" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="reason">Reason</label>
                <textarea name="reason" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
