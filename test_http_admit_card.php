<?php

// Test admin admit card endpoints with cURL
echo "Testing Admin Admit Card Endpoints...\n";

$base_url = 'http://127.0.0.1:8000';
$admin_email = 'admin@sarkariresult.com';
$admin_password = 'SecureAdmin@2025'; // Correct seeded password

// Function to make HTTP requests with cookies
function makeRequest($url, $method = 'GET', $data = [], $cookies = '') {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    
    if ($cookies) {
        curl_setopt($ch, CURLOPT_COOKIE, $cookies);
    }
    
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }
    }
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    
    curl_close($ch);
    
    $headers = substr($response, 0, $header_size);
    $body = substr($response, $header_size);
    
    return [
        'http_code' => $http_code,
        'headers' => $headers,
        'body' => $body
    ];
}

try {
    // Step 1: Get login page to get CSRF token
    echo "1. Getting login page...\n";
    $response = makeRequest($base_url . '/login');
    echo "   Status: " . $response['http_code'] . "\n";
    
    // Extract CSRF token
    preg_match('/<input[^>]+name="_token"[^>]+value="([^"]+)"/', $response['body'], $matches);
    $csrf_token = $matches[1] ?? null;
    
    if (!$csrf_token) {
        echo "   Error: Could not find CSRF token\n";
        exit(1);
    }
    echo "   CSRF Token: " . substr($csrf_token, 0, 20) . "...\n";
    
    // Step 2: Login as admin
    echo "2. Logging in as admin...\n";
    $login_data = [
        '_token' => $csrf_token,
        'email' => $admin_email,
        'password' => $admin_password
    ];
    
    $response = makeRequest($base_url . '/login', 'POST', $login_data);
    echo "   Status: " . $response['http_code'] . "\n";
    
    if ($response['http_code'] !== 302) {
        echo "   Error: Login failed\n";
        echo "   Response body: " . substr($response['body'], 0, 500) . "\n";
        exit(1);
    }
    
    // Check if redirected to dashboard
    if (strpos($response['headers'], 'Location: ') !== false) {
        preg_match('/Location: (.+)/', $response['headers'], $matches);
        $redirect_url = trim($matches[1] ?? '');
        echo "   Redirected to: " . $redirect_url . "\n";
    }
    
    // Step 3: Access admin admit cards index
    echo "3. Accessing admin admit cards index...\n";
    $response = makeRequest($base_url . '/admin/admit-cards');
    echo "   Status: " . $response['http_code'] . "\n";
    
    if ($response['http_code'] !== 200) {
        echo "   Error: Could not access admin admit cards page\n";
        exit(1);
    }
    
    // Step 4: Get create admit card page
    echo "4. Getting create admit card page...\n";
    $response = makeRequest($base_url . '/admin/admit-cards/create');
    echo "   Status: " . $response['http_code'] . "\n";
    
    if ($response['http_code'] !== 200) {
        echo "   Error: Could not access create admit card page\n";
        exit(1);
    }
    
    // Extract new CSRF token from create form
    preg_match('/<input[^>]+name="_token"[^>]+value="([^"]+)"/', $response['body'], $matches);
    $csrf_token = $matches[1] ?? null;
    
    if (!$csrf_token) {
        echo "   Error: Could not find CSRF token in create form\n";
        exit(1);
    }
    echo "   New CSRF Token: " . substr($csrf_token, 0, 20) . "...\n";
    
    // Step 5: Submit admit card creation form
    echo "5. Creating new admit card...\n";
    $admit_card_data = [
        '_token' => $csrf_token,
        'job_post_id' => '1',
        'title' => 'Test Admit Card via HTTP - ' . date('Y-m-d H:i:s'),
        'description' => 'This is a test admit card created via HTTP request.',
        'organization' => 'HTTP Test Organization',
        'exam_date' => '2024-12-31',
        'download_link' => 'https://example.com/test-admit-card.pdf',
        'official_website' => 'https://example.com',
        'instructions' => 'Test instructions for HTTP test admit card.',
        'status' => 'active'
    ];
    
    $response = makeRequest($base_url . '/admin/admit-cards', 'POST', $admit_card_data);
    echo "   Status: " . $response['http_code'] . "\n";
    
    if ($response['http_code'] === 302) {
        echo "   ✓ SUCCESS: Admit card created successfully!\n";
        
        // Check redirect location
        if (strpos($response['headers'], 'Location: ') !== false) {
            preg_match('/Location: (.+)/', $response['headers'], $matches);
            $redirect_url = trim($matches[1] ?? '');
            echo "   Redirected to: " . $redirect_url . "\n";
        }
    } else {
        echo "   ✗ FAILED: HTTP " . $response['http_code'] . "\n";
        echo "   Response headers:\n" . $response['headers'] . "\n";
        echo "   Response body (first 1000 chars):\n" . substr($response['body'], 0, 1000) . "\n";
    }
    
    // Step 6: Verify by checking admin admit cards page again
    echo "6. Verifying admit card creation...\n";
    $response = makeRequest($base_url . '/admin/admit-cards');
    echo "   Status: " . $response['http_code'] . "\n";
    
    if (strpos($response['body'], 'HTTP Test Organization') !== false) {
        echo "   ✓ Admit card appears in the list\n";
    } else {
        echo "   ✗ Admit card not found in the list\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} finally {
    // Clean up cookies file
    if (file_exists('cookies.txt')) {
        unlink('cookies.txt');
    }
}

echo "\nTest completed.\n";
