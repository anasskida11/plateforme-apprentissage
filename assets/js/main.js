// Add fade-in animation to cards
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.classList.add('fade-in');
    });
});

// Handle form submissions with validation
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});

// Configuration de la synthèse vocale
const speech = {
    speak: function(text, options = {}) {
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = options.lang || 'fr-FR';
        utterance.rate = options.rate || 0.8;
        utterance.pitch = options.pitch || 1;
        
        if (options.onEnd) {
            utterance.onend = options.onEnd;
        }
        
        window.speechSynthesis.speak(utterance);
    },
    
    cancel: function() {
        window.speechSynthesis.cancel();
    }
};

// Gestion des animations
const animations = {
    bounce: function(element) {
        element.style.transform = 'scale(1.1)';
        setTimeout(() => {
            element.style.transform = '';
        }, 300);
    }
};

// Common functions for the learning platform
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Initialize Bootstrap popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    });
});

// Handle responsive navigation
const navbarToggler = document.querySelector('.navbar-toggler');
if (navbarToggler) {
    navbarToggler.addEventListener('click', function() {
        document.querySelector('.navbar-collapse').classList.toggle('show');
    });
} 