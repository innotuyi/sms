@extends('layouts.master')

@section('page_title', 'Manage Routes')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Routes</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#routes-list" class="nav-link active" data-toggle="tab">Routes List</a></li>
            <li class="nav-item"><a href="#add-route" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Add Route</a></li>
        </ul>

        <div class="tab-content">
            {{-- Routes List --}}
            <div class="tab-pane fade show active" id="routes-list">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Route Name</th>
                            <th>Start Point</th>
                            <th>End Point</th>
                            <th>Distance (km)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($routes as $route)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $route->route_name }}</td>
                                <td>{{ $route->start_point }}</td>
                                <td>{{ $route->end_point }}</td>
                                <td>{{ $route->distance }}</td>
                                <td>
                                    <a href="{{ route('routes.edit', $route->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('routes.destroy', $route->id) }}" method="POST" style="display:inline;">
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

            {{-- Add Route --}}
            <div class="tab-pane fade" id="add-route">
                <form action="{{ route('routes.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="route_name">Route Name</label>
                        <input type="text" name="route_name" class="form-control" id="route_name" required>
                    </div>

                    <div class="form-group">
                        <label for="start_point">Start Point</label>
                        <input type="text" name="start_point" class="form-control" id="start_point" required>
                    </div>

                    <div class="form-group">
                        <label for="end_point">End Point</label>
                        <input type="text" name="end_point" class="form-control" id="end_point" required>
                    </div>

                    <div class="form-group">
                        <label for="distance">Distance (km)</label>
                        <input type="number" step="0.01" name="distance" class="form-control" id="distance" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Route</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
