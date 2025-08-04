<?php
// Simple router for PHP built-in server
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// Remove query string for path checking
$cleanPath = strtok($path, '?');

// Handle directory requests without trailing slash
if (substr($cleanPath, -1) !== '/' && is_dir(__DIR__ . $cleanPath)) {
    // Redirect to directory with trailing slash
    header("Location: $cleanPath/", true, 301);
    exit;
}

// Handle admin directory
if ($cleanPath === '/admin/' || $cleanPath === '/admin') {
    if (file_exists(__DIR__ . '/admin/index.php')) {
        require_once __DIR__ . '/admin/index.php';
        exit;
    }
}

// Handle other directories with index.php
if (substr($cleanPath, -1) === '/' && $cleanPath !== '/') {
    $indexFile = __DIR__ . rtrim($cleanPath, '/') . '/index.php';
    if (file_exists($indexFile)) {
        require_once $indexFile;
        exit;
    }
}

// Default behavior - let PHP handle the request normally
return false;
?>
