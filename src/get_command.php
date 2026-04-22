 <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes | PowerStock</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="./assets/images/favicon_io/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeOutDown {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(20px); }
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }
        
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        .stat-card:hover::before {
            transform: scaleX(1);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        }
        .stat-card .icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            transition: transform 0.2s ease;
        }
        .stat-card:hover .icon {
            transform: scale(1.05);
        }
        .stat-card .value {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark);
            transition: color 0.3s ease;
        }
        .stat-card:hover .value {
            color: var(--primary);
        }
        .stat-card .label {
            font-size: 13px;
            color: #64748b;
        }
        
        /* Badges */
        .badge-en-attente {
            background: var(--warning);
            color: white;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }
        .badge-livree {
            background: var(--success);
            color: white;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }
        .badge-annulee {
            background: var(--danger);
            color: white;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }
        
        /* Filtres */
        .filter-bar {
            background: white;
            border-radius: 20px;
            padding: 16px 20px;
            margin-bottom: 24px;
            border: 1px solid var(--border);
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: space-between;
            align-items: center;
        }
        .filter-tabs {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .filter-tab {
            padding: 8px 20px;
            background: #f1f5f9;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .filter-tab.active, .filter-tab:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-1px);
        }
        
        .search-box {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 40px;
            padding: 4px 16px;
            gap: 8px;
        }
        .search-box input {
            border: none;
            background: transparent;
            padding: 8px;
            width: 220px;
            outline: none;
        }
        
        .date-filter input {
            border: 1px solid var(--border);
            border-radius: 40px;
            padding: 8px 12px;
            outline: none;
        }
        
        /* Tableau */
        .table-container {
            background: white;
            border-radius: 20px;
            border: 1px solid var(--border);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
        }
        th {
            background: #f8fafc;
            padding: 14px 16px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-bottom: 1px solid var(--border);
        }
        td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        .order-row {
            transition: background 0.2s ease;
        }
        .order-row:hover {
            background: #fef4f0;
        }
        
        /* Status select */
         .status-select {
    padding: 4px 6px;
    border-radius: 6px;
    border: 1px solid var(--border);
    font-size: 11px;
    background: white;
    cursor: pointer;
     min-width: 130px;
    width: auto;
    display: inline-block;
    vertical-align: middle;
    margin-left: 8px;
}
        /* Actions */
         .action-btn {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: white;
    border: 1px solid var(--border);
    cursor: pointer;
    transition: all 0.2s ease;
    color: #64748b;
    margin: 0 2px;
    vertical-align: middle;
}

        .action-btn:hover {
            transform: translateY(-2px);
        }
        .action-btn.view:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        .action-btn.edit:hover {
            background: var(--warning);
            color: white;
            border-color: var(--warning);
        }
        .action-btn.delete:hover {
            background: var(--danger);
            color: white;
            border-color: var(--danger);
        }
        .action-btn.invoice:hover {
            background: var(--success);
            color: white;
            border-color: var(--success);
        }
        .action-btn.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
            flex-wrap: wrap;
        }
        .page-item {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: white;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        .page-item:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }
        .page-item.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        .page-item.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        /* Bouton principal */
        .btn-primary-custom {
            background: var(--primary);
            border: none;
            padding: 8px 20px;
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
        
        /* Bulk bar */
        .bulk-bar {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            background: #1e293b;
            color: white;
            padding: 12px 28px;
            border-radius: 60px;
            display: flex;
            gap: 20px;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            font-weight: 500;
        }
        
        /* Modal */
        .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
        }
        .modal-header {
            border-radius: 20px 20px 0 0;
            padding: 16px 24px;
        }
        
        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-state i {
            font-size: 64px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }
        
        /* Product tags */
        .product-tag {
            background: #f1f5f9;
            color: var(--dark);
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 4px;
            margin-right: 4px;
            margin-bottom: 4px;
            display: inline-block;
            white-space: nowrap;
        }
        
        /* Responsive */
        @media (max-width: 1199px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }
            .filter-tabs {
                justify-content: center;
            }
            .search-box {
                width: 100%;
            }
            .search-box input {
                width: 100%;
            }
            .date-filter input {
                width: 100%;
            }
            .btn-primary-custom {
                width: 100%;
                justify-content: center;
            }
        }
        @media (max-width: 576px) {
            .pagination {
                justify-content: center;
            }
            .page-item {
                width: 34px;
                height: 34px;
                font-size: 13px;
            }
            .bulk-bar {
                padding: 10px 20px;
                gap: 12px;
                font-size: 13px;
                width: 90%;
                justify-content: center;
                flex-wrap: wrap;
                white-space: normal;
            }
        }
        
        .table td:nth-child(6) {
            white-space: nowrap !important;
        }
        .product-row-modal {
    background: #f8fafc;
    border-radius: 12px;
    padding: 12px;
    margin-bottom: 12px;
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
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
<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main id="content" class="content py-10">
    <div class="container-fluid px-4">
        
        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h1 class="fs-3 fw-bold mb-1">
                    <i class="fa-solid fa-cart-shopping me-2" style="color: var(--primary);"></i>
                    Commandes
                </h1>
                <p class="text-secondary mb-0 small">Gérez vos commandes et suivez leur statut</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary" id="exportBtn" style="border-radius: 10px;">
                    <i class="fa-solid fa-download me-2"></i>Exporter
                </button>
                <a href="add_command.php" class="btn-primary-custom">
                    <i class="fa-solid fa-plus"></i> Nouvelle commande
                </a>
            </div>
        </div>

        <!-- Cartes statistiques -->
        <div class="stats-grid">
            <div class="stat-card" data-filter="all">
                <div class="icon" style="background: rgba(230,98,57,0.1);">
                    <i class="fa-solid fa-cart-shopping" style="color: var(--primary); font-size: 24px;"></i>
                </div>
                <div class="value" id="totalCount">0</div>
                <div class="label">Total commandes</div>
            </div>
            <div class="stat-card" data-filter="attente">
                <div class="icon" style="background: rgba(245,158,11,0.1);">
                    <i class="fa-solid fa-clock" style="color: var(--warning); font-size: 24px;"></i>
                </div>
                <div class="value" id="pendingCount">0</div>
                <div class="label">En attente</div>
            </div>
            <div class="stat-card" data-filter="livree">
                <div class="icon" style="background: rgba(16,185,129,0.1);">
                    <i class="fa-solid fa-truck" style="color: var(--success); font-size: 24px;"></i>
                </div>
                <div class="value" id="deliveredCount">0</div>
                <div class="label">Livrées</div>
            </div>
            <div class="stat-card" data-filter="annulee">
                <div class="icon" style="background: rgba(239,68,68,0.1);">
                    <i class="fa-solid fa-circle-xmark" style="color: var(--danger); font-size: 24px;"></i>
                </div>
                <div class="value" id="cancelledCount">0</div>
                <div class="label">Annulées</div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="filter-bar">
            <div class="filter-tabs">
                <span class="filter-tab active" data-filter="all">Toutes</span>
                <span class="filter-tab" data-filter="attente">En attente</span>
                <span class="filter-tab" data-filter="livree">Livrées</span>
                <span class="filter-tab" data-filter="annulee">Annulées</span>
            </div>
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Client ou N° commande...">
            </div>
            <div class="date-filter">
                <input type="date" id="dateFilter" placeholder="Filtrer par date">
            </div>
        </div>

        <!-- Tableau -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 40px;"><input type="checkbox" id="selectAllCheckbox"></th>
                        <th>N° Commande</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Produits</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination" id="pagination"></div>
        
    </div>
</main>

<!-- Barre d'actions groupées -->
<div id="bulkBar" class="bulk-bar no-print" style="display: none;">
    <span id="selectedCount">0</span> sélectionnée(s)
    <select id="bulkStatusSelect" style="background: white; border: none; border-radius: 30px; padding: 6px 12px; font-size: 13px;">
        <option value="">Changer statut</option>
        <option value="attente">En attente</option>
        <option value="livree">Livrée</option>
        <option value="annulee">Annulée</option>
    </select>
    <button id="bulkDeleteBtn" style="background: var(--danger); border: none; color: white; border-radius: 30px; padding: 6px 18px;">
        <i class="fa-solid fa-trash"></i> Supprimer
    </button>
    <button id="closeBulkBtn" class="btn btn-sm btn-light" style="border-radius: 30px;">✕</button>
</div>

<!-- MODAL DÉTAIL COMMANDE -->
<div class="modal fade" id="viewOrderModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: var(--primary); color: white;">
                <h5 class="modal-title">
                    <i class="fa-solid fa-eye me-2"></i>
                    <span id="viewOrderNumber">Détail commande</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewOrderContent"></div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Fermer</button>
                <button type="button" class="btn-primary-custom" id="printOrderBtn">
                    <i class="fa-solid fa-print"></i> Imprimer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL MODIFIER COMMANDE -->
<div class="modal fade" id="editOrderModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: var(--warning); color: white;">
                <h5 class="modal-title">
                    <i class="fa-solid fa-pen me-2"></i>
                    Modifier la commande
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editOrderId">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Client</label>
                    <select class="form-select" id="editOrderClient" style="border-radius: 10px;" disabled>
                        <option value="">Sélectionner un client</option>
                    </select>
                    <small class="text-muted">Le client ne peut pas être modifié</small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Date de commande</label>
                    <input type="date" class="form-control" id="editOrderDate" style="border-radius: 10px;">
                </div>
                <label class="form-label fw-semibold">Produits</label>
                <div id="editProductsContainer"></div>
                <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="editAddProductBtn" style="border-radius: 8px;">
                    <i class="fa-solid fa-plus"></i> Ajouter un produit
                </button>
                <div class="mt-3 pt-3 text-end border-top">
                    <h4>Total : <span id="editGrandTotal" style="color: var(--warning);">0 FCFA</span></h4>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Annuler</button>
                <button type="button" class="btn btn-warning" id="updateOrderBtn" style="background: var(--warning); border: none; color: white; border-radius: 10px;">
                    <i class="fa-solid fa-save"></i> Mettre à jour
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CONFIRMATION -->
<div class="modal fade" id="softConfirmModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-body text-center p-4">
                <i class="fa-solid fa-circle-question" style="font-size: 50px; color: var(--warning); margin-bottom: 15px;"></i>
                <p id="confirmMessageText" class="mb-4" style="font-size: 16px;">Message</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal" style="border-radius: 30px;">Non</button>
                    <button class="btn btn-primary btn-sm px-4" id="confirmSoftBtn" style="background: var(--primary); border: none; border-radius: 30px;">Oui</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ========== DONNÉES ==========
let orders = JSON.parse(localStorage.getItem('ps_orders')) || [
    { id: 1, number: "CMD-2026-001", clientId: 1, clientName: "Sangare Salim", clientTel: "77-90-34-44", date: "2026-04-15", amount: 850000, status: "livree", products: [{name:"iPhone 14 Pro Max", qty:1, price:850000}], invoiceId: 1 },
    { id: 2, number: "CMD-2026-002", clientId: 2, clientName: "Keita Aminata", clientTel: "97-90-34-21", date: "2026-04-10", amount: 750000, status: "attente", products: [{name:"Samsung Galaxy S23", qty:1, price:750000}], invoiceId: null },
    { id: 3, number: "CMD-2026-003", clientId: 3, clientName: "Sidibe Rokia", clientTel: "77-30-34-31", date: "2026-04-05", amount: 425000, status: "livree", products: [{name:"HP Pavilion Core i5", qty:1, price:425000}], invoiceId: 3 },
    { id: 4, number: "CMD-2026-004", clientId: 4, clientName: "Keita Mamadou", clientTel: "77-90-34-21", date: "2026-03-28", amount: 450000, status: "annulee", products: [{name:"TV Samsung 55\"", qty:1, price:450000}], invoiceId: null },
    { id: 5, number: "CMD-2026-005", clientId: 5, clientName: "Traore Koura", clientTel: "75-45-36-21", date: "2026-03-20", amount: 130000, status: "attente", products: [{name:"Enceinte JBL", qty:2, price:65000}], invoiceId: null },
    { id: 6, number: "CMD-2026-006", clientId: 1, clientName: "Sangare Salim", clientTel: "77-90-34-44", date: "2026-03-15", amount: 320000, status: "livree", products: [{name:"AirPods Pro", qty:1, price:250000}, {name:"Coque iPhone", qty:2, price:35000}], invoiceId: 6 },
    { id: 7, number: "CMD-2026-007", clientId: 8, clientName: "Touré Aïssata", clientTel: "74-11-22-33", date: "2026-04-01", amount: 520000, status: "attente", products: [{name:"iPad Air", qty:1, price:520000}], invoiceId: null }
];

// Catalogue produits (simulation)
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
    { id: 12, nom: "Écran Dell 24\"", prix: 120000 }
];

