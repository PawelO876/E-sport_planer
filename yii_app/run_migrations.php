<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/db.php';

$dbConfig = require __DIR__ . '/config/db.php';

try {
    $pdo = new PDO(
        $dbConfig['dsn'], 
        $dbConfig['username'], 
        $dbConfig['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully!\n\n";
    
    // Check if role column already exists
    $stmt = $pdo->prepare("SHOW COLUMNS FROM users LIKE 'role'");
    $stmt->execute();
    $roleExists = $stmt->fetch();
    
    if (!$roleExists) {
        echo "Adding 'role' column to users table...\n";
        $pdo->exec("ALTER TABLE users ADD COLUMN role VARCHAR(20) DEFAULT 'user'");
        echo "Setting admin user role...\n";
        $pdo->exec("UPDATE users SET role = 'admin' WHERE username = 'admin'");
        echo "Done!\n";
    } else {
        echo "Column 'role' already exists in users table.\n";
    }
    
    // Check if messages table exists
    $stmt = $pdo->prepare("SHOW TABLES LIKE 'messages'");
    $stmt->execute();
    $messagesTableExists = $stmt->fetch();
    
    if (!$messagesTableExists) {
        echo "\nCreating 'messages' table...\n";
        $pdo->exec("CREATE TABLE messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NULL,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            subject VARCHAR(255) NOT NULL,
            body TEXT NOT NULL,
            created_at INT NOT NULL,
            is_read TINYINT(1) DEFAULT 0
        )");
        echo "Done!\n";
    } else {
        echo "Table 'messages' already exists.\n";
    }
    
    // Check if user_id column exists in messages table
    $stmt = $pdo->prepare("SHOW COLUMNS FROM messages LIKE 'user_id'");
    $stmt->execute();
    $userIdExists = $stmt->fetch();
    
    if (!$userIdExists) {
        echo "\nAdding 'user_id' column to messages table...\n";
        $pdo->exec("ALTER TABLE messages ADD COLUMN user_id INT NULL");
        $pdo->exec("ALTER TABLE messages ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE");
        echo "Done!\n";
    } else {
        echo "Column 'user_id' already exists in messages table.\n";
    }
    
    echo "\nAll migrations applied successfully!\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

