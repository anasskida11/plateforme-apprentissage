<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container mt-4">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 rainbow-text">Les Histoires</h1>
        <p class="lead">Découvre des contes magiques !</p>
    </div>

    <div class="alert alert-info text-center mb-4" role="alert">
        <i class="fas fa-info-circle"></i> 
        Les histoires audio seront bientôt disponibles ! En attendant, vous pouvez lire les histoires et voir les images.
    </div>

    <!-- Navigation des catégories -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <button class="btn btn-lg btn-primary m-2" onclick="filterStories('all')">Toutes les histoires</button>
            <button class="btn btn-lg btn-success m-2" onclick="filterStories('classic')">Contes classiques</button>
            <button class="btn btn-lg btn-warning m-2" onclick="filterStories('animals')">Histoires d'animaux</button>
        </div>
    </div>

    <div class="row g-4">
        <!-- Jacques et le Haricot Magique -->
        <div class="col-md-6 mb-4" data-category="classic">
            <div class="story-card">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?= $root_path ?>assets/images/stories/jack-bean.jpg" 
                                 alt="Jacques et le Haricot Magique" 
                                 class="story-thumbnail me-3">
                            <h3 class="card-title">Jacques et le Haricot Magique</h3>
                        </div>
                        <p class="story-preview">
                            Il était une fois un jeune garçon nommé Jacques qui vivait avec sa mère...
                        </p>
                        <div class="story-controls">
                            <button class="btn btn-primary" onclick="playStory('jack-bean')">
                                <i class="fas fa-play"></i> Écouter
                            </button>
                            <button class="btn btn-success" onclick="showStoryImages('jack-bean')">
                                <i class="fas fa-images"></i> Voir les images
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Les Trois Petits Cochons -->
        <div class="col-md-6 mb-4" data-category="classic">
            <div class="story-card">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?= $root_path ?>assets/images/stories/three-pigs.jpg" 
                                 alt="Les Trois Petits Cochons" 
                                 class="story-thumbnail me-3">
                            <h3 class="card-title">Les Trois Petits Cochons</h3>
                        </div>
                        <p class="story-preview">
                            Il était une fois trois petits cochons qui quittèrent leur maman...
                        </p>
                        <div class="story-controls">
                            <button class="btn btn-primary" onclick="playStory('three-pigs')">
                                <i class="fas fa-play"></i> Écouter
                            </button>
                            <button class="btn btn-success" onclick="showStoryImages('three-pigs')">
                                <i class="fas fa-images"></i> Voir les images
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Le Petit Chat Curieux -->
        <div class="col-md-6 mb-4" data-category="animals">
            <div class="story-card">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?= $root_path ?>assets/images/stories/curious-cat.jpg" 
                                 alt="Le Petit Chat Curieux" 
                                 class="story-thumbnail me-3">
                            <h3 class="card-title">Le Petit Chat Curieux</h3>
                        </div>
                        <p class="story-preview">
                            Dans une petite maison vivait un chaton très curieux...
                        </p>
                        <div class="story-controls">
                            <button class="btn btn-primary" onclick="playStory('curious-cat')">
                                <i class="fas fa-play"></i> Écouter
                            </button>
                            <button class="btn btn-success" onclick="showStoryImages('curious-cat')">
                                <i class="fas fa-images"></i> Voir les images
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour les images -->
    <div class="modal fade" id="storyModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="storyModalTitle">Histoire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="storyCarousel" class="carousel slide">
                        <div class="carousel-inner" id="carouselInner">
                            <!-- Les images seront insérées ici par JavaScript -->
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#storyCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#storyCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
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

.story-card {
    transition: transform 0.3s ease;
}

.story-card:hover {
    transform: translateY(-5px);
}

.card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.story-thumbnail {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
}

.story-preview {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 1.5rem;
}

.story-controls {
    display: flex;
    gap: 10px;
}

.modal-content {
    border-radius: 15px;
}

.carousel-item img {
    max-height: 500px;
    object-fit: contain;
}

