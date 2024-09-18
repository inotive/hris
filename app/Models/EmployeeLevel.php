<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLevel extends Model
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
    ];

    public $rules = [
        'company_id'  => 'required',
        'name'  => 'required',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }


    public static function dummy_data() : array
    {
        $company_id = auth()->user()->company_id ?? null;

        $data = [];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Junior',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Middle',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Senior',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Manager',
        ];
        return $data;
    }

}
