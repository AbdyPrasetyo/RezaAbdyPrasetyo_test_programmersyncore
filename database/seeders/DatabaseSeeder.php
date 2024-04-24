<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Buat pengguna dengan peran admin
        User::create([
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role' => 1, // role admin
        ]);

        // Buat pengguna dengan peran user
        User::create([
            'email' => 'user@example.com',
            'password' => bcrypt('user123'),
            'role' => 2, // role user
        ]);

    }
}
