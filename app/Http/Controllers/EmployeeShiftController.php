<?php

namespace App\Http\Controllers;

use App\Models\EmployeeShift;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeeShiftController extends Controller
{
    use CrudTrait;

    public $model = EmployeeShift::class;
    public $route = 'employee-shifts'; 
    public $page_title = 'Employee Shift';

    public function select2(Request $request)
    {
        $company_id = $request->get('company_id');
        \Illuminate\Support\Facades\Log::info('EmployeeShiftController select2 company_id: ' . $company_id);
        $query = $request->get('query'); // Search query
        $page = $request->get('page', 1); // Pagination page

        // Define the number of results per page
        $limit = 10;

        // Fetch items from the database based on the search query
        $items = EmployeeShift::where('name', 'like', '%' . $query . '%')
                    ->where('company_id', $company_id)
                      ->skip(($page - 1) * $limit)
                      ->take($limit)
                      ->get();

        // Get the total count for pagination
        $totalItems = EmployeeShift::where('name', 'like', '%' . $query . '%')
        ->where('company_id', $company_id)
        ->count();

        return response()->json([
            'items' => $items,
            'more' => ($totalItems > $page * $limit) // Check if there are more results to load
        ]);
    }
}
