<?php

namespace Database\Seeders;

use App\Models\BankList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bankNamesIndonesia = [
            "Bank Mandiri",
            "BCA (Bank Central Asia)",
            "BNI (Bank Negara Indonesia)",
            "BRI (Bank Rakyat Indonesia)",
            "CIMB Niaga",
            "Bank Danamon",
            "Bank Permata",
            "Maybank Indonesia",
            "OCBC NISP",
            "Bank Syariah Indonesia",
            "HSBC Indonesia",
            "Citibank Indonesia",
            "Standard Chartered Bank Indonesia",
            "Bank Mega",
            "Bank CIMB Niaga",
            "Bank Sinarmas",
            "Bank Rakyat Indonesia Agroniaga",
            "Bank Victoria International",
            "Bank Panin",
            "Bank of China Indonesia",
            "Bank Jabar Banten",
            "Bank Kalsel",
            "Bank Sulselbar",
            "Bank NTB Syariah",
            "Bank Maluku Malut",
            "Bank BRI Agroniaga",
            "Bank Mandiri Taspen",
            "Bank Bukopin",
            "Bank DKI",
            "Bank Sulteng",
            "Bank Sahabat Sampoerna",
            "Bank BPR",
            "Bank Jateng",
            "Bank Papua",
            "Bank Sinar Mas",
            "Bank QNB Indonesia",
            "Bank Muamalat Indonesia",
            "Bank Artha Graha",
            "Bank NISP",
            "Bank Sumsel Babel",
            "Bank CIMB Niaga Syariah",
            "Bank Negara Indonesia Syariah",
            "Bank Syariah Mega",
            "Bank BTPN",
            "Bank VTB",
            "Bank Negara Indonesia (Persero) Tbk",
            "Bank Rakyat Indonesia (Persero) Tbk",
            "Bank Mandiri (Persero) Tbk",
            "Bank Woori Saudara",
            "Bank Kesejahteraan Ekonomi",
            "Bank Muamalat",
            "Bank Agroniaga",
            "Bank Ekonomi Raharja",
            "Bank Mandiri Syariah",
            "Bank Jasa Jakarta",
            "Bank Resona Perdania",
            "Bank Tri Sukma",
            "Bank Sinarmas Syariah",
            "Bank Artha Graha Internasional",
            "Bank OCBC NISP Syariah",
            "Bank Victoria Syariah",
            "Bank Syariah Bukopin",
            "Bank BRI Agro",
            "Bank Kaltimtara",
            "Bank NTT",
            "Bank Maluku",
            "Bank Pembangunan Daerah (BPD)",
            "Bank Syariah Indonesia (BSI)",
            "Bank Permata Syariah",
            "Bank Jatim",
            "Bank BPD Bali",
            "Bank Lampung",
            "Bank Sumut",
            "Bank Sulteng",
            "Bank Aceh",
            "Bank BPD Kaltim",
            "Bank BPD Kalbar",
            "Bank DIY",
            "Bank DKI Jakarta"
        ];

        foreach($bankNamesIndonesia as $bank) {
            BankList::create([
                'name'  => $bank,
                'image' => asset('assets/images/no_image.jpg')
            ]);
        }
    }
}
