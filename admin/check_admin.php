<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

// Vérifier si l'utilisateur est connecté
if (!isLoggedIn()) {
    echo "Vous n'êtes pas connecté.";
    exit;
}

// Vérifier le statut admin dans la base de données
$stmt = $pdo->prepare("SELECT id, username, email, is_admin FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<h2>Informations de débogage</h2>";
echo "<pre>";
echo "ID utilisateur: " . $_SESSION['user_id'] . "\n";
echo "Nom d'utilisateur: " . htmlspecialchars($user['username']) . "\n";
echo "Email: " . htmlspecialchars($user['email']) . "\n";
echo "Est admin?: " . ($user['is_admin'] ? 'Oui' : 'Non') . "\n";
echo "Type de is_admin: " . gettype($user['is_admin']) . "\n";
echo "Valeur brute de is_admin: " . var_export($user['is_admin'], true) . "\n";
echo "</pre>";
?> 