@extends('layouts.master')

@section('page_title', 'Resource Details')

@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Resource Details</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <h4>{{ $resource->title }}</h4>
        <p>{{ $resource->description }}</p>
        <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank" class="btn btn-info">Download</a>
    </div>
</div>
@endsection
