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
            <li class="nav-item"><a href="#loaned-books" class="nav-link" data-toggle="tab">Loaned Books</a></li>
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
                                    {{-- Borrow Book Button --}}
                                    <button class="btn btn-info" data-toggle="modal" data-target="#borrowBookModal" data-book-id="{{ $book->id }}" data-book-title="{{ $book->title }}">Borrow</button>
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

            {{-- Loaned Books List --}}
            <div class="tab-pane fade" id="loaned-books">
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Book Title</th>
                            <th>User Name</th>
                            <th>Borrowed At</th>
                            <th>Due At</th>
                            <th>Returned At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $loan->book_title }}</td>
                                <td>{{ $loan->user_name }}</td>
                                <td>{{ $loan->borrowed_at }}</td>
                                <td>{{ $loan->due_at }}</td>
                                <td>{{ $loan->returned_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- Borrow Book Modal --}}
<div class="modal fade" id="borrowBookModal" tabindex="-1" role="dialog" aria-labelledby="borrowBookModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="borrowBookModalLabel">Borrow Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('loans.borrow') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="book_id">Book</label>
                        <input type="text" name="book_id" id="book_id" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="date" name="due_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Borrow</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $('#borrowBookModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var bookId = button.data('book-id'); // Extract book ID from data attributes
        var bookTitle = button.data('book-title'); // Extract book title from data attributes

        var modal = $(this);
        modal.find('.modal-title').text('Borrow ' + bookTitle);
        modal.find('#book_id').val(bookId);
    });
</script>
@endsection
