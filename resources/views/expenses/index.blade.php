@extends('layouts.master')

@section('page_title', 'Manage Expenses')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Expenses</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-expenses" class="nav-link active" data-toggle="tab">Expenses List</a></li>
            <li class="nav-item"><a href="#new-expense" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Add Expense</a></li>
        </ul>

        <div class="tab-content">
            {{-- Expenses List --}}
            <div class="tab-pane fade show active" id="all-expenses">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Requested By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $expense)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>{{ $expense->amount }}</td>
                                <td>{{ $expense->category }}</td>
                                <td>{{ $expense->status }}</td>
                                <td>{{ $expense->requested_by }}</td>
                                <td>
                                    <td>
                                        <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-warning">Edit</a>
                                        {{-- <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form> --}}
                                        <form action="{{ route('expenses.approve', $expense->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('expenses.reject', $expense->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                    </td>
                                    
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Add Expense --}}
            <div class="tab-pane fade" id="new-expense">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('expenses.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="description">Title</label>
                                <textarea name="title" class="form-control" id="description" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" class="form-control" id="amount" value="{{ old('amount') }}" required min="0.01" step="0.01">
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control" id="category" required>
                                    <option value="" disabled selected>Select Category</option>
                                    <option value="Office Supplies">Office Supplies</option>
                                    <option value="Travel">Travel</option>
                                    <option value="Utilities">Utilities</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="requested_by">Requested By</label>
                                <input type="text" name="requested_by" class="form-control" id="requested_by" value="{{ old('requested_by') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Expense</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
