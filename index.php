<?php
// Temporairement commenté jusqu'à la configuration de la base de données
// require_once 'includes/db.php';
// require_once 'includes/functions.php';

require_once 'includes/db.php';
require_once 'includes/functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Plateforme d'Apprentissage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/projet/assets/css/style.css" rel="stylesheet">
    <style>
        .welcome-section {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        .category-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            overflow: hidden;
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .category-card .card-body {
            padding: 30px;
        }

        .category-card h3 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .category-card ul {
            list-style: none;
            padding-left: 0;
        }

        .category-card ul li {
            margin: 10px 0;
            padding-left: 25px;
            position: relative;
        }

        .category-card ul li:before {
            content: "•";
            color: #3498db;
            font-size: 1.5em;
            position: absolute;
            left: 0;
            top: -5px;
        }

        .btn-explore {
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-explore:hover {
            transform: translateX(5px);
        }

        .feature-list li {
            margin: 15px 0;
            font-size: 1.1em;
        }

        .feature-list i {
            margin-right: 10px;
            color: #2ecc71;
        }
    </style>
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <div class="container">
        <!-- Section d'accueil -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4">Bienvenue sur la Plateforme d'Apprentissage</h1>
                <p class="lead">Apprenez de manière interactive et amusante</p>
            </div>
        </div>

        <?php if (isLoggedIn()): ?>
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <a href="/projet/profile.php" class="btn btn-success btn-lg mb-2"><i class="fas fa-tachometer-alt"></i> Accéder à mon tableau de bord</a>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isLoggedIn()): ?>
            <div class="row mb-5">
                <div class="col-md-6 offset-md-3">
                    <div class="card border-success">
                        <div class="card-body text-center">
                            <h3><i class="fas fa-unlock text-success"></i> Profitez de toutes les fonctionnalités !</h3>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Suivre votre progression</li>
                                <li><i class="fas fa-check text-success"></i> Sauvegarder vos favoris</li>
                                <li><i class="fas fa-check text-success"></i> Accéder au contenu exclusif</li>
                                <li><i class="fas fa-check text-success"></i> Gagner des récompenses</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Section À la une / Carrousel -->
        <div class="row mb-5">
            <div class="col-12">
                <div id="carouselAlaUne" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height:200px;">
                                <h3><i class="fas fa-gamepad text-primary"></i> Nouveaux jeux disponibles !</h3>
                                <p>Découvre les derniers exercices interactifs ajoutés.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height:200px;">
                                <h3><i class="fas fa-trophy text-warning"></i> Top Récompenses</h3>
                                <p>Gagne des badges et grimpe dans le classement !</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height:200px;">
                                <h3><i class="fas fa-users text-info"></i> Derniers membres inscrits</h3>
                                <p>Bienvenue aux nouveaux membres de la communauté !</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAlaUne" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Précédent</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselAlaUne" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Suivant</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Section Catégories -->
        <div class="row mb-5 justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="category-card card h-100 text-center bg-light">
                    <div class="card-body">
                        <i class="fas fa-child fa-3x text-success mb-3"></i>
                        <h3>Maternelle</h3>
                        <ul>
                            <li>Découverte des sons</li>
                            <li>Premiers jeux de logique</li>
                            <li>Graphisme et motricité</li>
                        </ul>
                        <a href="/projet/modules/maternelle/index.php" class="btn btn-explore btn-success mt-2">Explorer <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="category-card card h-100 text-center bg-light">
                    <div class="card-body">
                        <i class="fas fa-school fa-3x text-primary mb-3"></i>
                        <h3>Primaire</h3>
                        <ul>
                            <li>Mathématiques ludiques</li>
                            <li>Lecture et compréhension</li>
                            <li>Découverte du monde</li>
                        </ul>
                        <a href="/projet/modules/primaire/index.php" class="btn btn-explore btn-primary mt-2">Explorer <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="category-card card h-100 text-center bg-light">
                    <div class="card-body">
                        <i class="fas fa-graduation-cap fa-3x text-warning mb-3"></i>
                        <h3>Scolaire</h3>
                        <ul>
                            <li>Révisions générales</li>
                            <li>Quiz et défis</li>
                            <li>Suivi de progression</li>
                        </ul>
                        <a href="/projet/modules/scolaire/index.php" class="btn btn-explore btn-warning mt-2">Explorer <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Nouveautés -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card bg-info bg-opacity-10 border-info">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-bolt text-info"></i> Nouveautés</h4>
                        <ul class="feature-list">
                            <li><i class="fas fa-trophy"></i> Système de scores et badges amélioré</li>
                            <li><i class="fas fa-gamepad"></i> Nouveaux exercices interactifs chaque semaine</li>
                            <li><i class="fas fa-chart-line"></i> Suivi de progression détaillé</li>
                            <li><i class="fas fa-users"></i> Classements et défis entre membres</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isAdmin()): ?>
        <!-- Section admin rapide -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fas fa-user-shield fa-2x me-3"></i>
                    <div>
                        <b>Accès administrateur :</b> <a href="/projet/admin/members.php" class="btn btn-sm btn-outline-dark ms-2"><i class="fas fa-users-cog"></i> Gérer les membres</a>
                        <a href="/projet/admin/dashboard.php" class="btn btn-sm btn-outline-dark ms-2"><i class="fas fa-chart-bar"></i> Statistiques admin</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!isLoggedIn()): ?>
        <!-- Section de connexion pour les utilisateurs non connectés -->
        <div class="row mb-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3><i class="fas fa-lock text-warning"></i> Contenu Exclusif</h3>
                        <p>Connectez-vous pour accéder à toutes les fonctionnalités :</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success"></i> Suivre votre progression</li>
                            <li><i class="fas fa-check text-success"></i> Sauvegarder vos favoris</li>
                            <li><i class="fas fa-check text-success"></i> Accéder au contenu exclusif</li>
                            <li><i class="fas fa-check text-success"></i> Gagner des récompenses</li>
                        </ul>
                        <div class="mt-3">
                            <a href="/projet/login.php" class="btn btn-primary me-2">
                                <i class="fas fa-sign-in-alt"></i> Se connecter
                            </a>
                            <a href="/projet/register.php" class="btn btn-outline-primary">
                                <i class="fas fa-user-plus"></i> S'inscrire
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <?php include 'templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
