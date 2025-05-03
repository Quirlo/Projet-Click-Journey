<?php
session_start();

if (!isset($_SESSION['user']['email'])) {
    header("Location: connexion.php");
    exit();
}

if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    header("Location: profil.php");
    exit();
}

$index = isset($_POST['voyage_index']) ? (int)$_POST['voyage_index'] : 0;

// Si l'index est invalide
if (!isset($_SESSION['panier'][$index])) {
    header("Location: panier.php");
    exit();
}

// Préparation des données pour le paiement
$_SESSION['recap'] = $_SESSION['panier'][$index];

// 🔁 On indique que ça vient du panier + l'index
$_SESSION['recap']['source'] = 'panier';
$_SESSION['recap']['index'] = $index;

// Redirection vers la page de paiement
header("Location: payment.php?index=$index");
exit();
