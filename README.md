# Plateforme d'Apprentissage Éducatif

Une plateforme interactive et ludique pour l'apprentissage des enfants, inspirée par SplashLearn.

## Structure du Projet

```
projet/
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── includes/
│   ├── db.php
│   └── functions.php
├── modules/
│   ├── maternelle/
│   ├── primaire/
│   └── scolaire/
├── admin/
│   ├── members.php
│   ├── member_details.php
│   └── dashboard.php
├── templates/
│   ├── header.php
│   └── footer.php
├── index.php
├── login.php
├── register.php
├── profile.php
├── team.php
└── database.sql
```

## Configuration requise

- PHP 8.2 ou supérieur
- MySQL 5.7 ou supérieur
- Serveur Web (Apache/Nginx)
- Extensions PHP : pdo_mysql, mysqli, openssl

## Installation

1. Cloner le projet
2. Configurer la base de données dans `includes/db.php`
3. Importer le fichier SQL `database.sql`
4. Configurer le serveur web pour pointer vers le dossier du projet
5. Accéder à l'application via `http://localhost/projet`

## Fonctionnalités principales

- **Navigation par catégories** : Maternelle, Primaire, Scolaire
- **Exercices interactifs** : Mathématiques, Français, Sciences, etc.
- **Système de scores et badges** : Suivi de progression, récompenses, classement
- **Favoris** : Sauvegarde des activités préférées
- **Interface responsive** : Adaptée aux enfants et aux mobiles
- **Gestion des utilisateurs** : Inscription, connexion, profil, progression
- **Administration** : Gestion des membres, statistiques globales, suppression/désactivation
- **Sécurité** : Accès restreint, confirmation avant actions sensibles

## Personnalisation & Extension

- Ajoutez facilement de nouveaux modules ou exercices dans le dossier `modules/`
- Personnalisez le style dans `assets/css/` et les templates dans `templates/`
- Étendez les fonctionnalités admin dans `admin/`

## Crédits

Projet open-source pour l'éducation, inspiré par SplashLearn et adapté pour le contexte francophone.

**Projet de : HICHAM MAHBOUB, Kida Anass, Oussama Mesbahi, Aya Elasri** 