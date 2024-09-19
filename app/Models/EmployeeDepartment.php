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


    public static function dummy_data() : array
    {
        $company_id = auth()->user()->company_id ?? null;

        $data = [];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Sumber Daya Manusia (HRD)',
            'description'   => '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Keuangan',
            'description'   => '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Pemasaran (Marketing)',
            'description'   => '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Penjualan (Sales)',
            'description'   => '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Produksi',
            'description'   => '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen IT (Teknologi Informasi)',
            'description'   => '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Operasional',
            'description'   => '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Pengadaan (Procurement)',
            'description'   => '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Hukum (Legal)',
            'description'   => '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Riset dan Pengembangan (R&D)',
            'description'   => '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Layanan Pelanggan (Customer Service)',
            'description'   => '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Kesehatan dan Keselamatan Kerja (K3)',
            'description'   => '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  =>  'Departemen Public Relations (PR)',
            'description'   => '',
        ];

  
        return $data;
    }
}
