<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 mb-4">Formes et Couleurs</h1>
        <p class="lead">Apprends à reconnaître les formes et les couleurs en t'amusant !</p>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="text-center mb-4">Les Formes</h2>
                    <div class="shapes-container text-center">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="shape-item" onclick="showShapeInfo('circle')">
                                    <div class="shape circle"></div>
                                    <p class="mt-2">Cercle</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="shape-item" onclick="showShapeInfo('square')">
                                    <div class="shape square"></div>
                                    <p class="mt-2">Carré</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="shape-item" onclick="showShapeInfo('triangle')">
                                    <div class="shape triangle"></div>
                                    <p class="mt-2">Triangle</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="shape-item" onclick="showShapeInfo('rectangle')">
                                    <div class="shape rectangle"></div>
                                    <p class="mt-2">Rectangle</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="text-center mb-4">Les Couleurs</h2>
                    <div class="colors-container text-center">
                        <div class="row g-3">
                            <div class="col-4">
                                <div class="color-item" onclick="showColorInfo('red')" style="background-color: #ff0000;">
                                    <span class="color-name">Rouge</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="color-item" onclick="showColorInfo('blue')" style="background-color: #0000ff;">
                                    <span class="color-name">Bleu</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="color-item" onclick="showColorInfo('yellow')" style="background-color: #ffff00;">
                                    <span class="color-name">Jaune</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="color-item" onclick="showColorInfo('green')" style="background-color: #00ff00;">
                                    <span class="color-name">Vert</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="color-item" onclick="showColorInfo('purple')" style="background-color: #800080;">
                                    <span class="color-name">Violet</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="color-item" onclick="showColorInfo('orange')" style="background-color: #ffa500;">
                                    <span class="color-name">Orange</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Zone d'exercices -->
    <div class="exercises-section mt-5">
        <h2 class="text-center mb-4">Exercices</h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3>Trouve la Forme</h3>
                        <p>Clique sur la forme demandée</p>
                        <button onclick="startShapeExercise()" class="btn btn-primary">
                            <i class="fas fa-play"></i> Commencer
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3>Trouve la Couleur</h3>
                        <p>Clique sur la couleur demandée</p>
                        <button onclick="startColorExercise()" class="btn btn-primary">
                            <i class="fas fa-play"></i> Commencer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.shape {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    border: 3px solid #333;
    transition: transform 0.3s ease;
}

.shape-item:hover .shape {
    transform: scale(1.1);
    cursor: pointer;
}

.circle {
    border-radius: 50%;
}

.square {
    /* Le carré utilise les dimensions par défaut */
}

.triangle {
    width: 0;
    height: 0;
    border: 40px solid transparent;
    border-bottom: 80px solid #333;
    border-top: 0;
    background: none;
}

.rectangle {
    width: 120px;
    height: 60px;
}

.color-item {
    height: 80px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.color-item:hover {
    transform: scale(1.1);
}

.color-name {
    color: white;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    font-weight: bold;
}

.exercises-section .card {
    transition: transform 0.3s ease;
}

.exercises-section .card:hover {
    transform: translateY(-5px);
}
</style>

<script>
function showShapeInfo(shape) {
    const shapes = {
        circle: "Le cercle est rond comme une balle !",
        square: "Le carré a 4 côtés égaux !",
        triangle: "Le triangle a 3 côtés !",
        rectangle: "Le rectangle est comme une porte !"
    };
    alert(shapes[shape]);
}

function showColorInfo(color) {
    const colors = {
        red: "Rouge comme une fraise !",
        blue: "Bleu comme le ciel !",
        yellow: "Jaune comme le soleil !",
        green: "Vert comme l'herbe !",
        purple: "Violet comme le raisin !",
        orange: "Orange comme... une orange !"
    };
    alert(colors[color]);
}

function startShapeExercise() {
    alert("Exercice des formes en cours de développement !");
}

function startColorExercise() {
    alert("Exercice des couleurs en cours de développement !");
}
</script>

<?php include $root_path . 'templates/footer.php'; ?> 