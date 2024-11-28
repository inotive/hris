<?php

namespace App\Models;

use App\Jobs\NewPasswordJob;
use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use App\Traits\UploadBase64File;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class Employee extends Authenticatable
{
    use HasFactory;
    use HasUuids;
    use HasApiTokens;

    use SearchTrait;
    use CreatedByUserTrait;
    use HasCompany;

    use UploadBase64File;


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

        'document_bpjstk_file',
        'document_bpjstk_name',
        'document_bpjstk_no',
        'document_bpjs_file',
        'document_bpjs_name',
        'document_bpjs_no',
        'type_ter',
        'code_forget_password',
        'token_forget_password',
    ];



    public function rules()
    {
        return [
            'company_id'  => 'required',
            'first_name'  => 'required',
            'last_name'  => 'required',
            'employee_shift_id'  => 'required',
            'email'  => [
                'required',
                'email',
                // Rule::unique('employees')->ignore($this->id),
            ],
            'username'  => 'required',
            // 'username' => [
            //     'required',
            //     Rule::unique('employees')->ignore($this->id)
            // ],
            'phone'  => 'required',
            'department_id'  => 'required',
            'employee_position_id'  => 'required',
            'employee_level_id'  => 'required',
            'join_date'  => '',
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

            'bank_account_name' => '',
            'bank_account_number' => '',

            'document_bpjstk_file' => '',
            'document_bpjstk_name' => '',
            'document_bpjstk_no' => '',
            'document_bpjs_file' => '',
            'document_bpjs_name' => '',
            'document_bpjs_no' => '',
            'type_ter' => '',
            'code_forget_password' => '',
            'token_forget_password' => '',
        ];
    }



    protected $hidden = [
        'password',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($row) {
            if ($row->password == null) {
                $new_pass = rand(100000, 999999) . uniqid();
                session()->flash('user', [
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
        return $this->belongsTo(Employee::class, 'head_departmen_id', 'id');
    }


    public function department()
    {
        return $this->belongsTo(EmployeeDepartment::class, 'department_id', 'id');
    }


    public function shift()
    {
        return $this->belongsTo(EmployeeShift::class, 'employee_shift_id', 'id');
    }


    public function position()
    {
        return $this->belongsTo(EmployeePosition::class, 'employee_position_id', 'id');
    }

    public function level()
    {
        return $this->belongsTo(EmployeeLevel::class, 'employee_level_id', 'id');
    }


    public function scopeName($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%');
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public static function getByUsername($username)
    {
        $query = "SELECT
                    employees.*,
                    JSON_OBJECT( 'id', employee_departments.id, 'name', employee_departments.NAME, 'description', employee_departments.description ) AS department,
                    JSON_OBJECT( 'id', employee_positions.id, 'name', employee_positions.NAME, 'description', employee_positions.description ) AS position,
                    JSON_OBJECT( 'id', employee_levels.id, 'name', employee_levels.`name` ) AS `level`,
                    JSON_OBJECT( 'id', employee_shifts.id, 'name', employee_shifts.`name`, 'start_time', employee_shifts.start_time, 'end_time', employee_shifts.end_time ) AS `shift`,
                    JSON_OBJECT(
                        'id',
                        companies.id,
                        'name',
                        companies.NAME,
                        'address',
                        companies.address,
                        'phone',
                        companies.phone,
                        'email',
                        companies.email,
                        'logo',
                        companies.logo,
                        'cut_off_payroll_date',
                        companies.cut_off_payroll_date,
                        'is_overtime_request',
                        companies.is_overtime_request,
                        'status',
                        companies.`status`,
                        'country',
                        companies.country,
                        'province',
                        companies.province,
                        'city',
                        companies.city,
                        'district',
                        companies.district,
                        'sub_district',
                        companies.sub_district,
                        'zip_code',
                        companies.zip_code,
                        'time_zone',
                        companies.time_zone 
                    ) AS company,
                    JSON_OBJECT( 'id', headdep.id, 'first_name', headdep.first_name, 'last_name', headdep.last_name) as head 
                    FROM
                    employees
                    LEFT JOIN employee_departments ON employee_departments.id = employees.department_id
                    LEFT JOIN employee_positions ON employee_positions.id = employees.employee_position_id
                    LEFT JOIN employee_levels ON employee_levels.id = employees.employee_level_id
                    LEFT JOIN employee_shifts ON employee_shifts.id = employees.employee_shift_id
                    LEFT JOIN companies ON companies.id = employees.company_id
                    LEFT JOIN employees AS headdep ON headdep.id = employees.head_departmen_id 
                    WHERE
                    employees.username = '$username'";
        $data = DB::select($query);

        $em =  $data[0] ?? null;

        if ($em->department != null) $em->department = json_decode($em->department);
        if ($em->position != null) $em->position = json_decode($em->position);
        if ($em->level != null) $em->level = json_decode($em->level);
        if ($em->shift != null) $em->shift = json_decode($em->shift);
        if ($em->company != null) $em->company = json_decode($em->company);
        if ($em->head != null) $em->head = json_decode($em->head);
        

        return $em;
    }


    public function getToken($device_name = null)
    {
        $this->logout();

        $device_name = $device_name ?? uniqid();
        return $this->createToken($device_name)->plainTextToken;
    }

    public function logout()
    {
        PersonalAccessToken::where("tokenable_type", self::class)
            ->where("tokenable_id", $this->id)
            ->whereNull("expires_at")
            ->update([
                "expires_at" => now(),
            ]);
    }


    public function getHeadDepartmentIdAttribute()
    {
        return $employee->head_department->id ?? $employee->department->head_departmen_id ?? null;
    }

    public function payslip_template()
    {
        return $this->hasMany(EmployeePayslipTemplate::class, 'employee_id', 'id');
    }

    public function getSallaryAttribute()
    {
        return EmployeePayslipTemplate::where('employee_id', $this->id)
            ->whereHas('master', function ($query) {
                return $query->where('slug', 'basic-sallary');
            })->first()->value ?? 0;
    }

    public static function dummy_data(): array
    {
        return [];
    }


    public static function religionDropdown()
    {
        return [
            'Islam'  => 'Islam',
            'Kristen Katolik'  => 'Kristen Katolik',
            'Kristen Protestan'  => 'Kristen Protestan',
            'Hindu'  => 'Hindu',
            'Budha'  => 'Budha',
            'Konghuchu'  => 'Konghuchu',
            'Lainnya'  => 'Lainnya',
        ];
    }

    public static function genderDropdown()
    {
        return [
            'Laki-laki'  => 'Laki-laki',
            'Perempuan'  => 'Perempuan',
        ];
    }

    public static function maritalStatusDropdown()
    {
        return [
            'Lajang'  => 'Lajang',
            'Menikah'  => 'Menikah',
            'Cerai Hidup'  => 'Cerai Hidup',
            'Cerai Mati'  => 'Cerai Mati',
        ];
    }


}
