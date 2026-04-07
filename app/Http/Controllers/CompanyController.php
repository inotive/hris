<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Traits\CrudTrait;
use Exception;
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

        $user = auth()->user();
        
        $queryBuilder = Company::where('name', 'like', '%' . $query . '%');
        if ($user && $user->role !== 'superadmin') {
            $queryBuilder->where('id', $user->company_id);
        }

        // Fetch items from the database based on the search query
        $items = $queryBuilder->skip(($page - 1) * $limit)
                      ->take($limit)
                      ->get();

        // Get the total count for pagination
        $totalItems = $queryBuilder->count();

        return response()->json([
            'items' => $items,
            'more' => ($totalItems > $page * $limit) // Check if there are more results to load
        ]);
    }

    public function destroy_validation_message($id)
    {

        $company = Company::find($id);

        if ($company->employees()->count() > 0) {
            return __('Cannot delete company as it has employees');
        }

        return null;
    }
}
