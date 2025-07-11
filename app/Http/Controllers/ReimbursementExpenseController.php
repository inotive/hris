<?php

namespace App\Http\Controllers;

use App\Models\EmployeePayslipMaster;
use App\Models\ReimbursementExpense;
use App\Models\ReimbursementType;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class ReimbursementExpenseController extends Controller
{
    use CrudTrait;

    public $model = ReimbursementExpense::class;
    public $route = 'reimbursement-expenses'; 
    public $page_title = 'Reimbursement Expense';


    
    public function select2(Request $request)
    {

        $company_id = $request->company_id;
        $query = $request->get('query'); // Search query
        $page = $request->get('page', 1); // Pagination page

        // Define the number of results per page
        $limit = $request->get('limit', 10);

        // Fetch items from the database based on the search query
        $items = ReimbursementExpense::where('name', 'like', '%' . $query . '%')
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
        $totalItems = ReimbursementExpense::where('name', 'like', '%' . $query . '%')
            ->where('company_id', $company_id)
            ->orderBy('name','asc')
            ->count();



        return response()->json([
            'items' => $items,
            'more' => ($totalItems > $page * $limit) // Check if there are more results to load
        ]);
    }

}
