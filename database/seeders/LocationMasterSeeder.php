<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;

class LocationMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Indonesia
        $indonesia = Country::firstOrCreate(['name' => 'Indonesia'], ['code' => 'ID']);

        // Data Provinces & Cities (Comprehensive)
        $data = [
            // --- SUMATERA ---
            'Aceh' => [
                'Banda Aceh', 'Sabang', 'Lhokseumawe', 'Langsa', 'Subulussalam', 'Aceh Selatan', 'Aceh Tenggara', 'Aceh Timur', 'Aceh Tengah', 'Aceh Barat', 'Aceh Besar', 'Pidie', 'Aceh Utara', 'Simeulue', 'Aceh Singkil', 'Bireuen', 'Aceh Barat Daya', 'Gayo Lues', 'Aceh Jaya', 'Nagan Raya', 'Aceh Tamiang', 'Bener Meriah', 'Pidie Jaya'
            ],
            'Sumatera Utara' => [
                'Medan', 'Pematang Siantar', 'Sibolga', 'Tanjung Balai', 'Binjai', 'Tebing Tinggi', 'Padang Sidempuan', 'Gunungsitoli', 'Deli Serdang', 'Langkat', 'Karo', 'Simalungun', 'Asahan', 'Labuhanbatu', 'Tapanuli Utara', 'Tapanuli Tengah', 'Tapanuli Selatan', 'Nias', 'Mandailing Natal', 'Toba Samosir', 'Nias Selatan', 'Pakpak Bharat', 'Humbang Hasundutan', 'Samosir', 'Serdang Bedagai', 'Batu Bara', 'Padang Lawas Utara', 'Padang Lawas', 'Labuhanbatu Selatan', 'Labuhanbatu Utara', 'Nias Utara', 'Nias Barat'
            ],
            'Sumatera Barat' => [
                'Padang', 'Solok', 'Sawahlunto', 'Padang Panjang', 'Bukittinggi', 'Payakumbuh', 'Pariaman', 'Pesisir Selatan', 'Solok', 'Sijunjung', 'Tanah Datar', 'Padang Pariaman', 'Agam', 'Lima Puluh Kota', 'Pasaman', 'Kepulauan Mentawai', 'Dharmasraya', 'Solok Selatan', 'Pasaman Barat'
            ],
            'Riau' => [
                'Pekanbaru', 'Dumai', 'Kuantan Singingi', 'Indragiri Hulu', 'Indragiri Hilir', 'Pelalawan', 'Siak', 'Kampar', 'Rokan Hulu', 'Bengkalis', 'Rokan Hilir', 'Kepulauan Meranti'
            ],
            'Jambi' => [
                'Jambi', 'Sungai Penuh', 'Kerinci', 'Merangin', 'Sarolangun', 'Batanghari', 'Muaro Jambi', 'Tanjung Jabung Timur', 'Tanjung Jabung Barat', 'Tebo', 'Bungo'
            ],
            'Sumatera Selatan' => [
                'Palembang', 'Prabumulih', 'Pagar Alam', 'Lubuklinggau', 'Ogan Komering Ulu', 'Ogan Komering Ilir', 'Muara Enim', 'Lahat', 'Musi Rawas', 'Musi Banyuasin', 'Banyuasin', 'Ogan Komering Ulu Selatan', 'Ogan Komering Ulu Timur', 'Ogan Ilir', 'Empat Lawang', 'Penukal Abab Lematang Ilir', 'Musi Rawas Utara'
            ],
            'Bengkulu' => [
                'Bengkulu', 'Bengkulu Selatan', 'Rejang Lebong', 'Bengkulu Utara', 'Kaur', 'Seluma', 'Mukomuko', 'Lebong', 'Kepahiang', 'Bengkulu Tengah'
            ],
            'Lampung' => [
                'Bandar Lampung', 'Metro', 'Lampung Barat', 'Tanggamus', 'Lampung Selatan', 'Lampung Timur', 'Lampung Tengah', 'Lampung Utara', 'Way Kanan', 'Tulang Bawang', 'Pesawaran', 'Pringsewu', 'Mesuji', 'Tulang Bawang Barat', 'Pesisir Barat'
            ],
            'Kepulauan Bangka Belitung' => [
                'Pangkal Pinang', 'Bangka', 'Belitung', 'Bangka Barat', 'Bangka Tengah', 'Bangka Selatan', 'Belitung Timur'
            ],
            'Kepulauan Riau' => [
                'Tanjung Pinang', 'Batam', 'Bintan', 'Karimun', 'Natuna', 'Lingga', 'Kepulauan Anambas'
            ],

            // --- JAWA ---
            'DKI Jakarta' => [
                'Jakarta Pusat', 'Jakarta Utara', 'Jakarta Barat', 'Jakarta Selatan', 'Jakarta Timur', 'Kepulauan Seribu'
            ],
            'Jawa Barat' => [
                'Bandung', 'Bogor', 'Sukabumi', 'Tasikmalaya', 'Cimahi', 'Depok', 'Bekasi', 'Banjar', 'Cirebon', 'Cianjur', 'Garut', 'Ciamis', 'Kuningan', 'Majalengka', 'Sumedang', 'Indramayu', 'Subang', 'Purwakarta', 'Karawang', 'Bandung Barat', 'Pangandaran'
            ],
            'Jawa Tengah' => [
                'Semarang', 'Surakarta', 'Salatiga', 'Magelang', 'Pekalongan', 'Tegal', 'Cilacap', 'Banyumas', 'Purbalingga', 'Banjarnegara', 'Kebumen', 'Purworejo', 'Wonosobo', 'Boyolali', 'Klaten', 'Sukoharjo', 'Wonogiri', 'Karanganyar', 'Sragen', 'Grobogan', 'Blora', 'Rembang', 'Pati', 'Kudus', 'Jepara', 'Demak', 'Temanggung', 'Kendal', 'Batang', 'Pemalang', 'Brebes'
            ],
            'DI Yogyakarta' => [
                'Yogyakarta', 'Bantul', 'Sleman', 'Gunung Kidul', 'Kulon Progo'
            ],
            'Jawa Timur' => [
                'Surabaya', 'Malang', 'Madiun', 'Kediri', 'Mojokerto', 'Probolinggo', 'Pasuruan', 'Blitar', 'Batu', 'Pacitan', 'Ponorogo', 'Trenggalek', 'Tulungagung', 'Lumajang', 'Jember', 'Banyuwangi', 'Bondowoso', 'Situbondo', 'Sidoarjo', 'Jombang', 'Nganjuk', 'Magetan', 'Ngawi', 'Bojonegoro', 'Tuban', 'Lamongan', 'Gresik', 'Bangkalan', 'Sampang', 'Pamekasan', 'Sumenep'
            ],
            'Banten' => [
                'Serang', 'Cilegon', 'Tangerang', 'Tangerang Selatan', 'Pandeglang', 'Lebak'
            ],

            // --- NUSA TENGGARA & BALI ---
            'Bali' => [
                'Denpasar', 'Badung', 'Bangli', 'Buleleng', 'Gianyar', 'Jembrana', 'Karangasem', 'Klungkung', 'Tabanan'
            ],
            'Nusa Tenggara Barat' => [
                'Mataram', 'Bima', 'Lombok Barat', 'Lombok Tengah', 'Lombok Timur', 'Sumbawa', 'Dompu', 'Sumbawa Barat', 'Lombok Utara'
            ],
            'Nusa Tenggara Timur' => [
                'Kupang', 'Timor Tengah Selatan', 'Timor Tengah Utara', 'Belu', 'Alor', 'Flores Timur', 'Sikka', 'Ende', 'Ngada', 'Manggarai', 'Sumba Timur', 'Sumba Barat', 'Lembata', 'Rote Ndao', 'Manggarai Barat', 'Nagekeo', 'Sumba Tengah', 'Sumba Barat Daya', 'Manggarai Timur', 'Sabu Raijua', 'Malaka'
            ],

            // --- KALIMANTAN (Already had some, expanding/keeping) ---
            'Kalimantan Barat' => [
                'Pontianak', 'Singkawang', 'Kubu Raya', 'Mempawah', 'Sambas', 'Sanggau', 'Ketapang', 'Sintang', 'Kapuas Hulu', 'Bengkayang', 'Landak', 'Sekadau', 'Melawi', 'Kayong Utara'
            ],
            'Kalimantan Tengah' => [
                'Palangka Raya', 'Kotawaringin Barat', 'Kotawaringin Timur', 'Kapuas', 'Barito Selatan', 'Barito Utara', 'Sukamara', 'Lamandau', 'Seruyan', 'Katingan', 'Pulang Pisau', 'Gunung Mas', 'Barito Timur', 'Murung Raya'
            ],
            'Kalimantan Selatan' => [
                'Banjarmasin', 'Banjarbaru', 'Banjar', 'Tanah Laut', 'Barito Kuala', 'Tapin', 'Hulu Sungai Selatan', 'Hulu Sungai Tengah', 'Hulu Sungai Utara', 'Tabalong', 'Tanah Bumbu', 'Balangan'
            ],
            'Kalimantan Timur' => [
                'Samarinda', 'Balikpapan', 'Bontang', 'Kutai Kartanegara', 'Kutai Barat', 'Kutai Timur', 'Penajam Paser Utara', 'Mahakam Ulu', 'Paser', 'Berau'
            ],
            'Kalimantan Utara' => [
                'Tarakan', 'Bulungan', 'Malinau', 'Nunukan', 'Tana Tidung'
            ],

            // --- SULAWESI ---
            'Sulawesi Utara' => [
                'Manado', 'Bitung', 'Tomohon', 'Kotamobagu', 'Minahasa', 'Bolaang Mongondow', 'Kepulauan Sangihe', 'Kepulauan Talaud', 'Minahasa Selatan', 'Minahasa Utara', 'Bolaang Mongondow Utara', 'Siau Tagulandang Biaro', 'Minahasa Tenggara', 'Bolaang Mongondow Selatan', 'Bolaang Mongondow Timur'
            ],
            'Sulawesi Tengah' => [
                'Palu', 'Banggai', 'Poso', 'Donggala', 'Toli-Toli', 'Buol', 'Morowali', 'Banggai Kepulauan', 'Parigi Moutong', 'Tojo Una-Una', 'Sigi', 'Banggai Laut', 'Morowali Utara'
            ],
            'Sulawesi Selatan' => [
                'Makassar', 'Parepare', 'Palopo', 'Bone', 'Gowa', 'Maros', 'Pangkajene dan Kepulauan', 'Barru', 'Soppeng', 'Wajo', 'Sidenreng Rappang', 'Pinrang', 'Enrekang', 'Luwu', 'Tana Toraja', 'Luwu Utara', 'Luwu Timur', 'Toraja Utara', 'Selayar', 'Bulukumba', 'Bantaeng', 'Jeneponto', 'Takalar', 'Sinjai'
            ],
            'Sulawesi Tenggara' => [
                'Kendari', 'Bau-Bau', 'Buton', 'Muna', 'Konawe', 'Kolaka', 'Konawe Selatan', 'Bombana', 'Wakatobi', 'Kolaka Utara', 'Buton Utara', 'Konawe Utara', 'Kolaka Timur', 'Konawe Kepulauan', 'Muna Barat', 'Buton Tengah', 'Buton Selatan'
            ],
            'Gorontalo' => [
                'Gorontalo', 'Boalemo', 'Bone Bolango', 'Pohuwato', 'Gorontalo Utara'
            ],
            'Sulawesi Barat' => [
                'Mamuju', 'Majene', 'Polewali Mandar', 'Mamasa', 'Mamuju Utara', 'Mamuju Tengah'
            ],

            // --- MALUKU & PAPUA ---
            'Maluku' => [
                'Ambon', 'Tual', 'Maluku Tengah', 'Maluku Tenggara', 'Maluku Tenggara Barat', 'Buru', 'Seram Bagian Timur', 'Seram Bagian Barat', 'Kepulauan Aru', 'Maluku Barat Daya', 'Buru Selatan'
            ],
            'Maluku Utara' => [
                'Ternate', 'Tidore Kepulauan', 'Halmahera Barat', 'Halmahera Tengah', 'Kepulauan Sula', 'Halmahera Selatan', 'Halmahera Utara', 'Halmahera Timur', 'Pulau Morotai', 'Pulau Taliabu'
            ],
            'Papua' => [
                'Jayapura', 'Biak Numfor', 'Kepulauan Yapen', 'Merauke', 'Jayawijaya', 'Nabire', 'Mimika', 'Paniai', 'Puncak Jaya', 'Boven Digoel', 'Mappi', 'Asmat', 'Yahukimo', 'Pegunungan Bintang', 'Tolikara', 'Sarmi', 'Keerom', 'Waropen', 'Supiori', 'Mamberamo Raya', 'Nduga', 'Lanny Jaya', 'Mamberamo Tengah', 'Yalimo', 'Puncak', 'Dogiyai', 'Intan Jaya', 'Deiyai'
            ],
            'Papua Barat' => [
                'Sorong', 'Manokwari', 'Fakfak', 'Sorong Selatan', 'Raja Ampat', 'Teluk Bintuni', 'Teluk Wondama', 'Kaimana', 'Tambrauw', 'Maybrat', 'Manokwari Selatan', 'Pegunungan Arfak'
            ]
        ];

        foreach ($data as $provName => $cities) {
            $province = Province::firstOrCreate(
                ['country_id' => $indonesia->id, 'name' => $provName]
            );

            foreach ($cities as $cityName) {
                City::firstOrCreate(
                    ['province_id' => $province->id, 'name' => $cityName]
                );
            }
        }
    }
}
