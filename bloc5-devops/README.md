# bloc5 - docker

pour lancer l'application :

copier .env.example en .env et changer les mots de passe

ensuite faire docker-compose up

le back office est sur le port 8080

le front (borne) c'est pas dans docker, faut l'ouvrir directement avec un navigateur depuis le dossier bloc1-frontend

si ca marche pas avec docker-compose up c'est peut etre qu'il faut faire docker-compose build avant

j'ai pas reussi a faire le github actions, je savais pas comment configurer le deploy automatique

note : j'ai eu un probleme avec le Dockerfile il copiait pas les bons fichiers, j'ai essayé de corriger mais je sais pas si c'est bon
