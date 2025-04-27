<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">Musique</h1>
        <p class="lead">Découvre le monde merveilleux de la musique !</p>
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
        <!-- Théorie Musicale -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-music text-primary"></i> Théorie Musicale
                    </h3>
                    <div class="theory-topics">
                        <div class="topic-item mb-3" onclick="startLesson('notes')">
                            <i class="fas fa-note"></i> Les Notes
                            <span class="badge bg-primary">5 leçons</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('rythme')">
                            <i class="fas fa-drum"></i> Le Rythme
                            <span class="badge bg-primary">4 leçons</span>
                        </div>
                        <div class="topic-item" onclick="startLesson('solfege')">
                            <i class="fas fa-book-open"></i> Le Solfège
                            <span class="badge bg-primary">6 leçons</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instruments -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-guitar text-success"></i> Instruments
                    </h3>
                    <div class="instruments-topics">
                        <div class="topic-item mb-3" onclick="startLesson('piano')">
                            <i class="fas fa-piano"></i> Piano
                            <span class="badge bg-success">5 leçons</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('guitare')">
                            <i class="fas fa-guitar"></i> Guitare
                            <span class="badge bg-success">4 leçons</span>
                        </div>
                        <div class="topic-item" onclick="startLesson('percussion')">
                            <i class="fas fa-drum"></i> Percussions
                            <span class="badge bg-success">3 leçons</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Chant -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-microphone text-warning"></i> Chant
                    </h3>
                    <div class="singing-section">
                        <div class="song-carousel text-center">
                            <div class="song-preview mb-4">
                                <div class="song-image mb-3">
                                    <i class="fas fa-microphone-alt fa-3x text-warning"></i>
                                </div>
                                <h4 id="songTitle" class="mb-2">Au Clair de la Lune</h4>
                                <p id="songDifficulty" class="text-muted">Niveau Facile</p>
                                <div class="song-controls">
                                    <button onclick="playSong()" class="btn btn-warning me-2">
                                        <i class="fas fa-play"></i> Écouter
                                    </button>
                                    <button onclick="startSinging()" class="btn btn-outline-warning">
                                        <i class="fas fa-microphone"></i> Chanter
                                    </button>
                                </div>
                            </div>
                            <div class="navigation-buttons">
                                <button onclick="previousSong()" class="btn btn-outline-warning me-2">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button onclick="nextSong()" class="btn btn-outline-warning">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jeux Musicaux -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-gamepad text-danger"></i> Jeux Musicaux
                    </h3>
                    <div class="games-section text-center">
                        <div class="game-preview mb-4">
                            <h4 class="display-6 mb-3">Reconnaissance de Notes</h4>
                            <div class="game-image mb-3">
                                <i class="fas fa-music fa-3x text-danger"></i>
                            </div>
                            <p class="mb-3">Devine les notes jouées !</p>
                            <button onclick="startGame()" class="btn btn-danger">
                                Jouer
                            </button>
                        </div>
                        <div class="difficulty-rating">
                            <p class="mb-2">Niveau de difficulté :</p>
                            <div class="stars">
                                <i class="fas fa-star text-danger"></i>
                                <i class="fas fa-star text-danger"></i>
                                <i class="far fa-star text-danger"></i>
                                <i class="far fa-star text-danger"></i>
                                <i class="far fa-star text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.topic-item {
    padding: 15px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.topic-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.topic-item:hover i {
    transform: scale(1.2);
}

.topic-item i {
    transition: transform 0.3s ease;
    margin-right: 10px;
}

.song-preview {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.song-image {
    margin: 20px 0;
    padding: 30px;
    background: linear-gradient(135deg, #fff6e6, #ffe5cc);
    border-radius: 50%;
    display: inline-block;
}

.game-image {
    margin: 20px 0;
    padding: 30px;
    background: linear-gradient(135deg, #ffe6e6, #ffcccc);
    border-radius: 50%;
    display: inline-block;
}

.stars {
    font-size: 1.2em;
}

.level-selector .btn-group .btn {
    flex: 1;
    padding: 10px 20px;
}

.btn-outline-primary.active {
    background-color: #3498db;
    color: white;
}

.navigation-buttons {
    margin-top: 15px;
}

.navigation-buttons .btn {
    width: 40px;
    height: 40px;
    padding: 0;
    line-height: 40px;
    border-radius: 50%;
}

.song-controls {
    margin-top: 15px;
}
</style>

<script>
let currentLevel = 'cp';
let currentSongIndex = 0;

const songs = [
    { title: "Frère Jacques", difficulty: "Facile", audio: "frere-jacques.mp3", lyrics: "Frère Jacques, Frère Jacques, Dormez-vous? Dormez-vous?" },
    { title: "Un, Deux, Trois", difficulty: "Facile", audio: "un-deux-trois.mp3", lyrics: "Un, deux, trois, nous irons au bois..." },
    { title: "Une Souris Verte", difficulty: "Moyen", audio: "une-souris-verte.mp3", lyrics: "Une souris verte, qui courait dans l'herbe..." }
];

function changeLevel(level) {
    currentLevel = level;
    document.querySelectorAll('.level-selector .btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`button[onclick="changeLevel('${level}')"]`).classList.add('active');
    updateContent();
}

function updateContent() {
    const content = {
        cp: {
            theory: ['notes-basic'],
            instruments: ['decouverte'],
            singing: ['comptines'],
            games: ['facile']
        },
        ce1: {
            theory: ['notes', 'rythme-basic'],
            instruments: ['piano-basic', 'percussion'],
            singing: ['chansons-simples'],
            games: ['moyen']
        },
        // Autres niveaux...
    };
    
    updateInterface(content[currentLevel]);
}

function startLesson(topic) {
    const lessons = {
        'notes': [
            { title: "Les notes de musique", content: "Do, Ré, Mi, Fa, Sol, La, Si" },
            { title: "La portée", content: "Les lignes et les espaces" }
        ],
        'rythme': [
            { title: "Les temps", content: "Compter la mesure" },
            { title: "Les rythmes simples", content: "Noire, croche, blanche" }
        ],
        // Autres leçons...
    };
    
    alert("La leçon va commencer !");
}

function playSong() {
    const song = songs[currentSongIndex];
    const audio = new Audio('/assets/audio/songs/' + song.audio);
    audio.play();
}

function startSinging() {
    const song = songs[currentSongIndex];
    const audio = new Audio('/assets/audio/songs/' + song.audio);
    audio.play();
}

function previousSong() {
    currentSongIndex = (currentSongIndex - 1 + songs.length) % songs.length;
    updateSongDisplay();
}

function nextSong() {
    currentSongIndex = (currentSongIndex + 1) % songs.length;
    updateSongDisplay();
}

function updateSongDisplay() {
    const song = songs[currentSongIndex];
    document.getElementById('songTitle').textContent = song.title;
    document.getElementById('songDifficulty').textContent = `Niveau ${song.difficulty}`;
}

function startGame() {
    const games = {
        'notes': {
            levels: ["Do-Mi", "Do-Sol", "Do-Do"],
            modes: ["Écoute", "Vue", "Mixte"]
        }
    };
    
    alert("Le jeu va commencer !");
}

// Initialiser le niveau CP par défaut
window.onload = function() {
    changeLevel('cp');
    updateSongDisplay();
};
</script>

<?php include $root_path . 'templates/footer.php'; ?> 