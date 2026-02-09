<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\EmployeePosition;
use App\Models\EmployeeShift;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Exception;

class FilterTestSeeder extends Seeder
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

            $companies = Company::all();

            foreach ($companies as $company) {
                $this->command->info('Seeding for company: ' . $company->name);

                // Ensure Department exists
                if (EmployeeDepartment::where('company_id', $company->id)->count() == 0) {
                    $data = EmployeeDepartment::dummy_data($company->id);
                    foreach ($data as $item) {
                        EmployeeDepartment::create($item);
                    }
                }

                // Ensure Position exists
                if (EmployeePosition::where('company_id', $company->id)->count() == 0) {
                     $data = EmployeePosition::dummy_data($company->id);
                    foreach ($data as $item) {
                        EmployeePosition::create($item);
                    }
                }

                // Ensure Shift exists
                if (EmployeeShift::where('company_id', $company->id)->count() == 0) {
                     $data = EmployeeShift::dummy_data($company->id);
                    foreach ($data as $item) {
                        EmployeeShift::create($item);
                    }
                }

                // Create 5 Employees
                $position = EmployeePosition::where('company_id', $company->id)->inRandomOrder()->first();
                $shift = EmployeeShift::where('company_id', $company->id)->inRandomOrder()->first();
                $department = EmployeeDepartment::where('company_id', $company->id)->inRandomOrder()->first();

                if (!$position) throw new Exception("Position not found for company " . $company->name);
                if (!$shift) throw new Exception("Shift not found for company " . $company->name);
                if (!$department) throw new Exception("Department not found for company " . $company->name);

                Employee::factory(5)->create([
                    'company_id' => $company->id,
                    'employee_position_id' => $position->id,
                    'employee_shift_id' => $shift->id,
                    'department_id' => $department->id,
                ]);
            }

            DB::commit();
            $this->command->info('FilterTestSeeder completed successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            $this->command->error('Error: ' . $e->getMessage());
        }
    }
}
