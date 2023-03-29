<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'password'=>fake()->name(),
            'date_of_birth' => fake()->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
            'n_number' => fake()->unique()->numerify('########'),
            'phone_number' => fake()->phoneNumber(),
            'file_no' => fake()->unique()->numerify('####'),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'height' => fake()->numberBetween(150, 200),
            'weight' => fake()->numberBetween(50, 200),
            'blood_type' => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            'disease_name' => fake()->word(),
            'description_disease' => fake()->sentence(),
            'gender' => fake()->randomElement(['male', 'female']),

        ];
    }
}
