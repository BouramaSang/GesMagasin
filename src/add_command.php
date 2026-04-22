 <!DOCTYPE html>  
<html lang="fr">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Nouvelle commande | PowerStock</title>  
     
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/favicon_io/apple-touch-icon.png"> 
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon_io/favicon-32x32.png"> 
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon_io/favicon-16x16.png"> 
     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">  
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
     
    <style>  
        :root {  
            --primary: #E66239;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --dark: #1e293b;
            --border: #e2e8f0;
        }  
 
        body {  
            background-color: #f8f9fa;  
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;  
        }  
 
        .page-header {
            margin-bottom: 28px;
        }
        
        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
        }
        
        /* Boutons */
        .btn-primary-custom {
            background: var(--primary);
            border: none;
            padding: 10px 24px;
            border-radius: 12px;
            color: white;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }
        .btn-primary-custom:hover {
            background: #d5542e;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 98, 57, 0.3);
            color: white;
        }
        
        .btn-outline-custom {
            background: white;
            border: 1.5px solid var(--border);
            padding: 10px 24px;
            border-radius: 12px;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }
        .btn-outline-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(230, 98, 57, 0.05);
        }
        
        .btn-add-product {
            background: var(--warning);
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
        }
        .btn-add-product:hover {
            background: #e67e22;
            transform: translateY(-1px);
            color: white;
        }
         
        .card-custom { 
            background: white;
            border: none; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); 
            border-radius: 20px; 
            border: 1px solid var(--border);
            overflow: hidden;
        }  
         
        .table-order thead { 
            background: #f8fafc;
        }  
        .table-order th { 
            font-weight: 600; 
            padding: 14px 16px; 
            border: none; 
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #64748b;
        } 
        .table-order td {
            padding: 14px 16px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border);
        }
         
        .total-section {  
            background: #f8fafc;  
            border-left: 4px solid var(--primary);  
            border-radius: 12px;
            padding: 20px;
        }  
 
        .ligne-produit-dynamique { 
            animation: fadeIn 0.4s ease-out; 
        } 
 
        @keyframes fadeIn { 
            from { opacity: 0; transform: translateY(10px); } 
            to { opacity: 1; transform: translateY(0); } 
        } 
 
        .empty-state { 
            padding: 40px; 
            text-align: center; 
            color: #95a5a6; 
            border: 2px dashed var(--border); 
            border-radius: 16px; 
            background: #fafafa;
        } 
        
        .remove-product {
            cursor: pointer;
            color: var(--danger);
            font-size: 18px;
            transition: all 0.2s ease;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
        .remove-product:hover {
            background: rgba(239, 68, 68, 0.1);
            transform: scale(1.1);
        }
        
        .form-select, .form-control {
            border-radius: 10px;
            border: 1px solid var(--border);
            padding: 10px 14px;
        }
        .form-select:focus, .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(230, 98, 57, 0.1);
        }
        
        .client-info-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
        }
        
        /* Toast */
        .toast-notification {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            background: white;
            padding: 12px 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-left: 4px solid;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .btn-primary-custom, .btn-outline-custom {
                width: 100%;
                justify-content: center;
            }
            .table-order {
                min-width: 700px;
            }
        }
    </style>  
</head>  
<body>  
 
<!-- TOPBAR -->
<nav id="topbar" class="navbar bg-white border-bottom fixed-top topbar px-3 no-print">
    <button id="toggleBtn" class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm">
        <i class="ti ti-layout-sidebar-left-expand"></i>
    </button>
    <button id="mobileBtn" class="btn btn-light btn-icon btn-sm d-lg-none me-2">
        <i class="ti ti-layout-sidebar-left-expand"></i>
    </button>
    <div class="ms-auto">
        <ul class="list-unstyled d-flex align-items-center mb-0 gap-2">
            <li>
                <a class="btn btn-light btn-icon btn-sm rounded-circle position-relative" href="#">
                    <i class="ti ti-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2 ms-n2">3</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" role="button" data-bs-toggle="dropdown">
                    <img src="./assets/images/avatar/avatar-1.jpg" alt="" class="avatar avatar-sm rounded-circle" />
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 200px;">
                    <div class="d-flex gap-3 align-items-center border-bottom px-3 py-3">
                        <img src="./assets/images/avatar/avatar-1.jpg" alt="" class="avatar avatar-md rounded-circle" />
                        <div>
                            <h4 class="mb-0 small fw-semibold">Admin User</h4>
                            <p class="mb-0 small text-secondary">@admin</p>
                        </div>
                    </div>
                    <div class="p-3 d-flex flex-column gap-1 small">
                        <a href="#" class="text-decoration-none text-dark py-1">Mon profil</a>
                        <a href="#" class="text-decoration-none text-dark py-1">Paramètres</a>
                        <a href="#" class="text-decoration-none text-dark py-1">Déconnexion</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- SIDEBAR -->