let currentPage = 1;
let rowsPerPage = 5;
let currentFilter = "all";
let currentSearch = "";
let currentDate = "";
let selectedIds = [];

// ========== UTILITAIRES ==========
function saveData() {
    localStorage.setItem('ps_orders', JSON.stringify(orders));
    // Mettre à jour les stats clients
    updateClientsStats();
}

function updateClientsStats() {
    let clients = JSON.parse(localStorage.getItem('ps_clients')) || [];
    clients.forEach(client => {
        let clientOrders = orders.filter(o => o.clientId === client.id && o.status !== 'annulee');
        client.nbCommandes = clientOrders.length;
        client.totalCommandes = clientOrders.reduce((sum, o) => sum + o.amount, 0);
    });
    localStorage.setItem('ps_clients', JSON.stringify(clients));
}

function formatMoney(amount) {
    return new Intl.NumberFormat('fr-FR').format(amount) + ' FCFA';
}

function formatDate(dateStr) {
    return new Date(dateStr).toLocaleDateString('fr-FR');
}

function getBadge(status) {
    if (status === 'attente') return '<span class="badge-en-attente"><i class="fa-solid fa-clock"></i> En attente</span>';
    if (status === 'livree') return '<span class="badge-livree"><i class="fa-solid fa-check-circle"></i> Livrée</span>';
    return '<span class="badge-annulee"><i class="fa-solid fa-circle-xmark"></i> Annulée</span>';
}

