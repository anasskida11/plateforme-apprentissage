<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">Éducation Physique et Sportive</h1>
        <p class="lead">Bouge et amuse-toi avec le sport !</p>
    </div>

    <!-- Sélection du niveau -->
    <div class="level-selector mb-5">
        <h2 class="text-center mb-4">Choisis ton niveau</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="btn-group w-100" role="group">
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('cp')">CP</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('ce1')">CE1</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('ce2')">CE2</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('cm1')">CM1</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('cm2')">CM2</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sections principales -->
    <div class="row mb-4">
        <!-- Activités Physiques -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-running text-primary"></i> Activités Physiques
                    </h3>
                    <div class="activities-topics">
                        <div class="topic-item mb-3" onclick="startLesson('course')">
                            <i class="fas fa-running"></i> Course et Athlétisme
                            <span class="badge bg-primary">5 exercices</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('gymnastique')">
                            <i class="fas fa-child"></i> Gymnastique
                            <span class="badge bg-primary">6 exercices</span>
                        </div>
                        <div class="topic-item" onclick="startLesson('natation')">
                            <i class="fas fa-swimmer"></i> Natation
                            <span class="badge bg-primary">4 exercices</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sports Collectifs -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-basketball-ball text-success"></i> Sports Collectifs
                    </h3>
                    <div class="team-sports-topics">
                        <div class="topic-item mb-3" onclick="startLesson('football')">
                            <i class="fas fa-futbol"></i> Football
                            <span class="badge bg-success">5 exercices</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('basketball')">
                            <i class="fas fa-basketball-ball"></i> Basketball
                            <span class="badge bg-success">4 exercices</span>
                        </div>
                        <div class="topic-item" onclick="startLesson('handball')">
                            <i class="fas fa-volleyball-ball"></i> Handball
                            <span class="badge bg-success">4 exercices</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Jeux et Coordination -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-dice text-warning"></i> Jeux et Coordination
                    </h3>
                    <div class="games-section">
                        <div class="game-carousel text-center">
                            <div class="game-preview mb-4">
                                <div class="game-image mb-3">
                                    <i class="fas fa-dice fa-3x text-warning"></i>
                                </div>
                                <h4 id="gameTitle" class="mb-2">Parcours d'Obstacles</h4>
                                <p id="gameDuration" class="text-muted">Durée : 15 minutes</p>
                                <div class="game-controls">
                                    <button onclick="startGame()" class="btn btn-warning">
                                        Commencer
                                    </button>
                                </div>
                            </div>
                            <div class="navigation-buttons">
                                <button onclick="previousGame()" class="btn btn-outline-warning me-2">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button onclick="nextGame()" class="btn btn-outline-warning">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Santé et Bien-être -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-heart text-danger"></i> Santé et Bien-être
                    </h3>
                    <div class="health-section text-center">
                        <div class="health-preview mb-4">
                            <h4 class="display-6 mb-3">Échauffement</h4>
                            <div class="health-image mb-3">
                                <i class="fas fa-heartbeat fa-3x text-danger"></i>
                            </div>
                            <p class="mb-3">Prépare ton corps avant l'effort !</p>
                            <button onclick="startWarmup()" class="btn btn-danger">
                                Commencer
                            </button>
                        </div>
                        <div class="difficulty-rating">
                            <p class="mb-2">Intensité :</p>
                            <div class="stars">
                                <i class="fas fa-star text-danger"></i>
                                <i class="fas fa-star text-danger"></i>
                                <i class="far fa-star text-danger"></i>
                                <i class="far fa-star text-danger"></i>
                                <i class="far fa-star text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.topic-item {
    padding: 15px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.topic-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.topic-item:hover i {
    transform: scale(1.2);
}

.topic-item i {
    transition: transform 0.3s ease;
    margin-right: 10px;
}

.game-preview {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.game-image {
    margin: 20px 0;
    padding: 30px;
    background: linear-gradient(135deg, #fff6e6, #ffe5cc);
    border-radius: 50%;
    display: inline-block;
}

.health-image {
    margin: 20px 0;
    padding: 30px;
    background: linear-gradient(135deg, #ffe6e6, #ffcccc);
    border-radius: 50%;
    display: inline-block;
}

.stars {
    font-size: 1.2em;
}

.level-selector .btn-group .btn {
    flex: 1;
    padding: 10px 20px;
}

.btn-outline-primary.active {
    background-color: #3498db;
    color: white;
}

.navigation-buttons {
    margin-top: 15px;
}

.navigation-buttons .btn {
    width: 40px;
    height: 40px;
    padding: 0;
    line-height: 40px;
    border-radius: 50%;
}

.game-controls {
    margin-top: 15px;
}
</style>

<script>
let currentLevel = 'cp';
let currentGameIndex = 0;

const games = [
    { title: "Parcours d'Obstacles", duration: "15 minutes", type: "Coordination" },
    { title: "Jeux de Ballon", duration: "20 minutes", type: "Adresse" },
    { title: "Course au Trésor", duration: "30 minutes", type: "Endurance" }
];

function changeLevel(level) {
    currentLevel = level;
    document.querySelectorAll('.level-selector .btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`button[onclick="changeLevel('${level}')"]`).classList.add('active');
    updateContent();
}

function updateContent() {
    const content = {
        cp: {
            activities: ['course-basic', 'gymnastique-basic'],
            team_sports: ['jeux-ballon'],
            games: ['coordination'],
            health: ['echauffement-basic']
        },
        ce1: {
            activities: ['course', 'gymnastique', 'natation-basic'],
            team_sports: ['football-basic', 'basketball-basic'],
            games: ['coordination', 'equilibre'],
            health: ['echauffement', 'etirements']
        },
        // Autres niveaux...
    };
    
    updateInterface(content[currentLevel]);
}

function startLesson(topic) {
    const lessons = {
        'course': [
            { title: "Course d'endurance", content: "Courir à son rythme" },
            { title: "Sprint", content: "Techniques de départ" }
        ],
        'gymnastique': [
            { title: "Roulades", content: "Roulade avant et arrière" },
            { title: "Équilibre", content: "Se tenir en équilibre" }
        ],
        // Autres leçons...
    };
    
    alert("L'activité va commencer !");
}

function startGame() {
    const game = games[currentGameIndex];
    alert(`Préparation de l'activité : ${game.title}`);
}

function previousGame() {
    currentGameIndex = (currentGameIndex - 1 + games.length) % games.length;
    updateGameDisplay();
}

function nextGame() {
    currentGameIndex = (currentGameIndex + 1) % games.length;
    updateGameDisplay();
}

function updateGameDisplay() {
    const game = games[currentGameIndex];
    document.getElementById('gameTitle').textContent = game.title;
    document.getElementById('gameDuration').textContent = `Durée : ${game.duration}`;
}

function startWarmup() {
    const warmups = {
        'basic': {
            exercises: [
                "Rotation des bras",
                "Flexion des jambes",
                "Étirements du dos"
            ],
            duration: "5 minutes"
        }
    };
    
    alert("Commençons l'échauffement !");
}

// Initialiser le niveau CP par défaut
window.onload = function() {
    changeLevel('cp');
    updateGameDisplay();
};
</script>

<?php include $root_path . 'templates/footer.php'; ?> 