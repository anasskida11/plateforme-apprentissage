<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">Espace Scolaire</h1>
        <p class="lead">Apprendre et progresser à son rythme !</p>
    </div>

    <div class="row">
        <!-- Section Français -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 lessons-section">
                <div class="card-body text-center">
                    <i class="fas fa-book fa-3x mb-3 text-primary"></i>
                    <h3>Français</h3>
                    <p>Grammaire, conjugaison et vocabulaire</p>
                    <a href="francais.php" class="btn btn-primary">Étudier</a>
                </div>
            </div>
        </div>

        <!-- Section Mathématiques -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 exercises-section">
                <div class="card-body text-center">
                    <i class="fas fa-calculator fa-3x mb-3 text-success"></i>
                    <h3>Mathématiques</h3>
                    <p>Calcul, géométrie et problèmes</p>
                    <a href="mathematiques.php" class="btn btn-success">Calculer</a>
                </div>
            </div>
        </div>

        <!-- Section Sciences -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 games-section">
                <div class="card-body text-center">
                    <i class="fas fa-flask fa-3x mb-3 text-danger"></i>
                    <h3>Sciences</h3>
                    <p>Découvre le monde qui t'entoure</p>
                    <a href="sciences.php" class="btn btn-danger">Expérimenter</a>
                </div>
            </div>
        </div>

        <!-- Section Histoire-Géo -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 videos-section">
                <div class="card-body text-center">
                    <i class="fas fa-globe fa-3x mb-3 text-info"></i>
                    <h3>Histoire-Géo</h3>
                    <p>Voyage dans le temps et l'espace</p>
                    <a href="histoire-geo.php" class="btn btn-info">Explorer</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Deuxième rangée -->
    <div class="row mt-4">
        <!-- Section Arts -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-palette fa-3x mb-3 text-warning"></i>
                    <h3>Arts</h3>
                    <p>Dessine et crée des œuvres d'art</p>
                    <a href="arts.php" class="btn btn-warning">Créer</a>
                </div>
            </div>
        </div>

        <!-- Section Anglais -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-language fa-3x mb-3 text-purple"></i>
                    <h3>Anglais</h3>
                    <p>Learn English with fun!</p>
                    <a href="english.php" class="btn btn-purple">Learn</a>
                </div>
            </div>
        </div>

        <!-- Section Musique -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-music fa-3x mb-3 text-info"></i>
                    <h3>Musique</h3>
                    <p>Découvre le monde des sons</p>
                    <a href="musique.php" class="btn btn-info">Écouter</a>
                </div>
            </div>
        </div>

        <!-- Section Sport -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-running fa-3x mb-3 text-success"></i>
                    <h3>Sport</h3>
                    <p>Bouge et reste en forme</p>
                    <a href="sports.php" class="btn btn-success">Bouger</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include $root_path . 'templates/footer.php'; ?> 