function showToast(message, type = 'success') {
    let container = document.getElementById('toastContainer');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toastContainer';
        container.style.cssText = 'position: fixed; bottom: 30px; right: 30px; z-index: 9999; display: flex; flex-direction: column; gap: 10px;';
        document.body.appendChild(container);
    }
    
    let toast = document.createElement('div');
    let colors = { success: '#10b981', danger: '#ef4444', warning: '#f59e0b', info: '#E66239' };
    let bgColor = colors[type] || '#64748b';
    
    toast.style.cssText = `
        background: white;
        padding: 12px 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-left: 4px solid ${bgColor};
        display: flex;
        align-items: center;
        gap: 12px;
        animation: fadeInUp 0.3s ease;
        font-size: 14px;
    `;
    let icon = type === 'success' ? 'fa-check-circle' : (type === 'danger' ? 'fa-trash-can' : 'fa-info-circle');
    toast.innerHTML = `<i class="fa-solid ${icon}" style="color: ${bgColor};"></i> ${message}`;
    container.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'fadeOutDown 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 2500);
}

function generateOrderNumber() {
    let maxId = orders.length > 0 ? Math.max(...orders.map(o => o.id)) : 0;
    return `CMD-${new Date().getFullYear()}-${String(maxId + 1).padStart(3, '0')}`;
}

