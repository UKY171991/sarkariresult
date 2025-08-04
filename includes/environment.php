<?php
// Environment detection and configuration
// This file should be included before config.php

// Detect environment
function detectEnvironment() {
    // Check if running from command line
    if (php_sapi_name() === 'cli') {
        return 'development'; // Default to development for CLI
    }
    
    // Check if running on localhost
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
    $isLocal = (
        $host === 'localhost' ||
        $host === '127.0.0.1' ||
        strpos($host, 'localhost:') === 0 ||
        strpos($host, '127.0.0.1:') === 0
    );
    
    return $isLocal ? 'development' : 'production';
}

// Set environment
$environment = detectEnvironment();
define('ENVIRONMENT', $environment);

// Environment-specific configurations
if ($environment === 'development') {
    // Development settings
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    define('DEBUG_MODE', true);
    define('BASE_URL', 'http://localhost:8000');
} else {
    // Production settings
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    
    define('DEBUG_MODE', false);
    define('BASE_URL', 'https://job.codeapka.com');
}

// Common security headers
if (!DEBUG_MODE && php_sapi_name() !== 'cli') {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
}
?>
