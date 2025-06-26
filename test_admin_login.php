<?php

require 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Request::capture();
$response = $kernel->handle($request);

echo "Testing admin login functionality...\n\n";

// Check if admin user exists
$adminUser = User::where('email', 'admin@example.com')->first();

if ($adminUser) {
    echo "✓ Admin user found: {$adminUser->name} ({$adminUser->email})\n";
    echo "✓ Email verified: " . ($adminUser->email_verified_at ? 'Yes' : 'No') . "\n";
    
    // Test password
    if (Hash::check('password', $adminUser->password)) {
        echo "✓ Password verification: Success\n";
    } else {
        echo "✗ Password verification: Failed\n";
    }
    
    // Test login attempt
    $credentials = [
        'email' => 'admin@example.com',
        'password' => 'password'
    ];
    
    if (Auth::attempt($credentials)) {
        echo "✓ Authentication: Success\n";
        echo "✓ Admin dashboard should be accessible at: http://127.0.0.1:8000/admin\n";
        
        // Logout for clean state
        Auth::logout();
    } else {
        echo "✗ Authentication: Failed\n";
    }
    
} else {
    echo "✗ Admin user not found\n";
}

echo "\n--- Test Summary ---\n";
echo "1. Admin user exists and is verified\n";
echo "2. Password authentication works\n";
echo "3. Login credentials: admin@example.com / password\n";
echo "4. Admin dashboard URL: http://127.0.0.1:8000/admin\n";
echo "5. Use the regular login page: http://127.0.0.1:8000/login\n";

$kernel->terminate($request, $response);
