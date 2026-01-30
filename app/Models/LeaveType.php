<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
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
        'days_limit',

    ];

    public $rules = [
        'company_id'  => 'required',
        'name'  => 'required',
        'days_limit'    => 'required',
    ];


    public static function dummy_data(): array
    {
        $company_id = auth()->user()->company_id;

        return [
            ['company_id'   => $company_id, 'name' => 'Anggota keluarga dalam 1 rumah meninggal dunia','slug'=>null],
            ['company_id'   => $company_id, 'name' => 'Annual Leave (Cuti tahunan)','slug'=>null],
            ['company_id'   => $company_id, 'name' => 'Ibadah Haji','slug'=>null],
            ['company_id'   => $company_id, 'name' => 'Istri sah karyawan melahirkan/ keguguran','slug'=>null],
            ['company_id'   => $company_id, 'name' => 'Karyawan Menikah','slug'=>null],
            ['company_id'   => $company_id, 'name' => 'Khitan/ Baptis','slug'=>null],
            ['company_id'   => $company_id, 'name' => 'Pernikahan Anak Kandung','slug'=>null],
            ['company_id'   => $company_id, 'name' => 'Sakit Keterangan Dokter (kopi resep & kuitansi)','slug'=>null],
            ['company_id'   => $company_id, 'name' => 'Unpaid Leave (Cuti tidak dibayar)','slug'=>'unpaid_leave'],
        ];
    }
}
