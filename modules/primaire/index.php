<?php
require_once '../../templates/header.php';
?>

<div class="container mt-5">
    <h1 class="text-center mb-5">Section Primaire</h1>
    <div class="row">
        <!-- Mathématiques -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-calculator fa-3x text-primary mb-3"></i>
                    <h4>Mathématiques</h4>
                    <p>Exercices et leçons de mathématiques.</p>
                    <a href="/projet/modules/primaire/mathematiques.php" class="btn btn-primary">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Français -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-book fa-3x text-info mb-3"></i>
                    <h4>Français</h4>
                    <p>Grammaire, orthographe et lecture.</p>
                    <a href="/projet/modules/primaire/francais.php" class="btn btn-info">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Sciences -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-flask fa-3x text-success mb-3"></i>
                    <h4>Sciences</h4>
                    <p>Découverte des sciences et expériences.</p>
                    <a href="/projet/modules/primaire/sciences.php" class="btn btn-success">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Histoire -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-landmark fa-3x text-warning mb-3"></i>
                    <h4>Histoire</h4>
                    <p>Découverte de l'histoire et des civilisations.</p>
                    <a href="/projet/modules/primaire/histoire.php" class="btn btn-warning">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Géographie -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-globe-americas fa-3x text-danger mb-3"></i>
                    <h4>Géographie</h4>
                    <p>Exploration du monde et des pays.</p>
                    <a href="/projet/modules/primaire/geographie.php" class="btn btn-danger">Explorer</a>
                </div>
            </div>
        </div>
        <!-- Anglais -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-language fa-3x text-secondary mb-3"></i>
                    <h4>Anglais</h4>
                    <p>Apprentissage de l'anglais et vocabulaire.</p>
                    <a href="/projet/modules/primaire/anglais.php" class="btn btn-secondary">Explorer</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../../templates/footer.php';
?> 