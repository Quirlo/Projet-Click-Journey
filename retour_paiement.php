<?php
session_start();
require('getapikey.php');

// Récupération des données GET
$session = $_GET['session'] ?? '';
$status = $_GET['status'] ?? '';
$montant = $_GET['montant'] ?? '0';
$transaction = $_GET['transaction'] ?? '';
$vendeur = $_GET['vendeur'] ?? '';
$control = $_GET['control'] ?? '';

// Vérification du contrôle
$api_key = getAPIKey($vendeur);
$calcul = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $status . "#");

if ($calcul !== $control) {
    echo "<h2 style='color: orange;'>⚠ Erreur de contrôle</h2><p>Les données ont été modifiées ou corrompues.</p><a href='profil.php'>Retour</a>";
    exit();
}


if ($status === 'denied') {
    header('Location: index.php');
    exit();
}


// Paiement accepté : on ajoute le voyage
if ($status === 'accepted' && isset($_SESSION['user'])) {
    if (isset($_GET['index']) && isset($_SESSION['panier'][$_GET['index']])) {
    unset($_SESSION['panier'][$_GET['index']]);
    // Réindexer le tableau pour éviter des trous
    $_SESSION['panier'] = array_values($_SESSION['panier']);
}
    $email = $_SESSION['user']['email'];
    $usersFile = 'data/users.json';
    $users = json_decode(file_get_contents($usersFile), true);
    $reservation = $_SESSION['recap'] ?? null;

    if ($reservation) {
        $trip_id = $reservation['trip_id'];
        $custom = $reservation['custom_options'];
        $date = date('Y-m-d');
        $titre = 'Voyage personnalisé';

        $trips = json_decode(file_get_contents('data/trips.json'), true);
        foreach ($trips as $trip) {
            if ($trip['id'] == $trip_id) {
                $titre = $trip['title'];
                break;
            }
        }

        foreach ($users as &$user) {
            if ($user['email'] === $email) {
                if (!isset($user['trips_history'])) $user['trips_history'] = [];
                $user['trips_history'][] = [
                    'trip_id' => $trip_id,
                    'title' => $titre,
                    'date' => $date,
                    'custom_options' => $custom
                ];
                $_SESSION['user'] = $user;
                break;
            }
        }

        file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
        unset($_SESSION['recap']);

        // Redirige vers la dernière réservation
        $newIndex = count($_SESSION['user']['trips_history']) - 1;
        header("Location: recapprofil.php?index=$newIndex");
        exit();
    }
}

echo "<h2>Erreur</h2><p>Impossible de traiter la réservation.</p><a href='profil.php'>Retour</a>";

