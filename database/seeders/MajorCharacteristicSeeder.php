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
        $majorCharacteristics = [
            // Teknik Informatika
            ['major' => 'Teknik Informatika', 'criteria' => 'Nilai UN Matematika', 'weight' => 0.8, 'min_score' => 80],
            ['major' => 'Teknik Informatika', 'criteria' => 'Nilai UN Bahasa Inggris', 'weight' => 0.6, 'min_score' => 75],
            ['major' => 'Teknik Informatika', 'criteria' => 'Minat Teknik', 'weight' => 0.9, 'min_score' => 85],

            // Sistem Informasi
            ['major' => 'Sistem Informasi', 'criteria' => 'Nilai UN Matematika', 'weight' => 0.7, 'min_score' => 75],
            ['major' => 'Sistem Informasi', 'criteria' => 'Nilai UN Bahasa Inggris', 'weight' => 0.7, 'min_score' => 75],
            ['major' => 'Sistem Informasi', 'criteria' => 'Minat Teknik', 'weight' => 0.8, 'min_score' => 80],

            // Manajemen
            ['major' => 'Manajemen', 'criteria' => 'Nilai UN Matematika', 'weight' => 0.6, 'min_score' => 70],
            ['major' => 'Manajemen', 'criteria' => 'Nilai UN Bahasa Inggris', 'weight' => 0.7, 'min_score' => 75],
            ['major' => 'Manajemen', 'criteria' => 'Minat Sosial', 'weight' => 0.8, 'min_score' => 80],

            // Akuntansi
            ['major' => 'Akuntansi', 'criteria' => 'Nilai UN Matematika', 'weight' => 0.8, 'min_score' => 80],
            ['major' => 'Akuntansi', 'criteria' => 'Nilai UN Bahasa Indonesia', 'weight' => 0.6, 'min_score' => 75],
            ['major' => 'Akuntansi', 'criteria' => 'Minat Sosial', 'weight' => 0.7, 'min_score' => 75],

            // Kedokteran
            ['major' => 'Kedokteran', 'criteria' => 'Nilai UN Matematika', 'weight' => 0.8, 'min_score' => 85],
            ['major' => 'Kedokteran', 'criteria' => 'Nilai UN IPA', 'weight' => 0.9, 'min_score' => 85],
            ['major' => 'Kedokteran', 'criteria' => 'Minat Sains', 'weight' => 0.9, 'min_score' => 90],

            // Ilmu Hukum
            ['major' => 'Ilmu Hukum', 'criteria' => 'Nilai UN Bahasa Indonesia', 'weight' => 0.8, 'min_score' => 80],
            ['major' => 'Ilmu Hukum', 'criteria' => 'Nilai UN Bahasa Inggris', 'weight' => 0.7, 'min_score' => 75],
            ['major' => 'Ilmu Hukum', 'criteria' => 'Minat Sosial', 'weight' => 0.9, 'min_score' => 85],

            // Psikologi
            ['major' => 'Psikologi', 'criteria' => 'Nilai UN Bahasa Indonesia', 'weight' => 0.7, 'min_score' => 75],
            ['major' => 'Psikologi', 'criteria' => 'Nilai UN IPS', 'weight' => 0.7, 'min_score' => 75],
            ['major' => 'Psikologi', 'criteria' => 'Minat Sosial', 'weight' => 0.9, 'min_score' => 85],

            // Teknik Sipil
            ['major' => 'Teknik Sipil', 'criteria' => 'Nilai UN Matematika', 'weight' => 0.9, 'min_score' => 85],
            ['major' => 'Teknik Sipil', 'criteria' => 'Nilai UN IPA', 'weight' => 0.7, 'min_score' => 75],
            ['major' => 'Teknik Sipil', 'criteria' => 'Minat Teknik', 'weight' => 0.8, 'min_score' => 80],

            // Sastra Inggris
            ['major' => 'Sastra Inggris', 'criteria' => 'Nilai UN Bahasa Inggris', 'weight' => 0.9, 'min_score' => 85],
            ['major' => 'Sastra Inggris', 'criteria' => 'Nilai UN Bahasa Indonesia', 'weight' => 0.7, 'min_score' => 75],
            ['major' => 'Sastra Inggris', 'criteria' => 'Minat Bahasa', 'weight' => 0.9, 'min_score' => 85],

            // Ilmu Komunikasi
            ['major' => 'Ilmu Komunikasi', 'criteria' => 'Nilai UN Bahasa Indonesia', 'weight' => 0.8, 'min_score' => 80],
            ['major' => 'Ilmu Komunikasi', 'criteria' => 'Nilai UN Bahasa Inggris', 'weight' => 0.8, 'min_score' => 80],
            ['major' => 'Ilmu Komunikasi', 'criteria' => 'Minat Sosial', 'weight' => 0.8, 'min_score' => 80],
        ];

        foreach ($majorCharacteristics as $char)
        {
            $major = CollegeMajor::where('major_name', $char['major'])->first();
            $criteria = Criteria::where('name', $char['criteria'])->first();

            if ($major && $criteria)
            {
                MajorCharacteristic::create([
                    'college_major_id' => $major->id,
                    'criteria_id' => $criteria->id,
                    'compatibility_weight' => $char['weight'],
                    'minimum_score' => $char['min_score'],
                ]);
            }
        }
    }
}
