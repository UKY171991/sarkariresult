<?php
// Production server verification script
// Place this in the root directory and access via browser

echo "<h1>Production Server Verification</h1>";
echo "<style>body{font-family:Arial;margin:40px;} .ok{color:green;} .error{color:red;} .warning{color:orange;}</style>";

echo "<h2>File System Check</h2>";

$files_to_check = [
    'admin/index.php' => 'Admin main entry point',
    'admin/login.php' => 'Admin login page',
    'admin/dashboard.php' => 'Admin dashboard',
    'admin/config.php' => 'Admin configuration',
    'admin/layouts/header.php' => 'AdminLTE header layout',
    'admin/layouts/sidebar.php' => 'AdminLTE sidebar layout',
    'admin/layouts/footer.php' => 'AdminLTE footer layout',
    'includes/config.php' => 'Main configuration',
    'includes/environment.php' => 'Environment settings',
    'database/sarkariresult.db' => 'SQLite database',
    '.htaccess' => 'URL rewrite rules'
];

foreach ($files_to_check as $file => $description) {
    $exists = file_exists($file);
    $class = $exists ? 'ok' : 'error';
    $status = $exists ? 'EXISTS' : 'MISSING';
    echo "<p class='$class'>$file - $description: <strong>$status</strong></p>";
}

echo "<h2>Directory Permissions</h2>";
$directories = ['admin', 'database', 'includes'];
foreach ($directories as $dir) {
    if (is_dir($dir)) {
        $perms = substr(sprintf('%o', fileperms($dir)), -4);
        $writable = is_writable($dir) ? 'WRITABLE' : 'NOT WRITABLE';
        echo "<p class='ok'>$dir/: Permissions $perms ($writable)</p>";
    } else {
        echo "<p class='error'>$dir/: Directory missing</p>";
    }
}

echo "<h2>Database Check</h2>";
if (file_exists('database/sarkariresult.db')) {
    $size = filesize('database/sarkariresult.db');
    echo "<p class='ok'>Database exists, size: " . number_format($size) . " bytes</p>";
    
    try {
        $pdo = new PDO('sqlite:database/sarkariresult.db');
        $tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll();
        echo "<p class='ok'>Database connection: SUCCESS</p>";
        echo "<p>Tables: " . implode(', ', array_column($tables, 'name')) . "</p>";
        
        // Check admin user
        $admin = $pdo->query("SELECT username FROM users WHERE role='admin' LIMIT 1")->fetch();
        if ($admin) {
            echo "<p class='ok'>Admin user exists: " . $admin['username'] . "</p>";
        } else {
            echo "<p class='warning'>No admin user found in database</p>";
        }
    } catch (Exception $e) {
        echo "<p class='error'>Database error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p class='error'>Database file not found</p>";
}

echo "<h2>Environment Detection</h2>";
if (file_exists('includes/environment.php')) {
    require_once 'includes/environment.php';
    echo "<p class='ok'>Environment: " . ENVIRONMENT . "</p>";
    echo "<p class='ok'>Base URL: " . BASE_URL . "</p>";
} else {
    echo "<p class='error'>Environment configuration missing</p>";
}

echo "<h2>Quick Links</h2>";
echo "<p><a href='admin/'>Admin Panel</a> (should redirect to login)</p>";
echo "<p><a href='admin/login.php'>Direct Login</a></p>";
echo "<p><a href='admin/diagnosis.php'>Admin Diagnosis</a></p>";

echo "<h2>Upload Instructions</h2>";
if (file_exists('admin/login.php')) {
    echo "<p class='ok'>✅ Admin files are uploaded correctly!</p>";
    echo "<p>You can now access the admin panel at: <a href='admin/'>admin/</a></p>";
} else {
    echo "<p class='error'>❌ Admin files need to be uploaded!</p>";
    echo "<p>Please upload the entire 'admin' directory from your local development environment.</p>";
}
?>
