<?php

/**
 * Direct test for Admin Admit Card functionality
 * Bypassing the admin dashboard to focus on the specific issue
 */

echo "=== DIRECT ADMIN ADMIT CARD TEST ===\n";
echo "Testing: " . date('Y-m-d H:i:s') . "\n\n";

$base_url = 'http://127.0.0.1:8000';
$admin_email = 'admin@sarkariresult.com';
$admin_password = 'SecureAdmin@2025';
$cookie_file = 'direct_test_cookies.txt';

if (file_exists($cookie_file)) {
    unlink($cookie_file);
}

function makeHttpRequest($url, $method = 'GET', $data = [], $headers = []) {
    global $cookie_file;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($ch, CURLOPT_USERAGENT, 'DirectAdminTest/1.0');
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
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
    
    return [
        'http_code' => $http_code,
        'headers' => substr($response, 0, $header_size),
        'body' => substr($response, $header_size)
    ];
}

function extractCsrfToken($html) {
    if (preg_match('/<meta name="csrf-token" content="([^"]+)"/', $html, $matches)) {
        return $matches[1];
    }
    if (preg_match('/<input[^>]+name="_token"[^>]+value="([^"]+)"/', $html, $matches)) {
        return $matches[1];
    }
    return null;
}

try {
    echo "1. Login process...\n";
    
    // Get login page
    $response = makeHttpRequest($base_url . '/login');
    if ($response['http_code'] !== 200) {
        throw new Exception("Cannot access login page");
    }
    
    $csrf_token = extractCsrfToken($response['body']);
    if (!$csrf_token) {
        throw new Exception("Cannot find CSRF token");
    }
    
    // Login
    $login_data = [
        '_token' => $csrf_token,
        'email' => $admin_email,
        'password' => $admin_password,
    ];
    
    $response = makeHttpRequest($base_url . '/login', 'POST', $login_data);
    if ($response['http_code'] !== 302) {
        throw new Exception("Login failed");
    }
    echo "✓ Logged in successfully\n\n";
    
    echo "2. Testing admin admit cards index directly...\n";
    $response = makeHttpRequest($base_url . '/admin/admit-cards');
    echo "Response code: " . $response['http_code'] . "\n";
    
    if ($response['http_code'] === 200) {
        echo "✓ Admin admit cards accessible!\n";
        
        // Look for existing admit cards in the response
        if (strpos($response['body'], 'admit') !== false) {
            echo "✓ Page contains admit card content\n";
        }
        
        if (strpos($response['body'], 'Create New Admit Card') !== false || strpos($response['body'], 'create') !== false) {
            echo "✓ Create button/link found\n";
        }
        
    } elseif ($response['http_code'] === 302) {
        // Check where it redirects
        if (preg_match('/Location:\s*(.+)/', $response['headers'], $matches)) {
            $redirect = trim($matches[1]);
            echo "✗ Redirects to: " . $redirect . "\n";
            if (strpos($redirect, 'login') !== false) {
                echo "✗ Authentication failed\n";
            }
        }
        throw new Exception("Access denied");
    } else {
        echo "✗ Error accessing admin admit cards\n";
        echo "Headers:\n" . $response['headers'] . "\n";
        throw new Exception("HTTP " . $response['http_code']);
    }
    
    echo "\n3. Testing admin admit cards create page...\n";
    $response = makeHttpRequest($base_url . '/admin/admit-cards/create');
    echo "Response code: " . $response['http_code'] . "\n";
    
    if ($response['http_code'] === 200) {
        echo "✓ Create form accessible!\n";
        
        $csrf_token = extractCsrfToken($response['body']);
        if (!$csrf_token) {
            throw new Exception("Cannot find CSRF token on create form");
        }
        echo "✓ CSRF token found\n";
        
        // Test form submission
        echo "\n4. Testing form submission...\n";
        $test_data = [
            '_token' => $csrf_token,
            'job_post_id' => '1',
            'title' => 'Direct Test Admit Card - ' . date('H:i:s'),
            'description' => 'Created by direct test',
            'organization' => 'Direct Test Org',
            'exam_date' => '2024-12-31',
            'download_link' => 'https://example.com/direct-test.pdf',
            'official_website' => 'https://example.com',
            'instructions' => 'Direct test instructions',
            'status' => 'active'
        ];
        
        $response = makeHttpRequest($base_url . '/admin/admit-cards', 'POST', $test_data);
        echo "POST response code: " . $response['http_code'] . "\n";
        
        if ($response['http_code'] === 302) {
            echo "✓ SUCCESS! Form submission worked\n";
            
            if (preg_match('/Location:\s*(.+)/', $response['headers'], $matches)) {
                $redirect = trim($matches[1]);
                echo "✓ Redirected to: " . $redirect . "\n";
            }
            
            echo "\n5. Verifying creation...\n";
            $response = makeHttpRequest($base_url . '/admin/admit-cards');
            if ($response['http_code'] === 200 && strpos($response['body'], 'Direct Test Org') !== false) {
                echo "✓ VERIFIED: Admit card created and appears in list\n";
            }
            
        } elseif ($response['http_code'] === 422) {
            echo "✗ Validation errors\n";
            echo substr($response['body'], 0, 500) . "\n";
        } else {
            echo "✗ Unexpected response\n";
            echo "Headers:\n" . $response['headers'] . "\n";
        }
        
    } else {
        throw new Exception("Cannot access create form");
    }
    
    echo "\n=== TEST COMPLETED ===\n";
    echo "Admin admit card POST functionality test finished.\n";
    
} catch (Exception $e) {
    echo "\n✗ ERROR: " . $e->getMessage() . "\n";
} finally {
    if (file_exists($cookie_file)) {
        unlink($cookie_file);
    }
}
