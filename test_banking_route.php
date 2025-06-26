<?php
// Test the banking-jobs route
$url = 'http://127.0.0.1:8000/jobs/banking-jobs';

echo "Testing route: $url\n";

$context = stream_context_create([
    'http' => [
        'timeout' => 10,
        'ignore_errors' => true
    ]
]);

$response = file_get_contents($url, false, $context);

if ($response === false) {
    echo "ERROR: Could not fetch the page\n";
    
    // Check if it's a connection issue
    $headers = get_headers($url, 1);
    if ($headers === false) {
        echo "Connection failed - server might be down\n";
    } else {
        echo "Headers received: " . print_r($headers, true) . "\n";
    }
} else {
    echo "SUCCESS: Page loaded successfully\n";
    echo "Response length: " . strlen($response) . " bytes\n";
    
    // Check for DOCTYPE
    if (strpos($response, '<!DOCTYPE html') !== false) {
        echo "✓ Contains proper DOCTYPE\n";
    } else {
        echo "⚠ No DOCTYPE found\n";
    }
    
    // Check for errors
    if (strpos($response, 'error') !== false || strpos($response, 'Exception') !== false) {
        echo "⚠ May contain error messages\n";
    } else {
        echo "✓ No obvious errors detected\n";
    }
}
?>
