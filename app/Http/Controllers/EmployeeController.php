<?php

namespace App\Http\Controllers;

use App\Jobs\NewPasswordJob;
use App\Models\Employee;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    use CrudTrait;

    public $model = Employee::class;
    public $route = 'employees'; 
    public $page_title = 'Employee';


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
        $query = $request->get('query'); // Search query
        $page = $request->get('page', 1); // Pagination page

        // Define the number of results per page
        $limit = 10;

        // Fetch items from the database based on the search query
        $items = Employee::select(DB::raw("CONCAT(first_name, ' ', last_name, ' (', username, ')') as name"), 'id')
            ->name($query)
            ->where('company_id', $company_id)
            ->skip(($page - 1) * $limit)
            ->take($limit)
            ->get();

        // Get the total count for pagination
        $totalItems = Employee::name($query)
            ->where('company_id', $company_id)
            ->count();


        return response()->json([
            'items' => $items,
            'more' => ($totalItems > $page * $limit) // Check if there are more results to load
        ]);
    }
}
