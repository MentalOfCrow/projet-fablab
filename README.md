### Projet-FabLab

## L’objectif de ce projet est de créer une application permettant d’automatiser la gestion des commandes d’impression 3D, d’optimiser les ressources (imprimantes, matériaux, temps) et d’offrir une meilleure visibilité sur l’état des impressions.

Sommaire
Contexte
Fonctionnalités Principales
Technologies et Architecture
Installation
Configuration
Utilisation
Structure du Projet
Contribuer
Licence
Auteurs / Contact
Contexte

# Ce projet a été réalisé dans le cadre d’un besoin de moderniser la gestion des commandes d’impression 3D d’un FabLab. Auparavant, la gestion se faisait manuellement via un fichier Excel, ce qui entraînait des problèmes de traçabilité et de suivi. L’application vise à centraliser toutes les informations, à faciliter la planification et à améliorer l’expérience client (confirmation de commande, état d’avancement, notifications, etc.).

### Fonctionnalités Principales
Gestion des commandes :

# Création et modification de commandes (nom du client, fichier STL, couleur, dimensions, type de filament).
Suivi de l’avancement (en attente, en cours, terminé).
Recherche de commandes par client, date ou statut.
Gestion des imprimantes :

# Suivi de la disponibilité (libre, en cours d’utilisation, maintenance).
Planification automatique (attribuer les commandes en fonction des ressources et temps estimés).
Tableau de bord :

# Vue d’ensemble des commandes en attente, en cours et terminées.
Statistiques (temps d’utilisation des imprimantes, nombre de commandes terminées, types de filaments utilisés, etc.).
Export de données :

# Possibilité d’exporter l’historique des commandes ou les statistiques au format PDF/Excel.
Notifications :

# Envoi de notifications (email ou in-app) pour informer les clients de l’avancement de leur commande.
Technologies et Architecture
Langage : PHP (back-end), HTML/CSS/JS (front-end).
Base de données : MySQL ou MariaDB (via PDO).
Architecture : Approche MVC simplifiée (Models, Views, Controllers) avec un routeur.
Dépôts de fichiers : Les fichiers STL sont stockés dans un dossier public/uploads (ou similaire).
(Adapter cette section à tes choix techniques réels : frameworks, libs, etc.)

### Installation
Cloner le dépôt : git clone https://github.com/MentalOfCrow/projet-fablab.git

Installer les dépendances (si tu utilises Composer) : composer install

### Configuration
Fichier .env (optionnel si tu utilises une configuration par environnement) :

### Utilisation
Démarrer le serveur web (par exemple avec PHP intégré) : php -S localhost:8000 -t public

Accéder à l’application :

Ouvre un navigateur à l’adresse http://localhost:8000/index.php (ou celle configurée).
Tu devrais voir la page d’accueil, avec un lien vers la liste des commandes, l’interface d’administration, etc.
Création de commande :

Aller sur l’onglet “Créer une nouvelle commande”, remplir le formulaire (client, fichier STL, etc.), puis valider.
Suivi des impressions :

Dans le tableau de bord, tu visualises les imprimantes disponibles, les commandes en cours, etc.


### Structure du Projet


PROJET-FABLAB/
├── .env
├── .gitignore
├── backend
│   ├── controllers
│   │   └── controller.php
│   ├── db
│   │   ├── bdd.sql
│   │   └── config.php
│   ├── includes
│   │   ├── footer.php
│   │   └── header.php
│   ├── models
│   │   └── model.php
│   └── views
│       └── view.php
├── index.php
├── LICENSE
├── public
│   └── assets
│       ├── css
│       │   └── index.css
│       ├── img
│       └── js
│           └── app.js
├── README.md
└── router.php

Principaux dossiers :

backend : logique métier (contrôleurs, modèles, vues, config BDD, etc.).
public/assets : ressources statiques (CSS, JS, images).
index.php : point d’entrée principal.
router.php : gère le routage des requêtes vers les bons contrôleurs.

### Contribuer
Les contributions sont les bienvenues !

### Fork le dépôt
Crée une branche (ex: feature/ma-nouvelle-fonctionnalite)
Fais tes modifications et ajoute des tests si nécessaire
Soumets une Pull Request
Merci de respecter la convention de commit (optionnel).

### Licence
Ce projet est sous licence MIT (ou autre, selon ton choix).
Tu es libre de le modifier, redistribuer, à condition de conserver la licence d’origine.

### Auteurs 
Abdallah 
Hugo 
Johan

Pour toute question, ouvre une issue ou contacte-nous directement.