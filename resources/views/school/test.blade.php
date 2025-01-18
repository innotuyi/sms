@extends('layouts.master')

@section('page_title', 'Assign Settings to Schools')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Assign Settings</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-settings" class="nav-link active" data-toggle="tab">Settings List</a></li>
            <li class="nav-item"><a href="#new-setting" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Assign Setting</a></li>
        </ul>

        <div class="tab-content">
            {{-- Settings List --}}
            <div class="tab-pane fade show active" id="all-settings">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>School Name</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($s as $type => $description)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $type }}</td>
                                <td>{{ $description }}</td>
                                <td>
                                    <a href="{{ route('settings.edit', $type) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('settings.destroy', $type) }}" method="POST" style="display:inline;">
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

            {{-- Assign Setting --}}
            <div class="tab-pane fade" id="new-setting">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('super_admin.assign_setting') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="school_id">School</label>
                                <select name="school_id" id="school_id" class="form-control" required>
                                    <option value="" disabled selected>Select School</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="type">Setting Type</label>
                                <input type="text" name="type" class="form-control" id="type" value="{{ old('type') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" required>{{ old('description') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Assign Setting</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
