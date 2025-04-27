<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container mt-4">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 rainbow-text">Couleurs et Formes</h1>
        <p class="lead">Découvre le monde magique des formes et des couleurs !</p>
    </div>

    <!-- Navigation des sections -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <button class="btn btn-lg btn-primary m-2" onclick="showSection('colors')">Les Couleurs</button>
            <button class="btn btn-lg btn-success m-2" onclick="showSection('shapes')">Les Formes</button>
            <button class="btn btn-lg btn-warning m-2" onclick="showSection('games')">Jeux</button>
        </div>
    </div>

    <!-- Section Couleurs -->
    <div id="colors-section" class="learning-section active">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #ff0000;" onclick="playColor(this, 'Rouge')">
                    <div class="card color-bg" style="background-color: #ff0000; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Rouge</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #0000ff;" onclick="playColor(this, 'Bleu')">
                    <div class="card color-bg" style="background-color: #0000ff; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Bleu</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #ffff00;" onclick="playColor(this, 'Jaune')">
                    <div class="card color-bg" style="background-color: #ffff00; color: #222;">
                        <div class="card-body text-center">
                            <h3>Jaune</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #00cc44;" onclick="playColor(this, 'Vert')">
                    <div class="card color-bg" style="background-color: #00cc44; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Vert</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #ff9900;" onclick="playColor(this, 'Orange')">
                    <div class="card color-bg" style="background-color: #ff9900; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Orange</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #9900cc;" onclick="playColor(this, 'Violet')">
                    <div class="card color-bg" style="background-color: #9900cc; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Violet</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #ffffff;" onclick="playColor(this, 'Blanc')">
                    <div class="card color-bg" style="background-color: #ffffff; color: #222;">
                        <div class="card-body text-center">
                            <h3>Blanc</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #000000;" onclick="playColor(this, 'Noir')">
                    <div class="card color-bg" style="background-color: #000000; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Noir</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #a52a2a;" onclick="playColor(this, 'Marron')">
                    <div class="card color-bg" style="background-color: #a52a2a; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Marron</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #ffc0cb;" onclick="playColor(this, 'Rose')">
                    <div class="card color-bg" style="background-color: #ffc0cb; color: #222;">
                        <div class="card-body text-center">
                            <h3>Rose</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #808080;" onclick="playColor(this, 'Gris')">
                    <div class="card color-bg" style="background-color: #808080; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Gris</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #ffd700;" onclick="playColor(this, 'Or')">
                    <div class="card color-bg" style="background-color: #ffd700; color: #222;">
                        <div class="card-body text-center">
                            <h3>Or</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #c0c0c0;" onclick="playColor(this, 'Argent')">
                    <div class="card color-bg" style="background-color: #c0c0c0; color: #222;">
                        <div class="card-body text-center">
                            <h3>Argent</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #8b4513;" onclick="playColor(this, 'Brun')">
                    <div class="card color-bg" style="background-color: #8b4513; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Brun</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #00ffff;" onclick="playColor(this, 'Cyan')">
                    <div class="card color-bg" style="background-color: #00ffff; color: #222;">
                        <div class="card-body text-center">
                            <h3>Cyan</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #ff1493;" onclick="playColor(this, 'Fuchsia')">
                    <div class="card color-bg" style="background-color: #ff1493; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Fuchsia</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #228b22;" onclick="playColor(this, 'Vert foncé')">
                    <div class="card color-bg" style="background-color: #228b22; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Vert foncé</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #add8e6;" onclick="playColor(this, 'Bleu clair')">
                    <div class="card color-bg" style="background-color: #add8e6; color: #222;">
                        <div class="card-body text-center">
                            <h3>Bleu clair</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #800000;" onclick="playColor(this, 'Bordeaux')">
                    <div class="card color-bg" style="background-color: #800000; color: #fff;">
                        <div class="card-body text-center">
                            <h3>Bordeaux</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="color-card" style="background-color: #ffa500;" onclick="playColor(this, 'Abricot')">
                    <div class="card color-bg" style="background-color: #ffa500; color: #222;">
                        <div class="card-body text-center">
                            <h3>Abricot</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Formes -->
    <div id="shapes-section" class="learning-section" style="display: none;">
        <div class="row g-4">
            <div class="col-md-4 col-6">
                <div class="shape-card" onclick="playShape(this, 'Cercle')">
                    <div class="card">
                        <div class="shape-preview">
                            <div class="circle"></div>
                        </div>
                        <div class="card-body text-center">
                            <h3>Le Cercle</h3>
                            <p>Rond comme une balle</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="shape-card" onclick="playShape(this, 'Carré')">
                    <div class="card">
                        <div class="shape-preview">
                            <div class="square"></div>
                        </div>
                        <div class="card-body text-center">
                            <h3>Le Carré</h3>
                            <p>Quatre côtés égaux</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="shape-card" onclick="playShape(this, 'Triangle')">
                    <div class="card">
                        <div class="shape-preview">
                            <div class="triangle"></div>
                        </div>
                        <div class="card-body text-center">
                            <h3>Le Triangle</h3>
                            <p>Trois côtés pointus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Jeux -->
    <div id="games-section" class="learning-section" style="display: none;">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card game-card">
                    <div class="card-body text-center">
                        <h3>Trouve la Couleur</h3>
                        <p>Clique sur la bonne couleur !</p>
                        <button class="btn btn-lg btn-primary mb-3" onclick="startColorGame()">Jouer</button>
                        <div id="color-game" style="display:none;">
                            <div class="mb-2"><strong id="color-question"></strong></div>
                            <div class="d-flex flex-wrap justify-content-center" id="color-choices"></div>
                            <div class="mt-2">Score : <span id="color-score">0</span></div>
                            <div id="color-feedback" class="mt-2"></div>
                            <button class="btn btn-secondary mt-2" onclick="stopColorGame()">Quitter</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card game-card">
                    <div class="card-body text-center">
                        <h3>Associe les Formes</h3>
                        <p>Trouve la forme demandée !</p>
                        <button class="btn btn-lg btn-success mb-3" onclick="startShapeGame()">Jouer</button>
                        <div id="shape-game" style="display:none;">
                            <div class="mb-2"><strong id="shape-question"></strong></div>
                            <div class="d-flex flex-wrap justify-content-center" id="shape-choices"></div>
                            <div class="mt-2">Score : <span id="shape-score">0</span></div>
                            <div id="shape-feedback" class="mt-2"></div>
                            <button class="btn btn-secondary mt-2" onclick="stopShapeGame()">Quitter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rainbow-text {
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: rainbow 20s linear infinite;
    background-size: 400%;
}

