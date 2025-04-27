<?php include '../../templates/header.php'; ?>

<div class="container mt-4">
    <div class="jumbotron text-center">
        <h1 class="display-4">Éducation Physique et Sportive</h1>
        <p class="lead">Découvre le monde du sport, apprends les règles et développe tes capacités physiques !</p>
    </div>

    <!-- Sélecteur de niveau -->
    <div class="level-selector mb-4 text-center">
        <h3>Choisis ton niveau</h3>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-primary" onclick="changeLevel('CP')">CP</button>
            <button type="button" class="btn btn-outline-primary" onclick="changeLevel('CE1')">CE1</button>
            <button type="button" class="btn btn-outline-primary" onclick="changeLevel('CE2')">CE2</button>
            <button type="button" class="btn btn-outline-primary" onclick="changeLevel('CM1')">CM1</button>
            <button type="button" class="btn btn-outline-primary" onclick="changeLevel('CM2')">CM2</button>
        </div>
    </div>

    <div class="row">
        <!-- Sports Collectifs -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h3>Sports Collectifs</h3>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action" onclick="startLesson('football')">
                            <i class="fas fa-futbol"></i> Football - Les règles de base
                        </a>
                        <a href="#" class="list-group-item list-group-item-action" onclick="startLesson('basketball')">
                            <i class="fas fa-basketball-ball"></i> Basketball - Apprends à dribbler
                        </a>
                        <a href="#" class="list-group-item list-group-item-action" onclick="startLesson('handball')">
                            <i class="fas fa-hand-paper"></i> Handball - Les passes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Athlétisme -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h3>Athlétisme</h3>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action" onclick="startLesson('course')">
                            <i class="fas fa-running"></i> Course - Techniques de sprint
                        </a>
                        <a href="#" class="list-group-item list-group-item-action" onclick="startLesson('saut')">
                            <i class="fas fa-arrow-up"></i> Saut en longueur
                        </a>
                        <a href="#" class="list-group-item list-group-item-action" onclick="startLesson('lancer')">
                            <i class="fas fa-bullseye"></i> Lancer de balle
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gymnastique -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-warning">
                    <h3>Gymnastique</h3>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action" onclick="startLesson('equilibre')">
                            <i class="fas fa-balance-scale"></i> Exercices d'équilibre
                        </a>
                        <a href="#" class="list-group-item list-group-item-action" onclick="startLesson('roulade')">
                            <i class="fas fa-redo"></i> La roulade avant
                        </a>
                        <a href="#" class="list-group-item list-group-item-action" onclick="startLesson('etirements')">
                            <i class="fas fa-child"></i> Étirements
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jeux et Défis -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h3>Jeux et Défis</h3>
                </div>
                <div class="card-body">
                    <div id="defi-du-jour" class="text-center mb-4">
                        <h4>Défi du jour</h4>
                        <div class="card">
                            <div class="card-body">
                                <h5>Course de relais virtuelle</h5>
                                <p>Réalise le parcours le plus rapidement possible !</p>
                                <button class="btn btn-info" onclick="startChallenge()">Commencer le défi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.3s;
}
.card:hover {
    transform: translateY(-5px);
}
.list-group-item {
    transition: background-color 0.3s;
}
.list-group-item:hover {
    background-color: #f8f9fa;
}
.btn-group .btn {
    margin: 0 5px;
}
</style>

<script>
function changeLevel(level) {
    alert('Niveau sélectionné : ' + level);
    updateContent();
}

function updateContent() {
    // Mettre à jour le contenu en fonction du niveau
}

function startLesson(topic) {
    alert('Début de la leçon : ' + topic);
}

function startChallenge() {
    alert('Prépare-toi pour le défi du jour !');
}
</script>

<?php include '../../templates/footer.php'; ?> 