// ========== STATISTIQUES ==========
function updateStats() {
    document.getElementById('totalCount').innerText = orders.length;
    document.getElementById('pendingCount').innerText = orders.filter(o => o.status === 'attente').length;
    document.getElementById('deliveredCount').innerText = orders.filter(o => o.status === 'livree').length;
    document.getElementById('cancelledCount').innerText = orders.filter(o => o.status === 'annulee').length;
}

// ========== RENDU TABLEAU ==========
 function renderTable() {
    let filtered = orders.filter(o => {
        if (currentFilter !== 'all' && o.status !== currentFilter) return false;
        if (currentSearch && !o.number.toLowerCase().includes(currentSearch) && !o.clientName.toLowerCase().includes(currentSearch)) return false;
        if (currentDate && o.date !== currentDate) return false;
        return true;
    });
    
    filtered.sort((a, b) => new Date(b.date) - new Date(a.date));
    
    let totalPages = Math.ceil(filtered.length / rowsPerPage);
    let start = (currentPage - 1) * rowsPerPage;
    let paginated = filtered.slice(start, start + rowsPerPage);
    
    let tbody = document.getElementById('tableBody');
    tbody.innerHTML = '';
    
    if (paginated.length === 0) {
        tbody.innerHTML = `<tr><td colspan="8"><div class="empty-state">
            <i class="fa-solid fa-box-open"></i>
            <h5 class="mt-3">Aucune commande trouvée</h5>
            <p class="text-secondary">Essayez de modifier vos filtres</p>
        </div></td></tr>`;
    } else {
        paginated.forEach(o => {
            let productsList = o.products.map(p => `${p.name} (${p.qty})`).join(', ');
            let productsTags = o.products.map(p => `<span class="product-tag">${p.name} (${p.qty})</span>`).join('');
            
            let editDisabled = o.status === 'livree' ? 'disabled' : '';
            
            tbody.innerHTML += `
                <tr class="order-row">
                    <td><input type="checkbox" class="orderCheckbox" value="${o.id}"></td>
                    <td><strong style="color: var(--primary);">#${o.number}</strong></td>
                    <td>
                        <strong>${o.clientName}</strong><br>
                        <small class="text-muted">${o.clientTel}</small>
                    </td>
                    <td>${formatDate(o.date)}</td>
                    <td title="${productsList}">${productsTags}</td>
                    <td class="fw-bold" style="color: var(--primary);">${formatMoney(o.amount)}</td>
                    <td style="white-space: nowrap;">
                        ${getBadge(o.status)}
                         <select class="status-select" onchange="changeStatus(${o.id}, this.value)">
    <option value="">Changer statut</option>
    <option value="attente">🟡 En attente</option>
    <option value="livree">🟢 Livrée</option>
    <option value="annulee">🔴 Annulée</option>
</select>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <div class="action-btn view" onclick="viewOrder(${o.id})" title="Voir">
                                <i class="fa-regular fa-eye"></i>
                            </div>
                            <div class="action-btn edit ${editDisabled}" onclick="${o.status !== 'livree' ? `editOrder(${o.id})` : ''}" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </div>
                            <div class="action-btn delete" onclick="deleteOrder(${o.id})" title="Supprimer">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                            ${o.invoiceId ? `
                                <div class="action-btn invoice" onclick="window.location.href='factures.php'" title="Voir facture">
                                    <i class="fa-regular fa-file-lines"></i>
                                </div>
                            ` : ''}
                        </div>
                    </td>
                </tr>
            `;
        });
    }
    
    // Pagination
    let pag = document.getElementById('pagination');
    pag.innerHTML = '';
    
    if (totalPages > 1) {
        pag.innerHTML += `<div class="page-item ${currentPage === 1 ? 'disabled' : ''}" data-page="${currentPage - 1}">
            <i class="fa-solid fa-chevron-left"></i>
        </div>`;
        
        for (let i = 1; i <= totalPages; i++) {
            pag.innerHTML += `<div class="page-item ${currentPage === i ? 'active' : ''}" data-page="${i}">${i}</div>`;
        }
        
        pag.innerHTML += `<div class="page-item ${currentPage === totalPages ? 'disabled' : ''}" data-page="${currentPage + 1}">
            <i class="fa-solid fa-chevron-right"></i>
        </div>`;
        
        document.querySelectorAll('#pagination .page-item').forEach(el => {
            el.addEventListener('click', function() {
                let p = parseInt(this.dataset.page);
                if (p >= 1 && p <= totalPages) {
                    currentPage = p;
                    renderTable();
                }
            });
        });
    }
    
    updateStats();
    updateBulkBar();
}
// ========== ACTIONS ==========
window.changeStatus = function(id, newStatus) {
    if (!newStatus) return;
    
    let order = orders.find(o => o.id === id);
    if (order) {
        order.status = newStatus;
        saveData();
        renderTable();
        showToast(`Commande #${order.number} : ${newStatus}`, 'success');
    }
};

