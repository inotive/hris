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

        $company_id = $request->filter['company_id'] ?? null;
        $month = $request->filter['month'] ?? null;
        $year = $request->filter['year'] ?? null;
        $daterange = $request->filter['daterange'] ?? null;

        
        if ($daterange) {
            // 01/06/2025 - 30/06/2025

            $daterange = explode(' - ', $daterange);
            $start = \Carbon\Carbon::createFromFormat('d/m/Y', $daterange[0])->format('Y-m-d');
            $end = \Carbon\Carbon::createFromFormat('d/m/Y', $daterange[1])->format('Y-m-d');
            $daterange = $start . ' - ' . $end;
        }


        $search = $request->search;

        $list = EmployeePayslipGenerate::orderBy('created_at','desc')
        ->when($company_id, function($query) use($company_id){
            $query->where('company_id', $company_id);
        })
        ->when($month, function($query) use($month){
            $query->where('month', $month);
        })
        ->when($year, function($query) use($year){
            $query->where('year', $year);
        })
        ->when($search, function($query) use($search){
            $query->whereHas('company', function($query) use($search){
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->orWhereHas('created_by', function($query) use($search){
                $query->whereRaw("concat(first_name, ' ', last_name) like '%".$search."%'");
            });
        })
        ->when($daterange, function($query) use($daterange){
            $query->whereBetween('generated_at', [
                \Carbon\Carbon::parse(explode(' - ', $daterange)[0])->format('Y-m-d 00:00:00'),
                \Carbon\Carbon::parse(explode(' - ', $daterange)[1])->format('Y-m-d 23:59:59')
            ]);
        })
        ->paginate();

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

       


        $company_id = $request->company_id;
        $month = $request->month;
        $year = $request->year;

        $employees_ids = $request->employee_ids ?? [];


        if ($company_id == null) {
            return [
                'success'   => false,
                'message'   => __('Company is required'),
            ];
        }


        if ($month == null) {
            return [
                'success'   => false,
                'message'   => __('Month is required'),
            ];
        }


        if ($year == null) {
            return [
                'success'   => false,
                'message'   => __('Year is required'),
            ];
        }


        if (count($employees_ids) == 0) {
            return [
                'success'   => false,
                'message'   => __('Employee is required'),
            ];
        }   

        $result = array_filter($employees_ids, function($value) {
            return $value !== '0';
        });

        $employees_ids = array_values($result);

        // Log::info($employees_ids);

        // Check if employees have payslip template
        if (!$request->has('force')) {
            $employees_without_template = [];
            foreach ($employees_ids as $employees_id) {
                $template_count = \App\Models\EmployeePayslipTemplate::where('employee_id', $employees_id)->count();
                if ($template_count == 0) {
                    $employee = Employee::find($employees_id);
                    if ($employee) {
                        $employees_without_template[] = $employee->full_name;
                    }
                }
            }

            if (count($employees_without_template) > 0) {
                $employee_list_html = '<ul style="text-align: left; margin-top: 10px;">';
                foreach ($employees_without_template as $name) {
                    $employee_list_html .= '<li>' . $name . '</li>';
                }
                $employee_list_html .= '</ul>';

                return response()->json([
                    'success' => false,
                    'title'   => __('Warning'), 
                    'message' => __('The following employees do not have payslip settings (Template):') . $employee_list_html,
                    'icon'    => 'warning',
                    'confirmation' => true, 
                ], 422); 
            }
        }

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
