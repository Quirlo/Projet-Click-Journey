<?php
session_start();

$titreVoyage = 'Voyage personnalisé';
$montant = 0;

// Si on vient du panier
if (isset($_GET['index']) && isset($_SESSION['panier'][$_GET['index']])) {
    $reservation = $_SESSION['panier'][$_GET['index']];
    $tripId = $reservation['trip_id'];
    $customOptions = $reservation['custom_options'];
    $montant = $reservation['prix_total'] ?? 0;
    $montant = isset($reservation['prix_total']) ? floatval($reservation['prix_total']) : 0;


    // Charger le nom du voyage depuis trips.json
    $trips = json_decode(file_get_contents('data/trips.json'), true);
    foreach ($trips as $trip) {
        if ($trip['id'] == $tripId) {
            $titreVoyage = $trip['title'];
            break;
        }
    }
}
// Sinon on vient du recapitulatif
elseif (isset($_SESSION['recap'])) {
    $recap = $_SESSION['recap'];
    $tripId = $recap['trip_id'];
    $customOptions = $recap['custom_options'];
    $montant = $recap['prix_total'] ?? 0;

    $trips = json_decode(file_get_contents('data/trips.json'), true);
    foreach ($trips as $trip) {
        if ($trip['id'] == $tripId) {
            $titreVoyage = $trip['title'];
            break;
        }
    }
} else {
    // Aucune donnée trouvée, redirige par sécurité
    header('Location: index.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement</title>
    <link rel="stylesheet" href="css/stylepayment.css">
</head>
<body>
<body>
    <div class="payment-wrapper">
        <h1>💳 Paiement</h1>
        <div class="payment-box">
            <p><strong>Voyage :</strong> <?= htmlspecialchars($titreVoyage) ?></p>


            <form method="post" action="validation_paiement.php">
                <div class="form-group">
                    <label>Numéro de carte :</label>
                   <input type="text" name="card_number" id="card_number" maxlength="19"
                    placeholder="1234 5678 9012 3456"
                    pattern="\d{4} \d{4} \d{4} \d{4}"
                    title="Format attendu : 1234 5678 9012 3456" required>
                </div>
                <div class="form-group">
                    <label>Nom du titulaire :</label>
                    <input type="text" name="card_name" placeholder="Jean Dupont"
                    pattern="[A-Za-zÀ-ÿ\s\-']{2,50}"
                    title="Seules les lettres, espaces et tirets sont autorisés"
                    required>
                </div>
                <div class="form-group">
                    <label>Date d'expiration :</label>
                    <input type="month" name="card_expiry" required>
                </div>
                <div class="form-group">
                    <label>CVV :</label>
                    <input type="text" name="card_cvv" placeholder="123" maxlength="3"
                    pattern="\d{3}" title="Le CVV doit contenir 3 chiffres" required>
                </div>
                <button type="submit" name="valider_paiement" class="btn-valider">✅ Payer maintenant</button>
            </form>

            <a href="destination.php"><button type="button" class="btn-annuler">❌ Annuler</button></a>
        </div>
    </div>

</body>
</html>

<script>
    const cardInput = document.getElementById('card_number');

    cardInput.addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, ''); // Supprimer tout sauf les chiffres
        value = value.substring(0, 16); // Limite à 16 chiffres
        const spaced = value.match(/.{1,4}/g); // Regroupe par 4
        this.value = spaced ? spaced.join(' ') : '';
    });
</script>
