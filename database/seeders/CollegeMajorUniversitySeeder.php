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
        // Daftar ini didasarkan pada CollegeMajorSeeder dan UniversitySeeder yang telah dibuat sebelumnya.
        // Pastikan semua nama universitas di sini SESUAI dengan yang ada di UniversitySeeder.php
        $majorUniversityMapping = [
            'Teknik Informatika' => ['Universitas Indonesia', 'Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'Institut Teknologi Sepuluh Nopember', 'Universitas Bina Nusantara', 'Universitas Telkom', 'IPB University', 'Universitas Brawijaya', 'Universitas Diponegoro', 'Universitas Sebelas Maret', 'Politeknik Elektronika Negeri Surabaya', 'Universitas Dian Nuswantoro', 'Universitas Atma Jaya Yogyakarta', 'Universitas Kristen Petra', 'Universitas Kristen Maranatha', 'Universitas Trisakti', 'UPN Veteran Yogyakarta'],
            'Sistem Informasi' => ['Universitas Indonesia', 'Institut Teknologi Sepuluh Nopember', 'Universitas Airlangga', 'Universitas Brawijaya', 'Universitas Bina Nusantara', 'Universitas Telkom', 'Universitas Gadjah Mada', 'Universitas Diponegoro', 'Universitas Islam Indonesia', 'Universitas Dian Nuswantoro', 'Universitas Kristen Petra', 'Universitas Atma Jaya Yogyakarta', 'Universitas Mercu Buana'],
            'Manajemen' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Diponegoro', 'Universitas Padjadjaran', 'Universitas Airlangga', 'Universitas Brawijaya', 'Universitas Bina Nusantara', 'Universitas Pelita Harapan', 'Universitas Katolik Parahyangan', 'Universitas Islam Indonesia', 'Universitas Sebelas Maret', 'Universitas Mercu Buana', 'Universitas Atma Jaya Yogyakarta', 'Universitas Kristen Petra', 'Universitas Muhammadiyah Yogyakarta', 'Universitas Trisakti', 'Universitas Bakrie', 'Universitas Ciputra', 'Universitas Bunda Mulia', 'Universitas Kristen Maranatha'],
            'Akuntansi' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Padjadjaran', 'Universitas Diponegoro', 'Universitas Brawijaya', 'Universitas Bina Nusantara', 'Universitas Islam Indonesia', 'Universitas Katolik Parahyangan', 'Universitas Pelita Harapan', 'Universitas Sebelas Maret', 'Universitas Kristen Petra', 'Universitas Atma Jaya Yogyakarta', 'Universitas Trisakti', 'Universitas Mercu Buana', 'Universitas Kristen Maranatha'],
            'Kedokteran' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Diponegoro', 'Universitas Padjadjaran', 'Universitas Brawijaya', 'Universitas Hasanuddin', 'Universitas Sumatera Utara', 'Universitas Sebelas Maret', 'Universitas Islam Indonesia', 'Universitas Pelita Harapan', 'Universitas Andalas', 'Universitas Sriwijaya', 'Universitas Kristen Maranatha', 'UPN Veteran Yogyakarta', 'Universitas Trisakti'], // UPNVY punya FK
            'Ilmu Hukum' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Diponegoro', 'Universitas Padjadjaran', 'Universitas Brawijaya', 'Universitas Hasanuddin', 'Universitas Islam Indonesia', 'Universitas Katolik Parahyangan', 'Universitas Pelita Harapan', 'Universitas Sebelas Maret', 'Universitas Andalas', 'Universitas Sumatera Utara', 'Universitas Trisakti', 'Universitas Atma Jaya Yogyakarta', 'Universitas Muhammadiyah Yogyakarta', 'Universitas Pelita Harapan'],
            'Psikologi' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Diponegoro', 'Universitas Padjadjaran', 'Universitas Bina Nusantara', 'Universitas Islam Indonesia', 'Universitas Katolik Parahyangan', 'Universitas Pelita Harapan', 'Universitas Muhammadiyah Yogyakarta', 'Universitas Kristen Maranatha',], // Sanata Dharma juga kuat di Psikologi, jika ditambahkan
            'Teknik Sipil' => ['Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'Institut Teknologi Sepuluh Nopember', 'Universitas Diponegoro', 'Universitas Brawijaya', 'Universitas Indonesia', 'Universitas Sebelas Maret', 'Universitas Katolik Parahyangan', 'Universitas Pelita Harapan', 'Universitas Andalas', 'Universitas Trisakti', 'UPN Veteran Yogyakarta', 'Universitas Kristen Petra'],
            'Sastra Inggris' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Padjadjaran', 'Universitas Bina Nusantara', 'Universitas Kristen Petra', 'Universitas Negeri Yogyakarta', 'Universitas Pendidikan Indonesia', 'Universitas Pelita Harapan', 'Universitas Atma Jaya Yogyakarta', 'Universitas Sumatera Utara', 'Universitas Negeri Malang', 'Universitas Kristen Satya Wacana', 'Universitas Bunda Mulia'],
            'Ilmu Komunikasi' => ['Universitas Indonesia', 'Universitas Padjadjaran', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Diponegoro', 'Universitas Bina Nusantara', 'Universitas Pelita Harapan', 'Universitas Islam Indonesia', 'Universitas Atma Jaya Yogyakarta', 'Universitas Muhammadiyah Yogyakarta', 'Universitas Mercu Buana', 'Universitas Telkom', 'Universitas Bakrie', 'Universitas Bunda Mulia', 'Universitas Kristen Petra'],
            'Farmasi' => ['Universitas Indonesia', 'Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'Universitas Padjadjaran', 'Universitas Airlangga', 'Universitas Hasanuddin', 'Universitas Sumatera Utara', 'Universitas Islam Indonesia',], // Pancasila juga punya Farmasi, jika ditambahkan
            'Arsitektur' => ['Institut Teknologi Bandung', 'Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Diponegoro', 'Universitas Brawijaya', 'Institut Teknologi Sepuluh Nopember', 'Universitas Katolik Parahyangan', 'Universitas Pelita Harapan', 'Universitas Kristen Petra', 'Universitas Trisakti', 'Universitas Bina Nusantara', 'Universitas Kristen Maranatha'],
            'Teknik Mesin' => ['Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'Institut Teknologi Sepuluh Nopember', 'Universitas Indonesia', 'Universitas Diponegoro', 'Universitas Brawijaya', 'Universitas Sebelas Maret', 'Universitas Hasanuddin', 'Universitas Trisakti', 'UPN Veteran Yogyakarta', 'Politeknik Negeri Bandung'],
            'Teknik Elektro' => ['Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'Institut Teknologi Sepuluh Nopember', 'Universitas Indonesia', 'Universitas Diponegoro', 'Universitas Brawijaya', 'Universitas Telkom', 'Politeknik Elektronika Negeri Surabaya', 'Universitas Sebelas Maret', 'Universitas Trisakti', 'Politeknik Negeri Bandung', 'Universitas Kristen Maranatha'],
            'Teknik Industri' => ['Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'Institut Teknologi Sepuluh Nopember', 'Universitas Indonesia', 'Universitas Diponegoro', 'Universitas Brawijaya', 'Universitas Islam Indonesia', 'Universitas Katolik Parahyangan', 'Universitas Telkom', 'Universitas Bina Nusantara', 'Universitas Trisakti', 'Universitas Kristen Petra', 'UPN Veteran Yogyakarta'],
            'Desain Komunikasi Visual (DKV)' => ['Institut Teknologi Bandung', 'Universitas Bina Nusantara', 'Universitas Pelita Harapan', 'Universitas Kristen Petra', 'Universitas Telkom', 'Institut Teknologi Sepuluh Nopember', 'Universitas Mercu Buana', 'Universitas Trisakti', 'Universitas Ciputra', 'Universitas Bunda Mulia', 'Universitas Kristen Maranatha'],
            'Pendidikan Guru Sekolah Dasar (PGSD)' => ['Universitas Pendidikan Indonesia', 'Universitas Negeri Yogyakarta', 'Universitas Negeri Malang', 'Universitas Sebelas Maret', 'Universitas Negeri Semarang', 'Universitas Terbuka', 'Universitas Muhammadiyah Yogyakarta',], // Unesa, jika ditambahkan
            'Hubungan Internasional' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Padjadjaran', 'Universitas Airlangga', 'Universitas Diponegoro', 'Universitas Bina Nusantara', 'Universitas Katolik Parahyangan', 'Universitas Islam Indonesia', 'Universitas Pelita Harapan', 'Universitas Muhammadiyah Yogyakarta', 'Universitas Brawijaya', 'Universitas Bakrie'],
            'Ilmu Gizi' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'IPB University', 'Universitas Diponegoro', 'Universitas Airlangga', 'Universitas Brawijaya', 'Universitas Hasanuddin', 'Universitas Sebelas Maret',], // Respati punya Gizi, jika ditambahkan
            'Agribisnis' => ['IPB University', 'Universitas Gadjah Mada', 'Universitas Brawijaya', 'Universitas Padjadjaran', 'Universitas Sebelas Maret', 'Universitas Hasanuddin', 'Universitas Andalas', 'Universitas Sumatera Utara', 'UPN Veteran Yogyakarta', 'Universitas Muhammadiyah Yogyakarta'],
            'Statistika' => ['Institut Teknologi Sepuluh Nopember', 'IPB University', 'Universitas Gadjah Mada', 'Universitas Padjadjaran', 'Universitas Diponegoro', 'Universitas Brawijaya', 'Universitas Airlangga', 'Universitas Bina Nusantara', 'Universitas Terbuka', 'Universitas Islam Indonesia'],
            'Matematika' => ['Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'Universitas Indonesia', 'Institut Teknologi Sepuluh Nopember', 'Universitas Padjadjaran', 'Universitas Airlangga', 'Universitas Diponegoro', 'Universitas Brawijaya', 'IPB University', 'Universitas Sebelas Maret', 'Universitas Terbuka', 'Universitas Negeri Malang', 'Universitas Negeri Semarang'],
            'Biologi' => ['Universitas Indonesia', 'Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'IPB University', 'Universitas Airlangga', 'Universitas Padjadjaran', 'Universitas Brawijaya', 'Universitas Diponegoro', 'Universitas Sebelas Maret', 'Universitas Hasanuddin', 'Universitas Negeri Yogyakarta', 'Universitas Negeri Malang', 'Universitas Terbuka'],
            'Kimia' => ['Institut Teknologi Bandung', 'Universitas Indonesia', 'Universitas Gadjah Mada', 'Institut Teknologi Sepuluh Nopember', 'Universitas Padjadjaran', 'Universitas Airlangga', 'Universitas Brawijaya', 'IPB University', 'Universitas Sebelas Maret', 'Universitas Negeri Malang', 'Universitas Diponegoro'],
            'Fisika' => ['Institut Teknologi Bandung', 'Universitas Indonesia', 'Universitas Gadjah Mada', 'Institut Teknologi Sepuluh Nopember', 'Universitas Padjadjaran', 'Universitas Airlangga', 'Universitas Brawijaya', 'Universitas Diponegoro', 'IPB University', 'Universitas Negeri Malang'],
            'Teknik Lingkungan' => ['Institut Teknologi Bandung', 'Institut Teknologi Sepuluh Nopember', 'Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Diponegoro', 'Universitas Brawijaya', 'Universitas Airlangga', 'Universitas Islam Indonesia', 'Universitas Bakrie', 'Universitas Trisakti', 'UPN Veteran Yogyakarta',], // Unpas, jika ditambahkan
            'Keperawatan' => ['Universitas Indonesia', 'Universitas Padjadjaran', 'Universitas Airlangga', 'Universitas Gadjah Mada', 'Universitas Brawijaya', 'Universitas Diponegoro', 'Universitas Hasanuddin', 'Universitas Pelita Harapan', 'Universitas Muhammadiyah Yogyakarta', 'Universitas Kristen Maranatha',], // Respati punya Keperawatan
            'Kesehatan Masyarakat' => ['Universitas Indonesia', 'Universitas Airlangga', 'Universitas Gadjah Mada', 'Universitas Diponegoro', 'Universitas Hasanuddin', 'Universitas Padjadjaran', 'Universitas Sumatera Utara', 'Universitas Sebelas Maret', 'Universitas Andalas',], // Respati punya Kesmas
            'Sosiologi' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Padjadjaran', 'Universitas Diponegoro', 'Universitas Brawijaya', 'Universitas Sebelas Maret', 'Universitas Hasanuddin', 'Universitas Negeri Semarang', 'Universitas Negeri Yogyakarta'],
            'Antropologi' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Padjadjaran', 'Universitas Airlangga', 'Universitas Hasanuddin', 'Universitas Brawijaya', 'Universitas Diponegoro', 'Universitas Udayana'],
            'Ilmu Politik' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Padjadjaran', 'Universitas Diponegoro', 'Universitas Brawijaya', 'Universitas Hasanuddin', 'Universitas Sebelas Maret', 'Universitas Muhammadiyah Yogyakarta', 'Universitas Bakrie'],
            'Sastra Indonesia' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Padjadjaran', 'Universitas Diponegoro', 'Universitas Airlangga', 'Universitas Negeri Yogyakarta', 'Universitas Pendidikan Indonesia', 'Universitas Sebelas Maret', 'Universitas Hasanuddin', 'Universitas Negeri Malang', 'Universitas Negeri Semarang'],
            'Perhotelan dan Pariwisata' => ['Universitas Pelita Harapan', 'Universitas Kristen Petra', 'Universitas Bina Nusantara', 'Universitas Ciputra', 'Universitas Bunda Mulia', 'Universitas Trisakti', 'Sekolah Tinggi Pariwisata Bandung (NHI)'], // NHI jika dianggap univ
            'Teknologi Pangan' => ['IPB University', 'Universitas Gadjah Mada', 'Universitas Brawijaya', 'Universitas Padjadjaran', 'Universitas Hasanuddin', 'Universitas Katolik Widya Mandala Surabaya',], // Unpas punya Tekpang
            'Kedokteran Gigi' => ['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Airlangga', 'Universitas Padjadjaran', 'Universitas Brawijaya', 'Universitas Hasanuddin', 'Universitas Sumatera Utara', 'Universitas Trisakti', 'Universitas Kristen Maranatha',], // Moestopo, jika ditambahkan
            'Teknik Perminyakan' => ['Institut Teknologi Bandung', 'Universitas Trisakti', 'UPN Veteran Yogyakarta',], // Univ Pertamina, jika ditambahkan
            'Teknik Pertambangan' => ['Institut Teknologi Bandung', 'UPN Veteran Yogyakarta', 'Universitas Trisakti', 'Universitas Hasanuddin', 'Universitas Sriwijaya',], // Unisba, jika ditambahkan
            'Teknik Geologi' => ['Institut Teknologi Bandung', 'Universitas Gadjah Mada', 'Universitas Padjadjaran', 'Universitas Diponegoro', 'UPN Veteran Yogyakarta', 'Universitas Trisakti', 'Universitas Hasanuddin'],
            'Ilmu Kelautan' => ['IPB University', 'Universitas Diponegoro', 'Universitas Hasanuddin', 'Universitas Brawijaya', 'Institut Teknologi Sepuluh Nopember', 'Universitas Padjadjaran', 'Universitas Udayana', 'Universitas Sriwijaya',], // UNRI, jika ditambahkan
            'Administrasi Bisnis/Niaga' => ['Universitas Indonesia', 'Universitas Padjadjaran', 'Universitas Diponegoro', 'Universitas Brawijaya', 'Universitas Gadjah Mada', 'Universitas Telkom', 'Universitas Katolik Parahyangan', 'Universitas Atma Jaya Yogyakarta', 'Politeknik Negeri Bandung', 'Universitas Bina Nusantara', 'Universitas Mercu Buana'],
            'Pendidikan Bahasa Inggris' => ['Universitas Pendidikan Indonesia', 'Universitas Negeri Yogyakarta', 'Universitas Negeri Malang', 'Universitas Negeri Semarang', 'Universitas Sebelas Maret', 'Universitas Kristen Satya Wacana',  'Universitas Katolik Widya Mandala Surabaya', 'Universitas Terbuka'],
        ];

        DB::table('college_major_university')->delete(); // Hapus data lama untuk menghindari duplikasi jika seeder dijalankan berulang

        foreach ($majorUniversityMapping as $majorName => $universityNames)
        {
            $major = CollegeMajor::where('major_name', $majorName)->first();
            if (!$major)
            {
                echo "Jurusan tidak ditemukan: " . $majorName . ". Harap pastikan ada di CollegeMajorSeeder.\n";
                continue;
            }

            foreach ($universityNames as $uniName)
            {
                $university = University::where('name', $uniName)->first();
                if (!$university)
                {
                    // Pesan ini seharusnya tidak muncul lagi jika semua universitas sudah ada di UniversitySeeder
                    echo "Universitas tidak ditemukan: " . $uniName . " untuk jurusan " . $majorName . ". Harap pastikan ada di UniversitySeeder.\n";
                    continue;
                }

                // Cek apakah kombinasi sudah ada (tidak perlu jika sudah ada delete di atas, tapi sebagai pengaman tambahan)
                $exists = DB::table('college_major_university')
                    ->where('college_major_id', $major->id)
                    ->where('university_id', $university->id)
                    ->exists();

                if (!$exists)
                {
                    DB::table('college_major_university')->insert([
                        'college_major_id' => $major->id,
                        'university_id' => $university->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        echo "CollegeMajorUniversitySeeder selesai dijalankan.\n";
    }
}
