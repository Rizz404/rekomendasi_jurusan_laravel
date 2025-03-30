<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

// Todo: Nanti lanjutin lagi buat factorynya

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CollegeMajor>
 */
class CollegeMajorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'major_name' => $this->faker->jobTitle(),
            'faculty' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'field_of_study' => $this->faker->word(),
            'career_prospects' => $this->faker->paragraph(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
