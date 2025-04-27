<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="fas fa-graduation-cap"></i> Plateforme d'Apprentissage
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/modules/games">
                        <i class="fas fa-gamepad"></i> Jeux
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/modules/exercises">
                        <i class="fas fa-tasks"></i> Exercices
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/modules/videos">
                        <i class="fas fa-video"></i> Vidéos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/modules/lessons">
                        <i class="fas fa-book"></i> Leçons
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isLoggedIn()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile.php">
                            <i class="fas fa-user"></i> Mon Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout.php">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login.php">
                            <i class="fas fa-sign-in-alt"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register.php">
                            <i class="fas fa-user-plus"></i> Inscription
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav> 