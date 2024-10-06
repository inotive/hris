<?php

namespace Database\Seeders;

use App\Models\EmployeeDepartment;
use App\Models\EmployeePosition;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $companies = \App\Models\Company::factory(2)->create();

       
    }
}
