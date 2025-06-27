@extends('layouts.master')

@section('page_title', 'Manage Books')

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Manage Books</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-books" class="nav-link active" data-toggle="tab">Books List</a></li>
            <li class="nav-item"><a href="#new-book" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Add Book</a></li>
        </ul>

        <div class="tab-content">
            {{-- Books List --}}
            <div class="tab-pane fade show active" id="all-books">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>{{ $book->quantity }}</td>
                                <td>
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
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

            {{-- Add Book --}}
            <div class="tab-pane fade" id="new-book">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('books.store') }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" name="author" class="form-control" id="author" value="{{ old('author') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="isbn">ISBN</label>
                                <input type="text" name="isbn" class="form-control" id="isbn" value="{{ old('isbn') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="quantity" value="{{ old('quantity') }}" required min="1">
                            </div>

                            <div class="form-group">
                                <label for="description">Description (optional)</label>
                                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