<?php include 'sidebar.php';?>

<!-- MAIN CONTENT -->
<main id="content" class="content py-10">
    <div class="container-fluid px-4">
        
        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h1 class="fs-3 fw-bold mb-1">
                    <i class="fa-solid fa-cart-plus me-2" style="color: var(--primary);"></i>
                    Nouvelle commande
                </h1>
                <p class="text-secondary mb-0 small">Saisie des ventes PowerStock</p>
            </div>
            <a href="get_command.php" class="btn-outline-custom">
                <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
        </div>

        <!-- Formulaire -->
        <div class="card-custom">
            <div class="p-4">
                <form id="orderForm">  
                    <!-- Sélection client -->
                    <div class="client-info-card">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa-solid fa-user me-2" style="color: var(--primary);"></i>Client
                                </label>
                                <select class="form-select" id="clientSelect" required>  
                                    <option value="">Sélectionner un client...</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa-solid fa-calendar me-2" style="color: var(--primary);"></i>Date de commande
                                </label>
                                <input type="date" class="form-control" id="orderDate" required>
                            </div>
                        </div>
                        <!-- Infos client (affichées après sélection) -->
                        <div id="clientInfo" class="mt-3" style="display: none;">
                            <div class="d-flex gap-3">
                                <span class="badge" style="background: var(--primary); color: white;">
                                    <i class="fa-solid fa-phone me-1"></i><span id="selectedClientTel"></span>
                                </span>
                                <span class="badge" style="background: #64748b; color: white;">
                                    <i class="fa-solid fa-location-dot me-1"></i><span id="selectedClientAdresse"></span>
                                </span>
                            </div>
                        </div>
                    </div>
         
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-semibold mb-0">
                            <i class="fa-solid fa-box me-2" style="color: var(--primary);"></i>Produits commandés
                        </h5>
                    </div>

                    <!-- Tableau des produits -->
                    <div class="table-responsive">  
                        <table class="table table-order" id="tableProduits">  
                            <thead>  
                                <tr>  
                                    <th style="width: 40%;">Produit</th>  
                                    <th style="width: 15%;" class="text-center">Prix unitaire</th>  
                                    <th style="width: 15%;" class="text-center">Quantité</th>  
                                    <th style="width: 20%;" class="text-end">Total</th>  
                                    <th style="width: 10%;"></th>  
                                </tr>  
                            </thead>  
                            <tbody id="orderBody"></tbody>  
                        </table>  
                    </div>  
 
                    <div id="emptyMsg" class="empty-state d-none"> 
                        <i class="fa-solid fa-cart-shopping fa-2x mb-3" style="color: #cbd5e1;"></i>
                        <h5 class="fw-semibold">Aucun produit</h5>
                        <p class="text-secondary mb-3">Cliquez sur "Ajouter un produit" pour commencer</p>
                    </div>

                    <!-- Bouton Ajouter un produit EN BAS -->
                    <div class="mt-3">
                        <button type="button" class="btn-add-product" id="btnAddProduct">
                            <i class="fa-solid fa-plus me-2"></i>Ajouter un produit
                        </button>
                    </div>
         
                    <!-- Totaux -->
                    <div class="row mt-4 justify-content-end">  
                        <div class="col-md-5 col-lg-4">  
                            <div class="total-section">  
                                <div class="d-flex justify-content-between mb-2">  
                                    <span class="text-secondary">Sous-total :</span>  
                                    <span id="sousTotal" class="fw-semibold">0 FCFA</span>  
                                </div>  
                                <div class="d-flex justify-content-between mb-2">  
                                    <span class="text-secondary">TVA (18%) :</span>  
                                    <span id="tva" class="fw-semibold">0 FCFA</span>  
                                </div>  
                                <hr class="my-3">  
                                <div class="d-flex justify-content-between align-items-center">  
                                    <span class="fw-bold">TOTAL NET</span>  
                                    <span class="fs-4 fw-bold" style="color: var(--primary);"><span id="totalNet">0</span> FCFA</span>  
                                </div>  
                            </div>  
                        </div>  
                    </div>  
         
                    <!-- Actions -->
                    <div class="d-flex gap-2 justify-content-end mt-4">  
                        <a href="get_command.php" class="btn-outline-custom">  
                            <i class="fa-solid fa-times"></i> Annuler  
                        </a>
                        <button type="submit" id="btnSubmit" class="btn-primary-custom">  
                            <i class="fa-solid fa-check-circle me-2"></i>Valider la commande  
                        </button>  
                    </div>  
                </form>  
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>  

