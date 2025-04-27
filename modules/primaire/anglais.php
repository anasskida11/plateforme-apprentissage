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
#visuel-en-choix .btn {
    min-width: 70px;
    min-height: 70px;
    font-size: 2.5rem;
}
#visuel-en-mot {
    color: #ff9800;
    font-size: 1.3em;
}
#visuel-en-feedback, #english-quiz-feedback, #picture-feedback, #apprentissage-en-feedback {
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
    #visuel-en-choix .btn { min-width: 50px; min-height: 50px; font-size: 1.5rem; }
}
</style>
<div class="container mt-5">
    <h1 class="text-center mb-4">Anglais - Primaire</h1>
    <div class="row mb-3">
        <div class="col-12 text-center">
            <p class="lead">Bienvenue dans la section Anglais !<br>Apprends l'anglais avec des jeux et quiz amusants.</p>
            <div class="btn-group mt-3" role="group" aria-label="Niveau de difficulté">
                <button class="btn btn-outline-primary" id="niveau-facile" onclick="setNiveau('facile')">Facile</button>
                <button class="btn btn-outline-warning" id="niveau-moyen" onclick="setNiveau('moyen')">Moyen</button>
                <button class="btn btn-outline-danger" id="niveau-difficile" onclick="setNiveau('difficile')">Difficile</button>
            </div>
            <div id="niveau-feedback" class="mt-2"></div>
        </div>
    </div>
    <div class="row g-4">
        <!-- Exercice visuel Anglais -->
        <div class="col-md-12">
            <div class="card h-100 mb-4">
                <div class="card-body text-center">
                    <h3 class="card-title mb-3">Exercice visuel</h3>
                    <p>Choisis l'emoji qui correspond au mot anglais&nbsp;: <span id="visuel-en-mot" class="fw-bold"></span></p>
                    <div id="visuel-en-choix" class="d-flex justify-content-center gap-4 mb-2 flex-wrap"></div>
                    <div id="visuel-en-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionVisuelEn()">Nouvelle question</button>
                    <div id="visuel-en-feedback"></div>
                </div>
            </div>
        </div>
        <!-- Quiz Vocabulaire QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Quiz : Vocabulaire</h3>
                    <div id="english-quiz-area">
                        <p id="english-quiz-question" class="fs-4"></p>
                        <div id="english-quiz-choices" class="mb-2"></div>
                        <div id="english-quiz-score" class="mb-2"></div>
                        <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionVocabEn()">Nouvelle question</button>
                        <div id="english-quiz-feedback" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quiz Images QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Quel est ce mot ?</h3>
                    <div id="picture-area" class="text-center">
                        <span id="picture-emoji" style="font-size:2.5rem;"></span>
                        <div id="picture-choices" class="mb-2 mt-2"></div>
                        <div id="picture-score" class="mb-2"></div>
                        <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionPictureEn()">Nouvelle question</button>
                        <div id="picture-feedback" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Exercice d'apprentissage -->
        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Learning Exercise</h3>
                    <p>Complete the sentence:</p>
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-5 me-2">The sun is ___ .</span>
                        <input type="text" id="apprentissage-en-answer" class="form-control w-auto me-2" style="width:100px;">
                        <button class="btn btn-warning" onclick="checkApprentissageEnAnswer()">Check</button>
                    </div>
                    <div id="apprentissage-en-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionApprentissageEn()">Nouvelle question</button>
                    <div id="apprentissage-en-feedback"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Niveau de difficulté
