<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">Jeux Éducatifs</h1>
        <p class="lead">Choisis ton jeu préféré et amuse-toi en apprenant !</p>
    </div>

    <div class="row">
        <!-- Jeu des Couleurs -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card game-card">
                <div class="card-body text-center">
                    <div class="game-icon mb-3">
                        <i class="fas fa-palette fa-3x text-primary"></i>
                    </div>
                    <h3>Les Couleurs</h3>
                    <p>Apprends à reconnaître les couleurs en t'amusant</p>
                    <div class="difficulty">
                        <span class="badge bg-success">Facile</span>
                        <span class="badge bg-info">2-4 ans</span>
                    </div>
                    <button onclick="startGame('colors')" class="btn btn-primary mt-3">
                        <i class="fas fa-play"></i> Jouer
                    </button>
                </div>
            </div>
        </div>

        <!-- Jeu des Animaux -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card game-card">
                <div class="card-body text-center">
                    <div class="game-icon mb-3">
                        <i class="fas fa-dog fa-3x text-warning"></i>
                    </div>
                    <h3>Les Animaux</h3>
                    <p>Découvre les cris des animaux de la ferme</p>
                    <div class="difficulty">
                        <span class="badge bg-success">Facile</span>
                        <span class="badge bg-info">3-5 ans</span>
                    </div>
                    <button onclick="startGame('animals')" class="btn btn-warning mt-3">
                        <i class="fas fa-play"></i> Jouer
                    </button>
                </div>
            </div>
        </div>

        <!-- Jeu des Formes -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card game-card">
                <div class="card-body text-center">
                    <div class="game-icon mb-3">
                        <i class="fas fa-shapes fa-3x text-danger"></i>
                    </div>
                    <h3>Les Formes</h3>
                    <p>Apprends à reconnaître les formes géométriques</p>
                    <div class="difficulty">
                        <span class="badge bg-warning">Moyen</span>
                        <span class="badge bg-info">4-5 ans</span>
                    </div>
                    <button onclick="startGame('shapes')" class="btn btn-danger mt-3">
                        <i class="fas fa-play"></i> Jouer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Zone de jeu -->
    <div id="gameArea" class="mt-4" style="display: none;">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 id="gameTitle" class="mb-0">Titre du jeu</h3>
                    <button onclick="closeGame()" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="gameContent" class="text-center p-4">
                    <!-- Le contenu du jeu sera injecté ici -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.game-card {
    transition: transform 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.game-card:hover {
    transform: translateY(-5px);
}

.game-icon {
    background-color: rgba(0,0,0,0.05);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.difficulty {
    margin: 15px 0;
}

.difficulty .badge {
    margin: 0 5px;
    padding: 8px 12px;
    font-size: 0.9em;
}

#gameArea {
    background-color: rgba(255,255,255,0.9);
    border-radius: 15px;
    min-height: 400px;
}
</style>

<script>
// Données des jeux
const games = {
    colors: {
        title: "Les Couleurs",
        colors: ['red', 'blue', 'green', 'yellow', 'purple', 'orange'],
        currentColor: null
    },
    animals: {
        title: "Les Animaux",
        animals: [
            { name: 'chien', sound: 'wouf wouf' },
            { name: 'chat', sound: 'miaou' },
            { name: 'vache', sound: 'meuh' },
            { name: 'coq', sound: 'cocorico' }
        ],
        currentAnimal: null
    },
    shapes: {
        title: "Les Formes",
        shapes: ['cercle', 'carré', 'triangle', 'rectangle'],
        currentShape: null
    }
};

function startGame(gameType) {
    const gameArea = document.getElementById('gameArea');
    const gameTitle = document.getElementById('gameTitle');
    const gameContent = document.getElementById('gameContent');
    
    gameArea.style.display = 'block';
    gameTitle.textContent = games[gameType].title;
    
    // Générer le contenu du jeu selon le type
    switch(gameType) {
        case 'colors':
            createColorGame();
            break;
        case 'animals':
            createAnimalGame();
            break;
        case 'shapes':
            createShapeGame();
            break;
    }
    
    // Scroll vers la zone de jeu
    gameArea.scrollIntoView({ behavior: 'smooth' });
}

function createColorGame() {
    const gameContent = document.getElementById('gameContent');
    const colors = games.colors.colors;
    
    let html = '<div class="row justify-content-center">';
    colors.forEach(color => {
        html += `
            <div class="col-4 col-md-2 mb-3">
                <div class="color-box" style="background-color: ${color}; width: 100px; height: 100px; border-radius: 10px; cursor: pointer;"
                     onclick="checkColor('${color}')">
                </div>
            </div>
        `;
    });
    html += '</div>';
    html += '<div class="mt-4"><h4>Clique sur la couleur : <span id="targetColor" class="badge bg-primary"></span></h4></div>';
    
    gameContent.innerHTML = html;
    
    // Démarrer le jeu
    startColorRound();
}

function startColorRound() {
    const colors = games.colors.colors;
    games.colors.currentColor = colors[Math.floor(Math.random() * colors.length)];
    document.getElementById('targetColor').textContent = games.colors.currentColor.toUpperCase();
}

function checkColor(selectedColor) {
    if (selectedColor === games.colors.currentColor) {
        alert('Bravo ! C\'est la bonne couleur !');
        startColorRound();
    } else {
        alert('Essaie encore !');
    }
}

function createAnimalGame() {
    const gameContent = document.getElementById('gameContent');
    const animals = games.animals.animals;
    
    let html = '<div class="row justify-content-center">';
    animals.forEach(animal => {
        html += `
            <div class="col-6 col-md-3 mb-3">
                <div class="animal-card card" onclick="playAnimalSound('${animal.name}', '${animal.sound}')">
                    <div class="card-body">
                        <i class="fas fa-paw fa-3x mb-2"></i>
                        <h5>${animal.name.toUpperCase()}</h5>
                    </div>
                </div>
            </div>
        `;
    });
    html += '</div>';
    html += '<div class="mt-4"><h4>Clique sur un animal pour entendre son cri !</h4></div>';
    
    gameContent.innerHTML = html;
}

function playAnimalSound(animal, sound) {
    alert(`Le ${animal} fait : ${sound} !`);
}

function createShapeGame() {
    const gameContent = document.getElementById('gameContent');
    const shapes = games.shapes.shapes;
    
    let html = '<div class="row justify-content-center">';
    shapes.forEach(shape => {
        html += `
            <div class="col-6 col-md-3 mb-3">
                <div class="shape-card card" onclick="checkShape('${shape}')">
                    <div class="card-body">
                        <i class="fas fa-${getShapeIcon(shape)} fa-3x mb-2"></i>
                        <h5>${shape.toUpperCase()}</h5>
                    </div>
                </div>
            </div>
        `;
    });
    html += '</div>';
    html += '<div class="mt-4"><h4>Trouve la forme : <span id="targetShape" class="badge bg-primary"></span></h4></div>';
    
    gameContent.innerHTML = html;
    
    // Démarrer le jeu
    startShapeRound();
}

function getShapeIcon(shape) {
    const icons = {
        'cercle': 'circle',
        'carré': 'square',
        'triangle': 'triangle',
        'rectangle': 'rectangle-wide'
    };
    return icons[shape] || 'shape';
}

function startShapeRound() {
    const shapes = games.shapes.shapes;
    games.shapes.currentShape = shapes[Math.floor(Math.random() * shapes.length)];
    document.getElementById('targetShape').textContent = games.shapes.currentShape.toUpperCase();
}

function checkShape(selectedShape) {
    if (selectedShape === games.shapes.currentShape) {
        alert('Bravo ! C\'est la bonne forme !');
        startShapeRound();
    } else {
        alert('Essaie encore !');
    }
}

function closeGame() {
    document.getElementById('gameArea').style.display = 'none';
}
</script>

<?php include $root_path . 'templates/footer.php'; ?> 