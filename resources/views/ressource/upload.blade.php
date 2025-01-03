@extends('layouts.master')

@section('page_title', 'Upload Resource')

@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Upload Resource</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <form action="{{ route('resources.upload') }}" method="POST" enctype="multipart/form-data">
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
                <label for="file">File</label>
                <input type="file" name="file" class="form-control" id="file" required>
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>
@endsection
