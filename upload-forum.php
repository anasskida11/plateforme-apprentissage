<?php
require 'includes/db.php';
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un contenu éducatif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Comic Sans MS', cursive;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-label {
            color: #2c3e50;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        .category-card {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .category-card:hover {
            border-color: #3498db;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">
            <i class="fas fa-plus-circle"></i> Ajouter un contenu éducatif
        </h1>
        
        <form action="upload.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="mb-3">
                <label class="form-label">Titre du contenu :</label>
                <input type="text" class="form-control" name="title" required 
                       placeholder="Ex: L'alphabet en chanson">
                <div class="form-text">Choisissez un titre clair et attractif pour les enfants</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description :</label>
                <textarea class="form-control" name="description" rows="3" 
                          placeholder="Décrivez le contenu et son objectif pédagogique"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Type de contenu :</label>
                <select class="form-select" name="type" required id="contentType">
                    <option value="video">Vidéo éducative</option>
                    <option value="audio">Audio (chanson, histoire...)</option>
                    <option value="image">Image (illustration, schéma...)</option>
                    <option value="text">Texte (histoire, exercice...)</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Catégorie :</label>
                <div class="row">
                    <?php foreach ($categories as $category): ?>
                    <div class="col-md-6 mb-2">
                        <div class="category-card">
                            <input type="radio" class="form-check-input" name="category_id" 
                                   value="<?= $category['id'] ?>" required>
                            <label class="form-check-label">
                                <strong><?= htmlspecialchars($category['name']) ?></strong>
                                <br>
                                <small>Age: <?= $category['age_min'] ?>-<?= $category['age_max'] ?> ans</small>
                                <br>
                                <small class="text-muted"><?= htmlspecialchars($category['description']) ?></small>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Niveau de difficulté :</label>
                <select class="form-select" name="difficulty_level" required>
                    <option value="facile">Facile</option>
                    <option value="moyen">Moyen</option>
                    <option value="avancé">Avancé</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fichier :</label>
                <input type="file" class="form-control" name="file" required>
                <div class="form-text" id="fileHelp">
                    Format accepté : 
                    <span id="formatHelp">Tous les formats</span>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-upload"></i> Envoyer le contenu
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mise à jour dynamique des formats acceptés
        document.getElementById('contentType').addEventListener('change', function() {
            const formatHelp = document.getElementById('formatHelp');
            switch(this.value) {
                case 'video':
                    formatHelp.textContent = 'MP4, WebM, AVI';
                    break;
                case 'audio':
                    formatHelp.textContent = 'MP3, WAV, OGG';
                    break;
                case 'image':
                    formatHelp.textContent = 'JPG, PNG, GIF';
                    break;
                case 'text':
                    formatHelp.textContent = 'PDF, DOC, TXT';
                    break;
            }
        });

        // Validation du formulaire
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>
