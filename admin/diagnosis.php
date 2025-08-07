<?php
// Admin diagnosis page
echo "<h1>Admin Access Diagnosis</h1>";

echo "<h2>File System Check</h2>";
echo "<p>Current directory: " . __DIR__ . "</p>";
echo "<p>Admin directory exists: " . (is_dir(__DIR__) ? "YES" : "NO") . "</p>";
echo "<p>Index.php exists: " . (file_exists(__DIR__ . "/index.php") ? "YES" : "NO") . "</p>";
echo "<p>Login.php exists: " . (file_exists(__DIR__ . "/login.php") ? "YES" : "NO") . "</p>";
echo "<p>Config.php exists: " . (file_exists(__DIR__ . "/config.php") ? "YES" : "NO") . "</p>";
echo "<p>Dashboard.php exists: " . (file_exists(__DIR__ . "/dashboard.php") ? "YES" : "NO") . "</p>";

echo "<h2>URL Information</h2>";
echo "<p>Request URI: " . $_SERVER['REQUEST_URI'] . "</p>";
echo "<p>Script Name: " . $_SERVER['SCRIPT_NAME'] . "</p>";
echo "<p>HTTP Host: " . $_SERVER['HTTP_HOST'] . "</p>";
echo "<p>Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";

echo "<h2>Rewrite Test</h2>";
echo "<p>Mod_rewrite enabled: " . (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules()) ? "YES" : "UNKNOWN") . "</p>";

echo "<h2>Quick Access Links</h2>";
echo '<p><a href="index.php">Admin Index</a></p>';
echo '<p><a href="login.php">Login Page</a></p>';
echo '<p><a href="dashboard.php">Dashboard (requires login)</a></p>';

echo "<h2>Environment</h2>";
if (file_exists(__DIR__ . "/../includes/environment.php")) {
    require_once __DIR__ . "/../includes/environment.php";
    echo "<p>Base URL: " . BASE_URL . "</p>";
    echo "<p>Environment: " . ENVIRONMENT . "</p>";
} else {
    echo "<p>Environment file not found</p>";
}
?>
