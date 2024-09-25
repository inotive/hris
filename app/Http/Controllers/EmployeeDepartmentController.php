<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDepartment;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeDepartmentController extends Controller
{
    use CrudTrait;

    public $model = EmployeeDepartment::class;
    public $route = 'employee-departments'; 
    public $page_title = 'Employee Department';


    public function select2(Request $request)
    {
        $query = $request->get('query'); // Search query
        $page = $request->get('page', 1); // Pagination page

        // Define the number of results per page
        $limit = 10;

        // Fetch items from the database based on the search query
        $items = EmployeeDepartment::where('name', 'like', '%' . $query . '%')
                    ->where('company_id', $request->company_id)
                      ->skip(($page - 1) * $limit)
                      ->take($limit)
                      ->get();

        // Get the total count for pagination
        $totalItems = EmployeeDepartment::where('name', 'like', '%' . $query . '%')
        ->where('company_id', $request->company_id)
            ->count();


        return response()->json([
            'items' => $items,
            'more' => ($totalItems > $page * $limit) // Check if there are more results to load
        ]);
    }


}
