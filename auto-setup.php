<?php
// Auto-setup script for immediate deployment
// Detect the current domain and protocol (with CLI fallback)
if (php_sapi_name() === 'cli') {
    // Default for CLI usage
    $protocol = 'https';
    $host = 'job.codeapka.com';
} else {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
}
$currentUrl = $protocol . '://' . $host;

// Auto-configure the site based on current domain
define('AUTO_DETECTED_URL', $currentUrl);

// Create or update the environment configuration
$envConfig = '<?php
// Auto-generated environment configuration
$protocol = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") || $_SERVER["SERVER_PORT"] == 443 ? "https" : "http";
$host = $_SERVER["HTTP_HOST"];
define("BASE_URL", $protocol . "://" . $host);

// Environment detection
function detectEnvironment() {
    $host = isset($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : "";
    $isLocal = (
        $host === "localhost" ||
        $host === "127.0.0.1" ||
        strpos($host, "localhost:") === 0 ||
        strpos($host, "127.0.0.1:") === 0
    );
    
    return $isLocal ? "development" : "production";
}

$environment = detectEnvironment();
define("ENVIRONMENT", $environment);

if ($environment === "development") {
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
    error_reporting(E_ALL);
    define("DEBUG_MODE", true);
} else {
    ini_set("display_errors", 0);
    ini_set("display_startup_errors", 0);
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    define("DEBUG_MODE", false);
}

if (!DEBUG_MODE && php_sapi_name() !== "cli") {
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
}
?>';

// Write the environment file
file_put_contents(__DIR__ . '/includes/environment.php', $envConfig);

// Update main config to use auto-detection
$mainConfig = '<?php
// Auto-configured main config
require_once __DIR__ . "/environment.php";

define("DB_PATH", __DIR__ . "/../database/sarkariresult.db");

define("SITE_NAME", "Sarkari Result");
define("SITE_URL", BASE_URL);
define("SITE_DESCRIPTION", "Find Latest Sarkari Job Vacancies And Sarkari Exam Results");

// Database connection with auto-setup
try {
    $dbDir = dirname(DB_PATH);
    if (!is_dir($dbDir)) {
        mkdir($dbDir, 0755, true);
    }
    
    if (!file_exists(DB_PATH)) {
        touch(DB_PATH);
        chmod(DB_PATH, 0666);
        
        // Auto-run database setup
        if (file_exists(__DIR__ . "/../database/setup.php")) {
            include_once __DIR__ . "/../database/setup.php";
        }
    }
    
    $pdo = new PDO("sqlite:" . DB_PATH);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec("PRAGMA foreign_keys = ON");
    
} catch(PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    $pdo = null;
}

function formatDate($date) {
    return date("d/m/Y", strtotime($date));
}

function truncateText($text, $length = 100) {
    if (strlen($text) > $length) {
        return substr($text, 0, $length) . "...";
    }
    return $text;
}

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

$categories = [
    "latest-jobs" => "Latest Jobs",
    "results" => "Results",
    "admit-card" => "Admit Card",
    "answer-key" => "Answer Key",
    "admission" => "Admission",
    "syllabus" => "Syllabus"
];
?>';

file_put_contents(__DIR__ . '/includes/config.php', $mainConfig);

// Update admin config
$adminConfig = '<?php
session_start();

require_once __DIR__ . "/../includes/config.php";

define("ADMIN_URL", BASE_URL . "/admin");
define("ADMIN_TITLE", "Sarkari Result - Admin Panel");

function isLoggedIn() {
    return isset($_SESSION["admin_id"]) && $_SESSION["admin_id"] > 0;
}

function isAdmin() {
    return isset($_SESSION["admin_role"]) && $_SESSION["admin_role"] === "admin";
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        header("Location: dashboard.php?error=access_denied");
        exit();
    }
}

function getCurrentPage() {
    return basename($_SERVER["PHP_SELF"], ".php");
}

function getDBConnection() {
    global $pdo;
    return $pdo;
}

// Rest of admin configuration...
$admin_menu = [
    "dashboard" => [
        "title" => "Dashboard",
        "icon" => "fas fa-tachometer-alt",
        "url" => "dashboard.php"
    ]
];

function formatAdminDate($date) {
    return date("d M Y, H:i", strtotime($date));
}

function getStatusBadge($status) {
    $badges = [
        "active" => "badge-success",
        "inactive" => "badge-secondary",
        "expired" => "badge-danger",
        "available" => "badge-success",
        "coming_soon" => "badge-warning"
    ];
    return isset($badges[$status]) ? $badges[$status] : "badge-secondary";
}

function truncateAdminText($text, $length = 50) {
    return strlen($text) > $length ? substr($text, 0, $length) . "..." : $text;
}
?>';

file_put_contents(__DIR__ . '/admin/config.php', $adminConfig);

// Create a simple .htaccess for admin
$adminHtaccess = 'RewriteEngine On
DirectoryIndex index.php

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^$ index.php [L]

<Files "config.php">
    Order allow,deny
    Deny from all
</Files>';

file_put_contents(__DIR__ . '/admin/.htaccess', $adminHtaccess);

// Create main .htaccess
$mainHtaccess = 'RewriteEngine On
DirectoryIndex index.php

RewriteCond %{REQUEST_URI} ^/admin/?$
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^admin/?$ admin/index.php [L]

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^([^.]+)$ $1.php [L]

<FilesMatch "\.(db|sql)$">
    Order allow,deny
    Deny from all
</FilesMatch>';

file_put_contents(__DIR__ . '/.htaccess', $mainHtaccess);

echo "<!DOCTYPE html>
<html>
<head>
    <title>Auto-Setup Complete</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .success { color: #28a745; }
        .info { color: #007bff; }
        .links { margin: 20px 0; }
        .links a { display: inline-block; margin: 10px; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        .links a:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class='container'>
        <h1 class='success'>✅ Auto-Setup Complete!</h1>
        <p class='info'>Your Sarkari Result website has been automatically configured for: <strong>" . AUTO_DETECTED_URL . "</strong></p>
        
        <h2>🔧 What was configured:</h2>
        <ul>
            <li>✅ Environment detection (auto-detects domain)</li>
            <li>✅ Database auto-setup</li>
            <li>✅ Admin panel configuration</li>
            <li>✅ URL rewriting (.htaccess files)</li>
            <li>✅ Security headers</li>
        </ul>
        
        <h2>🌐 Your URLs:</h2>
        <div class='links'>
            <a href='" . AUTO_DETECTED_URL . "'>Main Website</a>
            <a href='" . AUTO_DETECTED_URL . "/admin'>Admin Panel</a>
            <a href='" . AUTO_DETECTED_URL . "/admin/login.php'>Admin Login</a>
        </div>
        
        <h2>🔑 Default Admin Credentials:</h2>
        <ul>
            <li><strong>Username:</strong> admin</li>
            <li><strong>Password:</strong> admin123</li>
        </ul>
        
        <p><strong>Note:</strong> The website will automatically adapt to any domain you move it to!</p>
    </div>
</body>
</html>";

// Run database setup if needed
if (file_exists(__DIR__ . '/database/setup.php') && !file_exists(__DIR__ . '/database/sarkariresult.db')) {
    include_once __DIR__ . '/database/setup.php';
}
?>
