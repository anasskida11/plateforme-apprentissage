<?php
$root_path = '../../';
include $root_path . 'templates/header.php';
?>

<div class="container mt-4">
    <div class="welcome-section text-center mb-5">
        <h1 class="display-4 rainbow-text">Comptines et Chansons</h1>
        <p class="lead">Chante et danse avec tes amis !</p>
    </div>

    <div class="row g-4">
        <!-- Catégories de chansons -->
        <div class="col-12 mb-4">
            <div class="category-buttons text-center">
                <button class="btn btn-lg btn-primary m-2" onclick="filterSongs('all')">Toutes les chansons</button>
                <button class="btn btn-lg btn-success m-2" onclick="filterSongs('animals')">Les animaux</button>
                <button class="btn btn-lg btn-warning m-2" onclick="filterSongs('numbers')">Les chiffres</button>
                <button class="btn btn-lg btn-info m-2" onclick="filterSongs('nature')">La nature</button>
            </div>
        </div>

        <!-- Liste des chansons -->
        <div class="col-md-8">
            <div class="songs-container">
                <!-- Un, deux, trois -->
                <div class="song-card mb-4" data-category="numbers">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title">
                                    <i class="fas fa-123 text-warning"></i> Un, deux, trois
                                </h3>
                                <audio id="audio-un-deux-trois" class="d-none">
                                    <source src="/projet/assets/audio/songs/un deux trois.mp3" type="audio/mpeg">
                                </audio>
                                <button class="btn btn-primary btn-play" onclick="playSong('un-deux-trois')">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                            <div class="lyrics mt-3" id="lyrics-un-deux-trois">
                                Un, deux, trois<br>
                                Nous irons au bois<br>
                                Quatre, cinq, six<br>
                                Cueillir des cerises
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Frère Jacques -->
                <div class="song-card mb-4" data-category="all">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title">
                                    <i class="fas fa-music text-primary"></i> Frère Jacques
                                </h3>
                                <audio id="audio-frere-jacques" class="d-none">
                                    <source src="/projet/assets/audio/songs/frere jaques.mp3" type="audio/mpeg">
                                </audio>
                                <button class="btn btn-primary btn-play" onclick="playSong('frere-jacques')">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                            <div class="lyrics mt-3" id="lyrics-frere-jacques">
                                Frère Jacques, Frère Jacques<br>
                                Dormez-vous ? Dormez-vous ?<br>
                                Sonnez les matines, Sonnez les matines<br>
                                Ding ding dong, Ding ding dong
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Une Souris Verte -->
                <div class="song-card mb-4" data-category="animals">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title">
                                    <i class="fas fa-mouse text-success"></i> Une Souris Verte
                                </h3>
                                <audio id="audio-souris-verte" class="d-none">
                                    <source src="/projet/assets/audio/songs/une souris verte.mp3" type="audio/mpeg">
                                </audio>
                                <button class="btn btn-primary btn-play" onclick="playSong('souris-verte')">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                            <div class="lyrics mt-3" id="lyrics-souris-verte">
                                Une souris verte<br>
                                Qui courait dans l'herbe<br>
                                Je l'attrape par la queue<br>
                                Je la montre à ces messieurs
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lecteur de musique -->
        <div class="col-md-4">
            <div class="card player-card sticky-top" style="top: 20px;">
                <div class="card-body">
                    <h4 class="text-center mb-4">
                        <i class="fas fa-headphones"></i> En cours de lecture
                    </h4>
                    <div id="current-song" class="text-center">
                        <div class="current-song-image mb-3">
                            <i class="fas fa-music fa-3x text-primary"></i>
                        </div>
                        <h5 id="current-song-title">Sélectionne une chanson</h5>
                        <div class="controls mt-4">
                            <button class="btn btn-outline-primary me-2" onclick="previousSong()">
                                <i class="fas fa-backward"></i>
                            </button>
                            <button class="btn btn-primary me-2" id="main-play-btn" onclick="togglePlay()">
                                <i class="fas fa-play"></i>
                            </button>
                            <button class="btn btn-outline-primary me-2" onclick="nextSong()">
                                <i class="fas fa-forward"></i>
                            </button>
                            <button class="btn" id="shuffle-btn" onclick="toggleShuffle()">
                                <i class="fas fa-random"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rainbow-text {
    background: linear-gradient(45deg, #FF6B6B, #4ECDC4, #45B7D1, #96CEB4, #FFEEAD);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: rainbow 12s ease-in-out infinite;
    background-size: 400%;
    font-family: 'Comic Sans MS', cursive;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

@keyframes rainbow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.song-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: 1.5rem;
}

.song-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 12px 20px rgba(0,0,0,0.15);
}

