<?php
require 'includes/db.php';

try {
    // Vérification de l'ID
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new Exception('ID invalide');
    }

    $id = (int)$_GET['id'];

    // Récupération des informations du fichier avant suppression
    $stmt = $pdo->prepare("SELECT filepath, type FROM contents WHERE id = ?");
    $stmt->execute([$id]);
    $content = $stmt->fetch();

    if (!$content) {
        throw new Exception('Contenu non trouvé');
    }

    // Suppression du fichier physique
    if (file_exists($content['filepath']) && is_file($content['filepath'])) {
        if (!unlink($content['filepath'])) {
            throw new Exception('Impossible de supprimer le fichier');
        }
    }

    // Suppression de l'entrée dans la base de données
    $stmt = $pdo->prepare("DELETE FROM contents WHERE id = ?");
    $stmt->execute([$id]);

    // Vérification si la suppression a réussi
    if ($stmt->rowCount() > 0) {
        // Redirection avec message de succès
        header('Location: index.php?success=delete');
        exit;
    } else {
        throw new Exception('Erreur lors de la suppression');
    }

} catch (Exception $e) {
    // En cas d'erreur, redirection avec message d'erreur
    header('Location: index.php?error=' . urlencode($e->getMessage()));
    exit;
}
?> 