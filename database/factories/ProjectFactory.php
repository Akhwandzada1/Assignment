<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'detail' => fake()->text(),
            'client' => fake()->name(),
            'total_cost' => fake()->randomNumber($nbDigits = NULL, $strict = false),
            'deadline' => fake()->dateTime($max = 'now', $timezone = null)
        ];
    }
}
