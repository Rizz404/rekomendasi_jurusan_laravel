<?php

namespace Database\Seeders;

use App\Models\CollegeMajor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollegeMajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CollegeMajor::factory(10)->create();
    }
}
