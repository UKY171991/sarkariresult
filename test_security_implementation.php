<?php

require_once 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Initialize Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Admin Security Test ===\n\n";

// Test 1: Check if role column was added
echo "1. Testing role column in users table:\n";
$users = User::all();
foreach ($users as $user) {
    echo "   - {$user->email}: role = '{$user->role}'\n";
}

// Test 2: Check admin users
echo "\n2. Admin users found:\n";
$admins = User::where('role', 'admin')->get();
foreach ($admins as $admin) {
    echo "   - {$admin->name} ({$admin->email})\n";
}

// Test 3: Check helper methods
echo "\n3. Testing helper methods:\n";
$adminUser = User::where('role', 'admin')->first();
if ($adminUser) {
    echo "   - isAdmin(): " . ($adminUser->isAdmin() ? 'true' : 'false') . "\n";
    echo "   - isUser(): " . ($adminUser->isUser() ? 'true' : 'false') . "\n";
}

$regularUser = User::where('role', 'user')->first();
if ($regularUser) {
    echo "   - Regular user isAdmin(): " . ($regularUser->isAdmin() ? 'true' : 'false') . "\n";
    echo "   - Regular user isUser(): " . ($regularUser->isUser() ? 'true' : 'false') . "\n";
}

echo "\n✅ Security implementation test completed!\n";
echo "\nNew admin credentials:\n";
echo "Email: admin@sarkariresult.com\n";
echo "Password: SecureAdmin@2025\n";
echo "\nAdmin panel: http://127.0.0.1:8000/admin\n";
