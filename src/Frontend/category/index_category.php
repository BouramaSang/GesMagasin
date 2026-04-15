<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Categories - InApp Inventory Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="180x180" href="../../assets/images/favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../assets/images/favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon_io/favicon-16x16.png">
  <link rel="manifest" href="../../assets/images/favicon_io/site.webmanifest">
  <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/style.css">
  
  <style>
    :root {
      --primary-color: #E66239;
      --primary-light: rgba(230, 98, 57, 0.1);
      --primary-hover: rgba(230, 98, 57, 0.05);
    }

    .page-header {
      margin-bottom: 24px;
    }

    .page-title {
      font-size: 24px;
      font-weight: 600;
      color: #1a1a2e;
      margin-bottom: 4px;
    }

    .btn-primary-custom {
      background: var(--primary-color);
      border: none;
      color: white;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 500;
      font-size: 14px;
      transition: all 0.2s ease;
    }

    .btn-primary-custom:hover {
      background: #d4552e;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(230, 98, 57, 0.3);
    }

    .btn-outline-custom {
      background: white;
      border: 1.5px solid #e0e0e8;
      color: #555;
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 500;
      font-size: 14px;
      transition: all 0.2s ease;
    }

    .btn-outline-custom:hover {
      border-color: var(--primary-color);
      color: var(--primary-color);
      background: var(--primary-hover);
    }

    .category-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
    }

    .category-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
      transition: all 0.25s ease;
      border: 1px solid #f0f0f5;
      position: relative;
    }

    .category-card:hover {
      box-shadow: 0 8px 24px rgba(230, 98, 57, 0.12);
      border-color: var(--primary-color);
    }

    .category-image {
      height: 140px;
      overflow: hidden;
      position: relative;
    }

    .category-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .category-card:hover .category-image img {
      transform: scale(1.05);
    }

    .category-badge {
      position: absolute;
      top: 12px;
      right: 12px;
      background: rgba(255,255,255,0.95);
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
      color: #333;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      backdrop-filter: blur(4px);
    }

    .category-content {
      padding: 16px;
    }

    .category-header {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 8px;
    }

    .category-icon {
      width: 36px;
      height: 36px;
      background: var(--primary-light);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary-color);
    }

    .category-icon i {
      font-size: 20px;
    }

    .category-info {
      flex: 1;
    }

    .category-name {
      font-size: 16px;
      font-weight: 600;
      color: #1a1a2e;
      margin-bottom: 2px;
    }

    .category-count {
      font-size: 12px;
      color: #888;
    }

    .category-stats {
      display: flex;
      gap: 16px;
      margin-top: 12px;
      padding-top: 12px;
      border-top: 1px solid #f0f0f5;
    }

    .stat {
      flex: 1;
    }

    .stat-value {
      font-size: 16px;
      font-weight: 600;
      color: #1a1a2e;
    }

    .stat-label {
      font-size: 11px;
      color: #999;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    /* Actions visibles uniquement au hover */
    .category-actions {
      position: absolute;
      bottom: 16px;
      right: 16px;
      display: flex;
      gap: 6px;
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.25s ease;
    }

    .category-card:hover .category-actions {
      opacity: 1;
      transform: translateY(0);
    }

    .action-btn {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      border: 1px solid #e0e0e8;
      color: #666;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 14px;
    }

    .action-btn:hover {
      transform: scale(1.05);
    }

    .action-btn.view:hover {
      background: var(--primary-color);
      border-color: var(--primary-color);
      color: white;
    }

    .action-btn.edit:hover {
      background: #f39c12;
      border-color: #f39c12;
      color: white;
    }

    .action-btn.delete:hover {
      background: #e74c3c;
      border-color: #e74c3c;
      color: white;
    }

    .search-bar {
      background: white;
      border-radius: 10px;
      padding: 4px 4px 4px 16px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
      border: 1.5px solid #f0f0f5;
      display: flex;
      align-items: center;
    }

    .search-bar input {
      border: none;
      background: transparent;
      padding: 10px 0;
      font-size: 14px;
    }

    .search-bar input:focus {
      outline: none;
      box-shadow: none;
    }

    .search-bar button {
      background: var(--primary-color);
      border: none;
      color: white;
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 13px;
    }

    .filter-tabs {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .filter-tab {
      padding: 6px 14px;
      background: #f8f9fa;
      border-radius: 8px;
      font-size: 13px;
      color: #666;
      cursor: pointer;
      transition: all 0.2s ease;
      border: 1px solid transparent;
    }

    .filter-tab:hover,
    .filter-tab.active {
      background: var(--primary-light);
      color: var(--primary-color);
      border-color: var(--primary-color);
    }

    @media (max-width: 768px) {
      .category-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Animation notification */
    @keyframes slideIn {
      from { transform: translateX(100%); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
      from { transform: translateX(0); opacity: 1; }
      to { transform: translateX(100%); opacity: 0; }
    }
  </style>
</head>

<body>
  <div id="overlay" class="overlay"></div>
  
  <!-- TOPBAR -->
  <nav id="topbar" class="navbar bg-white border-bottom fixed-top topbar px-3">
    <button id="toggleBtn" class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm ">
      <i class="ti ti-layout-sidebar-left-expand"></i>
    </button>

    <button id="mobileBtn" class="btn btn-light btn-icon btn-sm d-lg-none me-2">
      <i class="ti ti-layout-sidebar-left-expand"></i>
    </button>
    
    <div>
      <ul class="list-unstyled d-flex align-items-center mb-0 gap-1">
        <li>
          <a class="position-relative btn-icon btn-sm btn-light btn rounded-circle" data-bs-toggle="dropdown"
            aria-expanded="false" href="#" role="button">
            <i class="ti ti-bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2 ms-n2">
              3
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-0">
            <ul class="list-unstyled p-0 m-0">
              <li class="p-3 border-bottom">
                <div class="d-flex gap-3">
                  <img src="../../assets/images/avatar/avatar-1.jpg" alt="" class="avatar avatar-sm rounded-circle" />
                  <div class="flex-grow-1 small">
                    <p class="mb-0 fw-medium">Nouvelle commande</p>
                    <p class="mb-1 text-secondary">Commande #12345</p>
                    <div class="text-secondary small">5 minutes</div>
                  </div>
                </div>
              </li>
              <li class="p-3 border-bottom">
                <div class="d-flex gap-3">
                  <img src="../../assets/images/avatar/avatar-4.jpg" alt="" class="avatar avatar-sm rounded-circle" />
                  <div class="flex-grow-1 small">
                    <p class="mb-0 fw-medium">Nouvel utilisateur</p>
                    <p class="mb-1 text-secondary">@john_doe s'est inscrit</p>
                    <div class="text-secondary small">30 minutes</div>
                  </div>
                </div>
              </li>
              <li class="px-4 py-3 text-center">
                <a href="#" class="text-primary small fw-medium">Voir toutes les notifications</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="ms-3 dropdown">
          <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../assets/images/avatar/avatar-1.jpg" alt="" class="avatar avatar-sm rounded-circle" />
          </a>
          <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 200px;">
            <div>
              <div class="d-flex gap-3 align-items-center border-bottom px-3 py-3">
                <img src="../../assets/images/avatar/avatar-1.jpg" alt="" class="avatar avatar-md rounded-circle" />
                <div>
                  <h4 class="mb-0 small fw-semibold">Admin User</h4>
                  <p class="mb-0 small text-secondary">@admin</p>
                </div>
              </div>
              <div class="p-3 d-flex flex-column gap-1 small">
                <a href="#!" class="text-decoration-none text-dark py-1">Mon profil</a>
                <a href="#!" class="text-decoration-none text-dark py-1">Paramètres</a>
                <a href="#!" class="text-decoration-none text-dark py-1">Déconnexion</a>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <!-- SIDEBAR -->
  <?php include '../../sidebar.php'; ?>

  <!-- MAIN CONTENT -->
  <main id="content" class="content py-10">
    <div class="container-fluid px-4">
      
      <!-- En-tête -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h1 class="page-title">
              <i class="ti ti-category me-2" style="color: var(--primary-color);"></i>
              Catégories Électroniques
            </h1>
            <p class="text-secondary mb-0 small">Gérez vos catégories de produits high-tech</p>
          </div>
          <div class="col-md-6">
            <div class="d-flex gap-3 justify-content-md-end mt-3 mt-md-0">
              <div class="search-bar flex-grow-1" style="max-width: 280px;">
                <i class="ti ti-search text-secondary me-2"></i>
                <input type="text" class="form-control-plaintext" placeholder="Rechercher...">
                <button><i class="ti ti-search"></i></button>
              </div>
              <button class="btn-primary-custom d-flex align-items-center gap-2">
                <i class="ti ti-plus"></i>
                <span class="d-none d-sm-inline">Nouvelle</span>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Filtres -->
      <div class="filter-tabs mb-4">
        <span class="filter-tab active">Toutes</span>
        <span class="filter-tab">Smartphones</span>
        <span class="filter-tab">Ordinateurs</span>
        <span class="filter-tab">Audio</span>
        <span class="filter-tab">Tablettes</span>
        <span class="filter-tab">Accessoires</span>
      </div>

      <!-- Grille de catégories -->
      <div class="category-grid">
        
        <!-- Catégorie 1 : Smartphones -->
        <div class="category-card">
          <div class="category-image">
            <img src="https://images.pexels.com/photos/47261/pexels-photo-47261.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Smartphones">
            <span class="category-badge">24 produits</span>
          </div>
          <div class="category-content">
            <div class="category-header">
              <div class="category-icon">
                <i class="ti ti-device-mobile"></i>
              </div>
              <div class="category-info">
                <div class="category-name">Smartphones</div>
                <div class="category-count">iPhone, Samsung, Google Pixel</div>
              </div>
            </div>
            <div class="category-stats">
              <div class="stat">
                <div class="stat-value">1,234</div>
                <div class="stat-label">En stock</div>
              </div>
              <div class="stat">
                <div class="stat-value">€89.2k</div>
                <div class="stat-label">Valeur</div>
              </div>
            </div>
          </div>
          <div class="category-actions">
            <div class="action-btn view" onclick="viewCategory('Smartphones')" title="Voir">
              <i class="ti ti-eye"></i>
            </div>
            <div class="action-btn edit" onclick="editCategory('Smartphones')" title="Modifier">
              <i class="ti ti-edit"></i>
            </div>
            <div class="action-btn delete" onclick="deleteCategory('Smartphones')" title="Supprimer">
              <i class="ti ti-trash"></i>
            </div>
          </div>
        </div>

        <!-- Catégorie 2 : Ordinateurs Portables -->
        <div class="category-card">
          <div class="category-image">
            <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=600" alt="Ordinateurs">
            <span class="category-badge">32 produits</span>
          </div>
          <div class="category-content">
            <div class="category-header">
              <div class="category-icon">
                <i class="ti ti-device-laptop"></i>
              </div>
              <div class="category-info">
                <div class="category-name">Ordinateurs Portables</div>
                <div class="category-count">MacBook, Dell XPS, Lenovo</div>
              </div>
            </div>
            <div class="category-stats">
              <div class="stat">
                <div class="stat-value">856</div>
                <div class="stat-label">En stock</div>
              </div>
              <div class="stat">
                <div class="stat-value">€156k</div>
                <div class="stat-label">Valeur</div>
              </div>
            </div>
          </div>
          <div class="category-actions">
            <div class="action-btn view" onclick="viewCategory('Ordinateurs')" title="Voir">
              <i class="ti ti-eye"></i>
            </div>
            <div class="action-btn edit" onclick="editCategory('Ordinateurs')" title="Modifier">
              <i class="ti ti-edit"></i>
            </div>
            <div class="action-btn delete" onclick="deleteCategory('Ordinateurs')" title="Supprimer">
              <i class="ti ti-trash"></i>
            </div>
          </div>
        </div>

        <!-- Catégorie 3 : Audio & Casques -->
        <div class="category-card">
          <div class="category-image">
            <img src="https://images.pexels.com/photos/1649771/pexels-photo-1649771.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Audio">
            <span class="category-badge">56 produits</span>
          </div>
          <div class="category-content">
            <div class="category-header">
              <div class="category-icon">
                <i class="ti ti-headphones"></i>
              </div>
              <div class="category-info">
                <div class="category-name">Audio & Casques</div>
                <div class="category-count">AirPods, Sony, Bose, JBL</div>
              </div>
            </div>
            <div class="category-stats">
              <div class="stat">
                <div class="stat-value">2,450</div>
                <div class="stat-label">En stock</div>
              </div>
              <div class="stat">
                <div class="stat-value">€45.8k</div>
                <div class="stat-label">Valeur</div>
              </div>
            </div>
          </div>
          <div class="category-actions">
            <div class="action-btn view" onclick="viewCategory('Audio')" title="Voir">
              <i class="ti ti-eye"></i>
            </div>
            <div class="action-btn edit" onclick="editCategory('Audio')" title="Modifier">
              <i class="ti ti-edit"></i>
            </div>
            <div class="action-btn delete" onclick="deleteCategory('Audio')" title="Supprimer">
              <i class="ti ti-trash"></i>
            </div>
          </div>
        </div>

        <!-- Catégorie 4 : Tablettes -->
        <div class="category-card">
          <div class="category-image">
            <img src="https://images.pexels.com/photos/1334597/pexels-photo-1334597.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Tablettes">
            <span class="category-badge">18 produits</span>
          </div>
          <div class="category-content">
            <div class="category-header">
              <div class="category-icon">
                <i class="ti ti-device-ipad"></i>
              </div>
              <div class="category-info">
                <div class="category-name">Tablettes</div>
                <div class="category-count">iPad Pro, Galaxy Tab, Surface</div>
              </div>
            </div>
            <div class="category-stats">
              <div class="stat">
                <div class="stat-value">678</div>
                <div class="stat-label">En stock</div>
              </div>
              <div class="stat">
                <div class="stat-value">€62.3k</div>
                <div class="stat-label">Valeur</div>
              </div>
            </div>
          </div>
          <div class="category-actions">
            <div class="action-btn view" onclick="viewCategory('Tablettes')" title="Voir">
              <i class="ti ti-eye"></i>
            </div>
            <div class="action-btn edit" onclick="editCategory('Tablettes')" title="Modifier">
              <i class="ti ti-edit"></i>
            </div>
            <div class="action-btn delete" onclick="deleteCategory('Tablettes')" title="Supprimer">
              <i class="ti ti-trash"></i>
            </div>
          </div>
        </div>

        <!-- Catégorie 5 : Montres Connectées -->
        <div class="category-card">
          <div class="category-image">
            <img src="https://images.pexels.com/photos/437037/pexels-photo-437037.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Montres">
            <span class="category-badge">14 produits</span>
          </div>
          <div class="category-content">
            <div class="category-header">
              <div class="category-icon">
                <i class="ti ti-watch"></i>
              </div>
              <div class="category-info">
                <div class="category-name">Montres Connectées</div>
                <div class="category-count">Apple Watch, Galaxy Watch</div>
              </div>
            </div>
            <div class="category-stats">
              <div class="stat">
                <div class="stat-value">234</div>
                <div class="stat-label">En stock</div>
              </div>
              <div class="stat">
                <div class="stat-value">€34.1k</div>
                <div class="stat-label">Valeur</div>
              </div>
            </div>
          </div>
          <div class="category-actions">
            <div class="action-btn view" onclick="viewCategory('Montres')" title="Voir">
              <i class="ti ti-eye"></i>
            </div>
            <div class="action-btn edit" onclick="editCategory('Montres')" title="Modifier">
              <i class="ti ti-edit"></i>
            </div>
            <div class="action-btn delete" onclick="deleteCategory('Montres')" title="Supprimer">
              <i class="ti ti-trash"></i>
            </div>
          </div>
        </div>

        <!-- Catégorie 6 : Accessoires Gaming -->
        <div class="category-card">
          <div class="category-image">
            <img src="https://images.pexels.com/photos/3945659/pexels-photo-3945659.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Gaming">
            <span class="category-badge">45 produits</span>
          </div>
          <div class="category-content">
            <div class="category-header">
              <div class="category-icon">
                <i class="ti ti-device-gamepad"></i>
              </div>
              <div class="category-info">
                <div class="category-name">Gaming & Accessoires</div>
                <div class="category-count">Souris, claviers, manettes</div>
              </div>
            </div>
            <div class="category-stats">
              <div class="stat">
                <div class="stat-value">1,890</div>
                <div class="stat-label">En stock</div>
              </div>
              <div class="stat">
                <div class="stat-value">€98.5k</div>
                <div class="stat-label">Valeur</div>
              </div>
            </div>
          </div>
          <div class="category-actions">
            <div class="action-btn view" onclick="viewCategory('Gaming')" title="Voir">
              <i class="ti ti-eye"></i>
            </div>
            <div class="action-btn edit" onclick="editCategory('Gaming')" title="Modifier">
              <i class="ti ti-edit"></i>
            </div>
            <div class="action-btn delete" onclick="deleteCategory('Gaming')" title="Supprimer">
              <i class="ti ti-trash"></i>
            </div>
          </div>
        </div>

      </div>

      <!-- Footer -->
      <div class="row mt-4">
        <div class="col-12">
          <footer class="text-center py-3">
            <p class="mb-0 text-secondary small">
              Copyright © 2026 InApp Inventory Dashboard. Developed by 
              <a href="#" class="text-decoration-none" style="color: var(--primary-color);">CodesCandy</a> 
              • Distributed by 
              <a href="#" class="text-decoration-none" style="color: var(--primary-color);">ThemeWagon</a>
            </p>
          </footer>
        </div>
      </div>
    </div>
  </main>

  <!-- Scripts -->
  <script>
    function viewCategory(name) {
      showNotification(`Catégorie "${name}" ouverte`, 'success');
    }
    
    function editCategory(name) {
      showNotification(`Édition de "${name}"`, 'info');
    }
    
    function deleteCategory(name) {
      if (confirm(`Supprimer la catégorie "${name}" ?`)) {
        showNotification(`Catégorie "${name}" supprimée`, 'warning');
      }
    }
    
    function showNotification(message, type) {
      const notification = document.createElement('div');
      const bgColor = type === 'success' ? '#E66239' : type === 'warning' ? '#e74c3c' : '#f39c12';
      notification.style.cssText = `
        position: fixed;
        top: 80px;
        right: 20px;
        background: ${bgColor};
        color: white;
        padding: 12px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        z-index: 9999;
        animation: slideIn 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      `;
      notification.innerHTML = `
        <i class="ti ti-${type === 'success' ? 'check' : type === 'warning' ? 'trash' : 'edit'} me-2"></i>
        ${message}
      `;
      document.body.appendChild(notification);
      
      setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
      }, 3000);
    }

    // Filtres interactifs
    document.querySelectorAll('.filter-tab').forEach(tab => {
      tab.addEventListener('click', function() {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/main.js" type="module"></script>

</body>

</html>