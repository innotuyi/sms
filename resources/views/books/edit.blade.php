@extends('layouts.master')

@section('page_title', 'Edit Book')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Edit Book</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $book->title) }}" required>
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" id="author" value="{{ old('author', $book->author) }}" required>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" class="form-control" id="isbn" value="{{ old('isbn', $book->isbn) }}" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" id="quantity" value="{{ old('quantity', $book->quantity) }}" required min="1">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description">{{ old('description', $book->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update Book</button>
        </form>
    </div>
</div>

@endsection
