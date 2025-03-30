<?php

namespace Database\Seeders;

use App\Models\CollegeMajor;
use App\Models\SawResult;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SawResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $majors = CollegeMajor::all();

        foreach ($students as $student)
        {
            $rank = 1;
            $majors->random(3)->each(function ($major) use ($student, &$rank)
            {
                \App\Models\SawResult::create([
                    'student_id' => $student->id,
                    'college_major_id' => $major->id,
                    'final_score' => fake()->randomFloat(4, 0, 100),
                    'rank' => $rank++,
                    'recommendation_reason' => fake()->paragraph
                ]);
            });
        }
    }
}
