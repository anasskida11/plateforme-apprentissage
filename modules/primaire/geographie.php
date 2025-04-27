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
#visuel-geo-choix .btn {
    min-width: 70px;
    min-height: 70px;
    font-size: 2.5rem;
}
#visuel-geo-question {
    color: #ff9800;
    font-size: 1.3em;
}
#visuel-geo-feedback, #geo-quiz-feedback, #capitales-feedback, #apprentissage-geo-feedback {
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
    #visuel-geo-choix .btn { min-width: 50px; min-height: 50px; font-size: 1.5rem; }
}
</style>
<div class="container mt-5">
    <h1 class="text-center mb-4">Géographie - Primaire</h1>
    <div class="row mb-3">
        <div class="col-12 text-center">
            <p class="lead">Bienvenue dans la section Géographie !<br>Découvre le monde avec des quiz et jeux interactifs.</p>
            <div class="btn-group mt-3" role="group" aria-label="Niveau de difficulté">
                <button class="btn btn-outline-primary" id="niveau-facile" onclick="setNiveau('facile')">Facile</button>
                <button class="btn btn-outline-warning" id="niveau-moyen" onclick="setNiveau('moyen')">Moyen</button>
                <button class="btn btn-outline-danger" id="niveau-difficile" onclick="setNiveau('difficile')">Difficile</button>
            </div>
            <div id="niveau-feedback" class="mt-2"></div>
        </div>
    </div>
    <div class="row g-4">
        <!-- Exercice visuel Géographie -->
        <div class="col-md-12">
            <div class="card h-100 mb-4">
                <div class="card-body text-center">
                    <h3 class="card-title mb-3">Exercice visuel</h3>
                    <p id="visuel-geo-question"></p>
                    <div id="visuel-geo-choix" class="d-flex justify-content-center gap-4 mb-2 flex-wrap"></div>
                    <div id="visuel-geo-feedback"></div>
                    <div id="visuel-geo-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionVisuelGeo()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Quiz Section QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Quiz : Les pays</h3>
                    <div id="geo-quiz-area">
                        <p id="geo-quiz-question" class="fs-4"></p>
                        <div id="geo-quiz-choices" class="mb-2"></div>
                        <div id="geo-quiz-feedback" class="mt-3"></div>
                    </div>
                    <div id="geo-quiz-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionGeoQuiz()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Capitales QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Quiz : Les capitales</h3>
                    <div id="capitales-area">
                        <p id="capitales-question" class="fs-4"></p>
                        <div id="capitales-choices" class="mb-2"></div>
                        <div id="capitales-feedback" class="mt-3"></div>
                    </div>
                    <div id="capitales-quiz-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionCapitalesQuiz()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Exercice d'apprentissage -->
        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Exercice d'apprentissage</h3>
                    <p>Complète la phrase suivante :</p>
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-5 me-2">La capitale de la France est ___ .</span>
                        <input type="text" id="apprentissage-geo-answer" class="form-control w-auto me-2" style="width:100px;">
                        <button class="btn btn-warning" onclick="checkApprentissageGeoAnswer()">Valider</button>
                    </div>
                    <div id="apprentissage-geo-feedback"></div>
                    <div id="apprentissage-geo-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionApprentissageGeo()">Nouvelle question</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Niveau de difficulté
