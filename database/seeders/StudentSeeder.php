<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the users except admin
        $users = User
            ::where('email', '!=', 'admin@example.com')->get();

        foreach ($users as $user)
        {
            Student::create([
                'user_id' => $user->id,
                'NIS' => mt_rand(100000, 999999),
                'name' => fake()->name(),
                'gender' => fake()->randomElement(['man', 'woman']),
                'school_origin' => fake()->randomElement([
                    'SMAN 1 Jakarta',
                    'SMAN 8 Jakarta',
                    'SMAN 3 Bandung',
                    'SMAN 5 Surabaya',
                    'SMAN 2 Yogyakarta',
                    'SMA Labschool Jakarta',
                    'SMKN 1 Jakarta',
                    'SMKN 4 Bandung',
                    'SMK Telkom Malang',
                    'SMK Negeri 2 Surabaya'
                ]),
                'school_type' => $school_type = fake()->randomElement(['high_school', 'vocational_school']),
                'school_major' => $school_type === 'high_school'
                    ? fake()->randomElement(['IPA', 'IPS', 'Bahasa'])
                    : fake()->randomElement([
                        'Teknik Komputer dan Jaringan',
                        'Rekayasa Perangkat Lunak',
                        'Akuntansi',
                        'Administrasi Perkantoran',
                        'Multimedia'
                    ]),
                'graduation_year' => fake()->numberBetween(2020, 2023),
            ]);
        }
    }
}
