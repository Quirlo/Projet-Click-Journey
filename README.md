#  Projet Click-JourneY-XPLORE

**Click-JourneY** est un site web dynamique de réservation de voyages d’aventure, développé en PHP et utilisant une base de données au format JSON. Il propose des séjours extrêmes à travers le monde (trek, safari, expéditions) et permet aux utilisateurs de consulter, personnaliser et réserver leurs voyages.

##  Arborescence du projet

```
Projet-Click-Journey/
│
├── css/                    # Feuilles de style CSS
├── data/                   # Fichiers JSON (trips, users)
├── image/                  # Images utilisées dans le site
├── testphp/                # Fichiers de tests PHP
│
├── admin.php               # Interface d'administration
├── connexion.php           # Page de connexion
├── destination.php         # Liste des voyages (publique)
├── inscription.php         # Page d'inscription
├── index.php               # Page d'accueil
├── payment.php             # Interface de paiement
├── profil.php              # Accès au profil utilisateur
├── recapitulatif.php       # Page de récapitulatif d'un voyage personnalisé
├── recapprofil.php         # Historique des voyages (profil ou admin)
├── validation_paiement.php # Vérification après retour de paiement
├── voyage.php              # Détails d’un voyage cliquable
│
├── README.md               # (Ce fichier)
├── README_XPlore.txt       # Informations spécifiques à la plateforme XPlore
└── Rapport.pdf             # Rapport de projet
```

##  Fonctionnalités principales

- 🔎 **Consultation libre des voyages** (page `destination.php`)
- 📄 **Fiches détaillées** avec personnalisation (hébergement, restauration, activités)
- 💬 **Authentification utilisateur** (inscription, connexion)
- 🧾 **Récapitulatif et réservation personnalisée**
- 💳 **Simulation de paiement via interface CY Bank**
- 🛠️ **Interface administrateur** (gestion des utilisateurs, bannissement, consultation des réservations)
- 🔐 **Sécurisation basique des accès selon rôles**

## 📦 Format des données JSON

### `trips.json`
Contient les voyages avec leurs caractéristiques :

```json
{
  "id": 1,
  "title": "Safari dans le Masai Mara",
  "destination": "Kenya",
  "price": 1490,
  "duration": "7 jours",
  "start_date": "2025-05-15",
  "steps": [
    "SITUATION", "HÉBERGEMENT", "RESTAURATION", ...
  ]
}
```

### `users.json`
Gère les comptes et rôles des utilisateurs :

```json
{
  "email": "exemple@mail.com",
  "password": "hash",
  "role": "normal",  // ou "admin", "banni"
  "reservations": [...]
}
```

## 👤 Comptes de test

- 🔑 **Administrateur**  
  Email : `test@admin.com`  
  Mot de passe : `oli`

- 👥 **Client classique**  
  Email : `slave1@test.com`  
  Mot de passe : `1234`

## 🚀 Lancer le projet

1. Placer le dossier dans `htdocs` (via XAMPP ou autre serveur local).
2. Démarrer **Apache** dans XAMPP.
3. Accéder à [http://localhost/Projet-Click-Journey](http://localhost/Projet-Click-Journey)

## ✏️ Auteurs

- Mohamed Ouhab
- Edonis Shaljani
- Taimim Jelouali