let niveau = 'facile';
let visuelEnScore = 0;
let vocabEnScore = 0;
let pictureEnScore = 0;
let apprentissageEnScore = 0;
function setNiveau(n) {
    niveau = n;
    document.getElementById('niveau-feedback').textContent = 'Niveau sélectionné : ' + n.charAt(0).toUpperCase() + n.slice(1);
    document.getElementById('niveau-facile').classList.toggle('active', n === 'facile');
    document.getElementById('niveau-moyen').classList.toggle('active', n === 'moyen');
    document.getElementById('niveau-difficile').classList.toggle('active', n === 'difficile');
    renderVisuelEn();
    generateEnglishQuizQCM();
    generatePictureQCM();
    updateVisuelEnScore();
    updateVocabEnScore();
    updatePictureEnScore();
    updateApprentissageEnScore();
}
// Exercice visuel Anglais (QCM)
const visuelEnData = {
    facile: [
        {mot: 'cat', emojis: ['🐱', '🐶', '🐭', '🐰'], correct: 0},
        {mot: 'dog', emojis: ['🐱', '🐶', '🐭', '🐰'], correct: 1},
        {mot: 'apple', emojis: ['🍎', '🍌', '🍓', '🍊'], correct: 0},
        {mot: 'banana', emojis: ['🍎', '🍌', '🍓', '🍊'], correct: 1},
        {mot: 'car', emojis: ['🚗', '🚕', '🚙', '🚌'], correct: 0},
        {mot: 'mouse', emojis: ['🐱', '🐶', '🐭', '🐰'], correct: 2},
        {mot: 'rabbit', emojis: ['🐱', '🐶', '🐭', '🐰'], correct: 3}
    ],
    moyen: [
        {mot: 'sun', emojis: ['🌞', '🌧️', '🌙', '⭐'], correct: 0},
        {mot: 'house', emojis: ['🏠', '🏢', '🏫', '🏥'], correct: 0},
        {mot: 'car', emojis: ['🚗', '🚕', '🚙', '🚌'], correct: 0},
        {mot: 'cloud', emojis: ['🌞', '🌧️', '🌙', '⭐'], correct: 1},
        {mot: 'star', emojis: ['🌞', '🌧️', '🌙', '⭐'], correct: 3},
        {mot: 'school', emojis: ['🏠', '🏢', '🏫', '🏥'], correct: 2},
        {mot: 'bus', emojis: ['🚗', '🚕', '🚌', '🚙'], correct: 2}
    ],
    difficile: [
        {mot: 'elephant', emojis: ['🐘', '🦒', '🦓', '🦁'], correct: 0},
        {mot: 'strawberry', emojis: ['🍎', '🍌', '🍓', '🍊'], correct: 2},
        {mot: 'rabbit', emojis: ['🐱', '🐶', '🐭', '🐰'], correct: 3},
        {mot: 'giraffe', emojis: ['🐘', '🦒', '🦓', '🦁'], correct: 1},
        {mot: 'zebra', emojis: ['🐘', '🦒', '🦓', '🦁'], correct: 2},
        {mot: 'lion', emojis: ['🐘', '🦒', '🦓', '🦁'], correct: 3},
        {mot: 'hospital', emojis: ['🏠', '🏢', '🏫', '🏥'], correct: 3}
    ]
};
let visuelEnIndex = 0;
function renderVisuelEn() {
    const dataArr = visuelEnData[niveau];
    visuelEnIndex = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[visuelEnIndex];
    document.getElementById('visuel-en-mot').textContent = data.mot;
    const choixDiv = document.getElementById('visuel-en-choix');
    choixDiv.innerHTML = '';
    data.emojis.forEach((emoji, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-light fs-2 mb-2';
        btn.innerHTML = emoji;
        btn.onclick = function() { checkVisuelEn(idx); };
        choixDiv.appendChild(btn);
    });
    document.getElementById('visuel-en-feedback').textContent = '';
}
function checkVisuelEn(idx) {
    const data = visuelEnData[niveau][visuelEnIndex];
    const feedback = document.getElementById('visuel-en-feedback');
    if (idx === data.correct) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success';
        visuelEnScore++;
        updateVisuelEnScore();
        setTimeout(renderVisuelEn, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <span class='fs-2'>${data.emojis[data.correct]}</span>`;
        feedback.className = 'text-danger';
    }
}
// Quiz vocabulaire QCM
function generateEnglishQuizQCM() {
    const questions = {
        facile: [
            {q: "Comment dit-on 'chat' en anglais ?", choices: ['cat', 'dog', 'house', 'apple'], correct: 0},
            {q: "Comment dit-on 'chien' en anglais ?", choices: ['cat', 'dog', 'house', 'apple'], correct: 1},
            {q: "Comment dit-on 'pomme' en anglais ?", choices: ['banana', 'apple', 'strawberry', 'orange'], correct: 1},
            {q: "Comment dit-on 'banane' en anglais ?", choices: ['banana', 'apple', 'strawberry', 'orange'], correct: 0},
            {q: "Comment dit-on 'voiture' en anglais ?", choices: ['car', 'bus', 'train', 'bike'], correct: 0},
            {q: "Comment dit-on 'souris' en anglais ?", choices: ['cat', 'dog', 'mouse', 'rabbit'], correct: 2},
            {q: "Comment dit-on 'lapin' en anglais ?", choices: ['cat', 'dog', 'mouse', 'rabbit'], correct: 3}
        ],
        moyen: [
            {q: "Comment dit-on 'maison' en anglais ?", choices: ['car', 'house', 'cat', 'dog'], correct: 1},
            {q: "Comment dit-on 'école' en anglais ?", choices: ['school', 'house', 'car', 'hospital'], correct: 0},
            {q: "Comment dit-on 'bus' en anglais ?", choices: ['car', 'bus', 'train', 'bike'], correct: 1},
            {q: "Comment dit-on 'nuage' en anglais ?", choices: ['cloud', 'star', 'sun', 'moon'], correct: 0},
            {q: "Comment dit-on 'étoile' en anglais ?", choices: ['cloud', 'star', 'sun', 'moon'], correct: 1},
            {q: "Comment dit-on 'soleil' en anglais ?", choices: ['cloud', 'star', 'sun', 'moon'], correct: 2},
            {q: "Comment dit-on 'hôpital' en anglais ?", choices: ['school', 'house', 'car', 'hospital'], correct: 3}
        ],
        difficile: [
            {q: "Comment dit-on 'fraise' en anglais ?", choices: ['banana', 'apple', 'strawberry', 'orange'], correct: 2},
            {q: "Comment dit-on 'éléphant' en anglais ?", choices: ['lion', 'giraffe', 'elephant', 'zebra'], correct: 2},
            {q: "Comment dit-on 'girafe' en anglais ?", choices: ['lion', 'giraffe', 'elephant', 'zebra'], correct: 1},
            {q: "Comment dit-on 'zèbre' en anglais ?", choices: ['lion', 'giraffe', 'elephant', 'zebra'], correct: 3},
            {q: "Comment dit-on 'lion' en anglais ?", choices: ['lion', 'giraffe', 'elephant', 'zebra'], correct: 0},
            {q: "Comment dit-on 'hôpital' en anglais ?", choices: ['school', 'house', 'car', 'hospital'], correct: 3},
            {q: "Comment dit-on 'école' en anglais ?", choices: ['school', 'house', 'car', 'hospital'], correct: 0}
        ]
    };
    const dataArr = questions[niveau];
    const idx = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[idx];
    document.getElementById('english-quiz-question').textContent = data.q;
    const choicesDiv = document.getElementById('english-quiz-choices');
    choicesDiv.innerHTML = '';
    data.choices.forEach((choice, i) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-primary me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkEnglishQuizQCMAnswer(i, data.correct, data.choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('english-quiz-feedback').textContent = '';
}
function checkEnglishQuizQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('english-quiz-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success mt-3';
        vocabEnScore++;
        updateVocabEnScore();
        setTimeout(generateEnglishQuizQCM, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger mt-3';
    }
}
// Quiz images QCM
function generatePictureQCM() {
    const questions = {
        facile: [
            {emoji: '🍎', choices: ['apple', 'banana', 'strawberry', 'orange'], correct: 0},
            {emoji: '🐶', choices: ['cat', 'dog', 'rabbit', 'mouse'], correct: 1},
            {emoji: '🐭', choices: ['cat', 'dog', 'rabbit', 'mouse'], correct: 3},
            {emoji: '🐰', choices: ['cat', 'dog', 'rabbit', 'mouse'], correct: 2},
            {emoji: '🍌', choices: ['apple', 'banana', 'strawberry', 'orange'], correct: 1}
        ],
        moyen: [
            {emoji: '🌞', choices: ['moon', 'star', 'sun', 'cloud'], correct: 2},
            {emoji: '🏠', choices: ['house', 'car', 'school', 'hospital'], correct: 0},
            {emoji: '🚌', choices: ['car', 'bus', 'train', 'bike'], correct: 1},
            {emoji: '🌧️', choices: ['cloud', 'star', 'sun', 'moon'], correct: 0},
            {emoji: '⭐', choices: ['cloud', 'star', 'sun', 'moon'], correct: 1},
            {emoji: '🏫', choices: ['school', 'house', 'car', 'hospital'], correct: 0},
            {emoji: '🏥', choices: ['school', 'house', 'car', 'hospital'], correct: 3}
        ],
        difficile: [
            {emoji: '🐘', choices: ['lion', 'giraffe', 'elephant', 'zebra'], correct: 2},
            {emoji: '🍓', choices: ['banana', 'apple', 'strawberry', 'orange'], correct: 2},
            {emoji: '🦒', choices: ['lion', 'giraffe', 'elephant', 'zebra'], correct: 1},
            {emoji: '🦓', choices: ['lion', 'giraffe', 'elephant', 'zebra'], correct: 3},
            {emoji: '🦁', choices: ['lion', 'giraffe', 'elephant', 'zebra'], correct: 0},
            {emoji: '🏥', choices: ['school', 'house', 'car', 'hospital'], correct: 3},
            {emoji: '🏫', choices: ['school', 'house', 'car', 'hospital'], correct: 0}
        ]
    };
    const dataArr = questions[niveau];
    const idx = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[idx];
    document.getElementById('picture-emoji').textContent = data.emoji;
    const choicesDiv = document.getElementById('picture-choices');
    choicesDiv.innerHTML = '';
    data.choices.forEach((choice, i) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-success me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkPictureQCMAnswer(i, data.correct, data.choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('picture-feedback').textContent = '';
}
function checkPictureQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('picture-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success mt-3';
        pictureEnScore++;
        updatePictureEnScore();
        setTimeout(generatePictureQCM, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger mt-3';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    setNiveau('facile');
    renderVisuelEn();
    generateEnglishQuizQCM();
    generatePictureQCM();
    renderApprentissageEn();
    addEnterKeyValidation('apprentissage-en-answer', checkApprentissageEnAnswer);
});
// Exercice d'apprentissage
const apprentissageData = {
    facile: [
        {sentence: 'The sun is ___ .', answer: 'yellow'},
        {sentence: 'The apple is ___ .', answer: 'red'},
        {sentence: 'The cat is ___ .', answer: 'small'},
        {sentence: 'The dog is ___ .', answer: 'big'},
        {sentence: 'The banana is ___ .', answer: 'yellow'}
    ],
    moyen: [
        {sentence: 'The house is ___ .', answer: 'big'},
        {sentence: 'The car is ___ .', answer: 'fast'},
        {sentence: 'The cloud is ___ .', answer: 'white'},
        {sentence: 'The rabbit is ___ .', answer: 'cute'},
        {sentence: 'The mouse is ___ .', answer: 'small'}
    ],
    difficile: [
        {sentence: 'The elephant is ___ .', answer: 'big'},
        {sentence: 'The strawberry is ___ .', answer: 'red'},
        {sentence: 'The giraffe is ___ .', answer: 'tall'},
        {sentence: 'The zebra is ___ .', answer: 'striped'},
        {sentence: 'The lion is ___ .', answer: 'strong'}
    ]
};
let apprentissageIndex = 0;
function renderApprentissageEn() {
    const dataArr = apprentissageData[niveau];
    apprentissageIndex = Math.floor(Math.random() * dataArr.length);
    document.querySelector('.fs-5.me-2').textContent = dataArr[apprentissageIndex].sentence;
    document.getElementById('apprentissage-en-answer').value = '';
    document.getElementById('apprentissage-en-feedback').textContent = '';
}
function checkApprentissageEnAnswer() {
    const answer = document.getElementById('apprentissage-en-answer').value.trim().toLowerCase();
    const feedback = document.getElementById('apprentissage-en-feedback');
    const dataArr = apprentissageData[niveau];
    const correct = dataArr[apprentissageIndex].answer;
    if (answer === correct) {
        feedback.textContent = 'Great! That is correct!';
        feedback.className = 'text-success';
        apprentissageEnScore++;
        updateApprentissageEnScore();
        setTimeout(renderApprentissageEn, 1500);
    } else {
        feedback.textContent = `Try again! The correct answer was: ${correct}`;
        feedback.className = 'text-danger';
    }
}
function addEnterKeyValidation(inputId, validateFn) {
    const input = document.getElementById(inputId);
    if (input) {
        input.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                validateFn();
            }
        });
    }
}
function updateVisuelEnScore() {
    document.getElementById('visuel-en-score').innerHTML = `🏆 Score : <b>${visuelEnScore}</b>`;
}
function nouvelleQuestionVisuelEn() {
    renderVisuelEn();
    document.getElementById('visuel-en-feedback').textContent = '';
}
function updateVocabEnScore() {
    document.getElementById('english-quiz-score').innerHTML = `🏆 Score : <b>${vocabEnScore}</b>`;
}
function nouvelleQuestionVocabEn() {
    generateEnglishQuizQCM();
    document.getElementById('english-quiz-feedback').textContent = '';
}
function updatePictureEnScore() {
    document.getElementById('picture-quiz-score').innerHTML = `🏆 Score : <b>${pictureEnScore}</b>`;
}
function nouvelleQuestionPictureEn() {
    generatePictureQCM();
    document.getElementById('picture-feedback').textContent = '';
}
function updateApprentissageEnScore() {
    document.getElementById('apprentissage-en-score').innerHTML = `🏆 Score : <b>${apprentissageEnScore}</b>`;
}
function nouvelleQuestionApprentissageEn() {
    renderApprentissageEn();
    document.getElementById('apprentissage-en-feedback').textContent = '';
}
</script>
<?php
require_once '../../templates/footer.php';
?> 