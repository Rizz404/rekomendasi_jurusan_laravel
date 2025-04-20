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
            'major_name' => $this->faker->randomElement([
                'Teknik Informatika',
                'Teknik Elektro',
                'Manajemen',
                'Akuntansi',
                'Kedokteran',
                'Hukum',
                'Psikologi',
                'Biologi',
                'Teknik Sipil',
                'Farmasi',
                'Sastra Inggris',
                'Ilmu Komunikasi',
                'Arsitektur',
                'Pendidikan Dokter'
            ]),
            'faculty' => $this->faker->randomElement([
                'Fakultas Teknik',
                'Fakultas Ekonomi dan Bisnis',
                'Fakultas Kedokteran',
                'Fakultas Hukum',
                'Fakultas Psikologi',
                'Fakultas MIPA',
                'Fakultas Ilmu Budaya',
                'Fakultas Ilmu Sosial dan Politik'
            ]),
            'description' => $this->faker->paragraph(),
            'field_of_study' => $this->faker->randomElement([
                'Teknik',
                'Sains',
                'Sosial',
                'Kesehatan',
                'Ekonomi',
                'Pendidikan',
                'Seni'
            ]),
            'career_prospects' => $this->faker->paragraph(),
            'is_active' => true,
        ];
    }
}
