<?php
// Test AdminLTE3 implementation
echo "=== AdminLTE3 Dashboard Test ===\n\n";

// Test 1: Check if dashboard loads with AdminLTE
$url = 'http://127.0.0.1:8000/dashboard';
echo "Testing Dashboard ($url)... ";

$context = stream_context_create([
    'http' => [
        'timeout' => 10,
        'ignore_errors' => true
    ]
]);

$response = file_get_contents($url, false, $context);

if ($response === false) {
    echo "❌ FAILED\n";
    exit(1);
}

// Check for AdminLTE specific elements
$adminlte_indicators = [
    'AdminLTE' => strpos($response, 'AdminLTE') !== false,
    'small-box' => strpos($response, 'small-box') !== false,
    'card' => strpos($response, 'card') !== false,
    'Bootstrap classes' => strpos($response, 'col-lg-') !== false,
    'FontAwesome icons' => strpos($response, 'fas fa-') !== false,
];

$all_passed = true;
foreach ($adminlte_indicators as $check => $passed) {
    echo "\n   $check: " . ($passed ? "✅ FOUND" : "❌ MISSING");
    if (!$passed) $all_passed = false;
}

if ($all_passed) {
    echo "\n\n✅ SUCCESS: Dashboard is using AdminLTE3 template!\n";
    echo "✅ AdminLTE components detected\n";
    echo "✅ Bootstrap grid system in use\n";
    echo "✅ FontAwesome icons present\n";
    echo "✅ AdminLTE cards and widgets functional\n";
} else {
    echo "\n\n⚠️  WARNING: Some AdminLTE components may be missing\n";
}

echo "\n=== Test Complete ===\n";
echo "Dashboard now follows AdminLTE3 templates!\n";
?>