.btn {
    border-radius: 25px;
    padding: 8px 20px;
}

.card-title {
    font-family: 'Comic Sans MS', cursive;
    color: #2c3e50;
    margin: 0;
}
</style>

<script>
let currentAudio = null;
let currentSpeech = null;
const modal = new bootstrap.Modal(document.getElementById('storyModal'));

const stories = {
    'jack-bean': {
        title: 'Jacques et le Haricot Magique',
        text: `Il était une fois un jeune garçon nommé Jacques qui vivait avec sa mère. 
        Ils étaient très pauvres et n'avaient qu'une vache. Un jour, sa mère lui demanda d'aller vendre la vache au marché. 
        Sur le chemin, Jacques rencontra un vieil homme qui lui proposa d'échanger la vache contre des haricots magiques. 
        Jacques accepta l'échange, mais sa mère fut très en colère et jeta les haricots par la fenêtre.
        Le lendemain matin, une immense tige de haricot avait poussé jusqu'au ciel.
        Jacques grimpa tout en haut et découvrit le château d'un géant...`,
        images: ['scene1.jpg', 'scene2.jpg', 'scene3.jpg']
    },
    'three-pigs': {
        title: 'Les Trois Petits Cochons',
        text: `Il était une fois trois petits cochons qui quittèrent leur maman pour découvrir le monde.
        Le premier petit cochon construisit sa maison en paille, très rapidement.
        Le deuxième petit cochon bâtit sa maison en bois, un peu plus solide.
        Le troisième petit cochon, le plus sage, prit son temps pour construire une maison en briques.
        Un jour, le grand méchant loup arriva...`,
        images: ['house1.jpg', 'house2.jpg', 'house3.jpg']
    },
    'curious-cat': {
        title: 'Le Petit Chat Curieux',
        text: `Dans une petite maison vivait un chaton très curieux.
        Il adorait explorer tous les recoins de la maison et du jardin.
        Un jour, il découvrit une mystérieuse boîte dans le grenier.
        En l'ouvrant, il fit une découverte extraordinaire...`,
        images: ['cat1.jpg', 'cat2.jpg', 'cat3.jpg']
    }
};

function playStory(storyId) {
    if (currentSpeech) {
        window.speechSynthesis.cancel();
    }
    if (currentAudio) {
        currentAudio.pause();
    }

    const story = stories[storyId];
    const utterance = new SpeechSynthesisUtterance(story.text);
    utterance.lang = 'fr-FR';
    utterance.rate = 0.9; // Vitesse légèrement plus lente pour les enfants
    utterance.pitch = 1.1; // Voix légèrement plus aigüe

    // Ajouter des effets sonores
    utterance.onboundary = function(event) {
        if (event.name === 'word') {
            const word = event.target.text.substr(event.charIndex, event.charLength).toLowerCase();
            if (word.includes('géant')) {
                playEffect('giant');
            } else if (word.includes('magique')) {
                playEffect('magic');
            }
        }
    };

    window.speechSynthesis.speak(utterance);
    currentSpeech = utterance;
}

