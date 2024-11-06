<?php

namespace App\Jobs;

use App\Models\Employee;
use App\Models\EmployeePayslip;
use App\Models\EmployeePayslipDetail;
use App\Models\EmployeePayslipTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GeneratePayslipFromTemplateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public $employee_payslip_generate_id, public  $employee_id)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $employee = Employee::find( $this->employee_id);

        if ($employee == null) return;


        try{

            $company_id = $employee->company_id;

            $total_payslip_earning = 0;
            $total_payslip_deduction = 0;

            $templates = EmployeePayslipTemplate::where('employee_id', $this->employee_id)->get();

            $earning = [];
            $deduction = [];

            foreach ($templates as $template) {

                $insert = [
                    'master_id' => $template->master->id,
                    'type'  => $template->type,
                    'amount' => $template->value,
                ];
                if ($template->master->master_type == 'earning') {
                    $earning[] = $insert;
                } else {
                    $deduction[] =$insert;
                }
            }

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
            $form->company_id = $employee->company_id;
            $form->employee_id = $employee->id;
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
            $form->employee_payslip_generate_id = $this->employee_payslip_generate_id;
            $form->save();

            // Log::info($form);
            // Log::info(json_encode($request->all()));
            // return null;


            EmployeePayslipDetail::where('employee_payslip_id', $form->id)->delete();

            foreach($earning as $k => $v) {
                EmployeePayslipDetail::create([
                    'company_id'    => $company_id,
                    'employee_payslip_master_id'    => $v['master_id'],
                    'payslip_type'  => 'earning',
                    'type'  => $v['type'],
                    'value' => (float) $v['amount'],
                    'employee_payslip_id'   => $form->id,
                ]);
            }

            foreach($deduction as $k => $v) {
                EmployeePayslipDetail::create([
                    'company_id'    => $company_id,
                    'employee_payslip_master_id'    => $v['master_id'],
                    'payslip_type'  => 'deduction',
                    'type'  => $v['type'],
                    'value' => (float) $v['amount'],
                    'employee_payslip_id'   => $form->id,
                ]);
            }

            DB::commit();


        }catch(Exception $e){
            Log::error($e);
            DB::rollBack();

        }
    }
}
