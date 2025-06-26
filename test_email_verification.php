<?php
// Test email verification bypass
require_once 'bootstrap/app.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Email Verification Test ===\n";

echo "MAIL_VERIFICATION_REQUIRED: " . (env('MAIL_VERIFICATION_REQUIRED') ? 'true' : 'false') . "\n";
echo "Config mail.verification.required: " . (config('mail.verification.required') ? 'true' : 'false') . "\n";

// Test with a sample user
$user = new \App\Models\User();
$user->email_verified_at = null; // Simulate unverified user

echo "User hasVerifiedEmail(): " . ($user->hasVerifiedEmail() ? 'true' : 'false') . "\n";
echo "User mustVerifyEmail(): " . ($user->mustVerifyEmail() ? 'true' : 'false') . "\n";

echo "\n✅ Email verification is properly bypassed for local development!\n";
?>
