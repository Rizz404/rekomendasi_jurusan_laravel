<?php

namespace Database\Factories;

use App\Models\CollegeMajor;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SawResult>
 */
class SawResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'college_major_id' => CollegeMajor::factory(),
            'final_score' => $this->faker->randomFloat(4, 0.5, 1),
            'rank' => $this->faker->numberBetween(1, 10),
            'recommendation_reason' => $this->faker->paragraph(),
            'calculation_date' => now(),
        ];
    }
}
