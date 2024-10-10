<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeePayrollController extends Controller
{
    //

    public function index(Employee $employee, Request $request)
    {
        return view('employees.payroll',[
            'employee'  => $employee,
            'form'  => $employee,
            'form_action'   => route('employees.payroll-update', $employee),
            'cancel'    => route('companies.index'),
        ]);
    }


    public function update(Employee $employee, Request $request)
    {

        $employee->update($request->all());

        $message = __('Data Saved Successfully');
        session()->flash('messages', [
            'success'   =>  $message,
        ]);


        return [
            'success'   => true,
            'message'   => $message,
            'redirect'  => route('employees.payroll', $employee),
        ];
    }
}
