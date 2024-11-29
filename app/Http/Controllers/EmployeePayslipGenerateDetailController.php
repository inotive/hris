<?php

namespace App\Http\Controllers;

use App\Jobs\GeneratePayslipFromTemplateJob;
use App\Models\Employee;
use App\Models\EmployeePayslip;
use App\Models\EmployeePayslipGenerate;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeePayslipGenerateDetailController extends Controller
{
    public function index($id, Request $request)
    {
        $list = EmployeePayslip::where('employee_payslip_generate_id', $id)
            ->orderBy('created_at','desc')->paginate();

        return view('employee_payslip_generate.detail',[
            'list'  => $list,

        ]);
    }


    public function create(Request $request)
    {
       
    }

    public function edit($id, Request $request)
    {
       
    }


    public function store(Request $request)
    {

        

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
             'redirect'  => route('employee-payslip-generate.index'),
        ];
    }


    public function update($id, Request $request)
    {
        

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            // 'redirect'  => route('employee-payslip-generate.index', $employee),
        ];
    }


    public function destroy($id, Request $request)
    {
      
    }
}
