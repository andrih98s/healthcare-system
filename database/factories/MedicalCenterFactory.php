<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class MedicalCenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'email' => fake()->unique()->safeEmail(),
            'password'=>fake()->name(),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'website' =>fake()->domainName(),
         
        ];
    }
}
