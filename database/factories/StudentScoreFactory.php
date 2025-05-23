<?php

namespace Database\Factories;

use App\Models\Criteria;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentScore>
 */
class StudentScoreFactory extends Factory
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
            'criteria_id' => Criteria::factory(),
            'score' => $this->faker->randomFloat(2, 60, 100),
            'input_date' => now(),
        ];
    }
}
