<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Contoh membuat 10 user acak
        // User::factory(10)->create();

        // Membuat user admin default
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // password harus di-hash
            'role' => 'admin',
        ]);

        // Membuat user teknisi
        User::factory()->create([
            'name' => 'Teknisi User',
            'email' => 'teknisi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'teknisi',
        ]);

        // Membuat user manager
        User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'manager',
        ]);
    }
}