.song-card[data-category="all"] {
    border-left: 4px solid #FF6B6B;
}

.song-card[data-category="animals"] {
    border-left: 4px solid #4ECDC4;
}

.song-card[data-category="numbers"] {
    border-left: 4px solid #FFD93D;
}

.song-card[data-category="nature"] {
    border-left: 4px solid #95E1D3;
}

.card {
    border-radius: 20px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    background: #fff;
    border: none;
    overflow: hidden;
}

.lyrics {
    font-size: 1.2rem;
    line-height: 2;
    color: #555;
    font-family: 'Comic Sans MS', cursive;
    padding: 15px;
    background: linear-gradient(145deg, #ffffff, #f8f9fa);
    border-radius: 15px;
    margin-top: 20px;
    border: 2px dashed #e0e0e0;
    transition: all 0.3s ease;
}

.lyrics:hover {
    border-color: #4ECDC4;
    background: linear-gradient(145deg, #ffffff, #f0f9f7);
}

.btn-play {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(145deg, #4ECDC4, #45B7D1);
    border: none;
    box-shadow: 0 6px 15px rgba(78, 205, 196, 0.3);
}

.btn-play:hover {
    transform: scale(1.15) rotate(360deg);
    box-shadow: 0 8px 25px rgba(78, 205, 196, 0.4);
}

.btn-play i {
    font-size: 1.4rem;
    color: white;
}

.player-card {
    background: linear-gradient(165deg, #ffffff, #f5f5f5);
    border: none;
    border-radius: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.player-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, #FF6B6B, #4ECDC4, #FFD93D);
    border-radius: 6px 6px 0 0;
}

.current-song-image {
    width: 140px;
    height: 140px;
    background: linear-gradient(145deg, #f8f9fa, #e9ecef);
    border-radius: 50%;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    animation: float 4s ease-in-out infinite;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

@keyframes float {
    0% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(5deg); }
    100% { transform: translateY(0px) rotate(0deg); }
}

.playing .current-song-image {
    animation: rotate 12s linear infinite;
    background: linear-gradient(45deg, #FF6B6B, #4ECDC4, #FFD93D);
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.category-buttons {
    padding: 20px 0;
    background: rgba(255,255,255,0.9);
    border-radius: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.category-buttons .btn {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    margin: 8px;
    padding: 12px 25px;
    border-radius: 30px;
    font-weight: bold;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    border: none;
}

.category-buttons .btn:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.visualizer {
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    margin: 20px 0;
}

.visualizer-bar {
    width: 5px;
    height: 25px;
    background: linear-gradient(to top, #4ECDC4, #45B7D1);
    border-radius: 3px;
}

.playing .visualizer-bar {
    animation: soundBars 1.2s ease-in-out infinite;
}

@keyframes soundBars {
    0% { height: 25px; opacity: 0.5; }
    50% { height: 45px; opacity: 1; }
    100% { height: 25px; opacity: 0.5; }
}

.playing-song {
    border: 3px solid #4ECDC4 !important;
    box-shadow: 0 0 20px rgba(78, 205, 196, 0.3);
    transform: scale(1.02);
}

#song-progress {
    width: 100%;
    height: 8px;
    margin: 20px 0;
    -webkit-appearance: none;
    background: #e0e0e0;
    border-radius: 4px;
    cursor: pointer;
}

#song-progress::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    background: #4ECDC4;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

#song-progress::-webkit-slider-thumb:hover {
    transform: scale(1.2);
    background: #45B7D1;
}

.controls {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 18px;
    margin-top: 20px;
}

.controls button {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    background: white;
    border: 2px solid #4ECDC4;
    color: #4ECDC4;
    font-size: 1.5rem;
}

.controls button.btn-primary {
    background: #4ECDC4;
    color: white;
    border: none;
    width: 60px;
    height: 60px;
    font-size: 2rem;
}

.controls button:focus {
    outline: none;
    box-shadow: 0 0 0 2px #4ECDC4;
}

#shuffle-btn {
    background: white;
    border: 2px solid #FFD93D;
    color: #FFD93D;
}

#shuffle-btn:hover, #shuffle-btn.active {
    background: #FFD93D;
    color: white;
}

@media (max-width: 600px) {
    .controls {
        gap: 8px;
    }
    .controls button, .controls button.btn-primary {
        width: 40px;
        height: 40px;
        font-size: 1.1rem;
    }
}
</style>

<script>
let currentAudio = null;
let pianoSound = null;

const songs = {
    'frere-jacques': {
        title: 'Frère Jacques',
        lyrics: `Frère Jacques, Frère Jacques\nDormez-vous ? Dormez-vous ?\nSonnez les matines, Sonnez les matines\nDing ding dong, Ding ding dong`,
        audioUrl: '/projet/assets/audio/songs/frere jaques.mp3'
    },
    'souris-verte': {
        title: 'Une souris verte',
        lyrics: `Une souris verte\nQui courait dans l'herbe\nJe l'attrape par la queue\nJe la montre à ces messieurs`,
        audioUrl: '/projet/assets/audio/songs/une souris verte.mp3'
    },
    'un-deux-trois': {
        title: 'Un, deux, trois',
        lyrics: `Un, deux, trois\nNous irons au bois\nQuatre, cinq, six\nCueillir des cerises`,
        audioUrl: '/projet/assets/audio/songs/un deux trois.mp3'
    }
};

let audioContext = null;
let oscillator = null;

const songOrder = ['frere-jacques', 'souris-verte', 'un-deux-trois'];
let currentSongIndex = 0;
let isShuffle = false;

function playSong(songId) {
    stopAllSounds();
    currentSongIndex = songOrder.indexOf(songId);
    const song = songs[songId];
    document.getElementById('current-song-title').textContent = song.title;
    if (window.currentAudio) {
        window.currentAudio.pause();
        window.currentAudio.currentTime = 0;
    }
    window.currentAudio = new Audio(song.audioUrl);
    window.currentAudio.volume = 1.0;
    window.currentAudio.onended = () => {
        nextSong();
    };
    window.currentAudio.onerror = () => {
        alert('Impossible de lire le fichier audio.');
    };
    window.currentAudio.ontimeupdate = updateProgressBar;
    window.currentAudio.onplay = () => updatePlayButton(true);
    window.currentAudio.onpause = () => updatePlayButton(false);
    window.currentAudio.play().catch(() => {
        document.body.addEventListener('click', () => window.currentAudio.play(), { once: true });
    });
    highlightCurrentSong();
    updatePlayButton(true);
    resetProgressBar();
}

function playPianoMelody(notes) {
    if (!audioContext) {
        audioContext = new (window.AudioContext || window.webkitAudioContext)();
    }

    const now = audioContext.currentTime;
    let time = now;

    notes.forEach(note => {
        const osc = audioContext.createOscillator();
        const gain = audioContext.createGain();
        
        // Utiliser une forme d'onde douce pour le piano
        osc.type = 'sine';
        
        osc.connect(gain);
        gain.connect(audioContext.destination);
        
        // Enveloppe ADSR douce pour le piano
        const attackTime = 0.1;
        const decayTime = 0.2;
        const sustainLevel = note.volume;
        const releaseTime = 0.3;

        gain.gain.setValueAtTime(0, time);
        gain.gain.linearRampToValueAtTime(note.volume, time + attackTime);
        gain.gain.linearRampToValueAtTime(sustainLevel, time + attackTime + decayTime);
        gain.gain.linearRampToValueAtTime(0, time + (note.duration / 1000));

        osc.frequency.value = noteToFreq(note.note);
        osc.start(time);
        osc.stop(time + note.duration / 1000);
        
        time += note.duration / 1000;
    });
}

function stopAllSounds() {
    if (currentAudio) {
        currentAudio.pause();
        currentAudio.currentTime = 0;
    }
    if (window.speechSynthesis.speaking) {
        window.speechSynthesis.cancel();
    }
    if (audioContext) {
        audioContext.close();
        audioContext = null;
    }
}

function togglePlay() {
    if (!window.currentAudio) return;
    if (window.currentAudio.paused) {
        window.currentAudio.play();
        updatePlayButton(true);
    } else {
        window.currentAudio.pause();
        updatePlayButton(false);
    }
}

function updatePlayButton(isPlaying) {
    const playButton = document.querySelector('#main-play-btn i');
    const playerCard = document.querySelector('.player-card');
    if (isPlaying) {
        playButton.classList.remove('fa-play');
        playButton.classList.add('fa-pause');
        playerCard.classList.add('playing');
        if (!document.querySelector('.visualizer')) {
            const visualizer = document.createElement('div');
            visualizer.className = 'visualizer';
            for (let i = 0; i < 10; i++) {
                const bar = document.createElement('div');
                bar.className = 'visualizer-bar';
                bar.style.animationDelay = `${i * 0.1}s`;
                visualizer.appendChild(bar);
            }
            document.querySelector('#current-song').insertBefore(
                visualizer,
                document.querySelector('.controls')
            );
        }
    } else {
        playButton.classList.remove('fa-pause');
        playButton.classList.add('fa-play');
        playerCard.classList.remove('playing');
    }
}

function previousSong() {
    if (isShuffle) {
        playSong(songOrder[Math.floor(Math.random() * songOrder.length)]);
        return;
    }
    currentSongIndex = (currentSongIndex - 1 + songOrder.length) % songOrder.length;
    playSong(songOrder[currentSongIndex]);
}

function nextSong() {
    if (isShuffle) {
        playSong(songOrder[Math.floor(Math.random() * songOrder.length)]);
        return;
    }
    currentSongIndex = (currentSongIndex + 1) % songOrder.length;
    playSong(songOrder[currentSongIndex]);
}

function highlightCurrentSong() {
    document.querySelectorAll('.song-card').forEach((card, idx) => {
        if (idx === currentSongIndex) {
            card.classList.add('playing-song');
        } else {
            card.classList.remove('playing-song');
        }
    });
}

function updateProgressBar() {
    const progress = document.getElementById('song-progress');
    if (window.currentAudio && progress) {
        progress.value = window.currentAudio.currentTime;
        progress.max = window.currentAudio.duration;
    }
}

function resetProgressBar() {
    const progress = document.getElementById('song-progress');
    if (progress) {
        progress.value = 0;
        progress.max = 1;
    }
}

function filterSongs(category) {
    const songs = document.querySelectorAll('.song-card');
    songs.forEach(song => {
        if (category === 'all' || song.dataset.category === category) {
            song.style.display = 'block';
        } else {
            song.style.display = 'none';
        }
    });
}

function toggleShuffle() {
    isShuffle = !isShuffle;
    const shuffleBtn = document.getElementById('shuffle-btn');
    shuffleBtn.classList.toggle('active', isShuffle);
}

document.addEventListener('DOMContentLoaded', () => {
    // Add progress bar
    const controls = document.querySelector('.controls');
    if (controls && !document.getElementById('song-progress')) {
        const progress = document.createElement('input');
        progress.type = 'range';
        progress.id = 'song-progress';
        progress.value = 0;
        progress.min = 0;
        progress.step = 0.01;
        progress.style.width = '100%';
        progress.addEventListener('input', function() {
            if (window.currentAudio) {
                window.currentAudio.currentTime = parseFloat(this.value);
            }
        });
        controls.parentNode.insertBefore(progress, controls);
    }
});

// Arrêter tous les sons quand on quitte la page
window.addEventListener('beforeunload', stopAllSounds);
</script>

<?php include $root_path . 'templates/footer.php'; ?> 