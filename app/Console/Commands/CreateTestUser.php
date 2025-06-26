<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateTestUser extends Command
{
    protected $signature = 'user:create-test';
    protected $description = 'Create a test user for admin access';

    public function handle()
    {
        $existingUser = User::where('email', 'admin@test.com')->first();
        
        if ($existingUser) {
            $this->info('Test user already exists: admin@test.com');
            return;
        }

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $this->info('Test user created successfully!');
        $this->info('Email: admin@test.com');
        $this->info('Password: password');
    }
}
