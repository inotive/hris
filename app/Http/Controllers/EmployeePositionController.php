<?php

namespace App\Http\Controllers;

use App\Models\EmployeePosition;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeePositionController extends Controller
{
    use CrudTrait;

    public $model = EmployeePosition::class;
    public $route = 'employee-positions'; 
    public $page_title = 'Employee Position';


    public function select2(Request $request)
    {

        $query = $request->get('query'); // Search query
        $page = $request->get('page', 1); // Pagination page

        // Define the number of results per page
        $limit = 10;

        // Fetch items from the database based on the search query
        $items = EmployeePosition::where('name', 'like', '%' . $query . '%')
                    ->where('department_id', $request->department_id)
                      ->skip(($page - 1) * $limit)
                      ->take($limit)
                      ->get();

        // Get the total count for pagination
        $totalItems = EmployeePosition::where('name', 'like', '%' . $query . '%')
        ->where('department_id', $request->department_id)
            ->count();


        return response()->json([
            'items' => $items,
            'more' => ($totalItems > $page * $limit) // Check if there are more results to load
        ]);
    }

}
