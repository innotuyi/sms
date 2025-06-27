@extends('layouts.master')

@section('page_title', 'Import Schools')

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Import Schools from Excel</h6>
            {!! Qs::getPanelOptions() !!}
        </div>
        <div class="card-body">
            <form action="{{ route('schools.import.process') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="file">Choose Excel File</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                    @error('file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Import</button>
            </form>
        </div>
    </div>
@endsection
