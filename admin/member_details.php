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

// Vérifier si l'ID du membre est fourni
if (!isset($_GET['id'])) {
    redirect('/projet/admin/members.php');
}

$memberId = $_GET['id'];

// Récupérer les informations du membre
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$memberId]);
$member = $stmt->fetch();

if (!$member) {
    redirect('/projet/admin/members.php');
}

// Récupérer les statistiques détaillées
$stmt = $pdo->prepare("
    SELECT 
        COUNT(DISTINCT up.content_id) as total_activities,
        COUNT(CASE WHEN up.completed = 1 THEN 1 END) as completed_activities,
        COUNT(DISTINCT uf.content_id) as total_favorites,
        COUNT(DISTINCT ur.id) as total_rewards,
        MAX(up.created_at) as last_activity
    FROM users u
    LEFT JOIN user_progress up ON u.id = up.user_id
    LEFT JOIN user_favorites uf ON u.id = uf.user_id
    LEFT JOIN user_rewards ur ON u.id = ur.user_id
    WHERE u.id = ?
    GROUP BY u.id
");
$stmt->execute([$memberId]);
$stats = $stmt->fetch();

// Récupérer les activités récentes
$stmt = $pdo->prepare("
    SELECT c.*, up.created_at as completed_at
    FROM user_progress up
    JOIN contents c ON up.content_id = c.id
    WHERE up.user_id = ? AND up.completed = 1
    ORDER BY up.created_at DESC
    LIMIT 10
");
$stmt->execute([$memberId]);
$recentActivities = $stmt->fetchAll();

// Récupérer les favoris
$stmt = $pdo->prepare("
    SELECT c.*, uf.created_at as favorited_at
    FROM user_favorites uf
    JOIN contents c ON uf.content_id = c.id
    WHERE uf.user_id = ?
    ORDER BY uf.created_at DESC
    LIMIT 10
");
$stmt->execute([$memberId]);
$favorites = $stmt->fetchAll();

// Récupérer les récompenses
$stmt = $pdo->prepare("
    SELECT *
    FROM user_rewards
    WHERE user_id = ?
    ORDER BY created_at DESC
");
$stmt->execute([$memberId]);
$rewards = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Membre - Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/projet/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../templates/header.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <!-- Informations du membre -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-user text-primary"></i> Informations</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-circle fa-5x text-primary"></i>
                        </div>
                        <h5 class="card-title"><?php echo htmlspecialchars($member['username']); ?></h5>
                        <p class="card-text">
                            <strong>Email:</strong> <?php echo htmlspecialchars($member['email']); ?><br>
                            <strong>Inscription:</strong> <?php echo date('d/m/Y', strtotime($member['created_at'])); ?><br>
                            <strong>Dernière activité:</strong> <?php echo $stats['last_activity'] ? date('d/m/Y H:i', strtotime($stats['last_activity'])) : 'Jamais'; ?><br>
                            <strong>Statut:</strong> <span class="badge bg-<?php echo $member['status']==='banned'?'danger':($member['status']==='inactive'?'secondary':'success'); ?>"><?php echo ucfirst($member['status']); ?></span><br>
                            <strong>Rôle:</strong> <span class="badge bg-info text-dark"><?php echo ucfirst($member['role']); ?></span>
                        </p>
                        <div class="d-flex flex-wrap gap-2 mt-3">
                            <a href="/projet/admin/members.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
                            <a href="reset_password.php?id=<?php echo $memberId; ?>" class="btn btn-outline-warning"><i class="fas fa-key"></i> Réinitialiser le mot de passe</a>
                            <a href="send_message.php?id=<?php echo $memberId; ?>" class="btn btn-outline-primary"><i class="fas fa-envelope"></i> Envoyer un message</a>
                            <button class="btn btn-outline-danger" onclick="confirmDelete(<?php echo $memberId; ?>)"><i class="fas fa-user-slash"></i> Supprimer/Désactiver</button>
                        </div>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-chart-bar text-success"></i> Statistiques</h4>
                    </div>
                    <div class="card-body">
                        <div class="stat-item">
                            <i class="fas fa-check-circle text-success"></i>
                            <span>Activités complétées: <?php echo $stats['completed_activities']; ?>/<?php echo $stats['total_activities']; ?></span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-star text-warning"></i>
                            <span>Favoris: <?php echo $stats['total_favorites']; ?></span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-trophy text-info"></i>
                            <span>Récompenses: <?php echo $stats['total_rewards']; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <!-- Activités récentes -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-history text-primary"></i> Activités Récentes</h4>
                    </div>
                    <div class="card-body">
                        <?php if (empty($recentActivities)): ?>
                            <p class="text-center">Aucune activité récente.</p>
                        <?php else: ?>
                            <div class="list-group">
                                <?php foreach ($recentActivities as $activity): ?>
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1"><?php echo htmlspecialchars($activity['title']); ?></h5>
                                            <small class="text-muted">
                                                <?php echo date('d/m/Y H:i', strtotime($activity['completed_at'])); ?>
                                            </small>
                                        </div>
                                        <p class="mb-1"><?php echo htmlspecialchars($activity['description']); ?></p>
                                        <small class="text-muted">
                                            <i class="fas fa-<?php echo getContentTypeIcon($activity['type']); ?>"></i>
                                            <?php echo ucfirst($activity['type']); ?> - 
                                            <span class="badge bg-<?php echo getDifficultyBadgeClass($activity['difficulty_level']); ?>">
                                                <?php echo ucfirst($activity['difficulty_level']); ?>
                                            </span>
                                        </small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if(count($recentActivities) === 10): ?>
                                <div class="text-center mt-2"><a href="member_history.php?id=<?php echo $memberId; ?>&type=activities" class="btn btn-sm btn-outline-info">Voir plus</a></div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Favoris -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-star text-warning"></i> Favoris</h4>
                    </div>
                    <div class="card-body">
                        <?php if (empty($favorites)): ?>
                            <p class="text-center">Aucun favori.</p>
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
                            <?php if(count($favorites) === 10): ?>
                                <div class="text-center mt-2"><a href="member_history.php?id=<?php echo $memberId; ?>&type=favorites" class="btn btn-sm btn-outline-info">Voir plus</a></div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Récompenses -->
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-trophy text-info"></i> Récompenses</h4>
                    </div>
                    <div class="card-body">
                        <?php if (empty($rewards)): ?>
                            <p class="text-center">Aucune récompense.</p>
                        <?php else: ?>
                            <div class="row">
                                <?php foreach ($rewards as $reward): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="reward-card badge bg-warning text-dark w-100 mb-2 p-2">
                                            <i class="fas fa-medal"></i> <b><?php echo htmlspecialchars($reward['title']); ?></b> <span class="ms-2 small"><?php echo htmlspecialchars($reward['description']); ?></span>
                                            <span class="float-end text-muted"><?php echo date('d/m/Y', strtotime($reward['created_at'])); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if(count($rewards) === 10): ?>
                                <div class="text-center mt-2"><a href="member_history.php?id=<?php echo $memberId; ?>&type=rewards" class="btn btn-sm btn-outline-info">Voir plus</a></div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function confirmDelete(id) {
        if(confirm('Êtes-vous sûr de vouloir supprimer ou désactiver ce membre ? Cette action est irréversible.')) {
            window.location.href = 'delete_member.php?id=' + id;
        }
    }
    </script>
</body>
</html> 