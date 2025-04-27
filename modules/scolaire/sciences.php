<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">Sciences</h1>
        <p class="lead">Découvre le monde fascinant des sciences !</p>
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
        <!-- Le Vivant -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-leaf text-success"></i> Le Vivant
                    </h3>
                    <div class="biology-topics">
                        <div class="topic-item mb-3" onclick="startLesson('corps-humain')">
                            <i class="fas fa-user"></i> Le Corps Humain
                            <span class="badge bg-success">6 leçons</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('animaux')">
                            <i class="fas fa-paw"></i> Les Animaux
                            <span class="badge bg-success">8 leçons</span>
                        </div>
                        <div class="topic-item" onclick="startLesson('plantes')">
                            <i class="fas fa-seedling"></i> Les Plantes
                            <span class="badge bg-success">5 leçons</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Matière et Énergie -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-atom text-primary"></i> Matière et Énergie
                    </h3>
                    <div class="physics-topics">
                        <div class="topic-item mb-3" onclick="startLesson('etats-matiere')">
                            <i class="fas fa-tint"></i> États de la Matière
                            <span class="badge bg-primary">4 leçons</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('electricite')">
                            <i class="fas fa-bolt"></i> Électricité
                            <span class="badge bg-primary">3 leçons</span>
                        </div>
                        <div class="topic-item" onclick="startLesson('forces')">
                            <i class="fas fa-magnet"></i> Forces et Mouvements
                            <span class="badge bg-primary">5 leçons</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Environnement -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-globe-americas text-info"></i> Environnement
                    </h3>
                    <div class="environment-topics">
                        <div class="topic-item mb-3" onclick="startLesson('ecosystemes')">
                            <i class="fas fa-tree"></i> Écosystèmes
                            <span class="badge bg-info">4 leçons</span>
                        </div>
                        <div class="topic-item mb-3" onclick="startLesson('climat')">
                            <i class="fas fa-cloud-sun"></i> Climat
                            <span class="badge bg-info">3 leçons</span>
                        </div>
                        <div class="topic-item" onclick="startLesson('recyclage')">
                            <i class="fas fa-recycle"></i> Recyclage
                            <span class="badge bg-info">3 leçons</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expériences -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        <i class="fas fa-flask text-warning"></i> Expériences
                    </h3>
                    <div class="experiments text-center">
                        <div class="experiment-preview mb-4">
                            <h4 id="experimentTitle" class="display-6 mb-3">Crée un Arc-en-ciel !</h4>
                            <div class="experiment-image mb-3">
                                <i class="fas fa-vial fa-3x text-warning"></i>
                            </div>
                            <button onclick="startExperiment()" class="btn btn-warning">
                                Commencer l'expérience
                            </button>
                        </div>
                        <div class="difficulty-rating">
                            <p class="mb-2">Niveau de difficulté :</p>
                            <div class="stars">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-warning"></i>
                                <i class="far fa-star text-warning"></i>
                                <i class="far fa-star text-warning"></i>
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

.experiment-preview {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.experiment-image {
    margin: 20px 0;
    padding: 30px;
    background: linear-gradient(135deg, #fff6e6, #ffe5cc);
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
</style>

<script>
let currentLevel = 'cp';

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
            biology: ['corps-humain-basic', 'animaux-basic'],
            physics: ['etats-matiere-basic'],
            environment: ['recyclage-basic'],
            experiments: ['facile']
        },
        ce1: {
            biology: ['corps-humain', 'animaux', 'plantes'],
            physics: ['etats-matiere', 'forces-basic'],
            environment: ['recyclage', 'ecosystemes'],
            experiments: ['moyen']
        },
        // Autres niveaux...
    };
    
    updateInterface(content[currentLevel]);
}

function startLesson(topic) {
    const lessons = {
        'corps-humain': [
            { title: "Les 5 sens", content: "Vue, ouïe, odorat, goût, toucher" },
            { title: "Le squelette", content: "Les os et les muscles" }
        ],
        'animaux': [
            { title: "Les mammifères", content: "Caractéristiques des mammifères" },
            { title: "Les oiseaux", content: "Comment volent les oiseaux" }
        ],
        // Autres leçons...
    };
    
    alert("La leçon va commencer !");
}

function startExperiment() {
    const experiments = {
        'arc-en-ciel': {
            materials: ["Verre d'eau", "Papier blanc", "Lumière du soleil"],
            steps: [
                "Remplis le verre d'eau",
                "Place le papier blanc derrière",
                "Observe l'arc-en-ciel !"
            ]
        }
    };
    
    alert("Préparons le matériel pour l'expérience !");
}

// Initialiser le niveau CP par défaut
window.onload = function() {
    changeLevel('cp');
};
</script>

<?php include $root_path . 'templates/footer.php'; ?> 