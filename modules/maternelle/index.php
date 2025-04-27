<?php
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maternelle - Activités</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/projet/assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php include '../../templates/header.php'; ?>
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-5">Maternelle : Activités</h1>
            <p class="lead">Choisissez une activité pour commencer l'apprentissage !</p>
        </div>
    </div>
    <div class="row">
        <!-- Alphabet -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-font fa-3x text-primary mb-3"></i>
                    <h4>Alphabet</h4>
                    <p>Découverte des lettres et de l'alphabet.</p>
                    <a href="/projet/modules/maternelle/alphabet.php" class="btn btn-primary">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Chiffres (Numbers) -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-sort-numeric-up fa-3x text-info mb-3"></i>
                    <h4>Chiffres</h4>
                    <p>Apprendre à compter et reconnaître les chiffres.</p>
                    <a href="/projet/modules/maternelle/numbers.php" class="btn btn-info">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Formes (Shapes) -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-shapes fa-3x text-secondary mb-3"></i>
                    <h4>Formes</h4>
                    <p>Découvrir et reconnaître les formes géométriques.</p>
                    <a href="/projet/modules/maternelle/shapes.php" class="btn btn-secondary">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Animaux (Animals) -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-dog fa-3x text-warning mb-3"></i>
                    <h4>Animaux</h4>
                    <p>Découvrir les animaux et leurs habitats.</p>
                    <a href="/projet/modules/maternelle/animals.php" class="btn btn-warning">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Jeux éducatifs (Games) -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-gamepad fa-3x text-success mb-3"></i>
                    <h4>Jeux éducatifs</h4>
                    <p>Jouer et apprendre avec des jeux interactifs.</p>
                    <a href="#" class="btn btn-success disabled">Bientôt disponible</a>
                </div>
            </div>
        </div>
        <!-- Coloriage (Coloring) -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-paint-brush fa-3x text-danger mb-3"></i>
                    <h4>Coloriage</h4>
                    <p>Colorier des images amusantes pour apprendre.</p>
                    <a href="/projet/modules/maternelle/coloring.php" class="btn btn-danger">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Mots (Words) -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-spell-check fa-3x text-info mb-3"></i>
                    <h4>Mots</h4>
                    <p>Apprendre de nouveaux mots et leur orthographe.</p>
                    <a href="/projet/modules/maternelle/words.php" class="btn btn-info">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Formes & Couleurs (Shapes & Colors) -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-palette fa-3x text-secondary mb-3"></i>
                    <h4>Formes & Couleurs</h4>
                    <p>Associer les formes et les couleurs.</p>
                    <a href="/projet/modules/maternelle/shapes-colors.php" class="btn btn-secondary">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Chansons (Songs) -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-music fa-3x text-warning mb-3"></i>
                    <h4>Chansons</h4>
                    <p>Chanter et apprendre avec des chansons amusantes.</p>
                    <a href="/projet/modules/maternelle/songs.php" class="btn btn-warning">Explorer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../../templates/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 