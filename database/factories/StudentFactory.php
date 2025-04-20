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
            'NIS' => $this->faker->unique()->numerify('######'),
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['man', 'woman']),
            'school_origin' => $this->faker->randomElement([
                'SMAN 1 Jakarta',
                'SMAN 8 Jakarta',
                'SMAN 3 Bandung',
                'SMAN 5 Surabaya',
                'SMAN 2 Yogyakarta',
                'SMA Labschool Jakarta',
                'SMKN 1 Jakarta',
                'SMKN 4 Bandung',
                'SMK Telkom Malang',
                'SMK Negeri 2 Surabaya'
            ]),
            'school_type' => $this->faker->randomElement(['high_school', 'vocational_school']),
            'school_major' => function (array $attributes)
            {
                if ($attributes['school_type'] === 'high_school')
                {
                    return $this->faker->randomElement(['IPA', 'IPS', 'Bahasa']);
                }
                else
                {
                    return $this->faker->randomElement([
                        'Teknik Komputer dan Jaringan',
                        'Rekayasa Perangkat Lunak',
                        'Akuntansi',
                        'Administrasi Perkantoran',
                        'Multimedia',
                        'Teknik Elektronika',
                        'Tata Boga'
                    ]);
                }
            },
            'graduation_year' => $this->faker->numberBetween(2020, 2023),
        ];
    }
}
