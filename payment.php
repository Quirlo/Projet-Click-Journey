<?php
session_start();
require('getapikey.php');

// Récupérer les infos de la commande (depuis panier ou recapitulatif)
$montant = 0;
$titreVoyage = 'Voyage personnalisé';
$transaction = uniqid(); //
$vendeur = "MEF-1_I"; //
$retour = "http://localhost:8080/Projet-Click-Journey/retour_paiement.php?session=" . session_id();

if (isset($_GET['index'])) {
    $retour .= "&index=" . $_GET['index'];
}

// Détection panier ou recap
if (isset($_GET['index']) && isset($_SESSION['panier'][$_GET['index']])) {
    $reservation = $_SESSION['panier'][$_GET['index']];
    $tripid = $reservation['trip_id'];
    $montant = number_format(floatval($reservation['prix_total']), 2, '.', '');
} elseif (isset($_SESSION['recap'])) {
    $recap = $_SESSION['recap'];
    $tripId = $recap['trip_id'];
    $montant = number_format(floatval($recap['prix_total'] ?? 0), 2, '.', '');
}
else {
    header('Location: index.php');
    exit();
}

// Récupérer le titre du voyage
$trips = json_decode(file_get_contents('data/trips.json'), true);
foreach ($trips as $trip) {
    if ($trip['id'] == $tripId) {
        $titreVoyage = $trip['title'];
        break;
    }
}

// Récupération de la clé API
$api_key = getAPIKey($vendeur);

// Calcul du contrôle
$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Redirection vers paiement</title>
</head>
<body onload="document.forms[0].submit();">
    <p>Redirection vers le service de paiement sécurisé CY Bank...</p>

    <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
        <input type="hidden" name="transaction" value="<?= htmlspecialchars($transaction) ?>">
        <input type="hidden" name="montant" value="<?= htmlspecialchars($montant) ?>">
        <input type="hidden" name="vendeur" value="<?= htmlspecialchars($vendeur) ?>">
        <input type="hidden" name="retour" value="<?= htmlspecialchars($retour) ?>">
        <input type="hidden" name="control" value="<?= htmlspecialchars($control) ?>">
    </form>
</body>
</html>
