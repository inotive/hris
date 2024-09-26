<?php

namespace App\Http\Controllers;

use App\Models\EmployeePayslip;
use Exception;
use Illuminate\Http\Request;

class EmployeePayslipController extends Controller
{
    public function index( Request $request)
    {
        $list = EmployeePayslip::paginate();

        return view('employee_payslips.index',[
            'list'  => $list,

        ]);
    }


    public function create( Request $request)
    {
        return view('employee_payslips.create',[

        ]);
    }

    public function edit( $id, Request $request)
    {
        return view('employee_payslips.edit',[

            'form'  => EmployeePayslip::find($id),
        ]);
    }


    public function store( Request $request)
    {
        $request->validate((new EmployeePayslip())->rules);

        $form = new EmployeePayslip();
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('employee-payslips.index'),
        ];
    }


    public function update( $id, Request $request)
    {

        $request->validate((new EmployeePayslip())->rules);

        $form = EmployeePayslip::find($id);
        $form->fill($request->all());
        $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route('employee-payslips.index'),
        ];
    }


    public function destroy( $id, Request $request)
    {
        try{

            EmployeePayslip::where('id', $id)->delete();
        
            return [
                'success'   => true,
                'meessage'  => 'Deleted',
            ];
        }catch(Exception $e) {

            return [
                'success'   => false,
                'meessage'  => 'Error',
            ];
        }
    }
}
