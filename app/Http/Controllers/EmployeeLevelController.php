<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLevel;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeeLevelController extends Controller
{
    use CrudTrait;

    public $model = EmployeeLevel::class;
    public $route = 'employee-levels'; 
    public $page_title = 'Employee Level';


    public function select2(Request $request)
    {
        $query = $request->get('query'); // Search query
        $page = $request->get('page', 1); // Pagination page

        // Define the number of results per page
        $limit = 10;

        // Fetch items from the database based on the search query
        \Illuminate\Support\Facades\Log::info('EmployeeLevelController select2 company_id: ' . $request->company_id);
        
        $items = EmployeeLevel::where('name', 'like', '%' . $query . '%')
            ->where('company_id', $request->company_id)
            ->skip(($page - 1) * $limit)
            ->take($limit)
            ->get();

        \Illuminate\Support\Facades\Log::info('EmployeeLevelController items found: ' . $items->count());
        \Illuminate\Support\Facades\Log::info('EmployeeLevelController items: ' . $items->toJson());

        // Get the total count for pagination
        $totalItems = EmployeeLevel::where('name', 'like', '%' . $query . '%')
            ->where('company_id', $request->company_id)
            ->count();


        return response()->json([
            'items' => $items,
            'total_count' => $totalItems, // Added for JS compatibility
            'more' => ($totalItems > $page * $limit) // Check if there are more results to load
        ]);
    }


}
