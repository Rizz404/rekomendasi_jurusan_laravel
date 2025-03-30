<?php

namespace Database\Seeders;

use App\Models\CollegeMajor;
use App\Models\Criteria;
use App\Models\MajorCharacteristic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorCharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = CollegeMajor::all();
        $criteria = Criteria::all();

        foreach ($majors as $major)
        {
            MajorCharacteristic::factory(5)->create([
                'college_major_id' => $major->id,
                'criteria_id' => $criteria->random()->id
            ]);
        }
    }
}
