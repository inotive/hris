<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementType extends Model
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
        'name'  => '',
    ];

    public static function dummy_data() : array
    {
        $company_id = auth()->user()->company_id;

        $categories = [
            'Transportasi',
            'Akomodasi',
            'Makan',
            'Bahan Bakar',
            'Peralatan Kantor',
            'Kesehatan',
            'Telekomunikasi',
            'Perbaikan Kendaraan',
            'Pendidikan/Training',
            'Hiburan/Konsumsi Karyawan',
            'Biaya Kantor',
            'Lain-lain',
        ];

        $data = collect($categories)->map(function($row) use ($company_id){
            return [
                'company_id'    => $company_id,
                'name'  => $row,
            ];
        })->all();
        
        return $data;
    }
}
