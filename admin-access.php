<?php
// Emergency admin access - works without .htaccess
// Use this if /admin URL doesn't work
session_start();

// Simple redirect to login if not authenticated
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page
    header('Location: login.php');
    exit();
} else {
    // Redirect to dashboard if already logged in
    header('Location: dashboard.php');
    exit();
}
?>