<script>
// ========== DONNÉES ==========
const catalogueProduits = [  
    { id: 1, nom: "iPhone 14 Pro Max", prix: 850000 },  
    { id: 2, nom: "Samsung Galaxy S23", prix: 750000 },  
    { id: 3, nom: "HP Pavilion Core i5", prix: 425000 },  
    { id: 4, nom: 'TV Samsung 55"', prix: 450000 },  
    { id: 5, nom: "Enceinte JBL", prix: 65000 },  
    { id: 6, nom: "AirPods Pro", prix: 250000 },  
    { id: 7, nom: "Coque iPhone", prix: 35000 },  
    { id: 8, nom: "iPad Air", prix: 520000 },  
    { id: 9, nom: "MacBook Air M2", prix: 950000 },  
    { id: 10, nom: "Clavier Logitech MX", prix: 65000 },  
    { id: 11, nom: "Souris Sans Fil Pro", prix: 15000 },  
    { id: 12, nom: 'Écran Dell 24"', prix: 120000 }  
];

// Clients depuis localStorage
function getClients() {
    let stored = localStorage.getItem('ps_clients');
    return stored ? JSON.parse(stored) : [];
}

// Commandes existantes
function getOrders() {
    let stored = localStorage.getItem('ps_orders');
    return stored ? JSON.parse(stored) : [];
}

function saveOrders(orders) {
    localStorage.setItem('ps_orders', JSON.stringify(orders));
}

function formatMoney(amount) { 
    return new Intl.NumberFormat('fr-FR').format(amount) + ' FCFA'; 
}