window.viewOrder = function(id) {
    let order = orders.find(o => o.id === id);
    if (!order) return;
    
    let productsHtml = order.products.map((p, idx) => `
        <tr>
            <td class="text-center">${idx + 1}</td>
            <td>${p.name}</td>
            <td class="text-end">${formatMoney(p.price)}</td>
            <td class="text-center">${p.qty}</td>
            <td class="text-end">${formatMoney(p.price * p.qty)}</td>
        </tr>
    `).join('');
    
    document.getElementById('viewOrderNumber').innerText = `Détail commande #${order.number}`;
    document.getElementById('viewOrderContent').innerHTML = `
        <div class="p-3">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="bg-light p-3 rounded-3">
                        <p class="detail-label mb-2">Client</p>
                        <p class="mb-1"><strong>${order.clientName}</strong></p>
                        <p class="mb-0 text-muted">${order.clientTel}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-light p-3 rounded-3">
                        <p class="detail-label mb-2">Informations</p>
                        <p class="mb-1"><strong>Date :</strong> ${formatDate(order.date)}</p>
                        <p class="mb-0"><strong>Statut :</strong> ${getBadge(order.status)}</p>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Produit</th>
                            <th class="text-end">Prix unitaire</th>
                            <th class="text-center">Qté</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>${productsHtml}</tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">TOTAL</td>
                            <td class="text-end fw-bold" style="color: var(--primary);">${formatMoney(order.amount)}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    `;
    
    new bootstrap.Modal(document.getElementById('viewOrderModal')).show();
};

