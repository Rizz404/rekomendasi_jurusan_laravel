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
        $collegeMajors = CollegeMajor::all();

        // Alasan rekomendasi yang bisa digunakan
        $reasons = [
            'Nilai akademik dan minat Anda sangat cocok dengan jurusan ini.',
            'Berdasarkan profil akademik, Anda memiliki potensi besar untuk sukses di jurusan ini.',
            'Minat dan kemampuan Anda menunjukkan kecocokan yang baik dengan jurusan ini.',
            'Jurusan ini sesuai dengan profil akademik dan cenderung membuka peluang karir yang baik.',
            'Hasil analisis menunjukkan bahwa Anda memiliki kecenderungan yang baik untuk jurusan ini.'
        ];

        foreach ($students as $student)
        {
            // Pilih 3-5 jurusan secara acak untuk setiap siswa
            $selectedMajors = $collegeMajors->random(rand(3, 5));
            $rank = 1;

            foreach ($selectedMajors as $major)
            {
                // Buat skor yang semakin menurun berdasarkan ranking
                $score = 1 - (($rank - 1) * 0.1);
                if ($score < 0.5) $score = 0.5;

                SAWResult::create([
                    'student_id' => $student->id,
                    'college_major_id' => $major->id,
                    'final_score' => $score,
                    'rank' => $rank,
                    'recommendation_reason' => $reasons[array_rand($reasons)],
                    'calculation_date' => now(),
                ]);

                $rank++;
            }
        }
    }
}
