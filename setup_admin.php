<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Setting up admin user...\n";

try {
    // First, check existing user
    $user = App\Models\User::where('email', 'admin@sarkariresult.com')->first();
    
    if ($user) {
        echo "Found existing user: " . $user->email . "\n";
        echo "Current role: " . ($user->role ?? 'null') . "\n";
        
        // Update role if necessary
        if ($user->role !== 'admin') {
            $user->role = 'admin';
            $user->save();
            echo "✓ Updated user role to 'admin'\n";
        } else {
            echo "✓ User already has admin role\n";
        }
    } else {
        echo "Creating new admin user...\n";
        $user = App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@sarkariresult.com',
            'password' => bcrypt('SecureAdmin@2025'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        echo "✓ Created admin user: " . $user->email . "\n";
    }
    
    // Verify the user
    $user = App\Models\User::where('email', 'admin@sarkariresult.com')->first();
    echo "\nFinal verification:\n";
    echo "ID: " . $user->id . "\n";
    echo "Name: " . $user->name . "\n";
    echo "Email: " . $user->email . "\n";
    echo "Role: " . $user->role . "\n";
    echo "Email verified: " . ($user->email_verified_at ? 'Yes' : 'No') . "\n";
    
    // Check if isAdmin() method works
    echo "isAdmin() method: " . ($user->isAdmin() ? 'true' : 'false') . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
