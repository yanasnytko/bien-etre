# Annuaire Bien-Être

Une application web dynamique pour mettre en relation des prestataires de services bien-être et des utilisateurs.  
Ce projet permet aux utilisateurs de rechercher et consulter des prestataires, d'inscrire des commentaires, de proposer des catégories, et aux prestataires de créer et gérer leurs offres (prestations, promotions, stages, etc.).

## Table des Matières

- [Description](#description)
- [Fonctionnalités](#fonctionnalités)
- [Technologies Utilisées](#technologies-utilisées)
- [Installation](#installation)
- [Configuration](#configuration)
- [Utilisation](#utilisation)
- [Seeders et Factories](#seeders-et-factories)
- [Tests](#tests)
- [Déploiement](#déploiement)
- [Contribuer](#contribuer)
- [Licence](#licence)

## Description

**Annuaire Bien-Être** est une application web Laravel qui a pour objectif de créer un annuaire de prestataires dans le domaine du bien-être.  
Les utilisateurs peuvent rechercher des prestataires selon divers critères (catégorie, localisation, nom) et consulter leurs fiches détaillées.  
Les prestataires peuvent s’inscrire et gérer leur profil, ainsi que leurs offres (services, promotions, stages).  
Une interface d'administration permet une gestion globale de l'annuaire.

## Fonctionnalités

- **Recherche et Consultation :**
  - Recherche par catégorie, localisation et nom.
  - Fiches détaillées pour chaque prestataire.
  - Visualisation de la localisation sur une carte (intégration future de Google Maps).

- **Interaction Utilisateur :**
  - Inscription et connexion via Jetstream (Livewire).
  - Ajout de favoris.
  - Publication de commentaires et notations.
  - Inscription à une newsletter.

- **Fonctionnalités pour Prestataires :**
  - Inscription et gestion de profil.
  - Gestion des offres de services, promotions et stages.
  - Proposition de nouvelles catégories (CategorieProposal).

- **Sécurité et Autorisation :**
  - Gestion de l'authentification via Laravel Jetstream.
  - Utilisation de Policies et Gates pour contrôler l'accès aux ressources.

## Technologies Utilisées

- **Backend :** Laravel 12 (PHP 8.4)
- **Frontend :** Blade (avec Jetstream et Livewire)
- **Base de Données :** MySQL
- **Authentification :** Laravel Jetstream (Livewire & Fortify) et Sanctum (pour l'API)
- **Gestion des Assets :** Vite
- **Contrôle de Version :** Git (hébergé sur GitHub)

## Installation

### Prérequis

- PHP 8.4 ou supérieur
- Composer
- MySQL
- Node.js et npm

### Étapes d'installation

1. **Cloner le dépôt GitHub :**
   ```bash
   git clone https://github.com/ton-compte/bien-etre.git
   cd bien-etre

2. **Installer les dépendances PHP :**
    ```bash
    composer install

3. **Installer les dépendances JavaScript :**
    ```bash
    npm install
    npm run dev

4. **Créer le fichier .env :**
    ```bash
    cp .env.example .env
    php artisan key:generate
Configure ensuite les variables d'environnement (base de données, mail, etc.) dans le fichier .env.

5. **Exécuter les migrations et seeders :**
    ```bash
    php artisan migrate:fresh --seed

6. **Configurer Jetstream et l'authentification :**
Jetstream est déjà installé et configuré avec Livewire pour gérer l'inscription, la connexion et la gestion du profil.

## Configuration

- **Fichier `.env`:**  
  Configure les variables d'environnement essentielles, telles que :
  - `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`  
  - La configuration du mail, si nécessaire.  
  - Toute autre variable propre à ton environnement de développement ou de production.

- **Fichiers de configuration:**  
  - **config/app.php** : Paramètres globaux de l'application (nom, fuseau horaire, fournisseurs de services, etc.).  
  - **config/jetstream.php** : Personnalisation des fonctionnalités de Jetstream (activation/désactivation des équipes, etc.).

## Utilisation

- **Navigation :**  
  L'application dispose d'un menu permettant d'accéder au dashboard, à la liste des prestataires et aux pages de gestion de profil.

- **Inscription et Connexion :**  
  Utilise les pages d'authentification générées par Jetstream pour t'inscrire, te connecter et gérer ton profil.

- **Gestion des Prestataires :**  
  Les utilisateurs pouvant devenir prestataires accèdent à une interface dédiée (via ServiceProviderController) pour ajouter, modifier ou supprimer leurs informations.

- **Administration :**  
  Les administrateurs (définis notamment par le champ `user_type` dans le modèle User) disposent d'un dashboard pour gérer l'annuaire et contrôler certaines fonctionnalités grâce aux Policies et Gates.

## Seeders et Factories

Chaque entité dispose d'une Factory (située dans **database/factories**) et d'un Seeder correspondant (dans **database/seeders**) pour générer des données de test.  
**Pour peupler ta base de données, exécute :**
    ```bash
    php artisan migrate:fresh --seed

## Tests
Des tests unitaires et d'intégration sont recommandés pour garantir la robustesse de l'application.
**Lance-les avec :**
    ```bash
    php artisan test

## Déploiement
- **Prépare ton environnement de production :** 
Configure tes variables d'environnement dans le fichier .env de production ainsi que les autres paramètres de configuration du serveur.

- **Compile les assets en production avec :**
    ```bash
    npm run build

- **Configure ton serveur web :** 
Assure-toi que le serveur (Nginx, Apache, etc.) pointe vers le dossier public/ de ton application Laravel.

## Contribuer
Les contributions sont les bienvenues !
Pour contribuer :

1. Forke le dépôt.

2. Crée une branche (ex. git checkout -b feature/nouvelle-fonctionnalite).

3. Fais tes modifications et commit-les.

4. Pousse la branche sur ton fork.
    ```bash
    git push -u origin feature/nouvelle-fonctionnalite

5. Ouvre une Pull Request sur le dépôt principal.

Licence
Ce projet est sous licence de rien du tout, parce que c'est un projet d'études.