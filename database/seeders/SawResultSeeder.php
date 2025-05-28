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

        if ($students->isEmpty())
        {
            $this->command->info('Tidak ada data siswa untuk di-seed hasil SAW-nya. Jalankan StudentSeeder dahulu.');
            return;
        }

        if ($collegeMajors->isEmpty())
        {
            $this->command->info('Tidak ada data jurusan kuliah. Jalankan CollegeMajorSeeder dahulu.');
            return;
        }

        // Alasan rekomendasi yang lebih beragam
        $reasons = [
            'Nilai akademik dan minat Anda sangat cocok dengan jurusan ini.',
            'Berdasarkan profil akademik, Anda memiliki potensi besar untuk sukses di jurusan ini.',
            'Minat dan kemampuan Anda menunjukkan kecocokan yang baik dengan jurusan ini.',
            'Jurusan ini sesuai dengan profil akademik dan cenderung membuka peluang karir yang baik.',
            'Hasil analisis menunjukkan bahwa Anda memiliki kecenderungan yang kuat untuk jurusan ini.',
            'Kekuatan Anda dalam analisis kuantitatif dan logika sangat mendukung pilihan jurusan ini.',
            'Kemampuan verbal dan pemahaman literasi Anda selaras dengan tuntutan jurusan ini.',
            'Skor Tes Potensi Skolastik (TPS) dan nilai rapor Anda menunjukkan kesiapan yang matang untuk materi di jurusan ini.',
            'Kreativitas dan portofolio Anda (jika ada) menjadi nilai tambah yang signifikan untuk jurusan ini.',
            'Nilai-nilai pada mata pelajaran IPA/IPS Anda sangat relevan dan mendukung untuk rumpun ilmu jurusan ini.',
            'Minat Anda yang kuat pada bidang Sains & Teknologi sangat sejalan dengan fokus jurusan ini.',
            'Minat Anda yang kuat pada bidang Ekonomi & Bisnis sangat cocok dengan materi pembelajaran di jurusan ini.',
            'Jurusan ini dapat menjadi wadah yang tepat untuk mengembangkan minat dan bakat Anda di bidang Sosial & Humaniora.',
            'Selain kecocokan akademik, jurusan ini memiliki prospek karir yang cerah dan relevan dengan perkembangan industri.',
            'Kombinasi antara profil Anda dan relevansi jurusan ini di dunia kerja menjadikannya pilihan yang strategis.',
            'Analisis komprehensif menunjukkan ini adalah salah satu pilihan terbaik berdasarkan keseluruhan profil Anda.',
            'Kombinasi skor dan minat Anda menempatkan jurusan ini sebagai rekomendasi teratas.',
            'Anda menunjukkan kecocokan yang sangat baik pada kriteria-kriteria kunci untuk jurusan ini.',
            'Potensi Anda untuk berkembang dan berprestasi di jurusan ini dinilai tinggi oleh sistem.',
            'Profil Anda secara konsisten menunjukkan keselarasan dengan karakteristik ideal mahasiswa jurusan ini.',
            'Jurusan ini sangat direkomendasikan berdasarkan analisis skor dan preferensi minat Anda.',
            'Kecocokan dengan kriteria soft skills seperti pemecahan masalah dan komunikasi juga mendukung pilihan ini.',
            'Berdasarkan hasil AKM dan nilai rapor, jurusan ini merupakan pilihan yang sangat sesuai.',
            'Prestasi akademik yang Anda miliki memberikan poin tambahan yang signifikan untuk jurusan ini.',
            'Keterampilan teknis dan nilai kejuruan Anda (khususnya untuk siswa SMK) sangat relevan dengan jurusan ini.'
        ];

        foreach ($students as $student)
        {
            // Tentukan jumlah jurusan yang akan direkomendasikan (3-5, atau kurang jika total jurusan sedikit)
            $majorsCount = $collegeMajors->count();
            if ($majorsCount === 0)
            {
                continue; // Tidak ada jurusan yang bisa dipilih
            }
            // Menentukan jumlah rekomendasi, minimal 1 jika ada jurusan, maksimal 5 atau jumlah jurusan yang ada
            $numberOfRecommendations = min(rand(3, 5), $majorsCount);
            if ($numberOfRecommendations <= 0) $numberOfRecommendations = 1;


            // Ambil sejumlah jurusan secara acak dan pastikan unik untuk siswa ini
            $selectedMajors = $collegeMajors->random($numberOfRecommendations);
            // Jika hanya satu jurusan yang terpilih dan random mengembalikan satu objek, bukan collection, bungkus dalam collection
            if (!$selectedMajors instanceof \Illuminate\Support\Collection)
            {
                $selectedMajors = collect([$selectedMajors]);
            }


            // Urutkan selectedMajors secara acak untuk simulasi skor yang berbeda tiap run (opsional)
            // Atau bisa juga diurutkan berdasarkan suatu kriteria dummy jika ingin lebih konsisten
            // Untuk seeder ini, pengurutan acak tidak terlalu masalah karena skornya juga dummy
            // $selectedMajors = $selectedMajors->shuffle(); // Jika ingin urutan berbeda-beda

            $rank = 1;

            foreach ($selectedMajors as $major)
            {
                // Buat skor dummy yang semakin menurun berdasarkan ranking
                // Skor dimulai dari ~0.95 untuk rank 1 dan menurun, dengan minimal 0.50
                $baseScore = 0.95; // Skor awal yang lebih tinggi untuk rank 1
                $decrement = 0.07; // Pengurangan skor per rank
                $minScore = 0.5000;

                // Skor sedikit diacak agar tidak selalu sama persis untuk rank yang sama antar student
                $scoreVariation = fake()->randomFloat(4, -0.02, 0.02);
                $score = $baseScore - (($rank - 1) * $decrement) + $scoreVariation;
                $score = max($minScore, min($score, 1.0000)); // Pastikan skor antara minScore dan 1.0

                SAWResult::create([
                    'student_id' => $student->id,
                    'college_major_id' => $major->id,
                    'final_score' => round($score, 4), // Bulatkan ke 4 angka desimal
                    'rank' => $rank,
                    'recommendation_reason' => $reasons[array_rand($reasons)],
                    'calculation_date' => now()->subDays(rand(0, 30)), // Tanggal kalkulasi bisa sedikit bervariasi
                    // created_at dan updated_at akan diisi otomatis
                ]);

                $rank++;
            }
        }
        $this->command->info('SawResultSeeder berhasil dijalankan.');
    }
}
