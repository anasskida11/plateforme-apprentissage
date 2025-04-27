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

// Récupérer les statistiques de l'utilisateur
$stmt = $pdo->prepare("
    SELECT 
        COUNT(DISTINCT content_id) as total_activities,
        COUNT(CASE WHEN completed = 1 THEN 1 END) as completed_activities,
        MAX(created_at) as last_activity
    FROM user_progress 
    WHERE user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$stats = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Progression - Plateforme d'Apprentissage</title>
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
                        <h4><i class="fas fa-chart-line text-primary"></i> Ma Progression</h4>
                    </div>
                    <div class="card-body">
                        <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: <?php echo ($stats['completed_activities'] / max($stats['total_activities'], 1)) * 100; ?>%">
                                <?php echo round(($stats['completed_activities'] / max($stats['total_activities'], 1)) * 100); ?>%
                            </div>
                        </div>
                        <p>Dernière activité : <?php echo date('d/m/Y H:i', strtotime($stats['last_activity'])); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 