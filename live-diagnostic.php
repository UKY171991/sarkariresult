<?php
// Quick diagnostic script for job.codeapka.com
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Live Server Diagnostic - job.codeapka.com</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .warning { color: orange; font-weight: bold; }
        .info { color: blue; }
        .section { margin: 20px 0; padding: 15px; border-left: 4px solid #007bff; background: #f8f9fa; }
        pre { background: #f1f1f1; padding: 10px; border-radius: 4px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Live Server Diagnostic for job.codeapka.com</h1>
        
        <div class="section">
            <h2>✅ PHP Status</h2>
            <p class="success">PHP is working! Version: <?php echo phpversion(); ?></p>
            <p><strong>Server:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?></p>
            <p><strong>Document Root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown'; ?></p>
            <p><strong>Current Script:</strong> <?php echo $_SERVER['SCRIPT_NAME'] ?? 'Unknown'; ?></p>
        </div>

        <div class="section">
            <h2>📁 File System Check</h2>
            <?php
            $files_to_check = [
                'index.php' => 'Main website file',
                'admin/index.php' => 'Admin entry point',
                'admin/login.php' => 'Admin login page',
                'admin/config.php' => 'Admin configuration',
                'admin/.htaccess' => 'Admin URL routing',
                'includes/config.php' => 'Main configuration',
                'includes/environment.php' => 'Environment detection',
                'database/sarkariresult.db' => 'SQLite database',
                '.htaccess' => 'Main URL routing'
            ];

            foreach ($files_to_check as $file => $description) {
                $exists = file_exists($file);
                $readable = $exists ? is_readable($file) : false;
                
                echo "<p>";
                echo "<strong>$file</strong> ($description): ";
                
                if ($exists) {
                    if ($readable) {
                        echo "<span class='success'>✅ EXISTS & READABLE</span>";
                    } else {
                        echo "<span class='warning'>⚠️ EXISTS BUT NOT READABLE</span>";
                    }
                } else {
                    echo "<span class='error'>❌ MISSING</span>";
                }
                echo "</p>";
            }
            ?>
        </div>

        <div class="section">
            <h2>🗂️ Directory Structure</h2>
            <?php
            $dirs = ['admin', 'includes', 'database', 'assets'];
            foreach ($dirs as $dir) {
                if (is_dir($dir)) {
                    $files = scandir($dir);
                    $count = count($files) - 2; // Remove . and ..
                    echo "<p><strong>$dir/</strong>: <span class='success'>✅ EXISTS</span> ($count files)</p>";
                } else {
                    echo "<p><strong>$dir/</strong>: <span class='error'>❌ MISSING</span></p>";
                }
            }
            ?>
        </div>

        <div class="section">
            <h2>🔧 Server Configuration</h2>
            <?php
            // Check mod_rewrite
            if (function_exists('apache_get_modules')) {
                $modules = apache_get_modules();
                if (in_array('mod_rewrite', $modules)) {
                    echo "<p><strong>mod_rewrite:</strong> <span class='success'>✅ ENABLED</span></p>";
                } else {
                    echo "<p><strong>mod_rewrite:</strong> <span class='error'>❌ DISABLED</span></p>";
                }
            } else {
                echo "<p><strong>mod_rewrite:</strong> <span class='warning'>⚠️ CANNOT DETECT</span></p>";
            }

            // Check .htaccess
            if (file_exists('.htaccess')) {
                $htaccess_content = file_get_contents('.htaccess');
                echo "<p><strong>.htaccess:</strong> <span class='success'>✅ EXISTS</span></p>";
                echo "<details><summary>View .htaccess content</summary><pre>" . htmlspecialchars($htaccess_content) . "</pre></details>";
            } else {
                echo "<p><strong>.htaccess:</strong> <span class='error'>❌ MISSING</span></p>";
            }
            ?>
        </div>

        <div class="section">
            <h2>🗄️ Database Check</h2>
            <?php
            if (file_exists('database/sarkariresult.db')) {
                try {
                    $pdo = new PDO("sqlite:database/sarkariresult.db");
                    echo "<p><strong>Database:</strong> <span class='success'>✅ ACCESSIBLE</span></p>";
                    
                    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users WHERE role = 'admin'");
                    $result = $stmt->fetch();
                    echo "<p><strong>Admin Users:</strong> " . $result['count'] . "</p>";
                } catch (Exception $e) {
                    echo "<p><strong>Database:</strong> <span class='error'>❌ ERROR - " . $e->getMessage() . "</span></p>";
                }
            } else {
                echo "<p><strong>Database:</strong> <span class='error'>❌ MISSING</span></p>";
            }
            ?>
        </div>

        <div class="section">
            <h2>🔗 URL Tests</h2>
            <p><strong>Test these URLs:</strong></p>
            <ul>
                <li><a href="/" target="_blank">Main Site (/)</a></li>
                <li><a href="/admin" target="_blank">Admin Panel (/admin)</a></li>
                <li><a href="/admin/" target="_blank">Admin Panel with slash (/admin/)</a></li>
                <li><a href="/admin/index.php" target="_blank">Admin Direct (/admin/index.php)</a></li>
                <li><a href="/admin/login.php" target="_blank">Admin Login (/admin/login.php)</a></li>
            </ul>
        </div>

        <div class="section">
            <h2>📋 Next Steps</h2>
            <ol>
                <li><strong>If admin folder shows as MISSING:</strong> Upload the admin/ folder with all files</li>
                <li><strong>If .htaccess is MISSING:</strong> Upload the .htaccess files</li>
                <li><strong>If database is MISSING:</strong> Upload the database/ folder</li>
                <li><strong>If mod_rewrite is DISABLED:</strong> Contact your hosting provider</li>
                <li><strong>If files exist but admin still shows 404:</strong> Check file permissions</li>
            </ol>
        </div>

        <div class="section">
            <h2>🆘 Emergency Admin Access</h2>
            <p>If /admin doesn't work, try direct access:</p>
            <ul>
                <li><a href="/admin/login.php" target="_blank">/admin/login.php</a></li>
                <li><strong>Username:</strong> admin</li>
                <li><strong>Password:</strong> admin123</li>
            </ul>
        </div>

        <p><small>Generated on <?php echo date('Y-m-d H:i:s'); ?> | Server: <?php echo $_SERVER['HTTP_HOST']; ?></small></p>
    </div>
</body>
</html>
