<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $religion_dropdown = Employee::religionDropdown();
        $randomKey = array_rand($religion_dropdown);
        $religion = $religion_dropdown[$randomKey];
        
        return [
            'id'    => Uuid::uuid4()->toString(),
            'first_name' => 'DUMMY - ' . fake()->firstName(),
            'last_name' => fake()->lastName(),
            'company_id'    => Company::where('name','like','%DUMMY%')->inRandomOrder()->first()->id,
            'gender'    => ["Laki-laki","Perempuan"][rand(0,1)],
            'religion'  => $religion,
            'status'    => rand(0,1),
        ];
    }
}
