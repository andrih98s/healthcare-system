<?php

namespace Database\Factories;

use App\Models\Lab;
use App\Models\MedicalCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sample>
 */
class SampleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //patient_file_number patient_nationality
            
            'lab_id' =>Lab::inRandomOrder()->first()->id,
            'medical_center_id' =>MedicalCenter::inRandomOrder()->first()->id,
            'sending_doctor_name' => fake()->word(),
            'patient_name' => fake()->word(),
            'patient_file_number' => fake()->unique()->numerify('########'),
            'patient_nationality' => fake()->country(),
        ];
    }
}
