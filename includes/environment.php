<?php
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
?>