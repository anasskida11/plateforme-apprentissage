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
#visuel-fr-choix .btn {
    min-width: 70px;
    min-height: 70px;
    font-size: 2.5rem;
}
#visuel-fr-mot {
    color: #ff9800;
    font-size: 1.3em;
}
#visuel-fr-feedback, #vocab-quiz-feedback, #blank-feedback, #apprentissage-fr-feedback {
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
    #visuel-fr-choix .btn { min-width: 50px; min-height: 50px; font-size: 1.5rem; }
}
</style>
<div class="container mt-5">
    <h1 class="text-center mb-4">Français - Primaire</h1>
    <div class="row mb-3">
        <div class="col-12 text-center">
            <p class="lead">Bienvenue dans la section Français !<br>Améliore ton vocabulaire et ta grammaire avec des jeux et exercices interactifs.</p>
            <div class="btn-group mt-3" role="group" aria-label="Niveau de difficulté">
                <button class="btn btn-outline-primary" id="niveau-facile" onclick="setNiveau('facile')">Facile</button>
                <button class="btn btn-outline-warning" id="niveau-moyen" onclick="setNiveau('moyen')">Moyen</button>
                <button class="btn btn-outline-danger" id="niveau-difficile" onclick="setNiveau('difficile')">Difficile</button>
            </div>
            <div id="niveau-feedback" class="mt-2"></div>
        </div>
    </div>
    <div class="row g-4">
        <!-- Exercice d'apprentissage visuel -->
        <div class="col-md-12">
            <div class="card h-100 mb-4">
                <div class="card-body text-center">
                    <h3 class="card-title mb-3">Exercice visuel</h3>
                    <p>Choisis l'image qui correspond au mot&nbsp;: <span id="visuel-fr-mot" class="fw-bold"></span></p>
                    <div id="visuel-fr-choix" class="d-flex justify-content-center gap-4 mb-2 flex-wrap"></div>
                    <div id="visuel-fr-feedback"></div>
                    <div id="visuel-fr-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionVisuelFr()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Quiz Vocabulaire QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Quiz : Trouve le bon mot</h3>
                    <div id="vocab-quiz-area">
                        <p id="vocab-quiz-question" class="fs-4"></p>
                        <div id="vocab-quiz-choices" class="mb-2"></div>
                        <div id="vocab-quiz-feedback" class="mt-3"></div>
                    </div>
                    <div id="vocab-quiz-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionVocabFr()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Fill in the blank QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Complète la phrase</h3>
                    <div id="blank-area">
                        <p class="fs-4" id="blank-qcm-sentence"></p>
                        <span id="blank-qcm-choices"></span>
                        <div id="blank-feedback" class="mt-3"></div>
                    </div>
                    <div id="blank-qcm-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionBlankFr()">Nouvelle question</button>
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
                        <span class="fs-5 me-2">Le ___ mange une pomme.</span>
                        <input type="text" id="apprentissage-fr-answer" class="form-control w-auto me-2" style="width:100px;">
                        <button class="btn btn-warning" onclick="checkApprentissageFrAnswer()">Valider</button>
                    </div>
                    <div id="apprentissage-fr-feedback"></div>
                    <div id="apprentissage-fr-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionApprentissageFr()">Nouvelle question</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Niveau de difficulté
