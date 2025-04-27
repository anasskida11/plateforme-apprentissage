<?php
require_once '../../templates/header.php';
?>

<style>
.card {
    border-radius: 18px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    border: none;
    margin-bottom: 20px;
}
.card-title {
    font-family: 'Comic Sans MS', cursive;
    color: #2d6cdf;
    letter-spacing: 1px;
}
.btn-group .btn {
    border-radius: 25px !important;
    font-weight: bold;
    font-size: 1.1rem;
    margin: 0 4px;
    padding: 8px 24px;
    transition: all 0.2s;
}
.btn-group .btn.active, .btn-group .btn:focus {
    background: linear-gradient(90deg, #2d6cdf, #4ecdc4);
    color: #fff;
    border: none;
    box-shadow: 0 2px 8px #4ecdc455;
}
.btn-outline-primary, .btn-outline-success {
    border-width: 2px;
    font-weight: bold;
    border-radius: 20px;
    margin-bottom: 6px;
}
.btn-outline-primary:hover, .btn-outline-success:hover, .btn-outline-primary:focus, .btn-outline-success:focus {
    background: linear-gradient(90deg, #2d6cdf, #4ecdc4);
    color: #fff;
    border: none;
}
.btn-light {
    border-radius: 18px;
    font-size: 2.2rem !important;
    margin: 0 8px 8px 0;
    background: #f8f9fa;
    border: 2px solid #e0e0e0;
    transition: all 0.2s;
}
.btn-light:hover, .btn-light:focus {
    background: #4ecdc4;
    color: #fff;
    border-color: #2d6cdf;
    transform: scale(1.12);
}
#visuel-math-choix .btn {
    min-width: 70px;
    min-height: 70px;
    font-size: 2.5rem;
}
#visuel-math-question {
    color: #ff9800;
    font-size: 1.3em;
}
#visuel-math-feedback, #quiz-feedback, #learning-feedback, #subtraction-feedback, #multiplication-feedback, #apples-feedback {
    font-size: 1.15rem;
    margin-top: 10px;
    padding: 10px 18px;
    border-radius: 12px;
    display: inline-block;
}
.text-success {
    background: #e6f9ed;
    color: #1b8a3a !important;
    border: 1.5px solid #1b8a3a22;
}
.text-danger {
    background: #fff0f0;
    color: #d32f2f !important;
    border: 1.5px solid #d32f2f22;
}
.btn-warning {
    border-radius: 20px;
    font-weight: bold;
    color: #fff;
    background: linear-gradient(90deg, #ff9800, #ffd600);
    border: none;
}
.btn-warning:hover, .btn-warning:focus {
    background: linear-gradient(90deg, #ffd600, #ff9800);
    color: #fff;
}
input[type="text"], input[type="number"] {
    border-radius: 12px !important;
    border: 1.5px solid #4ecdc4;
    font-size: 1.1rem;
    padding: 6px 12px;
}
@media (max-width: 600px) {
    .btn-group .btn { font-size: 1rem; padding: 6px 10px; }
    #visuel-math-choix .btn { min-width: 50px; min-height: 50px; font-size: 1.5rem; }
}
</style>
<div class="container mt-5">
    <h1 class="text-center mb-4">Mathématiques - Primaire</h1>
    <div class="row mb-3">
        <div class="col-12 text-center">
            <p class="lead">Bienvenue dans la section Mathématiques !<br>Apprends, joue et teste tes connaissances avec des exercices interactifs.</p>
            <div class="btn-group mt-3" role="group" aria-label="Niveau de difficulté">
                <button class="btn btn-outline-primary" id="niveau-facile" onclick="setNiveau('facile')">Facile</button>
                <button class="btn btn-outline-warning" id="niveau-moyen" onclick="setNiveau('moyen')">Moyen</button>
                <button class="btn btn-outline-danger" id="niveau-difficile" onclick="setNiveau('difficile')">Difficile</button>
            </div>
            <div id="niveau-feedback" class="mt-2"></div>
        </div>
    </div>
    <div class="row g-4">
        <!-- Exercice visuel Mathématiques -->
        <div class="col-md-12">
            <div class="card h-100 mb-4">
                <div class="card-body text-center">
                    <h3 class="card-title mb-3">Exercice visuel</h3>
                    <p id="visuel-math-question"></p>
                    <div id="visuel-math-choix" class="d-flex justify-content-center gap-4 mb-2 flex-wrap"></div>
                    <div id="visuel-math-feedback"></div>
                    <div id="visuel-math-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionVisuelMath()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Quiz Section QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Quiz : Fais la somme !</h3>
                    <div id="quiz-area">
                        <p id="quiz-question" class="fs-4"></p>
                        <div id="quiz-choices" class="mb-2"></div>
                        <div id="quiz-feedback" class="mt-3"></div>
                    </div>
                    <div id="quiz-math-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionQuizMath()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Learning Exercise QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Exercice d'apprentissage</h3>
                    <p>Complète la suite :</p>
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-4 me-2">2, 4, 6, 8, ...</span>
                        <span id="learning-qcm-choices"></span>
                    </div>
                    <div id="learning-feedback"></div>
                    <div id="learning-math-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionLearningMath()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Subtraction Quiz QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Quiz : La soustraction</h3>
                    <div id="subtraction-area">
                        <p id="subtraction-question" class="fs-4"></p>
                        <div id="subtraction-choices" class="mb-2"></div>
                        <div id="subtraction-feedback" class="mt-3"></div>
                    </div>
                    <div id="subtraction-math-score" class="mb-2"></div>
                </div>
            </div>
        </div>
        <!-- Multiplication Quiz QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Quiz : La multiplication</h3>
                    <div id="multiplication-area">
                        <p id="multiplication-question" class="fs-4"></p>
                        <div id="multiplication-choices" class="mb-2"></div>
                        <div id="multiplication-feedback" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Visual Counting Exercise QCM -->
        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="card-title mb-3">Exercice visuel : Compte les pommes !</h3>
                    <div id="apples-container" class="mb-3"></div>
                    <span id="apples-qcm-choices"></span>
                    <div id="apples-feedback" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Niveau de difficulté
let niveau = 'facile';
function setNiveau(n) {
    niveau = n;
    document.getElementById('niveau-feedback').textContent = 'Niveau sélectionné : ' + n.charAt(0).toUpperCase() + n.slice(1);
    document.getElementById('niveau-facile').classList.toggle('active', n === 'facile');
    document.getElementById('niveau-moyen').classList.toggle('active', n === 'moyen');
    document.getElementById('niveau-difficile').classList.toggle('active', n === 'difficile');
    renderVisuelMath();
    generateQuizQCM();
    renderLearningQCM();
    generateSubtractionQCM();
    generateMultiplicationQCM();
    generateApplesQCM();
}
// Exercice visuel Mathématiques (QCM)
const visuelMathData = {
    facile: [
        {q: 'Combien font 2 + 2 ?', choices: ['3', '4', '5', '6'], correct: 1},
        {q: 'Quel est le chiffre impair ?', choices: ['2', '4', '5', '6'], correct: 2},
        {q: 'Quel est le plus grand ?', choices: ['1', '3', '5', '7'], correct: 3}
    ],
    moyen: [
        {q: 'Combien font 3 x 2 ?', choices: ['5', '6', '7', '8'], correct: 1},
        {q: 'Quel est le double de 4 ?', choices: ['6', '7', '8', '9'], correct: 2},
        {q: 'Quel est le résultat de 10 - 3 ?', choices: ['6', '7', '8', '9'], correct: 1}
    ],
    difficile: [
        {q: 'Combien font 12 ÷ 3 ?', choices: ['2', '3', '4', '5'], correct: 2},
        {q: 'Quel est le carré de 3 ?', choices: ['6', '7', '8', '9'], correct: 3},
        {q: 'Quel est le résultat de 15 - 7 ?', choices: ['6', '7', '8', '9'], correct: 2}
    ]
};
let visuelMathIndex = 0;
function renderVisuelMath() {
    const dataArr = visuelMathData[niveau];
    visuelMathIndex = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[visuelMathIndex];
    document.getElementById('visuel-math-question').textContent = data.q;
    const choixDiv = document.getElementById('visuel-math-choix');
    choixDiv.innerHTML = '';
    data.choices.forEach((choice, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-light fs-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkVisuelMath(idx); };
        choixDiv.appendChild(btn);
    });
    document.getElementById('visuel-math-feedback').textContent = '';
}
function checkVisuelMath(idx) {
    const data = visuelMathData[niveau][visuelMathIndex];
    const feedback = document.getElementById('visuel-math-feedback');
    if (idx === data.correct) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success';
        setTimeout(renderVisuelMath, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${data.choices[data.correct]}</b>`;
        feedback.className = 'text-danger';
    }
}
// Quiz addition QCM
function generateQuizQCM() {
    let a = Math.floor(Math.random() * 10) + 1;
    let b = Math.floor(Math.random() * 10) + 1;
    document.getElementById('quiz-question').textContent = `Combien font ${a} + ${b} ?`;
    const correct = a + b;
    let choices = [correct];
    while (choices.length < 4) {
        let val = correct + Math.floor(Math.random() * 7) - 3;
        if (!choices.includes(val) && val > 0) choices.push(val);
    }
    choices = choices.sort(() => Math.random() - 0.5);
    const correctIdx = choices.indexOf(correct);
    const choicesDiv = document.getElementById('quiz-choices');
    choicesDiv.innerHTML = '';
    choices.forEach((choice, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-primary me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkQuizQCMAnswer(idx, correctIdx, choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('quiz-feedback').textContent = '';
}
function checkQuizQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('quiz-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success mt-3';
        setTimeout(generateQuizQCM, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger mt-3';
    }
}
// Learning exercise QCM
const learningQCM = {
    facile: {choices: ['10', '12', '14', '16'], correct: 0},
    moyen: {choices: ['12', '14', '16', '18'], correct: 1},
    difficile: {choices: ['16', '18', '20', '22'], correct: 2}
};
function renderLearningQCM() {
    const data = learningQCM[niveau];
    const choicesDiv = document.getElementById('learning-qcm-choices');
    choicesDiv.innerHTML = '';
    data.choices.forEach((choice, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-success me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkLearningQCMAnswer(idx, data.correct, data.choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('learning-feedback').textContent = '';
}
function checkLearningQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('learning-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success';
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger';
    }
}
// Subtraction QCM
function generateSubtractionQCM() {
    let a = Math.floor(Math.random() * 10) + 5;
    let b = Math.floor(Math.random() * 5) + 1;
    document.getElementById('subtraction-question').textContent = `Combien font ${a} - ${b} ?`;
    const correct = a - b;
    let choices = [correct];
    while (choices.length < 4) {
        let val = correct + Math.floor(Math.random() * 7) - 3;
        if (!choices.includes(val) && val > 0) choices.push(val);
    }
    choices = choices.sort(() => Math.random() - 0.5);
    const correctIdx = choices.indexOf(correct);
    const choicesDiv = document.getElementById('subtraction-choices');
    choicesDiv.innerHTML = '';
    choices.forEach((choice, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-primary me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkSubtractionQCMAnswer(idx, correctIdx, choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('subtraction-feedback').textContent = '';
}
function checkSubtractionQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('subtraction-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success mt-3';
        setTimeout(generateSubtractionQCM, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger mt-3';
    }
}
// Multiplication QCM
function generateMultiplicationQCM() {
    let a = Math.floor(Math.random() * 5) + 1;
    let b = Math.floor(Math.random() * 5) + 1;
    document.getElementById('multiplication-question').textContent = `Combien font ${a} × ${b} ?`;
    const correct = a * b;
    let choices = [correct];
    while (choices.length < 4) {
        let val = correct + Math.floor(Math.random() * 7) - 3;
        if (!choices.includes(val) && val > 0) choices.push(val);
    }
    choices = choices.sort(() => Math.random() - 0.5);
    const correctIdx = choices.indexOf(correct);
    const choicesDiv = document.getElementById('multiplication-choices');
    choicesDiv.innerHTML = '';
    choices.forEach((choice, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-primary me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkMultiplicationQCMAnswer(idx, correctIdx, choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('multiplication-feedback').textContent = '';
}
function checkMultiplicationQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('multiplication-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success mt-3';
        setTimeout(generateMultiplicationQCM, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger mt-3';
    }
}
// Visual Counting QCM
let appleCount;
function generateApplesQCM() {
    appleCount = Math.floor(Math.random() * 6) + 3;
    const container = document.getElementById('apples-container');
    container.innerHTML = '';
    for (let i = 0; i < appleCount; i++) {
        const img = document.createElement('span');
        img.innerHTML = '🍎';
        img.style.fontSize = '2rem';
        img.style.margin = '0 5px';
        container.appendChild(img);
    }
    let choices = [appleCount];
    while (choices.length < 4) {
        let val = appleCount + Math.floor(Math.random() * 5) - 2;
        if (!choices.includes(val) && val > 0) choices.push(val);
    }
    choices = choices.sort(() => Math.random() - 0.5);
    const correctIdx = choices.indexOf(appleCount);
    const choicesDiv = document.getElementById('apples-qcm-choices');
    choicesDiv.innerHTML = '';
    choices.forEach((choice, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-success me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkApplesQCMAnswer(idx, correctIdx, choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('apples-feedback').textContent = '';
}
function checkApplesQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('apples-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Tu as bien compté les pommes ! (Niveau : ${niveau})`;
        feedback.className = 'text-success mt-3';
        setTimeout(generateApplesQCM, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger mt-3';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    setNiveau('facile');
    renderVisuelMath();
    generateQuizQCM();
    renderLearningQCM();
    generateSubtractionQCM();
    generateMultiplicationQCM();
    generateApplesQCM();
});
</script>

<?php
require_once '../../templates/footer.php';
?> 