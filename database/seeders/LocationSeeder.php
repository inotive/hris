<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Seed master location data for Indonesia - Kalimantan
     */
    public function run()
    {
        // 1. Create Country
        $country = Country::firstOrCreate(['name' => 'Indonesia']);

        // Data Kalimantan
        $provinces = [
            'Kalimantan Barat' => [
                'Pontianak', 'Singkawang', 'Kubu Raya', 'Mempawah', 'Sambas', 'Sanggau', 'Ketapang'
            ],
            'Kalimantan Tengah' => [
                'Palangka Raya', 'Kotawaringin Barat', 'Kotawaringin Timur', 'Kapuas', 'Barito Selatan', 'Pulang Pisau', 'Seruyan'
            ],
            'Kalimantan Selatan' => [
                'Banjarmasin', 'Banjarbaru', 'Banjar', 'Tanah Laut', 'Barito Kuala', 'Tapin', 'Hulu Sungai Selatan'
            ],
            'Kalimantan Timur' => [
                'Samarinda', 'Balikpapan', 'Bontang', 'Kutai Kartanegara', 'Kutai Barat', 'Kutai Timur', 'Penajam Paser Utara'
            ],
            'Kalimantan Utara' => [
                'Tarakan', 'Bulungan', 'Malinau', 'Nunukan', 'Tana Tidung', 'Berau'
            ]
        ];

        foreach ($provinces as $provName => $cities) {
            // 2. Create Province
            $province = Province::firstOrCreate([
                'country_id' => $country->id,
                'name' => $provName
            ]);

            // 3. Create Cities
            foreach ($cities as $cityName) {
                City::firstOrCreate([
                    'province_id' => $province->id,
                    'name' => $cityName
                ]);
            }
        }
    }
}
