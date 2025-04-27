<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">Arts Plastiques</h1>
        <p class="lead">Exprime ta créativité et découvre l'art !</p>
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
        <!-- Techniques de Dessin -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-pencil-alt text-primary"></i> Techniques de Dessin
                    </h3>
                    <div class="drawing-topics">
                        <div class="topic-item mb-3" onclick="startLesson('bases-dessin')">
                            <i class="fas fa-square"></i> Les Bases du Dessin
                            <span class="badge bg-primary">5 leçons</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('personnages')">
                            <i class="fas fa-user-astronaut"></i> Dessiner des Personnages
                            <span class="badge bg-primary">6 leçons</span>
                        </div>
                        <div class="topic-item" onclick="startLesson('perspectives')">
                            <i class="fas fa-cube"></i> La Perspective
                            <span class="badge bg-primary">4 leçons</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peinture et Couleurs -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-palette text-success"></i> Peinture et Couleurs
                    </h3>
                    <div class="painting-topics">
                        <div class="topic-item mb-3" onclick="startLesson('couleurs')">
                            <i class="fas fa-paint-brush"></i> Théorie des Couleurs
                            <span class="badge bg-success">4 leçons</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('techniques')">
                            <i class="fas fa-fill-drip"></i> Techniques de Peinture
                            <span class="badge bg-success">5 leçons</span>
                        </div>
                        <div class="topic-item" onclick="startLesson('styles')">
                            <i class="fas fa-paint-roller"></i> Styles Artistiques
                            <span class="badge bg-success">6 leçons</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Histoire de l'Art -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-landmark text-warning"></i> Histoire de l'Art
                    </h3>
                    <div class="art-history">
                        <div class="artwork-carousel text-center">
                            <div class="artwork-preview mb-4">
                                <div class="artwork-image mb-3">
                                    <i class="fas fa-image fa-3x text-warning"></i>
                                </div>
                                <h4 id="artworkTitle" class="mb-2">La Joconde</h4>
                                <p id="artistName" class="text-muted">Léonard de Vinci</p>
                                <button onclick="learnAboutArtwork()" class="btn btn-warning">
                                    Découvrir l'œuvre
                                </button>
                            </div>
                            <div class="navigation-buttons">
                                <button onclick="previousArtwork()" class="btn btn-outline-warning me-2">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button onclick="nextArtwork()" class="btn btn-outline-warning">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Atelier Créatif -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-paint-brush text-danger"></i> Atelier Créatif
                    </h3>
                    <div class="creative-workshop text-center">
                        <div class="project-preview mb-4">
                            <h4 class="display-6 mb-3">Projet du Jour</h4>
                            <div class="project-image mb-3">
                                <i class="fas fa-star fa-3x text-danger"></i>
                            </div>
                            <p class="mb-3">Crée ton propre chef-d'œuvre !</p>
                            <button onclick="startProject()" class="btn btn-danger">
                                Commencer
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

.artwork-preview {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.artwork-image {
    margin: 20px 0;
    padding: 30px;
    background: linear-gradient(135deg, #fff6e6, #ffe5cc);
    border-radius: 50%;
    display: inline-block;
}

.project-image {
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
</style>

<script>
let currentLevel = 'cp';
let currentArtworkIndex = 0;

const artworks = [
    { title: "La Joconde", artist: "Léonard de Vinci", period: "Renaissance" },
    { title: "La Nuit étoilée", artist: "Vincent van Gogh", period: "Post-impressionnisme" },
    { title: "Les Nymphéas", artist: "Claude Monet", period: "Impressionnisme" }
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
            drawing: ['bases-simple'],
            painting: ['couleurs-basic'],
            history: ['simple'],
            workshop: ['facile']
        },
        ce1: {
            drawing: ['bases-dessin', 'personnages-simple'],
            painting: ['couleurs', 'techniques-basic'],
            history: ['moyen'],
            workshop: ['moyen']
        },
        // Autres niveaux...
    };
    
    updateInterface(content[currentLevel]);
}

function startLesson(topic) {
    const lessons = {
        'bases-dessin': [
            { title: "Les formes de base", content: "Cercles, carrés, triangles" },
            { title: "Les lignes", content: "Droites, courbes, hachures" }
        ],
        'couleurs': [
            { title: "Les couleurs primaires", content: "Rouge, bleu, jaune" },
            { title: "Le cercle chromatique", content: "Mélanges et harmonies" }
        ],
        // Autres leçons...
    };
    
    alert("La leçon va commencer !");
}

function learnAboutArtwork() {
    const artwork = artworks[currentArtworkIndex];
    alert(`Découvrons ${artwork.title} de ${artwork.artist}`);
}

function previousArtwork() {
    currentArtworkIndex = (currentArtworkIndex - 1 + artworks.length) % artworks.length;
    updateArtworkDisplay();
}

function nextArtwork() {
    currentArtworkIndex = (currentArtworkIndex + 1) % artworks.length;
    updateArtworkDisplay();
}

function updateArtworkDisplay() {
    const artwork = artworks[currentArtworkIndex];
    document.getElementById('artworkTitle').textContent = artwork.title;
    document.getElementById('artistName').textContent = artwork.artist;
}

function startProject() {
    const projects = {
        'autoportrait': {
            materials: ["Papier", "Crayons", "Miroir"],
            steps: [
                "Observe ton visage dans le miroir",
                "Dessine les formes principales",
                "Ajoute les détails"
            ]
        }
    };
    
    alert("Préparons le matériel pour ton projet !");
}

// Initialiser le niveau CP par défaut
window.onload = function() {
    changeLevel('cp');
    updateArtworkDisplay();
};
</script>

<?php include $root_path . 'templates/footer.php'; ?> 