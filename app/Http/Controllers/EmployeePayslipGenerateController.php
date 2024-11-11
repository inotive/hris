<?php

namespace App\Http\Controllers;

use App\Jobs\GeneratePayslipFromTemplateJob;
use App\Models\Employee;
use App\Models\EmployeePayslip;
use App\Models\EmployeePayslipGenerate;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeePayslipGenerateController extends Controller
{
    public function index(Request $request)
    {
        $list = EmployeePayslipGenerate::paginate();

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

        Log::info($request->all());


        $company_id = $request->company_id;
        $month = $request->month;
        $year = $request->year;

        $employees_ids = $request->employee_ids;

        $id = EmployeePayslipGenerate::create([
            'company_id'    => $company_id,
            'month' => $month,
            'year'  => $year,
            'data_generate_total'   => count($employees_ids),
            'data_generate_status'  => 'pending',
            'generated_at'  => now(),
        ])->id;

        foreach ($employees_ids as $employees_id) {
            GeneratePayslipFromTemplateJob::dispatch($id, $employees_id);
        }

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
             'redirect'  => route('employee-payslip-generate.index'),
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
