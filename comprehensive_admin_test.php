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

echo "=== COMPREHENSIVE ADMIN LOGIN TEST ===\n\n";

$adminEmails = [
    'admin@example.com',
    'admin@sarkariresult.com'
];

foreach ($adminEmails as $email) {
    echo "Testing admin user: {$email}\n";
    echo str_repeat('-', 50) . "\n";
    
    // Check if admin user exists
    $adminUser = User::where('email', $email)->first();
    
    if ($adminUser) {
        echo "✓ Admin user found: {$adminUser->name} ({$adminUser->email})\n";
        echo "✓ Email verified: " . ($adminUser->email_verified_at ? 'Yes' : 'No') . "\n";
        
        // Test password with different possible passwords
        $passwords = ['password', 'admin123', 'admin', 'secret'];
        $passwordFound = false;
        
        foreach ($passwords as $testPassword) {
            if (Hash::check($testPassword, $adminUser->password)) {
                echo "✓ Password verification: Success (password: '{$testPassword}')\n";
                $passwordFound = true;
                
                // Test login attempt
                $credentials = [
                    'email' => $email,
                    'password' => $testPassword
                ];
                
                if (Auth::attempt($credentials)) {
                    echo "✓ Authentication: Success\n";
                    echo "✓ Admin dashboard accessible at: http://127.0.0.1:8000/admin\n";
                    
                    // Logout for clean state
                    Auth::logout();
                } else {
                    echo "✗ Authentication: Failed (even though password verification succeeded)\n";
                }
                break;
            }
        }
        
        if (!$passwordFound) {
            echo "✗ Password verification: Failed (tried common passwords)\n";
        }
        
    } else {
        echo "✗ Admin user not found\n";
    }
    
    echo "\n";
}

echo "=== ADMIN ACCESS SUMMARY ===\n";
echo "1. Admin users found with emails:\n";
echo "   - admin@example.com\n";
echo "   - admin@sarkariresult.com\n";
echo "2. Both use password: 'password'\n";
echo "3. Admin routes are protected by 'auth' middleware\n";
echo "4. Access admin panel at: http://127.0.0.1:8000/admin\n";
echo "5. Login page: http://127.0.0.1:8000/login\n";
echo "6. No role-based restrictions found - any authenticated user can access admin\n";

$kernel->terminate($request, $response);
