# Projet-FabLab

## L’objectif de ce projet est de créer une application permettant d’automatiser la gestion des commandes d’impression 3D, d’optimiser les ressources (imprimantes, matériaux, temps) et d’offrir une meilleure visibilité sur l’état des impressions.

- Sommaire
- Contexte
- Fonctionnalités Principales
- Technologies et Architecture
- Installation
- Configuration
- Utilisation
- Structure du Projet
- Contribuer
- Licence
- Auteurs / Contact
- Contexte

###  Cadre du Projet :
- Ce projet a été réalisé dans le cadre d’un besoin de moderniser la gestion des commandes d’impression 3D d’un FabLab.
- Auparavant, la gestion se faisait manuellement via un fichier Excel, ce qui entraînait des problèmes de traçabilité et de suivi.
- L’application vise à centraliser toutes les informations, à faciliter la planification et à améliorer l’expérience client (confirmation de commande, état d’avancement, notifications, etc.).

# Fonctionnalités Principales :
### 🛠 Gestion des commandes :
- ✔️ Création et modification de commandes (Nom du client, fichier STL, couleur, dimensions, type de filament, etc.)
- ✔️ Suivi de l’avancement (En attente, en cours, terminé)
- ✔️ Recherche de commandes (Par client, date, ou statut)

### 📁 Création et modification de commandes (nom du client, fichier STL, couleur, dimensions, type de filament).
- ✔️ Suivi de l’avancement (en attente, en cours, terminé).
- ✔️ Recherche de commandes par client, date ou statut.

### 🖨️ Gestion des imprimantes :
- ✔️ Suivi de la disponibilité (Libre, en cours d’utilisation, en maintenance)
- ✔️ Planification automatique (Attribution intelligente des commandes en fonction des ressources et du temps estimé)

### 📊 Suivi de la disponibilité (libre, en cours d’utilisation, maintenance) / Tableau de bord / statistiques au format PDF/Excel :
- ✔️ Planification automatique (attribuer les commandes en fonction des ressources et temps estimés).
- ✔️ Vue d’ensemble des commandes en attente, en cours et terminées.
- ✔️ Statistiques (temps d’utilisation des imprimantes, nombre de commandes terminées, types de filaments utilisés, etc.).
- ✔️ Export de données : PDF et EXCEL
- ✔️ Notifications 

### 🔔 Envoi de notifications (email ou in-app) pour informer les clients de l’avancement de leur commande.
- ✔️ Technologies et Architecture
- ✔️ Langage : PHP (back-end), HTML/CSS/JS (front-end).
- ✔️ Base de données : MySQL ou MariaDB (via PDO).
- ✔️ Architecture : Approche MVC simplifiée (Models, Views, Controllers) avec un routeur.
- ✔️ Dépôts de fichiers : Les fichiers STL sont stockés dans un dossier public/uploads (ou similaire).
- ✔️ (Adapter cette section à tes choix techniques réels : frameworks, libs, etc.)


# Installation
- Cloner le dépôt : git clone https://github.com/MentalOfCrow/projet-fablab.git
- Installer les dépendances (si tu utilises Composer) : composer install

### Configuration
- Fichier .env (optionnel si tu utilises une configuration par environnement) :

### utilisation
- Démarrer le serveur web (par exemple avec PHP intégré) : php -S localhost:9080 -t public ou php -S localhost:9080

### Accéder à l’application :

- Ouvre un navigateur à l’adresse http://localhost:8090/ ou http://localhost:8090/backend/views/index.php (ou celle configurée).
- Tu devrais voir la page d’accueil, avec un lien vers la liste des commandes, l’interface d’administration, etc.

### Création de commande :
- Aller sur l’onglet “Créer une nouvelle commande”, remplir le formulaire (client, fichier STL, etc.), puis valider.

### Suivi des impressions :
- ✔️ Dans le tableau de bord, tu visualises les imprimantes disponibles, les commandes en cours, etc.

### Accéder au projet : 

- Création de la base de données :
- Dans WampServer, ouvrez phpMyAdmin et créez une nouvelle base de données nommée fablab_db.


- Importation de la base de données :

- Rendez-vous dans le dossier /backend/bd/ et localisez le fichier bdd.sql.
- Copiez ce fichier sur votre bureau.
- Dans phpMyAdmin, sélectionnez la base fablab_db, cliquez sur l’onglet Importer, puis importez le fichier bdd.sql.
- Cette étape est très importante pour recréer la structure et insérer les données nécessaires au fonctionnement du projet.


