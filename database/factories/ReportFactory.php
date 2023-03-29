<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'test' => fake()->word(),
            'date' => $this->faker->date('Y-m-d'),
            'admin_id' =>Admin::inRandomOrder()->first()->id,
            'patient_id' =>Patient::inRandomOrder()->first()->id,
            'doctor_id' =>Doctor::inRandomOrder()->first()->id,
            
            
           

        ];
    }
}
