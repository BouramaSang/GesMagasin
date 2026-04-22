 <?php
// src/Frontend/commandes/update_status.php
require_once '../../config/app.php';
requireAdmin();

$pdo = getPDO();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$new_status = isset($_GET['status']) ? $_GET['status'] : '';
$redirect_to = isset($_GET['redirect']) ? $_GET['redirect'] : 'view';

$allowed = ['en_attente', 'livree', 'annulee'];

if ($id <= 0 || !in_array($new_status, $allowed)) {
    header('Location: index_commande.php');
    exit();
}

// Récupérer les infos actuelles
$stmt = $pdo->prepare("SELECT statut, facture_id FROM commandes WHERE id = ?");
$stmt->execute([$id]);
$commande = $stmt->fetch();

if (!$commande) {
    header('Location: index_commande.php');
    exit();
}

$old_status = $commande['statut'];
$showNotification = false;

try {
    $pdo->beginTransaction();
    
    // ========== 1. GESTION DU STOCK ==========
    // Annulation : restaurer le stock
    if (($old_status === 'en_attente' && $new_status === 'annulee') ||
        ($old_status === 'livree' && $new_status === 'annulee')) {
        $stmt = $pdo->prepare("SELECT produit_id, quantite FROM detail_commande WHERE commande_id = ?");
        $stmt->execute([$id]);
        $details = $stmt->fetchAll();
        foreach ($details as $detail) {
            $pdo->prepare("UPDATE produits SET quantite = quantite + ? WHERE id = ?")
                ->execute([$detail['quantite'], $detail['produit_id']]);
        }
    }
    
    // Réactivation d'une annulée : re-déduire le stock
    if ($old_status === 'annulee' && $new_status === 'livree') {
        $stmt = $pdo->prepare("SELECT produit_id, quantite FROM detail_commande WHERE commande_id = ?");
        $stmt->execute([$id]);
        $details = $stmt->fetchAll();
        foreach ($details as $detail) {
            $pdo->prepare("UPDATE produits SET quantite = quantite - ? WHERE id = ?")
                ->execute([$detail['quantite'], $detail['produit_id']]);
        }
    }
    
    // ========== 2. GESTION DE LA FACTURE ==========
    if ($new_status === 'livree') {
        // Créer une facture si elle n'existe pas
        if (!$commande['facture_id']) {
            $num = 'FACT-' . date('Ymd') . '-' . str_pad($id, 4, '0', STR_PAD_LEFT);
            $stmt = $pdo->prepare("INSERT INTO factures (nomf, datef) VALUES (?, NOW())");
            $stmt->execute([$num]);
            $facture_id = $pdo->lastInsertId();
            $pdo->prepare("UPDATE commandes SET facture_id = ? WHERE id = ?")
                ->execute([$facture_id, $id]);
            $showNotification = true;
        }
    } else {
        // Si plus livrée, supprimer la facture
        if ($commande['facture_id']) {
            $pdo->prepare("DELETE FROM factures WHERE id = ?")->execute([$commande['facture_id']]);
            $pdo->prepare("UPDATE commandes SET facture_id = NULL WHERE id = ?")->execute([$id]);
        }
    }
    
    // ========== 3. METTRE À JOUR LE STATUT ==========
    $pdo->prepare("UPDATE commandes SET statut = ? WHERE id = ?")->execute([$new_status, $id]);
    
    $pdo->commit();
    
} catch (PDOException $e) {
    $pdo->rollBack();
}

// ========== 4. REDIRECTION INTELLIGENTE ==========
if ($redirect_to === 'facture' && $new_status === 'livree' && !$showNotification) {
    // Rediriger vers la facture si elle existe déjà
    $stmt = $pdo->prepare("SELECT facture_id FROM commandes WHERE id = ?");
    $stmt->execute([$id]);
    $facture_id = $stmt->fetchColumn();
    if ($facture_id) {
        header('Location: view_facture.php?id=' . $facture_id);
        exit();
    }
}

$redirect = 'view_commande.php?id=' . $id;
if ($showNotification) {
    $redirect .= '&facture=1';
}
header('Location: ' . $redirect);
exit();
?>