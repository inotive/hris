<?php

namespace App\Models;

use App\Jobs\NewPasswordJob;
use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Employee extends Model
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
        'first_name',
        'last_name',
        'employee_shift_id',
        'employee_id',
        'email',
        'password',
        'phone',
        'department_id',
        'employee_position_id',
        'employee_level_id',
        'join_date',
        'sallary',
        'image',
        'reimbursement_limit',
        'birth_date',
        'address',
        'country',
        'province',
        'city',
        'district',
        'sub_district',
        'zip_code',
        'birth_place',
        'religion',
        'status',
        'marital_status',
        'birth_place',
        'gender',
        'nationality',
        'document_id',
        'document_expiry',
        'tax_registered_name',
        'tax_number',
        'username',
        'bank_account_name',
        'bank_account_number',
    ];

    public function rules() {
        return [
            'company_id'  => 'required',
            'first_name'  => 'required',
            'last_name'  => 'required',
            'employee_shift_id'  => 'required',
            'email'  => [
                'required',
                'email',
                Rule::unique('employees')->ignore($this->id),
            ],
            'phone'  => 'required',
            'department_id'  => 'required',
            'employee_position_id'  => 'required',
            'employee_level_id'  => 'required',
            'join_date'  => 'required',
            'sallary'  => '',
            'image'  => '',
            'reimbursement_limit'  => '',
            'birth_date'  => '',
            'birth_place'  => '',
            'address' => '',
            'country' => '',
            'province' => '',
            'city' => '',
            'district' => '',
            'sub_district' => '',
            'zip_code' => '',
            'birth_place' => '',
            'religion' => 'required',
            'status' => '',
            'marital_status' => '',
            'birth_place' => '',
            'gender' => 'required',
            'nationality' => '',
            'document_id' => 'required',
            'document_expiry' => '',
            'tax_registered_name' => 'required',
            'tax_number' => 'required',
            'username' => 'required',
            'bank_account_name' => 'required',
            'bank_account_number' => 'required',
        ];

    }


    public static function boot()
    {
        parent::boot();

        static::creating(function($row){
          if ($row->password == null)  {
            $new_pass = rand(100000,999999) . uniqid();
            session()->flash('user',[
                'new_pass'  => $new_pass,
            ]);
            $row->password = bcrypt($new_pass);

          }
        });

        // static::created(function($row){
        //     if (session('user.new_pass') != null) {
        //         $new_pass = session('user.new_pass');
        //         NewPasswordJob::dispatch($row->email, $new_pass);
        //     }
           

        // });

    
    }


    public function getFullNameAttribute()
    {
        return collect([$this->first_name, $this->last_name])->join(' ');
    }


    public function head_department()
    {
        return $this->belongsTo(Employee::class,'head_departmen_id','id');
    }


    public function department()
    {
        return $this->belongsTo(EmployeeDepartment::class,'department_id','id');
    }


    public function position()
    {
        return $this->belongsTo(EmployeePosition::class,'employee_position_id','id');
    }

    public function level()
    {
        return $this->belongsTo(EmployeeLevel::class,'employee_level_id','id');
    }


    public function scopeName($query, $search)
    {
        return $query->where(function($query) use ($search){
            $query->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name','like', '%' . $search . '%');
        });
    }


    public static function dummy_data() : array 
    {
        return [];
    }
}
