<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = DB::table('expenses')
            ->leftJoin('users as requested', 'expenses.requested_by', '=', 'requested.id')
            ->leftJoin('users as approved', 'expenses.approved_by', '=', 'approved.id')
            ->select(
                'expenses.*',
                'requested.name as requested_by_name',
                'approved.name as approved_by_name'
            )
            ->get();

        return view('expenses.index', compact('expenses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        Expense::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'amount' => $validated['amount'],
            'requested_by' => auth()->id(),
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense request submitted successfully!');
    }

    // public function approve($id)
    // {
    //     $expense = DB::table('expenses')->where('id', $id)->first();

    //     if (!$expense) {
    //         return redirect()->back()->with('error', 'Expense not found.');
    //     }

    //     // Check if the user has the appropriate role
    //     if (!auth()->user()->hasRole('accountant') && !auth()->user()->hasRole('headmaster')) {
    //         abort(403, 'You are not authorized to approve expenses.');
    //     }

    //     DB::table('expenses')->where('id', $id)->update([
    //         'status' => 'Approved',
    //         'approved_by' => auth()->id(),
    //         'approved_at' => now(),
    //     ]);

    //     return redirect()->back()->with('success', 'Expense approved successfully!');
    // }

    // public function reject($id)
    // {
    //     $expense = DB::table('expenses')->where('id', $id)->first();

    //     if (!$expense) {
    //         return redirect()->back()->with('error', 'Expense not found.');
    //     }

    //     // Check if the user has the appropriate role
    //     if (!auth()->user()->hasRole('accountant') && !auth()->user()->hasRole('headmaster')) {
    //         abort(403, 'You are not authorized to reject expenses.');
    //     }

    //     DB::table('expenses')->where('id', $id)->update([
    //         'status' => 'Rejected',
    //         'approved_by' => auth()->id(),
    //         'approved_at' => now(),
    //     ]);

    //     return redirect()->back()->with('success', 'Expense rejected!');
    // }
    public function approve($id)
    {

        $expense = Expense::findOrFail($id);
        $expense->status = 'Approved';
        $expense->approved_by = auth()->id(); // Assuming you store the approver's ID
        $expense->approved_at = now();
        $expense->save();

        return redirect()->back()->with('success', 'Expense approved successfully.');
    }

    public function reject($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->status = 'Rejected';
        $expense->approved_by = auth()->id();
        $expense->approved_at = now();
        $expense->save();

        return redirect()->back()->with('success', 'Expense rejected successfully.');
    }
}
