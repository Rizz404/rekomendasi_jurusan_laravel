<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\Student;
use App\Models\StudentScore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $criterias = Criteria::all();

        foreach ($students as $student)
        {
            foreach ($criterias as $criteria)
            {
                // Skip if criteria doesn't match student's school type
                $schoolMapping = [
                    'high_school' => 'SMA',
                    'vocational_school' => 'SMK'
                ];

                $studentSchoolType = $schoolMapping[$student->school_type] ?? 'All';

                if ($criteria->school_type !== 'All' && $criteria->school_type !== $studentSchoolType)
                {
                    continue;
                }

                // Generate a realistic score based on criteria name
                $score = match (true)
                {
                    str_contains($criteria->name, 'UN') => fake()->numberBetween(70, 100),
                    str_contains($criteria->name, 'Minat') => fake()->numberBetween(50, 100),
                    default => fake()->numberBetween(60, 100),
                };

                StudentScore::create([
                    'student_id' => $student->id,
                    'criteria_id' => $criteria->id,
                    'score' => $score,
                    'input_date' => now(),
                ]);
            }
        }
    }
}
