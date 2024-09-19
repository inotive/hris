<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
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
        'department_id',
        'name',
        'description',
    ];

    public $rules = [
        'company_id'  => 'required',
        'department_id'  => 'required',
        'name'  => 'required',
        'description'  => 'required',
    ];


    public function department()
    {
        return $this->belongsTo(EmployeeDepartment::class,'department_id','id');
    }
}
