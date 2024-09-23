<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeShiftRequest extends Model
{
    use HasFactory;
    use HasUuids;

    use CreatedByUserTrait;
    use HasCompany;
    use SearchTrait;


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


    public static function dummy_data() : array
    {
        $company_id = auth()->user()->company_id;

        return [
            ['company_id'   => $company_id, 'name' => 'Overtime Hours',],
            ['company_id'   => $company_id, 'name' => 'Extra Leave',],
        ];
    }
}
