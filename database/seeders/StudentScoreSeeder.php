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

        if ($students->isEmpty())
        {
            $this->command->info('Tidak ada data siswa untuk di-seed skornya. Silakan jalankan StudentSeeder terlebih dahulu.');
            return;
        }

        if ($criterias->isEmpty())
        {
            $this->command->info('Tidak ada data kriteria. Silakan jalankan CriteriaSeeder terlebih dahulu.');
            return;
        }

        foreach ($students as $student)
        {
            foreach ($criterias as $criteria)
            {
                // Skip if criteria doesn't match student's school type
                $schoolMapping = [ // Pastikan ini sesuai dengan nilai di tabel students.school_type
                    'high_school' => 'SMA',      // Contoh jika di tabel students isinya 'high_school'
                    'vocational_school' => 'SMK', // Contoh jika di tabel students isinya 'vocational_school'
                    'SMA' => 'SMA',              // Jika sudah SMA/SMK
                    'SMK' => 'SMK',              // Jika sudah SMA/SMK
                ];

                // Ambil school_type siswa, default ke 'All' jika tidak ada mapping atau student->school_type kosong
                $studentSchoolTypeFromDb = $student->school_type ?? null;
                $studentSchoolType = $studentSchoolTypeFromDb ? ($schoolMapping[$studentSchoolTypeFromDb] ?? 'All') : 'All';


                if ($criteria->school_type !== 'All' && $criteria->school_type !== $studentSchoolType)
                {
                    continue;
                }

                // Generate a realistic score based on criteria name
                $criteriaNameLower = strtolower($criteria->name);
                $score = 0; // Default score

                // Prioritaskan kriteria yang lebih spesifik terlebih dahulu
                if (str_contains($criteriaNameLower, 'prestasi akademik'))
                {
                    $score = fake()->optional(0.6, 0)->numberBetween(75, 100);
                }
                elseif (str_contains($criteriaNameLower, 'prestasi non-akademik'))
                {
                    $score = fake()->optional(0.7, 0)->numberBetween(70, 100);
                }
                elseif (str_contains($criteriaNameLower, 'portofolio'))
                {
                    // Hanya generate skor portofolio jika relevan dengan minat tertentu (opsional, bisa lebih kompleks)
                    // Untuk simplicity, kita generate saja jika kriterianya ada
                    $score = fake()->optional(0.5, 0)->numberBetween(70, 98);
                }
                elseif (str_contains($criteriaNameLower, 'pengalaman organisasi'))
                {
                    $score = fake()->optional(0.4, 0)->numberBetween(60, 90);
                }
                elseif (str_contains($criteriaNameLower, 'un'))
                { // Cek 'un' setelah prestasi dan portofolio
                    $score = fake()->numberBetween(65, 95);
                }
                elseif (str_contains($criteriaNameLower, 'rapor'))
                {
                    $score = fake()->numberBetween(70, 98);
                }
                elseif (str_contains($criteriaNameLower, 'tps') || str_contains($criteriaNameLower, 'skolastik'))
                {
                    $score = fake()->numberBetween(60, 95); // Asumsi skor 0-100
                }
                elseif (str_contains($criteriaNameLower, 'akm'))
                {
                    $score = fake()->numberBetween(60, 90);
                }
                elseif (str_contains($criteriaNameLower, 'kemampuan') || str_contains($criteriaNameLower, 'keterampilan'))
                {
                    $score = fake()->numberBetween(65, 95);
                }
                elseif (str_contains($criteriaNameLower, 'minat'))
                {
                    $score = fake()->numberBetween(50, 100);
                }
                else
                {
                    $score = fake()->numberBetween(60, 90); // Default untuk kriteria lain
                }

                // Pastikan score tidak null jika kolom DB tidak mengizinkan
                $finalScore = $score ?? 0;

                StudentScore::create([
                    'student_id' => $student->id,
                    'criteria_id' => $criteria->id,
                    'score' => $finalScore,
                    'input_date' => now(), // 'input_date' akan diisi oleh useCurrent() dari migrasi jika tidak di-provide di sini
                    // Namun, mengisi di sini juga tidak masalah.
                    // created_at dan updated_at akan diisi otomatis
                ]);
            }
        }
        $this->command->info('StudentScoreSeeder berhasil dijalankan.');
    }
}
