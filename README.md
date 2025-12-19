# Devoir_Touche_Pas_Au_Klaxon

## Description du Projet

"Touche_Pas_Au_Klaxon" est une application web basée sur PHP qui suit le modèle architectural MVC (Modèle-Vue-Contrôleur).

## Fonctionnalités

- **Gestion des Utilisateurs** : Prend en charge les rôles d'utilisateur tels que 'utilisateur' et 'admin'.
- **Gestion des Agences** : Permet la gestion de diverses agences.
- **Gestion des Trajets** : Permet aux utilisateurs de créer et de gérer des trajets entre différentes agences.

## Installation

1. **Cloner le Répertoire**
   ```bash
   git clone <repository-url>
   ```
2. **Naviguer vers le Répertoire du Projet**
   ```bash
   cd Devoir_Touche_Pas_Au_Klaxon
   ```
3. **Installer les Dépendances**
   ```bash
   composer install
   ```

## Configuration de la Base de Données

1. **Créer la Base de Données**
   - Exécutez le script SQL `01_schema.sql` pour configurer le schéma de la base de données.
2. **Insérer les Données Initiales**
   - Exécutez `02_insertion_donnees.sql` pour peupler la base de données avec des données initiales.

## Utilisation

- **Accéder à l'Application**
  - Démarrez un serveur local et accédez au répertoire du projet.
  - Accédez via `http://localhost`.

## Dépendances

- PHP 8.1 ou supérieur
- Composer
- izniburak/router

