<?php
require 'includes/db.php';

// Configuration
$uploadDir = 'uploads/';
$maxFileSize = 50 * 1024 * 1024; // 50 MB
$allowedTypes = [
    'video' => ['video/mp4', 'video/webm', 'video/avi'],
    'audio' => ['audio/mpeg', 'audio/wav', 'audio/ogg'],
    'image' => ['image/jpeg', 'image/png', 'image/gif'],
    'text' => ['application/pdf', 'application/msword', 'text/plain']
];

try {
    // Validation des données
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Méthode non autorisée');
    }

    $requiredFields = ['title', 'type', 'category_id', 'difficulty_level'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Le champ $field est requis");
        }
    }

    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Erreur lors du téléchargement du fichier');
    }

    // Validation du type de fichier
    $fileType = $_FILES['file']['type'];
    $uploadType = $_POST['type'];
    if (!isset($allowedTypes[$uploadType]) || !in_array($fileType, $allowedTypes[$uploadType])) {
        throw new Exception('Type de fichier non autorisé');
    }

    // Validation de la taille
    if ($_FILES['file']['size'] > $maxFileSize) {
        throw new Exception('Le fichier est trop volumineux (max 50 MB)');
    }

    // Création du dossier de destination
    $targetDir = $uploadDir . $uploadType . 's/';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Génération d'un nom de fichier unique
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $fileName = uniqid() . '_' . time() . '.' . $extension;
    $targetPath = $targetDir . $fileName;

    // Déplacement du fichier
    if (!move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        throw new Exception('Erreur lors du déplacement du fichier');
    }

    // Insertion dans la base de données
    $stmt = $pdo->prepare("
        INSERT INTO contents (title, description, type, filepath, category_id, difficulty_level)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $_POST['title'],
        $_POST['description'] ?? '',
        $_POST['type'],
        $targetPath,
        $_POST['category_id'],
        $_POST['difficulty_level']
    ]);

    // Redirection avec message de succès
    header('Location: index.php?success=1');
    exit;

} catch (Exception $e) {
    // En cas d'erreur, redirection avec message d'erreur
    header('Location: upload-forum.php?error=' . urlencode($e->getMessage()));
    exit;
}
?>
