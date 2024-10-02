<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'id'    => 'dummy-' . uniqid(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'company_id'    => Company::where('id','like','dummy%')->inRandomOrder()->first()->id,
        ];
    }
}
