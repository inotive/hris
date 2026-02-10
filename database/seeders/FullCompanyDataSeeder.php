<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\EmployeeDepartment;
use App\Models\EmployeePosition;
use App\Models\EmployeeLevel;
use App\Models\EmployeeShift;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class FullCompanyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 0. Get User
        $user = \App\Models\User::first();
        if (!$user) {
            $user = \App\Models\User::create([
                'name' => 'Test User',
                'email' => 'testuser@example.com',
                'password' => Hash::make('password'),
            ]);
        }
        
        // 1. Create Company
        $company = Company::create([
            'name' => 'PT Full Feature Test ' . rand(100, 999),
            'email' => 'test' . rand(100, 999) . '@example.com',
            'phone' => '08123456789',
            'address' => 'Test Address',
            'status' => 1,
            'lat' => -6.200000,
            'lng' => 106.816666,
        ]);

        $this->command->info('Company created: ' . $company->name);

        // 2. Create Departments
        $departments = collect(['IT', 'HR', 'Finance']);
        $departmentModels = $departments->map(function ($name) use ($company, $user) {
            return EmployeeDepartment::create([
                'company_id' => $company->id,
                'name' => $name,
                'description' => $name . ' Department',
                'created_by_user_id' => $user->id,
            ]);
        });

        // 3. Create Positions
        $departmentModels->each(function ($dept) use ($company, $user) {
            EmployeePosition::create([
                'company_id' => $company->id,
                'department_id' => $dept->id,
                'name' => 'Staff ' . $dept->name,
                'created_by_user_id' => $user->id,
            ]);
            EmployeePosition::create([
                'company_id' => $company->id,
                'department_id' => $dept->id,
                'name' => 'Manager ' . $dept->name,
                'created_by_user_id' => $user->id,
            ]);
        });

        // 4. Create Levels
        $levels = ['Junior', 'Senior', 'Lead'];
        $levelModels = collect($levels)->map(function ($name) use ($company, $user) {
            return EmployeeLevel::create([
                'company_id' => $company->id,
                'name' => $name,
                'created_by_user_id' => $user->id,
            ]);
        });

        // 5. Create Shifts
        $shift = EmployeeShift::create([
            'company_id' => $company->id,
            'name' => 'Morning Shift ' . $company->id,
            'start_time' => '09:00',
            'end_time' => '18:00',
            'created_by_user_id' => $user->id,
        ]);

        // 6. Create Employee (Potential Head)
        // Need to pick one position/level/dept
        $dept = $departmentModels->first();
        $pos = EmployeePosition::where('department_id', $dept->id)->first();
        $lev = $levelModels->first();

        Employee::create([
            'company_id' => $company->id,
            'first_name' => 'John',
            'last_name' => 'Manager',
            'email' => 'john.manager' . rand(100,999) . '@example.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'username' => 'johnmanager' . rand(100,999),
            'department_id' => $dept->id,
            'employee_position_id' => $pos->id,
            'employee_level_id' => $lev->id,
            'employee_shift_id' => $shift->id,
            'join_date' => now(),
            'religion' => 'Islam', // required
            'gender' => 'Laki-laki', // required
            'status' => 1,
            'nik' => '1234567890' . rand(100,999),
            'tax_number' => '1234567890' . rand(100,999),
            'document_id' => 'DOC123',
            'tax_registered_name' => 'John Manager',
        ]);

        $this->command->info('Seeding completed for company: ' . $company->name);
    }
}