window.deleteOrder = function(id) {
    let order = orders.find(o => o.id === id);
    document.getElementById('confirmMessageText').innerHTML = `Supprimer la commande <strong>#${order.number}</strong> ?`;
    
    let modal = new bootstrap.Modal(document.getElementById('softConfirmModal'));
    modal.show();
    
    let confirmBtn = document.getElementById('confirmSoftBtn');
    let handler = () => {
        orders = orders.filter(o => o.id !== id);
        if (orders.length === 0 && currentPage > 1) currentPage--;
        saveData();
        renderTable();
        showToast(`Commande #${order.number} supprimée`, 'danger');
        confirmBtn.removeEventListener('click', handler);
        modal.hide();
    };
    confirmBtn.removeEventListener('click', handler);
    confirmBtn.addEventListener('click', handler);
};

// ========== BULK BAR ==========
function updateBulkBar() {
    selectedIds = Array.from(document.querySelectorAll('.orderCheckbox:checked')).map(cb => parseInt(cb.value));
    let bar = document.getElementById('bulkBar');
    if (selectedIds.length >= 2) {
        document.getElementById('selectedCount').innerText = selectedIds.length;
        bar.style.display = 'flex';
    } else {
        bar.style.display = 'none';
    }
}

document.getElementById('selectAllCheckbox')?.addEventListener('change', function() {
    document.querySelectorAll('.orderCheckbox').forEach(cb => cb.checked = this.checked);
    updateBulkBar();
});

