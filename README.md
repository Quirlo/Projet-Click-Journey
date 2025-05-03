# 🌍 Projet Click-JourneY - XPLORE

Click-JourneY est un site web dynamique de réservation de voyages d’aventure, développé en **PHP**, **JavaScript** et utilisant des fichiers **JSON** comme base de données. Il propose des séjours extrêmes à travers le monde (trek, safari, expéditions) et permet aux utilisateurs de consulter, personnaliser et réserver leurs voyages.

---

## 📁 Arborescence du projet

```
Projet-Click-JourneY/
├── css/
│   ├── styleindex.css
│   ├── styleprofil.css
│   ├── stylepayment.css
│   ├── stylevoyage.css
│   └── styledark.css            # Thème sombre (nouveau)
│
├── data/
│   ├── trips.json               # Base de voyages
│   └── users.json               # Base utilisateurs
│
├── image/                       # Images du site
│
├── js/                          # Scripts JavaScript
│   ├── form_validation.js
│   ├── panier.js
│   ├── personnalisation.js
│   ├── profil.js
│   ├── theme.js
│   └── tri.js
│
├── testphp/                     # Fichiers de test PHP
│
├── admin.php
├── ajouter_panier.php
├── connexion.php
├── consulter.php
├── destination.php
├── index.php
├── inscription.php
├── logout.php
├── panier.php
├── payment.php
├── prepare_payment.php
├── profil.php
├── recapprofil.php
├── recapitulatif.php
├── retirer_panier.php
├── update_user.php
├── validation_paiement.php
├── voyage.php
│
├── README.md
├── README_XPlore.txt
└── Rapport.pdf
```

---

## ✅ Fonctionnalités principales

- 🔍 Consultation libre des voyages (page `destination.php`)
- 📄 Fiches détaillées avec personnalisation (hébergement, restauration, activités)
- 🧾 Récapitulatif et réservation personnalisée
- 💬 Authentification complète (inscription, connexion, profil utilisateur)
- 🛍️ **Nouveau** : système de **panier**
- 💳 Simulation de paiement avec CY Bank
- 🧠 **Nouveau** : validation JS des formulaires + édition dynamique de profil
- 🎨 **Nouveau** : thème clair/sombre stocké en cookie
- 📊 **Nouveau** : tri & filtres dynamiques sur les voyages (JS)

---

## 📦 Données JSON

### `trips.json`
Stocke les voyages avec :
- id, titre, destination, dates, durée, prix de base, difficulté
- étapes (avec hébergement, restauration, activités, transport)
- options personnalisables avec prix unitaires

### `users.json`
Contient :
- email, mot de passe (hashé), rôle (`normal`, `admin`, `banni`)
- réservations avec date, ID voyage, options choisies, statut

---

## 👤 Comptes de test

| Rôle          | Email               | Mot de passe |
|---------------|---------------------|--------------|
| Administrateur| `test@admin.com`    | `oli`        |
| Client normal | `slave1@test.com`   | `1234`       |

---

## 🚀 Lancer le projet en local

1. Copier le dossier dans `htdocs/` (serveur local XAMPP ou équivalent)
2. Démarrer **Apache**
3. Ouvrir un navigateur et accéder à :  
   👉 [http://localhost/Projet-Click-JourneY](http://localhost/Projet-Click-JourneY)

---

## ✍️ Auteurs

- **Mohamed Ouhab**
- **Edonis Shaljani**
- **Taimim Jelouali**

---

> Projet réalisé dans le cadre de la phase 3 (JS dynamique) du cours d'informatique à CY Cergy Paris Université.
