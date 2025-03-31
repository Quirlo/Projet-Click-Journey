<?php
session_start();
$isConnected = isset($_SESSION['user']);

// Chargement du voyage sélectionné
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Aucun voyage sélectionné.";
    exit;
}

$trips = json_decode(file_get_contents('data/trips.json'), true);
$trip = null;

foreach ($trips as $t) {
    if ($t['id'] == $id) {
        $trip = $t;
        break;
    }
}

if (!$trip) {
    echo "Voyage non trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($trip['title']) ?> - Détail</title>
    <link rel="stylesheet" href="css/stylevoyage.css">
</head>
<body>

    <header>
        <h1><?= htmlspecialchars($trip['title']) ?></h1>
    </header>

    <section class="voyage-detail">
        <img src="<?= htmlspecialchars($trip['image']) ?>" alt="<?= $trip['title'] ?>" style="width: 100%; max-width: 600px;">

        <p><strong>Dates :</strong> <?= $trip['start_date'] ?> → <?= $trip['end_date'] ?> (<?= $trip['duration'] ?> jours)</p>
        <p><strong>Prix :</strong> <?= $trip['price'] ?> €</p>
        <p><strong>Difficulté :</strong> <?= ucfirst($trip['difficulty']) ?></p>
        <p><strong>Saison :</strong> <?= ucfirst($trip['season']) ?></p>

        <p><?= nl2br($trip['long_description']) ?></p>

        <h2>Étapes :</h2>
        <ol>
            <?php foreach ($trip['steps'] as $step): ?>
                <li>
                    <h3><?= $step['title'] ?></h3>
                    <p><strong>Dates :</strong> <?= $step['arrival_date'] ?> → <?= $step['departure_date'] ?></p>
                    <p><strong>Lieu :</strong> <?= $step['location']['city'] ?></p>

                    <p><strong>Hébergement :</strong> <?= implode(', ', $step['options']['hebergement']) ?></p>
                    <p><strong>Restauration :</strong> <?= implode(', ', $step['options']['restauration']) ?></p>
                    <p><strong>Activités :</strong> <?= implode(', ', $step['options']['activites']) ?></p>
                    <p><strong>Transport :</strong> <?= implode(', ', $step['options']['transport']) ?></p>

                    <?php if ($isConnected): ?>
                <form method="post" action="recapitulatif.php">
                    <h4>Personnalisez cette étape :</h4>

                    <!-- On cache des données pour transfert -->
                    <input type="hidden" name="trip_id" value="<?= $trip['id'] ?>">
                    <input type="hidden" name="step_title[]" value="<?= htmlspecialchars($step['title']) ?>">

                    <label>Hébergement :</label>
                    <select name="hebergement[]">
                        <?php foreach ($step['options']['hebergement'] as $option): ?>
                            <option value="<?= $option ?>"><?= $option ?></option>
                        <?php endforeach; ?>
                    </select><br>

                    <label>Restauration :</label>
                    <select name="restauration[]">
                        <?php foreach ($step['options']['restauration'] as $option): ?>
                            <option value="<?= $option ?>"><?= $option ?></option>
                        <?php endforeach; ?>
                    </select><br>

                    <label>Activité :</label>
                    <select name="activite[]">
                        <?php foreach ($step['options']['activites'] as $option): ?>
                            <option value="<?= $option ?>"><?= $option ?></option>
                        <?php endforeach; ?>
                    </select><br>

                    <label>Transport :</label>
                    <select name="transport[]">
                        <?php foreach ($step['options']['transport'] as $option): ?>
                            <option value="<?= $option ?>"><?= $option ?></option>
                        <?php endforeach; ?>
                    </select><br>

                    <label>Nombre de participants :</label>
                    <input type="number" name="participants[]" min="1" value="1"><br><br>
                    <?php endif; ?>


                            </li>
                        <?php endforeach; ?>
                        <?php if ($isConnected): ?>
                <button type="submit">Voir le récapitulatif</button>
                </form>
                <?php else: ?>
                    <p style="color: red;">Veuillez vous connecter pour personnaliser ce voyage.</p>
                <?php endif; ?>
                    </ol>

        <a href="destination.php" class="btn-retour">← Retour aux voyages</a>
    </section>

</body>
</html>

