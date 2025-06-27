<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends SchoolBaseController
{
    public function index()
    {
        $schoolId = $this->getSchoolId();
        $payrolls = DB::select(
            'SELECT p.*, u.name AS employee_name 
            FROM payrolls p 
            JOIN users u ON p.user_id = u.id
            WHERE p.school_id = ?',
            [$schoolId]
        );

        $users = DB::table('users')
            ->where('school_id', $schoolId)
            ->whereIn('user_type', ['teacher', 'admin', 'accountant'])
            ->select('id', 'name')
            ->get();

        return view('payrolls.index', compact('payrolls', 'users'));
    }

    public function store(Request $request)
    {
        $schoolId = $this->getSchoolId();
        
        // Verify user belongs to school
        $user = DB::selectOne(
            'SELECT * FROM users WHERE id = ? AND school_id = ?',
            [$request->user_id, $schoolId]
        );

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        $net_salary = $request->basic_salary + $request->allowances - $request->deductions;

        DB::insert(
            'INSERT INTO payrolls 
            (user_id, basic_salary, allowances, deductions, net_salary, payment_date, school_id, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())',
            [
                $request->user_id,
                $request->basic_salary,
                $request->allowances,
                $request->deductions,
                $net_salary,
                $request->payment_date,
                $schoolId
            ]
        );

        return redirect()->route('payrolls.index')->with('success', 'Payroll processed successfully!');
    }

    public function delete($id)
    {
        $schoolId = $this->getSchoolId();
        
        // Verify payroll belongs to school
        $payroll = DB::selectOne(
            'SELECT * FROM payrolls WHERE id = ? AND school_id = ?',
            [$id, $schoolId]
        );

        if (!$payroll) {
            abort(403, 'Unauthorized action.');
        }

        DB::delete('DELETE FROM payrolls WHERE id = ? AND school_id = ?', [$id, $schoolId]);
        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully!');
    }
}
