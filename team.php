<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre Équipe - Plateforme d'Apprentissage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/projet/assets/css/style.css" rel="stylesheet">
    <style>
        .team-member {
            transition: transform 0.3s;
        }
        .team-member:hover {
            transform: translateY(-10px);
        }
        .team-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #3498db;
        }
        .social-links a {
            color: #666;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s;
        }
        .social-links a:hover {
            color: #3498db;
        }
    </style>
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4">Notre Équipe</h1>
                <p class="lead">Découvrez les personnes derrière la plateforme d'apprentissage</p>
            </div>
        </div>

        <div class="row">
            <!-- Hicham Mahboub -->
            <div class="col-md-3 mb-4">
                <div class="card team-member h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-user-circle team-icon"></i>
                        <h3>Hicham Mahboub</h3>
                        <p class="text-muted">Étudiant - Développeur Principal</p>
                        <p>Étudiant passionné par le développement web, Hicham a conçu et développé cette plateforme dans le cadre d'un projet universitaire.</p>
                    </div>
                </div>
            </div>

            <!-- Anass Kida -->
            <div class="col-md-3 mb-4">
                <div class="card team-member h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-code team-icon"></i>
                        <h3>Anass Kida</h3>
                        <p class="text-muted">Étudiant - Développeur Backend</p>
                        <p>Étudiant en informatique, Anass a contribué à la création de l'architecture backend de la plateforme dans le cadre de ce projet étudiant.</p>
                    </div>
                </div>
            </div>

            <!-- Oussama Mesbahi -->
            <div class="col-md-3 mb-4">
                <div class="card team-member h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-paint-brush team-icon"></i>
                        <h3>Oussama Mesbahi</h3>
                        <p class="text-muted">Étudiant - Designer UI/UX</p>
                        <p>Étudiant créatif, Oussama a imaginé l'interface et l'expérience utilisateur de la plateforme dans le cadre de ce projet d'étude.</p>
                    </div>
                </div>
            </div>

            <!-- Aya Elasri -->
            <div class="col-md-3 mb-4">
                <div class="card team-member h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-graduation-cap team-icon"></i>
                        <h3>Aya Elasri</h3>
                        <p class="text-muted">Étudiante - Expert Pédagogique</p>
                        <p>Étudiante en sciences de l'éducation, Aya a contribué à la conception du contenu pédagogique pour ce projet universitaire.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Technologies -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Technologies Utilisées</h3>
                        <div class="row text-center">
                            <div class="col-md-3 mb-3">
                                <i class="fab fa-php fa-3x mb-2"></i>
                                <h5>PHP</h5>
                            </div>
                            <div class="col-md-3 mb-3">
                                <i class="fab fa-html5 fa-3x mb-2"></i>
                                <h5>HTML5</h5>
                            </div>
                            <div class="col-md-3 mb-3">
                                <i class="fab fa-css3-alt fa-3x mb-2"></i>
                                <h5>CSS3</h5>
                            </div>
                            <div class="col-md-3 mb-3">
                                <i class="fab fa-js fa-3x mb-2"></i>
                                <h5>JavaScript</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 