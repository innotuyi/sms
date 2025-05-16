@extends('layouts.master')
@section('page_title', 'Manage Universities')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Universities</h5>
        <div class="header-elements">
            <a href="{{ route('universities.create') }}" class="btn btn-primary">
                <i class="icon-plus2"></i> Add University
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4">
                <select class="form-control" id="type-filter">
                    <option value="">All Types</option>
                    <option value="PUBLIC">Public</option>
                    <option value="PRIVATE">Private</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-control" id="district-filter">
                    <option value="">All Districts</option>
                    @foreach($districts ?? [] as $district)
                        <option value="{{ $district }}">{{ $district }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>District</th>
                        <th>Rector</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($universities as $university)
                        <tr>
                            <td>{{ $university->university_code }}</td>
                            <td>{{ $university->name }}</td>
                            <td>{{ $university->type }}</td>
                            <td>{{ $university->district }}</td>
                            <td>{{ $university->rector_name }}</td>
                            <td>
                                <span class="badge badge-{{ $university->is_active ? 'success' : 'danger' }}">
                                    {{ $university->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="list-icons">
                                    <a href="{{ route('universities.show', $university->id) }}" class="list-icons-item text-info"><i class="icon-eye"></i></a>
                                    <a href="{{ route('universities.edit', $university->id) }}" class="list-icons-item text-primary"><i class="icon-pencil"></i></a>
                                    <a href="#" class="list-icons-item text-danger" 
                                       onclick="event.preventDefault(); if(confirm('Are you sure?')) document.getElementById('delete-form-{{ $university->id }}').submit();">
                                        <i class="icon-trash"></i>
                                    </a>
                                    <form id="delete-form-{{ $university->id }}" action="{{ route('universities.destroy', $university->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $universities->links() }}
        </div>
    </div>
</div>

@endsection

@section('page_scripts')
<script>
    $(document).ready(function() {
        $('#type-filter, #district-filter').change(function() {
            const type = $('#type-filter').val();
            const district = $('#district-filter').val();
            let url = new URL(window.location.href);
            
            if (type) url.searchParams.set('type', type);
            else url.searchParams.delete('type');
            
            if (district) url.searchParams.set('district', district);
            else url.searchParams.delete('district');
            
            window.location.href = url.toString();
        });

        // Set initial values from URL
        const urlParams = new URLSearchParams(window.location.search);
        $('#type-filter').val(urlParams.get('type') || '');
        $('#district-filter').val(urlParams.get('district') || '');
    });
</script>
@endsection 