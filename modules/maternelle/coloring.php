<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container mt-4">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 rainbow-text">Coloriage</h1>
        <p class="lead">Colorie de jolis dessins !</p>
    </div>

    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="btn-group" role="group" aria-label="Outils de dessin">
                <button class="btn btn-lg btn-primary tool-btn active" data-tool="brush">
                    <i class="fas fa-paint-brush"></i> Pinceau
                </button>
                <button class="btn btn-lg btn-secondary tool-btn" data-tool="eraser">
                    <i class="fas fa-eraser"></i> Gomme
                </button>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="color-palette">
                <button class="color-btn" style="background-color: #FF0000;" data-color="#FF0000"></button>
                <button class="color-btn" style="background-color: #00FF00;" data-color="#00FF00"></button>
                <button class="color-btn" style="background-color: #0000FF;" data-color="#0000FF"></button>
                <button class="color-btn" style="background-color: #FFFF00;" data-color="#FFFF00"></button>
                <button class="color-btn" style="background-color: #FF00FF;" data-color="#FF00FF"></button>
                <button class="color-btn" style="background-color: #00FFFF;" data-color="#00FFFF"></button>
                <button class="color-btn" style="background-color: #FFA500;" data-color="#FFA500"></button>
                <button class="color-btn" style="background-color: #800080;" data-color="#800080"></button>
                <button class="color-btn active" style="background-color: #FF0000;" data-color="#FF0000"></button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="drawing-container">
                <canvas id="coloringCanvas"></canvas>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-success btn-lg" onclick="saveDrawing()">
                    <i class="fas fa-save"></i> Sauvegarder
                </button>
                <button class="btn btn-danger btn-lg" onclick="clearCanvas()">
                    <i class="fas fa-trash"></i> Effacer tout
                </button>
                <button class="btn btn-primary btn-lg" onclick="newDrawing()">
                    <i class="fas fa-image"></i> Nouveau dessin
                </button>
            </div>
        </div>
    </div>
</div>

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

.drawing-container {
    width: 100%;
    height: 500px;
    border: 2px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    background-color: white;
}

#coloringCanvas {
    width: 100%;
    height: 100%;
    cursor: crosshair;
}

.color-palette {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
}

.color-btn {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.color-btn:hover {
    transform: scale(1.1);
}

.color-btn.active {
    border: 3px solid #333;
    transform: scale(1.1);
}

.tool-btn {
    padding: 10px 20px;
    margin: 0 5px;
    border-radius: 50px;
}

.tool-btn.active {
    background-color: #007bff;
    color: white;
}

.tool-btn:not(.active) {
    background-color: #f8f9fa;
    color: #333;
}
</style>

<script>
const canvas = document.getElementById('coloringCanvas');
const ctx = canvas.getContext('2d');
let currentColor = '#FF0000';
let currentTool = 'brush';
let isDrawing = false;
let lastX = 0;
let lastY = 0;

// Dessins prédéfinis simples
const drawings = [
    {
        name: 'Maison',
        path: [
            {type: 'beginPath'},
            {type: 'moveTo', x: 100, y: 300},
            {type: 'lineTo', x: 300, y: 300},
            {type: 'lineTo', x: 300, y: 200},
            {type: 'lineTo', x: 200, y: 100},
            {type: 'lineTo', x: 100, y: 200},
            {type: 'closePath'},
            {type: 'moveTo', x: 180, y: 250},
            {type: 'rect', x: 180, y: 250, w: 40, h: 50},
            {type: 'moveTo', x: 150, y: 220},
            {type: 'rect', x: 150, y: 220, w: 30, h: 30}
        ]
    },
    {
        name: 'Fleur',
        path: [
            {type: 'beginPath'},
            {type: 'arc', x: 200, y: 200, r: 30, start: 0, end: Math.PI * 2},
            {type: 'moveTo', x: 200, y: 230},
            {type: 'lineTo', x: 200, y: 300},
            {type: 'moveTo', x: 170, y: 170},
            {type: 'arc', x: 170, y: 170, r: 20, start: 0, end: Math.PI * 2},
            {type: 'moveTo', x: 230, y: 170},
            {type: 'arc', x: 230, y: 170, r: 20, start: 0, end: Math.PI * 2},
            {type: 'moveTo', x: 170, y: 230},
            {type: 'arc', x: 170, y: 230, r: 20, start: 0, end: Math.PI * 2},
            {type: 'moveTo', x: 230, y: 230},
            {type: 'arc', x: 230, y: 230, r: 20, start: 0, end: Math.PI * 2}
        ]
    },
    {
        name: 'Soleil',
        path: [
            {type: 'beginPath'},
            {type: 'arc', x: 200, y: 200, r: 50, start: 0, end: Math.PI * 2},
            {type: 'moveTo', x: 200, y: 130},
            {type: 'lineTo', x: 200, y: 100},
            {type: 'moveTo', x: 200, y: 270},
            {type: 'lineTo', x: 200, y: 300},
            {type: 'moveTo', x: 130, y: 200},
            {type: 'lineTo', x: 100, y: 200},
            {type: 'moveTo', x: 270, y: 200},
            {type: 'lineTo', x: 300, y: 200}
        ]
    }
];

// Initialisation
function initCanvas() {
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
}

// Dessiner un dessin prédéfini
function drawTemplate(drawing) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 2;
    
    drawing.path.forEach(cmd => {
        switch(cmd.type) {
            case 'beginPath':
                ctx.beginPath();
                break;
            case 'moveTo':
                ctx.moveTo(cmd.x, cmd.y);
                break;
            case 'lineTo':
                ctx.lineTo(cmd.x, cmd.y);
                break;
            case 'arc':
                ctx.arc(cmd.x, cmd.y, cmd.r, cmd.start, cmd.end);
                break;
            case 'rect':
                ctx.rect(cmd.x, cmd.y, cmd.w, cmd.h);
                break;
            case 'closePath':
                ctx.closePath();
                break;
        }
    });
    
    ctx.stroke();
}

