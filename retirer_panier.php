<?php
session_start();

if (!isset($_SESSION['user']['email'])) {
    header("Location: connexion.php");
    exit();
}

if (isset($_GET['index'])) {
    $index = (int) $_GET['index'];

    if (isset($_SESSION['panier'][$index])) {
        // Supprimer l’élément du panier
        array_splice($_SESSION['panier'], $index, 1);
    }

    // Redirection intelligente
    if (empty($_SESSION['panier'])) {
        header("Location: profil.php"); // ou page vide du panier
    } else {
        $newIndex = max(0, $index - 1);
        header("Location: panier.php?index=$newIndex");
    }
    exit();
}
