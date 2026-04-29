<?php
require_once '../../config/app.php';
requireAdmin();

$pdo = getPDO();
$stats = $pdo->query("
    SELECT 
        COUNT(*) as total,
        SUM(CASE WHEN statut = 'en_attente' THEN 1 ELSE 0 END) as attente,
        SUM(CASE WHEN statut = 'livree' THEN 1 ELSE 0 END) as livree,
        SUM(CASE WHEN statut = 'annulee' THEN 1 ELSE 0 END) as annulee
    FROM commandes
")->fetch();

header('Content-Type: application/json');
echo json_encode($stats);