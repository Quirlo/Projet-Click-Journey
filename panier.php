<?php
session_start();

if (!isset($_SESSION['user']['email'])) {
    header("Location: connexion.php");
    exit();
}

$panier = $_SESSION['panier'] ?? [];
if (empty($panier)) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Mon Panier - XPlore</title>
        <link rel="stylesheet" href="css/stylepanier.css">
    </head>
    <body>
        <div class="empty-panier">
            <h1>🧳 Mon panier</h1>
            <p>Votre panier est vide pour le moment.</p>
            <a href="destination.php" class="btn-retour">Découvrir des voyages</a>
        </div>
    </body>
    </html>
    <?php
    exit();
}


$voyageIndex = isset($_GET['index']) ? (int)$_GET['index'] : 0;

// Si l'index n'est pas valide, on redirige vers le premier voyage
if (!isset($panier[$voyageIndex])) {
    header("Location: panier.php?index=0");
    exit();
}


$voyage = $panier[$voyageIndex];

$allTrips = json_decode(file_get_contents('data/trips.json'), true);
$tripName = "Voyage";

foreach ($allTrips as $trip) {
    if ($trip['id'] == $voyage['trip_id']) {
        $tripName = $trip['title'];
        break;
    }
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier - XPlore</title>
    <link rel="stylesheet" href="css/stylepanier.css">
</head>
<body>
    <h1>🧳 Mon panier</h1>

    <div class="voyage-container">
    <h2>🗺️ <?= htmlspecialchars($tripName) ?></h2>


    <?php foreach ($voyage['custom_options'] as $index => $step): ?>
    <?php
        // Ne pas afficher si tout est vide (hors participants)
        $isEmpty = empty($step['hebergement']) && empty($step['restauration']) &&
                   empty($step['activites']) && empty($step['transport']);
        if ($isEmpty) continue;
    ?>
    <div class="step-card">
        <h3>Étape <?= $index + 1 ?> : <?= htmlspecialchars($step['step']) ?></h3>
        <ul>
            <li> Hébergement : <?= htmlspecialchars($step['hebergement']) ?></li>
            <li> Restauration : <?= htmlspecialchars($step['restauration']) ?></li>
            <li> Activité : <?= htmlspecialchars($step['activites']) ?></li>
            <li> Transport : <?= htmlspecialchars($step['transport']) ?></li>
            <li> Participants : <?= htmlspecialchars($step['participants']) ?></li>
        </ul>
    </div>
<?php endforeach; ?>


        <div class="panier-buttons">
        <form action="prepare_payment.php" method="post" style="display: inline;">
            <input type="hidden" name="voyage_index" value="<?= $voyageIndex ?>">
            <button type="submit" class="btn-payer">Payer ce voyage</button>
        </form>



            <a href="retirer_panier.php?index=<?= $voyageIndex ?>" class="btn-retirer">Retirer du panier</a>

            <?php if ($voyageIndex + 1 < count($panier)): ?>
                <a href="panier.php?index=<?= $voyageIndex + 1 ?>" class="btn-suivant">Suivant</a>
            <?php endif; ?>

            <a href="profil.php" class="btn-retour">Retour à mon profil</a>
        </div>
    </div>
</body>
</html>
