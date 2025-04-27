// Validation du formulaire
document.addEventListener('DOMContentLoaded', function() {
    // Validation des formulaires Bootstrap
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Mise à jour dynamique des formats de fichiers acceptés
    var contentType = document.getElementById('contentType');
    if (contentType) {
        contentType.addEventListener('change', function() {
            const formatHelp = document.getElementById('formatHelp');
            switch(this.value) {
                case 'video':
                    formatHelp.textContent = 'Formats acceptés : MP4, WebM, AVI';
                    break;
                case 'audio':
                    formatHelp.textContent = 'Formats acceptés : MP3, WAV, OGG';
                    break;
                case 'image':
                    formatHelp.textContent = 'Formats acceptés : JPG, PNG, GIF';
                    break;
                case 'text':
                    formatHelp.textContent = 'Formats acceptés : PDF, DOC, TXT';
                    break;
            }
        });
    }

    // Animation des cartes de contenu
    const cards = document.querySelectorAll('.content-card');
    cards.forEach(card => {
        card.classList.add('fade-in');
    });

    // Gestion des messages
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    const error = urlParams.get('error');

    // Affichage des messages de succès
    if (success === 'delete') {
        showAlert('Succès !', 'Le contenu a été supprimé avec succès.', 'success');
    }
    
    // Affichage des messages d'erreur
    if (error) {
        showAlert('Erreur !', decodeURIComponent(error), 'danger');
    }

    // Confirmation de suppression
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer ce contenu ? Cette action est irréversible.')) {
                e.preventDefault();
            }
        });
    });
});

// Fonction pour afficher les alertes
function showAlert(title, message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        <strong>${title}</strong> ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    // Insertion de l'alerte au début du conteneur
    const container = document.querySelector('.container');
    container.insertBefore(alertDiv, container.firstChild);

    // Auto-fermeture après 5 secondes
    setTimeout(() => {
        alertDiv.classList.remove('show');
        setTimeout(() => alertDiv.remove(), 150);
    }, 5000);
} 