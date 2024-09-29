<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementRequest extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;
    use CreatedByUserTrait;
    use HasCompany;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'employee_id',
        'date',
        'reimbursement_type_id',
        'total',
        'manager_id',
        'status',
    ];

    public $rules = [
        'company_id'  => 'required',
        'employee_id'  => 'required',
        'date'  => '',
        'reimbursement_type_id'  => '',
        'total'  => '',
        'status'  => '',
    ];

    public function type()
    {
        return $this->belongsTo(ReimbursementType::class, 'reimbursement_type_id','id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id','id');
    }

    public function expenses()
    {
        return $this->hasMany(ReimbursementExpenseList::class, 'reimbursement_request_id', 'id');
    }
}
