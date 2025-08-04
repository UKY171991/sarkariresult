<?php
// Redirect to dashboard or login based on authentication
require_once 'config.php';

if (isLoggedIn()) {
    header('Location: dashboard.php');
} else {
    header('Location: login.php');
}
exit();
?>
