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
│   ├
│   └── users.json
│
├── image/                  # Images utilisées dans le site
│
├── js/                     # Scripts JavaScript (phase 3)
│   ├── form_validation.js      # (Nouveau) Validation formulaire
│   ├── panier.js               # (Nouveau) Gestion du panier
│   ├── personnalisation.js     # (Nouveau) Personnalisation dynamique
│   ├── profil.js               # (Nouveau) Modification profil en direct
│   ├── theme.js                # (Nouveau) Changement de thème
│   └── tri.js                  # (Nouveau) Filtres + tri dynamique
│
├── testphp/                # Fichiers de tests PHP
│
├── admin.php               # Interface d'administration
├── ajouter_panier.php      # (Nouveau) Ajout d’un voyage personnalisé au panier
├── connexion.php           # Page de connexion
├── consulter.php           # Consultation des réservations
├── destination.php         # Liste des voyages (publique)
├── index.php               # Page d'accueil
├── inscription.php         # Page d'inscription
├── logout.php              # Déconnexion utilisateur
├── panier.php              # (Nouveau) Page du panier
├── payment.php             # Interface de paiement
├── prepare_payment.php     # (Nouveau) Préparation paiement
├── profil.php              # Accès au profil utilisateur
├── recapprofil.php         # Historique des voyages (profil ou admin)
├── recapitulatif.php       # Page de récapitulatif d'un voyage personnalisé
├── retirer_panier.php      # (Nouveau) Suppression d’un voyage du panier
├── update_user.php         # Mise à jour profil utilisateur
├── validation_paiement.php # Vérification après retour de paiement
├── voyage.php              # Détails d’un voyage cliquable avec personnalisation
│
├── README.md               # (Ce fichier)
├── README_XPlore.txt       # Informations spécifiques à XPlore
└── Rapport.pdf             # Rapport de projet (phase 3 à jour)

Fonctionnalités principales

 Consultation libre des voyages (page destination.php)  
 Fiches détaillées avec personnalisation (hébergement, restauration, activités)  
 Authentification utilisateur (inscription, connexion)  
 Récapitulatif et réservation personnalisée  
 Système de panier avant paiement  
 Simulation de paiement via interface CY Bank  
 Interface administrateur (gestion des utilisateurs, bannissement, consultation des réservations)  
 Changement de thème (clair/sombre) via cookie  
 Validation JS des formulaires, édition de profil sans rechargement  
 Tri & filtres dynamiques des voyages  

 📦 Format des données JSON

 trips.json : voyages avec personnalisation par étapes  
 users.json : utilisateurs avec réservations, rôles, dates, identifiants  

##  Comptes de test

###  Administrateur  
Email : `test@admin.com`  
Mot de passe : `oli`

###  Client classique  
Email : `slave1@test.com`  
Mot de passe : `1234`


Auteurs

- Mohamed Ouhab  
- Edonis Shaljani  
- Taimim Jelouali

