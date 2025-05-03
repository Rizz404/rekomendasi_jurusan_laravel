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
            'role' => "admin",
            'profile_picture' => "https://i.pinimg.com/736x/c6/ee/a1/c6eea122496fbe5aadc69231fddd5e2e.jpg"
        ]);

        // Regular users
        User::factory(10)->create();
    }
}
