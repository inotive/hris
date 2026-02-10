<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Jobs\NewPasswordJob;
use App\Models\Company;
use App\Models\Employee;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    use CrudTrait;

    public $model = Employee::class;
    public $route = 'employees';
    public $page_title = 'Employee';
    
    public function import(Request $request) {
        return view('employees.import_modal');
    }

    public function downloadTemplate()
    {
        $filename = 'employee_import_template.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\EmployeeTemplateExport, $filename);
    }

    public function importCheck(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            DB::beginTransaction();
            
            $file = $request->file('file');
            $import = new \App\Imports\EmployeeImport(auth()->user()->company_id);
            
            \Maatwebsite\Excel\Facades\Excel::import($import, $file);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Employees imported successfully'
            ]);

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            DB::rollBack();
            $failures = $e->failures();
            $messages = [];
            foreach ($failures as $failure) {
                $messages[] = 'Row ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return response()->json([
                'success' => false,
                'message' => 'Validation Failed',
                'errors'  => $messages
            ], 422);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            $errors = [];
            foreach ($e->errors() as $field => $messages) {
                // Formatting to match the expected frontend format
                $errors[] = $field . ': ' . implode(', ', $messages);
            }
            return response()->json([
                'success' => false,
                'message' => 'Validation Failed',
                'errors'  => $errors
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Import Failed: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function resetPassword($id, Request $request)
    {
        $new_pass = rand(100000,999999) . uniqid();

        $employee = Employee::find($id);
        $employee->password = bcrypt($new_pass);
        $employee->save();

        NewPasswordJob::dispatch($employee->email, $new_pass);

        return [
            'success'   => true,
            'message'   => __('Send Password To Email Successfully'),
        ];
    }


    public function select2(Request $request)
    {

        $company_id = $request->company_id;
        \Illuminate\Support\Facades\Log::info('EmployeeController select2 company_id: ' . $company_id);
        $query = $request->get('query'); // Search query
        $page = $request->get('page', 1); // Pagination page

        // Define the number of results per page
        $limit = $request->get('limit', 10);

        // Fetch items from the database based on the search query
        $items = Employee::with([
            'position',
            'department'
        ])
        // ->select(DB::raw("CONCAT(first_name, ' ', last_name,  IF(username != null,' (' +  username + ')' ,'')) as name"), 'id')
            ->name($query)
            ->where('company_id', $company_id)
            ->skip(($page - 1) * $limit)
            ->take($limit)
            ->orderBy('first_name','asc')
           
            ->get()
            ->map(function($row){
                $name = $row->full_name . ' - ' . ($row->position->name ?? '') . ' - ' . ($row->department->name??'-');
                return [
                    'id'    => $row->id,
                    'name'  => $name,
                ];
            });

        // Get the total count for pagination
        $totalItems = Employee::name($query)
            ->where('company_id', $company_id)
            ->orderBy('first_name','asc')
            ->count();



        return response()->json([
            'items' => $items,
            'more' => ($totalItems > $page * $limit) // Check if there are more results to load
        ]);
    }


    public function getAll(Request $request)
    {

        $company_id = $request->company_id;

        $query = $request->get('query');


        // Fetch items from the database based on the search query
        $items = Employee::with(['position'])->name($query)
            ->where('company_id', $company_id)
            ->orderBy('first_name','asc')
            ->get();


        return response()->json([
            'items' => $items,
        ]);
    }

    public function checkUsername(Request $request)
    {
        try{
            $employee_id = $request->employee_id;
            $username = trim($request->username);


            if (strlen($username) < 3) {
                throw __('Minimum 3 character');
            }

            if (preg_match('/^[a-zA-Z0-9]+$/', $username) == false) {

                throw __('Only alphabet and numeric characters allowed');
            }

            $count = Employee::where('username',$username)
                ->when($employee_id != null, function($query) use ($employee_id){
                    $query->where('id', $employee_id);
                })
                ->count();

            if ($count == 0) {
                $msg = __($username . ' available');
                return [
                    'success' => true,
                    'message'   => $msg,
                ];
            } else {
                $msg = __($username . ' not available');
                return [
                    'success' => false,
                    'message'   => $msg,
                ];
            }


        }catch(Exception $e){
            return [
                'success' => false,
                'message'   => $e->getMessage(),
            ];
        }
    }


    public function export(Request $request)
    {
        $company = null;
        $filename = __('Employees') . '.xlsx';
        if ($request->company_id != null) {
            $company = Company::find($request->company_id);
            $filename = __('Employees') . ' - ' . $company->name . '.xlsx';
        }
        return (new EmployeeExport(company_id: $request->company_id))->download($filename);
    }
}
