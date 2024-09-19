<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
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
    use HasCompany;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'name',
        'description',
        'head_departmen_id',
        'prefix',
    ];

    public $rules = [
        'company_id'  => 'required',
        'name'  => 'required',
        'description'  => 'required',
        'head_departmen_id'  => '',
    ];


    public function head_department()
    {
        return $this->belongsTo(Employee::class,'head_departmen_id','id');
    }

       // data array to show button dummy data
    public static function dummy_data() : array
    {
        $company_id = auth()->user()->company_id ?? null;

        $data = [];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Sumber Daya Manusia (HRD)',
            'description'   => '',
            'prefix'    => 'hrd',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Keuangan',
            'description'   => '',
            'prefix'    => 'keuangan',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Pemasaran (Marketing)',
            'description'   => '',
            'prefix'    => 'marketing',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Penjualan (Sales)',
            'description'   => '',
            'prefix'    => 'sales',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Produksi',
            'description'   => '',
            'prefix'    => 'produksi',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen IT (Teknologi Informasi)',
            'description'   => '',
            'prefix'    => 'it',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Operasional',
            'description'   => '',
            'prefix'    => 'operasional',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Pengadaan (Procurement)',
            'description'   => '',
            'prefix'    => 'procurement',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Hukum (Legal)',
            'description'   => '',
            'prefix'    => 'legal',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Riset dan Pengembangan (R&D)',
            'description'   => '',
            'prefix'    => 'riset-development',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Layanan Pelanggan (Customer Service)',
            'description'   => '',
            'prefix'    => 'cs',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Public Relations (PR)',
            'description'   => '',
            'prefix'    => 'pr',
        ];



        foreach($data as $key => $value) {
            $value['prefix'] = $value['prefix'] ?? 'other' . $key;
            $data[$key] = $value;
        }

  
        return $data;
    }
}
