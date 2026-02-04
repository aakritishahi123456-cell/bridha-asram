<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        User::create([
            'name' => 'Super Administrator',
            'email' => 'admin@buddhabhoomi.org',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create Admin for Surkhet
        User::create([
            'name' => 'Surkhet Admin',
            'email' => 'surkhet@buddhabhoomi.org',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create Admin for Jajarkot
        User::create([
            'name' => 'Jajarkot Admin',
            'email' => 'jajarkot@buddhabhoomi.org',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create some volunteer users
        User::create([
            'name' => 'Ram Bahadur Thapa',
            'email' => 'ram.thapa@example.com',
            'password' => Hash::make('password'),
            'role' => 'volunteer',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Sita Kumari Sharma',
            'email' => 'sita.sharma@example.com',
            'password' => Hash::make('password'),
            'role' => 'volunteer',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}