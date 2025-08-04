<?php
/**
 * SQLite Database Setup Script
 * Run this script to create and initialize the SQLite database
 */

// Include the configuration file
require_once __DIR__ . '/../includes/config.php';

echo "Starting SQLite database setup...\n";

try {
    // Connect to SQLite database (will create if not exists)
    $dbDir = dirname(DB_PATH);
    if (!is_dir($dbDir)) {
        mkdir($dbDir, 0755, true);
    }
    
    $db = new PDO("sqlite:" . DB_PATH);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Enable foreign key constraints
    $db->exec("PRAGMA foreign_keys = ON");
    
    // Read the SQL setup file
    $sqlFile = __DIR__ . '/setup_sqlite.sql';
    if (!file_exists($sqlFile)) {
        throw new Exception("SQL setup file not found: $sqlFile");
    }
    
    $sql = file_get_contents($sqlFile);
    if ($sql === false) {
        throw new Exception("Could not read SQL setup file");
    }
    
    // Execute the SQL commands
    echo "Executing database setup commands...\n";
    $result = $db->exec($sql);
    
    if ($result === false) {
        $errorInfo = $db->errorInfo();
        throw new Exception("Database setup failed: " . $errorInfo[2]);
    }
    
    echo "Database setup completed successfully!\n";
    
    // Verify tables were created
    echo "\nVerifying database structure...\n";
    $query = "SELECT name FROM sqlite_master WHERE type='table' ORDER BY name";
    $stmt = $db->query($query);
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "Created tables:\n";
    foreach ($tables as $table) {
        echo "- $table\n";
    }
    
    // Check sample data
    echo "\nSample data counts:\n";
    $countQueries = [
        'jobs' => 'SELECT COUNT(*) FROM jobs',
        'results' => 'SELECT COUNT(*) FROM results',
        'admit_cards' => 'SELECT COUNT(*) FROM admit_cards',
        'answer_keys' => 'SELECT COUNT(*) FROM answer_keys',
        'admissions' => 'SELECT COUNT(*) FROM admissions',
        'categories' => 'SELECT COUNT(*) FROM categories',
        'users' => 'SELECT COUNT(*) FROM users'
    ];
    
    foreach ($countQueries as $table => $query) {
        $stmt = $db->query($query);
        $count = $stmt->fetchColumn();
        echo "- $table: $count records\n";
    }
    
    echo "\n✅ Database setup completed successfully!\n";
    echo "Database location: " . DB_PATH . "\n";
    echo "\nYou can now run your website!\n";
    
} catch (Exception $e) {
    echo "❌ Error during database setup: " . $e->getMessage() . "\n";
    exit(1);
}
?>