document.getElementById('tableBody')?.addEventListener('change', function(e) {
    if (e.target && e.target.classList.contains('orderCheckbox')) {
        updateBulkBar();
    }
});

document.getElementById('bulkStatusSelect')?.addEventListener('change', function() {
    let newStatus = this.value;
    if (!newStatus) return;
    
    selectedIds.forEach(id => {
        let order = orders.find(o => o.id === id);
        if (order) order.status = newStatus;
    });
    
    saveData();
    renderTable();
    showToast(`${selectedIds.length} commandes → ${newStatus}`, 'success');
    document.getElementById('closeBulkBtn').click();
    this.value = '';
});

document.getElementById('bulkDeleteBtn')?.addEventListener('click', () => {
    document.getElementById('confirmMessageText').innerHTML = `Supprimer ${selectedIds.length} commande(s) ?`;
    
    let modal = new bootstrap.Modal(document.getElementById('softConfirmModal'));
    modal.show();
    
    let confirmBtn = document.getElementById('confirmSoftBtn');
    let handler = () => {
        orders = orders.filter(o => !selectedIds.includes(o.id));
        if (orders.length === 0 && currentPage > 1) currentPage--;
        saveData();
        renderTable();
        showToast(`${selectedIds.length} commande(s) supprimée(s)`, 'danger');
        document.getElementById('closeBulkBtn').click();
        confirmBtn.removeEventListener('click', handler);
        modal.hide();
    };
    confirmBtn.removeEventListener('click', handler);
    confirmBtn.addEventListener('click', handler);
});

document.getElementById('closeBulkBtn')?.addEventListener('click', () => {
    document.querySelectorAll('.orderCheckbox').forEach(cb => cb.checked = false);
    document.getElementById('selectAllCheckbox').checked = false;
    document.getElementById('bulkBar').style.display = 'none';
});

// ========== FILTRES ==========
document.querySelectorAll('.filter-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        currentFilter = this.dataset.filter;
        currentPage = 1;
        renderTable();
    });
});

document.querySelectorAll('.stat-card').forEach(card => {
    card.addEventListener('click', function() {
        let filter = this.dataset.filter;
        if (filter) {
            document.querySelectorAll('.filter-tab').forEach(tab => {
                if (tab.dataset.filter === filter) tab.classList.add('active');
                else tab.classList.remove('active');
            });
            currentFilter = filter;
            currentPage = 1;
            renderTable();
        }
    });
});

document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
    currentSearch = e.target.value.toLowerCase();
    currentPage = 1;
    renderTable();
});

document.getElementById('dateFilter')?.addEventListener('change', function(e) {
    currentDate = e.target.value;
    currentPage = 1;
    renderTable();
});
// ========== MODIFIER COMMANDE ==========
window.editOrder = function(id) {
    let order = orders.find(o => o.id === id);
    if (!order || order.status === 'livree') return;
    
    // Remplir le modal
    document.getElementById('editOrderId').value = order.id;
    document.getElementById('editOrderDate').value = order.date;
    
    // Remplir le select client (désactivé)
    let clientSelect = document.getElementById('editOrderClient');
    clientSelect.innerHTML = `<option value="${order.clientId}">${order.clientName} - ${order.clientTel}</option>`;
    clientSelect.value = order.clientId;
    
    // Remplir les produits
    let container = document.getElementById('editProductsContainer');
    container.innerHTML = '';
    
    order.products.forEach(p => {
        addEditProductRow(p.name, p.price, p.qty);
    });
    
    recalcEditTotal();
    
    new bootstrap.Modal(document.getElementById('editOrderModal')).show();
};

