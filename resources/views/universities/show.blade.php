@extends('layouts.master')
@section('page_title', 'University Details')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">University Details</h5>
        <div class="header-elements">
            <a href="{{ route('universities.index') }}" class="btn btn-secondary mr-2">
                <i class="icon-circle-left2"></i> Back to Universities
            </a>
            <a href="{{ route('universities.edit', $university->id) }}" class="btn btn-primary">
                <i class="icon-pencil"></i> Edit University
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">University Code</th>
                            <td>{{ $university->university_code }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $university->name }}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>
                                <span class="badge badge-{{ $university->type == 'PUBLIC' ? 'primary' : 'info' }}">
                                    {{ $university->type }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge badge-{{ $university->is_active ? 'success' : 'danger' }}">
                                    {{ $university->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Province</th>
                            <td>{{ $university->province ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>District</th>
                            <td>{{ $university->district }}</td>
                        </tr>
                        <tr>
                            <th>Sector</th>
                            <td>{{ $university->sector ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Email</th>
                            <td>{{ $university->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $university->phone_number ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td>
                                @if($university->website)
                                    <a href="{{ $university->website }}" target="_blank">{{ $university->website }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Rector</th>
                            <td>{{ $university->rector_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Established</th>
                            <td>{{ $university->established_year ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Accreditation</th>
                            <td>
                                <span class="badge badge-{{ $university->accreditation_status == 'Accredited' ? 'success' : ($university->accreditation_status == 'Provisional' ? 'warning' : 'secondary') }}">
                                    {{ $university->accreditation_status ?? 'N/A' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $university->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        @if($university->description)
        <div class="row mt-3">
            <div class="col-md-12">
                <h6>Description</h6>
                <p class="text-justify">{{ $university->description }}</p>
            </div>
        </div>
        @endif

        @if($university->faculties)
        <div class="row mt-3">
            <div class="col-md-12">
                <h6>Faculties</h6>
                <ul class="list-group">
                    @foreach(json_decode($university->faculties) as $faculty)
                        <li class="list-group-item">{{ $faculty }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection 