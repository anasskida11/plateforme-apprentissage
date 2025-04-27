<?php
// Démarrer la session si pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclure les fichiers nécessaires
require_once __DIR__ . '/../includes/functions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme d'Apprentissage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/projet/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/projet/index.php">
                <i class="fas fa-graduation-cap"></i> Plateforme d'Apprentissage
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/projet/modules/maternelle/index.php">Maternelle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/projet/modules/primaire/index.php">Primaire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/projet/modules/scolaire/index.php">Scolaire</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item">
                            <?php
                            $username = '';
                            if (isset($_SESSION['username'])) {
                                $username = $_SESSION['username'];
                            } elseif (isset($_SESSION['user_id'])) {
                                require_once __DIR__ . '/../includes/db.php';
                                $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
                                $stmt->execute([$_SESSION['user_id']]);
                                $user = $stmt->fetch();
                                $username = $user ? $user['username'] : 'Profil';
                            } else {
                                $username = 'Profil';
                            }
                            ?>
                            <a class="nav-link" href="/projet/profile.php">
                                <i class="fas fa-user"></i> <?php echo htmlspecialchars($username); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/projet/modules/progress.php">
                                <i class="fas fa-chart-line"></i> Mes Progrès
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/projet/modules/favorites.php">
                                <i class="fas fa-star"></i> Favoris
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/projet/logout.php">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/projet/login.php">
                                <i class="fas fa-sign-in-alt"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/projet/register.php">
                                <i class="fas fa-user-plus"></i> Inscription
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4"> 