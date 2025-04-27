<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Animaux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .animal-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            height: 100%;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .animal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .animal-image-container {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .animal-emoji {
            font-size: 100px;
            transition: transform 0.3s ease;
        }

        .animal-card:hover .animal-emoji {
            transform: scale(1.1);
        }

        .animal-info {
            padding: 15px;
            text-align: center;
            background: white;
            border-top: 1px solid #eee;
        }

        .animal-name {
            font-size: 24px;
            color: #2c3e50;
            margin: 0;
            font-family: 'Comic Sans MS', cursive;
        }

        .animal-sound {
            color: #7f8c8d;
            font-style: italic;
            margin: 5px 0 0 0;
            font-size: 18px;
        }

        .playing {
            animation: bounce 0.5s ease infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .game-section {
            display: none;
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .game-section.active {
            display: block;
        }

        .game-card {
            text-align: center;
            padding: 20px;
        }

        .game-emoji {
            font-size: 120px;
            margin: 20px 0;
        }

        .option-button {
            margin: 10px;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 50px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
            border: 2px solid #dee2e6;
            color: #333;
        }

        .option-button:hover {
            transform: scale(1.05);
            background-color: #e9ecef;
        }

        .score-display {
            font-size: 24px;
            color: #28a745;
            margin: 20px 0;
        }

        .correct {
            background-color: #d4edda !important;
            border-color: #28a745 !important;
        }

        .incorrect {
            background-color: #f8d7da !important;
            border-color: #dc3545 !important;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="welcome-section text-center mb-5">
            <h1 class="display-4 rainbow-text">Les Animaux</h1>
            <p class="lead">Découvre les animaux et leurs cris !</p>
            
            <!-- Boutons de mode -->
            <div class="btn-group mb-4" role="group">
                <button class="btn btn-lg btn-primary" onclick="setMode('learn')">Découvrir</button>
                <button class="btn btn-lg btn-success" onclick="setMode('play')">Jouer</button>
                <button class="btn btn-lg btn-warning" onclick="setMode('quiz')">Quiz</button>
            </div>
        </div>

        <!-- Section Découverte -->
        <div id="learn-section" class="game-section active">
            <div class="row" id="animalsGrid"></div>
        </div>

        <!-- Section Jeu -->
        <div id="play-section" class="game-section">
            <div class="game-card">
                <h2>Quel est cet animal ?</h2>
                <div id="game-display" class="game-emoji"></div>
                <div class="score-display">Score: <span id="game-score">0</span></div>
                <div id="game-options" class="d-flex flex-wrap justify-content-center"></div>
            </div>
        </div>

        <!-- Section Quiz -->
        <div id="quiz-section" class="game-section">
            <div class="game-card">
                <h2>Quel est le cri de cet animal ?</h2>
                <div id="quiz-display" class="game-emoji"></div>
                <div class="score-display">Score: <span id="quiz-score">0</span></div>
                <div id="quiz-options" class="d-flex flex-wrap justify-content-center"></div>
            </div>
        </div>
    </div>

    <script>
        const animals = {
            chat: {
                name: 'Chat',
                sound: 'Miaou',
                emoji: '🐱',
                color: '#FFB380'
            },
            chien: {
                name: 'Chien',
                sound: 'Wouf wouf',
                emoji: '🐶',
                color: '#A57D4F'
            },
            vache: {
                name: 'Vache',
                sound: 'Meuh',
                emoji: '🐮',
                color: '#FFFFFF'
            },
            coq: {
                name: 'Coq',
                sound: 'Cocorico',
                emoji: '🐔',
                color: '#FF4757'
            },
            mouton: {
                name: 'Mouton',
                sound: 'Bêêê',
                emoji: '🐑',
                color: '#F1F2F6'
            },
            cochon: {
                name: 'Cochon',
                sound: 'Groin groin',
                emoji: '🐷',
                color: '#FFC0CB'
            }
        };

        let currentMode = 'learn';
        let gameScore = 0;
        let quizScore = 0;
        let currentAnimal = null;
        let currentAnimalAudio = null;

        function setMode(mode) {
            currentMode = mode;
            document.querySelectorAll('.game-section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(mode + '-section').classList.add('active');

            if (mode === 'play') {
                startGame();
            } else if (mode === 'quiz') {
                startQuiz();
            }
        }

        function startGame() {
            gameScore = 0;
            updateGameScore();
            newGameQuestion();
        }

        function startQuiz() {
            quizScore = 0;
            updateQuizScore();
            newQuizQuestion();
        }

        function newGameQuestion() {
            const animalKeys = Object.keys(animals);
            currentAnimal = animalKeys[Math.floor(Math.random() * animalKeys.length)];
            
            // Afficher l'emoji
            document.getElementById('game-display').textContent = animals[currentAnimal].emoji;

            // Générer les options
            const options = generateOptions(currentAnimal);
            const optionsHtml = options.map(key => `
                <button class="option-button" onclick="checkGameAnswer('${key}')">
                    ${animals[key].name}
                </button>
            `).join('');
            
            document.getElementById('game-options').innerHTML = optionsHtml;
        }

        function newQuizQuestion() {
            const animalKeys = Object.keys(animals);
            currentAnimal = animalKeys[Math.floor(Math.random() * animalKeys.length)];
            
            // Afficher l'emoji
            document.getElementById('quiz-display').textContent = animals[currentAnimal].emoji;

            // Générer les options
            const options = generateOptions(currentAnimal);
            const optionsHtml = options.map(key => `
                <button class="option-button" onclick="checkQuizAnswer('${key}')">
                    ${animals[key].sound}
                </button>
            `).join('');
            
            document.getElementById('quiz-options').innerHTML = optionsHtml;
        }

        function generateOptions(correctKey) {
            const options = [correctKey];
            const animalKeys = Object.keys(animals);
            
            while (options.length < 4) {
                const randomKey = animalKeys[Math.floor(Math.random() * animalKeys.length)];
                if (!options.includes(randomKey)) {
                    options.push(randomKey);
                }
            }
            
            return options.sort(() => Math.random() - 0.5);
        }

        function checkGameAnswer(answer) {
            const buttons = document.querySelectorAll('#game-options .option-button');
            buttons.forEach(button => {
                button.disabled = true;
                if (button.textContent.trim() === animals[answer].name) {
                    button.classList.add(answer === currentAnimal ? 'correct' : 'incorrect');
                }
            });

            if (answer === currentAnimal) {
                gameScore += 10;
                updateGameScore();
                playCorrectSound();
                setTimeout(() => {
                    newGameQuestion();
                }, 1500);
            } else {
                playIncorrectSound();
                setTimeout(() => {
                    buttons.forEach(button => {
                        button.disabled = false;
                        button.classList.remove('incorrect', 'correct');
                    });
                }, 1500);
            }
        }

        function checkQuizAnswer(answer) {
            const buttons = document.querySelectorAll('#quiz-options .option-button');
            buttons.forEach(button => {
                button.disabled = true;
                if (button.textContent.trim() === animals[answer].sound) {
                    button.classList.add(answer === currentAnimal ? 'correct' : 'incorrect');
                }
            });

            if (answer === currentAnimal) {
                quizScore += 10;
                updateQuizScore();
                playCorrectSound();
                setTimeout(() => {
                    newQuizQuestion();
                }, 1500);
            } else {
                playIncorrectSound();
                setTimeout(() => {
                    buttons.forEach(button => {
                        button.disabled = false;
                        button.classList.remove('incorrect', 'correct');
                    });
                }, 1500);
            }
        }

        function updateGameScore() {
            document.getElementById('game-score').textContent = gameScore;
        }

        function updateQuizScore() {
            document.getElementById('quiz-score').textContent = quizScore;
        }

        function playCorrectSound() {
            const utterance = new SpeechSynthesisUtterance("Bravo !");
            utterance.lang = 'fr-FR';
            window.speechSynthesis.speak(utterance);
        }

        function playIncorrectSound() {
            const utterance = new SpeechSynthesisUtterance("Essaie encore !");
            utterance.lang = 'fr-FR';
            window.speechSynthesis.speak(utterance);
        }

        function generateAnimalsGrid() {
            const grid = document.getElementById('animalsGrid');
            grid.innerHTML = '';
            
            Object.entries(animals).forEach(([key, animal]) => {
                const col = document.createElement('div');
                col.className = 'col-md-4 col-sm-6';
                col.innerHTML = `
                    <div class="animal-card">
                        <div class="animal-image-container" style="background-color: ${animal.color}">
                            <span class="animal-emoji">${animal.emoji}</span>
                        </div>
                        <div class="animal-info">
                            <h3 class="animal-name">${animal.name}</h3>
                            <p class="animal-sound">${animal.sound}</p>
                        </div>
                    </div>
                `;
                
                const card = col.querySelector('.animal-card');
                card.addEventListener('click', () => {
                    card.classList.add('playing');
                    setTimeout(() => card.classList.remove('playing'), 500);

                    // Play custom audio for the 6 animals if available
                    const animalAudioFiles = {
                        chat: 'cat.mp3',
                        chien: 'dog.mp3',
                        vache: 'cow.mp3',
                        coq: 'chicken.mp3',
                        mouton: 'sheep.mp3',
                        cochon: 'pig.mp3'
                    };
                    if (animalAudioFiles[key]) {
                        if (currentAnimalAudio) {
                            currentAnimalAudio.pause();
                            currentAnimalAudio.currentTime = 0;
                        }
                        const audio = new Audio(`/projet/assets/audio/animals/${animalAudioFiles[key]}`);
                        currentAnimalAudio = audio;
                        audio.play();
                    } else {
                        // Fallback to TTS
                        const nameUtterance = new SpeechSynthesisUtterance(animal.name);
                        nameUtterance.lang = 'fr-FR';
                        nameUtterance.rate = 0.8;
                        window.speechSynthesis.speak(nameUtterance);
                        setTimeout(() => {
                            const soundUtterance = new SpeechSynthesisUtterance(animal.sound);
                            soundUtterance.lang = 'fr-FR';
                            soundUtterance.rate = 0.8;
                            soundUtterance.pitch = 1.2;
                            window.speechSynthesis.speak(soundUtterance);
                        }, 1000);
                    }
                });

                grid.appendChild(col);
            });
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', () => {
            generateAnimalsGrid();
            setMode('learn');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include $root_path . 'templates/footer.php'; ?>