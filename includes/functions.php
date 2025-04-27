<?php
/**
 * Sanitize user input
 */
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate file upload
 */
function validateFile($file, $allowedTypes) {
    if (!isset($file['error']) || is_array($file['error'])) {
        return false;
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);

    return in_array($mimeType, $allowedTypes);
}

/**
 * Generate a random filename
 */
function generateFileName($originalName, $prefix = '') {
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
    return $prefix . uniqid() . '.' . $extension;
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Redirect to a URL
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Check if content is locked for the current user
 */
function isContentLocked($contentId) {
    // List of content IDs that are locked for non-logged-in users
    $lockedContent = [
        // Quizzes
        'quiz-numbers',
        'quiz-colors',
        'quiz-animals',
        'quiz-shapes',
        
        // Games
        'play-numbers',
        'play-colors',
        'advanced-games',
        'memory-game',
        'puzzle-game',
        'word-game',
        
        // Interactive Lessons
        'interactive-lessons',
        'video-lessons',
        'audio-lessons',
        
        // Progress Tracking
        'progress-tracking',
        'achievements',
        'certificates',
        
        // Premium Features
        'download-content',
        'print-worksheets',
        'offline-mode',
        'parent-dashboard'
    ];
    
    return in_array($contentId, $lockedContent) && !isLoggedIn();
}

/**
 * Get user's premium features
 */
function getUserPremiumFeatures() {
    if (!isLoggedIn()) {
        return [];
    }
    
    // You can add more premium features here
    return [
        'unlimited_quizzes',
        'download_content',
        'print_worksheets',
        'offline_mode',
        'parent_dashboard',
        'progress_tracking',
        'achievements',
        'certificates'
    ];
}

/**
 * Check if user has a specific premium feature
 */
function hasPremiumFeature($feature) {
    $premiumFeatures = getUserPremiumFeatures();
    return in_array($feature, $premiumFeatures);
}

/**
 * Display locked content message
 */
function displayLockedContent($contentId, $contentTitle) {
    ?>
    <div class="locked-content">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-lock fa-3x text-warning mb-3"></i>
                <h4><?php echo htmlspecialchars($contentTitle); ?></h4>
                <p class="text-muted">Ce contenu est réservé aux utilisateurs connectés.</p>
                <div class="mt-3">
                    <a href="/projet/login.php" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Se connecter
                    </a>
                    <a href="/projet/register.php" class="btn btn-outline-primary ms-2">
                        <i class="fas fa-user-plus"></i> S'inscrire
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Vérifie si l'utilisateur actuel est un administrateur
 * @return bool True si l'utilisateur est un admin, false sinon
 */
function isAdmin() {
    if (!isLoggedIn()) {
        return false;
    }

    global $pdo;
    $stmt = $pdo->prepare("SELECT is_admin FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    // Check if is_admin is 1 or true
    return $user && ($user['is_admin'] == 1 || $user['is_admin'] === true);
} 