@extends('layouts.master')
@section('page_title', 'My Children')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">My Children</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <table class="table datatable-button-html5-columns">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>ADM_No</th>
                    <th>Section</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $s->user->photo }}" alt="photo"></td>
                        <td>{{ $s->user->name }}</td>
                        <td>{{ $s->adm_no }}</td>
                        <td>{{ $s->my_class->name.' '.$s->section->name }}</td>
                        <td>{{ $s->user->email }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-left">
                                        <a href="{{ route('students.show', Qs::hash($s->id)) }}" class="dropdown-item">
                                            <i class="icon-eye"></i> View Profile
                                        </a>
                                        <a target="_blank" href="{{ route('marks.year_selector', Qs::hash($s->user->id)) }}" class="dropdown-item">
                                            <i class="icon-check"></i> Marksheet
                                        </a>
                                        <!-- Request Permission -->
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#requestPermissionModal{{ $s->id }}">
                                            <i class="icon-file-plus"></i> Request Permission
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal for Requesting Permission -->
                    <div class="modal fade" id="requestPermissionModal{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="requestPermissionLabel{{ $s->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('permissions.request', $s->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="requestPermissionLabel{{ $s->id }}">Request Permission for {{ $s->user->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="reason">Reason for Permission Request:</label>
                                            <textarea name="reason" id="reason" class="form-control" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit Request</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of Modal -->
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
