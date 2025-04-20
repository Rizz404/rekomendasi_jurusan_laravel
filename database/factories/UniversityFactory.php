<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'status' => $this->faker->randomElement(['negeri', 'swasta']),
            'city' => $this->faker->city(),
            'province' => $this->faker->state(),
            'description' => $this->faker->paragraph(),
            'website' => $this->faker->url(),
            'logo' => $this->faker->imageUrl(200, 200),
            'rating' => $this->faker->randomFloat(2, 3, 5),
            'is_active' => true,
        ];
    }
}
