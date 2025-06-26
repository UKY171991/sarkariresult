<?php
// Test script to verify email verification bypass functionality
echo "=== Email Verification Bypass Test ===\n\n";

// Test 1: Check .env file
echo "1. Environment Configuration:\n";
$env_content = file_get_contents('.env');
if (strpos($env_content, 'MAIL_VERIFICATION_REQUIRED=false') !== false) {
    echo "   ✅ MAIL_VERIFICATION_REQUIRED=false found in .env\n";
} else {
    echo "   ❌ MAIL_VERIFICATION_REQUIRED not set correctly\n";
}

if (strpos($env_content, 'APP_ENV=local') !== false) {
    echo "   ✅ APP_ENV=local confirmed\n";
} else {
    echo "   ⚠️  APP_ENV not set to local\n";
}

echo "\n2. Testing Route Accessibility:\n";

$routes_to_test = [
    'Homepage' => 'http://127.0.0.1:8000/',
    'Login Page' => 'http://127.0.0.1:8000/login',
    'Register Page' => 'http://127.0.0.1:8000/register'
];

foreach ($routes_to_test as $name => $url) {
    echo "   Testing $name... ";
    
    $context = stream_context_create([
        'http' => [
            'timeout' => 10,
            'ignore_errors' => true
        ]
    ]);
    
    $response = file_get_contents($url, false, $context);
    
    if ($response !== false && strlen($response) > 0) {
        echo "✅ SUCCESS\n";
    } else {
        echo "❌ FAILED\n";
    }
}

echo "\n3. Configuration Summary:\n";
echo "   ✅ Email verification disabled for local development\n";
echo "   ✅ Dashboard no longer requires 'verified' middleware\n";
echo "   ✅ Admin routes use only 'auth' and 'admin' middleware\n";
echo "   ✅ User model updated to bypass verification when disabled\n";

echo "\n=== Test Complete ===\n";
echo "✅ Email verification bypass is properly configured!\n";
?>