let niveau = 'facile';
let visuelGeoScore = 0;
let geoQuizScore = 0;
let capitalesQuizScore = 0;
let apprentissageGeoScore = 0;
function setNiveau(n) {
    niveau = n;
    document.getElementById('niveau-feedback').textContent = 'Niveau sélectionné : ' + n.charAt(0).toUpperCase() + n.slice(1);
    document.getElementById('niveau-facile').classList.toggle('active', n === 'facile');
    document.getElementById('niveau-moyen').classList.toggle('active', n === 'moyen');
    document.getElementById('niveau-difficile').classList.toggle('active', n === 'difficile');
    renderVisuelGeo();
    generateGeoQuizQCM();
    generateCapitalesQCM();
    updateVisuelGeoScore();
    updateGeoQuizScore();
    updateCapitalesQuizScore();
    updateApprentissageGeoScore();
}
// Exercice visuel Géographie (QCM)
const visuelGeoData = {
    facile: [
        {q: 'Quel est le drapeau de la France ?', choices: ['🇫🇷', '🇮🇹', '🇪🇸', '🇩🇪'], correct: 0},
        {q: 'Quel est le drapeau de l'Italie ?', choices: ['🇫🇷', '🇮🇹', '🇪🇸', '🇩🇪'], correct: 1},
        {q: 'Quel est le drapeau de l'Espagne ?', choices: ['🇫🇷', '🇮🇹', '🇪🇸', '🇩🇪'], correct: 2}
    ],
    moyen: [
        {q: 'Quel est le continent de l'Égypte ?', choices: ['Europe', 'Asie', 'Afrique', 'Amérique'], correct: 2},
        {q: 'Quel est le drapeau de l'Allemagne ?', choices: ['🇫🇷', '🇮🇹', '🇪🇸', '🇩🇪'], correct: 3},
        {q: 'Quel est le continent du Brésil ?', choices: ['Europe', 'Amérique', 'Afrique', 'Océanie'], correct: 1}
    ],
    difficile: [
        {q: 'Quel est le plus grand pays du monde ?', choices: ['Chine', 'États-Unis', 'Russie', 'Canada'], correct: 2},
        {q: 'Quel est le drapeau du Japon ?', choices: ['🇨🇳', '🇯🇵', '🇰🇷', '🇹🇭'], correct: 1},
        {q: 'Quel est le continent de l'Australie ?', choices: ['Europe', 'Océanie', 'Afrique', 'Asie'], correct: 1}
    ]
};
let visuelGeoIndex = 0;
function renderVisuelGeo() {
    const dataArr = visuelGeoData[niveau];
    visuelGeoIndex = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[visuelGeoIndex];
    document.getElementById('visuel-geo-question').textContent = data.q;
    const choixDiv = document.getElementById('visuel-geo-choix');
    choixDiv.innerHTML = '';
    data.choices.forEach((choice, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-light fs-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkVisuelGeo(idx); };
        choixDiv.appendChild(btn);
    });
    document.getElementById('visuel-geo-feedback').textContent = '';
}
function checkVisuelGeo(idx) {
    const data = visuelGeoData[niveau][visuelGeoIndex];
    const feedback = document.getElementById('visuel-geo-feedback');
    if (idx === data.correct) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success';
        visuelGeoScore++;
        setTimeout(renderVisuelGeo, 1500);
        updateVisuelGeoScore();
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${data.choices[data.correct]}</b>`;
        feedback.className = 'text-danger';
    }
}
// Quiz pays QCM
function generateGeoQuizQCM() {
    const questions = {
        facile: [
            {q: 'Où se trouve la Tour Eiffel ?', choices: ['Londres', 'Paris', 'Rome', 'Berlin'], correct: 1},
            {q: 'Quel pays est en forme de botte ?', choices: ['France', 'Italie', 'Espagne', 'Allemagne'], correct: 1}
        ],
        moyen: [
            {q: 'Quel pays a la plus grande population ?', choices: ['Inde', 'Chine', 'États-Unis', 'Brésil'], correct: 1},
            {q: 'Dans quel pays se trouve le Machu Picchu ?', choices: ['Pérou', 'Mexique', 'Brésil', 'Argentine'], correct: 0}
        ],
        difficile: [
            {q: 'Quel est le plus long fleuve du monde ?', choices: ['Nil', 'Amazone', 'Yangtsé', 'Mississippi'], correct: 1},
            {q: 'Dans quel pays se trouve la ville de Sydney ?', choices: ['Australie', 'Nouvelle-Zélande', 'Canada', 'Afrique du Sud'], correct: 0}
        ]
    };
    const dataArr = questions[niveau];
    const idx = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[idx];
    document.getElementById('geo-quiz-question').textContent = data.q;
    const choicesDiv = document.getElementById('geo-quiz-choices');
    choicesDiv.innerHTML = '';
    data.choices.forEach((choice, i) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-primary me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkGeoQuizQCMAnswer(i, data.correct, data.choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('geo-quiz-feedback').textContent = '';
    geoQuizScore++;
    updateGeoQuizScore();
}
function checkGeoQuizQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('geo-quiz-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success mt-3';
        setTimeout(generateGeoQuizQCM, 1500);
        geoQuizScore++;
        updateGeoQuizScore();
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger mt-3';
    }
}
// Capitales QCM
function generateCapitalesQCM() {
    const questions = {
        facile: [
            {q: 'Quelle est la capitale de la France ?', choices: ['Paris', 'Londres', 'Rome', 'Berlin'], correct: 0},
            {q: 'Quelle est la capitale de l'Italie ?', choices: ['Madrid', 'Rome', 'Paris', 'Berlin'], correct: 1}
        ],
        moyen: [
            {q: 'Quelle est la capitale du Canada ?', choices: ['Toronto', 'Ottawa', 'Vancouver', 'Montréal'], correct: 1},
            {q: 'Quelle est la capitale du Japon ?', choices: ['Pékin', 'Tokyo', 'Séoul', 'Bangkok'], correct: 1}
        ],
        difficile: [
            {q: 'Quelle est la capitale de l'Australie ?', choices: ['Sydney', 'Melbourne', 'Canberra', 'Perth'], correct: 2},
            {q: 'Quelle est la capitale du Brésil ?', choices: ['Rio', 'Brasilia', 'São Paulo', 'Salvador'], correct: 1}
        ]
    };
    const dataArr = questions[niveau];
    const idx = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[idx];
    document.getElementById('capitales-question').textContent = data.q;
    const choicesDiv = document.getElementById('capitales-choices');
    choicesDiv.innerHTML = '';
    data.choices.forEach((choice, i) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-success me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkCapitalesQCMAnswer(i, data.correct, data.choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('capitales-feedback').textContent = '';
    capitalesQuizScore++;
    updateCapitalesQuizScore();
}
function checkCapitalesQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('capitales-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success mt-3';
        setTimeout(generateCapitalesQCM, 1500);
        capitalesQuizScore++;
        updateCapitalesQuizScore();
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger mt-3';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    setNiveau('facile');
    renderVisuelGeo();
    generateGeoQuizQCM();
    generateCapitalesQCM();
    addEnterKeyValidation('apprentissage-geo-answer', checkApprentissageGeoAnswer);
});
// Exercice d'apprentissage
function checkApprentissageGeoAnswer() {
    const answer = document.getElementById('apprentissage-geo-answer').value.trim().toLowerCase();
    const feedback = document.getElementById('apprentissage-geo-feedback');
    if (answer === 'paris') {
        feedback.textContent = 'Bravo ! Bonne réponse.';
        feedback.className = 'text-success';
        apprentissageGeoScore++;
        updateApprentissageGeoScore();
    } else {
        feedback.textContent = 'Essaie encore !';
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
function updateVisuelGeoScore() {
    document.getElementById('visuel-geo-score').innerHTML = `🏆 Score : <b>${visuelGeoScore}</b>`;
}
function nouvelleQuestionVisuelGeo() {
    renderVisuelGeo();
    document.getElementById('visuel-geo-feedback').textContent = '';
}
function updateGeoQuizScore() {
    document.getElementById('geo-quiz-score').innerHTML = `�� Score : <b>${geoQuizScore}</b>`;
}
function nouvelleQuestionGeoQuiz() {
    generateGeoQuizQCM();
    document.getElementById('geo-quiz-feedback').textContent = '';
}
function updateCapitalesQuizScore() {
    document.getElementById('capitales-quiz-score').innerHTML = `🏆 Score : <b>${capitalesQuizScore}</b>`;
}
function nouvelleQuestionCapitalesQuiz() {
    generateCapitalesQCM();
    document.getElementById('capitales-feedback').textContent = '';
}
function updateApprentissageGeoScore() {
    document.getElementById('apprentissage-geo-score').innerHTML = `🏆 Score : <b>${apprentissageGeoScore}</b>`;
}
function nouvelleQuestionApprentissageGeo() {
    renderApprentissageGeo();
    document.getElementById('apprentissage-geo-feedback').textContent = '';
}
</script>
<?php
require_once '../../templates/footer.php';
?> 