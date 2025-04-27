<?php 
$base_path = dirname(dirname(__DIR__));
include $base_path . '/includes/header.php';
require_once $base_path . '/includes/functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>L'Alphabet</title>
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

        .letter-card {
            width: 150px;
            height: 180px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: white;
        }

        .letter-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .letter-card.playing {
            animation: bounce 0.5s ease;
        }

        .letter {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .word {
            font-size: 18px;
            color: #666;
        }

        .game-section {
            display: none;
        }

        .game-section.active {
            display: block;
        }

        .score {
            font-size: 24px;
            margin: 20px 0;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .btn-mode {
            margin: 0 5px;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-mode:hover {
            transform: scale(1.05);
        }

        #options button {
            margin: 10px;
            padding: 15px 30px;
            font-size: 20px;
            border-radius: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        #options button:hover {
            transform: scale(1.05);
        }

        #quiz-timer {
            font-size: 24px;
            color: #ff6b6b;
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .correct-answer {
            background-color: #4CAF50 !important;
            color: white !important;
            animation: correct 0.5s ease;
        }

        .incorrect-answer {
            background-color: #f44336 !important;
            color: white !important;
            animation: incorrect 0.5s ease;
        }

        @keyframes correct {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes incorrect {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
            100% { transform: translateX(0); }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4 rainbow-text">L'Alphabet</h1>
        
        <div class="text-center mb-4">
            <button class="btn btn-primary btn-mode" onclick="switchMode('learn')">Découvrir</button>
            <button class="btn btn-success btn-mode" onclick="switchMode('play')">Jouer</button>
            <button class="btn btn-warning btn-mode" onclick="switchMode('quiz')">Quiz</button>
        </div>

        <div id="learn-section" class="game-section active">
            <div id="alphabet-grid" class="d-flex flex-wrap justify-content-center">
                <!-- Letters will be generated here -->
            </div>
        </div>

        <div id="play-section" class="game-section">
            <div class="text-center">
                <div class="score">Score: <span id="play-score">0</span></div>
                <div class="letter-card mx-auto mb-4">
                    <div id="current-letter" class="letter"></div>
                </div>
                <div id="options" class="d-flex flex-wrap justify-content-center">
                    <!-- Options will be generated here -->
                </div>
            </div>
        </div>

        <div id="quiz-section" class="game-section">
            <div class="text-center">
                <div class="score">Score: <span id="quiz-score">0</span></div>
                <div id="quiz-word" class="h2 mb-4"></div>
                <div id="quiz-timer" class="h2 mb-4">30</div>
                <div id="quiz-options" class="d-flex flex-wrap justify-content-center">
                    <!-- Quiz options will be generated here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        const alphabet = {
            'A': { word: 'Avion', color: '#FFB3BA' },
            'B': { word: 'Ballon', color: '#BAFFC9' },
            'C': { word: 'Chat', color: '#BAE1FF' },
            'D': { word: 'Dauphin', color: '#FFFFBA' },
            'E': { word: 'Éléphant', color: '#FFB3FF' },
            'F': { word: 'Fleur', color: '#B3FFF3' },
            'G': { word: 'Gâteau', color: '#FFD9BA' },
            'H': { word: 'Hélicoptère', color: '#E5BAFF' },
            'I': { word: 'Igloo', color: '#BAF7FF' },
            'J': { word: 'Jardin', color: '#FFBAB3' },
            'K': { word: 'Kangourou', color: '#BAFFBA' },
            'L': { word: 'Lion', color: '#FFE5BA' },
            'M': { word: 'Maison', color: '#BAC9FF' },
            'N': { word: 'Nid', color: '#FFBAE5' },
            'O': { word: 'Oiseau', color: '#B3FFE5' },
            'P': { word: 'Papillon', color: '#FFBAD4' },
            'Q': { word: 'Queue', color: '#BAF0FF' },
            'R': { word: 'Robot', color: '#FFD4BA' },
            'S': { word: 'Soleil', color: '#BACEFF' },
            'T': { word: 'Train', color: '#FFB3E5' },
            'U': { word: 'Usine', color: '#B3FFF0' },
            'V': { word: 'Vélo', color: '#FFBACC' },
            'W': { word: 'Wagon', color: '#BAE8FF' },
            'X': { word: 'Xylophone', color: '#FFDEBA' },
            'Y': { word: 'Yoyo', color: '#BAD4FF' },
            'Z': { word: 'Zèbre', color: '#FFB3D9' }
        };

        const wordBank = [
            { word: 'Chat', synonyms: ['Minou', 'Félin', 'Matou'] },
            { word: 'Chien', synonyms: ['Toutou', 'Canin', 'Chiot'] },
            { word: 'Soleil', synonyms: ['Astro', 'Jour', 'Lumière'] },
            { word: 'Eau', synonyms: ['Liquide', 'Pluie', 'Source'] },
            { word: 'Papa', synonyms: ['Père', 'Papa', 'Dada'] },
            { word: 'Maman', synonyms: ['Mère', 'Maman', 'Mamie'] },
            { word: 'Bébé', synonyms: ['Petit', 'Nourrisson', 'Enfant'] },
            { word: 'Livre', synonyms: ['Bouquin', 'Histoire', 'Conte'] },
            { word: 'Ballon', synonyms: ['Balle', 'Rond', 'Jouet'] },
            { word: 'Lait', synonyms: ['Boisson', 'Blanc', 'Vache'] },
            { word: 'Pomme', synonyms: ['Fruit', 'Rouge', 'Verte'] },
            { word: 'Fleur', synonyms: ['Plante', 'Rose', 'Tulipe'] },
            { word: 'Maison', synonyms: ['Chez', 'Domicile', 'Toit'] },
            { word: 'Arbre', synonyms: ['Bois', 'Forêt', 'Feuille'] },
            { word: 'Voiture', synonyms: ['Auto', 'Véhicule', 'Taxi'] },
            { word: 'Oiseau', synonyms: ['Aile', 'Plume', 'Vol'] },
            { word: 'Poisson', synonyms: ['Nage', 'Mer', 'Aquatique'] },
            { word: 'Pain', synonyms: ['Baguette', 'Croûte', 'Tranche'] },
            { word: 'Nez', synonyms: ['Visage', 'Odeur', 'Respirer'] },
            { word: 'Main', synonyms: ['Doigt', 'Bras', 'Toucher'] }
        ];

        let playScore = 0;
        let quizScore = 0;
        let quizTimer = 30; // 30 seconds for the whole quiz
        let quizInterval;
        let quizChoices = [];
        let currentFeedbackAudio = null;
        let quizActive = false;

        function generateAlphabetGrid() {
            const grid = document.getElementById('alphabet-grid');
            grid.innerHTML = '';
            
            Object.entries(alphabet).forEach(([letter, data]) => {
                const card = document.createElement('div');
                card.className = 'letter-card';
                card.style.backgroundColor = data.color;
                card.innerHTML = `
                    <div class="letter">${letter}</div>
                    <div class="word">${data.word}</div>
                `;
                card.onclick = () => playLetter(letter);
                grid.appendChild(card);
            });
        }

        function playLetter(letter) {
            const cards = document.querySelectorAll('.letter-card');
            const card = Array.from(cards).find(card => 
                card.querySelector('.letter').textContent === letter
            );
            
            if (card) {
                card.classList.add('playing');
                setTimeout(() => card.classList.remove('playing'), 500);

                const utterance = new SpeechSynthesisUtterance();
                utterance.lang = 'fr-FR';
                utterance.rate = 0.8;

                // Pronounce letter
                utterance.text = letter;
                window.speechSynthesis.speak(utterance);

                // Pronounce word after delay
                setTimeout(() => {
                    utterance.text = alphabet[letter].word;
                    window.speechSynthesis.speak(utterance);
                }, 1000);
            }
        }

        function switchMode(mode) {
            document.querySelectorAll('.game-section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(`${mode}-section`).classList.add('active');

            if (mode === 'learn') {
                generateAlphabetGrid();
            } else if (mode === 'play') {
                generatePlayQuestion();
            } else if (mode === 'quiz') {
                generateQuizQuestion();
            }
        }

        function generatePlayQuestion() {
            const letters = Object.keys(alphabet);
            const correctLetter = letters[Math.floor(Math.random() * letters.length)];
            document.getElementById('current-letter').textContent = correctLetter;

            const options = document.getElementById('options');
            options.innerHTML = '';

            // Generate 4 options including the correct one
            const allWords = Object.values(alphabet).map(data => data.word);
            const correctWord = alphabet[correctLetter].word;
            const wrongWords = allWords.filter(word => word !== correctWord);
            const shuffledWrongWords = wrongWords.sort(() => Math.random() - 0.5).slice(0, 3);
            const allOptions = [...shuffledWrongWords, correctWord].sort(() => Math.random() - 0.5);

            allOptions.forEach(word => {
                const button = document.createElement('button');
                button.className = 'btn btn-outline-primary';
                button.textContent = word;
                button.onclick = () => checkPlayAnswer(word, correctWord);
                options.appendChild(button);
            });
        }

        function checkPlayAnswer(selectedWord, correctWord) {
            const utterance = new SpeechSynthesisUtterance();
            utterance.lang = 'fr-FR';
            utterance.rate = 0.8;

            if (selectedWord === correctWord) {
                playScore += 10;
                utterance.text = "Bravo! C'est correct!";
            } else {
                utterance.text = "Non, ce n'est pas correct. Essaie encore!";
            }
            
            document.getElementById('play-score').textContent = playScore;
            window.speechSynthesis.speak(utterance);
            setTimeout(generatePlayQuestion, 1500);
        }

        function generateQuizQuestion() {
            if (!quizActive) {
                quizActive = true;
                quizTimer = 30;
                document.getElementById('quiz-timer').textContent = quizTimer;
                quizInterval = setInterval(() => {
                    quizTimer--;
                    document.getElementById('quiz-timer').textContent = quizTimer;
                    if (quizTimer <= 0) {
                        clearInterval(quizInterval);
                        quizActive = false;
                        showQuizSummary();
                    }
                }, 1000);
            }
            const randomWord = wordBank[Math.floor(Math.random() * wordBank.length)];
            document.getElementById('quiz-word').textContent = randomWord.word;

            const options = document.getElementById('quiz-options');
            options.innerHTML = '';

            // Generate 4 options including the correct one
            const allSynonyms = wordBank.flatMap(item => item.synonyms);
            const correctSynonym = randomWord.synonyms[0];
            const wrongSynonyms = allSynonyms.filter(syn => syn !== correctSynonym);
            const shuffledWrongSynonyms = wrongSynonyms.sort(() => Math.random() - 0.5).slice(0, 3);
            const allOptions = [...shuffledWrongSynonyms, correctSynonym].sort(() => Math.random() - 0.5);

            allOptions.forEach(synonym => {
                const button = document.createElement('button');
                button.className = 'btn btn-outline-warning';
                button.textContent = synonym;
                button.onclick = () => {
                    checkQuizAnswer(synonym, correctSynonym);
                    // Disable all buttons after selection
                    document.querySelectorAll('#quiz-options button').forEach(btn => {
                        btn.disabled = true;
                    });
                };
                options.appendChild(button);
            });
        }

        function checkQuizAnswer(selectedSynonym, correctSynonym) {
            clearInterval(quizInterval);
            const utterance = new SpeechSynthesisUtterance();
            utterance.lang = 'fr-FR';
            utterance.rate = 0.8;

            const buttons = document.querySelectorAll('#quiz-options button');
            buttons.forEach(button => {
                if (button.textContent === correctSynonym) {
                    button.style.backgroundColor = 'green';
                    button.style.color = 'white';
                } else if (button.textContent === selectedSynonym) {
                    button.style.backgroundColor = 'red';
                    button.style.color = 'white';
                }
            });

            if (selectedSynonym === correctSynonym) {
                quizScore += 10;
                if (currentFeedbackAudio) {
                    currentFeedbackAudio.pause();
                    currentFeedbackAudio.currentTime = 0;
                }
                const audio = new Audio('/projet/assets/audio/effects/correct.m4a');
                currentFeedbackAudio = audio;
                audio.play();
                quizChoices.push({ word: document.getElementById('quiz-word').textContent, correct: true });
                setTimeout(generateQuizQuestion, 1200);
            } else {
                if (currentFeedbackAudio) {
                    currentFeedbackAudio.pause();
                    currentFeedbackAudio.currentTime = 0;
                }
                const audio = new Audio('/projet/assets/audio/effects/false.m4a');
                currentFeedbackAudio = audio;
                audio.play();
                utterance.text = `La bonne réponse est: ${correctSynonym}`;
                quizChoices.push({ word: document.getElementById('quiz-word').textContent, correct: false });
                window.speechSynthesis.speak(utterance);
                setTimeout(generateQuizQuestion, 1800);
            }
            
            document.getElementById('quiz-score').textContent = quizScore;
        }

        function showQuizSummary() {
            quizActive = false;
            const summary = document.createElement('div');
            summary.className = 'quiz-summary';
            summary.innerHTML = `
                <h2>Quiz Summary</h2>
                <p>Your final score: ${quizScore}</p>
                <h3>Correct Choices:</h3>
                <ul>
                    ${quizChoices.filter(choice => choice.correct).map(choice => `<li>${choice.word}</li>`).join('')}
                </ul>
                <h3>Incorrect Choices:</h3>
                <ul>
                    ${quizChoices.filter(choice => !choice.correct).map(choice => `<li>${choice.word}</li>`).join('')}
                </ul>
            `;
            document.getElementById('quiz-section').appendChild(summary);
        }

        // Initialize the page
        generateAlphabetGrid();
    </script>
</body>
</html>

<?php 
$base_path = dirname(dirname(__DIR__));
include $base_path . '/includes/footer.php';
?> 