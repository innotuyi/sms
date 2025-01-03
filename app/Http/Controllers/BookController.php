<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{


    // Display a list of all books
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Display details for a single book
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    // Show the form to create a new book
    public function create()
    {
        return view('books.create');
    }

    // Store a new book in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    // Show the form to edit an existing book
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book')); // Pass the book to the edit view
    }
    
    // Update the details of an existing book
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $id,
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    // Delete a book from the inventory
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }

    // Search for books by title, author, or ISBN
    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = Book::where('title', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
            ->orWhere('isbn', 'LIKE', "%{$query}%")
            ->get();

        return view('books.index', compact('books'));
    }
}
