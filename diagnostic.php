<?php
// Server diagnostic script
echo "<h1>Sarkari Result Server Diagnostic</h1>";
echo "<h2>Server Information</h2>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p><strong>Script Name:</strong> " . $_SERVER['SCRIPT_NAME'] . "</p>";
echo "<p><strong>Request URI:</strong> " . $_SERVER['REQUEST_URI'] . "</p>";
echo "<p><strong>HTTP Host:</strong> " . $_SERVER['HTTP_HOST'] . "</p>";

echo "<h2>File System Check</h2>";
$files_to_check = [
    'index.php',
    'admin/index.php',
    'admin/login.php',
    'admin/config.php',
    'includes/config.php',
    'includes/environment.php',
    'database/sarkariresult.db',
    '.htaccess',
    'admin/.htaccess'
];

foreach ($files_to_check as $file) {
    $exists = file_exists($file);
    $readable = is_readable($file);
    echo "<p><strong>$file:</strong> ";
    if ($exists) {
        echo "✅ EXISTS";
        if ($readable) {
            echo " | ✅ READABLE";
        } else {
            echo " | ❌ NOT READABLE";
        }
    } else {
        echo "❌ MISSING";
    }
    echo "</p>";
}

echo "<h2>Directory Permissions</h2>";
$dirs_to_check = ['admin', 'database', 'includes', 'assets'];
foreach ($dirs_to_check as $dir) {
    if (is_dir($dir)) {
        $perms = substr(sprintf('%o', fileperms($dir)), -4);
        echo "<p><strong>$dir/:</strong> ✅ EXISTS (Permissions: $perms)</p>";
    } else {
        echo "<p><strong>$dir/:</strong> ❌ MISSING</p>";
    }
}

echo "<h2>Environment Detection</h2>";
if (file_exists('includes/environment.php')) {
    require_once 'includes/environment.php';
    echo "<p><strong>Environment:</strong> " . ENVIRONMENT . "</p>";
    echo "<p><strong>Base URL:</strong> " . BASE_URL . "</p>";
    echo "<p><strong>Debug Mode:</strong> " . (DEBUG_MODE ? 'ON' : 'OFF') . "</p>";
} else {
    echo "<p>❌ Environment file not found</p>";
}

echo "<h2>Database Check</h2>";
if (file_exists('database/sarkariresult.db')) {
    try {
        $pdo = new PDO("sqlite:database/sarkariresult.db");
        echo "<p>✅ Database connection successful</p>";
        
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
        $result = $stmt->fetch();
        echo "<p>✅ Users table accessible ({$result['count']} users)</p>";
    } catch (Exception $e) {
        echo "<p>❌ Database error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>❌ Database file not found</p>";
}

echo "<h2>Recommended Actions</h2>";
echo "<ol>";
echo "<li>If files are missing, upload all project files to the server</li>";
echo "<li>Set proper permissions: chmod 755 for directories, chmod 644 for files</li>";
echo "<li>Ensure database directory has write permissions: chmod 755 database/</li>";
echo "<li>Check if .htaccess files are working (mod_rewrite enabled)</li>";
echo "<li>If admin folder shows as missing, verify it was uploaded correctly</li>";
echo "</ol>";

echo "<p><small>Generated on " . date('Y-m-d H:i:s') . "</small></p>";
?>
