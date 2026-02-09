<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployeePosition extends Model
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
        'department_id',
        'name',
        'description',
        'prefix',
    ];

    public $rules = [
        'company_id'  => 'required',
        'department_id'  => 'required',
        'name'  => 'required',
        'description'  => 'required',
    ];


    public function department()
    {
        return $this->belongsTo(EmployeeDepartment::class,'department_id','id');
    }


    public static function dummy_data_validation_message($company_id = null)
    {

        $company_id = $company_id ?? auth()->user()->company_id ?? null;

        $check = EmployeeDepartment::where('company_id', $company_id)->count();
        if($check <= 0) {

            return __('department_not_exist');
        }

        return null;
    }


    // custom query index
    public static function tableQuery()
    {
        $search = request()->search;

        $filter = request()->filter;

        $company_id = $filter['company_id'] ?? null;

        $positions = DB::table('employee_positions as ep')
            ->select(
                'ep.id',
                'ep.name',
                'ep.company_id',
                'c.name as company_name',
                'ep.department_id',
                'ed.name as department_name',
                'ed.description'
            )
            ->leftJoin('employee_departments as ed', 'ed.id', '=', 'ep.department_id')
            ->leftJoin('companies as c', 'c.id', '=', 'ep.company_id')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('ep.name', 'like', "%{$search}%")
                    ->orWhere('ed.name', 'like', "%{$search}%")
                    ->orWhere('c.name', 'like', "%{$search}%")
                    ->orWhere('ed.description', 'like', "%{$search}%");
                });
            })
            ->when($company_id, function ($query, $company_id) {
                $query->where('ep.company_id', $company_id);
            })
            ->paginate(10);

            return $positions;
    }

   // data array to show button dummy data
    public static function dummy_data($company_id = null) : array
    {
        // auto dummy employee department
        // $departments = EmployeeDepartment::dummy_data($company_id);
        // foreach($departments as $key => $value) {
            // EmployeeDepartment::firstOrCreate($value);
        // }


        
        $company_id = $company_id ?? auth()->user()->company_id ?? null;

        $data = [];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'hrd',
            'department_id'    => '',
            'name'  =>  'HR Manager',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'hrd',
            'department_id'    => '',
            'name'  =>  'HR Specialist',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'hrd',
            'department_id'    => '',
            'name'  =>  'Recruiter',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'hrd',
            'department_id'    => '',
            'name'  =>  'Training & Development Officer',
            'description'  =>  '',
        ];



        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'keuangan',
            'department_id'    => '',
            'name'  =>  'Payroll Officer',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'keuangan',
            'department_id'    => '',
            'name'  =>  'CFO (Chief Financial Officer)',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'keuangan',
            'department_id'    => '',
            'name'  =>  'Finance Manager',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'keuangan',
            'department_id'    => '',
            'name'  =>  'Accounting Supervisor',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'keuangan',
            'department_id'    => '',
            'name'  =>  'Financial Analyst',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'keuangan',
            'department_id'    => '',
            'name'  =>  'Tax Officer',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'marketing',
            'department_id'    => '',
            'name'  =>  'CMO (Chief Marketing Officer) ',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'marketing',
            'department_id'    => '',
            'name'  =>  'Marketing Manager',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'marketing',
            'department_id'    => '',
            'name'  =>  'Digital Marketing Specialist',
            'description'  =>  '',
        ];


        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'marketing',
            'department_id'    => '',
            'name'  =>  'Content Creator',
            'description'  =>  '',
        ];


        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'marketing',
            'department_id'    => '',
            'name'  =>  'Market Research Analyst',
            'description'  =>  '',
        ];


        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'sales',
            'department_id'    => '',
            'name'  =>  'Sales Manager',
            'description'  =>  '',
        ];


        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'sales',
            'department_id'    => '',
            'name'  =>  'Sales Executive',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'sales',
            'department_id'    => '',
            'name'  =>  'Sales Representative',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'sales',
            'department_id'    => '',
            'name'  =>  'Key Account Manager',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'produksi',
            'department_id'    => '',
            'name'  =>  'Production Manager',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'produksi',
            'department_id'    => '',
            'name'  =>  'Quality Control Manager',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'produksi',
            'department_id'    => '',
            'name'  =>  'Production Supervisor',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'produksi',
            'department_id'    => '',
            'name'  =>  'Machine Operator',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'produksi',
            'department_id'    => '',
            'name'  =>  'Quality Control Inspector',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'it',
            'department_id'    => '',
            'name'  =>  'CTO (Chief Technology Officer)',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'it',
            'department_id'    => '',
            'name'  =>  'IT Manager',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'it',
            'department_id'    => '',
            'name'  =>  'Software Engineer',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'it',
            'department_id'    => '',
            'name'  =>  'System Administrator',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'it',
            'department_id'    => '',
            'name'  =>  'IT Support Specialist',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'operasional',
            'department_id'    => '',
            'name'  =>  'COO (Chief Operating Officer)',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'operasional',
            'department_id'    => '',
            'name'  =>  'Operations Manager',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'operasional',
            'department_id'    => '',
            'name'  =>  'Logistic Coordinator',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'operasional',
            'department_id'    => '',
            'name'  =>  'Supply Chain Analyst',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'procurement',
            'department_id'    => '',
            'name'  =>  'Procurement Manager',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'procurement',
            'department_id'    => '',
            'name'  =>  'Procurement Officer',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'procurement',
            'department_id'    => '',
            'name'  =>  'Purchasing Assistant',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'legal',
            'department_id'    => '',
            'name'  =>  'Legal Counsel',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'legal',
            'department_id'    => '',
            'name'  =>  'Legal Assistant',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'cs',
            'department_id'    => '',
            'name'  =>  'Customer Service Manager',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'cs',
            'department_id'    => '',
            'name'  =>  'Customer Service Representative',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'cs',
            'department_id'    => '',
            'name'  =>  'Helpdesk Support',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'pr',
            'department_id'    => '',
            'name'  =>  'Manajer Public Relations',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'pr',
            'department_id'    => '',
            'name'  =>  'Supervisor Public Relations',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'pr',
            'department_id'    => '',
            'name'  =>  'Spesialis Public Relations',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'pr',
            'department_id'    => '',
            'name'  =>  'Koordinator Komunikasi',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'pr',
            'department_id'    => '',
            'name'  =>  'Juru Bicara Perusahaan',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'pr',
            'department_id'    => '',
            'name'  =>  'Analis Media dan Komunikasi',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => 'pr',
            'department_id'    => '',
            'name'  =>  'Spesialis Hubungan Media',
            'description'  =>  '',
        ];

        foreach($data as $key => $value) {
            $prefix = $value['prefix'] != null && strlen($value['prefix']) > 0 ? $value['prefix'] : 'other1';
            $value['prefix'] = $prefix;
            $department = EmployeeDepartment::where('company_id', $company_id)->where('prefix', $prefix)->first();
            $value['department_id'] = $department ? $department->id : null;
            $data[$key] = $value;
        }


        return $data;
    }
}
