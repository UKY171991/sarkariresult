<?php
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
?>