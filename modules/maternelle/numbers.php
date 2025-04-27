<?php
$root_path = '../../';
if (file_exists($root_path . 'templates/header.php')) {
    include $root_path . 'templates/header.php';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Nombres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/modules.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Comic Sans MS', cursive;
        }

        .mode-button {
            padding: 15px 40px;
            font-size: 24px;
            border-radius: 50px;
            border: none;
            margin: 10px;
            transition: transform 0.3s ease;
        }

        .mode-button:hover {
            transform: scale(1.05);
        }

        #apprendre-btn {
            background-color: #007bff;
            color: white;
        }

        #jouer-btn {
            background-color: #28a745;
            color: white;
        }

        #compter-btn {
            background-color: #ffc107;
            color: black;
        }

        .game-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }

        .number-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .number-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .number-card:hover {
            transform: translateY(-5px);
        }

        .number-display {
            font-size: 72px;
            margin: 10px 0;
            color: #333;
        }

        .number-word {
            font-size: 24px;
            color: #666;
            margin-top: 10px;
        }

        .number-dots {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            margin: 15px 0;
        }

        .dot {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: currentColor;
        }

        .option-button {
            padding: 15px 30px;
            font-size: 24px;
            margin: 10px;
            border-radius: 15px;
            border: 2px solid #dee2e6;
            background-color: white;
            transition: all 0.3s ease;
        }

        .option-button:hover {
            transform: scale(1.05);
        }

        .score-display {
            font-size: 24px;
            color: #28a745;
            margin: 20px 0;
        }

        .correct {
            background-color: #d4edda;
            border-color: #28a745;
        }

        .incorrect {
            background-color: #f8d7da;
            border-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="welcome-section text-center mb-5">
            <h1 class="display-4 rainbow-text">Les Nombres</h1>
            <p class="lead">Apprends à compter en t'amusant !</p>
        </div>

        <!-- Boutons de mode -->
        <div class="text-center mb-4">
            <button id="apprendre-btn" class="mode-button" onclick="setMode('apprendre')">Apprendre</button>
            <button id="jouer-btn" class="mode-button" onclick="setMode('jouer')">Jouer</button>
            <button id="compter-btn" class="mode-button" onclick="setMode('compter')">Compter</button>
        </div>

        <!-- Section de jeu -->
        <div class="game-section">
            <h2 id="game-title">Apprends les nombres</h2>
            <div class="score-display" style="display: none;">Score: <span id="score">0</span></div>
            <div id="game-content">
                <!-- Le contenu sera généré par JavaScript -->
            </div>
        </div>
    </div>

    <script>
        const numbers = {
            1: { word: 'Un', color: '#FF9F43' },
            2: { word: 'Deux', color: '#FF6B6B' },
            3: { word: 'Trois', color: '#4ECDC4' },
            4: { word: 'Quatre', color: '#45B7D1' },
            5: { word: 'Cinq', color: '#A55EEA' },
            6: { word: 'Six', color: '#2ED573' },
            7: { word: 'Sept', color: '#FF6348' },
            8: { word: 'Huit', color: '#5352ED' },
            9: { word: 'Neuf', color: '#FF4757' },
            10: { word: 'Dix', color: '#747D8C' }
        };

        let currentMode = 'apprendre';
        let score = 0;
        let currentNumber = null;

        function setMode(mode) {
            currentMode = mode;
            score = 0;
            updateScore();
            
            // Mise à jour du titre
            const titles = {
                'apprendre': 'Apprends les nombres',
                'jouer': 'Trouve le nombre...',
                'compter': 'Compte les objets'
            };
            document.getElementById('game-title').textContent = titles[mode];
            
            // Afficher/cacher le score
            document.querySelector('.score-display').style.display = 
                mode === 'apprendre' ? 'none' : 'block';
            
            // Générer le contenu
            generateContent();
        }

        function generateContent() {
            const content = document.getElementById('game-content');
            
            if (currentMode === 'apprendre') {
                content.innerHTML = '<div class="number-grid"></div>';
                const grid = content.querySelector('.number-grid');
                
                for (let i = 1; i <= 10; i++) {
                    const card = document.createElement('div');
                    card.className = 'number-card';
                    card.style.borderLeft = `4px solid ${numbers[i].color}`;
                    card.innerHTML = `
                        <div class="number-display" style="color: ${numbers[i].color}">${i}</div>
                        <div class="number-dots" style="color: ${numbers[i].color}">
                            ${Array(i).fill('<span class="dot"></span>').join('')}
                        </div>
                        <div class="number-word">${numbers[i].word}</div>
                    `;
                    card.onclick = () => playNumber(i);
                    grid.appendChild(card);
                }
            } else if (currentMode === 'jouer') {
                currentNumber = Math.floor(Math.random() * 10) + 1;
                content.innerHTML = `
                    <div class="number-display">${currentNumber}</div>
                    <div id="options-container" class="d-flex flex-wrap justify-content-center">
                        ${generateOptions(currentNumber).map(num => `
                            <button class="option-button" onclick="checkAnswer(${num})">
                                ${numbers[num].word}
                            </button>
                        `).join('')}
                    </div>
                `;
            } else if (currentMode === 'compter') {
                currentNumber = Math.floor(Math.random() * 10) + 1;
                content.innerHTML = `
                    <div class="number-dots" style="font-size: 40px;">
                        ${Array(currentNumber).fill('⚫').join(' ')}
                    </div>
                    <div id="options-container" class="d-flex flex-wrap justify-content-center">
                        ${generateOptions(currentNumber).map(num => `
                            <button class="option-button" onclick="checkAnswer(${num})">
                                ${num}
                            </button>
                        `).join('')}
                    </div>
                `;
            }
        }

        function playNumber(num) {
            const card = event.currentTarget;
            card.style.transform = 'scale(1.1)';
            setTimeout(() => card.style.transform = '', 300);

            // Prononcer le nombre
            speak(num.toString());
            
            // Prononcer le mot après un délai
            setTimeout(() => speak(numbers[num].word), 1000);
        }

        function generateOptions(correct) {
            const options = [correct];
            while (options.length < 4) {
                const num = Math.floor(Math.random() * 10) + 1;
                if (!options.includes(num)) {
                    options.push(num);
                }
            }
            return options.sort(() => Math.random() - 0.5);
        }

        function checkAnswer(answer) {
            const buttons = document.querySelectorAll('.option-button');
            buttons.forEach(button => {
                button.disabled = true;
                if (parseInt(button.textContent) === answer || button.textContent === numbers[answer].word) {
                    button.classList.add(answer === currentNumber ? 'correct' : 'incorrect');
                }
            });

            if (answer === currentNumber) {
                score += 10;
                updateScore();
                speak('Bravo !');
                setTimeout(generateContent, 1500);
            } else {
                speak('Essaie encore !');
                setTimeout(() => {
                    buttons.forEach(button => {
                        button.disabled = false;
                        button.classList.remove('incorrect', 'correct');
                    });
                }, 1500);
            }
        }

        function updateScore() {
            document.getElementById('score').textContent = score;
        }

        function speak(text) {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'fr-FR';
            utterance.rate = 0.8;
            window.speechSynthesis.speak(utterance);
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', () => {
            setMode('apprendre');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (file_exists($root_path . 'templates/footer.php')) {
    include $root_path . 'templates/footer.php';
}
?> 