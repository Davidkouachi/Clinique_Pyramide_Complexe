<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Gallery - Medical Admin Templates & Dashboards</title>
    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="assets/images/favicon.svg">
    <!-- *************
        ************ CSS Files *************
    ************* -->
    <link rel="stylesheet" href="assets/fonts/remix/remixicon.css">
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- *************
        ************ Vendor Css Files *************
    ************ -->
    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="assets/vendor/overlay-scroll/OverlayScrollbars.min.css">
</head>

<body>
    <!-- Loading starts -->
    <div id="loading-wrapper">
        <div class='spin-wrapper'>
            <div class='spin'>
                <div class='inner'></div>
            </div>
            <div class='spin'>
                <div class='inner'></div>
            </div>
            <div class='spin'>
                <div class='inner'></div>
            </div>
            <div class='spin'>
                <div class='inner'></div>
            </div>
            <div class='spin'>
                <div class='inner'></div>
            </div>
            <div class='spin'>
                <div class='inner'></div>
            </div>
        </div>
    </div>
    <!-- Loading ends -->
    <!-- Page wrapper starts -->
    <div class="page-wrapper bg-white">
        <!-- App header starts -->
        <div class="app-header d-flex align-items-center">
            <!-- Toggle buttons starts -->
            <div class="d-flex">
                <button class="toggle-sidebar">
                    <i class="ri-menu-line"></i>
                </button>
                <button class="pin-sidebar">
                    <i class="ri-menu-line"></i>
                </button>
            </div>
            <!-- Toggle buttons ends -->
            <!-- App brand starts -->
            <div class="app-brand ms-3 ">
                <a href="index.html" class="d-lg-block d-none">
                    <img src="assets/images/logo.jpeg" height="40" width="40" class="" style="border-radius: 50%;" alt="Medicare Admin Template">
                </a>
                <a href="index.html" class="d-lg-none d-md-block">
                    <img src="assets/images/logo.jpeg" height="40" width="40" class="" style="border-radius: 50%;" alt="Medicare Admin Template">
                </a>
            </div>
            <!-- App brand ends -->
            
            <!-- App header actions starts -->
            <div class="header-actions">
                <!-- Search container starts -->
                {{-- <div class="search-container d-lg-block d-none mx-3">
                    <input type="text" class="form-control" id="searchId" placeholder="Search">
                    <i class="ri-search-line"></i>
                </div> --}}
                <!-- Search container ends -->
                <!-- Header actions starts -->
                {{-- <div class="d-lg-flex d-none gap-2">
                    <div class="dropdown">
                        <a class="dropdown-toggle header-icon" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-list-check-3"></i>
                            <span class="count-label warning"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-300">
                            <h5 class="fw-semibold px-3 py-2 text-primary">Activity</h5>
                            <!-- Scroll starts -->
                            <div class="scroll300">
                                <!-- Activity List Starts -->
                                <div class="p-3">
                                    <ul class="p-0 activity-list2">
                                        <li class="activity-item pb-3 mb-3">
                                            <a href="#!">
                                                <h5 class="fw-regular">
                                                    <i class="ri-circle-fill text-danger me-1"></i>
                                                    Invoices.
                                                </h5>
                                                <div class="ps-3 ms-2 border-start">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/products/1.jpg" class="img-shadow img-3x rounded-1" alt="Hospital Admin Templates">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            23 invoices have been paid to the MediCare Labs.
                                                        </div>
                                                    </div>
                                                    <p class="m-0 small">10:20AM Today</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="activity-item pb-3 mb-3">
                                            <a href="#!">
                                                <h5 class="fw-regular">
                                                    <i class="ri-circle-fill text-info me-1"></i>
                                                    Purchased.
                                                </h5>
                                                <div class="ps-3 ms-2 border-start">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/products/2.jpg" class="img-shadow img-3x rounded-1" alt="Hospital Admin Templates">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            28 new surgical equipments have been purchased.
                                                        </div>
                                                    </div>
                                                    <p class="m-0 small">04:30PM Today</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="activity-item pb-3 mb-3">
                                            <a href="#!">
                                                <h5 class="fw-regular">
                                                    <i class="ri-circle-fill text-success me-1"></i>
                                                    Appointed.
                                                </h5>
                                                <div class="ps-3 ms-2 border-start">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/products/8.jpg" class="img-shadow img-3x rounded-1" alt="Hospital Admin Templates">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            36 new doctors and 28 staff members appointed.
                                                        </div>
                                                    </div>
                                                    <p class="m-0 small">06:50PM Today</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="activity-item">
                                            <a href="#!">
                                                <h5 class="fw-regular">
                                                    <i class="ri-circle-fill text-warning me-1"></i>
                                                    Requested
                                                </h5>
                                                <div class="ps-3 ms-2 border-start">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/products/9.jpg" class="img-shadow img-3x rounded-1" alt="Hospital Admin Templates">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            Requested for 6 new vehicles for medical emergency. .
                                                        </div>
                                                    </div>
                                                    <p class="m-0 small">08:30PM Today</p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Activity List Ends -->
                            </div>
                            <!-- Scroll ends -->
                            <!-- View all button starts -->
                            <div class="d-grid m-3">
                                <a href="javascript:void(0)" class="btn btn-primary">View all</a>
                            </div>
                            <!-- View all button ends -->
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle header-icon" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-alarm-warning-line"></i>
                            <span class="count-label success"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-300">
                            <h5 class="fw-semibold px-3 py-2 text-primary">Alerts</h5>
                            <!-- Scroll starts -->
                            <div class="scroll300">
                                <!-- Alert list starts -->
                                <div class="p-3">
                                    <div class="d-flex py-2">
                                        <div class="icon-box md bg-info rounded-circle me-3">
                                            <span class="fw-bold fs-6 text-white">DS</span>
                                        </div>
                                        <div class="m-0">
                                            <h6 class="mb-1 fw-semibold">Douglass Shaw</h6>
                                            <p class="mb-1">
                                                Appointed as a new President 2014-2025
                                            </p>
                                            <p class="small m-0 opacity-50">Today, 07:30pm</p>
                                        </div>
                                    </div>
                                    <div class="d-flex py-2">
                                        <div class="icon-box md bg-danger rounded-circle me-3">
                                            <span class="fw-bold fs-6 text-white">WG</span>
                                        </div>
                                        <div class="m-0">
                                            <h6 class="mb-1 fw-semibold">Willie Garrison</h6>
                                            <p class="mb-1">
                                                Congratulate, James for new job.
                                            </p>
                                            <p class="small m-0 opacity-50">Today, 08:00pm</p>
                                        </div>
                                    </div>
                                    <div class="d-flex py-2">
                                        <div class="icon-box md bg-warning rounded-circle me-3">
                                            <span class="fw-bold fs-6 text-white">TJ</span>
                                        </div>
                                        <div class="m-0">
                                            <h6 class="mb-1 fw-semibold">Terry Jenkins</h6>
                                            <p class="mb-1">
                                                Lewis added new doctors training schedule.
                                            </p>
                                            <p class="small m-0 opacity-50">Today, 09:30pm</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Alert list ends -->
                            </div>
                            <!-- Scroll ends -->
                            <!-- View all button starts -->
                            <div class="d-grid m-3">
                                <a href="javascript:void(0)" class="btn btn-primary">View all</a>
                            </div>
                            <!-- View all button ends -->
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle header-icon" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-message-3-line"></i>
                            <span class="count-label"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-300">
                            <h5 class="fw-semibold px-3 py-2 text-primary">Messages</h5>
                            <!-- Scroll starts -->
                            <div class="scroll300">
                                <!-- Messages list starts -->
                                <div class="p-3">
                                    <div class="d-flex py-2">
                                        <img src="assets/images/user3.png" class="img-shadow img-3x me-3 rounded-5" alt="Hospital Admin Templates">
                                        <div class="m-0">
                                            <h6 class="mb-1 fw-semibold">Nick Gonzalez</h6>
                                            <p class="mb-1">
                                                Appointed as a new President 2014-2025
                                            </p>
                                            <p class="small m-0 opacity-50">Today, 07:30pm</p>
                                        </div>
                                    </div>
                                    <div class="d-flex py-2">
                                        <img src="assets/images/user1.png" class="img-shadow img-3x me-3 rounded-5" alt="Hospital Admin Templates">
                                        <div class="m-0">
                                            <h6 class="mb-1 fw-semibold">Clyde Fowler</h6>
                                            <p class="mb-1">
                                                Congratulate, James for new job.
                                            </p>
                                            <p class="small m-0 opacity-50">Today, 08:00pm</p>
                                        </div>
                                    </div>
                                    <div class="d-flex py-2">
                                        <img src="assets/images/user4.png" class="img-shadow img-3x me-3 rounded-5" alt="Hospital Admin Templates">
                                        <div class="m-0">
                                            <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                                            <p class="mb-1">
                                                Lewis added new doctors training schedule.
                                            </p>
                                            <p class="small m-0 opacity-50">Today, 09:30pm</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Messages list ends -->
                            </div>
                            <!-- Scroll ends -->
                            <!-- View all button starts -->
                            <div class="d-grid m-3">
                                <a href="javascript:void(0)" class="btn btn-primary">View all</a>
                            </div>
                            <!-- View all button ends -->
                        </div>
                    </div>
                </div> --}}
                <!-- Header actions ends -->
                <!-- Header user settings starts -->
                <div class="dropdown ms-2">
                    <a id="userSettings" class="dropdown-toggle d-flex align-items-center" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar-box">JB<span class="status busy"></span></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow-lg">
                        <div class="px-3 py-2">
                            <span class="small">Admin</span>
                            <h6 class="m-0">James Bruton</h6>
                        </div>
                        <div class="mx-3 my-2 d-grid">
                            <a href="login.html" class="btn btn-danger">Se deconnecté</a>
                        </div>
                    </div>
                </div>
                <!-- Header user settings ends -->
            </div>
            <!-- App header actions ends -->
        </div>
        <!-- App header ends -->
        <!-- Main container starts -->
        <div class="main-container">
            <!-- Sidebar wrapper starts -->
            <nav id="sidebar" class="sidebar-wrapper">
                <!-- Sidebar profile starts -->
                <div class="sidebar-profile">
                    <img src="assets/images/user8.png" class="img-shadow img-3x me-3 rounded-5" alt="Hospital Admin Templates">
                    <div class="m-0">
                        <h5 class="mb-1 profile-name text-nowrap text-truncate">Nick Gonzalez</h5>
                        <p class="m-0 small profile-name text-nowrap text-truncate">Dept Admin</p>
                    </div>
                </div>
                <!-- Sidebar profile ends -->
                <!-- Sidebar menu starts -->
                <div class="sidebarMenuScroll">
                    <ul class="sidebar-menu">
                        <li class="active current-page">
                            <a href="index.html">
                                <i class="ri-bar-chart-line"></i>
                                <span class="menu-text">Tableau de bord</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#!">
                                <i class="ri-home-5-line"></i>
                                <span class="menu-text">Acceuil</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#!">
                                        Patient
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="#">Nouveau</a>
                                        </li>
                                        <li>
                                            <a href="#">Recherche</a>
                                        </li>
                                        <li>
                                            <a href="#">Liste</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        Prix des examens
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#!">
                                <i class="ri-settings-5-line"></i>
                                <span class="menu-text">Laboratoire</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#!">
                                        Famille acte biologie
                                    </a>
                                </li>
                                <li>
                                    <a href="#!">
                                        Examen demandés
                                    </a>
                                </li>
                                <li>
                                    <a href="#!">
                                        Liste des examens
                                    </a>
                                </li>
                                <li>
                                    <a href="#!">
                                        Historique des examens
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#!">
                                <i class="ri-settings-5-line"></i>
                                <span class="menu-text">Ressources Humaines</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#!">
                                        Nouveau médécin
                                    </a>
                                </li>
                                <li>
                                    <a href="#!">
                                        Nouvel administrateur
                                    </a>
                                </li>
                                <li>
                                    <a href="#!">
                                        Liste de médécins
                                    </a>
                                </li>
                                <li>
                                    <a href="#!">
                                        Liste des administrateurs
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#!">
                                <i class="ri-settings-5-line"></i>
                                <span class="menu-text">Infirmerie</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#!">
                                        Attribution de lits
                                    </a>
                                </li>
                                <li>
                                    <a href="#!">
                                        Prise de constantes
                                    </a>
                                </li>
                                <li>
                                    <a href="#!">
                                        Liste
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="#">Soin Infirmier</a>
                                        </li>
                                        <li>
                                            <a href="#">Chambre</a>
                                        </li>
                                        <li>
                                            <a href="#">lit</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#!">
                                <i class="ri-settings-5-line"></i>
                                <span class="menu-text">Assurances</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#!">
                                        Liste
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="#">Assurance</a>
                                        </li>
                                        <li>
                                            <a href="#">Assureur</a>
                                        </li>
                                        <li>
                                            <a href="#">Société assurer</a>
                                        </li>
                                        <li>
                                            <a href="#">Produit assurance</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#!">
                                <i class="ri-settings-5-line"></i>
                                <span class="menu-text">Pharmacie</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#!">
                                        Ajouter
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="#">Facture</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#!">
                                        Liste
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="#">Medicament</a>
                                        </li>
                                        <li>
                                            <a href="#">Catégorie</a>
                                        </li>
                                        <li>
                                            <a href="#">Facture</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#!">
                                <i class="ri-settings-5-line"></i>
                                <span class="menu-text">Caisse</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#!">
                                        Encaissement
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="#">Consultation</a>
                                        </li>
                                        <li>
                                            <a href="#">Bulletin</a>
                                        </li>
                                        <li>
                                            <a href="#">Admission</a>
                                        </li>
                                        <li>
                                            <a href="#">Soins infirmier</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        Réimprimer recu
                                    </a>
                                </li>
                                <li>
                                    <a href="#!">
                                        Opération de caisse
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="#">Sortie d'espèce</a>
                                        </li>
                                        <li>
                                            <a href="#">Liste des sorties</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        Point de caisse
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#!">
                                <i class="ri-settings-5-line"></i>
                                <span class="menu-text">Gestionnaire</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#!">
                                        Ajouter
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="#!">
                                                Infirmerie
                                                <i class="ri-arrow-right-s-line"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="#">Soin Infirmier</a>
                                                </li>
                                                <li>
                                                    <a href="#">Chambre</a>
                                                </li>
                                                <li>
                                                    <a href="#">lit</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#!">
                                                Assurance
                                                <i class="ri-arrow-right-s-line"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="#">Assurance</a>
                                                </li>
                                                <li>
                                                    <a href="#">Assureur</a>
                                                </li>
                                                <li>
                                                    <a href="#">Société assurer</a>
                                                </li>
                                                <li>
                                                    <a href="#">Produit assurance</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#!">
                                                Pharmacie
                                                <i class="ri-arrow-right-s-line"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="#">Medicament</a>
                                                </li>
                                                <li>
                                                    <a href="#">Catégorie</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#!">
                                                Laboratoire
                                                <i class="ri-arrow-right-s-line"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="#">Examen</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#!">
                                        Liste
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="#!">
                                                Infirmerie
                                                <i class="ri-arrow-right-s-line"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="#">Soin Infirmier</a>
                                                </li>
                                                <li>
                                                    <a href="#">Chambre</a>
                                                </li>
                                                <li>
                                                    <a href="#">lit</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#!">
                                                Assurance
                                                <i class="ri-arrow-right-s-line"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="#">Assurance</a>
                                                </li>
                                                <li>
                                                    <a href="#">Assureur</a>
                                                </li>
                                                <li>
                                                    <a href="#">Société assurer</a>
                                                </li>
                                                <li>
                                                    <a href="#">Produit assurance</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#!">
                                                Pharmacie
                                                <i class="ri-arrow-right-s-line"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="#">Medicament</a>
                                                </li>
                                                <li>
                                                    <a href="#">Catégorie</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#!">
                                                Laboratoire
                                                <i class="ri-arrow-right-s-line"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="#">Examen</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar menu ends -->
                <!-- Sidebar contact starts -->
                <div class="sidebar-contact" style="background-color: red;">
                    <p class="fw-light mb-1 text-nowrap text-truncate">Appel d'urgence</p>
                    <h5 class="m-0 lh-1 text-nowrap text-truncate">0987654321</h5>
                    <i class="ri-phone-line"></i>
                </div>      
                <!-- Sidebar contact ends -->
            </nav>
            <!-- Sidebar wrapper ends -->
            <!-- App container starts -->
            <div class="app-container">
                <!-- App hero header starts -->
                @yield('info_page')
                <!-- App Hero header ends -->
                <!-- App body starts -->
                @yield('content')
                <!-- App body ends -->
                <!-- App footer starts -->
                <div class="app-footer bg-white">
                    <span>© Medflex admin 2024</span>
                </div>
                <!-- App footer ends -->
            </div>
            <!-- App container ends -->
        </div>
        <!-- Main container ends -->
    </div>
    <!-- Page wrapper ends -->
    <!-- *************
            ************ JavaScript Files *************
        ************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <!-- *************
            ************ Vendor Js Files *************
        ************* -->
    <!-- Overlay Scroll JS -->
    <script src="assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
    <script src="assets/vendor/overlay-scroll/custom-scrollbar.js"></script>
    <!-- Apex Charts -->
    <script src="assets/vendor/apex/apexcharts.min.js"></script>
    <script src="assets/vendor/apex/custom/home/patients.js"></script>
    <script src="assets/vendor/apex/custom/home/treatment.js"></script>
    {{-- <script src="assets/vendor/apex/custom/home/available-beds.js"></script> --}}
    <script src="assets/vendor/apex/custom/home/earnings.js"></script>
    <script src="assets/vendor/apex/custom/home/gender-age.js"></script>
    <script src="assets/vendor/apex/custom/home/claims.js"></script>
    <!-- Custom JS files -->
    <script src="assets/js/custom.js"></script>
</body>
<!-- Mirrored from buybootstrap.com/demos/medflex/medflex-admin-dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Sep 2024 12:22:06 GMT -->

</html>