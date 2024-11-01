<?php

namespace App\Http\Controllers;

use App\Models\EmployeePayslipGenerate;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeePayslipGenerateController extends Controller
{
    public function index(Request $request)
    {
        $list = [];

        return view('employee_payslip_generate.index',[
            'list'  => $list,
            
        ]);
    }


    public function create(Request $request)
    {
        return view('employee_payslip_generate.create',[
            
        ]);
    }

    public function edit($id, Request $request)
    {
        return view('employee_payslip_generate.edit',[
            
        ]);
    }


    public function store(Request $request)
    {

        // $request->validate((new EmployeeOrganizationExperience())->rules);

        // $form = new EmployeeOrganizationExperience();
        // $form->fill($request->all());
        // $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            // 'redirect'  => route('employee-payslip-generate.index', $employee),
        ];
    }


    public function update($id, Request $request)
    {
        // $request->validate((new EmployeeOrganizationExperience())->rules);

        // $form = EmployeeOrganizationExperience::find($id);
        // $form->fill($request->all());
        // $form->save();

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            // 'redirect'  => route('employee-payslip-generate.index', $employee),
        ];
    }


    public function destroy($id, Request $request)
    {
        // try{

        //     EmployeeOrganizationExperience::where('id', $id)->delete();
        
        //     return [
        //         'success'   => true,
        //         'meessage'  => 'Deleted',
        //     ];
        // }catch(Exception $e) {

        //     return [
        //         'success'   => false,
        //         'meessage'  => 'Error',
        //     ];
        // }
    }
}