@keyframes rainbow {
    0% { background-position: 0% 50%; }
    100% { background-position: 400% 50%; }
}

.card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    cursor: pointer;
}

.card:hover {
    transform: translateY(-5px);
}

.color-preview {
    height: 100px;
    border-radius: 15px 15px 0 0;
}

.shape-preview {
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    border-radius: 15px 15px 0 0;
}

.circle {
    width: 60px;
    height: 60px;
    background-color: #ff6b6b;
    border-radius: 50%;
}

.square {
    width: 60px;
    height: 60px;
    background-color: #4ecdc4;
}

.triangle {
    width: 0;
    height: 0;
    border-left: 40px solid transparent;
    border-right: 40px solid transparent;
    border-bottom: 60px solid #ffd93d;
}

.game-card {
    background: linear-gradient(145deg, #ffffff, #f0f0f0);
}

.color-card .color-preview {
    background-color: inherit;
}

.card-body {
    font-family: 'Comic Sans MS', cursive;
}

.card-body h3 {
    color: #2c3e50;
    font-size: 1.5rem;
}

.card-body p {
    color: #7f8c8d;
    font-size: 1.1rem;
}

.color-bg h3, .color-bg p {
    color: inherit;
    text-shadow: 0 2px 8px rgba(0,0,0,0.10);
}

.color-card.bounce {
    animation: bounce 0.4s;
}
@keyframes bounce {
    0% { transform: scale(1); }
    30% { transform: scale(1.1); }
    60% { transform: scale(0.95); }
    100% { transform: scale(1); }
}
</style>

<script>
function showSection(sectionName) {
    document.querySelectorAll('.learning-section').forEach(section => {
        section.style.display = 'none';
    });
    document.getElementById(sectionName + '-section').style.display = 'block';
}

function playColor(element, color) {
    // Effet visuel bounce
    element.classList.add('bounce');
    setTimeout(() => element.classList.remove('bounce'), 400);
    // Synthèse vocale
    speak(color);
}

function playShape(element, shape) {
    // Effet visuel bounce
    element.classList.add('bounce');
    setTimeout(() => element.classList.remove('bounce'), 400);
    // Synthèse vocale
    speak(shape);
}

// --- Jeu Trouve la Couleur ---
const colorList = [
    {name: 'Rouge', color: '#ff0000'},
    {name: 'Bleu', color: '#0000ff'},
    {name: 'Jaune', color: '#ffff00'},
    {name: 'Vert', color: '#00cc44'},
    {name: 'Orange', color: '#ff9900'},
    {name: 'Violet', color: '#9900cc'}
];
let colorScore = 0;
let colorAnswer = null;

function startColorGame() {
    document.getElementById('color-game').style.display = '';
    colorScore = 0;
    document.getElementById('color-score').textContent = colorScore;
    nextColorQuestion();
}
function stopColorGame() {
    document.getElementById('color-game').style.display = 'none';
    document.getElementById('color-feedback').textContent = '';
}
function nextColorQuestion() {
    // Choisir la couleur à trouver
    const idx = Math.floor(Math.random() * colorList.length);
    colorAnswer = colorList[idx];
    document.getElementById('color-question').textContent = 'Trouve la couleur : ' + colorAnswer.name;
    // Générer les choix (mélangés)
    const choices = [...colorList].sort(() => Math.random() - 0.5).slice(0, 4);
    if (!choices.includes(colorAnswer)) choices[0] = colorAnswer;
    const container = document.getElementById('color-choices');
    container.innerHTML = '';
    choices.sort(() => Math.random() - 0.5).forEach(choice => {
        const btn = document.createElement('button');
        btn.className = 'm-2';
        btn.style.background = choice.color;
        btn.style.width = '70px';
        btn.style.height = '70px';
        btn.style.border = '3px solid #fff';
        btn.style.borderRadius = '15px';
        btn.title = choice.name;
        btn.onclick = () => checkColorAnswer(choice.name);
        container.appendChild(btn);
    });
}
function checkColorAnswer(selected) {
    const feedback = document.getElementById('color-feedback');
    speak(selected);
    if (selected === colorAnswer.name) {
        colorScore += 10;
        feedback.textContent = 'Bravo !';
        feedback.style.color = 'green';
        speak('Bravo !');
    } else {
        feedback.textContent = 'Essaie encore !';
        feedback.style.color = 'red';
        speak('Essaie encore !');
    }
    document.getElementById('color-score').textContent = colorScore;
    setTimeout(() => {
        feedback.textContent = '';
        nextColorQuestion();
    }, 900);
}

// --- Jeu Associe les Formes ---
const shapeList = [
    {name: 'Cercle', html: '<div class="circle mx-auto"></div>'},
    {name: 'Carré', html: '<div class="square mx-auto"></div>'},
    {name: 'Triangle', html: '<div class="triangle mx-auto"></div>'}
];
let shapeScore = 0;
let shapeAnswer = null;

function startShapeGame() {
    document.getElementById('shape-game').style.display = '';
    shapeScore = 0;
    document.getElementById('shape-score').textContent = shapeScore;
    nextShapeQuestion();
}
function stopShapeGame() {
    document.getElementById('shape-game').style.display = 'none';
    document.getElementById('shape-feedback').textContent = '';
}
function nextShapeQuestion() {
    // Choisir la forme à trouver
    const idx = Math.floor(Math.random() * shapeList.length);
    shapeAnswer = shapeList[idx];
    document.getElementById('shape-question').textContent = 'Trouve la forme : ' + shapeAnswer.name;
    // Générer les choix (mélangés)
    const choices = [...shapeList].sort(() => Math.random() - 0.5);
    const container = document.getElementById('shape-choices');
    container.innerHTML = '';
    choices.forEach(choice => {
        const btn = document.createElement('button');
        btn.className = 'm-2 d-flex align-items-center justify-content-center';
        btn.style.background = '#fff';
        btn.style.width = '70px';
        btn.style.height = '70px';
        btn.style.border = '3px solid #ddd';
        btn.style.borderRadius = '15px';
        btn.innerHTML = choice.html;
        btn.title = choice.name;
        btn.onclick = () => checkShapeAnswer(choice.name);
        container.appendChild(btn);
    });
}
function checkShapeAnswer(selected) {
    const feedback = document.getElementById('shape-feedback');
    speak(selected);
    if (selected === shapeAnswer.name) {
        shapeScore += 10;
        feedback.textContent = 'Bravo !';
        feedback.style.color = 'green';
        speak('Bravo !');
    } else {
        feedback.textContent = 'Essaie encore !';
        feedback.style.color = 'red';
        speak('Essaie encore !');
    }
    document.getElementById('shape-score').textContent = shapeScore;
    setTimeout(() => {
        feedback.textContent = '';
        nextShapeQuestion();
    }, 900);
}

function speak(text) {
    const utterance = new window.SpeechSynthesisUtterance(text);
    utterance.lang = 'fr-FR';
    utterance.rate = 0.9;
    window.speechSynthesis.speak(utterance);
}
</script>

<?php include $root_path . 'templates/footer.php'; ?> 