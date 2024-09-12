<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDepartment extends Model
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
        'description',
        'head_departmen_id',
    ];

    public $rules = [
        'company_id'  => 'required',
        'name'  => 'required',
        'description'  => 'required',
        'head_departmen_id'  => 'required',
    ];
}
