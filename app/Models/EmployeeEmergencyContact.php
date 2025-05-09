<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEmergencyContact extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string



    public $fillable = [
        'employee_id',
        'family_relation',
        'name',
        'phone',
        'address',
        'country',
        'province',
        'city',
        'district',
        'sub_district',
        'zip_code',
    ];


    public $rules = [
        'employee_id' => 'required',
        'family_relation' => 'required',
        'name' => 'required',
        'phone' => 'required',
    ];


    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('filter_by_empoyee', function (Builder $builder) {
            if (auth()->user() instanceof Employee) {
                $builder->where('employee_id', auth()->user()->id);
            }
        });
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
