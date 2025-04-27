-- Création de la base de données
CREATE DATABASE IF NOT EXISTS apprentissage;
USE apprentissage;

-- Table des catégories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    age_min INT,
    age_max INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des contenus
CREATE TABLE IF NOT EXISTS contents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    type ENUM('video', 'audio', 'image', 'text') NOT NULL,
    filepath VARCHAR(255) NOT NULL,
    category_id INT,
    difficulty_level ENUM('facile', 'moyen', 'avancé') DEFAULT 'facile',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des progrès utilisateur
CREATE TABLE user_progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content_id INT NOT NULL,
    completed BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (content_id) REFERENCES contents(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des favoris utilisateur
CREATE TABLE user_favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (content_id) REFERENCES contents(id) ON DELETE CASCADE,
    UNIQUE KEY unique_favorite (user_id, content_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des récompenses utilisateur
CREATE TABLE user_rewards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    type ENUM('achievement', 'badge', 'medal') NOT NULL,
    points INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertion des catégories de base
INSERT INTO categories (name, description, age_min, age_max) VALUES
('Lecture', 'Apprentissage de la lecture et du vocabulaire', 3, 7),
('Mathématiques', 'Nombres, formes et calculs simples', 4, 8),
('Sciences', 'Découverte de la nature et des sciences', 5, 10),
('Langues', 'Apprentissage des langues étrangères', 6, 10),
('Musique', 'Éveil musical et chansons éducatives', 3, 8),
('Art', 'Activités créatives et artistiques', 3, 10); 