<?php

namespace Database\Factories;

use App\Models\CollegeMajor;
use App\Models\Criteria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MajorCharacteristic>
 */
class MajorCharacteristicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'college_major_id' => CollegeMajor::factory(),
            'criteria_id' => Criteria::factory(),
            'compatibility_weight' => $this->faker->randomFloat(2, 0, 1),
            'minimum_score' => $this->faker->optional()->randomFloat(2, 0, 100),
        ];
    }
}
