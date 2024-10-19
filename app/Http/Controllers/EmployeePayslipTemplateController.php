<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeePayslipTemplate;
use App\Models\Ptkp;
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
        
        
        $ptkp_list = Ptkp::select([
            DB::raw("CONCAT(type_ter, ' - ', notes) as name"),
            'type_ter'
        ])
            ->groupBy('type_ter','notes')->orderBy('type_ter')->pluck('name', 'type_ter');
   
        
        return view('employees.payslip',[
            'employee'  => $employee,
            'deduction_details'  => $deduction_details,
            'earning_details'  => $earning_details,
            'ptkp_list' => $ptkp_list,
            'form_action'   => route('employees.payslip-update', $employee),
            'cancel'    => route('employees.index'),
        ]);
    }


    public function update(Employee $employee, Request $request)
    {

        // $employee->update($request->all());

        try{
            DB::beginTransaction();

            $em = Employee::find($employee->id);
            $em->bank_account_name = $request->bank_account_name;
            $em->bank_account_number = $request->bank_account_number;
            $em->join_date = $request->join_date;
            $em->type_ter = $request->type_ter;
            $em->overtime_type = $request->overtime_type;
            $em->overtime_value = $request->overtime_value;
            $em->reimbursement_type = $request->reimbursement_type;
            $em->reimbursement_limit = $request->reimbursement_limit;
            $em->save();

            EmployeePayslipTemplate::where('employee_id', $employee->id)->delete();
            
            foreach($request->earning ?? [] as $key => $value) {

                EmployeePayslipTemplate::firstOrCreate([
                    'company_id'    => $employee->company_id,
                    'employee_id'   => $employee->id,
                    'employee_payslip_master_id'    => $value['master_id'],
                    'payslip_type'  => 'earning',
                    'type'  => $value['type'],
                    'value' => $value['amount'],
                ]);
            }

            foreach($request->deduction ?? [] as $key => $value) {
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
