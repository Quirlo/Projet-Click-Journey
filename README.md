# Projet Click-JourneY - XPLORE

Click-JourneY est un site web dynamique de réservation de voyages d’aventure, développé en PHP et utilisant une base de données au format JSON. Il propose des séjours extrêmes à travers le monde (trek, safari, expéditions) et permet aux utilisateurs de consulter, personnaliser et réserver leurs voyages.

## 📁 Arborescence du projet

Projet-Click-JourneY/
│
├── css/                    # Feuilles de style CSS
│   ├── styleindex.css
│   ├── styleprofil.css
│   ├── stylepayment.css
│   ├── stylevoyage.css
│   └── styledark.css       # (Nouveau) Thème sombre
│
├── data/                   # Fichiers JSON (trips, users)
│   ├── trips.json
│   └── users.json
│
├── image/                  # Images utilisées dans le site
│
├── js/                     # Scripts JavaScript (phase 3)
│   ├── form_validation.js      # Validation des formulaires
│   ├── panier.js               # Gestion du panier
│   ├── personnalisation.js     # Calcul dynamique du prix
│   ├── profil.js               # Édition du profil en direct
│   ├── theme.js                # Gestion du thème (clair/sombre)
│   └── tri.js                  # Filtres & tri dynamiques
│
├── testphp/                # Fichiers de tests PHP
│
├── admin.php               # Interface d'administration
├── ajouter_panier.php      # (Nouveau) Ajout d’un voyage au panier
├── connexion.php           # Page de connexion
├── consulter.php           # Détails des voyages réservés
├── destination.php         # Liste publique des voyages
├── index.php               # Page d'accueil
├── inscription.php         # Page d'inscription
├── logout.php              # Déconnexion utilisateur
├── panier.php              # (Nouveau) Panier avec voyages personnalisés
├── payment.php             # Interface de paiement
├── prepare_payment.php     # (Nouveau) Préparation des paramètres de paiement
├── profil.php              # Page profil avec champs éditables
├── recapprofil.php         # Historique des voyages réservés
├── recapitulatif.php       # Récapitulatif d'un voyage personnalisé
├── retirer_panier.php      # (Nouveau) Suppression d’un voyage du panier
├── update_user.php         # Mise à jour du profil
├── validation_paiement.php # Traitement du retour de paiement
├── voyage.php              # Détails + personnalisation d’un voyage
│
├── README.md               # (Ce fichier)
├── README_XPlore.txt       # Informations spécifiques à XPlore
└── Rapport.pdf             # Rapport de projet à jour

## ✅ Fonctionnalités principales

🔎 Consultation libre des voyages (page destination.php)  
📄 Fiches détaillées avec personnalisation (hébergement, restauration, activités)  
💬 Authentification utilisateur (inscription, connexion)  
🧾 Récapitulatif et réservation personnalisée  
🛍️ **Nouveau** : système de panier avant paiement  
💳 Simulation de paiement via interface CY Bank  
🛠️ Interface administrateur (consultation, bannissement, etc.)  
🎨 **Nouveau** : gestion dynamique du thème clair/sombre (via cookies)  
🧠 **Nouveau** : validation JS des formulaires, édition de profil inline  
📊 **Nouveau** : filtres et tri dynamiques des voyages sans rechargement  

## 📦 Format des données JSON

### `trips.json`
Contient les voyages, leurs étapes, prix de base et options personnalisables avec prix unitaires.

### `users.json`
Contient les utilisateurs (email, mot de passe, rôle, réservations, etc.).

## 👤 Comptes de test

### 🔑 Administrateur  
Email : `test@admin.com`  
Mot de passe : `oli`

### 👥 Client classique  
Email : `slave1@test.com`  
Mot de passe : `1234`

## 🚀 Lancer le projet

1. Copier le dossier dans `htdocs/` (serveur local avec XAMPP par ex.)  
2. Démarrer **Apache**  
3. Accéder à : [http://localhost/Projet-Click-JourneY](http://localhost/Projet-Click-JourneY)

## ✏️ Auteurs

- Mohamed Ouhab  
- Edonis Shaljani  
- Taimim Jelouali

