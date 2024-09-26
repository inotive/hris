<?php

namespace App\Http\Controllers;

use App\Models\EmployeePayslip;
use App\Models\EmployeePayslipDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        try{
            $request->validate((new EmployeePayslip())->rules);


            $total_payslip_earning = 0;
            $total_payslip_deduction = 0;

            $earning = $request->earning ?? [];
            $deduction = $request->deduction ?? [];


            foreach($earning as $k => $v) {
                $total_payslip_earning += (float) $v['amount'];
            }

            foreach($deduction as $k => $v) {
                $total_payslip_deduction += (float) $v['amount'];
            }

            $sub_total_payslip = $total_payslip_earning - $total_payslip_deduction;
            $tax = $request->tax ?? 0;
            $take_home_pay = $sub_total_payslip - $tax;

            DB::beginTransaction();

            $form = new EmployeePayslip();
            $form->company_id = $request->company_id;
            $form->employee_id = $request->employee_id;
            $form->total_payslip_earning = $total_payslip_earning;
            $form->total_payslip_deduction = $total_payslip_deduction;
            $form->sub_total_payslip = $sub_total_payslip;
            $form->tax = $tax;
            $form->take_home_pay = $take_home_pay;
            $form->pay_date = $request->pay_date;
            $form->metode = $request->metode;
            $form->account_number = $request->account_number;
            $form->account_name = $request->account_name;
            $form->file = $request->file;
            $form->save();

            // Log::info($form);
            // Log::info(json_encode($request->all()));
            // return null;


            foreach($earning as $k => $v) {
                EmployeePayslipDetail::create([
                    'company_id'    => $request->company_id,
                    'employee_payslip_master_earning_id'    => $v['master_id'],
                    'payslip_type'  => 'earning',
                    'type'  => $v['type'],
                    'value' => (float) $v['amount'],
                    'employee_payslip_id'   => $form->id,
                ]);
            }

            foreach($deduction as $k => $v) {
                EmployeePayslipDetail::create([
                    'company_id'    => $request->company_id,
                    'employee_payslip_master_earning_id'    => $v['master_id'],
                    'payslip_type'  => 'deduction',
                    'type'  => $v['type'],
                    'value' => (float) $v['amount'],
                    'employee_payslip_id'   => $form->id,
                ]);
            }

            DB::commit();
            return [
                'success'   => true,
                'message'   => __('Data Saved Successfully'),
                'redirect'  => route('employee-payslips.index'),
            ];


        }catch(Exception $e){
            Log::error($e);
            DB::rollBack();
            return [
                'success'   => false,
                'message'   => __('Error'),
            ];
        }
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
