<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\EmployeePayslip;
use App\Models\EmployeePayslipDetail;
use App\Models\EmployeePayslipMaster;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeePayslipController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;

        $company_id = $filter['company_id'] ?? null;

        $list = EmployeePayslip::search($request->search)

            ->when($company_id, function ($query) use ($company_id) {
                $query->where('company_id', $company_id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('employee_payslips.index', [
            'list' => $list,

        ]);
    }


    public function create(Request $request)
    {
        return view('employee_payslips.create', [

        ]);
    }

    public function edit($id, Request $request)
    {
        $form = EmployeePayslip::find($id);

        // dd($form);

        return view('employee_payslips.edit', [

            'form' => $form,
        ]);
    }

    private function _save(Request $request)
    {
        $request->validate((new EmployeePayslip())->rules);

        try {


            $redirect = $request->redirect ?? null;

            Log::info($redirect);

            $approve = $request->approve ?? false;

            Log::info($approve);

            $total_payslip_earning = 0;
            $total_payslip_deduction = 0;

            $earning = $request->earning ?? [];
            $deduction = $request->deduction ?? [];

            if (count($earning) == 0) {
                throw new Exception("Earning is required");
            }

            if (count($deduction) == 0) {
                throw new Exception("Deduction is required");
            }


            foreach ($earning as $k => $v) {
                $total_payslip_earning += (float) $v['amount'];
            }

            foreach ($deduction as $k => $v) {
                $total_payslip_deduction += (float) $v['amount'];
            }

            $sub_total_payslip = $total_payslip_earning - $total_payslip_deduction;
            $tax = $request->tax ?? 0;
            $take_home_pay = $sub_total_payslip - $tax;

            DB::beginTransaction();

            $form = $request->slip_id != null ? EmployeePayslip::where('id', $request->slip_id)->first() : new EmployeePayslip();
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

            if ($approve == true) {
                $company = Company::find($form->company_id);
                $form->approved_at = $company->date_time_location;
                $form->approved_by_user_id = auth()->user()->id;
            } else {
                $form->approved_at = null;
                $form->approved_by_user_id = null;
            }
            $form->save();

            // Log::info($form);
            // Log::info(json_encode($request->all()));
            // return null;


            EmployeePayslipDetail::where('employee_payslip_id', $form->id)->delete();

            foreach ($earning as $k => $v) {
                EmployeePayslipDetail::create([
                    'company_id' => $request->company_id,
                    'employee_payslip_master_id' => $v['master_id'],
                    'payslip_type' => 'earning',
                    'type' => $v['type'],
                    'value' => (float) $v['amount'],
                    'employee_payslip_id' => $form->id,
                ]);
            }

            foreach ($deduction as $k => $v) {
                EmployeePayslipDetail::create([
                    'company_id' => $request->company_id,
                    'employee_payslip_master_id' => $v['master_id'],
                    'payslip_type' => 'deduction',
                    'type' => $v['type'],
                    'value' => (float) $v['amount'],
                    'employee_payslip_id' => $form->id,
                ]);
            }

            DB::commit();

            $redirect = $request->redirect ?? route('employee-payslips.index');
            return [
                'success' => true,
                'message' => __('Data Saved Successfully'),
                'redirect' => $redirect,
            ];


        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function store(Request $request)
    {
        return $this->_save($request);
    }


    public function update($id, Request $request)
    {
        return $this->_save($request);
    }

    public function show($id, Request $request)
    {
        return view('employee_payslips.show');
    }


    public function destroy($id, Request $request)
    {
        try {
            DB::beginTransaction();

            EmployeePayslipDetail::where('employee_payslip_id', $id)->delete();
            EmployeePayslip::where('id', $id)->delete();

            DB::commit();

            return [
                'success' => true,
                'meessage' => 'Deleted',
            ];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return [
                'success' => false,
                'meessage' => $e->getMessage(),
            ];
        }
    }
    public function getMasters(Request $request)
    {
        $company_id = $request->company_id;
        $type = $request->type; // earning or deduction

        if (!$company_id) {
            return response()->json([]);
        }

        $query = EmployeePayslipMaster::where('company_id', $company_id);

        if ($type === 'earning') {
            $query->masterTypeEarning();
        } elseif ($type === 'deduction') {
            $query->masterTypeDeduction();
        }

        $masters = $query->orderBy('name')->get(['id', 'name']);

        return response()->json($masters);
    }
}
