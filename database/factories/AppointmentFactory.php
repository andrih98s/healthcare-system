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
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_time' => $this->faker->time('H:i:s'),
            'end_time' => $this->faker->time('H:i:s'),
            'date' => $this->faker->date('Y-m-d'),
            'doctor_id' =>Doctor::inRandomOrder()->first()->id,
            'patient_id' =>Patient::inRandomOrder()->first()->id,
            'admins_id' =>Admin::inRandomOrder()->first()->id,
         
        ];
    }
}
