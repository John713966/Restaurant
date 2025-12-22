# Système de Gestion de Restaurant

## Aperçu du Projet
Ce projet est une application web de gestion de restaurant développée en PHP. Elle permet de gérer les catégories de produits, les produits, les commandes, le stock et les utilisateurs. L'application utilise une base de données MySQL pour stocker les données et offre une interface utilisateur pour effectuer diverses opérations.

## Fonctionnalités
- **Authentification des utilisateurs** : Connexion et déconnexion des utilisateurs avec différents niveaux d'accès (admin, système).
- **Gestion des catégories** : Ajouter, modifier et supprimer des catégories de produits (ex. : Bière, Boissons Gazeuses, Alcool).
- **Gestion des produits** : Ajouter, modifier et supprimer des produits avec leurs prix et catégories associées.
- **Gestion des commandes** : Passer des commandes, calculer les totaux et les taxes.
- **Suivi du stock** : Gérer les quantités en stock pour chaque produit.
- **Rapports** : Générer des rapports sur les commandes, les catégories, les utilisateurs et la comptabilité.
- **Interface utilisateur** : Pages web pour l'accueil, la connexion, la gestion des produits, etc.

## Installation
1. **Prérequis** :
   - Serveur web (ex. : Apache ou Nginx)
   - PHP 8.0 ou supérieur
   - MySQL ou MariaDB
   - Navigateur web

2. **Clonage du projet** :
   ```
   git clone <url-du-repo>
   cd Restaurant
   ```

3. **Configuration de la base de données** :
   - Importez le fichier `restaurant.sql` dans votre base de données MySQL.
   - Modifiez le fichier `BD/connexion.php` pour configurer les paramètres de connexion à la base de données (hôte, nom d'utilisateur, mot de passe, nom de la base).

4. **Déploiement** :
   - Placez le dossier `Restaurant` dans le répertoire racine de votre serveur web (ex. : htdocs pour XAMPP).
   - Accédez à l'application via votre navigateur (ex. : http://localhost/Restaurant/page/index.html).

## Configuration de la Base de Données
- **Tables principales** :
  - `categorie` : Stocke les catégories de produits.
  - `produits` : Stocke les informations sur les produits (nom, catégorie, prix).
  - `commande` : Enregistre les commandes passées par les utilisateurs.
  - `stock` : Suit les quantités en stock pour chaque produit.
  - `user` : Gère les utilisateurs et leurs rôles.

- Exécutez le script SQL fourni pour créer et peupler la base de données.

## Utilisation
1. **Connexion** : Utilisez la page de connexion (`page/index.html`) pour accéder à l'application.
2. **Navigation** : Utilisez le menu pour accéder aux différentes sections (accueil, catégories, produits, commandes, etc.).
3. **Opérations** :
   - Ajouter des produits via `traitement/ajouterproduit.php`.
   - Passer des commandes via `traitement/passercom.php`.
   - Générer des rapports via les pages de rapport (ex. : `page/rapportcategorie.php`).

## Technologies Utilisées
- **Backend** : PHP
- **Frontend** : HTML, CSS (avec Bootstrap et FontAwesome), JavaScript (jQuery)
- **Base de données** : MySQL
- **Bibliothèques** : Bootstrap, DataTables, FPDF (pour les rapports PDF)

## Contribution
Pour contribuer à ce projet :
1. Forkez le repository.
2. Créez une branche pour vos modifications.
3. Soumettez une pull request avec une description détaillée des changements.

## Licence
Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus de détails.

## Contact
Pour toute question ou support, contactez [votre-email@example.com].
