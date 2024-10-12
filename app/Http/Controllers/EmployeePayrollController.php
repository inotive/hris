<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Ptkp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeePayrollController extends Controller
{
    //

    public function index(Employee $employee, Request $request)
    {

        $ptkp_list = Ptkp::select([
            DB::raw("CONCAT(type_ter, ' - ', notes) as name"),
            'type_ter'
        ])
            ->groupBy('type_ter','notes')->orderBy('type_ter')->pluck('name', 'type_ter');

        return view('employees.payroll',[
            'employee'  => $employee,
            'ptkp_list' => $ptkp_list,
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
