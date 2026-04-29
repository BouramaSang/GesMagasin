 <?php
// src/Frontend/commandes/delete_commande.php
require_once '../../config/app.php';
requireAdmin();

$pdo = getPDO();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index_commande.php');
    exit();
}

try {
    $pdo->beginTransaction();
    
    // Récupérer les produits de la commande pour restaurer le stock
    $stmt = $pdo->prepare("SELECT produit_id, quantite FROM detail_commande WHERE commande_id = ?");
    $stmt->execute([$id]);
    $details = $stmt->fetchAll();
    
    // Restaurer le stock pour chaque produit
    foreach ($details as $detail) {
        $stmt = $pdo->prepare("UPDATE produits SET quantite = quantite + ? WHERE id = ?");
        $stmt->execute([$detail['quantite'], $detail['produit_id']]);
    }
    
    // Supprimer les lignes de détail
    $stmt = $pdo->prepare("DELETE FROM detail_commande WHERE commande_id = ?");
    $stmt->execute([$id]);
    
    // Supprimer la commande
    $stmt = $pdo->prepare("DELETE FROM commandes WHERE id = ?");
    $stmt->execute([$id]);
    
    $pdo->commit();
    
} catch (PDOException $e) {
    $pdo->rollBack();
    // Gérer l'erreur si besoin
}

header('Location: index_commande.php');
exit();