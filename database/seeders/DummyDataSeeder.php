<?php

namespace Database\Seeders;

use App\Models\EmployeeDepartment;
use App\Models\EmployeePosition;
use App\Models\EmployeeShift;
use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            //
            $companies = \App\Models\Company::factory(2)->create();


            // init date
            foreach ($companies as $company) {

                $data = EmployeeShift::dummy_data($company->id);

                foreach ($data as $item) {
                    EmployeeShift::create($item);
                }

                $data = EmployeeDepartment::dummy_data($company->id);
                foreach ($data as $item) {
                    EmployeeDepartment::create($item);
                }

                $data = EmployeePosition::dummy_data($company->id);
                foreach ($data as $item) {
                    EmployeePosition::create($item);
                }


                $company->employees()->saveMany(
                    \App\Models\Employee::factory(10)->create([
                        'company_id' => $company->id,
                        'employee_position_id' => EmployeePosition::where('company_id', $company->id)->inRandomOrder()->first()->id,
                        'employee_shift_id' => EmployeeShift::where('company_id', $company->id)->inRandomOrder()->first()->id,
                    ])
                );
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        } finally {
        }
    }
}
