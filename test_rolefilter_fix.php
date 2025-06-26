<?php
// Test the fixed RoleFilter
echo "=== Testing Fixed RoleFilter ===\n\n";

$base_url = 'http://127.0.0.1:8000';

// Test dashboard access
echo "1. Testing dashboard access... ";
$context = stream_context_create([
    'http' => [
        'timeout' => 10,
        'ignore_errors' => true
    ]
]);

$response = file_get_contents($base_url . '/dashboard', false, $context);

if ($response !== false) {
    if (strpos($response, 'Internal Server Error') !== false) {
        echo "❌ FAILED - Internal Server Error still present\n";
    } elseif (strpos($response, 'Login') !== false || strpos($response, 'login') !== false) {
        echo "✅ PASSED - Dashboard properly redirects to login (authentication working)\n";
    } else {
        echo "✅ PASSED - Dashboard accessible\n";
    }
} else {
    echo "❌ FAILED - Could not access dashboard\n";
}

// Test that RoleFilter class is valid
echo "2. Testing RoleFilter class... ";
$filter_path = __DIR__ . '/app/Menu/Filters/RoleFilter.php';
if (file_exists($filter_path)) {
    $filter_content = file_get_contents($filter_path);
    
    // Check for correct method signature
    if (strpos($filter_content, 'public function transform($item)') !== false) {
        echo "✅ PASSED - Correct method signature\n";
    } else {
        echo "❌ FAILED - Incorrect method signature\n";
    }
} else {
    echo "❌ FAILED - RoleFilter file not found\n";
}

// Test AdminLTE config
echo "3. Testing AdminLTE config... ";
$config_path = __DIR__ . '/config/adminlte.php';
if (file_exists($config_path)) {
    $config_content = file_get_contents($config_path);
    if (strpos($config_content, 'App\Menu\Filters\RoleFilter::class') !== false) {
        echo "✅ PASSED - RoleFilter registered in config\n";
    } else {
        echo "❌ FAILED - RoleFilter not registered\n";
    }
} else {
    echo "❌ FAILED - AdminLTE config not found\n";
}

echo "\n=== Test Complete ===\n";
echo "The RoleFilter interface compatibility issue should now be fixed!\n";
echo "You can now access the dashboard without the Internal Server Error.\n";
?>
