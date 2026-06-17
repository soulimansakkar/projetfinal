-- base de données wakdo - souliman sakkar

CREATE DATABASE IF NOT EXISTS wakdo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wakdo;

CREATE TABLE produits (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(150) NOT NULL,
    description TEXT,
    prix DECIMAL(6,2) NOT NULL,
    categorie VARCHAR(50) NOT NULL,
    image VARCHAR(200),
    disponible TINYINT(1) DEFAULT 1
);

CREATE TABLE utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(80) NOT NULL,
    prenom VARCHAR(80) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'preparation', 'accueil') NOT NULL
);

CREATE TABLE commandes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    numero_client INT NOT NULL,
    total DECIMAL(8,2) NOT NULL DEFAULT 0,
    statut ENUM('en_attente', 'prete', 'livree') NOT NULL DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- pas eu le temps de faire la table lignes_commande

INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role) VALUES
('Admin', 'Wakdo', 'admin@wakdo.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Martin', 'Sophie', 'prep@wakdo.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'preparation'),
('Bernard', 'Karim', 'accueil@wakdo.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'accueil');
