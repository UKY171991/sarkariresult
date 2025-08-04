<?php
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
?>