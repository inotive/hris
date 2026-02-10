<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\EmployeeDepartment;
use App\Models\EmployeeLevel;
use App\Models\EmployeePosition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanyAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $this->command->info("Checking company: {$company->name}");

            // Fallback user if company creator is missing
            $userId = $company->created_by_user_id ?? \App\Models\User::first()->id ?? null;

            if (!$userId) {
                $this->command->error("  - No user found to assign as creator (created_by_user_id). Skipping.");
                continue;
            }

            // 1. Ensure Department exist
            $department = EmployeeDepartment::where('company_id', $company->id)->first();
            if (!$department) {
                $department = EmployeeDepartment::create([
                    'id' => Str::uuid(),
                    'company_id' => $company->id,
                    'name' => 'General Department',
                    'description' => 'General Department for ' . $company->name,
                    'prefix' => 'gen-' . substr($company->name, 0, 3) . rand(100,999), 
                    'created_by_user_id' => $userId,
                ]);
                $this->command->info("  - Created Department: General Department");
            } else {
                $this->command->info("  - Department exists.");
            }

            // 2. Ensure Position exists (Linked to Department)
            $position = EmployeePosition::where('company_id', $company->id)->first();
            if (!$position) {
                EmployeePosition::create([
                    'id' => Str::uuid(),
                    'company_id' => $company->id,
                    'department_id' => $department->id,
                    'name' => 'Staff',
                    'description' => 'General Staff Position',
                    'prefix' => 'stf-' . rand(100, 999),
                    'created_by_user_id' => $userId,
                ]);
               $this->command->info("  - Created Position: Staff");
            } else {
                $this->command->info("  - Position exists.");
            }

            // 3. Ensure Level exists
            $level = EmployeeLevel::where('company_id', $company->id)->first();
            if (!$level) {
                EmployeeLevel::create([
                    'id' => Str::uuid(),
                    'company_id' => $company->id,
                    'name' => 'Junior',
                    'created_by_user_id' => $userId,
                ]);
                $this->command->info("  - Created Level: Junior");
            } else {
                $this->command->info("  - Level exists.");
            }
        }
    }
}
