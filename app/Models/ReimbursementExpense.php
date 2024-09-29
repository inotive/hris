<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementExpense extends Model
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
    ];

    public $rules = [
        'company_id'  => 'required',
        'name'  => 'required',
    ];

    public static function dummy_data() : array
    {
        $company_id = auth()->user()->company_id;

        $data = []; 
        $data[] = [
            'company_id'    => $company_id,
            'name'  => 'Transportasi'
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  => 'Makan'
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  => 'Akomodasi'
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  => 'Biaya Kesehatan'
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  => 'Peralatan Kerja'
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  => 'Pelatihan dan Seminar'
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  => 'Biaya Hiburan'
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  => 'Biaya Komunikasi'
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  => 'Perjalanan Dinas'
        ];
        $data[] = [
            'company_id'    => $company_id,
            'name'  => 'Lain-lain'
        ];

        return $data;
    }
}
