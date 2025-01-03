@extends('layouts.master')

@section('page_title', 'Payroll Management')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="card-title">Manage Payrolls</h6>
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-payrolls" class="nav-link active" data-toggle="tab">Payroll List</a></li>
            <li class="nav-item"><a href="#new-payroll" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Process Payroll</a></li>
        </ul>

        <div class="tab-content">
            {{-- Payroll List --}}
            <div class="tab-pane fade show active" id="all-payrolls">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Employee</th>
                            <th>Basic Salary</th>
                            <th>Allowances</th>
                            <th>Deductions</th>
                            <th>Net Salary</th>
                            <th>Payment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payrolls as $payroll)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payroll->employee_name }}</td>
                                <td>{{ number_format($payroll->basic_salary, 2) }}</td>
                                <td>{{ number_format($payroll->allowances, 2) }}</td>
                                <td>{{ number_format($payroll->deductions, 2) }}</td>
                                <td>{{ number_format($payroll->net_salary, 2) }}</td>
                                <td>{{ $payroll->payment_date }}</td>
                                <td>
                                    <form action="{{ route('payrolls.delete', $payroll->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Process Payroll --}}
            <div class="tab-pane fade" id="new-payroll">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('payrolls.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="user_id">Employee</label>
                                <input type="number" name="user_id" class="form-control" id="user_id" required>
                            </div>

                            <div class="form-group">
                                <label for="basic_salary">Basic Salary</label>
                                <input type="number" name="basic_salary" class="form-control" id="basic_salary" step="0.01" required>
                            </div>

                            <div class="form-group">
                                <label for="allowances">Allowances</label>
                                <input type="number" name="allowances" class="form-control" id="allowances" step="0.01" value="0.00">
                            </div>

                            <div class="form-group">
                                <label for="deductions">Deductions</label>
                                <input type="number" name="deductions" class="form-control" id="deductions" step="0.01" value="0.00">
                            </div>

                            <div class="form-group">
                                <label for="payment_date">Payment Date</label>
                                <input type="date" name="payment_date" class="form-control" id="payment_date" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Process Payroll</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
