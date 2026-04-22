 <?php
// src/Frontend/commandes/edit_commande.php
require_once '../../config/app.php';
requireAdmin();

$pdo = getPDO();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';
$success = '';

if ($id <= 0) {
    header('Location: index_commande.php');
    exit();
}

// Récupérer la commande
$stmt = $pdo->prepare("SELECT * FROM commandes WHERE id = ?");
$stmt->execute([$id]);
$commande = $stmt->fetch();

if (!$commande) {
    header('Location: index_commande.php');
    exit();
}

// Récupérer les produits de la commande
$stmt = $pdo->prepare("
    SELECT d.*, p.nomp, p.prix, p.quantite as stock
    FROM detail_commande d
    LEFT JOIN produits p ON d.produit_id = p.id
    WHERE d.commande_id = ?
");
$stmt->execute([$id]);
$details = $stmt->fetchAll();

// Récupérer les clients et produits pour les selects
$clients = $pdo->query("SELECT id, nomc, prenom, tel, email, adresse FROM clients ORDER BY nomc")->fetchAll();
$produits = $pdo->query("SELECT id, nomp, prix, quantite FROM produits ORDER BY nomp")->fetchAll();

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = (int)$_POST['client_id'];
    $date_commande = $_POST['date_commande'];
    $produits_json = $_POST['produits_json'];
    
    if ($client_id <= 0) {
        $error = "Veuillez sélectionner un client";
    } elseif (empty($produits_json)) {
        $error = "Ajoutez au moins un produit";
    } else {
        $items = json_decode($produits_json, true);
        $total = 0;
        $stock_ok = true;
        
        // Vérifier les stocks pour les nouveaux produits
        foreach ($items as $item) {
            $stmt = $pdo->prepare("SELECT prix, quantite FROM produits WHERE id = ?");
            $stmt->execute([$item['id']]);
            $pdt = $stmt->fetch();
            if (!$pdt) {
                $error = "Produit introuvable";
                $stock_ok = false;
                break;
            }
            // Vérifier le stock (en tenant compte des anciennes quantités)
            $ancienne_qty = 0;
            foreach ($details as $old) {
                if ($old['produit_id'] == $item['id']) {
                    $ancienne_qty = $old['quantite'];
                    break;
                }
            }
            $stock_necessaire = $item['qty'] - $ancienne_qty;
            if ($stock_necessaire > 0 && $pdt['quantite'] < $stock_necessaire) {
                $error = "Stock insuffisant pour le produit (Stock: {$pdt['quantite']})";
                $stock_ok = false;
                break;
            }
            $total += $pdt['prix'] * $item['qty'];
        }
        
        if ($stock_ok && empty($error)) {
            try {
                $pdo->beginTransaction();
                
                // Mettre à jour la commande
                $stmt = $pdo->prepare("
                    UPDATE commandes 
                    SET client_id = ?, date_commande = ?, total_ttc = ?
                    WHERE id = ?
                ");
                $stmt->execute([$client_id, $date_commande, $total, $id]);
                
                // Restaurer les anciens stocks
                foreach ($details as $old) {
                    $stmt = $pdo->prepare("UPDATE produits SET quantite = quantite + ? WHERE id = ?");
                    $stmt->execute([$old['quantite'], $old['produit_id']]);
                }
                
                // Supprimer les anciennes lignes
                $stmt = $pdo->prepare("DELETE FROM detail_commande WHERE commande_id = ?");
                $stmt->execute([$id]);
                
                // Insérer les nouvelles lignes
                foreach ($items as $item) {
                    $stmt = $pdo->prepare("SELECT prix FROM produits WHERE id = ?");
                    $stmt->execute([$item['id']]);
                    $prix = $stmt->fetchColumn();
                    
                    $stmt = $pdo->prepare("
                        INSERT INTO detail_commande (commande_id, produit_id, quantite, prix_unitaire) 
                        VALUES (?, ?, ?, ?)
                    ");
                    $stmt->execute([$id, $item['id'], $item['qty'], $prix]);
                    
                    // Mettre à jour le nouveau stock
                    $stmt = $pdo->prepare("UPDATE produits SET quantite = quantite - ? WHERE id = ?");
                    $stmt->execute([$item['qty'], $item['id']]);
                }
                
                $pdo->commit();
                $success = "Commande modifiée avec succès !";
                
            } catch (PDOException $e) {
                $pdo->rollBack();
                $error = "Erreur : " . $e->getMessage();
            }
        }
    }
}

$page_title = 'Modifier commande';
include '../../sidebar.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier commande #<?= $id ?> | PowerStock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        :root { --primary: #E66239; --border: #e2e8f0; }
        .card-custom { background: white; border-radius: 20px; border: 1px solid var(--border); overflow: hidden; }
        .btn-primary-custom { background: var(--primary); border: none; padding: 10px 24px; border-radius: 12px; color: white; font-weight: 500; transition: all 0.2s ease; }
        .btn-primary-custom:hover { background: #d5542e; transform: translateY(-2px); }
        .btn-outline-custom { background: white; border: 1.5px solid var(--border); padding: 10px 24px; border-radius: 12px; color: #64748b; transition: all 0.2s ease; }
        .btn-outline-custom:hover { border-color: var(--primary); color: var(--primary); }
        .btn-add-product { background: #f59e0b; border: none; padding: 10px 20px; border-radius: 10px; color: white; font-weight: 500; }
        .btn-add-product:hover { background: #e67e22; transform: translateY(-1px); }
        .product-row { background: #f8fafc; border-radius: 12px; padding: 12px; margin-bottom: 12px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
        .remove-product { cursor: pointer; color: #ef4444; font-size: 20px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; }
        .remove-product:hover { background: rgba(239,68,68,0.1); }
        .total-section { background: #f8fafc; border-left: 4px solid var(--primary); border-radius: 12px; padding: 20px; }
        .form-select, .form-control { border-radius: 10px; border: 1px solid var(--border); padding: 10px 14px; }
        .client-info-card { background: #f8fafc; border-radius: 16px; padding: 20px; margin-bottom: 24px; }
        .stock-out { color: #9ca3af; }
        .stock-low { color: #f59e0b; }
        @media (max-width: 768px) {
            .product-row { flex-direction: column; align-items: stretch; }
            .product-row select, .product-row input { width: 100% !important; }
        }
    </style>
</head>
<body>

<main id="content" class="content py-10">
    <div class="container-fluid px-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h1 class="fs-3 fw-bold mb-1"><i class="fa-solid fa-pen me-2" style="color: var(--primary);"></i>Modifier commande #<?= $id ?></h1>
                <p class="text-secondary mb-0 small">Modifiez les informations de la commande</p>
            </div>
            <a href="index_commande.php" class="btn-outline-custom"><i class="fa-solid fa-arrow-left"></i> Retour</a>
        </div>

        <?php if($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <?php if($success): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success) ?>
                <script>setTimeout(function() { window.location.href = 'view_commande.php?id=<?= $id ?>'; }, 1500);</script>
            </div>
        <?php endif; ?>

        <div class="card-custom">
            <div class="p-4">
                <form id="orderForm" method="POST">
                    
                    <div class="client-info-card">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fa-solid fa-user me-2" style="color: var(--primary);"></i>Client</label>
                                <select class="form-select" id="clientSelect" name="client_id" required>
                                    <option value="">Sélectionner un client...</option>
                                    <?php foreach($clients as $c): ?>
                                        <option value="<?= $c['id'] ?>" <?= $c['id'] == $commande['client_id'] ? 'selected' : '' ?> data-tel="<?= htmlspecialchars($c['tel']) ?>" data-adresse="<?= htmlspecialchars($c['adresse']) ?>">
                                            <?= htmlspecialchars($c['prenom'] . ' ' . $c['nomc']) ?> - <?= $c['tel'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"><i class="fa-solid fa-calendar me-2" style="color: var(--primary);"></i>Date de commande</label>
                                <input type="date" class="form-control" name="date_commande" value="<?= $commande['date_commande'] ?>" required>
                            </div>
                        </div>
                        <div id="clientInfo" class="mt-3" style="display: <?= $commande['client_id'] ? 'block' : 'none' ?>">
                            <div class="d-flex gap-3">
                                <span class="badge" style="background:var(--primary);color:white"><i class="fa-solid fa-phone me-1"></i><span id="selectedClientTel"></span></span>
                                <span class="badge" style="background:#64748b;color:white"><i class="fa-solid fa-location-dot me-1"></i><span id="selectedClientAdresse"></span></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-semibold mb-0"><i class="fa-solid fa-box me-2" style="color: var(--primary);"></i>Produits commandés</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table" id="tableProduits">
                            <thead><tr><th style="width:40%">Produit</th><th style="width:15%">Prix unitaire</th><th style="width:15%">Quantité</th><th style="width:20%">Total</th><th style="width:10%"></th></tr></thead>
                            <tbody id="orderBody"></tbody>
                        </table>
                    </div>

                    <div id="emptyMsg" class="empty-state d-none text-center py-5" style="border:2px dashed var(--border); border-radius:16px;">
                        <i class="fa-solid fa-cart-shopping fa-2x mb-3" style="color:#cbd5e1"></i>
                        <h5>Aucun produit</h5>
                        <p class="text-secondary">Cliquez sur "Ajouter un produit"</p>
                    </div>

                    <div class="mt-3">
                        <button type="button" class="btn-add-product" id="btnAddProduct"><i class="fa-solid fa-plus me-2"></i>Ajouter un produit</button>
                    </div>

                    <div class="row mt-4 justify-content-end">
                        <div class="col-md-5 col-lg-4">
                            <div class="total-section">
                                <div class="d-flex justify-content-between mb-2"><span class="text-secondary">Sous-total :</span><span id="sousTotal" class="fw-semibold">0 FCFA</span></div>
                                <hr class="my-3">
                                <div class="d-flex justify-content-between align-items-center"><span class="fw-bold">TOTAL</span><span class="fs-4 fw-bold" style="color: var(--primary);"><span id="totalNet">0</span> FCFA</span></div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="produits_json" id="produits_json">
                    
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="view_commande.php?id=<?= $id ?>" class="btn-outline-custom"><i class="fa-solid fa-times"></i> Annuler</a>
                        <button type="submit" id="btnSubmit" class="btn-primary-custom"><i class="fa-solid fa-check-circle me-2"></i>Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
const produits = <?= json_encode($produits) ?>;
const existingDetails = <?= json_encode($details) ?>;

function formatMoney(amount) { return new Intl.NumberFormat('fr-FR').format(amount) + ' FCFA'; }
function getStockClass(stock) { if(stock <= 0) return 'stock-out'; if(stock < 5) return 'stock-low'; return ''; }
function getStockLabel(stock) { if(stock <= 0) return '⚠️ RUPTURE'; if(stock < 5) return '⚠️ Stock: ' + stock; return 'Stock: ' + stock; }

// Client info
document.getElementById('clientSelect').addEventListener('change', function() {
    const opt = this.options[this.selectedIndex];
    if(this.value) {
        document.getElementById('selectedClientTel').innerText = opt.dataset.tel || 'Non renseigné';
        document.getElementById('selectedClientAdresse').innerText = opt.dataset.adresse || 'Non renseignée';
        document.getElementById('clientInfo').style.display = 'block';
    } else {
        document.getElementById('clientInfo').style.display = 'none';
    }
});
if (document.getElementById('clientSelect').value) {
    const opt = document.getElementById('clientSelect').options[document.getElementById('clientSelect').selectedIndex];
    document.getElementById('selectedClientTel').innerText = opt?.dataset.tel || 'Non renseigné';
    document.getElementById('selectedClientAdresse').innerText = opt?.dataset.adresse || 'Non renseignée';
}

// Gestion produits
const orderBody = document.getElementById('orderBody');
const emptyMsg = document.getElementById('emptyMsg');
const btnAdd = document.getElementById('btnAddProduct');

function ajouterLigne(pid='', qty=1, price=0) {
    emptyMsg.classList.add('d-none');
    const tr = document.createElement('tr');
    tr.className = 'ligne-produit-dynamique';
    
    let options = '<option value="">-- Sélectionner --</option>';
    produits.forEach(p => {
        const stockClass = getStockClass(p.quantite);
        const stockLabel = getStockLabel(p.quantite);
        options += `<option value="${p.id}" data-prix="${p.prix}" data-stock="${p.quantite}" class="${stockClass}" ${p.id == pid ? 'selected' : ''}>${p.nomp} - ${formatMoney(p.prix)} (${stockLabel})</option>`;
    });
    
    tr.innerHTML = `
        <td><select class="form-select selector-produit" required>${options}</select></td>
        <td><input type="text" class="form-control text-center bg-light prix-u" value="${price ? formatMoney(price) : '0 FCFA'}" readonly></td>
        <td><input type="number" class="form-control text-center qte" value="${qty}" min="1"></td>
        <td class="text-end fw-semibold"><span class="total-ligne">${price ? formatMoney(price * qty) : '0 FCFA'}</span></td>
        <td class="text-center"><div class="remove-product"><i class="fa-solid fa-trash-alt"></i></div></td>
    `;
    
    orderBody.appendChild(tr);
    updateLineTotal(tr);
}

function updateLineTotal(row) {
    const select = row.querySelector('.selector-produit');
    const prix = parseFloat(select.options[select.selectedIndex]?.dataset.prix || 0);
    const stock = parseInt(select.options[select.selectedIndex]?.dataset.stock || 0);
    let qte = parseInt(row.querySelector('.qte').value) || 0;
    
    if (!select.value) {
        row.querySelector('.prix-u').value = '0 FCFA';
        row.querySelector('.total-ligne').innerText = '0 FCFA';
        return 0;
    }
    
    if (qte > stock && stock > 0) { 
        qte = stock; 
        row.querySelector('.qte').value = stock; 
        showToast(`Stock limité à ${stock}`); 
    }
    if (stock <= 0 && qte > 0) { 
        qte = 0; 
        row.querySelector('.qte').value = 0; 
        showToast('Produit en rupture'); 
    }
    
    row.querySelector('.prix-u').value = prix ? formatMoney(prix) : '0 FCFA';
    row.querySelector('.total-ligne').innerText = formatMoney(prix * qte);
    return prix * qte;
}

function calculerTotaux() {
    let total = 0, hasProducts = false;
    document.querySelectorAll('.ligne-produit-dynamique').forEach(row => {
        const select = row.querySelector('.selector-produit');
        if (select && select.value) {
            hasProducts = true;
            const prix = parseFloat(select.options[select.selectedIndex]?.dataset.prix || 0);
            const qte = parseInt(row.querySelector('.qte').value) || 0;
            total += prix * qte;
        }
    });
    document.getElementById('sousTotal').innerText = formatMoney(total);
    document.getElementById('totalNet').innerText = new Intl.NumberFormat('fr-FR').format(total);
    document.getElementById('btnSubmit').disabled = !hasProducts;
    
    const items = [];
    document.querySelectorAll('.ligne-produit-dynamique').forEach(row => {
        const select = row.querySelector('.selector-produit');
        if (select && select.value) {
            items.push({ id: parseInt(select.value), qty: parseInt(row.querySelector('.qte').value) || 0 });
        }
    });
    document.getElementById('produits_json').value = JSON.stringify(items);
}

function showToast(msg) {
    let t = document.createElement('div');
    t.style.cssText = 'position:fixed;bottom:30px;right:30px;background:#1e293b;color:white;padding:10px 20px;border-radius:40px;font-size:13px;z-index:9999;animation:fadeIn 0.3s ease';
    t.innerText = msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 2500);
}

orderBody.addEventListener('input', function(e) {
    const row = e.target.closest('.ligne-produit-dynamique');
    if (row && (e.target.classList.contains('selector-produit') || e.target.classList.contains('qte'))) {
        updateLineTotal(row);
        calculerTotaux();
    }
});

orderBody.addEventListener('click', function(e) {
    const btn = e.target.closest('.remove-product');
    if (btn) {
        const row = btn.closest('.ligne-produit-dynamique');
        row.style.transform = "translateX(20px)"; row.style.opacity = "0"; row.style.transition = "all 0.3s ease";
        setTimeout(() => { row.remove(); if(orderBody.children.length === 0) emptyMsg.classList.remove('d-none'); calculerTotaux(); }, 300);
    }
});

btnAdd.addEventListener('click', () => ajouterLigne());

// Charger les produits existants
existingDetails.forEach(d => {
    ajouterLigne(d.produit_id, d.quantite, d.prix_unitaire);
});

if (existingDetails.length === 0) {
    ajouterLigne();
}

document.getElementById('orderForm').addEventListener('submit', function(e) {
    if (!document.getElementById('clientSelect').value) {
        e.preventDefault();
        showToast('Sélectionnez un client');
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>