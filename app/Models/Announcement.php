<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
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
        'employee_id',
        'manager_id',
        'title',
        'content',
        'reference',
        'type',
        'module',
        'module_id',
    ];

    public $rules = [
        'company_id'  => 'required',
        'for_employee_id'  => 'required',
        'title'  => 'required',
        'content'  => 'required',
        'reference'  => '',
        'created_by_employee_id'  => '',
    ];


    public static function dummy_data() : array
    {
        return [];
    }
}
