<?php
require_once '../../templates/header.php';
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Sciences - Primaire</h1>
    <div class="row mb-3">
        <div class="col-12 text-center">
            <p class="lead">Bienvenue dans la section Sciences !<br>Découvre le monde avec des quiz et des jeux scientifiques amusants.</p>
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
                    <p>Choisis l'image qui correspond au mot&nbsp;: <span id="visuel-sc-mot" class="fw-bold"></span></p>
                    <div id="visuel-sc-choix" class="d-flex justify-content-center gap-4 mb-2 flex-wrap"></div>
                    <div id="visuel-sc-feedback"></div>
                    <div id="visuel-sc-score" class="mb-2"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionVisuelSc()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Quiz Vrai/Faux QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Quiz : Vrai ou Faux ?</h3>
                    <div id="science-quiz-area">
                        <p id="science-quiz-question" class="fs-4"></p>
                        <div id="science-quiz-choices" class="mb-2"></div>
                        <div id="science-quiz-feedback" class="mt-3"></div>
                    </div>
                    <div id="science-quiz-score" class="mt-3"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionScienceQuiz()">Nouvelle question</button>
                </div>
            </div>
        </div>
        <!-- Matching QCM -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title mb-3">Associe l'animal à son cri</h3>
                    <div id="match-area">
                        <p class="fs-5">Le chien fait <span id="match-qcm-choices"></span>.</p>
                        <div id="match-feedback" class="mt-3"></div>
                    </div>
                    <div id="match-quiz-score" class="mt-3"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionMatchQuiz()">Nouvelle question</button>
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
                        <span class="fs-5 me-2">Les plantes ont besoin de ___ pour pousser.</span>
                        <input type="text" id="apprentissage-sc-answer" class="form-control w-auto me-2" style="width:100px;">
                        <button class="btn btn-warning" onclick="checkApprentissageScAnswer()">Valider</button>
                    </div>
                    <div id="apprentissage-sc-feedback"></div>
                    <div id="apprentissage-sc-score" class="mt-3"></div>
                    <button class="btn btn-secondary btn-sm mb-2" onclick="nouvelleQuestionApprentissageSc()">Nouvelle question</button>
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
    renderVisuelSc();
    generateScienceQuiz();
    renderMatchQCM();
    visuelScScore = 0;
    scienceQuizScore = 0;
    matchQuizScore = 0;
    apprentissageScScore = 0;
    updateVisuelScScore();
    updateScienceQuizScore();
    updateMatchQuizScore();
    updateApprentissageScScore();
}
// Exercice visuel Sciences (notions scientifiques)
const visuelScData = {
    facile: [
        {mot: 'mammifère', images: ['🐶', '🐟', '🐦', '🐸'], correct: 0},
        {mot: 'oiseau', images: ['🐶', '🐟', '🐦', '🐸'], correct: 2},
        {mot: 'poisson', images: ['🐶', '🐟', '🐦', '🐸'], correct: 1},
        {mot: 'amphibien', images: ['🐶', '🐟', '🐦', '🐸'], correct: 3},
        {mot: 'arbre', images: ['🌳', '🌲', '🌵', '🌴'], correct: 0},
        {mot: 'cactus', images: ['🌳', '🌲', '🌵', '🌴'], correct: 2},
        {mot: 'fleur', images: ['🌹', '🌻', '🌷', '🌼'], correct: 2},
        {mot: 'nuage', images: ['🌧️', '☀️', '🌩️', '☁️'], correct: 3},
        {mot: 'chat', images: ['🐶', '🐟', '🐦', '🐱'], correct: 3},
        {mot: 'chien', images: ['🐶', '🐟', '🐦', '🐱'], correct: 0}
    ],
    moyen: [
        {mot: 'insecte', images: ['🐞', '🐍', '🐢', '🐸'], correct: 0},
        {mot: 'reptile', images: ['🐞', '🐍', '🐢', '🐸'], correct: 1},
        {mot: 'tortue', images: ['🐞', '🐍', '🐢', '🐸'], correct: 2},
        {mot: 'grenouille', images: ['🐞', '🐍', '🐢', '🐸'], correct: 3},
        {mot: 'pluie', images: ['🌧️', '☀️', '🌩️', '☁️'], correct: 0},
        {mot: 'orage', images: ['🌧️', '☀️', '🌩️', '☁️'], correct: 2},
        {mot: 'soleil', images: ['🌧️', '☀️', '🌩️', '☁️'], correct: 1},
        {mot: 'feuille', images: ['🍁', '🍂', '🌿', '🌵'], correct: 0},
        {mot: 'abeille', images: ['🐞', '🐝', '🐢', '🐸'], correct: 1},
        {mot: 'serpent', images: ['🐞', '🐍', '🐢', '🐸'], correct: 1}
    ],
    difficile: [
        {mot: 'planète', images: ['🌍', '🌞', '🌙', '⭐'], correct: 0},
        {mot: 'étoile', images: ['🌍', '🌞', '🌙', '⭐'], correct: 3},
        {mot: 'lune', images: ['🌍', '🌞', '🌙', '⭐'], correct: 2},
        {mot: 'soleil', images: ['🌍', '🌞', '🌙', '⭐'], correct: 1},
        {mot: 'microscope', images: ['🔬', '🧪', '⚗️', '🧲'], correct: 0},
        {mot: 'aimant', images: ['🔬', '🧪', '⚗️', '🧲'], correct: 3},
        {mot: 'tube à essai', images: ['🔬', '🧪', '⚗️', '🧲'], correct: 1},
        {mot: 'bécher', images: ['🧪', '⚗️', '🧫', '🧪'], correct: 0},
        {mot: 'bactérie', images: ['🦠', '🧬', '🧫', '🧪'], correct: 0},
        {mot: 'ADN', images: ['🦠', '🧬', '🧫', '🧪'], correct: 1}
    ]
};
let visuelScIndex = 0;
let visuelScScore = 0;
function updateVisuelScScore() {
    document.getElementById('visuel-sc-score').innerHTML = `🏆 Score : <b>${visuelScScore}</b>`;
}
function nouvelleQuestionVisuelSc() {
    renderVisuelSc();
    document.getElementById('visuel-sc-feedback').textContent = '';
}
function renderVisuelSc() {
    const dataArr = visuelScData[niveau];
    visuelScIndex = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[visuelScIndex];
    document.getElementById('visuel-sc-mot').textContent = data.mot;
    const choixDiv = document.getElementById('visuel-sc-choix');
    choixDiv.innerHTML = '';
    data.images.forEach((img, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-light fs-2 mb-2';
        btn.innerHTML = img;
        btn.onclick = function() { checkVisuelSc(idx); };
        choixDiv.appendChild(btn);
    });
    document.getElementById('visuel-sc-feedback').textContent = '';
}
function checkVisuelSc(idx) {
    const data = visuelScData[niveau][visuelScIndex];
    const feedback = document.getElementById('visuel-sc-feedback');
    if (idx === data.correct) {
        feedback.textContent = `Bravo ! Bonne image 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success';
        visuelScScore++;
        updateVisuelScScore();
        setTimeout(renderVisuelSc, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <span class='fs-2'>${data.images[data.correct]}</span>`;
        feedback.className = 'text-danger';
    }
}
// Quiz Vrai/Faux QCM avec niveau
const scienceQuestions = {
    facile: [
        {q: "Quel animal pond des œufs ?", choices: ['Chien', 'Poisson', 'Chat', 'Lapin'], correct: 1},
        {q: "Lequel est un mammifère ?", choices: ['Poisson', 'Grenouille', 'Chien', 'Tortue'], correct: 2},
        {q: "Lequel vit dans l'eau ?", choices: ['Chien', 'Poisson', 'Chat', 'Souris'], correct: 1},
        {q: "Lequel est un oiseau ?", choices: ['Chien', 'Poisson', 'Chat', 'Pigeon'], correct: 3},
        {q: "Lequel est un insecte ?", choices: ['Chien', 'Poisson', 'Abeille', 'Chat'], correct: 2}
    ],
    moyen: [
        {q: "Quel phénomène produit de la lumière et de la chaleur ?", choices: ['Pluie', 'Soleil', 'Vent', 'Neige'], correct: 1},
        {q: "Quel est l'état de l'eau à 0°C ?", choices: ['Liquide', 'Solide', 'Gazeux', 'Plasma'], correct: 1},
        {q: "Quel organe permet de respirer ?", choices: ['Cœur', 'Poumons', 'Estomac', 'Foie'], correct: 1},
        {q: "Quel animal a des écailles ?", choices: ['Chien', 'Poisson', 'Chat', 'Souris'], correct: 1},
        {q: "Quel animal a des plumes ?", choices: ['Chien', 'Poisson', 'Chat', 'Pigeon'], correct: 3}
    ],
    difficile: [
        {q: "Quel instrument permet d'observer les étoiles ?", choices: ['Microscope', 'Télescope', 'Loupe', 'Boussole'], correct: 1},
        {q: "Quel est le gaz le plus abondant dans l'air ?", choices: ['Oxygène', 'Hydrogène', 'Azote', 'Dioxyde de carbone'], correct: 2},
        {q: "Quel est le plus grand organe du corps humain ?", choices: ['Cœur', 'Peau', 'Foie', 'Poumons'], correct: 1},
        {q: "Quel est l'organe de la vision ?", choices: ['Cœur', 'Œil', 'Foie', 'Poumons'], correct: 1},
        {q: "Quel est l'organe de l'ouïe ?", choices: ['Oreille', 'Œil', 'Foie', 'Poumons'], correct: 0}
    ]
};
let scienceIndex = 0;
let scienceQuizScore = 0;
function updateScienceQuizScore() {
    document.getElementById('science-quiz-score').innerHTML = `🏆 Score : <b>${scienceQuizScore}</b>`;
}
function nouvelleQuestionScienceQuiz() {
    generateScienceQuiz();
    document.getElementById('science-quiz-feedback').textContent = '';
}
function generateScienceQuiz() {
    const dataArr = scienceQuestions[niveau];
    scienceIndex = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[scienceIndex];
    document.getElementById('science-quiz-question').textContent = data.q;
    const choicesDiv = document.getElementById('science-quiz-choices');
    choicesDiv.innerHTML = '';
    data.choices.forEach((choice, idx) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-primary me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkScienceQuizAnswer(idx); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('science-quiz-feedback').textContent = '';
}
function checkScienceQuizAnswer(idx) {
    const data = scienceQuestions[niveau][scienceIndex];
    const feedback = document.getElementById('science-quiz-feedback');
    if (idx === data.correct) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success mt-3';
        scienceQuizScore++;
        updateScienceQuizScore();
        setTimeout(generateScienceQuiz, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${data.choices[data.correct]}</b>`;
        feedback.className = 'text-danger mt-3';
    }
}
// Matching QCM
const matchQCM = {
    facile: [
        {choices: ['aboyer', 'miauler', 'chanter', 'siffler'], correct: 0, question: "Le chien fait ..."},
        {choices: ['miauler', 'aboyer', 'chanter', 'siffler'], correct: 0, question: "Le chat fait ..."}
    ],
    moyen: [
        {choices: ['rugir', 'bêler', 'meugler', 'braire'], correct: 1, question: "Le mouton fait ..."},
        {choices: ['meugler', 'bêler', 'rugir', 'braire'], correct: 0, question: "La vache fait ..."}
    ],
    difficile: [
        {choices: ['glousser', 'hurler', 'grogner', 'craquer'], correct: 2, question: "Le cochon fait ..."},
        {choices: ['hurler', 'glousser', 'grogner', 'craquer'], correct: 0, question: "Le loup fait ..."}
    ]
};
let matchQuizScore = 0;
function updateMatchQuizScore() {
    document.getElementById('match-quiz-score').innerHTML = `🏆 Score : <b>${matchQuizScore}</b>`;
}
function nouvelleQuestionMatchQuiz() {
    renderMatchQCM();
    document.getElementById('match-feedback').textContent = '';
}
function renderMatchQCM() {
    const dataArr = matchQCM[niveau];
    const idx = Math.floor(Math.random() * dataArr.length);
    const data = dataArr[idx];
    const choicesDiv = document.getElementById('match-qcm-choices');
    document.getElementById('match-area').querySelector('p').innerHTML = data.question + ' <span id="match-qcm-choices"></span>.';
    choicesDiv.innerHTML = '';
    data.choices.forEach((choice, i) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-success me-2 mb-2';
        btn.textContent = choice;
        btn.onclick = function() { checkMatchQCMAnswer(i, data.correct, data.choices); };
        choicesDiv.appendChild(btn);
    });
    document.getElementById('match-feedback').textContent = '';
}
function checkMatchQCMAnswer(idx, correctIdx, choices) {
    const feedback = document.getElementById('match-feedback');
    if (idx === correctIdx) {
        feedback.textContent = `Bravo ! Bonne réponse 🎉 (Niveau : ${niveau})`;
        feedback.className = 'text-success';
        matchQuizScore++;
        updateMatchQuizScore();
        setTimeout(renderMatchQCM, 1500);
    } else {
        feedback.innerHTML = `Essaie encore !<br>La bonne réponse était : <b>${choices[correctIdx]}</b>`;
        feedback.className = 'text-danger';
    }
}
// Exercice d'apprentissage
const apprentissageData = {
    facile: [
        {sentence: "Les plantes ont besoin de ___ pour pousser.", answer: "lumière"},
        {sentence: "Le chien est un ___ .", answer: "mammifère"},
        {sentence: "Le poisson vit dans ___ .", answer: "l'eau"},
        {sentence: "L'oiseau a des ___ .", answer: "plumes"}
    ],
    moyen: [
        {sentence: "L'eau bout à ___ degrés Celsius.", answer: "100"},
        {sentence: "Le mouton fait ___ .", answer: "bêler"},
        {sentence: "La vache fait ___ .", answer: "meugler"},
        {sentence: "Le soleil est une ___ .", answer: "étoile"}
    ],
    difficile: [
        {sentence: "Le gaz le plus abondant dans l'air est ___ .", answer: "azote"},
        {sentence: "L'instrument pour observer les étoiles est le ___ .", answer: "télescope"},
        {sentence: "L'organe de la vision est l'___ .", answer: "œil"},
        {sentence: "L'organe de l'ouïe est l'___ .", answer: "oreille"}
    ]
};
let apprentissageIndex = 0;
let apprentissageScScore = 0;
function updateApprentissageScScore() {
    document.getElementById('apprentissage-sc-score').innerHTML = `🏆 Score : <b>${apprentissageScScore}</b>`;
}
function nouvelleQuestionApprentissageSc() {
    renderApprentissageSc();
    document.getElementById('apprentissage-sc-feedback').textContent = '';
}
function renderApprentissageSc() {
    const dataArr = apprentissageData[niveau];
    apprentissageIndex = Math.floor(Math.random() * dataArr.length);
    document.querySelector('.fs-5.me-2').textContent = dataArr[apprentissageIndex].sentence;
    document.getElementById('apprentissage-sc-answer').value = '';
    document.getElementById('apprentissage-sc-feedback').textContent = '';
}
function checkApprentissageScAnswer() {
    const answer = document.getElementById('apprentissage-sc-answer').value.trim().toLowerCase();
    const feedback = document.getElementById('apprentissage-sc-feedback');
    const dataArr = apprentissageData[niveau];
    const correct = dataArr[apprentissageIndex].answer.toLowerCase();
    if (answer === correct) {
        feedback.textContent = 'Bravo ! Bonne réponse.';
        feedback.className = 'text-success';
        apprentissageScScore++;
        updateApprentissageScScore();
        setTimeout(renderApprentissageSc, 1500);
    } else {
        feedback.textContent = `Essaie encore ! La bonne réponse était : ${dataArr[apprentissageIndex].answer}`;
        feedback.className = 'text-danger';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    setNiveau('facile');
    renderVisuelSc();
    generateScienceQuiz();
    renderMatchQCM();
    renderApprentissageSc();
    addEnterKeyValidation('apprentissage-sc-answer', checkApprentissageScAnswer);
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