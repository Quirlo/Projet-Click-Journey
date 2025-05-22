<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo json_encode(["success" => false, "message" => "Non connecté."]);
    exit();
}



// Si envoi JSON brut via fetch
$input = json_decode($_POST['recap_data'], true);

// ✅ On force uniquement si le champ n'existe pas déjà
if (!isset($input['prix_total'])) {
    $input['prix_total'] = $_POST['prix_total'] ?? '0';
}



// Si c’est un formulaire POST classique (comme dans recapitulatif.php)
if (!$input && isset($_POST['recap_data'])) {
    $input = json_decode($_POST['recap_data'], true);
    $input['prix_total'] = $_POST['prix_total'] ?? '0'; // ✅ ajoute cette ligne ici
}




// Vérification des données
if (!isset($input['trip_id']) || !isset($input['custom_options']) || !isset($input['prix_total'])) {
    echo json_encode(["success" => false, "message" => "Données invalides."]);
    exit();
}


// Ajout dans le panier
$_SESSION['panier'][] = [
    'trip_id' => $input['trip_id'],
    'custom_options' => $input['custom_options'],
    "prix_total" => floatval($input['prix_total'])
];

// Si appelé via formulaire, on redirige
if (isset($_POST['recap_data'])) {
    header("Location: panier.php");
    exit();
}

// Sinon, c’est un appel AJAX
echo json_encode(["success" => true]);
