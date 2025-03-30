<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'NIS' => $this->faker->unique()->numerify('##########'),
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['man', 'woman']),
            'school_origin' => $this->faker->company(),
            'school_type' => $this->faker->randomElement(['high_school', 'vocational_school']),
            'school_major' => $this->faker->jobTitle(),
            'graduation_year' => $this->faker->numberBetween(2018, 2023),
        ];
    }
}
