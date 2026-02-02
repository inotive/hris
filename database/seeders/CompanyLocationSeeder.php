<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CompanyLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeder ini membuat 40 data companies dengan lokasi normalized (foreign keys)
     * District/Sub-district dibuat random text
     */
    public function run()
    {
        // Pastikan master data ada
        $this->call(LocationSeeder::class);

        // Fetch master data untuk random pick
        $cities = City::with('province.country')->get();
        if ($cities->isEmpty()) {
            return;
        }

        // Nama perusahaan yang realistis
        $companyNames = [
            'PT Borneo Timber Jaya',
            'PT Kalimantan Coal Mining',
            'PT Mahakam Oil & Gas',
            'PT Pontianak Sejahtera',
            'CV Banjar Makmur',
            'PT Barito Pacific',
            'PT Kutai Timber Indonesia',
            'CV Samarinda Jaya',
            'PT Tarakan Marine Services',
            'PT Palangka Raya Plantation',
            'CV Singkawang Trading',
            'PT Banjarbaru Teknologi',
            'PT Kapuas Sawit Lestari',
            'CV Martapura Gemstone',
            'PT Sangatta Energy',
            'PT Delta Pawan Logistics',
            'CV Tenggarong Furniture',
            'PT Nunukan Fishery',
            'PT Sampit Wood Industry',
            'CV Buntok Agro',
            'PT Pelaihari Construction',
            'PT Tanjung Selor Plantation',
            'CV Marabahan Transport',
            'PT Rantau Palm Oil',
            'PT Kandangan Rubber',
            'PT Kuala Pembuang Port',
            'CV Sendawar Mining',
            'PT Pangkalan Bun Logistics',
            'PT Berau Coal',
            'CV Mempawah Seafood',
            'PT Sambas Agriculture',
            'PT Sanggau Plantation',
            'CV Ketapang Trading',
            'PT Loktabat Industries',
            'PT Menteng Property',
            'CV Pasiran Manufacturing', // 36
            'PT Sungai Raya Logistics',
            'PT Mulia Kerta Plantation',
            'CV Tanjung Mekar Trading',
            'PT Durian Export Indonesia', // 40
        ];

        DB::beginTransaction();
        
        try {
            // Get user
            $user = User::where('role', 'superadmin')->first() ?? User::first();

            echo "Creating 40 companies with normalized location data...\n";

            for ($i = 0; $i < 40; $i++) {
                // Pick random Location from master data
                $randomCity = $cities->random();
                $province = $randomCity->province;
                $country = $province->country;
                
                // Random District & Sub-district generator
                $districts = ['Utara', 'Selatan', 'Barat', 'Timur', 'Tengah', 'Kota', 'Hilir', 'Ulu'];
                $subDistricts = ['Maju', 'Jaya', 'Indah', 'Makmur', 'Sejahtera', 'Baru', 'Lama', 'Besar'];
                
                $districtName = $randomCity->name . ' ' . $districts[array_rand($districts)];
                $subDistrictName = 'Desa ' . $randomCity->name . ' ' . $subDistricts[array_rand($subDistricts)];

                // Pilih timezone berdasarkan provinsi
                // Kalimantan Timur/Utara = WITA (Asia/Makassar)
                $isWita = in_array($province->name, ['Kalimantan Timur', 'Kalimantan Utara']);
                $timezone = $isWita ? 'Asia/Makassar' : 'Asia/Pontianak';

                $name = $companyNames[$i] ?? 'PT Company ' . ($i+1);

                $company = Company::create([
                    'id' => Uuid::uuid4()->toString(),
                    'name' => $name,
                    'email' => strtolower(str_replace([' ', '.', '&'], ['', '', ''], $name)) . '@example.com',
                    'phone' => '0' . rand(811, 899) . rand(1000000, 9999999),
                    'address' => 'Jl. ' . $subDistrictName . ' No. ' . rand(1, 999),
                    
                    // Normalized Location IDs
                    'country_id' => $country->id,
                    'province_id' => $province->id,
                    'city_id' => $randomCity->id,
                    
                    // Text Fields
                    'district' => $districtName,
                    'sub_district' => $subDistrictName,
                    
                    'zip_code' => rand(70000, 79999),
                    'time_zone' => $timezone,
                    'cut_off_payroll_date' => rand(1, 28),
                    'cut_off_payroll_method' => rand(0, 1) ? 'current' : 'backward',
                    'tax_calculation_method' => ['gross', 'gross-up', null][rand(0, 2)],
                    'status' => true,
                    'is_overtime_request' => rand(0, 1),
                    'is_leave_request' => rand(0, 1),
                    'is_reimbursement_request' => rand(0, 1),
                    'is_attendance' => rand(0, 1),
                    'is_ewa' => rand(0, 1),
                    'is_payslip' => true,
                    'created_by_user_id' => $user?->id,
                    'lat' => rand(-400, 400) / 100, 
                    'lng' => rand(10900, 11900) / 100,
                ]);

                echo "✓ Created: {$company->name} - {$randomCity->name}\n";
            }

            DB::commit();
            echo "\n✅ Successfully created 40 companies with normalized location!\n";
            
        } catch (\Exception $e) {
            DB::rollBack();
            echo "\n❌ Error: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
}
