<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@sarkariresult.com',
            'role' => 'admin',
            'password' => bcrypt('SecureAdmin@2025'),
            'email_verified_at' => now(),
        ]);

        // Run other seeders
        $this->call([
            CategorySeeder::class,
            JobPostSeeder::class,
        ]);
    }
}
