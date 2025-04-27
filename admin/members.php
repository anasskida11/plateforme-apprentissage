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

// Récupérer tous les membres avec leurs statistiques
$stmt = $pdo->prepare("
    SELECT 
        u.*,
        COUNT(DISTINCT up.content_id) as total_activities,
        COUNT(CASE WHEN up.completed = 1 THEN 1 END) as completed_activities,
        COUNT(DISTINCT uf.content_id) as total_favorites,
        COUNT(DISTINCT ur.id) as total_rewards,
        MAX(up.created_at) as last_activity
    FROM users u
    LEFT JOIN user_progress up ON u.id = up.user_id
    LEFT JOIN user_favorites uf ON u.id = uf.user_id
    LEFT JOIN user_rewards ur ON u.id = ur.user_id
    GROUP BY u.id
    ORDER BY u.created_at DESC
");
$stmt->execute();
$members = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Membres - Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/projet/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../templates/header.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4><i class="fas fa-users text-primary"></i> Gestion des Membres</h4>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-primary" onclick="exportToCSV()">
                                <i class="fas fa-download"></i> Exporter
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom d'utilisateur</th>
                                        <th>Email</th>
                                        <th>Date d'inscription</th>
                                        <th>Activités complétées</th>
                                        <th>Favoris</th>
                                        <th>Récompenses</th>
                                        <th>Dernière activité</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($members as $member): ?>
                                        <tr>
                                            <td><?php echo $member['id']; ?></td>
                                            <td><?php echo htmlspecialchars($member['username']); ?></td>
                                            <td><?php echo htmlspecialchars($member['email']); ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($member['created_at'])); ?></td>
                                            <td>
                                                <span class="badge bg-success">
                                                    <?php echo $member['completed_activities']; ?>/<?php echo $member['total_activities']; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning">
                                                    <?php echo $member['total_favorites']; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    <?php echo $member['total_rewards']; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php echo $member['last_activity'] ? date('d/m/Y H:i', strtotime($member['last_activity'])) : 'Jamais'; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="member_details.php?id=<?php echo $member['id']; ?>" 
                                                       class="btn btn-sm btn-primary" 
                                                       title="Voir les détails">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-danger" 
                                                            onclick="deleteMember(<?php echo $member['id']; ?>)"
                                                            title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function deleteMember(userId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')) {
            window.location.href = `delete_member.php?id=${userId}`;
        }
    }

    function exportToCSV() {
        // Créer le contenu CSV
        let csv = 'ID,Username,Email,Date d\'inscription,Activités complétées,Favoris,Récompenses,Dernière activité\n';
        
        // Ajouter les données
        document.querySelectorAll('tbody tr').forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowData = [
                cells[0].textContent,
                cells[1].textContent,
                cells[2].textContent,
                cells[3].textContent,
                cells[4].textContent,
                cells[5].textContent,
                cells[6].textContent,
                cells[7].textContent
            ];
            csv += rowData.join(',') + '\n';
        });

        // Créer et télécharger le fichier
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'membres_' + new Date().toISOString().slice(0,10) + '.csv';
        link.click();
    }
    </script>
</body>
</html> 