<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use CrudTrait;

    public $model = Company::class;
    public $route = 'companies';
    public $page_title = 'Management Company';
    public $action_title = 'Company';



    public function select2(Request $request)
    {
        $query = $request->get('query'); // Search query
        $page = $request->get('page', 1); // Pagination page

        // Define the number of results per page
        $limit = 10;

        // Fetch items from the database based on the search query
        $items = Company::where('name', 'like', '%' . $query . '%')
                      ->skip(($page - 1) * $limit)
                      ->take($limit)
                      ->get();

        // Get the total count for pagination
        $totalItems = Company::where('name', 'like', '%' . $query . '%')->count();

        return response()->json([
            'items' => $items,
            'more' => ($totalItems > $page * $limit) // Check if there are more results to load
        ]);
    }
}
