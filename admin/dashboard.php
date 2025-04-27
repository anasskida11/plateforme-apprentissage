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

// Récupérer les statistiques globales
$stats = [
    'total_users' => 0,
    'active_users' => 0,
    'total_activities' => 0,
    'total_rewards' => 0
];

// Nombre total d'utilisateurs
$stmt = $pdo->query("SELECT COUNT(*) FROM users");
$stats['total_users'] = $stmt->fetchColumn();

// Utilisateurs actifs (avec au moins une activité dans les 30 derniers jours)
$stmt = $pdo->query("
    SELECT COUNT(DISTINCT user_id) 
    FROM user_progress 
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
");
$stats['active_users'] = $stmt->fetchColumn();

// Nombre total d'activités complétées
$stmt = $pdo->query("SELECT COUNT(*) FROM user_progress WHERE completed = 1");
$stats['total_activities'] = $stmt->fetchColumn();

// Nombre total de récompenses attribuées
$stmt = $pdo->query("SELECT COUNT(*) FROM user_rewards");
$stats['total_rewards'] = $stmt->fetchColumn();

// Récupérer les dernières activités
$stmt = $pdo->prepare("
    SELECT 
        u.username,
        c.title as content_title,
        up.created_at
    FROM user_progress up
    JOIN users u ON up.user_id = u.id
    JOIN contents c ON up.content_id = c.id
    WHERE up.completed = 1
    ORDER BY up.created_at DESC
    LIMIT 10
");
$stmt->execute();
$recent_activities = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/projet/assets/css/style.css" rel="stylesheet">
    <style>
        .stat-card {
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .activity-list {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../templates/header.php'; ?>

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2><i class="fas fa-chart-line"></i> Tableau de Bord</h2>
                    <div>
                        <a href="/projet/admin/members.php" class="btn btn-primary">
                            <i class="fas fa-users"></i> Gérer les Membres
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card bg-primary text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-users stat-icon"></i>
                        <h3><?php echo isset($stats['total_users']) ? htmlspecialchars($stats['total_users']) : 'Valeur non disponible'; ?></h3>
                        <p class="mb-0">Utilisateurs Total</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-success text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-user-check stat-icon"></i>
                        <h3><?php echo isset($stats['active_users']) ? htmlspecialchars($stats['active_users']) : 'Valeur non disponible'; ?></h3>
                        <p class="mb-0">Utilisateurs Actifs</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-info text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-tasks stat-icon"></i>
                        <h3><?php echo isset($stats['total_activities']) ? htmlspecialchars($stats['total_activities']) : 'Valeur non disponible'; ?></h3>
                        <p class="mb-0">Activités Complétées</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-warning text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-trophy stat-icon"></i>
                        <h3><?php echo isset($stats['total_rewards']) ? htmlspecialchars($stats['total_rewards']) : 'Valeur non disponible'; ?></h3>
                        <p class="mb-0">Récompenses Attribuées</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activités Récentes -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-history"></i> Activités Récentes</h4>
                    </div>
                    <div class="card-body">
                        <div class="activity-list">
                            <?php if (empty($recent_activities)): ?>
                                <p class="text-center">Aucune activité récente.</p>
                            <?php else: ?>
                                <div class="list-group">
                                    <?php foreach ($recent_activities as $activity): ?>
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">
                                                    <?php echo htmlspecialchars($activity['username']); ?>
                                                </h5>
                                                <small class="text-muted">
                                                    <?php echo date('d/m/Y H:i', strtotime($activity['created_at'])); ?>
                                                </small>
                                            </div>
                                            <p class="mb-1">
                                                A complété : <?php echo htmlspecialchars($activity['content_title']); ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 