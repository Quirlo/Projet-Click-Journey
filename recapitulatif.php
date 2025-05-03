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
            'hebergement' => $_POST['hebergement'][$i],
            'restauration' => $_POST['restauration'][$i],
            'activites' => $_POST['activites'][$i],
            'transport' => $_POST['transport'][$i],
            'participants' => $_POST['participants'][$i]
        ];
    }

    // Enregistrement dans la session
    $recap = [
        'trip_id' => $tripId,
        'title' => 'Voyage personnalisé',
        'date' => date('Y-m-d'),
        'prix_total' => $_POST['prix_total'] ?? 0,
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
    <link id="theme-style" rel="stylesheet" href="css/stylerecapitulatif.css">
    <script src="js/theme.js" defer></script>
</head>
<body>
    <h1>Récapitulatif de votre voyage</h1>

    <?php if (isset($_SESSION['recap'])): ?>
        <?php $recap = $_SESSION['recap']; ?>
        <p><strong>Date de réservation :</strong> <?= $recap['date'] ?></p>
        <h2>Étapes personnalisées :</h2>
        <ol>
        <?php foreach ($recap['custom_options'] as $step): ?>
  <table class="recap-table">
    <thead>
      <th colspan="2"><?= htmlspecialchars($step['step'] ?? 'Étape non définie') ?></th>
<tr>
    <td><strong>Hébergement</strong></td>
    <td><?= htmlspecialchars($step['hebergement'] ?? 'Non défini') ?></td>
</tr>
<tr>
    <td><strong>Restauration</strong></td>
    <td><?= htmlspecialchars($step['restauration'] ?? 'Non défini') ?></td>
</tr>
<tr>
    <td><strong>Activité</strong></td>
    <td><?= htmlspecialchars($step['activites'] ?? 'Non défini') ?></td>
</tr>
<tr>
    <td><strong>Transport</strong></td>
    <td><?= htmlspecialchars($step['transport'] ?? 'Non défini') ?></td>
</tr>
<tr>
    <td><strong>Participants</strong></td>
    <td><?= htmlspecialchars($step['participants'] ?? 'Non défini') ?></td>
</tr>

    </tbody>
  </table>
<?php endforeach; ?>

        </ol>
        <form action="payment.php" method="post" style="margin-top: 30px;">
        <input type="hidden" name="recap_data" value='<?= htmlspecialchars(json_encode($_SESSION['recap']), ENT_QUOTES, "UTF-8") ?>'>
        <input type="hidden" name="prix_total" id="prix_total_input" value="0">

        <button type="submit" class="confirm-btn">Confirmer ma réservation</button>
        </form>
        
        <form method="post" action="ajouter_panier.php" style="display: inline;">
            <input type="hidden" name="recap_data" id="recap_data_input" value='<?= htmlspecialchars(json_encode($_SESSION["recap"]), ENT_QUOTES, "UTF-8") ?>'>
            <input type="hidden" name="prix_total" id="prix_total_input" value="0">
            <button type="submit" class="recap-btn">Ajouter au panier</button>
    
        </form>


        <a href="voyage.php?id=<?= htmlspecialchars($_SESSION['recap']['trip_id']) ?>" class="btn-retour">← Retour à la personnalisation</a>

    <?php else: ?>
        <p>Aucune donnée de personnalisation trouvée.</p>
    <?php endif; ?>


    <script>
    const tripId = <?= json_encode($_GET['id']) ?>;
</script>
<script src="js/panier.js"></script>



</body>


</html>

