<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            StudentSeeder::class,
            CriteriaSeeder::class,
            CollegeMajorSeeder::class,
            UniversitySeeder::class,
            CollegeMajorUniversitySeeder::class,
            StudentScoreSeeder::class,
            MajorCharacteristicSeeder::class,
            SAWResultSeeder::class,
        ]);
    }
}
