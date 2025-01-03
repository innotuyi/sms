@extends('layouts.master')

@section('page_title', 'Manage Past Papers')

@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage Past Papers</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-past-papers" class="nav-link active" data-toggle="tab">Past Papers List</a>
                </li>
                <li class="nav-item"><a href="#new-past-paper" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i>
                        Add Past Paper</a></li>
            </ul>

            <div class="tab-content">
                {{-- Past Papers List --}}
                <div class="tab-pane fade show active" id="all-past-papers">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Academic Year</th>
                                <th>Subject</th>
                                <th>Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pastPapers as $pastPaper)
                                <tr>
                                    <td>{{$pastPaper->id }}</td>

                                    <td>{{$pastPaper->title }}</td>
                                    <td>{{$pastPaper->type }}</td>
                                    <td>{{$pastPaper->academic_year }}</td>
                                    <td>{{$pastPaper->subject }}</td>
                                    <td>{{$pastPaper->level }}</td>
                                    <td>
                                        <a href="{{ asset('storage/public/past_papers/' .$pastPaper->file_name) }}"
                                            target="_blank">Download</a>
                                    </td>
                                    {{-- <td>
                                        <a href="{{ route('past_papers.edit', $pastPaper->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('past_papers.destroy', $pastPaper->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Add Past Paper --}}
                <div class="tab-pane fade" id="new-past-paper">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('past_papers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                        value="{{ old('title') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control" id="type" required>
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="Ibizamini by’abalimu">Ibizamini by’abalimu</option>
                                        <option value="Ibizamini bya Leta">Ibizamini bya Leta</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="academic_year">Academic Year</label>
                                    <input type="text" name="academic_year" class="form-control" id="academic_year"
                                        value="{{ old('academic_year') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" class="form-control" id="subject"
                                        value="{{ old('subject') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select name="level" class="form-control" id="level" required>
                                        <option value="" disabled selected>Select Level</option>
                                        <option value="Primary">Primary</option>
                                        <option value="O-level">O-level</option>
                                        <option value="A-level">A-level</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="file">Upload File</label>
                                    <input type="file" name="document" class="form-control" id="file" {{ isset($pastPaper) ? '' : 'required' }}>
                                </div>
                                

                                <button type="submit" class="btn btn-primary">Add Past Paper</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
