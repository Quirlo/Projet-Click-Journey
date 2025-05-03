<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user']['email'])) {
    echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !is_array($data)) {
    echo json_encode(['success' => false, 'error' => 'Données invalides']);
    exit;
}

$email = $_SESSION['user']['email'];
$usersFile = 'data/users.json';

if (!file_exists($usersFile)) {
    echo json_encode(['success' => false, 'error' => 'Fichier introuvable']);
    exit;
}

$users = json_decode(file_get_contents($usersFile), true);
$found = false;

foreach ($users as &$user) {
    if ($user['email'] === $email) {
        // Validation email côté serveur
        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'error' => 'Email invalide']);
            exit;
}

        foreach ($data as $field => $value) {
            if ($field === 'email') {
                $user['email'] = $value;
            } elseif (in_array($field, ['name', 'nickname', 'address'])) {
                $user['personal_info'][$field] = $value;
            }
        }
        $_SESSION['user'] = $user;
        $found = true;
        break;
    }
}

if ($found) {
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Utilisateur introuvable']);
}