- Lancement du projet :
- Ouvrez un terminal à la racine du projet et lancez la commande suivante :
- php -S localhost:9080 ou php -S localhost:9080 -t public
- Si le projet ne se lance pas, redémarrez votre ordinateur et réexécutez la commande.

- Accès à l’application :
- Connectez-vous avec l’un des comptes préconfigurés :

- Compte Administrateur
- Identifiant : johan
- Mot de passe : 010422

- Compte Utilisateur
- Identifiant : paul
- Mot de passe : 010203

Vous pouvez également créer votre propre compte, cela fonctionne très bien aussi.

### Structure du Projet
PROJET-FABLAB :

```
PROJET-FABLAB/
├── backend
│   ├── controllers
│   │   ├── add_order.php
│   │   ├── add_printer.php
│   │   ├── auth_controller.php
│   │   ├── check_completed_prints.php
│   │   ├── export_orders.php
│   │   ├── export_stats.php
│   │   ├── get_completed_orders.php
│   │   ├── get_notifications.php
│   │   ├── logout.php
│   │   ├── start_printing.php
│   │   ├── supprimer_commande.php
│   │   ├── supprimer_imprimante.php
│   │   ├── supprimer_user.php
│   │   ├── traiter_modification.php
│   │   ├── update_printer_status.php
│   │   ├── update_printer.php
│   │   ├── update_profile.php
│   │   └── update_user.php
│   ├── db
│   │   ├── bdd.sql
│   │   └── config.php
│   ├── includes
│   │   ├── footer.php
│   │   └── header.php
│   ├── models
│   │   └── model.php
│   └── views
│       ├── 404.php
│       ├── about.php
│       ├── attentes.php
│       ├── commande-user.php
│       ├── commande.php
│       ├── contact.php
│       ├── cours.php
│       ├── dashboard-admin.php
│       ├── dashboard-user.php
│       ├── export.php
│       ├── faq.php
│       ├── gestion.php
│       ├── help.php
│       ├── historique.php
│       ├── imprimantes.php
│       ├── index.php
│       ├── login.php
│       ├── modifier_commande.php
│       ├── modifier_profil.php
│       ├── privacy.php
│       ├── termines.php
│       └── terms.php
├── public
│   └── assets
│       ├── css
│       │   ├── 404.css
│       │   ├── about.css
│       │   ├── attentes.css
│       │   ├── commande.css
│       │   ├── contact.css
│       │   ├── cours.css
│       │   ├── dashboard.css
│       │   ├── export.css
│       │   ├── faq.css
│       │   ├── footer.css
│       │   ├── gestion.css
│       │   ├── header.css
│       │   ├── help.css
│       │   ├── historique.css
│       │   ├── imprimantes.css
│       │   ├── index.css
│       │   ├── login.css
│       │   ├── modifier_commande.css
│       │   ├── modifier_profil.css
│       │   ├── privacy.css
│       │   ├── termines.css
│       │   └── terms.css
│       ├── img
│       └── js
│           ├── 404.js
│           ├── app.js
│           ├── tabs.js
│           ├── tabs2.js
│           ├── updatePrints.js
│           └── updateProgress.js
│       └── uploads
├── .env
├── .gitignore
├── LICENSE
├── README.md
├── composer.json
├── composer.lock
├── index.php
└── router.php
````

### Principaux dossiers :

- backend : logique métier (contrôleurs, modèles, vues, config BDD, etc.).
- public/assets : ressources statiques (CSS, JS, images).
- index.php : point d’entrée principal.
- router.php : gère le routage des requêtes vers les bons contrôleurs.

### Contribuer
- Les contributions sont les bienvenues !

### Fork le dépôt
- Crée une branche (ex: feature/ma-nouvelle-fonctionnalite)
- Fais tes modifications et ajoute des tests si nécessaire
- Soumets une Pull Request
- Merci de respecter la convention de commit (optionnel).

### Licence
- Ce projet est sous licence MIT (ou autre, selon ton choix).
- Tu es libre de le modifier, redistribuer, à condition de conserver la licence d’origine.

### Auteurs 
- Abdallah 
- Hugo 
- Johan

Pour toute question, ouvre une issue ou contacte-nous directement. !!!