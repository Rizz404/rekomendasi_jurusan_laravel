<?php

namespace Database\Seeders;

use App\Models\CollegeMajor;
use App\Models\University;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeMajorUniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mapping jurusan dan universitas
        $majorUniversityMapping = [
            'Teknik Informatika' => ['Universitas Indonesia', 'Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'Institut Teknologi Sepuluh Nopember', 'Universitas Bina Nusantara'],
            'Sistem Informasi' => ['Universitas Indonesia', 'Universitas Airlangga', 'Universitas Brawijaya', 'Universitas Bina Nusantara'],
            'Manajemen' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Diponegoro', 'Universitas Padjadjaran', 'Universitas Pelita Harapan'],
            'Akuntansi' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Padjadjaran', 'Universitas Pelita Harapan'],
            'Kedokteran' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Diponegoro', 'Universitas Padjadjaran'],
            'Ilmu Hukum' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Diponegoro', 'Universitas Padjadjaran'],
            'Psikologi' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Diponegoro', 'Universitas Pelita Harapan'],
            'Teknik Sipil' => ['Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'Institut Teknologi Sepuluh Nopember', 'Universitas Diponegoro', 'Universitas Brawijaya'],
            'Sastra Inggris' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Padjadjaran', 'Universitas Pelita Harapan'],
            'Ilmu Komunikasi' => ['Universitas Indonesia', 'Universitas Padjadjaran', 'Universitas Airlangga', 'Universitas Bina Nusantara', 'Universitas Pelita Harapan'],
        ];

        foreach ($majorUniversityMapping as $majorName => $universityNames)
        {
            $major = CollegeMajor::where('major_name', $majorName)->first();
            if (!$major) continue;

            foreach ($universityNames as $uniName)
            {
                $university = University::where('name', $uniName)->first();
                if (!$university) continue;

                DB::table('college_major_university')->insert([
                    'college_major_id' => $major->id,
                    'university_id' => $university->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
