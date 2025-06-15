<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use App\Models\Post;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    use CrudTrait;

    public $model = LeaveType::class;
    public $route = 'leave-types';
    public $page_title = 'Leave Types';
    public $action_title = 'Type';


    public function select2(Request $request)
    {

        $company_id = $request->company_id;
        $query = $request->get('query'); // Search query
        $page = $request->get('page', 1); // Pagination page

        // Define the number of results per page
        $limit = $request->get('limit', 10);

        // Fetch items from the database based on the search query
        $items = LeaveType::where('name', 'like', '%' . $query . '%')
            ->where('company_id', $company_id)
            ->skip(($page - 1) * $limit)
            ->take($limit)
            ->orderBy('name','asc')
           
            ->get()
            ->map(function($row){
                $name = $row->name;
                return [
                    'id'    => $row->id,
                    'name'  => $name,
                ];
            });

        // Get the total count for pagination
        $totalItems = LeaveType::where('name', 'like', '%' . $query . '%')
            ->where('company_id', $company_id)
            ->orderBy('name','asc')
            ->count();



        return response()->json([
            'items' => $items,
            'more' => ($totalItems > $page * $limit) // Check if there are more results to load
        ]);
    }

}
