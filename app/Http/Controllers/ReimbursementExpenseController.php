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

}
