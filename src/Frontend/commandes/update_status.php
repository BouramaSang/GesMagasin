 <?php
// src/Frontend/commandes/update_status.php
require_once '../../config/app.php';
requireAdmin();

$pdo = getPDO();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$status = isset($_GET['status']) ? $_GET['status'] : '';

// 3 statuts seulement
$allowed = ['en_attente', 'livree', 'annulee'];

if ($id > 0 && in_array($status, $allowed)) {
    try {
        $pdo->beginTransaction();
        
        // Mettre à jour le statut
        $stmt = $pdo->prepare("UPDATE commandes SET statut = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        
        // Si la commande est livrée et n'a pas de facture, on en crée une
        if ($status === 'livree') {
            // Vérifier si une facture existe déjà
            $stmt = $pdo->prepare("SELECT id FROM factures WHERE commande_id = ?");
            $stmt->execute([$id]);
            $facture = $stmt->fetch();
            
            if (!$facture) {
                // Récupérer le total de la commande
                $stmt = $pdo->prepare("SELECT total_ttc FROM commandes WHERE id = ?");
                $stmt->execute([$id]);
                $commande = $stmt->fetch();
                
                // Générer un numéro de facture (nomf)
                $num = 'FACT-' . date('Ymd') . '-' . str_pad($id, 4, '0', STR_PAD_LEFT);
                
                // Insérer la facture
                $stmt = $pdo->prepare("
                    INSERT INTO factures (nomf, datef, commande_id, montant) 
                    VALUES (?, NOW(), ?, ?)
                ");
                $stmt->execute([$num, $id, $commande['total_ttc']]);
                $facture_id = $pdo->lastInsertId();
                
                // Lier la facture à la commande
                $stmt = $pdo->prepare("UPDATE commandes SET facture_id = ? WHERE id = ?");
                $stmt->execute([$facture_id, $id]);
            }
        }
        
        $pdo->commit();
        
    } catch (PDOException $e) {
        $pdo->rollBack();
        // Gérer l'erreur si besoin
    }
}

header('Location: view_commande.php?id=' . $id);
exit();