<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReimbursementType;
use App\Models\ReimbursementExpense;
use App\Models\ReimbursementRequest;
use App\Models\ReimbursementExpenseList;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class ReimbursementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Get Company and User Context
        $company = Company::first();
        if (!$company) {
            $this->command->error('No company found. Please run Key seeders first.');
            return;
        }

        $user = \App\Models\User::first();
        
        // 2. Seed Reimbursement Types
        $types = [
            'Medical',
            'Travel',
            'Office Supplies',
            'Entertainment',
            'Other'
        ];

        $reimbursementTypes = [];
        foreach ($types as $typeName) {
            $reimbursementTypes[] = ReimbursementType::firstOrCreate(
                ['company_id' => $company->id, 'name' => $typeName],
                ['created_by_user_id' => $user->id ?? null]
            );
        }
        $this->command->info('Reimbursement Types seeded.');

        // 3. Seed Reimbursement Expenses
        $expenses = [
            'Hotel',
            'Flight Ticket',
            'Train Ticket',
            'Taxi',
            'Meal',
            'Fuel',
            'Internet',
            'Phone Bill',
            'Parking',
            'Toll'
        ];

        $reimbursementExpenses = [];
        foreach ($expenses as $expenseName) {
            $reimbursementExpenses[] = ReimbursementExpense::firstOrCreate(
                ['company_id' => $company->id, 'name' => $expenseName],
                ['created_by_user_id' => $user->id ?? null]
            );
        }
        $this->command->info('Reimbursement Expenses seeded.');

        // 4. Create Dummy Requests (Optional, but good for testing)
        $employee = Employee::first();
        
        if ($employee) {
            // Find a manager (or use same employee if none other exists)
            $manager = Employee::where('id', '!=', $employee->id)->first() ?? $employee;

            // Create a request
            $type = $reimbursementTypes[array_rand($reimbursementTypes)];
            
            DB::beginTransaction();
            try {
                $request = ReimbursementRequest::create([
                    'company_id' => $company->id,
                    'employee_id' => $employee->id,
                    'date' => now(),
                    'reimbursement_type_id' => $type->id,
                    'manager_id' => $manager->id,
                    'status' => 'pending',
                    'total' => 0 // will update
                ]);

                // Create Expense Items
                $total = 0;
                $numItems = rand(1, 3);
                
                for ($i = 0; $i < $numItems; $i++) {
                    $expense = $reimbursementExpenses[array_rand($reimbursementExpenses)];
                    $value = rand(50000, 500000);
                    
                    ReimbursementExpenseList::create([
                        'reimbursement_request_id' => $request->id,
                        'reimbursement_expense_id' => $expense->id,
                        'name' => $expense->name . ' - ' . \Illuminate\Support\Str::random(5),
                        'value' => $value,
                    ]);
                    $total += $value;
                }

                $request->update(['total' => $total]);
                
                DB::commit();
                $this->command->info('Dummy Reimbursement Request created for employee: ' . $employee->first_name);

            } catch (\Exception $e) {
                DB::rollBack();
                $this->command->error('Failed to create dummy request: ' . $e->getMessage());
            }
        }
    }
}
