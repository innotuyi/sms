<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    // Display a list of all loans

    public function index()
    {
        // Modify the query to use borrowed_at as loan_date
        $loans = DB::select("
            SELECT loans.*, books.title AS book_title, users.name AS user_name, loans.borrowed_at AS loan_date
            FROM loans
            INNER JOIN books ON loans.book_id = books.id
            INNER JOIN users ON loans.user_id = users.id
        ");
        
        $books = DB::select("
            SELECT * FROM books WHERE quantity > 0
        ");
        
        return view('loans.index', compact('loans', 'books'));
    }
    
    
    // Borrow a book and create a loan record
    public function borrow(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        // Fetch the book using raw SQL
        $book = DB::selectOne("SELECT * FROM books WHERE id = ? LIMIT 1", [$request->book_id]);

        if (!$book || $book->quantity < 1) {
            return redirect()->back()->with('error', 'No copies available for borrowing!');
        }

        // Insert a loan record
        DB::insert("
            INSERT INTO loans (book_id, user_id, borrowed_at, due_at, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?)
        ", [
            $book->id,
            auth()->id(),
            now(),
            $request->due_date,
            now(),
            now(),
        ]);

        // Decrement the book quantity
        DB::update("
            UPDATE books SET quantity = quantity - 1 WHERE id = ?
        ", [$book->id]);

        return redirect()->back()->with('success', 'Book borrowed successfully!');
    }

    // Return a borrowed book and update loan status
    public function return($loanId)
    {
        // Fetch the loan using raw SQL
        $loan = DB::selectOne("
            SELECT * FROM loans WHERE id = ? LIMIT 1
        ", [$loanId]);

        if (!$loan) {
            return redirect()->route('loans.index')->with('error', 'Loan not found!');
        }

        // Mark the loan as returned
        DB::update("
            UPDATE loans SET returned_at = ?, updated_at = ? WHERE id = ?
        ", [now(), now(), $loanId]);

        // Increment the book quantity
        DB::update("
            UPDATE books SET quantity = quantity + 1 WHERE id = ?
        ", [$loan->book_id]);

        return redirect()->route('loans.index')->with('success', 'Book returned successfully!');
    }

    // Display overdue loans
    public function overdue()
    {
        $overdueLoans = DB::select("
            SELECT loans.*, books.title AS book_title, users.name AS user_name
            FROM loans
            INNER JOIN books ON loans.book_id = books.id
            INNER JOIN users ON loans.user_id = users.id
            WHERE loans.returned_at IS NULL AND loans.due_at < ?
        ", [now()]);

        return view('loans.overdue', compact('overdueLoans'));
    }
}
