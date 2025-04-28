<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universities = [
            [
                'name' => 'Universitas Indonesia',
                'status' => 'negeri',
                'city' => 'Depok',
                'province' => 'Jawa Barat',
                'description' => 'Universitas terkemuka di Indonesia yang didirikan pada tahun 1849.',
                'website' => 'https://www.ui.ac.id',
                'logo' => 'https://i.pinimg.com/236x/c6/27/83/c62783232ffa8098770395a72e03655e.jpg',
                'rating' => 4.8,
                'is_active' => true,
            ],
            [
                'name' => 'Institut Teknologi Bandung',
                'status' => 'negeri',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'description' => 'Perguruan tinggi teknik tertua di Indonesia yang didirikan pada tahun 1920.',
                'website' => 'https://www.itb.ac.id',
                'logo' => 'https://i.pinimg.com/236x/c6/27/83/c62783232ffa8098770395a72e03655e.jpg',
                'rating' => 4.7,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Gadjah Mada',
                'status' => 'negeri',
                'city' => 'Yogyakarta',
                'province' => 'D.I. Yogyakarta',
                'description' => 'Universitas negeri tertua di Indonesia yang didirikan pada tahun 1949.',
                'website' => 'https://www.ugm.ac.id',
                'logo' => 'https://i.pinimg.com/236x/c6/27/83/c62783232ffa8098770395a72e03655e.jpg',
                'rating' => 4.7,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Airlangga',
                'status' => 'negeri',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'description' => 'Universitas negeri tertua kedua di Indonesia.',
                'website' => 'https://www.unair.ac.id',
                'logo' => 'https://i.pinimg.com/236x/c6/27/83/c62783232ffa8098770395a72e03655e.jpg',
                'rating' => 4.5,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Diponegoro',
                'status' => 'negeri',
                'city' => 'Semarang',
                'province' => 'Jawa Tengah',
                'description' => 'Universitas negeri di Jawa Tengah yang didirikan pada tahun 1957.',
                'website' => 'https://www.undip.ac.id',
                'logo' => 'https://i.pinimg.com/236x/c6/27/83/c62783232ffa8098770395a72e03655e.jpg',
                'rating' => 4.4,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Bina Nusantara',
                'status' => 'swasta',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'description' => 'Universitas swasta terkemuka di Indonesia yang fokus pada teknologi informasi.',
                'website' => 'https://www.binus.ac.id',
                'logo' => 'https://i.pinimg.com/236x/c6/27/83/c62783232ffa8098770395a72e03655e.jpg',
                'rating' => 4.3,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Padjadjaran',
                'status' => 'negeri',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'description' => 'Universitas negeri yang didirikan pada tahun 1957.',
                'website' => 'https://www.unpad.ac.id',
                'logo' => 'https://i.pinimg.com/236x/c6/27/83/c62783232ffa8098770395a72e03655e.jpg',
                'rating' => 4.3,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Brawijaya',
                'status' => 'negeri',
                'city' => 'Malang',
                'province' => 'Jawa Timur',
                'description' => 'Universitas negeri di Jawa Timur yang didirikan pada tahun 1963.',
                'website' => 'https://www.ub.ac.id',
                'logo' => 'https://i.pinimg.com/236x/c6/27/83/c62783232ffa8098770395a72e03655e.jpg',
                'rating' => 4.2,
                'is_active' => true,
            ],
            [
                'name' => 'Institut Teknologi Sepuluh Nopember',
                'status' => 'negeri',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'description' => 'Perguruan tinggi teknik terkemuka di Jawa Timur.',
                'website' => 'https://www.its.ac.id',
                'logo' => 'https://i.pinimg.com/236x/c6/27/83/c62783232ffa8098770395a72e03655e.jpg',
                'rating' => 4.2,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Pelita Harapan',
                'status' => 'swasta',
                'city' => 'Tangerang',
                'province' => 'Banten',
                'description' => 'Universitas swasta Kristen yang didirikan pada tahun 1994.',
                'website' => 'https://www.uph.edu',
                'logo' => 'https://i.pinimg.com/236x/c6/27/83/c62783232ffa8098770395a72e03655e.jpg',
                'rating' => 4.0,
                'is_active' => true,
            ],
        ];

        foreach ($universities as $university)
        {
            University::create($university);
        }
    }
}
