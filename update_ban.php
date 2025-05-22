<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email']) || !isset($data['role'])) {
    echo json_encode(['success' => false, 'error' => 'Données manquantes']);
    exit;
}

$email = $data['email'];
$newRole = $data['role'];

$usersFile = 'data/users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

$found = false;
foreach ($users as &$user) {
    if ($user['email'] === $email) {
        if ($user['role'] === 'administrator') {
            echo json_encode(['success' => false, 'error' => "Impossible de bannir des admin"]);
            exit;
        }

        $user['role'] = $newRole;
        $found = true;
        break;
    }
}


if ($found) {
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Utilisateur non trouvé']);
}
