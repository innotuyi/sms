<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = DB::select('
            SELECT p.*, u.name AS employee_name 
            FROM payrolls p 
            JOIN users u ON p.user_id = u.id
        ');

        return view('payrolls.index', compact('payrolls'));
    }

    public function store(Request $request)
    {
        $net_salary = $request->basic_salary + $request->allowances - $request->deductions;

        DB::insert('
            INSERT INTO payrolls 
            (user_id, basic_salary, allowances, deductions, net_salary, payment_date, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
        ', [
            $request->user_id,
            $request->basic_salary,
            $request->allowances,
            $request->deductions,
            $net_salary,
            $request->payment_date,
        ]);

        return redirect()->route('payrolls.index')->with('success', 'Payroll processed successfully!');
    }

    public function delete($id)
    {
        DB::delete('DELETE FROM payrolls WHERE id = ?', [$id]);
        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully!');
    }
}
