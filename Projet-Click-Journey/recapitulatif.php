<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

$recap = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['step_title'])) {
    $tripId = $_POST['trip_id'];
    $steps = [];

    for ($i = 0; $i < count($_POST['step_title']); $i++) {
        $steps[] = [
            'step' => $_POST['step_title'][$i],
            'hébergement' => $_POST['hebergement'][$i],
            'restauration' => $_POST['restauration'][$i],
            'activité' => $_POST['activite'][$i],
            'transport' => $_POST['transport'][$i],
            'participants' => $_POST['participants'][$i]
        ];
    }

    // Enregistrement dans la session
    $recap = [
        'trip_id' => $tripId,
        'title' => 'Voyage personnalisé',
        'date' => date('Y-m-d'),
        'custom_options' => $steps
    ];
    $_SESSION['recap'] = $recap;
}

// Si on confirme la réservation → mise à jour du fichier users.json
if (isset($_POST['confirmer_reservation']) && isset($_SESSION['recap'])) {
    $userEmail = $_SESSION['user']['email'];
    $usersFile = 'data/users.json';
    $users = json_decode(file_get_contents($usersFile), true);

    foreach ($users as &$user) {
        if ($user['email'] === $userEmail) {
            $user['trips_history'][] = $_SESSION['recap'];
            $_SESSION['user'] = $user;
            break;
        }
    }

    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
    unset($_SESSION['recap']);
    header('Location: profil.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif</title>
    <link rel="stylesheet" href="css/stylevoyage.css">
</head>
<body>
    <h1>Récapitulatif de votre voyage</h1>

    <?php if (isset($_SESSION['recap'])): ?>
        <?php $recap = $_SESSION['recap']; ?>
        <p><strong>Date de réservation :</strong> <?= $recap['date'] ?></p>
        <h2>Étapes personnalisées :</h2>
        <ol>
            <?php foreach ($recap['custom_options'] as $step): ?>
                <li>
                    <strong><?= htmlspecialchars($step['step']) ?></strong><br>
                    Hébergement : <?= htmlspecialchars($step['hébergement']) ?><br>
                    Restauration : <?= htmlspecialchars($step['restauration']) ?><br>
                    Activité : <?= htmlspecialchars($step['activité']) ?><br>
                    Transport : <?= htmlspecialchars($step['transport']) ?><br>
                    Participants : <?= htmlspecialchars($step['participants']) ?>
                </li>
            <?php endforeach; ?>
        </ol>
        <form method="post">
            <button type="submit" name="confirmer_reservation">Confirmer ma réservation</button>
        </form>
        <a href="javascript:history.back()">← Retour à la personnalisation</a>
    <?php else: ?>
        <p>Aucune donnée de personnalisation trouvée.</p>
    <?php endif; ?>
</body>
</html>
