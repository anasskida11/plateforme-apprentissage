<?php
require_once __DIR__ . '/config/database.php';

try {
    // Configuration de la base de données
    $host = 'localhost';
    $dbname = 'apprentissage';
    $username = 'root';  // Utilisateur par défaut de XAMPP
    $password = '';      // Mot de passe par défaut de XAMPP (vide)
    $charset = 'utf8mb4';

    // Options de PDO
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    // Construction du DSN
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

    // Tentative de connexion
    $pdo = new PDO($dsn, $username, $password, $options);

    // Message de succès (à commenter en production)
    // echo "Connexion à la base de données réussie !";
    
} catch (PDOException $e) {
    // Message d'erreur détaillé
    die('Erreur de connexion à la base de données : ' . $e->getMessage() . 
        '<br>Assurez-vous que : <br>' .
        '1. MySQL est démarré dans XAMPP<br>' .
        '2. La base de données "apprentissage" existe<br>' .
        '3. Les identifiants sont corrects');
} 