// Fonction pour ajouter une ligne produit dans le modal d'édition
function addEditProductRow(productName = '', productPrice = 0, productQty = 1) {
    let container = document.getElementById('editProductsContainer');
    
    let row = document.createElement('div');
    row.className = 'product-row-modal';
    row.innerHTML = `
        <select class="form-select product-select-edit" style="flex: 2; min-width: 200px;">
            <option value="">Choisir un produit</option>
            ${catalogueProduits.map(p => `<option value="${p.id}" data-price="${p.prix}" data-name="${p.nom}" ${p.nom === productName ? 'selected' : ''}>${p.nom} - ${formatMoney(p.prix)}</option>`).join('')}
        </select>
        <input type="number" class="form-control qty-edit" value="${productQty}" min="1" style="width: 100px;">
        <input type="text" class="form-control line-total-edit" readonly style="width: 130px; background: #f1f5f9;" value="${productPrice ? formatMoney(productPrice * productQty) : '0 FCFA'}">
        <i class="fa-solid fa-trash remove-product-edit" style="cursor: pointer; color: var(--danger); font-size: 20px;"></i>
    `;
    
    container.appendChild(row);
    
    let select = row.querySelector('.product-select-edit');
    let qty = row.querySelector('.qty-edit');
    let remove = row.querySelector('.remove-product-edit');
    
    select.addEventListener('change', () => recalcEditTotal());
    qty.addEventListener('input', () => recalcEditTotal());
    remove.addEventListener('click', () => {
        row.remove();
        recalcEditTotal();
    });
}

function recalcEditTotal() {
    let total = 0;
    document.querySelectorAll('#editProductsContainer .product-row-modal').forEach(row => {
        let select = row.querySelector('.product-select-edit');
        let price = parseInt(select.options[select.selectedIndex]?.dataset.price || 0);
        let qty = parseInt(row.querySelector('.qty-edit').value) || 0;
        let lineTotal = row.querySelector('.line-total-edit');
        if (lineTotal) lineTotal.value = formatMoney(price * qty);
        total += price * qty;
    });
    document.getElementById('editGrandTotal').innerHTML = formatMoney(total);
}

// Bouton ajouter produit dans modal édition
document.getElementById('editAddProductBtn')?.addEventListener('click', () => {
    addEditProductRow();
});

// Bouton mettre à jour
document.getElementById('updateOrderBtn')?.addEventListener('click', () => {
    let id = parseInt(document.getElementById('editOrderId').value);
    let order = orders.find(o => o.id === id);
    if (!order) return;
    
    order.date = document.getElementById('editOrderDate').value;
    
    // Récupérer les produits
    let products = [];
    let total = 0;
    
    document.querySelectorAll('#editProductsContainer .product-row-modal').forEach(row => {
        let select = row.querySelector('.product-select-edit');
        if (!select.value) return;
        
        let name = select.options[select.selectedIndex]?.dataset.name;
        let price = parseInt(select.options[select.selectedIndex]?.dataset.price || 0);
        let qty = parseInt(row.querySelector('.qty-edit').value) || 0;
        
        if (name && qty > 0) {
            products.push({ name, qty, price });
            total += price * qty;
        }
    });
    
    if (products.length === 0) {
        showToast('Ajoutez au moins un produit', 'warning');
        return;
    }
    
    order.products = products;
    order.amount = total;
    
    saveData();
    renderTable();
    
    bootstrap.Modal.getInstance(document.getElementById('editOrderModal')).hide();
    showToast(`Commande #${order.number} modifiée`, 'success');
});
// ========== EXPORT ==========
document.getElementById('exportBtn')?.addEventListener('click', function() {
    let csv = "N° Commande,Client,Téléphone,Date,Produits,Montant,Statut\n";
    orders.forEach(o => {
        let products = o.products.map(p => `${p.name} (${p.qty})`).join('; ');
        csv += `"${o.number}","${o.clientName}","${o.clientTel}","${o.date}","${products}","${o.amount}","${o.status}"\n`;
    });
    
    let blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    let link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = `commandes_${new Date().toISOString().split('T')[0]}.csv`;
    link.click();
    showToast("Export CSV réussi", 'success');
});

// ========== INITIALISATION ==========
renderTable();
</script>
</body>
</html>