# 📚 Mini Bibliothèque de Quartier

Une application web simple et intuitive de gestion de bibliothèque, développée avec le framework **Laravel (v12)**, **Blade**, et **Bootstrap**. Ce projet a été réalisé en suivant la méthodologie **Agile (Scrum)**.

## 🚀 Installation Rapide

Pour lancer le projet pour la première fois, assurez-vous d'avoir PHP 8.2+ et Composer installés, puis exécutez :

```bash
# Configuration automatique (dépendances, .env, clé, base de données, seeds)
composer setup
```

## 🛠️ Lancement du Développement

Pour lancer les serveurs simultanément (Serveur PHP + Vite pour les assets) :

```bash
composer dev
```

L'application sera accessible sur : [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 🔐 Accès de Test

Voici les comptes pré-configurés pour tester l'application (générés via `db:seed`) :

### 🛡️ Administrateur (Accès complet)
- **Email** : `admin@biblio.com`
- **Mot de passe** : `password`
- **Actions** : Gestion de tout le catalogue (Lancer/Supprimer des livres), gestion des utilisateurs et des emprunts.

### 👤 Utilisateur Standard
- **Email** : `test@example.com`
- **Mot de passe** : `password`
- **Actions** : Consultation du catalogue et emprunt de livres.

## 📖 Fonctionnalités Implémentées

### Pour les Utilisateurs
- ✅ Inscription et Connexion sécurisées (Laravel Breeze).
- ✅ Consultation du catalogue de livres avec recherche.
- ✅ Emprunt et retour de livres (Logique de stock gérée).

### Pour les Administrateurs
- ✅ **Tableau de bord** : Statistiques en temps réel (Emprunts actifs, retards, total livres).
- ✅ **Gestion du Catalogue** : CRUD complet (Ajouter, Modifier, Supprimer des livres).
- ✅ **Gestion des Utilisateurs** : Consultation de la liste des membres.

## 📁 Structure Technique

- **Routes** : `routes/web.php` (logique d'administration et dashboard) et `routes/auth.php` (authentification).
- **Contrôleurs** :
    - `BookController` : Gère le catalogue et les actions admin sur les livres.
    - `AdminController` : Gère le dashboard et les statistiques.
    - `LoanController` : Gère la logique d'emprunt/retour.
- **Middleware** : `AdminMiddleware` protège l'accès à la section `/admin`.
- **Base de données** : SQLite par défaut (`database/database.sqlite`).

## 🤝 Équipe du Projet
- Kylian SEKA
- Lucas
- Youssef (Responsable US5 & US7 : Ajout/Suppression de livres)
- Glenn
- Timothée
