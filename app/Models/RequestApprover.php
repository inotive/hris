<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestApprover extends Model
{
    use HasFactory;

    use HasUuids;

    use SearchTrait;
    
    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'request_id',
        'approver_employee_id',
        'approver_level',
        'approver_status',
        'approved_at',
        'active',
        'reason',
    ];

    public $rules = [
        'request_id' => '',
        'approver_employee_id' => '',
        'approver_level' => '',
        'approver_status' => '',
        'approved_at' => '',
        'active' => '',
        'reason' => '',
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'approver_employee_id','id');
    }
}
