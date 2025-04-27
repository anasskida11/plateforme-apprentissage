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
#visuel-hist-choix .btn {
    min-width: 70px;
    min-height: 70px;
    font-size: 2.5rem;
}
#visuel-hist-mot {
    color: #ff9800;
    font-size: 1.3em;
}
#visuel-hist-feedback, #history-quiz-feedback, #timeline-feedback, #apprentissage-hist-feedback {
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
    #visuel-hist-choix .btn { min-width: 50px; min-height: 50px; font-size: 1.5rem; }
}
</style>
<div class="container mt-5">
    <h1 class="text-center mb-4">Histoire - Primaire</h1>
    <div class="row mb-3">
        <div class="col-12 text-center">
            <p class="lead">Bienvenue dans la section Histoire !<br>Découvre le passé avec des jeux et quiz historiques amusants.</p>
            <div class="btn-group mt-3" role="group" aria-label="Niveau de difficulté">
                <button class="btn btn-outline-primary" id="niveau-facile" onclick="setNiveau('facile')">Facile</button>
                <button class="btn btn-outline-warning" id="niveau-moyen" onclick="setNiveau('moyen')">Moyen</button>
                <button class="btn btn-outline-danger" id="niveau-difficile" onclick="setNiveau('difficile')">Difficile</button>
            </div>
            <div id="niveau-feedback" class="mt-2"></div>
        </div>
    </div>
    <div class="row g-4">
        <!-- Exercice visuel Histoire -->
        <div class="col-md-12">
            <div class="card h-100 mb-4">
                <div class="card-body text-center">
                    <h3 class="card-title mb-3">Exercice visuel</h3>
                    <p>Choisis l'image qui correspond à l'événement ou au personnage&nbsp;: <span id="visuel-hist-mot" class="fw-bold"></span></p>
                    <div id="visuel-hist-choix" class="d-flex justify-content-center gap-4 mb-2 flex-wrap"></div>
                    <div id="visuel-hist-feedback"></div>
                    <div id="visuel-hist-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionVisuelHist()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Timeline Ordering QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Remets dans l'ordre</h3>
                    <div id="timeline-area">
                        <p class="fs-5">Mets ces événements dans l'ordre chronologique :</p>
                        <div id="timeline-qcm-choices"></div>
                        <div id="timeline-feedback" class="mt-3"></div>
                    </div>
                    <div id="timeline-hist-score" class="mt-3"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionTimelineHist()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Simple History Quiz QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Quiz : Histoire</h3>
                    <div id="history-quiz-area">
                        <p id="history-quiz-question" class="fs-4"></p>
                        <div id="history-quiz-choices" class="mb-2"></div>
                        <div id="history-quiz-feedback" class="mt-3"></div>
                    </div>
                    <div id="history-quiz-score" class="mt-3"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionHistoryQuiz()">Nouvelle question</button>
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
                        <span class="fs-5 me-2">La Révolution française a eu lieu en ___ .</span>
                        <input type="text" id="apprentissage-hist-answer" class="form-control w-auto me-2" style="width:100px;">
                        <button class="btn btn-warning" onclick="checkApprentissageHistAnswer()">Valider</button>
                    </div>
                    <div id="apprentissage-hist-feedback"></div>
                    <div id="apprentissage-hist-score" class="mt-3"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionApprentissageHist()">Nouvelle question</button>
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
    renderVisuelHist();
    renderTimelineQCM();
    generateHistoryQuizQCM();
    visuelHistScore = 0;
    timelineHistScore = 0;
    historyQuizScore = 0;
    apprentissageHistScore = 0;
    updateVisuelHistScore();
    updateTimelineHistScore();
    updateHistoryQuizScore();
    updateApprentissageHistScore();
}
// Exercice visuel Histoire (QCM)
const visuelHistData = {
    facile: [
        {mot: 'Révolution française', images: ['🇫🇷', '🏰', '⚔️', '👑'], correct: 0},
        {mot: 'Pyramides d\'Égypte', images: ['🏰', '🗼', '🗿', '🗻'], correct: 2},
        {mot: 'Louis XIV', images: ['👑', '⚔️', '🏰', '🇫🇷'], correct: 0},
        {mot: 'Tour Eiffel', images: ['🗼', '🏰', '🗿', '🇫🇷'], correct: 0},
        {mot: 'Charlemagne', images: ['👑', '⚔️', '🏰', '🇫🇷'], correct: 0}
    ],
    moyen: [
        {mot: 'Christophe Colomb', images: ['🚢', '🧭', '🌎', '👑'], correct: 0},
        {mot: 'Napoléon', images: ['👑', '⚔️', '🏰', '🇫🇷'], correct: 1},
        {mot: 'Vercingétorix', images: ['⚔️', '👑', '🏰', '🇫🇷'], correct: 0},
        {mot: 'Gustave Eiffel', images: ['🗼', '🏰', '🗿', '🇫🇷'], correct: 0},
        {mot: 'Cléopâtre', images: ['👑', '🏰', '🗿', '🇪🇬'], correct: 0}
    ],
    difficile: [
        {mot: 'Guerre de Cent Ans', images: ['⚔️', '🏰', '🇫🇷', '🗼'], correct: 0},
        {mot: 'Déclaration des droits de l\'homme', images: ['📜', '🇫🇷', '👑', '🏰'], correct: 0},
        {mot: 'Prise de la Bastille', images: ['🏰', '⚔️', '🇫🇷', '🗼'], correct: 0},
        {mot: 'Lafayette', images: ['👑', '⚔️', '🏰', '🇫🇷'], correct: 1},
        {mot: 'Renaissance', images: ['🎨', '🏰', '📜', '🇫🇷'], correct: 0}
    ]
};
let visuelHistIndex = 0;
let visuelHistScore = 0;
function updateVisuelHistScore() {
    document.getElementById('visuel-hist-score').innerHTML = `🏆 Score : <b>${visuelHistScore}</b>`;
}
function nouvelleQuestionVisuelHist() {
    renderVisuelHist();
    document.getElementById('visuel-hist-feedback').textContent = '';
}
function renderVisuelHist() {
    const dataArr = visuelHistData[niveau];
    visuelHistIndex = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[visuelHistIndex];
    document.getElementById('visuel-hist-mot').textContent = data.mot;
    const choixDiv = document.getElementById('visuel-hist-choix');
    choixDiv.innerHTML = '';
    data.images.forEach((img, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-light fs-2 mb-2';
        btn.innerHTML = img;
        btn.onclick = function() { checkVisuelHist(idx); };
        choixDiv.appendChild(btn);
    });
    document.getElementById('visuel-hist-feedback').textContent = '';
}
function checkVisuelHist(idx) {
    const data = visuelHistData[niveau][visuelHistIndex];
    const feedback = document.getElementById('visuel-hist-feedback');
    if (idx === data.correct) {
        feedback.textContent = `Bravo ! Bonne image 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success';
        visuelHistScore++;
        updateVisuelHistScore();
        setTimeout(renderVisuelHist, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <span class='fs-2'>${data.images[data.correct]}</span>`;
        feedback.className = 'text-danger';
    }
}
// Timeline QCM
const timelineQCM = {
    facile: [
        {choices: ['Pyramides', 'Révolution française', 'Découverte de l\'Amérique'], correct: 0, order: '1,2,3'},
        {choices: ['Louis XIV', 'Révolution française', 'Tour Eiffel'], correct: 0, order: '1,2,3'}
    ],
    moyen: [
        {choices: ['Prise de la Bastille', 'Louis XIV', 'Tour Eiffel'], correct: 0, order: '1,2,3'},
        {choices: ['Guerre de Cent Ans', 'Renaissance', 'Révolution française'], correct: 0, order: '1,2,3'}
    ],
    difficile: [
        {choices: ['Guerre de Cent Ans', 'Déclaration des droits de l\'homme', 'Prise de la Bastille'], correct: 0, order: '1,2,3'},
        {choices: ['Renaissance', 'Révolution française', 'Première Guerre mondiale'], correct: 0, order: '1,2,3'}
    ]
};
let timelineHistScore = 0;
function updateTimelineHistScore() {
    document.getElementById('timeline-hist-score').innerHTML = `🏆 Score : <b>${timelineHistScore}</b>`;
}
function nouvelleQuestionTimelineHist() {
    renderTimelineQCM();
    document.getElementById('timeline-feedback').textContent = '';
}
function renderTimelineQCM() {
    const dataArr = timelineQCM[niveau];
    const idx = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[idx];
    const choicesDiv = document.getElementById('timeline-qcm-choices');
    choicesDiv.innerHTML = '';
    data.choices.forEach((choice, idx) => {
        const span = document.createElement('span');
        span.className = 'badge bg-primary fs-6 me-2';
        span.textContent = `${idx+1}. ${choice}`;
        choicesDiv.appendChild(span);
    });
    // QCM pour l'ordre
    const orderChoices = ['1,2,3', '2,1,3', '3,2,1'];
    orderChoices.forEach((order, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-primary me-2 mb-2';
        btn.textContent = order;
        btn.onclick = function() { checkTimelineQCMAnswer(order, data.order); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('timeline-feedback').textContent = '';
}
function checkTimelineQCMAnswer(selected, correct) {
    const feedback = document.getElementById('timeline-feedback');
    if (selected === correct) {
        feedback.textContent = `Bravo ! C'est le bon ordre 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success';
        timelineHistScore++;
        updateTimelineHistScore();
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${correct}</b>`;
        feedback.className = 'text-danger';
    }
}
// History Quiz QCM
const historyQuestions = {
    facile: [
        {q: "Qui a découvert l'Amérique en 1492 ?", choices: ['Louis XIV', 'Christophe Colomb', 'Napoléon', 'Charlemagne'], correct: 1},
        {q: "Quel roi était surnommé le Roi Soleil ?", choices: ['Louis XIV', 'Louis XVI', 'Napoléon', 'Henri IV'], correct: 0},
        {q: "Qui a construit la Tour Eiffel ?", choices: ['Gustave Eiffel', 'Louis XIV', 'Napoléon', 'Victor Hugo'], correct: 0},
        {q: "Qui était Cléopâtre ?", choices: ['Reine d\'Égypte', 'Reine de France', 'Impératrice de Russie', 'Princesse d\'Espagne'], correct: 0}
    ],
    moyen: [
        {q: "En quelle année a eu lieu la Révolution française ?", choices: ['1789', '1492', '1914', '1945'], correct: 0},
        {q: "Qui a écrit la Déclaration des droits de l'homme ?", choices: ['Rousseau', 'Voltaire', 'Lafayette', 'Napoléon'], correct: 2},
        {q: "Qui a découvert la pénicilline ?", choices: ['Pasteur', 'Fleming', 'Curie', 'Einstein'], correct: 1},
        {q: "Qui a inventé l'imprimerie ?", choices: ['Gutenberg', 'Edison', 'Franklin', 'Tesla'], correct: 0}
    ],
    difficile: [
        {q: "Quelle guerre a duré 100 ans ?", choices: ['Guerre de Cent Ans', 'Première Guerre mondiale', 'Guerre de Sécession', 'Guerre de Trente Ans'], correct: 0},
        {q: "Qui a été le premier président de la République française ?", choices: ['Napoléon', 'Louis XVI', 'Louis-Napoléon Bonaparte', 'De Gaulle'], correct: 2},
        {q: "Qui a peint la Joconde ?", choices: ['Michel-Ange', 'Léonard de Vinci', 'Raphaël', 'Rembrandt'], correct: 1},
        {q: "En quelle année a commencé la Première Guerre mondiale ?", choices: ['1914', '1789', '1939', '1945'], correct: 0}
    ]
};
let historyQuizScore = 0;
function updateHistoryQuizScore() {
    document.getElementById('history-quiz-score').innerHTML = `🏆 Score : <b>${historyQuizScore}</b>`;
}
function nouvelleQuestionHistoryQuiz() {
    generateHistoryQuizQCM();
    document.getElementById('history-quiz-feedback').textContent = '';
}
function generateHistoryQuizQCM() {
    const dataArr = historyQuestions[niveau];
    const idx = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[idx];
    document.getElementById('history-quiz-question').textContent = data.q;
    const choicesDiv = document.getElementById('history-quiz-choices');
    choicesDiv.innerHTML = '';
    data.choices.forEach((choice, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-primary me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkHistoryQuizQCMAnswer(idx, data.correct, data.choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('history-quiz-feedback').textContent = '';
}
function checkHistoryQuizQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('history-quiz-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success mt-3';
        historyQuizScore++;
        updateHistoryQuizScore();
        setTimeout(generateHistoryQuizQCM, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger mt-3';
    }
}
const apprentissageData = {
    facile: [
        {sentence: "La Révolution française a eu lieu en ___ .", answer: "1789"},
        {sentence: "Christophe Colomb a découvert l'Amérique en ___ .", answer: "1492"},
        {sentence: "Louis XIV était surnommé le ___ Soleil.", answer: "Roi"},
        {sentence: "La Tour Eiffel a été construite en ___ .", answer: "1889"}
    ],
    moyen: [
        {sentence: "La Déclaration des droits de l'homme a été écrite en ___ .", answer: "1789"},
        {sentence: "La Joconde a été peinte par ___ .", answer: "Léonard de Vinci"},
        {sentence: "La Renaissance commence au ___ siècle.", answer: "XVe"},
        {sentence: "La Bastille a été prise le 14 ___ 1789.", answer: "juillet"}
    ],
    difficile: [
        {sentence: "La Guerre de Cent Ans a duré ___ ans.", answer: "116"},
        {sentence: "La Première Guerre mondiale a commencé en ___ .", answer: "1914"},
        {sentence: "Lafayette a aidé la Révolution ___ .", answer: "américaine"},
        {sentence: "La Révolution industrielle commence au ___ siècle.", answer: "XIXe"}
    ]
};
let apprentissageIndex = 0;
let apprentissageHistScore = 0;
function updateApprentissageHistScore() {
    document.getElementById('apprentissage-hist-score').innerHTML = `🏆 Score : <b>${apprentissageHistScore}</b>`;
}
function nouvelleQuestionApprentissageHist() {
    renderApprentissageHist();
    document.getElementById('apprentissage-hist-feedback').textContent = '';
}
function renderApprentissageHist() {
    const dataArr = apprentissageData[niveau];
    apprentissageIndex = Math.floor(Math.random() * dataArr.length);
    document.querySelector('.fs-5.me-2').textContent = dataArr[apprentissageIndex].sentence;
    document.getElementById('apprentissage-hist-answer').value = '';
    document.getElementById('apprentissage-hist-feedback').textContent = '';
}
function checkApprentissageHistAnswer() {
    const answer = document.getElementById('apprentissage-hist-answer').value.trim().toLowerCase();
    const feedback = document.getElementById('apprentissage-hist-feedback');
    const dataArr = apprentissageData[niveau];
    const correct = dataArr[apprentissageIndex].answer.toLowerCase();
    if (answer === correct) {
        feedback.textContent = 'Bravo ! Bonne réponse.';
        feedback.className = 'text-success';
        apprentissageHistScore++;
        updateApprentissageHistScore();
        setTimeout(renderApprentissageHist, 1500);
    } else {
        feedback.textContent = `Essaie encore ! La bonne réponse était : ${dataArr[apprentissageIndex].answer}`;
        feedback.className = 'text-danger';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    setNiveau('facile');
    renderVisuelHist();
    renderTimelineQCM();
    generateHistoryQuizQCM();
    renderApprentissageHist();
    addEnterKeyValidation('apprentissage-hist-answer', checkApprentissageHistAnswer);
});
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
</script>
<?php
require_once '../../templates/footer.php';
?> 