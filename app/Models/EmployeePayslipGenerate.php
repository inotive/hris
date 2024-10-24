<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasMyCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayslipGenerate extends Model
{
    use HasFactory;

    use HasUuids;

    use SearchTrait;
    use CreatedByUserTrait;
    use HasMyCompany;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'month',
        'year',
        'data_generate_total',
        'data_generate_status',
        'approved_at',
        'generated_at',
    ];

    public $rules = [
        'company_id'=>'',
        'month'=>'',
        'year'=>'',
        'data_generate_total'=>'',
        'data_generate_status'=>'',
        'approved_at'=>'',
        'generated_at'=>'',
    ];
}
