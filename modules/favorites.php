<?php
// Démarrer la session si pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclure les fichiers nécessaires
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

// Vérifier si l'utilisateur est connecté
if (!isLoggedIn()) {
    redirect('/projet/login.php');
}

// Traitement de l'ajout/suppression des favoris
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contentId = $_POST['content_id'];
    $action = $_POST['action'];

    if ($action === 'add') {
        $stmt = $pdo->prepare("INSERT INTO user_favorites (user_id, content_id) VALUES (?, ?)");
        $stmt->execute([$_SESSION['user_id'], $contentId]);
    } elseif ($action === 'remove') {
        $stmt = $pdo->prepare("DELETE FROM user_favorites WHERE user_id = ? AND content_id = ?");
        $stmt->execute([$_SESSION['user_id'], $contentId]);
    }
}

// Récupérer les favoris de l'utilisateur
$stmt = $pdo->prepare("
    SELECT c.*, f.created_at as favorited_at
    FROM user_favorites f
    JOIN contents c ON f.content_id = c.id
    WHERE f.user_id = ?
    ORDER BY f.created_at DESC
");
$stmt->execute([$_SESSION['user_id']]);
$favorites = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris - Plateforme d'Apprentissage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/projet/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../templates/header.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-star text-warning"></i> Mes Favoris</h4>
                    </div>
                    <div class="card-body">
                        <?php if (empty($favorites)): ?>
                            <p class="text-center">Vous n'avez pas encore de favoris.</p>
                        <?php else: ?>
                            <div class="list-group">
                                <?php foreach ($favorites as $favorite): ?>
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1"><?php echo htmlspecialchars($favorite['title']); ?></h5>
                                            <small class="text-muted">
                                                Ajouté le <?php echo date('d/m/Y', strtotime($favorite['favorited_at'])); ?>
                                            </small>
                                        </div>
                                        <p class="mb-1"><?php echo htmlspecialchars($favorite['description']); ?></p>
                                        <small class="text-muted">
                                            <i class="fas fa-<?php echo getContentTypeIcon($favorite['type']); ?>"></i>
                                            <?php echo ucfirst($favorite['type']); ?> - 
                                            <span class="badge bg-<?php echo getDifficultyBadgeClass($favorite['difficulty_level']); ?>">
                                                <?php echo ucfirst($favorite['difficulty_level']); ?>
                                            </span>
                                        </small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Fonction pour obtenir la classe de badge selon le niveau de difficulté
function getDifficultyBadgeClass($level) {
    switch ($level) {
        case 'facile':
            return 'success';
        case 'moyen':
            return 'warning';
        case 'avancé':
            return 'danger';
        default:
            return 'secondary';
    }
}

// Fonction pour obtenir l'URL du contenu
function getContentUrl($item) {
    switch ($item['type']) {
        case 'video':
            return '/projet/modules/videos.php?id=' . $item['id'];
        case 'audio':
            return '/projet/modules/songs.php?id=' . $item['id'];
        case 'image':
            return '/projet/modules/images.php?id=' . $item['id'];
        case 'text':
            return '/projet/modules/lessons.php?id=' . $item['id'];
        default:
            return '#';
    }
}
?> 