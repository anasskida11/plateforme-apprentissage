<?php
// Démarrer la session si pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclure les fichiers nécessaires
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Vérifier si l'utilisateur est connecté
if (!isLoggedIn()) {
    redirect('/projet/login.php');
}

// Récupérer les informations de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user || !isset($user['email'])) {
    echo '<div class="alert alert-danger text-center mt-5">Profil introuvable ou données incomplètes. Veuillez contacter l\'administrateur.</div>';
    include 'templates/footer.php';
    exit;
}

// FAKE STATS POUR SAV!OR
if ($user['username'] === 'SAV!OR') {
    $stats = [
        'total_activities' => 120,
        'completed_activities' => 114,
        'last_activity' => date('Y-m-d H:i:s', strtotime('-1 hour'))
    ];
    $rewards = [
        [
            'title' => 'Champion du Mois',
            'description' => 'A terminé le plus d\'activités ce mois-ci',
        ],
        [
            'title' => 'Maître du Français',
            'description' => 'Score parfait en français',
        ],
        [
            'title' => 'Explorateur',
            'description' => 'A découvert toutes les sections',
        ],
        [
            'title' => 'Vitesse Lumière',
            'description' => 'A terminé une activité en moins de 30s',
        ],
        [
            'title' => 'Fidèle',
            'description' => 'Connecté 30 jours d\'affilée',
        ],
        [
            'title' => 'Génie des Maths',
            'description' => 'Score parfait en mathématiques',
        ],
        [
            'title' => 'Super Lecteur',
            'description' => 'A lu 50 histoires',
        ],
        [
            'title' => 'Ami des Animaux',
            'description' => 'A terminé tous les quiz sur les animaux',
        ],
        [
            'title' => 'Artiste',
            'description' => 'A créé 10 dessins',
        ],
        [
            'title' => 'Champion du Calcul',
            'description' => 'A résolu 100 opérations',
        ],
        [
            'title' => 'Curieux',
            'description' => 'A consulté toutes les nouveautés',
        ],
        [
            'title' => 'Top Classement',
            'description' => 'Dans le top 3 du classement général',
        ]
    ];
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

// Récupérer les récompenses
$stmt = $pdo->prepare("SELECT * FROM user_rewards WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$rewards = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Plateforme d'Apprentissage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/projet/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <!-- Informations du profil -->
            <div class="col-md-4">
                <div class="card profile-card mb-4">
                    <div class="card-body text-center">
                        <div class="profile-avatar mb-4">
                            <i class="fas fa-user-circle fa-5x text-primary"></i>
                        </div>
                        <h3 class="card-title"><?php echo htmlspecialchars($user['username']); ?></h3>
                        <p class="text-muted">
                            <?php echo isset($user['email']) ? htmlspecialchars($user['email']) : '<span class="text-danger">Email non disponible</span>'; ?>
                        </p>
                        <div class="profile-stats mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="stat-item">
                                        <i class="fas fa-check-circle text-success"></i>
                                        <span><?php echo $stats['completed_activities']; ?></span>
                                        <small>Activités complétées</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-item">
                                        <i class="fas fa-trophy text-warning"></i>
                                        <span><?php echo count($rewards); ?></span>
                                        <small>Récompenses</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (isset($user['is_admin']) && $user['is_admin']): ?>
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0"><i class="fas fa-shield-alt"></i> Administration</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="/projet/admin/members.php" class="btn btn-primary">
                                <i class="fas fa-users"></i> Gérer les Membres
                            </a>
                            <a href="/projet/admin/dashboard.php" class="btn btn-info">
                                <i class="fas fa-chart-line"></i> Tableau de Bord
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Contenu principal -->
            <div class="col-md-8">
                <!-- Progression -->
                <div class="card mb-4">
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
                        <p>Dernière activité : <?php echo $stats['last_activity'] ? date('d/m/Y H:i', strtotime($stats['last_activity'])) : 'Aucune activité'; ?></p>
                    </div>
                </div>

                <!-- Récompenses -->
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-trophy text-warning"></i> Mes Récompenses</h4>
                    </div>
                    <div class="card-body">
                        <?php if (empty($rewards)): ?>
                            <p class="text-center">Aucune récompense pour le moment. Continuez à apprendre !</p>
                        <?php else: ?>
                            <div class="row">
                                <?php foreach ($rewards as $reward): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="reward-card">
                                            <i class="fas fa-medal fa-2x text-warning"></i>
                                            <h5><?php echo htmlspecialchars($reward['title']); ?></h5>
                                            <p><?php echo htmlspecialchars($reward['description']); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .profile-card {
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 15px;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-item {
        text-align: center;
        padding: 10px;
    }

    .stat-item i {
        font-size: 2rem;
        margin-bottom: 5px;
    }

    .stat-item span {
        display: block;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .stat-item small {
        color: #6c757d;
    }

    .reward-card {
        text-align: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .reward-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .exclusive-content-card {
        text-align: center;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .exclusive-content-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .exclusive-content-card i {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .progress {
        height: 25px;
        border-radius: 12px;
    }

    .progress-bar {
        background: linear-gradient(45deg, #3498db, #2ecc71);
    }
    </style>

    <?php include 'templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 