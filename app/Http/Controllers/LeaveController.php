<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = DB::select('SELECT l.*, u.name AS user_name FROM leaves l JOIN users u ON l.user_id = u.id');
        return view('leaves.index', compact('leaves'));
    }

    public function store(Request $request)
    {
        DB::insert(
            'INSERT INTO leaves (user_id, type, reason, start_date, end_date, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())',
            [
                $request->user_id,
                $request->type,
                $request->reason,
                $request->start_date,
                $request->end_date,
                'Pending'
            ]
        );

        return redirect()->route('leaves.index')->with('success', 'Leave request added successfully!');
    }

    public function approve($id)
    {
        DB::update('UPDATE leaves SET status = "Approved" WHERE id = ?', [$id]);
        return redirect()->route('leaves.index')->with('success', 'Leave request approved!');
    }

    public function reject($id)
    {
        DB::update('UPDATE leaves SET status = "Rejected" WHERE id = ?', [$id]);
        return redirect()->route('leaves.index')->with('success', 'Leave request rejected!');
    }
}
