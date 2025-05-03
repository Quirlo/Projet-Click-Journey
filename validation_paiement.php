<?php
session_start();

$redirect = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider_paiement']) && isset($_SESSION['recap'])) {
    $recap = $_SESSION['recap'];
    $recap['date'] = date('Y-m-d');
    $email = $_SESSION['user']['email'];

    // Lire les utilisateurs existants
    $usersFile = 'data/users.json';
    $users = json_decode(file_get_contents($usersFile), true);

    // Ajouter le voyage à l'historique
    foreach ($users as &$user) {
        if ($user['email'] === $email) {
            if (!isset($recap['date'])) {
                $recap['date'] = date('Y-m-d');
            }
            $user['trips_history'][] = $recap;
            $_SESSION['user'] = $user;
            break;
        }
    }

    // Sauvegarde
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

    // ✅ Si c'est un paiement depuis le panier, on le retire :
    if (isset($recap['source']) && $recap['source'] === 'panier') {
        $index = $recap['index'] ?? null;
        if ($index !== null && isset($_SESSION['panier'][$index])) {
            unset($_SESSION['panier'][$index]);
            $_SESSION['panier'] = array_values($_SESSION['panier']); // Réindexation propre
        }
    }

    unset($_SESSION['recap']); // Nettoyage
    $redirect = true;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Validation du paiement</title>
    <link rel="stylesheet" href="css/stylevoyage.css">
    <meta http-equiv="refresh" content="4;url=profil.php">
</head>
<body>
    <div class="payment-box">
        <?php if ($redirect): ?>
            <h2>Paiement validé ✅</h2>
            <p>Merci pour votre réservation !</p>
            <p>Redirection vers votre profil en cours...</p>
        <?php else: ?>
            <h2>Erreur ❌</h2>
            <p>Une erreur est survenue lors du paiement.</p>
            <a href="destination.php">↩ Retour vers les voyages</a>
        <?php endif; ?>
    </div>
</body>
</html>