function showToast(message, type = 'success') {
    let existingToast = document.querySelector('.toast-notification');
    if(existingToast) existingToast.remove();
    
    let toast = document.createElement('div');
    let colors = { success: '#10b981', danger: '#ef4444', warning: '#f59e0b' };
    toast.className = 'toast-notification';
    toast.style.borderLeftColor = colors[type] || '#E66239';
    let icon = type === 'success' ? 'fa-check-circle' : (type === 'danger' ? 'fa-exclamation-circle' : 'fa-info-circle');
    toast.innerHTML = `<i class="fa-solid ${icon}" style="color: ${colors[type]};"></i> ${message}`;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        toast.style.transition = 'all 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

function generateOrderNumber() {
    let orders = getOrders();
    let maxId = orders.length > 0 ? Math.max(...orders.map(o => o.id)) : 0;
    return `CMD-${new Date().getFullYear()}-${String(maxId + 1).padStart(3, '0')}`;
}

// ========== INITIALISATION CLIENTS ==========
function initClientSelect() {
    let clients = getClients();
    let select = document.getElementById('clientSelect');
    
    clients.filter(c => c.statut === 'actif').forEach(client => {
        let option = document.createElement('option');
        option.value = client.id;
        option.textContent = client.nom;
        option.dataset.tel = client.telephone || '';
        option.dataset.adresse = client.adresse || '';
        select.appendChild(option);
    });
    
    let urlParams = new URLSearchParams(window.location.search);
    let clientId = urlParams.get('client');
    if (clientId) {
        select.value = clientId;
        updateClientInfo();
    }
}

function updateClientInfo() {
    let select = document.getElementById('clientSelect');
    let selectedOption = select.options[select.selectedIndex];
    let infoDiv = document.getElementById('clientInfo');
    
    if (select.value) {
        document.getElementById('selectedClientTel').textContent = selectedOption.dataset.tel || 'Non renseigné';
        document.getElementById('selectedClientAdresse').textContent = selectedOption.dataset.adresse || 'Non renseignée';
        infoDiv.style.display = 'block';
    } else {
        infoDiv.style.display = 'none';
    }
}

document.getElementById('clientSelect').addEventListener('change', updateClientInfo);

// Date du jour
let today = new Date().toISOString().split('T')[0];
document.getElementById('orderDate').value = today;

// ========== GESTION PRODUITS ==========
const orderBody = document.getElementById('orderBody'); 
const emptyMsg = document.getElementById('emptyMsg'); 
const btnAdd = document.getElementById('btnAddProduct');

function ajouterLigne() { 
    emptyMsg.classList.add('d-none'); 
    const tr = document.createElement('tr'); 
    tr.className = "ligne-produit-dynamique"; 
     
    tr.innerHTML = `  
        <td>  
            <select class="form-select selector-produit" required>  
                <option value="">-- Sélectionner un produit --</option>  
                ${catalogueProduits.map(p => `<option value="${p.id}" data-price="${p.prix}" data-name="${p.nom}">${p.nom}</option>`).join('')}  
            </select>  
        </td>  
        <td>  
            <input type="text" class="form-control text-center bg-light prix-u" value="0 FCFA" readonly>  
        </td>  
        <td>  
            <input type="number" class="form-control text-center qte" value="1" min="1">  
        </td>  
        <td class="text-end fw-semibold">  
            <span class="total-ligne">0 FCFA</span>
        </td>  
        <td class="text-center">  
            <div class="remove-product">  
                <i class="fa-solid fa-trash-alt"></i>  
            </div>  
        </td>  
    `;  
    orderBody.appendChild(tr); 
} 

btnAdd.addEventListener('click', ajouterLigne);

// Event delegation
orderBody.addEventListener('input', function(e) { 
    const target = e.target; 
    const tr = target.closest('tr'); 
 
    if (target.classList.contains('selector-produit')) { 
        const selectedOption = target.options[target.selectedIndex];
        const prix = selectedOption.dataset.price || 0; 
        tr.querySelector('.prix-u').value = formatMoney(parseInt(prix));
    } 
 
    calculerTotaux(); 
}); 

orderBody.addEventListener('click', function(e) { 
    const btn = e.target.closest('.remove-product'); 
    if (btn) { 
        const tr = btn.closest('tr'); 
        tr.style.transform = "translateX(20px)"; 
        tr.style.opacity = "0"; 
        tr.style.transition = "all 0.3s ease";
        setTimeout(() => { 
            tr.remove(); 
            if(orderBody.children.length === 0) emptyMsg.classList.remove('d-none'); 
            calculerTotaux(); 
        }, 300); 
    } 
}); 

function calculerTotaux() {  
    let cumulHT = 0;  
    const lignes = document.querySelectorAll('.ligne-produit-dynamique');  
    let hasProducts = false;
  
    lignes.forEach(ligne => {  
        const select = ligne.querySelector('.selector-produit');
        if (!select || !select.value) return;
        
        hasProducts = true;
        const selectedOption = select.options[select.selectedIndex];
        const pu = parseInt(selectedOption?.dataset.price) || 0;  
        const qte = parseInt(ligne.querySelector('.qte').value) || 0;  
        const totalLigne = pu * qte;  
          
        ligne.querySelector('.total-ligne').innerText = formatMoney(totalLigne);  
        cumulHT += totalLigne;  
    });  
  
    const tva = cumulHT * 0.18;  
    const net = cumulHT + tva;  
  
    document.getElementById('sousTotal').innerText = formatMoney(cumulHT);  
    document.getElementById('tva').innerText = formatMoney(tva);  
    document.getElementById('totalNet').innerText = new Intl.NumberFormat('fr-FR').format(net);
    
    document.getElementById('btnSubmit').disabled = !hasProducts;
} 

// ========== VALIDATION ==========
document.getElementById('orderForm').addEventListener('submit', function(e) { 
    e.preventDefault(); 
    
    let clientSelect = document.getElementById('clientSelect');
    if (!clientSelect.value) {
        showToast('Veuillez sélectionner un client', 'danger');
        return;
    }
    
    let products = [];
    let hasValidProduct = false;
    
    document.querySelectorAll('.ligne-produit-dynamique').forEach(row => {
        const select = row.querySelector('.selector-produit');
        if (!select || !select.value) return;
        
        const selectedOption = select.options[select.selectedIndex];
        const name = selectedOption.dataset.name;
        const price = parseInt(selectedOption.dataset.price);
        const qty = parseInt(row.querySelector('.qte').value) || 0;
        
        if (name && qty > 0) {
            products.push({ name, qty, price });
            hasValidProduct = true;
        }
    });
    
    if (!hasValidProduct) {
        showToast('Ajoutez au moins un produit valide', 'danger');
        return;
    }
    
    let orders = getOrders();
    let clients = getClients();
    
    let selectedOption = clientSelect.options[clientSelect.selectedIndex];
    let clientId = parseInt(clientSelect.value);
    let clientName = selectedOption.textContent;
    let clientTel = selectedOption.dataset.tel;
    
    let total = parseInt(document.getElementById('totalNet').innerText.replace(/\s/g, '')) || 0;
    
    let newOrder = {
        id: orders.length > 0 ? Math.max(...orders.map(o => o.id)) + 1 : 1,
        number: generateOrderNumber(),
        clientId: clientId,
        clientName: clientName,
        clientTel: clientTel,
        date: document.getElementById('orderDate').value,
        amount: total,
        status: 'attente',
        products: products,
        invoiceId: null
    };
    
    orders.push(newOrder);
    saveOrders(orders);
    
    let client = clients.find(c => c.id === clientId);
    if (client) {
        client.nbCommandes = (client.nbCommandes || 0) + 1;
        client.totalCommandes = (client.totalCommandes || 0) + total;
        localStorage.setItem('ps_clients', JSON.stringify(clients));
    }
    
    showToast(`Commande #${newOrder.number} créée avec succès`, 'success');
    
    setTimeout(() => {
        window.location.href = 'get_command.php';
    }, 1500);
});

// ========== INITIALISATION ==========
initClientSelect();
ajouterLigne();
</script>

<script src="./assets/js/main.js" type="module"></script>
</body>  
</html>