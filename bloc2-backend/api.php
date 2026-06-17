<?php

require_once 'config.php';
require_once 'db.php';
require_once 'classes/Commande.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || empty($data['numero']) || !isset($data['total'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Données manquantes']);
    exit;
}

$commande = new Commande();
$commande_id = $commande->creer([
    'numero' => intval($data['numero'], 10),
    'total' => floatval($data['total'])
]);

echo json_encode(['ok' => true, 'id' => $commande_id]);
