<?php
// Démarrer la session si pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclure les fichiers nécessaires
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

// Vérifier si l'utilisateur est connecté et est admin
if (!isLoggedIn() || !isAdmin()) {
    redirect('/projet/login.php');
}

// Vérifier si l'ID est fourni
if (!isset($_GET['id'])) {
    $_SESSION['error'] = "ID de l'utilisateur non spécifié.";
    redirect('/projet/admin/members.php');
}

$userId = $_GET['id'];

// Empêcher la suppression de son propre compte
if ($userId == $_SESSION['user_id']) {
    $_SESSION['error'] = "Vous ne pouvez pas supprimer votre propre compte.";
    redirect('/projet/admin/members.php');
}

try {
    // Commencer une transaction
    $pdo->beginTransaction();

    // Supprimer les données associées
    $pdo->prepare("DELETE FROM user_progress WHERE user_id = ?")->execute([$userId]);
    $pdo->prepare("DELETE FROM user_favorites WHERE user_id = ?")->execute([$userId]);
    $pdo->prepare("DELETE FROM user_rewards WHERE user_id = ?")->execute([$userId]);
    
    // Supprimer l'utilisateur
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);

    // Valider la transaction
    $pdo->commit();

    $_SESSION['success'] = "L'utilisateur a été supprimé avec succès.";
} catch (Exception $e) {
    // En cas d'erreur, annuler la transaction
    $pdo->rollBack();
    $_SESSION['error'] = "Une erreur est survenue lors de la suppression de l'utilisateur.";
}

redirect('/projet/admin/members.php'); 