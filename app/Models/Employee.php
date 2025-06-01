<?php

namespace App\Models;

use App\Http\Resources\CompanyResource;
use App\Http\Resources\EmployeeResource;
use App\Jobs\NewPasswordJob;
use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use App\Traits\UploadBase64File;
use Carbon\Carbon;
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
        'head_departmen_id',
        'document_file',
        'nik',

        'is_attendance_location',
        'is_leave_request',
        'is_overtime_request',
        'is_reimbursement_request',
        'is_attendance',
        'is_payslip',
        'is_ewa',
    ];


    public function rules()
    {
        return [
            'company_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'employee_shift_id' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('employees')->ignore($this->id),
            ],
            'username' => 'required',
            // 'username' => [
            //     'required',
            //     Rule::unique('employees')->ignore($this->id)
            // ],
            'phone' => ['required','min:10'],
            'department_id' => 'required',
            'employee_position_id' => 'required',
            'employee_level_id' => 'required',
            'join_date' => '',
            'image' => '',
            'reimbursement_limit' => '',
            'birth_date' => '',
            'birth_place' => '',
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
            'head_departmen_id' => '',
            'document_file' => '',
            'nik' => ['required','min:10'],

            'is_attendance_location' => '',
            'is_leave_request' => '',
            'is_overtime_request' => '',
            'is_reimbursement_request' => '',
            'is_attendance' => '',
            'is_payslip' => '',
            'is_ewa' => '',
        ];
    }


    protected $hidden = [
        'password',
        'code_forget_password',
        'token_forget_password',
    ];

    protected $casts = [
        'status'    => 'boolean',
        'document_is_unlimited' => 'boolean',
        'is_attendance_location' => 'boolean',
        'is_leave_request' => 'boolean',
        'is_overtime_request' => 'boolean',
        'is_reimbursement_request' => 'boolean',
        'is_attendance' => 'boolean',
        'is_payslip' => 'boolean',
        'is_ewa' => 'boolean',

    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($row) {
            if ($row->password == null) {
                $new_pass = rand(100000, 999999) . uniqid();
                session()->flash('user', [
                    'new_pass' => $new_pass,
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

        $em = $data[0] ?? null;

        if ($em != null) {
            $em->status = $em->status == 1 ? true : false;

            $em->document_is_unlimited = $em->document_is_unlimited == 1 ? true : false;

            $em->is_attendance_location = $em->is_attendance_location == 1 ? true : false;

            $em->is_leave_request = $em->is_leave_request == 1 ? true : false;
            $em->is_overtime_request = $em->is_overtime_request == 1 ? true : false;

            $em->is_reimbursement_request = $em->is_reimbursement_request == 1 ? true : false;

            $em->is_attendance = $em->is_attendance == 1 ? true : false;

            $em->is_payslip = $em->is_payslip == 1 ? true : false;

            $em->is_ewa = $em->is_ewa == 1 ? true : false;


            if ($em->department != null) $em->department = json_decode($em->department);
            if ($em->position != null) $em->position = json_decode($em->position);
            if ($em->level != null) $em->level = json_decode($em->level);
            if ($em->shift != null) {
                $json = json_decode($em->shift, true);
                $em->shift = new EmployeeShift($json);
            }
            if ($em->company != null) {
                $json = json_decode($em->company, true);
                $company = new Company($json);

                $em->company = new CompanyResource($company);
            }
            if ($em->head != null) {
                $json = json_decode($em->head, true);
                $employee = new Employee($json);
                if ($employee != null) {
                    $em->head = new EmployeeResource($employee);
                } else {
                    $em->head = null;
                }
            }
        }


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
            'Islam' => __('Islam'),
            'Kristen Katolik' => __('Kristen Katolik'),
            'Kristen Protestan' => __('Kristen Protestan'),
            'Hindu' => __('Hindu'),
            'Budha' => __('Budha'),
            'Konghuchu' => __('Konghuchu'),
            'Lainnya' => __('Lainnya'),
        ];
    }

    public static function genderDropdown()
    {
        return [
            'Laki-laki' => __('Laki-laki'),
            'Perempuan' => __('Perempuan'),
        ];
    }

    public static function maritalStatusDropdown()
    {
        return [
            'Lajang' => __('Lajang'),
            'Menikah' => __('Menikah'),
            'Cerai Hidup' => __('Cerai Hidup'),
            'Cerai Mati' => __('Cerai Mati'),
        ];
    }


    public function total_work_days($start_date, $end_date)
    {
        $startDate = Carbon::parse($start_date); // Replace with your start date
        $endDate = Carbon::parse($end_date); // Replace with your end date

        $day_off_count = EmployeeShiftDayOff::where('shift_id', $this->employee_shift_id)
            ->where('date', '>=', $startDate->format('Y-m-d'))
            ->where('date', '<=', $endDate->format('Y-m-d'))
            ->count();

        $total_days = $startDate->diffInDays($endDate);

        $work_days = $total_days - $day_off_count;
        return $work_days;
    }

    public function attendances($start_date, $end_date)
    {
        $startDate = Carbon::parse($start_date); // Replace with your start date
        $endDate = Carbon::parse($end_date); // Replace with your end date

        $attendances = Attendance::query()
            ->where('date', '>=', $startDate->format('Y-m-d'))
            ->where('date', '<=', $endDate->format('Y-m-d'))
            ->whereIn('clockin_status', ['EARLY', 'LATE'])
            ->where('employee_id', $this->id)
            ->get();

        return $attendances;
    }


    public function approved_leave_request($start_date, $end_date)
    {
        $startDate = Carbon::parse($start_date); // Replace with your start date
        $endDate = Carbon::parse($end_date); // Replace with your end date

        $leave = LeaveRequest::where('employee_id', $this->id)
            ->where('status', 'approved')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                    ->orWhereBetween('end_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate->format('Y-m-d'))
                            ->where('end_date', '>=', $endDate->format('Y-m-d'));
                    });
            })
            ->get();

        return $leave;
    }


    public function getLeaveRequestCountAttribute()
    {
        return LeaveRequest::where('employee_id', $this->id)->count();
    }

    public function getOvertimeRequestCountAttribute()
    {
        return OvertimeRequest::where('employee_id', $this->id)->count();
    }


    public function getReimbursementRequestCountAttribute()
    {
        return ReimbursementRequest::where('employee_id', $this->id)->count();
    }
}
