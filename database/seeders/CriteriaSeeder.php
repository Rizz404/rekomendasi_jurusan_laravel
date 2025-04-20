<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criterias = [
            [
                'name' => 'Nilai UN Matematika',
                'description' => 'Nilai Ujian Nasional Matematika',
                'weight' => 0.20,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Nilai UN Bahasa Indonesia',
                'description' => 'Nilai Ujian Nasional Bahasa Indonesia',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Nilai UN Bahasa Inggris',
                'description' => 'Nilai Ujian Nasional Bahasa Inggris',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Nilai UN IPA',
                'description' => 'Nilai Ujian Nasional IPA',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'SMA',
                'is_active' => true,
            ],
            [
                'name' => 'Nilai UN IPS',
                'description' => 'Nilai Ujian Nasional IPS',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'SMA',
                'is_active' => true,
            ],
            [
                'name' => 'Nilai Kejuruan',
                'description' => 'Nilai Ujian Kompetensi Kejuruan',
                'weight' => 0.25,
                'type' => 'benefit',
                'school_type' => 'SMK',
                'is_active' => true,
            ],
            [
                'name' => 'Minat Sains',
                'description' => 'Tingkat minat terhadap sains',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Minat Sosial',
                'description' => 'Tingkat minat terhadap ilmu sosial',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Minat Bahasa',
                'description' => 'Tingkat minat terhadap bahasa',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Minat Teknik',
                'description' => 'Tingkat minat terhadap teknik',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
        ];

        foreach ($criterias as $criteria)
        {
            Criteria::create($criteria);
        }
    }
}
