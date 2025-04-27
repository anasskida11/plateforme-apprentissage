<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">Mathématiques</h1>
        <p class="lead">Découvre et pratique les mathématiques de manière interactive !</p>
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

    <!-- Sections des exercices -->
    <div class="exercises-container">
        <!-- Calcul Mental -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">Calcul Mental</h3>
                <div id="mentalMathGame" class="text-center">
                    <div class="operation-display mb-4">
                        <span id="num1" class="h1">?</span>
                        <span id="operator" class="h1">?</span>
                        <span id="num2" class="h1">?</span>
                        <span class="h1">=</span>
                        <input type="number" id="answer" class="form-control form-control-lg d-inline-block w-auto">
                    </div>
                    <div class="mb-3">
                        <span id="timer" class="h4">30</span> secondes restantes
                    </div>
                    <div class="mb-3">
                        Score: <span id="score">0</span> / <span id="total">0</span>
                    </div>
                    <button onclick="startMentalMathGame()" class="btn btn-primary btn-lg">
                        <i class="fas fa-play"></i> Commencer
                    </button>
                </div>
            </div>
        </div>

        <!-- Tables de multiplication -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">Tables de multiplication</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-selector mb-3">
                            <label class="form-label">Choisis une table :</label>
                            <select id="tableNumber" class="form-select">
                                <?php for($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>">Table de <?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <button onclick="startTableTraining()" class="btn btn-success">
                            <i class="fas fa-table"></i> S'entraîner
                        </button>
                    </div>
                    <div class="col-md-6">
                        <div id="tableDisplay" class="text-center">
                            <!-- La table sera affichée ici -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Géométrie -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">Géométrie</h3>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="geometry-card" onclick="startGeometryLesson('angles')">
                            <i class="fas fa-ruler-combined fa-3x mb-2"></i>
                            <h4>Les Angles</h4>
                            <p>Mesure et compare les angles</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="geometry-card" onclick="startGeometryLesson('perimeter')">
                            <i class="fas fa-draw-polygon fa-3x mb-2"></i>
                            <h4>Périmètre</h4>
                            <p>Calcule le périmètre des formes</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="geometry-card" onclick="startGeometryLesson('area')">
                            <i class="fas fa-vector-square fa-3x mb-2"></i>
                            <h4>Aires</h4>
                            <p>Calcule l'aire des formes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Problèmes -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">Problèmes</h3>
                <div id="problemSection">
                    <div class="problem-text mb-3">
                        <p id="problemStatement">Clique sur "Nouveau problème" pour commencer.</p>
                    </div>
                    <div class="answer-section mb-3">
                        <input type="number" id="problemAnswer" class="form-control" placeholder="Ta réponse">
                        <small id="problemHint" class="form-text text-muted">N'oublie pas d'indiquer l'unité dans ta réponse !</small>
                    </div>
                    <div class="buttons">
                        <button onclick="checkProblemAnswer()" class="btn btn-primary me-2">Vérifier</button>
                        <button onclick="getNewProblem()" class="btn btn-success">Nouveau problème</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.geometry-card {
    text-align: center;
    padding: 20px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.geometry-card:hover {
    transform: translateY(-5px);
    border-color: #3498db;
    background-color: #f8f9fa;
}

.operation-display {
    font-size: 1.5em;
    margin: 20px 0;
}

.operation-display input {
    font-size: 1.2em;
    width: 100px !important;
    text-align: center;
    margin: 0 10px;
}

.table-selector {
    max-width: 200px;
}

#tableDisplay {
    font-size: 1.2em;
    line-height: 1.8;
}

.problem-text {
    font-size: 1.2em;
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 10px;
}

.level-selector .btn-group .btn {
    flex: 1;
    padding: 10px 20px;
}

.btn-outline-primary.active {
    background-color: #3498db;
    color: white;
}
</style>

<script>
let currentLevel = 'cp';
let currentScore = 0;
let totalQuestions = 0;
let timer;

function changeLevel(level) {
    currentLevel = level;
    document.querySelectorAll('.level-selector .btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`button[onclick="changeLevel('${level}')"]`).classList.add('active');
    // Adapter la difficulté des exercices selon le niveau
    updateDifficulty();
}

function updateDifficulty() {
    const difficulties = {
        'cp': { max: 20, operations: ['+'] },
        'ce1': { max: 50, operations: ['+', '-'] },
        'ce2': { max: 100, operations: ['+', '-', '*'] },
        'cm1': { max: 1000, operations: ['+', '-', '*', '/'] },
        'cm2': { max: 10000, operations: ['+', '-', '*', '/'] }
    };
    return difficulties[currentLevel];
}

function startMentalMathGame() {
    currentScore = 0;
    totalQuestions = 0;
    document.getElementById('score').textContent = currentScore;
    document.getElementById('total').textContent = totalQuestions;
    
    let timeLeft = 30;
    if(timer) clearInterval(timer);
    
    timer = setInterval(() => {
        timeLeft--;
        document.getElementById('timer').textContent = timeLeft;
        if(timeLeft <= 0) {
            clearInterval(timer);
            alert(`Temps écoulé ! Score final : ${currentScore}/${totalQuestions}`);
        }
    }, 1000);
    
    generateNewQuestion();
}

function generateNewQuestion() {
    const difficulty = updateDifficulty();
    const num1 = Math.floor(Math.random() * difficulty.max) + 1;
    const num2 = Math.floor(Math.random() * difficulty.max) + 1;
    const operator = difficulty.operations[Math.floor(Math.random() * difficulty.operations.length)];
    
    document.getElementById('num1').textContent = num1;
    document.getElementById('operator').textContent = operator;
    document.getElementById('num2').textContent = num2;
    document.getElementById('answer').value = '';
    
    return { num1, num2, operator };
}

function checkAnswer() {
    const num1 = parseInt(document.getElementById('num1').textContent);
    const num2 = parseInt(document.getElementById('num2').textContent);
    const operator = document.getElementById('operator').textContent;
    const userAnswer = parseInt(document.getElementById('answer').value);
    
    let correctAnswer;
    switch(operator) {
        case '+': correctAnswer = num1 + num2; break;
        case '-': correctAnswer = num1 - num2; break;
        case '*': correctAnswer = num1 * num2; break;
        case '/': correctAnswer = Math.floor(num1 / num2); break;
    }
    
    totalQuestions++;
    if(userAnswer === correctAnswer) {
        currentScore++;
        alert('Bravo ! C\'est la bonne réponse !');
    } else {
        alert(`Dommage ! La bonne réponse était ${correctAnswer}`);
    }
    
    document.getElementById('score').textContent = currentScore;
    document.getElementById('total').textContent = totalQuestions;
    
    generateNewQuestion();
}

function startTableTraining() {
    const table = parseInt(document.getElementById('tableNumber').value);
    let html = '<div class="table-responsive"><table class="table table-bordered">';
    for(let i = 1; i <= 10; i++) {
        html += `<tr><td>${table} × ${i} = ${table * i}</td></tr>`;
    }
    html += '</table></div>';
    document.getElementById('tableDisplay').innerHTML = html;
}

function startGeometryLesson(topic) {
    alert(`Leçon de géométrie sur ${topic} en cours de développement !`);
}

function getNewProblem() {
    const problems = {
        cp: [
            "Pierre a 5 billes. Il en gagne 3. Combien en a-t-il maintenant ?",
            "Marie a 8 bonbons. Elle en mange 2. Combien lui en reste-t-il ?"
        ],
        ce1: [
            "Dans une classe, il y a 12 filles et 15 garçons. Combien y a-t-il d'élèves en tout ?",
            "Le boulanger a fait 45 croissants. Il en a vendu 28. Combien lui en reste-t-il ?"
        ]
        // Ajouter plus de problèmes pour les autres niveaux
    };
    
    const levelProblems = problems[currentLevel] || problems.cp;
    const randomProblem = levelProblems[Math.floor(Math.random() * levelProblems.length)];
    document.getElementById('problemStatement').textContent = randomProblem;
}

function checkProblemAnswer() {
    alert("Vérification de la réponse en cours de développement !");
}

// Initialiser le niveau CP par défaut
window.onload = function() {
    changeLevel('cp');
};
</script>

<?php include $root_path . 'templates/footer.php'; ?> 