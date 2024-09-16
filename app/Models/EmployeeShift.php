<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeShift extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;
    use CreatedByUserTrait;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'name',
        'default',
        'start_time',
        'end_time',
    ];

    public $rules = [
        'company_id'  => 'required',
        'name'  => 'required',
        'default'  => 'required',
        'start_time'  => 'required|date_format:H:i',
        'end_time'  => 'required|date_format:H:i',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
