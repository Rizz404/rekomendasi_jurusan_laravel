<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Criteria;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Criteria>
 */
class CriteriaFactory extends Factory
{
    // * Kalo follow naming convention gak usah lagi
    // protected $model = Criteria::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'weight' => $this->faker->randomFloat(2, 0.1, 5),
            'type' => $this->faker->randomElement(['benefit', 'cost']),
            'school_type' => $this->faker->randomElement(['SMA', 'SMK', 'All']),
            'is_active' => $this->faker->boolean(),
        ];
    }

    /**
     * Indicate that the criteria is active.
     */
    public function active(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the criteria is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the criteria is for SMA school type.
     */
    public function forSMA(): static
    {
        return $this->state(fn(array $attributes) => [
            'school_type' => 'SMA',
        ]);
    }

    /**
     * Indicate that the criteria is for SMK school type.
     */
    public function forSMK(): static
    {
        return $this->state(fn(array $attributes) => [
            'school_type' => 'SMK',
        ]);
    }

    /**
     * Indicate that the criteria is for all school types.
     */
    public function forAllSchools(): static
    {
        return $this->state(fn(array $attributes) => [
            'school_type' => 'All',
        ]);
    }
}
