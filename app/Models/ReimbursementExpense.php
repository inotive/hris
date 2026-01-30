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

        $expenses = [
            'Taksi',
            'Kereta',
            'Bus',
            'Parkir',
            'Hotel',
            'Guesthouse',
            'Makan Siang',
            'Makan Malam',
            'Bensin',
            'Solar',
            'Laptop',
            'Alat Tulis',
            'Konsultasi Dokter',
            'Obat-obatan',
            'Pulsa',
            'Paket Data',
            'Servis Kendaraan',
            'Ganti Oli',
            'Seminar',
            'Kursus/Training',
            'Acara Kantor',
            'Konsumsi Rapat',
            'Alat Tulis Kantor',
            'Perlengkapan Kebersihan',
            'Pengeluaran Lain',
        ];

        $data = collect($expenses)->map(function($row) use ($company_id){
            return [
                'company_id'    => $company_id,
                'name'  => $row,
            ];
        })->all();
        

        return $data;
    }
}
