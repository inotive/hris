<?php

namespace App\Jobs;

use App\Models\Company;
use App\Models\CompanyPayoutSetting;
use App\Models\Employee;
use App\Models\EmployeePayslip;
use App\Models\EmployeePayslipDetail;
use App\Models\EmployeePayslipGenerate;
use App\Models\EmployeePayslipTemplate;
use App\Models\Ptkp;
use Carbon\Carbon;
use Exception;
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

            $generate = EmployeePayslipGenerate::find($this->employee_payslip_generate_id);
            $pay_date = Carbon::parse($generate->year . "-" . $generate->month . "-01")->format('Y-m-t');

            $company_id = $employee->company_id;

            $company = Company::find($company_id);

            $now = Carbon::parse($generate->year . "-" . $generate->month . "-01");
            $period = $company->getMonthPeriod($now->format('Y'), $now->format('m'));
            $month_period_start = $period[0];
            $month_period_end = $period[1];
           

            $bank_account_name = $employee->bank_account_name;
            $bank_account_number = $employee->bank_account_number;
            $bank_account_number = is_int($bank_account_number) ? $bank_account_number : "0";
            
            $pay_method = $bank_account_name != null ? "transfer" : "cash";

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
            $tax = 0;
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
            $form->pay_date = $pay_date;
            $form->metode = $pay_method;
            $form->account_number = $bank_account_number;
            $form->account_name = $bank_account_name;
            $form->month_period_start = $month_period_start;
            $form->month_period_end = $month_period_end . ' 23:59:59';
            $form->employee_payslip_generate_id = $this->employee_payslip_generate_id;
            $form->month = $generate->month;
            $form->year = $generate->year;
            $form->generated_at = Carbon::now();
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



            // update tax

            try{
                $subtotal = $form->sub_total_payslip;

                // cari TER berapa persen

                $tax_method = $company->tax_calculation_method;

                if ($tax_method == null) {
                    $form->ter = null;
                    $form->tax = 0;
                } else {
                    $type_ter = $employee->type_ter;
                    Log::info($type_ter);
                    Log::info($subtotal);
                    $ptkp = Ptkp::where('type_ter', $type_ter)
                        ->where('value_start','<=', $subtotal)
                        ->where('value_end', '>=', $subtotal)
                        ->first();
                    Log::info($ptkp);
                    $form->ter = $ptkp->value;

                    // GROSS UP
                    if ($tax_method == 'gross-up') {
                        $form->tax = $subtotal * $form->ter / (100 - $form->ter);  
                    }else {
                        $form->tax = $subtotal * $form->ter / 100;

                    }
                  
    
                }
    
                $form->take_home_pay = $subtotal - $form->tax;
                if ($tax_method == 'gross-up') {
                    $form->bruto = $form->take_home_pay + $form->tax;
                } else {
                    $form->bruto = null;
                }
                $form->save();
            }catch(Exception $e){
                Log::error($e);
            }

            // end update tax

            DB::commit();


        }catch(Exception $e){
            Log::error($e);
            DB::rollBack();

        }
    }
}
