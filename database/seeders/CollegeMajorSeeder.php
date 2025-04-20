<?php

namespace Database\Seeders;

use App\Models\CollegeMajor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollegeMajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collegeMajors = [
            [
                'major_name' => 'Teknik Informatika',
                'faculty' => 'Fakultas Teknik',
                'description' => 'Program studi yang mempelajari ilmu komputer, pemrograman, dan teknologi informasi.',
                'field_of_study' => 'Teknik',
                'career_prospects' => 'Software Engineer, Web Developer, Data Scientist, IT Consultant, System Analyst',
                'is_active' => true,
            ],
            [
                'major_name' => 'Sistem Informasi',
                'faculty' => 'Fakultas Teknik',
                'description' => 'Program studi yang mempelajari analisis dan desain sistem informasi untuk memecahkan masalah bisnis.',
                'field_of_study' => 'Teknik',
                'career_prospects' => 'Business Analyst, System Analyst, Database Administrator, IT Project Manager',
                'is_active' => true,
            ],
            [
                'major_name' => 'Manajemen',
                'faculty' => 'Fakultas Ekonomi dan Bisnis',
                'description' => 'Program studi yang mempelajari teori dan praktik mengelola organisasi, sumber daya manusia, dan operasi bisnis.',
                'field_of_study' => 'Ekonomi',
                'career_prospects' => 'Manager, Entrepreneur, Business Consultant, HR Manager, Marketing Executive',
                'is_active' => true,
            ],
            [
                'major_name' => 'Akuntansi',
                'faculty' => 'Fakultas Ekonomi dan Bisnis',
                'description' => 'Program studi yang mempelajari pencatatan transaksi keuangan, pelaporan keuangan, dan audit.',
                'field_of_study' => 'Ekonomi',
                'career_prospects' => 'Auditor, Tax Consultant, Financial Analyst, Accountant, Finance Manager',
                'is_active' => true,
            ],
            [
                'major_name' => 'Kedokteran',
                'faculty' => 'Fakultas Kedokteran',
                'description' => 'Program studi yang mempelajari ilmu tentang kesehatan manusia, diagnosis penyakit, dan pengobatan.',
                'field_of_study' => 'Kesehatan',
                'career_prospects' => 'Dokter, Peneliti Medis, Konsultan Kesehatan',
                'is_active' => true,
            ],
            [
                'major_name' => 'Ilmu Hukum',
                'faculty' => 'Fakultas Hukum',
                'description' => 'Program studi yang mempelajari hukum dan sistem peradilan.',
                'field_of_study' => 'Sosial',
                'career_prospects' => 'Pengacara, Hakim, Jaksa, Konsultan Hukum, Legal Staff',
                'is_active' => true,
            ],
            [
                'major_name' => 'Psikologi',
                'faculty' => 'Fakultas Psikologi',
                'description' => 'Program studi yang mempelajari perilaku dan mental manusia.',
                'field_of_study' => 'Sosial',
                'career_prospects' => 'Psikolog, Konselor, HR Specialist, Peneliti',
                'is_active' => true,
            ],
            [
                'major_name' => 'Teknik Sipil',
                'faculty' => 'Fakultas Teknik',
                'description' => 'Program studi yang mempelajari perencanaan, desain, dan konstruksi infrastruktur.',
                'field_of_study' => 'Teknik',
                'career_prospects' => 'Civil Engineer, Project Manager, Konsultan Konstruksi',
                'is_active' => true,
            ],
            [
                'major_name' => 'Sastra Inggris',
                'faculty' => 'Fakultas Ilmu Budaya',
                'description' => 'Program studi yang mempelajari bahasa, sastra, dan budaya Inggris.',
                'field_of_study' => 'Bahasa',
                'career_prospects' => 'Penerjemah, Editor, Pengajar Bahasa Inggris, Penulis',
                'is_active' => true,
            ],
            [
                'major_name' => 'Ilmu Komunikasi',
                'faculty' => 'Fakultas Ilmu Sosial dan Politik',
                'description' => 'Program studi yang mempelajari teori dan praktik komunikasi dalam berbagai konteks.',
                'field_of_study' => 'Sosial',
                'career_prospects' => 'Public Relations, Jurnalis, Content Creator, Marketing Communication',
                'is_active' => true,
            ],
        ];

        foreach ($collegeMajors as $major)
        {
            CollegeMajor::create($major);
        }
    }
}
