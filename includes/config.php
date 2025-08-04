<?php
// Environment detection
require_once __DIR__ . '/environment.php';

// Database configuration for SQLite
define('DB_PATH', __DIR__ . '/../database/sarkariresult.db');

// Site configuration
define('SITE_NAME', 'Sarkari Result');
define('SITE_URL', BASE_URL);
define('SITE_DESCRIPTION', 'Find Latest Sarkari Job Vacancies And Sarkari Exam Results');

// Database connection
try {
    // Create database directory if it doesn't exist
    $dbDir = dirname(DB_PATH);
    if (!is_dir($dbDir)) {
        mkdir($dbDir, 0755, true);
    }
    
    // Ensure database file is writable
    if (!file_exists(DB_PATH)) {
        touch(DB_PATH);
        chmod(DB_PATH, 0666);
    }
    
    $pdo = new PDO("sqlite:" . DB_PATH);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Enable foreign key constraints
    $pdo->exec("PRAGMA foreign_keys = ON");
    
} catch(PDOException $e) {
    // Log error in production
    error_log("Database connection failed: " . $e->getMessage());
    $pdo = null; // Continue without database for now
}

// Common functions
function formatDate($date) {
    return date('d/m/Y', strtotime($date));
}

function truncateText($text, $length = 100) {
    if (strlen($text) > $length) {
        return substr($text, 0, $length) . '...';
    }
    return $text;
}

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

// Categories array
$categories = [
    'latest-jobs' => 'Latest Jobs',
    'results' => 'Results',
    'admit-card' => 'Admit Card',
    'answer-key' => 'Answer Key',
    'admission' => 'Admission',
    'syllabus' => 'Syllabus',
    'documents' => 'Documents'
];

// Navigation menu
$nav_menu = [
    'Home' => 'index.php',
    'Latest Jobs' => 'latest-jobs.php',
    'Results' => 'results.php',
    'Admit Card' => 'admit-card.php',
    'Answer Key' => 'answer-key.php',
    'Admission' => 'admission.php',
    'Syllabus' => 'syllabus.php',
    'Contact' => 'contact.php'
];
?>
