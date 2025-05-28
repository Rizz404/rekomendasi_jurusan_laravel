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
            // Kriteria yang sudah ada
            [
                'name' => 'Nilai UN Matematika',
                'description' => 'Nilai Ujian Nasional Matematika (jika masih relevan/data historis)',
                'weight' => 0.20, // Bobot bisa disesuaikan
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Nilai UN Bahasa Indonesia',
                'description' => 'Nilai Ujian Nasional Bahasa Indonesia (jika masih relevan/data historis)',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Nilai UN Bahasa Inggris',
                'description' => 'Nilai Ujian Nasional Bahasa Inggris (jika masih relevan/data historis)',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Nilai UN IPA Terpadu', // Mengganti 'Nilai UN IPA' agar lebih umum untuk SMA IPA
                'description' => 'Nilai Ujian Nasional IPA Terpadu (Fisika, Kimia, Biologi) (jika masih relevan/data historis)',
                'weight' => 0.20, // Bobot mungkin lebih tinggi untuk rumpun Saintek
                'type' => 'benefit',
                'school_type' => 'SMA', // Spesifik untuk SMA IPA
                'is_active' => true,
            ],
            [
                'name' => 'Nilai UN IPS Terpadu', // Mengganti 'Nilai UN IPS' agar lebih umum untuk SMA IPS
                'description' => 'Nilai Ujian Nasional IPS Terpadu (Ekonomi, Sosiologi, Geografi) (jika masih relevan/data historis)',
                'weight' => 0.20, // Bobot mungkin lebih tinggi untuk rumpun Soshum
                'type' => 'benefit',
                'school_type' => 'SMA', // Spesifik untuk SMA IPS
                'is_active' => true,
            ],
            [
                'name' => 'Nilai Ujian Kompetensi Kejuruan', // Memperjelas 'Nilai Kejuruan'
                'description' => 'Nilai Ujian Kompetensi Keahlian (UKK) untuk SMK',
                'weight' => 0.25,
                'type' => 'benefit',
                'school_type' => 'SMK',
                'is_active' => true,
            ],
            [
                'name' => 'Minat Bidang Sains & Teknologi', // Memperjelas 'Minat Sains' dan 'Minat Teknik'
                'description' => 'Tingkat minat terhadap ilmu-ilmu eksakta, rekayasa, dan teknologi',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Minat Bidang Sosial & Humaniora', // Memperjelas 'Minat Sosial'
                'description' => 'Tingkat minat terhadap ilmu-ilmu sosial, hukum, dan humaniora',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Minat Bidang Bahasa & Budaya', // Memperjelas 'Minat Bahasa'
                'description' => 'Tingkat minat terhadap bahasa, sastra, dan budaya',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            // Tambahan kriteria baru
            [
                'name' => 'Rata-rata Nilai Rapor Matematika',
                'description' => 'Rata-rata nilai rapor Matematika (misal: semester 1-5)',
                'weight' => 0.20,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Rata-rata Nilai Rapor Fisika',
                'description' => 'Rata-rata nilai rapor Fisika (misal: semester 1-5, untuk jurusan IPA/Teknik)',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'SMA', // Atau 'All' jika sistem bisa menangani ketiadaan nilai
                'is_active' => true,
            ],
            [
                'name' => 'Rata-rata Nilai Rapor Kimia',
                'description' => 'Rata-rata nilai rapor Kimia (misal: semester 1-5, untuk jurusan IPA/Kesehatan)',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'SMA',
                'is_active' => true,
            ],
            [
                'name' => 'Rata-rata Nilai Rapor Biologi',
                'description' => 'Rata-rata nilai rapor Biologi (misal: semester 1-5, untuk jurusan IPA/Kesehatan/Pertanian)',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'SMA',
                'is_active' => true,
            ],
            [
                'name' => 'Rata-rata Nilai Rapor Ekonomi',
                'description' => 'Rata-rata nilai rapor Ekonomi (misal: semester 1-5, untuk jurusan IPS/Bisnis)',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'SMA',
                'is_active' => true,
            ],
            [
                'name' => 'Skor Tes Potensi Skolastik (TPS) - Kuantitatif',
                'description' => 'Skor subtes Kemampuan Kuantitatif dari Tes Potensi Skolastik',
                'weight' => 0.20,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Skor Tes Potensi Skolastik (TPS) - Verbal/Literasi',
                'description' => 'Skor subtes Kemampuan Pemahaman Bacaan dan Menulis / Literasi dari Tes Potensi Skolastik',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Skor Tes Potensi Skolastik (TPS) - Penalaran',
                'description' => 'Skor subtes Kemampuan Penalaran Umum dari Tes Potensi Skolastik',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Nilai AKM Literasi',
                'description' => 'Nilai Asesmen Kompetensi Minimum (AKM) untuk Literasi Membaca',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Nilai AKM Numerasi',
                'description' => 'Nilai Asesmen Kompetensi Minimum (AKM) untuk Numerasi',
                'weight' => 0.20,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Prestasi Akademik (Olimpiade Sains, Debat, dll.)',
                'description' => 'Tingkat pencapaian dalam kompetisi akademik (Kabupaten/Kota, Provinsi, Nasional, Internasional)',
                'weight' => 0.10, // Bisa lebih tinggi jika prestasinya signifikan
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Prestasi Non-Akademik (Olahraga, Seni, dll.)',
                'description' => 'Tingkat pencapaian dalam kompetisi non-akademik (Olahraga, Seni, Kepemimpinan)',
                'weight' => 0.05,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Kemampuan Analisis & Logika',
                'description' => 'Skor dari tes atau penilaian kemampuan berpikir analitis dan logis',
                'weight' => 0.15,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Kreativitas & Inovasi',
                'description' => 'Penilaian tingkat kreativitas dan kemampuan menghasilkan ide-ide inovatif (bisa dari portofolio atau tes)',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Keterampilan Komunikasi',
                'description' => 'Penilaian kemampuan berkomunikasi lisan maupun tulisan secara efektif',
                'weight' => 0.05,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Keterampilan Pemecahan Masalah',
                'description' => 'Kemampuan dalam mengidentifikasi dan menyelesaikan masalah secara efektif',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Minat Bidang Seni & Desain',
                'description' => 'Tingkat minat terhadap seni rupa, desain grafis, arsitektur, musik, dll.',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Minat Bidang Kesehatan & Kedokteran',
                'description' => 'Tingkat minat terhadap ilmu kedokteran, keperawatan, farmasi, dan kesehatan masyarakat',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Minat Bidang Ekonomi & Bisnis',
                'description' => 'Tingkat minat terhadap ilmu ekonomi, manajemen, akuntansi, dan kewirausahaan',
                'weight' => 0.10,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ],
            [
                'name' => 'Portofolio (DKV, Arsitektur, Seni Rupa)',
                'description' => 'Penilaian kualitas portofolio karya untuk jurusan yang membutuhkan (DKV, Arsitektur, Seni Rupa, dll.)',
                'weight' => 0.20, // Bobot tinggi untuk jurusan terkait
                'type' => 'benefit',
                'school_type' => 'All', // Siswa SMA/SMK bisa saja punya
                'is_active' => true,
            ],
            [
                'name' => 'Pengalaman Organisasi & Kepemimpinan',
                'description' => 'Keaktifan dan peran dalam organisasi siswa, ekstrakurikuler, atau komunitas',
                'weight' => 0.05,
                'type' => 'benefit',
                'school_type' => 'All',
                'is_active' => true,
            ]
        ];

        foreach ($criterias as $criteriaData)
        {
            Criteria::create($criteriaData);
        }
    }
}
