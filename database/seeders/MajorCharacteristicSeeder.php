<?php

namespace Database\Seeders;

use App\Models\CollegeMajor;
use App\Models\Criteria;
use App\Models\MajorCharacteristic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk DB::statement jika diperlukan, tapi tidak di sini

class MajorCharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama jika ingin fresh seed setiap kali (hati-hati jika sudah ada data penting)
        // MajorCharacteristic::query()->delete();

        $majorCharacteristics = [
            // == SAINTEK & TEKNIK ==

            // Teknik Informatika
            ['major' => 'Teknik Informatika', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Teknik Informatika', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Kuantitatif', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknik Informatika', 'criteria' => 'Nilai AKM Numerasi', 'compatibility_weight' => 0.8, 'min_score' => 80],
            ['major' => 'Teknik Informatika', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Teknik Informatika', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Teknik Informatika', 'criteria' => 'Keterampilan Pemecahan Masalah', 'compatibility_weight' => 0.75, 'min_score' => 75],
            ['major' => 'Teknik Informatika', 'criteria' => 'Nilai UN Matematika', 'compatibility_weight' => 0.7, 'min_score' => 80], // Historis
            ['major' => 'Teknik Informatika', 'criteria' => 'Rata-rata Nilai Rapor Fisika', 'compatibility_weight' => 0.5, 'min_score' => 70],

            // Sistem Informasi
            ['major' => 'Sistem Informasi', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.8, 'min_score' => 80],
            ['major' => 'Sistem Informasi', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Penalaran', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Sistem Informasi', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Sistem Informasi', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.75, 'min_score' => 75],
            ['major' => 'Sistem Informasi', 'criteria' => 'Minat Bidang Ekonomi & Bisnis', 'compatibility_weight' => 0.7, 'min_score' => 70],
            ['major' => 'Sistem Informasi', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.6, 'min_score' => 70],
            ['major' => 'Sistem Informasi', 'criteria' => 'Nilai UN Matematika', 'compatibility_weight' => 0.6, 'min_score' => 75], // Historis

            // Teknik Sipil
            ['major' => 'Teknik Sipil', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Teknik Sipil', 'criteria' => 'Rata-rata Nilai Rapor Fisika', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknik Sipil', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Kuantitatif', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Teknik Sipil', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.8, 'min_score' => 80],
            ['major' => 'Teknik Sipil', 'criteria' => 'Keterampilan Pemecahan Masalah', 'compatibility_weight' => 0.7, 'min_score' => 75],
            ['major' => 'Teknik Sipil', 'criteria' => 'Nilai UN IPA Terpadu', 'compatibility_weight' => 0.7, 'min_score' => 75], // Historis (mencakup Fisika)

            // Arsitektur
            ['major' => 'Arsitektur', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.75, 'min_score' => 75],
            ['major' => 'Arsitektur', 'criteria' => 'Rata-rata Nilai Rapor Fisika', 'compatibility_weight' => 0.7, 'min_score' => 70],
            ['major' => 'Arsitektur', 'criteria' => 'Kreativitas & Inovasi', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Arsitektur', 'criteria' => 'Portofolio (DKV, Arsitektur, Seni Rupa)', 'compatibility_weight' => 0.9, 'min_score' => 80],
            ['major' => 'Arsitektur', 'criteria' => 'Minat Bidang Seni & Desain', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Arsitektur', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.6, 'min_score' => 70],

            // Teknik Mesin
            ['major' => 'Teknik Mesin', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknik Mesin', 'criteria' => 'Rata-rata Nilai Rapor Fisika', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Teknik Mesin', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknik Mesin', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Kuantitatif', 'compatibility_weight' => 0.75, 'min_score' => 75],
            ['major' => 'Teknik Mesin', 'criteria' => 'Keterampilan Pemecahan Masalah', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Teknik Elektro
            ['major' => 'Teknik Elektro', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknik Elektro', 'criteria' => 'Rata-rata Nilai Rapor Fisika', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Teknik Elektro', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknik Elektro', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.75, 'min_score' => 75],
            ['major' => 'Teknik Elektro', 'criteria' => 'Nilai AKM Numerasi', 'compatibility_weight' => 0.7, 'min_score' => 75],

            // Teknik Industri
            ['major' => 'Teknik Industri', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Teknik Industri', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Penalaran', 'compatibility_weight' => 0.75, 'min_score' => 75],
            ['major' => 'Teknik Industri', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Teknik Industri', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.7, 'min_score' => 70],
            ['major' => 'Teknik Industri', 'criteria' => 'Minat Bidang Ekonomi & Bisnis', 'compatibility_weight' => 0.65, 'min_score' => 70],
            ['major' => 'Teknik Industri', 'criteria' => 'Keterampilan Pemecahan Masalah', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Statistika
            ['major' => 'Statistika', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Statistika', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Kuantitatif', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Statistika', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Statistika', 'criteria' => 'Nilai AKM Numerasi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Statistika', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Matematika
            ['major' => 'Matematika', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.95, 'min_score' => 85],
            ['major' => 'Matematika', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Kuantitatif', 'compatibility_weight' => 0.9, 'min_score' => 80],
            ['major' => 'Matematika', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Matematika', 'criteria' => 'Nilai AKM Numerasi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Matematika', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Fisika
            ['major' => 'Fisika', 'criteria' => 'Rata-rata Nilai Rapor Fisika', 'compatibility_weight' => 0.95, 'min_score' => 85],
            ['major' => 'Fisika', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Fisika', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.9, 'min_score' => 80],
            ['major' => 'Fisika', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Kuantitatif', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Fisika', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.75, 'min_score' => 70],

            // Kimia
            ['major' => 'Kimia', 'criteria' => 'Rata-rata Nilai Rapor Kimia', 'compatibility_weight' => 0.95, 'min_score' => 85],
            ['major' => 'Kimia', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Kimia', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.9, 'min_score' => 80],
            ['major' => 'Kimia', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.75, 'min_score' => 70],
            ['major' => 'Kimia', 'criteria' => 'Nilai UN IPA Terpadu', 'compatibility_weight' => 0.7, 'min_score' => 75], // Historis (mencakup Kimia)

            // Biologi
            ['major' => 'Biologi', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.95, 'min_score' => 85],
            ['major' => 'Biologi', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.9, 'min_score' => 80],
            ['major' => 'Biologi', 'criteria' => 'Rata-rata Nilai Rapor Kimia', 'compatibility_weight' => 0.7, 'min_score' => 70],
            ['major' => 'Biologi', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.7, 'min_score' => 70],
            ['major' => 'Biologi', 'criteria' => 'Nilai UN IPA Terpadu', 'compatibility_weight' => 0.7, 'min_score' => 75], // Historis (mencakup Biologi)

            // Teknik Lingkungan
            ['major' => 'Teknik Lingkungan', 'criteria' => 'Rata-rata Nilai Rapor Kimia', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Teknik Lingkungan', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.75, 'min_score' => 75],
            ['major' => 'Teknik Lingkungan', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.7, 'min_score' => 70],
            ['major' => 'Teknik Lingkungan', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknik Lingkungan', 'criteria' => 'Keterampilan Pemecahan Masalah', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // == KESEHATAN ==

            // Kedokteran
            ['major' => 'Kedokteran', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Kedokteran', 'criteria' => 'Rata-rata Nilai Rapor Kimia', 'compatibility_weight' => 0.85, 'min_score' => 85],
            ['major' => 'Kedokteran', 'criteria' => 'Minat Bidang Kesehatan & Kedokteran', 'compatibility_weight' => 0.95, 'min_score' => 90],
            ['major' => 'Kedokteran', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.8, 'min_score' => 80],
            ['major' => 'Kedokteran', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Penalaran', 'compatibility_weight' => 0.75, 'min_score' => 80],
            ['major' => 'Kedokteran', 'criteria' => 'Nilai UN IPA Terpadu', 'compatibility_weight' => 0.8, 'min_score' => 85], // Historis
            ['major' => 'Kedokteran', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.7, 'min_score' => 80],

            // Farmasi
            ['major' => 'Farmasi', 'criteria' => 'Rata-rata Nilai Rapor Kimia', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Farmasi', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.8, 'min_score' => 80],
            ['major' => 'Farmasi', 'criteria' => 'Minat Bidang Kesehatan & Kedokteran', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Farmasi', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.75, 'min_score' => 75],
            ['major' => 'Farmasi', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Ilmu Gizi
            ['major' => 'Ilmu Gizi', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Ilmu Gizi', 'criteria' => 'Rata-rata Nilai Rapor Kimia', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Ilmu Gizi', 'criteria' => 'Minat Bidang Kesehatan & Kedokteran', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Ilmu Gizi', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.7, 'min_score' => 70], // Kaitan dengan pangan

            // Keperawatan
            ['major' => 'Keperawatan', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Keperawatan', 'criteria' => 'Minat Bidang Kesehatan & Kedokteran', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Keperawatan', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.75, 'min_score' => 75], // Empati dan komunikasi penting
            ['major' => 'Keperawatan', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Kesehatan Masyarakat
            ['major' => 'Kesehatan Masyarakat', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.75, 'min_score' => 70],
            ['major' => 'Kesehatan Masyarakat', 'criteria' => 'Minat Bidang Kesehatan & Kedokteran', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Kesehatan Masyarakat', 'criteria' => 'Minat Bidang Sosial & Humaniora', 'compatibility_weight' => 0.7, 'min_score' => 70], // Aspek sosial kuat
            ['major' => 'Kesehatan Masyarakat', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Kedokteran Gigi
            ['major' => 'Kedokteran Gigi', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Kedokteran Gigi', 'criteria' => 'Rata-rata Nilai Rapor Kimia', 'compatibility_weight' => 0.8, 'min_score' => 80],
            ['major' => 'Kedokteran Gigi', 'criteria' => 'Minat Bidang Kesehatan & Kedokteran', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Kedokteran Gigi', 'criteria' => 'Kreativitas & Inovasi', 'compatibility_weight' => 0.7, 'min_score' => 70], // Aspek estetika dan keterampilan tangan

            // == SOSIAL HUMANIORA ==

            // Manajemen
            ['major' => 'Manajemen', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.7, 'min_score' => 70], // Logika dasar
            ['major' => 'Manajemen', 'criteria' => 'Rata-rata Nilai Rapor Ekonomi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Manajemen', 'criteria' => 'Minat Bidang Ekonomi & Bisnis', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Manajemen', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Penalaran', 'compatibility_weight' => 0.75, 'min_score' => 75],
            ['major' => 'Manajemen', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.7, 'min_score' => 70],
            ['major' => 'Manajemen', 'criteria' => 'Pengalaman Organisasi & Kepemimpinan', 'compatibility_weight' => 0.6, 'min_score' => 70],
            ['major' => 'Manajemen', 'criteria' => 'Nilai UN Bahasa Inggris', 'compatibility_weight' => 0.6, 'min_score' => 75], // Historis

            // Akuntansi
            ['major' => 'Akuntansi', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.85, 'min_score' => 80], // Ketelitian angka
            ['major' => 'Akuntansi', 'criteria' => 'Rata-rata Nilai Rapor Ekonomi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Akuntansi', 'criteria' => 'Minat Bidang Ekonomi & Bisnis', 'compatibility_weight' => 0.8, 'min_score' => 80],
            ['major' => 'Akuntansi', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.75, 'min_score' => 75],
            ['major' => 'Akuntansi', 'criteria' => 'Nilai AKM Numerasi', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Ilmu Hukum
            ['major' => 'Ilmu Hukum', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Ilmu Hukum', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Penalaran', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Ilmu Hukum', 'criteria' => 'Minat Bidang Sosial & Humaniora', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Ilmu Hukum', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.75, 'min_score' => 75], // Argumentasi
            ['major' => 'Ilmu Hukum', 'criteria' => 'Nilai UN Bahasa Indonesia', 'compatibility_weight' => 0.7, 'min_score' => 80], // Historis

            // Psikologi
            ['major' => 'Psikologi', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Psikologi', 'criteria' => 'Minat Bidang Sosial & Humaniora', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Psikologi', 'criteria' => 'Minat Bidang Kesehatan & Kedokteran', 'compatibility_weight' => 0.6, 'min_score' => 70], // Ada irisan
            ['major' => 'Psikologi', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.75, 'min_score' => 70], // Empati
            ['major' => 'Psikologi', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.6, 'min_score' => 70], // Dasar ilmu perilaku

            // Ilmu Komunikasi
            ['major' => 'Ilmu Komunikasi', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Ilmu Komunikasi', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Ilmu Komunikasi', 'criteria' => 'Minat Bidang Sosial & Humaniora', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Ilmu Komunikasi', 'criteria' => 'Kreativitas & Inovasi', 'compatibility_weight' => 0.7, 'min_score' => 70],
            ['major' => 'Ilmu Komunikasi', 'criteria' => 'Nilai UN Bahasa Indonesia', 'compatibility_weight' => 0.7, 'min_score' => 80], // Historis
            ['major' => 'Ilmu Komunikasi', 'criteria' => 'Nilai UN Bahasa Inggris', 'compatibility_weight' => 0.7, 'min_score' => 75], // Historis

            // Hubungan Internasional
            ['major' => 'Hubungan Internasional', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Hubungan Internasional', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Penalaran', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Hubungan Internasional', 'criteria' => 'Minat Bidang Sosial & Humaniora', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Hubungan Internasional', 'criteria' => 'Nilai UN Bahasa Inggris', 'compatibility_weight' => 0.85, 'min_score' => 80], // Historis dan relevan
            ['major' => 'Hubungan Internasional', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Sosiologi
            ['major' => 'Sosiologi', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Sosiologi', 'criteria' => 'Minat Bidang Sosial & Humaniora', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Sosiologi', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.75, 'min_score' => 70], // Analisis sosial
            ['major' => 'Sosiologi', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Penalaran', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Antropologi
            ['major' => 'Antropologi', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Antropologi', 'criteria' => 'Minat Bidang Sosial & Humaniora', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Antropologi', 'criteria' => 'Minat Bidang Bahasa & Budaya', 'compatibility_weight' => 0.75, 'min_score' => 70],
            ['major' => 'Antropologi', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.7, 'min_score' => 70], // Wawancara, observasi

            // Ilmu Politik
            ['major' => 'Ilmu Politik', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Ilmu Politik', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Penalaran', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Ilmu Politik', 'criteria' => 'Minat Bidang Sosial & Humaniora', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Ilmu Politik', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.7, 'min_score' => 70], // Debat, orasi

            // == BAHASA & SENI ==

            // Sastra Inggris
            ['major' => 'Sastra Inggris', 'criteria' => 'Nilai UN Bahasa Inggris', 'compatibility_weight' => 0.9, 'min_score' => 85], // Historis dan sangat relevan
            ['major' => 'Sastra Inggris', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.85, 'min_score' => 80], // Kemampuan pemahaman teks
            ['major' => 'Sastra Inggris', 'criteria' => 'Minat Bidang Bahasa & Budaya', 'compatibility_weight' => 0.95, 'min_score' => 90],
            ['major' => 'Sastra Inggris', 'criteria' => 'Kreativitas & Inovasi', 'compatibility_weight' => 0.7, 'min_score' => 70], // Interpretasi, penulisan kreatif
            ['major' => 'Sastra Inggris', 'criteria' => 'Nilai UN Bahasa Indonesia', 'compatibility_weight' => 0.7, 'min_score' => 75], // Historis, kemampuan bahasa ibu

            // Sastra Indonesia
            ['major' => 'Sastra Indonesia', 'criteria' => 'Nilai UN Bahasa Indonesia', 'compatibility_weight' => 0.9, 'min_score' => 85], // Historis dan sangat relevan
            ['major' => 'Sastra Indonesia', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.9, 'min_score' => 80],
            ['major' => 'Sastra Indonesia', 'criteria' => 'Minat Bidang Bahasa & Budaya', 'compatibility_weight' => 0.95, 'min_score' => 90],
            ['major' => 'Sastra Indonesia', 'criteria' => 'Kreativitas & Inovasi', 'compatibility_weight' => 0.75, 'min_score' => 70],

            // Desain Komunikasi Visual (DKV)
            ['major' => 'Desain Komunikasi Visual (DKV)', 'criteria' => 'Kreativitas & Inovasi', 'compatibility_weight' => 0.95, 'min_score' => 85],
            ['major' => 'Desain Komunikasi Visual (DKV)', 'criteria' => 'Portofolio (DKV, Arsitektur, Seni Rupa)', 'compatibility_weight' => 0.9, 'min_score' => 80],
            ['major' => 'Desain Komunikasi Visual (DKV)', 'criteria' => 'Minat Bidang Seni & Desain', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Desain Komunikasi Visual (DKV)', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.7, 'min_score' => 70], // Visual communication

            // == PENDIDIKAN ==

            // Pendidikan Guru Sekolah Dasar (PGSD)
            ['major' => 'Pendidikan Guru Sekolah Dasar (PGSD)', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Pendidikan Guru Sekolah Dasar (PGSD)', 'criteria' => 'Nilai AKM Numerasi', 'compatibility_weight' => 0.75, 'min_score' => 70],
            ['major' => 'Pendidikan Guru Sekolah Dasar (PGSD)', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.85, 'min_score' => 80], // Interaksi dengan anak
            ['major' => 'Pendidikan Guru Sekolah Dasar (PGSD)', 'criteria' => 'Minat Bidang Sosial & Humaniora', 'compatibility_weight' => 0.7, 'min_score' => 70], // Minat mengajar, kesabaran
            ['major' => 'Pendidikan Guru Sekolah Dasar (PGSD)', 'criteria' => 'Kreativitas & Inovasi', 'compatibility_weight' => 0.7, 'min_score' => 70], // Metode mengajar

            // Pendidikan Bahasa Inggris
            ['major' => 'Pendidikan Bahasa Inggris', 'criteria' => 'Nilai UN Bahasa Inggris', 'compatibility_weight' => 0.9, 'min_score' => 85], // Historis dan sangat relevan
            ['major' => 'Pendidikan Bahasa Inggris', 'criteria' => 'Minat Bidang Bahasa & Budaya', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Pendidikan Bahasa Inggris', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Pendidikan Bahasa Inggris', 'criteria' => 'Nilai AKM Literasi', 'compatibility_weight' => 0.75, 'min_score' => 75],

            // == PERTANIAN & LAINNYA ==

            // Agribisnis
            ['major' => 'Agribisnis', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.7, 'min_score' => 70],
            ['major' => 'Agribisnis', 'criteria' => 'Rata-rata Nilai Rapor Ekonomi', 'compatibility_weight' => 0.75, 'min_score' => 70],
            ['major' => 'Agribisnis', 'criteria' => 'Minat Bidang Ekonomi & Bisnis', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Agribisnis', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.65, 'min_score' => 65], // Aspek pertaniannya
            ['major' => 'Agribisnis', 'criteria' => 'Keterampilan Pemecahan Masalah', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Teknologi Pangan
            ['major' => 'Teknologi Pangan', 'criteria' => 'Rata-rata Nilai Rapor Kimia', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknologi Pangan', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Teknologi Pangan', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknologi Pangan', 'criteria' => 'Kemampuan Analisis & Logika', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Ilmu Kelautan
            ['major' => 'Ilmu Kelautan', 'criteria' => 'Rata-rata Nilai Rapor Biologi', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Ilmu Kelautan', 'criteria' => 'Rata-rata Nilai Rapor Kimia', 'compatibility_weight' => 0.75, 'min_score' => 70],
            ['major' => 'Ilmu Kelautan', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Ilmu Kelautan', 'criteria' => 'Rata-rata Nilai Rapor Fisika', 'compatibility_weight' => 0.7, 'min_score' => 70], // Oseanografi fisik

            // Perhotelan dan Pariwisata
            ['major' => 'Perhotelan dan Pariwisata', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Perhotelan dan Pariwisata', 'criteria' => 'Nilai UN Bahasa Inggris', 'compatibility_weight' => 0.8, 'min_score' => 75], // Historis dan relevan
            ['major' => 'Perhotelan dan Pariwisata', 'criteria' => 'Minat Bidang Sosial & Humaniora', 'compatibility_weight' => 0.8, 'min_score' => 75], // Pelayanan
            ['major' => 'Perhotelan dan Pariwisata', 'criteria' => 'Pengalaman Organisasi & Kepemimpinan', 'compatibility_weight' => 0.6, 'min_score' => 70],

            // Administrasi Bisnis/Niaga
            ['major' => 'Administrasi Bisnis/Niaga', 'criteria' => 'Rata-rata Nilai Rapor Ekonomi', 'compatibility_weight' => 0.75, 'min_score' => 70],
            ['major' => 'Administrasi Bisnis/Niaga', 'criteria' => 'Minat Bidang Ekonomi & Bisnis', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Administrasi Bisnis/Niaga', 'criteria' => 'Keterampilan Komunikasi', 'compatibility_weight' => 0.7, 'min_score' => 70],
            ['major' => 'Administrasi Bisnis/Niaga', 'criteria' => 'Skor Tes Potensi Skolastik (TPS) - Penalaran', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Teknik Perminyakan (Contoh untuk jurusan yang mungkin lebih spesifik dan kompetitif)
            ['major' => 'Teknik Perminyakan', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.9, 'min_score' => 85],
            ['major' => 'Teknik Perminyakan', 'criteria' => 'Rata-rata Nilai Rapor Fisika', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknik Perminyakan', 'criteria' => 'Rata-rata Nilai Rapor Kimia', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Teknik Perminyakan', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.9, 'min_score' => 85],

            // Teknik Pertambangan
            ['major' => 'Teknik Pertambangan', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknik Pertambangan', 'criteria' => 'Rata-rata Nilai Rapor Fisika', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Teknik Pertambangan', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.85, 'min_score' => 80],
            ['major' => 'Teknik Pertambangan', 'criteria' => 'Keterampilan Pemecahan Masalah', 'compatibility_weight' => 0.7, 'min_score' => 70],

            // Teknik Geologi
            ['major' => 'Teknik Geologi', 'criteria' => 'Rata-rata Nilai Rapor Fisika', 'compatibility_weight' => 0.8, 'min_score' => 75],
            ['major' => 'Teknik Geologi', 'criteria' => 'Rata-rata Nilai Rapor Kimia', 'compatibility_weight' => 0.75, 'min_score' => 70],
            ['major' => 'Teknik Geologi', 'criteria' => 'Rata-rata Nilai Rapor Matematika', 'compatibility_weight' => 0.75, 'min_score' => 70],
            ['major' => 'Teknik Geologi', 'criteria' => 'Minat Bidang Sains & Teknologi', 'compatibility_weight' => 0.9, 'min_score' => 85],

            // SMK specific criteria usage example
            ['major' => 'Teknik Informatika', 'criteria' => 'Nilai Ujian Kompetensi Kejuruan', 'compatibility_weight' => 0.7, 'min_score' => 75], // Jika relevan untuk SMK jurusan RPL/TKJ
            ['major' => 'Teknik Mesin', 'criteria' => 'Nilai Ujian Kompetensi Kejuruan', 'compatibility_weight' => 0.8, 'min_score' => 80], // Jika relevan untuk SMK jurusan Mesin
        ];

        $count = 0;
        $skippedMajors = [];
        $skippedCriteria = [];

        foreach ($majorCharacteristics as $char)
        {
            $major = CollegeMajor::where('major_name', $char['major'])->first();
            $criteria = Criteria::where('name', $char['criteria'])->first();

            if ($major && $criteria)
            {
                // Cek apakah kombinasi sudah ada untuk menghindari duplikasi jika seeder dijalankan berkali-kali
                $exists = MajorCharacteristic::where('college_major_id', $major->id)
                    ->where('criteria_id', $criteria->id)
                    ->exists();
                if (!$exists)
                {
                    MajorCharacteristic::create([
                        'college_major_id' => $major->id,
                        'criteria_id' => $criteria->id,
                        'compatibility_weight' => $char['compatibility_weight'],
                        'minimum_score' => $char['min_score'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $count++;
                }
            }
            else
            {
                if (!$major && !in_array($char['major'], $skippedMajors))
                {
                    echo "Peringatan: Jurusan Kuliah '{$char['major']}' tidak ditemukan di database.\n";
                    $skippedMajors[] = $char['major'];
                }
                if (!$criteria && !in_array($char['criteria'], $skippedCriteria))
                {
                    echo "Peringatan: Kriteria '{$char['criteria']}' tidak ditemukan di database.\n";
                    $skippedCriteria[] = $char['criteria'];
                }
            }
        }
        echo "MajorCharacteristicSeeder selesai. {$count} data berhasil ditambahkan.\n";
        if (!empty($skippedMajors))
        {
            echo "Jurusan yang dilewati (tidak ditemukan): " . implode(', ', array_unique($skippedMajors)) . "\n";
        }
        if (!empty($skippedCriteria))
        {
            echo "Kriteria yang dilewati (tidak ditemukan): " . implode(', ', array_unique($skippedCriteria)) . "\n";
        }
    }
}
