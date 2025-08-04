<?php
// Simple test to check if server supports the required features
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Server Test - job.codeapka.com</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .success { color: green; }
        .error { color: red; }
        .warning { color: orange; }
    </style>
</head>
<body>
    <h1>Server Test for job.codeapka.com</h1>
    
    <h2>Basic PHP Test</h2>
    <p class="success">✅ PHP is working! Version: <?php echo phpversion(); ?></p>
    
    <h2>Required Extensions</h2>
    <?php
    $required_extensions = ['pdo', 'pdo_sqlite', 'json', 'mbstring'];
    foreach ($required_extensions as $ext) {
        if (extension_loaded($ext)) {
            echo "<p class='success'>✅ $ext extension loaded</p>";
        } else {
            echo "<p class='error'>❌ $ext extension missing</p>";
        }
    }
    ?>
    
    <h2>File Upload Test</h2>
    <?php
    if (is_writable('.')) {
        echo "<p class='success'>✅ Directory is writable</p>";
    } else {
        echo "<p class='error'>❌ Directory is not writable</p>";
    }
    ?>
    
    <h2>Admin Directory Test</h2>
    <?php
    if (is_dir('admin')) {
        echo "<p class='success'>✅ Admin directory exists</p>";
        if (file_exists('admin/index.php')) {
            echo "<p class='success'>✅ Admin index.php exists</p>";
        } else {
            echo "<p class='error'>❌ Admin index.php missing</p>";
        }
    } else {
        echo "<p class='error'>❌ Admin directory missing</p>";
    }
    ?>
    
    <h2>URL Rewrite Test</h2>
    <?php
    if (isset($_SERVER['REQUEST_URI'])) {
        echo "<p class='success'>✅ REQUEST_URI available: " . $_SERVER['REQUEST_URI'] . "</p>";
    }
    
    if (function_exists('apache_get_modules')) {
        $modules = apache_get_modules();
        if (in_array('mod_rewrite', $modules)) {
            echo "<p class='success'>✅ mod_rewrite is enabled</p>";
        } else {
            echo "<p class='error'>❌ mod_rewrite is not enabled</p>";
        }
    } else {
        echo "<p class='warning'>⚠️ Cannot check mod_rewrite status</p>";
    }
    ?>
    
    <h2>Test Links</h2>
    <ul>
        <li><a href="/">Home Page</a></li>
        <li><a href="/admin">Admin Panel</a> (should work if files uploaded correctly)</li>
        <li><a href="/admin/">Admin Panel with slash</a></li>
        <li><a href="/admin/login.php">Admin Login Direct</a></li>
    </ul>
    
    <h2>Instructions</h2>
    <ol>
        <li>If you see this page, PHP is working</li>
        <li>Upload all project files to the server root</li>
        <li>Set proper file permissions</li>
        <li>Test the admin panel links above</li>
    </ol>
</body>
</html>
