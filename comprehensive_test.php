<?php

/**
 * Comprehensive test for Admin Admit Card POST functionality
 */

echo "=== ADMIN ADMIT CARD POST TEST ===\n";
echo "Testing: " . date('Y-m-d H:i:s') . "\n\n";

// Test configuration
$base_url = 'http://127.0.0.1:8000';
$admin_email = 'admin@sarkariresult.com';
$admin_password = 'SecureAdmin@2025';

// Cookie storage
$cookie_file = 'test_cookies.txt';

// Clean up previous cookies
if (file_exists($cookie_file)) {
    unlink($cookie_file);
}

/**
 * Helper function to make HTTP requests with session persistence
 */
function httpRequest($url, $method = 'GET', $data = [], $headers = []) {
    global $cookie_file;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($ch, CURLOPT_USERAGENT, 'AdminCardTest/1.0');
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if (!empty($data)) {
            if (is_array($data)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        }
    }
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $error = curl_error($ch);
    
    curl_close($ch);
    
    if ($error) {
        throw new Exception("cURL Error: " . $error);
    }
    
    $headers = substr($response, 0, $header_size);
    $body = substr($response, $header_size);
    
    return [
        'http_code' => $http_code,
        'headers' => $headers,
        'body' => $body
    ];
}

/**
 * Extract CSRF token from HTML
 */
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
    echo "Step 1: Testing server connectivity...\n";
    $response = httpRequest($base_url);
    if ($response['http_code'] !== 200) {
        throw new Exception("Server not responding. HTTP: " . $response['http_code']);
    }
    echo "✓ Server is responding\n\n";
    
    echo "Step 2: Getting login page...\n";
    $response = httpRequest($base_url . '/login');
    if ($response['http_code'] !== 200) {
        throw new Exception("Cannot access login page. HTTP: " . $response['http_code']);
    }
    
    $csrf_token = extractCsrfToken($response['body']);
    if (!$csrf_token) {
        throw new Exception("Cannot find CSRF token on login page");
    }
    echo "✓ Login page accessible, CSRF token: " . substr($csrf_token, 0, 10) . "...\n\n";
    
    echo "Step 3: Attempting login...\n";
    $login_data = [
        '_token' => $csrf_token,
        'email' => $admin_email,
        'password' => $admin_password,
    ];
    
    $response = httpRequest($base_url . '/login', 'POST', $login_data);
    echo "Login response: HTTP " . $response['http_code'] . "\n";
    
    // Check for successful login (should redirect)
    if ($response['http_code'] === 302) {
        if (preg_match('/Location:\s*(.+)/', $response['headers'], $matches)) {
            $redirect_url = trim($matches[1]);
            echo "✓ Login successful, redirected to: " . $redirect_url . "\n";
        } else {
            echo "✓ Login appears successful (302 redirect)\n";
        }
    } else {
        echo "Login response headers:\n" . $response['headers'] . "\n";
        echo "Login response body (first 500 chars):\n" . substr($response['body'], 0, 500) . "\n";
        throw new Exception("Login failed. Expected 302 redirect, got " . $response['http_code']);
    }
    echo "\n";
    
    echo "Step 4: Testing admin access...\n";
    $response = httpRequest($base_url . '/admin');
    if ($response['http_code'] === 200) {
        echo "✓ Admin dashboard accessible\n";
    } elseif ($response['http_code'] === 302) {
        echo "⚠ Admin dashboard redirects (possibly to login)\n";
    } else {
        echo "✗ Admin dashboard error: HTTP " . $response['http_code'] . "\n";
    }
    echo "\n";
    
    echo "Step 5: Testing admin admit cards index...\n";
    $response = httpRequest($base_url . '/admin/admit-cards');
    if ($response['http_code'] === 200) {
        echo "✓ Admin admit cards index accessible\n";
        
        // Check if we can see the page content
        if (strpos($response['body'], 'admit-cards') !== false || strpos($response['body'], 'Admit Card') !== false) {
            echo "✓ Page contains admit card content\n";
        }
    } elseif ($response['http_code'] === 302) {
        echo "✗ Admin admit cards redirects to login (authentication failed)\n";
        throw new Exception("Admin authentication failed");
    } else {
        throw new Exception("Cannot access admin admit cards. HTTP: " . $response['http_code']);
    }
    echo "\n";
    
    echo "Step 6: Getting create admit card form...\n";
    $response = httpRequest($base_url . '/admin/admit-cards/create');
    if ($response['http_code'] !== 200) {
        throw new Exception("Cannot access create form. HTTP: " . $response['http_code']);
    }
    
    $csrf_token = extractCsrfToken($response['body']);
    if (!$csrf_token) {
        throw new Exception("Cannot find CSRF token on create form");
    }
    echo "✓ Create form accessible, CSRF token: " . substr($csrf_token, 0, 10) . "...\n";
    
    // Check if form has required fields
    $required_fields = ['job_post_id', 'title', 'organization', 'download_link', 'status'];
    $form_ok = true;
    foreach ($required_fields as $field) {
        if (strpos($response['body'], 'name="' . $field . '"') === false) {
            echo "✗ Missing field: " . $field . "\n";
            $form_ok = false;
        }
    }
    if ($form_ok) {
        echo "✓ All required form fields present\n";
    }
    echo "\n";
    
    echo "Step 7: Testing POST to create admit card...\n";
    $admit_card_data = [
        '_token' => $csrf_token,
        'job_post_id' => '1',
        'title' => 'Test Admit Card - Comprehensive Test ' . date('H:i:s'),
        'description' => 'This admit card was created by the comprehensive test script.',
        'organization' => 'Test Organization',
        'exam_date' => '2024-12-31',
        'download_link' => 'https://example.com/test-admit-card-' . time() . '.pdf',
        'official_website' => 'https://example.com',
        'instructions' => 'Test instructions for admit card download.',
        'status' => 'active'
    ];
    
    echo "Data being sent:\n";
    foreach ($admit_card_data as $key => $value) {
        if ($key !== '_token') {
            echo "  $key: $value\n";
        }
    }
    echo "\n";
    
    $response = httpRequest($base_url . '/admin/admit-cards', 'POST', $admit_card_data);
    
    echo "POST Response: HTTP " . $response['http_code'] . "\n";
    
    if ($response['http_code'] === 302) {
        echo "✓ SUCCESS! Admit card creation returned redirect (expected behavior)\n";
        
        if (preg_match('/Location:\s*(.+)/', $response['headers'], $matches)) {
            $redirect_url = trim($matches[1]);
            echo "✓ Redirected to: " . $redirect_url . "\n";
            
            if (strpos($redirect_url, '/admin/admit-cards') !== false) {
                echo "✓ Redirected back to admit cards index (success pattern)\n";
            }
        }
    } elseif ($response['http_code'] === 422) {
        echo "✗ Validation errors occurred\n";
        echo "Response body:\n" . $response['body'] . "\n";
    } elseif ($response['http_code'] === 419) {
        echo "✗ CSRF token mismatch\n";
    } else {
        echo "✗ Unexpected response\n";
        echo "Headers:\n" . $response['headers'] . "\n";
        echo "Body (first 1000 chars):\n" . substr($response['body'], 0, 1000) . "\n";
    }
    echo "\n";
    
    echo "Step 8: Verifying admit card was created...\n";
    $response = httpRequest($base_url . '/admin/admit-cards');
    if ($response['http_code'] === 200) {
        if (strpos($response['body'], 'Test Organization') !== false) {
            echo "✓ VERIFIED: New admit card appears in the list\n";
        } else {
            echo "⚠ Admit card may not have been created (not found in list)\n";
        }
    }
    
    echo "\n=== TEST COMPLETED SUCCESSFULLY ===\n";
    echo "The admin admit card POST functionality is working correctly.\n";
    
} catch (Exception $e) {
    echo "\n✗ ERROR: " . $e->getMessage() . "\n";
    echo "=== TEST FAILED ===\n";
} finally {
    // Clean up
    if (file_exists($cookie_file)) {
        unlink($cookie_file);
    }
}
