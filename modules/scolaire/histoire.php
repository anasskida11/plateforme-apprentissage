<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">Histoire et Géographie</h1>
        <p class="lead">Voyage dans le temps et explore le monde !</p>
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
        <!-- Périodes Historiques -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-landmark text-primary"></i> Périodes Historiques
                    </h3>
                    <div class="timeline-topics">
                        <div class="topic-item mb-3" onclick="startLesson('prehistoire')">
                            <i class="fas fa-fire"></i> La Préhistoire
                            <span class="badge bg-primary">5 leçons</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('antiquite')">
                            <i class="fas fa-columns"></i> L'Antiquité
                            <span class="badge bg-primary">6 leçons</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('moyen-age')">
                            <i class="fas fa-chess-rook"></i> Le Moyen Âge
                            <span class="badge bg-primary">7 leçons</span>
                        </div>
                        <div class="topic-item" onclick="startLesson('temps-modernes')">
                            <i class="fas fa-ship"></i> Les Temps Modernes
                            <span class="badge bg-primary">4 leçons</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Géographie -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-globe-europe text-success"></i> Géographie
                    </h3>
                    <div class="geography-topics">
                        <div class="topic-item mb-3" onclick="startLesson('france')">
                            <i class="fas fa-map-marked-alt"></i> La France
                            <span class="badge bg-success">5 leçons</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('europe')">
                            <i class="fas fa-flag-checkered"></i> L'Europe
                            <span class="badge bg-success">4 leçons</span>
                        </div>
                        <div class="topic-item" onclick="startLesson('monde')">
                            <i class="fas fa-globe"></i> Le Monde
                            <span class="badge bg-success">6 leçons</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Personnages Historiques -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-crown text-warning"></i> Personnages Célèbres
                    </h3>
                    <div class="historical-figures">
                        <div class="figure-carousel text-center">
                            <div class="figure-preview mb-4">
                                <div class="figure-image mb-3">
                                    <i class="fas fa-user-crown fa-3x text-warning"></i>
                                </div>
                                <h4 id="figureName" class="mb-2">Charlemagne</h4>
                                <p id="figureEra" class="text-muted">Moyen Âge</p>
                                <button onclick="learnAboutFigure()" class="btn btn-warning">
                                    En savoir plus
                                </button>
                            </div>
                            <div class="navigation-buttons">
                                <button onclick="previousFigure()" class="btn btn-outline-warning me-2">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button onclick="nextFigure()" class="btn btn-outline-warning">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz et Jeux -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-gamepad text-danger"></i> Quiz et Jeux
                    </h3>
                    <div class="games-section text-center">
                        <div class="game-preview mb-4">
                            <h4 class="display-6 mb-3">Voyage dans le Temps</h4>
                            <div class="game-image mb-3">
                                <i class="fas fa-clock fa-3x text-danger"></i>
                            </div>
                            <p class="mb-3">Place les événements dans l'ordre chronologique !</p>
                            <button onclick="startGame()" class="btn btn-danger">
                                Jouer
                            </button>
                        </div>
                        <div class="difficulty-rating">
                            <p class="mb-2">Niveau de difficulté :</p>
                            <div class="stars">
                                <i class="fas fa-star text-danger"></i>
                                <i class="fas fa-star text-danger"></i>
                                <i class="fas fa-star text-danger"></i>
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

.figure-preview {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.figure-image {
    margin: 20px 0;
    padding: 30px;
    background: linear-gradient(135deg, #fff6e6, #ffe5cc);
    border-radius: 50%;
    display: inline-block;
}

.game-image {
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
</style>

<script>
let currentLevel = 'cp';
let currentFigureIndex = 0;

const historicalFigures = [
    { name: "Charlemagne", era: "Moyen Âge", years: "742-814" },
    { name: "Jeanne d'Arc", era: "Moyen Âge", years: "1412-1431" },
    { name: "Louis XIV", era: "Temps Modernes", years: "1638-1715" }
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
            history: ['prehistoire-basic'],
            geography: ['ma-ville', 'ma-region'],
            figures: ['simple'],
            games: ['facile']
        },
        ce1: {
            history: ['prehistoire', 'antiquite-basic'],
            geography: ['france-basic'],
            figures: ['moyen'],
            games: ['moyen']
        },
        // Autres niveaux...
    };
    
    updateInterface(content[currentLevel]);
}

function startLesson(topic) {
    const lessons = {
        'prehistoire': [
            { title: "La vie des premiers hommes", content: "Découverte du feu et des outils" },
            { title: "L'art préhistorique", content: "Les peintures rupestres" }
        ],
        'antiquite': [
            { title: "Les Gaulois", content: "La vie quotidienne des Gaulois" },
            { title: "Les Romains", content: "La conquête de la Gaule" }
        ],
        // Autres leçons...
    };
    
    alert("La leçon va commencer !");
}

function learnAboutFigure() {
    const figure = historicalFigures[currentFigureIndex];
    alert(`En savoir plus sur ${figure.name} (${figure.years})`);
}

function previousFigure() {
    currentFigureIndex = (currentFigureIndex - 1 + historicalFigures.length) % historicalFigures.length;
    updateFigureDisplay();
}

function nextFigure() {
    currentFigureIndex = (currentFigureIndex + 1) % historicalFigures.length;
    updateFigureDisplay();
}

function updateFigureDisplay() {
    const figure = historicalFigures[currentFigureIndex];
    document.getElementById('figureName').textContent = figure.name;
    document.getElementById('figureEra').textContent = figure.era;
}

function startGame() {
    const games = {
        'chronologie': {
            events: [
                { text: "Invention du feu", date: "-400000" },
                { text: "Construction des pyramides", date: "-2500" },
                { text: "Chute de Rome", date: "476" }
            ],
            difficulty: "moyen"
        }
    };
    
    alert("Le jeu va commencer !");
}

// Initialiser le niveau CP par défaut
window.onload = function() {
    changeLevel('cp');
    updateFigureDisplay();
};
</script>

<?php include $root_path . 'templates/footer.php'; ?> 