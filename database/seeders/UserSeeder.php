<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => Hash::make('177013'),
        ]);

        // Regular users
        User::factory(10)->create();
    }
}
