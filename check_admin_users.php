<?php

require 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\User;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Request::capture();
$response = $kernel->handle($request);

echo "Checking all admin users in the database...\n\n";

$adminUsers = User::whereIn('email', [
    'admin@example.com',
    'admin@sarkariresult.com'
])->get();

if ($adminUsers->count() > 0) {
    echo "Found " . $adminUsers->count() . " admin user(s):\n";
    foreach ($adminUsers as $user) {
        echo "- {$user->name} ({$user->email})\n";
        echo "  Email verified: " . ($user->email_verified_at ? 'Yes' : 'No') . "\n";
        echo "  Created: {$user->created_at}\n\n";
    }
} else {
    echo "No admin users found with standard email addresses.\n";
    echo "Checking all users in the database:\n\n";
    
    $allUsers = User::all();
    foreach ($allUsers as $user) {
        echo "- {$user->name} ({$user->email})\n";
        echo "  Email verified: " . ($user->email_verified_at ? 'Yes' : 'No') . "\n";
        echo "  Created: {$user->created_at}\n\n";
    }
}

$kernel->terminate($request, $response);
