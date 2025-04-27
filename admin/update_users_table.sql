-- Ajouter la colonne is_admin à la table users
ALTER TABLE users ADD COLUMN is_admin BOOLEAN DEFAULT FALSE;

-- Mettre à jour l'utilisateur pour en faire un admin
UPDATE users SET is_admin = TRUE WHERE email = 'anaskida111@gmail.com'; 