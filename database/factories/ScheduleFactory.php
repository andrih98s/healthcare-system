<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ScheduleFactory extends Factory
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
            'admin_id' =>Admin::inRandomOrder()->first()->id,
            
            
        ];
    }
}
