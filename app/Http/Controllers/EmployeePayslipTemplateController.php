<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeePayslipTemplate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeePayslipTemplateController extends Controller
{
    //

    public function index(Employee $employee, Request $request)
    {
        EmployeePayslipTemplate::initData($employee->id);

        $earning_details = EmployeePayslipTemplate::where('employee_id', $employee->id)->where('payslip_type','earning')->get();
        $deduction_details = EmployeePayslipTemplate::where('employee_id', $employee->id)->where('payslip_type','deduction')->get();
        
        
   
        
        return view('employees.payslip',[
            'employee'  => $employee,
            'deduction_details'  => $deduction_details,
            'earning_details'  => $earning_details,
            'form_action'   => route('employees.payslip-update', $employee),
            'cancel'    => route('employees.index'),
        ]);
    }


    public function update(Employee $employee, Request $request)
    {

        // $employee->update($request->all());

        try{
            DB::beginTransaction();
            EmployeePayslipTemplate::where('employee_id', $employee->id)->delete();
            
            foreach($request->earning as $key => $value) {

                EmployeePayslipTemplate::firstOrCreate([
                    'company_id'    => $employee->company_id,
                    'employee_id'   => $employee->id,
                    'employee_payslip_master_id'    => $value['master_id'],
                    'payslip_type'  => 'earning',
                    'type'  => $value['type'],
                    'value' => $value['amount'],
                ]);
            }

            foreach($request->deduction as $key => $value) {
                EmployeePayslipTemplate::firstOrCreate([
                    'company_id'    => $employee->company_id,
                    'employee_id'   => $employee->id,
                    'employee_payslip_master_id'    => $value['master_id'],
                    'payslip_type'  => 'deduction',
                    'type'  => $value['type'],
                    'value' => $value['amount'],
                ]);
            }

            $message = __('Data Saved Successfully');
            session()->flash('messages', [
                'success'   =>  $message,
            ]);

            DB::commit();

            return [
                'success'   => true,
                'message'   => $message,
                'redirect'  => route('employees.payslip', $employee),
            ];

        }catch(Exception $e){
            DB::rollBack();
            Log::error($e);
            return [
                'success'   => false,
                'message'   => 'Error',
            ];
        }
    }
}
