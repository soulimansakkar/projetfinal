# Wakdo - Projet étudiant

Petit projet de commande en ligne :

- `bloc1-frontend` : interface client en HTML/CSS/JS
- `bloc2-backend` : administration PHP avec login et gestion des commandes
- `bloc3-symfony` : dossier non utilisé
- `bloc5-devops` : fichiers Docker

## Installation rapide

1. Importer `bloc2-backend/database.sql` dans MySQL pour creer la base.
2. Depuis la racine du projet, lancer un serveur PHP :
   `php -S localhost:8000`
3. Back office : http://localhost:8000/bloc2-backend/
4. Borne client : http://localhost:8000/bloc1-frontend/

## Comptes de test

mot de passe : `wakdo2024`

- admin@wakdo.fr (admin)
- prep@wakdo.fr (preparation)
- accueil@wakdo.fr (accueil)

## Notes

- le frontend charge les produits depuis `data/produits.json`
- l'API de commande est dans `bloc2-backend/api.php`
