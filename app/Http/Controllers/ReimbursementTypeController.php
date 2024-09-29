<?php

namespace App\Http\Controllers;

use App\Models\EmployeePayslipMaster;
use App\Models\ReimbursementType;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class ReimbursementTypeController extends Controller
{
    use CrudTrait;

    public $model = ReimbursementType::class;
    public $route = 'reimbursement-types'; 
    public $page_title = 'Reimbursement Type';

}
