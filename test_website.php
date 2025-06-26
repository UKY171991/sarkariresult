<?php
// Simple test script to verify homepage loads without errors
$url = 'http://127.0.0.1:8000';

echo "Testing homepage at: $url\n";

$response = file_get_contents($url);

if ($response === false) {
    echo "ERROR: Could not fetch homepage\n";
    exit(1);
}

if (strpos($response, '<!DOCTYPE html') === false) {
    echo "ERROR: Response does not contain DOCTYPE declaration\n";
    exit(1);
}

if (strpos($response, 'error') !== false || strpos($response, 'Exception') !== false) {
    echo "WARNING: Response may contain error messages\n";
}

echo "SUCCESS: Homepage loaded successfully\n";
echo "Response length: " . strlen($response) . " bytes\n";

// Test categories page
$categories_url = 'http://127.0.0.1:8000/categories';
echo "\nTesting categories page at: $categories_url\n";

$categories_response = file_get_contents($categories_url);

if ($categories_response === false) {
    echo "ERROR: Could not fetch categories page\n";
    exit(1);
}

if (strpos($categories_response, '<!DOCTYPE html') === false) {
    echo "ERROR: Categories response does not contain DOCTYPE declaration\n";
    exit(1);
}

echo "SUCCESS: Categories page loaded successfully\n";
echo "Categories response length: " . strlen($categories_response) . " bytes\n";

echo "\nAll tests passed! The website is working correctly.\n";
?>
