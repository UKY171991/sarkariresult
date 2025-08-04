<?php
session_start();

// Include main config
require_once __DIR__ . '/../includes/config.php';

// Admin configuration
define('ADMIN_URL', 'http://localhost:8000/admin');
define('ADMIN_TITLE', 'Sarkari Result - Admin Panel');

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['admin_id']) && $_SESSION['admin_id'] > 0;
}

// Check admin role
function isAdmin() {
    return isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'admin';
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

// Redirect if not admin
function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        header('Location: dashboard.php?error=access_denied');
        exit();
    }
}

// Get current page for navigation
function getCurrentPage() {
    return basename($_SERVER['PHP_SELF'], '.php');
}

// Database connection function
function getDBConnection() {
    global $pdo;
    return $pdo;
}

// Admin navigation menu
$admin_menu = [
    'dashboard' => [
        'title' => 'Dashboard',
        'icon' => 'fas fa-tachometer-alt',
        'url' => 'dashboard.php'
    ],
    'jobs' => [
        'title' => 'Jobs Management',
        'icon' => 'fas fa-briefcase',
        'submenu' => [
            'jobs-list' => ['title' => 'All Jobs', 'url' => 'pages/jobs-list.php'],
            'jobs-add' => ['title' => 'Add Job', 'url' => 'pages/jobs-add.php']
        ]
    ],
    'results' => [
        'title' => 'Results Management',
        'icon' => 'fas fa-poll',
        'submenu' => [
            'results-list' => ['title' => 'All Results', 'url' => 'pages/results-list.php'],
            'results-add' => ['title' => 'Add Result', 'url' => 'pages/results-add.php']
        ]
    ],
    'admit-cards' => [
        'title' => 'Admit Cards',
        'icon' => 'fas fa-id-card',
        'submenu' => [
            'admit-cards-list' => ['title' => 'All Admit Cards', 'url' => 'pages/admit-cards-list.php'],
            'admit-cards-add' => ['title' => 'Add Admit Card', 'url' => 'pages/admit-cards-add.php']
        ]
    ],
    'answer-keys' => [
        'title' => 'Answer Keys',
        'icon' => 'fas fa-key',
        'submenu' => [
            'answer-keys-list' => ['title' => 'All Answer Keys', 'url' => 'pages/answer-keys-list.php'],
            'answer-keys-add' => ['title' => 'Add Answer Key', 'url' => 'pages/answer-keys-add.php']
        ]
    ],
    'admissions' => [
        'title' => 'Admissions',
        'icon' => 'fas fa-graduation-cap',
        'submenu' => [
            'admissions-list' => ['title' => 'All Admissions', 'url' => 'pages/admissions-list.php'],
            'admissions-add' => ['title' => 'Add Admission', 'url' => 'pages/admissions-add.php']
        ]
    ],
    'syllabus' => [
        'title' => 'Syllabus',
        'icon' => 'fas fa-book',
        'submenu' => [
            'syllabus-list' => ['title' => 'All Syllabus', 'url' => 'pages/syllabus-list.php'],
            'syllabus-add' => ['title' => 'Add Syllabus', 'url' => 'pages/syllabus-add.php']
        ]
    ],
    'categories' => [
        'title' => 'Categories',
        'icon' => 'fas fa-tags',
        'url' => 'pages/categories.php'
    ],
    'messages' => [
        'title' => 'Contact Messages',
        'icon' => 'fas fa-envelope',
        'url' => 'pages/messages.php'
    ],
    'users' => [
        'title' => 'Users',
        'icon' => 'fas fa-users',
        'url' => 'pages/users.php',
        'admin_only' => true
    ],
    'settings' => [
        'title' => 'Site Settings',
        'icon' => 'fas fa-cog',
        'url' => 'pages/settings.php',
        'admin_only' => true
    ]
];

// Helper functions
function formatAdminDate($date) {
    return date('d M Y, H:i', strtotime($date));
}

function getStatusBadge($status) {
    $badges = [
        'active' => 'badge-success',
        'inactive' => 'badge-secondary',
        'expired' => 'badge-danger',
        'available' => 'badge-success',
        'coming_soon' => 'badge-warning',
        'new' => 'badge-primary',
        'read' => 'badge-info',
        'replied' => 'badge-success'
    ];
    
    return isset($badges[$status]) ? $badges[$status] : 'badge-secondary';
}

function truncateAdminText($text, $length = 50) {
    return strlen($text) > $length ? substr($text, 0, $length) . '...' : $text;
}
?>
