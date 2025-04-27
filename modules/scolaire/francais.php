<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">Français</h1>
        <p class="lead">Améliore ton français avec des exercices interactifs !</p>
    </div>

    <!-- Sélection du niveau -->
    <div class="level-selector mb-5">
        <h2 class="text-center mb-4">Choisis ton niveau</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="btn-group w-100" role="group">
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('cp')">CP</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('ce1')">CE1</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('ce2')">CE2</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('cm1')">CM1</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeLevel('cm2')">CM2</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sections principales -->
    <div class="row mb-4">
        <!-- Grammaire -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-book text-primary"></i> Grammaire
                    </h3>
                    <div class="grammar-exercises">
                        <div class="exercise-item mb-3">
                            <h4>Nature des mots</h4>
                            <p>Identifie les noms, verbes, adjectifs...</p>
                            <button onclick="startGrammarExercise('nature')" class="btn btn-primary">
                                Commencer
                            </button>
                        </div>
                        <div class="exercise-item mb-3">
                            <h4>Accords</h4>
                            <p>Accorde les mots correctement</p>
                            <button onclick="startGrammarExercise('accord')" class="btn btn-primary">
                                Commencer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conjugaison -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-pen text-success"></i> Conjugaison
                    </h3>
                    <div class="conjugation-game">
                        <div class="mb-3">
                            <label class="form-label">Choisis un temps :</label>
                            <select id="tenseSelect" class="form-select">
                                <option value="present">Présent</option>
                                <option value="imparfait">Imparfait</option>
                                <option value="futur">Futur</option>
                                <option value="passe-compose">Passé composé</option>
                            </select>
                        </div>
                        <div id="conjugationExercise" class="text-center">
                            <p id="verbToConjugate" class="h4 mb-3">Verbe à conjuguer</p>
                            <input type="text" id="conjugationAnswer" class="form-control mb-3" placeholder="Ta réponse">
                            <button onclick="checkConjugation()" class="btn btn-success">Vérifier</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Orthographe -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-spell-check text-warning"></i> Orthographe
                    </h3>
                    <div class="spelling-game">
                        <div class="dictation-section mb-3">
                            <h4>Dictée</h4>
                            <button onclick="playDictation()" class="btn btn-warning mb-2">
                                <i class="fas fa-volume-up"></i> Écouter
                            </button>
                            <textarea id="dictationText" class="form-control" rows="4" placeholder="Écris la dictée ici..."></textarea>
                        </div>
                        <div class="homophones-section">
                            <h4>Homophones</h4>
                            <div id="homophoneExercise" class="text-center">
                                <p class="exercise-text mb-3">Choisis le bon homophone :</p>
                                <div class="btn-group">
                                    <button onclick="checkHomophone(1)" class="btn btn-outline-warning">a</button>
                                    <button onclick="checkHomophone(2)" class="btn btn-outline-warning">à</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Compréhension -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-book-reader text-info"></i> Compréhension
                    </h3>
                    <div class="reading-section">
                        <div id="textContainer" class="mb-3">
                            <p class="reading-text">
                                Le texte de lecture apparaîtra ici...
                            </p>
                        </div>
                        <div id="questionContainer" class="mb-3">
                            <p class="question-text">Les questions apparaîtront ici...</p>
                            <div class="answers-list">
                                <!-- Les réponses seront générées ici -->
                            </div>
                        </div>
                        <button onclick="startReadingExercise()" class="btn btn-info">
                            Nouveau texte
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.exercise-item {
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
}

.exercise-item:last-child {
    border-bottom: none;
}

.reading-text {
    font-size: 1.1em;
    line-height: 1.6;
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
}

.question-text {
    font-weight: bold;
    color: #2c3e50;
}

.answers-list {
    margin-top: 10px;
}

.answers-list button {
    margin: 5px;
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
let currentLevel = 'cp';

function changeLevel(level) {
    currentLevel = level;
    document.querySelectorAll('.level-selector .btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`button[onclick="changeLevel('${level}')"]`).classList.add('active');
    updateExercises();
}

function updateExercises() {
    // Adapter les exercices selon le niveau
    const exercises = {
        cp: {
            grammar: ['articles', 'noms'],
            conjugation: ['présent'],
            spelling: ['lettres', 'syllabes'],
            reading: 'niveau1'
        },
        ce1: {
            grammar: ['nature des mots', 'accords simples'],
            conjugation: ['présent', 'futur'],
            spelling: ['mots courants', 'homophones simples'],
            reading: 'niveau2'
        },
        // Ajouter les autres niveaux...
    };
    
    // Mettre à jour l'interface selon le niveau
    updateInterface(exercises[currentLevel]);
}

function startGrammarExercise(type) {
    const exercises = {
        nature: {
            cp: ["Le chat dort.", "La fleur pousse."],
            ce1: ["Le petit chat noir dort.", "Une jolie fleur rouge pousse."],
            // Autres niveaux...
        },
        accord: {
            cp: ["Le chat est noir_", "Les fleur_ sont rouge_"],
            ce1: ["Les petit_ chat_ noir_ dorment", "Les jolie_ fleur_ rouge_ poussent"],
            // Autres niveaux...
        }
    };
    
    alert("Exercice de grammaire en cours de développement !");
}

function checkConjugation() {
    const verbs = {
        present: {
            'être': ['suis', 'es', 'est', 'sommes', 'êtes', 'sont'],
            'avoir': ['ai', 'as', 'a', 'avons', 'avez', 'ont']
        },
        // Autres temps...
    };
    
    alert("Vérification de la conjugaison en cours de développement !");
}

function playDictation() {
    const dictations = {
        cp: ["Le chat dort sur le lit."],
        ce1: ["Le petit chat noir dort sur le grand lit."],
        // Autres niveaux...
    };
    
    alert("Lecture de la dictée en cours de développement !");
}

function checkHomophone(choice) {
    const homophones = {
        cp: [
            { sentence: "Il _ un chat.", correct: 1, options: ['a', 'à'] },
            { sentence: "Il va _ l'école.", correct: 2, options: ['a', 'à'] }
        ],
        // Autres niveaux...
    };
    
    alert("Vérification de l'homophone en cours de développement !");
}

function startReadingExercise() {
    const texts = {
        cp: {
            text: "Le chat et la souris",
            questions: ["Qui dort ?", "Où est le chat ?"]
        },
        ce1: {
            text: "Le chat et la souris jouent",
            questions: ["Que font les animaux ?", "Sont-ils amis ?"]
        },
        // Autres niveaux...
    };
    
    alert("Nouvel exercice de lecture en cours de développement !");
}

// Initialiser le niveau CP par défaut
window.onload = function() {
    changeLevel('cp');
};
</script>

<?php include $root_path . 'templates/footer.php'; ?> 