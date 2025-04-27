<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

echo "<h2>Session Debug Information</h2>";
echo "<pre>";
echo "Session ID: " . session_id() . "\n";
echo "Session Data:\n";
print_r($_SESSION);

echo "\n\nUser Information:\n";
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($user);
} else {
    echo "No user_id in session\n";
}

echo "\n\nAdmin Check:\n";
echo "isLoggedIn(): " . (isLoggedIn() ? 'true' : 'false') . "\n";
echo "isAdmin(): " . (isAdmin() ? 'true' : 'false') . "\n";

// Check database connection
echo "\n\nDatabase Connection:\n";
try {
    $pdo->query("SELECT 1");
    echo "Database connection successful\n";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
}
echo "</pre>"; 