<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
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
        'n_number' => fake()->unique()->numerify('########'),
        'job_description' => fake()->jobTitle(),
        'job_id' => fake()->randomNumber(4),
        'date_of_birth' => fake()->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
        'years_of_experience' => fake()->numberBetween(1, 30),
        'phone_number' =>fake()->phoneNumber(''),
        'email' =>fake()->unique()->safeEmail(),
        'address' => fake()->address(),
        'gender' => fake()->randomElement(['male', 'female']),
        'nationality' => fake()->country(),
        'admin_id' =>Admin::inRandomOrder()->first()->id,
        ];
    }
}