let niveau = 'facile';
let visuelFrScore = 0;
let vocabFrScore = 0;
let blankFrScore = 0;
let apprentissageFrScore = 0;
function setNiveau(n) {
    niveau = n;
    document.getElementById('niveau-feedback').textContent = 'Niveau sélectionné : ' + n.charAt(0).toUpperCase() + n.slice(1);
    document.getElementById('niveau-facile').classList.toggle('active', n === 'facile');
    document.getElementById('niveau-moyen').classList.toggle('active', n === 'moyen');
    document.getElementById('niveau-difficile').classList.toggle('active', n === 'difficile');
    renderVisuelFr();
    generateVocabQuiz();
    renderBlankQCM();
    updateVisuelFrScore();
    updateVocabFrScore();
    updateBlankFrScore();
    updateApprentissageFrScore();
}
// Exercice visuel Français (plus de choix et niveau)
const visuelFrData = {
    facile: [
        {mot: 'chat', images: ['🐱', '🐶', '🐦', '🐸'], correct: 0},
        {mot: 'pomme', images: ['🍌', '🍎', '🍇', '🍓'], correct: 1},
        {mot: 'voiture', images: ['🚲', '🚗', '✈️', '🚕'], correct: 1},
        {mot: 'soleil', images: ['🌙', '🌞', '⭐', '☁️'], correct: 1},
        {mot: 'chien', images: ['🐱', '🐶', '🐦', '🐸'], correct: 1},
        {mot: 'banane', images: ['🍌', '🍎', '🍇', '🍓'], correct: 0},
        {mot: 'oiseau', images: ['🐱', '🐶', '🐦', '🐸'], correct: 2}
    ],
    moyen: [
        {mot: 'livre', images: ['📚', '📖', '📰', '📒'], correct: 1},
        {mot: 'arbre', images: ['🌳', '🌲', '🌵', '🌴'], correct: 0},
        {mot: 'poisson', images: ['🐟', '🐬', '🐳', '🐸'], correct: 0},
        {mot: 'fleur', images: ['🌹', '🌻', '🌷', '🌼'], correct: 2},
        {mot: 'maison', images: ['🏠', '🏢', '🏫', '🏥'], correct: 0},
        {mot: 'train', images: ['🚗', '🚕', '🚙', '🚆'], correct: 3},
        {mot: 'grenouille', images: ['🐟', '🐬', '🐳', '🐸'], correct: 3}
    ],
    difficile: [
        {mot: 'hibou', images: ['🦉', '🦅', '🦆', '🐦'], correct: 0},
        {mot: 'escargot', images: ['🐌', '🐍', '🐛', '🦋'], correct: 0},
        {mot: 'cerise', images: ['🍒', '🍓', '🍎', '🍇'], correct: 0},
        {mot: 'girafe', images: ['🦒', '🦓', '🦁', '🐘'], correct: 0},
        {mot: 'zèbre', images: ['🦒', '🦓', '🦁', '🐘'], correct: 1},
        {mot: 'lion', images: ['🦒', '🦓', '🦁', '🐘'], correct: 2},
        {mot: 'éléphant', images: ['🦒', '🦓', '🦁', '🐘'], correct: 3}
    ]
};
let visuelFrIndex = 0;
function renderVisuelFr() {
    const dataArr = visuelFrData[niveau];
    visuelFrIndex = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[visuelFrIndex];
    document.getElementById('visuel-fr-mot').textContent = data.mot;
    const choixDiv = document.getElementById('visuel-fr-choix');
    choixDiv.innerHTML = '';
    data.images.forEach((img, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-light fs-2 mb-2';
        btn.innerHTML = img;
        btn.onclick = function() { checkVisuelFr(idx); };
        choixDiv.appendChild(btn);
    });
    document.getElementById('visuel-fr-feedback').textContent = '';
}
function checkVisuelFr(idx) {
    const data = visuelFrData[niveau][visuelFrIndex];
    const feedback = document.getElementById('visuel-fr-feedback');
    if (idx === data.correct) {
        feedback.textContent = `Bravo ! Bonne image 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success';
        visuelFrScore++;
        updateVisuelFrScore();
        setTimeout(renderVisuelFr, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <span class='fs-2'>${data.images[data.correct]}</span>`;
        feedback.className = 'text-danger';
    }
}
// Quiz vocabulaire QCM (plus de questions)
const vocabQuestions = {
    facile: [
        {q: "Quel est le féminin de 'chat' ?", choices: ['chatte', 'chien', 'poule', 'vache'], correct: 0},
        {q: "Quel est le contraire de 'grand' ?", choices: ['petit', 'gros', 'haut', 'mince'], correct: 0},
        {q: "Quel est le pluriel de 'pomme' ?", choices: ['pommes', 'pomme', 'pommeses', 'pommesz'], correct: 0},
        {q: "Quel est le masculin de 'chienne' ?", choices: ['chien', 'chat', 'cheval', 'vache'], correct: 0},
        {q: "Quel est le contraire de 'jour' ?", choices: ['nuit', 'matin', 'soir', 'lundi'], correct: 0},
        {q: "Quel est le féminin de 'chien' ?", choices: ['chienne', 'chatte', 'vache', 'poule'], correct: 0}
    ],
    moyen: [
        {q: "Quel est le synonyme de 'rapide' ?", choices: ['vite', 'lent', 'fort', 'grand'], correct: 0},
        {q: "Quel est le contraire de 'facile' ?", choices: ['difficile', 'rapide', 'petit', 'grand'], correct: 0},
        {q: "Quel est le pluriel de 'cheval' ?", choices: ['chevaux', 'chevals', 'chevauxs', 'chevalz'], correct: 0},
        {q: "Quel est le féminin de 'acteur' ?", choices: ['actrice', 'acteur', 'acteuse', 'acteure'], correct: 0},
        {q: "Quel est le synonyme de 'beau' ?", choices: ['joli', 'laid', 'grand', 'petit'], correct: 0},
        {q: "Quel est le contraire de 'chaud' ?", choices: ['froid', 'tiède', 'doux', 'sec'], correct: 0}
    ],
    difficile: [
        {q: "Quel est le féminin de 'roi' ?", choices: ['reine', 'princesse', 'dame', 'fille'], correct: 0},
        {q: "Quel est le pluriel de 'bijou' ?", choices: ['bijoux', 'bijous', 'bijoues', 'bijousx'], correct: 0},
        {q: "Quel est le synonyme de 'courageux' ?", choices: ['brave', 'peureux', 'timide', 'sage'], correct: 0},
        {q: "Quel est le contraire de 'heureux' ?", choices: ['malheureux', 'joyeux', 'content', 'gentil'], correct: 0},
        {q: "Quel est le féminin de 'acteur' ?", choices: ['actrice', 'acteur', 'acteuse', 'acteure'], correct: 0},
        {q: "Quel est le synonyme de 'rapide' ?", choices: ['vite', 'lent', 'fort', 'grand'], correct: 0}
    ]
};
let vocabIndex = 0;
function generateVocabQuiz() {
    const dataArr = vocabQuestions[niveau];
    vocabIndex = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[vocabIndex];
    document.getElementById('vocab-quiz-question').textContent = data.q;
    const choicesDiv = document.getElementById('vocab-quiz-choices');
    choicesDiv.innerHTML = '';
    data.choices.forEach((choice, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-primary me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkVocabQuizAnswer(idx); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('vocab-quiz-feedback').textContent = '';
}
function checkVocabQuizAnswer(idx) {
    const data = vocabQuestions[niveau][vocabIndex];
    const feedback = document.getElementById('vocab-quiz-feedback');
    if (idx === data.correct) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success mt-3';
        vocabFrScore++;
        updateVocabFrScore();
        setTimeout(generateVocabQuiz, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${data.choices[data.correct]}</b>`;
        feedback.className = 'text-danger mt-3';
    }
}
// Fill in the blank QCM (plus de variété)
function renderBlankQCM() {
    const blanks = {
        facile: [
            {sentence: 'Le chat est ___ sur le canapé.', choices: ['assis', 'debout', 'couché', 'sautant'], correct: 0},
            {sentence: 'La pomme est ___ .', choices: ['rouge', 'verte', 'bleue', 'jaune'], correct: 0},
            {sentence: 'Le chien est ___ .', choices: ['grand', 'petit', 'noir', 'blanc'], correct: 1},
            {sentence: 'La banane est ___ .', choices: ['jaune', 'verte', 'rouge', 'bleue'], correct: 0}
        ],
        moyen: [
            {sentence: 'Le livre est ___ .', choices: ['ouvert', 'fermé', 'cassé', 'perdu'], correct: 0},
            {sentence: "L'arbre est ___ .", choices: ['grand', 'petit', 'vert', 'jaune'], correct: 2},
            {sentence: 'Le poisson est ___ .', choices: ['petit', 'grand', 'bleu', 'rouge'], correct: 2},
            {sentence: 'La fleur est ___ .', choices: ['belle', 'moche', 'fanée', 'petite'], correct: 0}
        ],
        difficile: [
            {sentence: 'Le hibou est ___ .', choices: ['sage', 'rapide', 'petit', 'grand'], correct: 0},
            {sentence: "L'escargot est ___ .", choices: ['lent', 'rapide', 'petit', 'grand'], correct: 0},
            {sentence: 'La girafe est ___ .', choices: ['grande', 'petite', 'rapide', 'lente'], correct: 0},
            {sentence: 'Le lion est ___ .', choices: ['fort', 'faible', 'petit', 'grand'], correct: 0}
        ]
    };
    const dataArr = blanks[niveau];
    const idx = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[idx];
    document.getElementById('blank-qcm-sentence').textContent = data.sentence;
    const choicesDiv = document.getElementById('blank-qcm-choices');
    choicesDiv.innerHTML = '';
    data.choices.forEach((choice, i) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-success me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkBlankQCMAnswer(i, data.correct, data.choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('blank-feedback').textContent = '';
}
function checkBlankQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('blank-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success';
        blankFrScore++;
        updateBlankFrScore();
        setTimeout(renderBlankQCM, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    setNiveau('facile');
    renderApprentissageFr();
    renderVisuelFr();
    generateVocabQuiz();
    renderBlankQCM();
    addEnterKeyValidation('apprentissage-fr-answer', checkApprentissageFrAnswer);
    console.log("JS chargé !");
});
// Exercice d'apprentissage (plus de phrases et randomisation)
const apprentissageData = {
    facile: [
        {sentence: 'Le ___ mange une pomme.', answer: 'chat'},
        {sentence: 'La ___ est rouge.', answer: 'pomme'},
        {sentence: 'Le ___ aboie.', answer: 'chien'},
        {sentence: 'La ___ est jaune.', answer: 'banane'}
    ],
    moyen: [
        {sentence: 'Le ___ lit un livre.', answer: 'garçon'},
        {sentence: 'La ___ arrose la fleur.', answer: 'fille'},
        {sentence: 'Le ___ nage dans la mer.', answer: 'poisson'},
        {sentence: 'La ___ pousse dans le jardin.', answer: 'fleur'}
    ],
    difficile: [
        {sentence: 'Le ___ hulule la nuit.', answer: 'hibou'},
        {sentence: "L'escargot est ___ .", answer: 'escargot'},
        {sentence: 'La ___ est très grande.', answer: 'girafe'},
        {sentence: 'Le ___ rugit fort.', answer: 'lion'}
    ]
};
let apprentissageIndex = 0;
function renderApprentissageFr() {
    const dataArr = apprentissageData[niveau];
    apprentissageIndex = Math.floor(Math.random() * dataArr.length);
    document.querySelector('.fs-5.me-2').textContent = dataArr[apprentissageIndex].sentence;
    document.getElementById('apprentissage-fr-answer').value = '';
    document.getElementById('apprentissage-fr-feedback').textContent = '';
}
function checkApprentissageFrAnswer() {
    const answer = document.getElementById('apprentissage-fr-answer').value.trim().toLowerCase();
    const feedback = document.getElementById('apprentissage-fr-feedback');
    const dataArr = apprentissageData[niveau];
    const correct = dataArr[apprentissageIndex].answer;
    if (answer === correct) {
        feedback.textContent = 'Bravo ! Bonne réponse.';
        feedback.className = 'text-success';
        apprentissageFrScore++;
        updateApprentissageFrScore();
        setTimeout(renderApprentissageFr, 1500);
    } else {
        feedback.textContent = `Essaie encore ! La bonne réponse était : ${correct}`;
        feedback.className = 'text-danger';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    addEnterKeyValidation('apprentissage-fr-answer', checkApprentissageFrAnswer);
});
function updateVisuelFrScore() {
    document.getElementById('visuel-fr-score').innerHTML = `🏆 Score : <b>${visuelFrScore}</b>`;
}
function nouvelleQuestionVisuelFr() {
    renderVisuelFr();
    document.getElementById('visuel-fr-feedback').textContent = '';
}
function updateVocabFrScore() {
    document.getElementById('vocab-quiz-score').innerHTML = `🏆 Score : <b>${vocabFrScore}</b>`;
}
function nouvelleQuestionVocabFr() {
    generateVocabQuiz();
    document.getElementById('vocab-quiz-feedback').textContent = '';
}
function updateBlankFrScore() {
    document.getElementById('blank-qcm-score').innerHTML = `🏆 Score : <b>${blankFrScore}</b>`;
}
function nouvelleQuestionBlankFr() {
    renderBlankQCM();
    document.getElementById('blank-feedback').textContent = '';
}
function updateApprentissageFrScore() {
    document.getElementById('apprentissage-fr-score').innerHTML = `🏆 Score : <b>${apprentissageFrScore}</b>`;
}
function nouvelleQuestionApprentissageFr() {
    renderApprentissageFr();
    document.getElementById('apprentissage-fr-feedback').textContent = '';
}
</script>
<?php
require_once '../../templates/footer.php';
?> 