// Gestionnaires d'événements pour le dessin
canvas.addEventListener('mousedown', startDrawing);
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mouseup', stopDrawing);
canvas.addEventListener('mouseout', stopDrawing);

function startDrawing(e) {
    isDrawing = true;
    [lastX, lastY] = [e.offsetX, e.offsetY];
}

function draw(e) {
    if (!isDrawing) return;
    
    ctx.beginPath();
    ctx.moveTo(lastX, lastY);
    ctx.lineTo(e.offsetX, e.offsetY);
    
    if (currentTool === 'brush') {
        ctx.strokeStyle = currentColor;
        ctx.lineWidth = 5;
    } else {
        ctx.strokeStyle = '#FFFFFF';
        ctx.lineWidth = 20;
    }
    
    ctx.stroke();
    [lastX, lastY] = [e.offsetX, e.offsetY];
}

function stopDrawing() {
    isDrawing = false;
}

// Gestion des outils et des couleurs
document.querySelectorAll('.color-btn').forEach(btn => {
    btn.addEventListener('click', e => {
        document.querySelectorAll('.color-btn').forEach(b => b.classList.remove('active'));
        e.target.classList.add('active');
        currentColor = e.target.dataset.color;
    });
});

document.querySelectorAll('.tool-btn').forEach(btn => {
    btn.addEventListener('click', e => {
        document.querySelectorAll('.tool-btn').forEach(b => b.classList.remove('active'));
        e.target.closest('.tool-btn').classList.add('active');
        currentTool = e.target.closest('.tool-btn').dataset.tool;
    });
});

// Fonctions utilitaires
function clearCanvas() {
    if (confirm('Es-tu sûr de vouloir tout effacer ?')) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
}

function saveDrawing() {
    const link = document.createElement('a');
    link.download = 'mon-dessin.png';
    link.href = canvas.toDataURL();
    link.click();
}

function newDrawing() {
    const randomDrawing = drawings[Math.floor(Math.random() * drawings.length)];
    drawTemplate(randomDrawing);
}

// Initialisation au chargement
window.addEventListener('load', () => {
    initCanvas();
    newDrawing();
});

// Redimensionnement du canvas
window.addEventListener('resize', () => {
    initCanvas();
    newDrawing();
});
</script>

<?php include $root_path . 'templates/footer.php'; ?> 