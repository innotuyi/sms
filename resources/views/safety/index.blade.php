@extends('layouts.master')

@section('page_title', 'Manage Safety Incidents')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Safety Incidents</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#incidents-list" class="nav-link active" data-toggle="tab">Incidents List</a></li>
            <li class="nav-item"><a href="#report-incident" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Report Incident</a></li>
        </ul>

        <div class="tab-content">
            {{-- Incidents List --}}
            <div class="tab-pane fade show active" id="incidents-list">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Severity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($incidents as $incident)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $incident->date }}</td>
                                <td>{{ $incident->description }}</td>
                                <td>{{ $incident->severity }}</td>
                                <td>
                                    <a href="{{ route('safety.edit', $incident->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('safety.destroy', $incident->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Report Incident --}}
            <div class="tab-pane fade" id="report-incident">
                <form action="{{ route('safety.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" class="form-control" id="date" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="severity">Severity</label>
                        <select name="severity" id="severity" class="form-control" required>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Report Incident</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