function playEffect(effectName) {
    const audio = new Audio();
    switch(effectName) {
        case 'giant':
            audio.src = 'data:audio/mp3;base64,SUQzBAAAAAAAI1RTU0UAAAAPAAADTGF2ZjU4Ljc2LjEwMAAAAAAAAAAAAAAA//OEAAAAAAAAAAAAAAAAAAAAAAAASW5mbwAAAA8AAAASAAAeMwAUFBQUFCIiIiIiIjAwMDAwPz8/Pz8/TU1NTU1NW1tbW1tbaGhoaGhoaHd3d3d3d4aGhoaGhpSUlJSUlKMjIyMjIyMwMDAwMDA/Pz8/Pz9NTU1NTU1bW1tbW1toaGhoaGh3d3d3d3eGhoaGhoaUlJSUlJSj//MUZAAAAAGkAAAAAAAAA0gAAAAATEFN//MUZAMAAAGkAAAAAAAAA0gAAAAATEFN//MUZAYAAAGkAAAAAAAAA0gAAAAATEFN//MUZAkAAAGkAAAAAAAAA0gAAAAATEFN//MUZAwAAAGkAAAAAAAAA0gAAAAATEFN//MUZBEAAAGkAAAAAAAAA0gAAAAATEFN//MUZBQAAAGkAAAAAAAAA0gAAAAATEFN//MUZBcAAAGkAAAAAAAAA0gAAAAATEFN//MUZBoAAAGkAAAAAAAAA0gAAAAATEFN//MUZB0AAAGkAAAAAAAAA0gAAAAATEFN//MUZCAAAAGkAAAAAAAAA0gAAAAATEFN//MUZCMAAAGkAAAAAAAAA0gAAAAATEFN//MUZCYAAAGkAAAAAAAAA0gAAAAATEFN//MUZCkAAAGkAAAAAAAAA0gAAAAATEFN//MUZCwAAAGkAAAAAAAAA0gAAAAATEFN';
            break;
        case 'magic':
            audio.src = 'data:audio/mp3;base64,SUQzBAAAAAAAI1RTU0UAAAAPAAADTGF2ZjU4Ljc2LjEwMAAAAAAAAAAAAAAA//OEAAAAAAAAAAAAAAAAAAAAAAAASW5mbwAAAA8AAAASAAAeMwAUFBQUFCIiIiIiIjAwMDAwPz8/Pz8/TU1NTU1NW1tbW1tbaGhoaGhoaHd3d3d3d4aGhoaGhpSUlJSUlKMjIyMjIyMwMDAwMDA/Pz8/Pz9NTU1NTU1bW1tbW1toaGhoaGh3d3d3d3eGhoaGhoaUlJSUlJSj//MUZAAAAAGkAAAAAAAAA0gAAAAATEFN//MUZAMAAAGkAAAAAAAAA0gAAAAATEFN//MUZAYAAAGkAAAAAAAAA0gAAAAATEFN//MUZAkAAAGkAAAAAAAAA0gAAAAATEFN//MUZAwAAAGkAAAAAAAAA0gAAAAATEFN//MUZBEAAAGkAAAAAAAAA0gAAAAATEFN//MUZBQAAAGkAAAAAAAAA0gAAAAATEFN//MUZBcAAAGkAAAAAAAAA0gAAAAATEFN//MUZBoAAAGkAAAAAAAAA0gAAAAATEFN//MUZB0AAAGkAAAAAAAAA0gAAAAATEFN//MUZCAAAAGkAAAAAAAAA0gAAAAATEFN//MUZCMAAAGkAAAAAAAAA0gAAAAATEFN//MUZCYAAAGkAAAAAAAAA0gAAAAATEFN//MUZCkAAAGkAAAAAAAAA0gAAAAATEFN//MUZCwAAAGkAAAAAAAAA0gAAAAATEFN';
            break;
    }
    audio.play();
}

function showStoryImages(storyId) {
    const story = stories[storyId];
    document.getElementById('storyModalTitle').textContent = story.title;

    const carouselInner = document.getElementById('carouselInner');
    carouselInner.innerHTML = story.images.map((image, index) => `
        <div class="carousel-item ${index === 0 ? 'active' : ''}">
            <img src="<?= $root_path ?>assets/images/stories/${storyId}/${image}" 
                 class="d-block w-100" 
                 alt="Scene ${index + 1}">
        </div>
    `).join('');

    modal.show();
}

// Arrêter la narration quand on ferme la page
window.addEventListener('beforeunload', () => {
    if (currentSpeech) {
        window.speechSynthesis.cancel();
    }
    if (currentAudio) {
        currentAudio.pause();
    }
});

function filterStories(category) {
    const storyCards = document.querySelectorAll('.story-card');
    storyCards.forEach(story => {
        const parent = story.parentElement;
        if (category === 'all' || parent.dataset.category === category) {
            parent.style.display = 'block';
        } else {
            parent.style.display = 'none';
        }
    });
}
</script>

<?php include $root_path . 'templates/footer.php'; ?> 