<?php

namespace App\Models;

use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeShiftDayOff extends Model
{
    use HasFactory;

    use HasUuids;

    use SearchTrait;
    use HasCompany;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'shift_id',
        'date',
        'description',
    ];

    public $rules = [
        'company_id'  => 'required',
        'shift_id'  => 'required',
        'date'  => 'required',
        'description'  => '',

    ];
}
