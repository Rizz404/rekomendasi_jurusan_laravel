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
        $criteria = Criteria::all();

        foreach ($students as $student)
        {
            $student->scores()->createMany(
                $criteria->random(5)->map(function ($crit)
                {
                    return [
                        'criteria_id' => $crit->id,
                        'score' => fake()->randomFloat(2, 0, 100)
                    ];
                })->toArray()
            );
        }
    }
}
