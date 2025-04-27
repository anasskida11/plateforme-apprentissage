<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">English Learning</h1>
        <p class="lead">Learn English in a fun and interactive way!</p>
    </div>

    <!-- Sélection du niveau -->
    <div class="level-selector mb-5">
        <h2 class="text-center mb-4">Choose your level</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="btn-group w-100" role="group">
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('beginner')">Débutant</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('elementary')">Élémentaire</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('intermediate')">Intermédiaire</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sections principales -->
    <div class="row mb-4">
        <!-- Vocabulaire -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-book text-primary"></i> Vocabulary
                    </h3>
                    <div class="vocabulary-categories">
                        <div class="category-item mb-3" onclick="startVocabularyLesson('colors')">
                            <i class="fas fa-palette"></i> Colors
                            <span class="badge bg-primary">8 words</span>
                        </div>
                        <div class="category-item mb-3" onclick="startVocabularyLesson('animals')">
                            <i class="fas fa-paw"></i> Animals
                            <span class="badge bg-primary">12 words</span>
                        </div>
                        <div class="category-item mb-3" onclick="startVocabularyLesson('food')">
                            <i class="fas fa-utensils"></i> Food
                            <span class="badge bg-primary">10 words</span>
                        </div>
                        <div class="category-item" onclick="startVocabularyLesson('numbers')">
                            <i class="fas fa-sort-numeric-up"></i> Numbers
                            <span class="badge bg-primary">20 words</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grammaire -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-pencil-alt text-success"></i> Grammar
                    </h3>
                    <div class="grammar-exercises">
                        <div class="exercise-item mb-3">
                            <h4>Present Simple</h4>
                            <p>Learn to use verbs in present simple</p>
                            <button onclick="startGrammarExercise('present-simple')" class="btn btn-success">
                                Start
                            </button>
                        </div>
                        <div class="exercise-item">
                            <h4>To Be</h4>
                            <p>Practice with the verb "to be"</p>
                            <button onclick="startGrammarExercise('to-be')" class="btn btn-success">
                                Start
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Listening -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-headphones text-warning"></i> Listening
                    </h3>
                    <div class="listening-exercises">
                        <div id="audioPlayer" class="text-center mb-4">
                            <button onclick="playAudio()" class="btn btn-warning btn-lg mb-3">
                                <i class="fas fa-play"></i> Play Audio
                            </button>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                        <div id="questionSection" class="mt-3">
                            <p class="question">Question will appear here...</p>
                            <div class="answers">
                                <button class="btn btn-outline-warning mb-2 w-100">Answer 1</button>
                                <button class="btn btn-outline-warning mb-2 w-100">Answer 2</button>
                                <button class="btn btn-outline-warning mb-2 w-100">Answer 3</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Speaking -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-microphone text-danger"></i> Speaking
                    </h3>
                    <div class="speaking-exercises text-center">
                        <div class="word-to-pronounce mb-4">
                            <h4 id="wordDisplay" class="display-6 mb-3">Hello!</h4>
                            <button onclick="playWord()" class="btn btn-outline-danger mb-2">
                                <i class="fas fa-volume-up"></i> Listen
                            </button>
                        </div>
                        <div class="record-section">
                            <button onclick="startRecording()" class="btn btn-danger btn-lg mb-3">
                                <i class="fas fa-microphone"></i> Record
                            </button>
                            <div id="recordingStatus" class="text-muted">
                                Click to start recording your pronunciation
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.category-item {
    padding: 15px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.category-item:hover {
    border-color: #3498db;
    background-color: #f8f9fa;
    transform: translateY(-2px);
}

.exercise-item {
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
    margin-bottom: 15px;
}

.exercise-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.progress {
    height: 5px;
    margin-top: 10px;
}

.word-to-pronounce {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.level-selector .btn-group .btn {
    flex: 1;
    padding: 10px 20px;
}

.btn-outline-primary.active {
    background-color: #3498db;
    color: white;
}
</style>

<script>
let currentLevel = 'beginner';

function changeLevel(level) {
    currentLevel = level;
    document.querySelectorAll('.level-selector .btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`button[onclick="changeLevel('${level}')"]`).classList.add('active');
    updateExercises();
}

function updateExercises() {
    const exercises = {
        beginner: {
            vocabulary: ['colors', 'numbers'],
            grammar: ['to-be'],
            listening: 'level1',
            speaking: 'basic'
        },
        elementary: {
            vocabulary: ['animals', 'food'],
            grammar: ['present-simple', 'to-be'],
            listening: 'level2',
            speaking: 'intermediate'
        },
        intermediate: {
            vocabulary: ['all'],
            grammar: ['all'],
            listening: 'level3',
            speaking: 'advanced'
        }
    };
    
    // Mettre à jour l'interface selon le niveau
    updateInterface(exercises[currentLevel]);
}

function startVocabularyLesson(category) {
    const vocabulary = {
        colors: [
            { word: 'red', translation: 'rouge' },
            { word: 'blue', translation: 'bleu' },
            { word: 'green', translation: 'vert' }
        ],
        animals: [
            { word: 'cat', translation: 'chat' },
            { word: 'dog', translation: 'chien' },
            { word: 'bird', translation: 'oiseau' }
        ],
        // Autres catégories...
    };
    
    alert("Vocabulary lesson starting soon!");
}

function startGrammarExercise(type) {
    const exercises = {
        'present-simple': [
            { sentence: "He _ to school every day", answer: "goes" },
            { sentence: "They _ football on weekends", answer: "play" }
        ],
        'to-be': [
            { sentence: "I _ a student", answer: "am" },
            { sentence: "She _ happy", answer: "is" }
        ]
    };
    
    alert("Grammar exercise starting soon!");
}

function playAudio() {
    alert("Audio feature coming soon!");
}

function playWord() {
    alert("Word pronunciation coming soon!");
}

function startRecording() {
    alert("Recording feature coming soon!");
}

// Initialiser le niveau débutant par défaut
window.onload = function() {
    changeLevel('beginner');
};
</script>

<?php include $root_path . 'templates/footer.php'; ?> 