@extends('layouts.master')

@section('page_title', 'Manage Resources')

@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Resources</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-resources" class="nav-link active" data-toggle="tab">Resources List</a></li>
            <li class="nav-item"><a href="#new-resource" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Add Resource</a></li>
        </ul>

        <div class="tab-content">
            {{-- Resources List --}}
            <div class="tab-pane fade show active" id="all-resources">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resources as $resource)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $resource->title }}</td>
                                <td>{{ $resource->description }}</td>
                                <td>
                                    <a href="{{ route('resources.show', $resource->id) }}" class="btn btn-info">View</a>
                                    <form action="{{ route('resources.destroy', $resource->id) }}" method="POST" style="display:inline;">
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

            {{-- Add Resource --}}
            <div class="tab-pane fade" id="new-resource">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('ressource.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description (optional)</label>
                                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="file">Upload File</label>
                                <input type="file" name="file" class="form-control" id="file" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Upload Resource</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection