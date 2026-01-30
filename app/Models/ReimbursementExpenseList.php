<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementExpenseList extends Model
{
    use HasFactory;
    use HasUuids;


    protected $fillable = [
        'employee_id',
        'reimbursement_request_id',
        'reimbursement_expense_id',
        'name',
        'value',
    ];
}
