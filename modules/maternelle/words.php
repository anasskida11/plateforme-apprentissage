<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">Apprendre les Mots</h1>
        <p class="lead">Découvre de nouveaux mots en t'amusant !</p>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card word-card h-100" data-word="chat">
                <iframe src="<?= $root_path ?>assets/images/words/chat.html" class="card-img-top" style="height: 200px; border: none;"></iframe>
                <div class="card-body">
                    <h5 class="card-title">Chat</h5>
                    <p class="card-text">Clique pour écouter le mot</p>
                    <button class="btn btn-primary play-button" onclick="playWord('chat')">
                        <i class="fas fa-volume-up"></i> Écouter
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card word-card h-100" data-word="chien">
                <iframe src="<?= $root_path ?>assets/images/words/chien.html" class="card-img-top" style="height: 200px; border: none;"></iframe>
                <div class="card-body">
                    <h5 class="card-title">Chien</h5>
                    <p class="card-text">Clique pour écouter le mot</p>
                    <button class="btn btn-primary play-button" onclick="playWord('chien')">
                        <i class="fas fa-volume-up"></i> Écouter
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card word-card h-100" data-word="lapin">
                <iframe src="<?= $root_path ?>assets/images/words/lapin.html" class="card-img-top" style="height: 200px; border: none;"></iframe>
                <div class="card-body">
                    <h5 class="card-title">Lapin</h5>
                    <p class="card-text">Clique pour écouter le mot</p>
                    <button class="btn btn-primary play-button" onclick="playWord('lapin')">
                        <i class="fas fa-volume-up"></i> Écouter
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card word-card h-100" data-word="oiseau">
                <iframe src="<?= $root_path ?>assets/images/words/oiseau.html" class="card-img-top" style="height: 200px; border: none;"></iframe>
                <div class="card-body">
                    <h5 class="card-title">Oiseau</h5>
                    <p class="card-text">Clique pour écouter le mot</p>
                    <button class="btn btn-primary play-button" onclick="playWord('oiseau')">
                        <i class="fas fa-volume-up"></i> Écouter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Zone de jeu -->
    <div class="game-section mt-5">
        <h2 class="text-center mb-4">Jouons avec les mots !</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card game-card">
                    <div class="card-body text-center">
                        <h3 class="mb-3">Trouve le mot</h3>
                        <p id="gameInstruction" class="mb-4">Écoute le mot et clique sur la bonne image</p>
                        <button class="btn btn-success btn-lg" onclick="startGame()">
                            <i class="fas fa-play"></i> Commencer le jeu
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.word-card {
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent;
}

.word-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: #3498db;
}

.play-button {
    transition: all 0.3s ease;
}

.play-button:hover {
    transform: scale(1.1);
}

.play-button:active {
    transform: scale(0.95);
}

.game-card {
    background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
    border: none;
    border-radius: 15px;
}

.word-card.playing {
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.word-card.correct {
    border-color: #2ecc71;
    animation: correct 0.5s ease;
}

.word-card.incorrect {
    border-color: #e74c3c;
    animation: incorrect 0.5s ease;
}

@keyframes correct {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

@keyframes incorrect {
    0% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    75% { transform: translateX(10px); }
    100% { transform: translateX(0); }
}
</style>

<script>
let currentAudio = null;
let isPlaying = false;
let gameMode = false;
let currentWord = '';
const words = ['chat', 'chien', 'lapin', 'oiseau'];
const synth = window.speechSynthesis;

function playWord(word) {
    if (isPlaying) {
        synth.cancel();
    }

    const card = document.querySelector(`.word-card[data-word="${word}"]`);
    card.classList.add('playing');

    isPlaying = true;
    
    // Créer un nouvel utterance pour la synthèse vocale
    const utterance = new SpeechSynthesisUtterance(word);
    utterance.lang = 'fr-FR';
    utterance.rate = 0.8; // Parler un peu plus lentement
    
    utterance.onend = function() {
        card.classList.remove('playing');
        isPlaying = false;
    };

    synth.speak(utterance);

    if (gameMode) {
        checkAnswer(word);
    }
}

function startGame() {
    gameMode = true;
    document.getElementById('gameInstruction').textContent = "Écoute bien et trouve le bon mot !";
    nextWord();
}

function nextWord() {
    currentWord = words[Math.floor(Math.random() * words.length)];
    setTimeout(() => {
        playWord(currentWord);
    }, 1000);
}

function checkAnswer(word) {
    if (!gameMode) return;

    const card = document.querySelector(`.word-card[data-word="${word}"]`);
    
    if (word === currentWord) {
        card.classList.add('correct');
        setTimeout(() => {
            card.classList.remove('correct');
            nextWord();
        }, 1000);
    } else {
        card.classList.add('incorrect');
        setTimeout(() => {
            card.classList.remove('incorrect');
        }, 500);
    }
}

// Ajouter les écouteurs d'événements pour les cartes
document.querySelectorAll('.word-card').forEach(card => {
    card.addEventListener('click', function() {
        const word = this.dataset.word;
        playWord(word);
    });
});
</script>

<?php include $root_path . 'templates/footer.php'; ?> 