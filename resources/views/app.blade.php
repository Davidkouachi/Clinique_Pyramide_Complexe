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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}">
    <!-- *************
        ************ CSS Files *************
    ************* -->
    <link rel="stylesheet" href="{{asset('assets/fonts/remix/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- *************
        ************ Vendor Css Files *************
    ************ -->
    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}">
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
    <div class="page-wrapper">
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
                <a href="" class="d-lg-block d-none">
                    <img src="{{asset('assets/images/logo.jpeg')}}" height="40" width="40" class="" style="border-radius: 50%;" alt="Medicare Admin Template">
                </a>
                <a href="" class="d-lg-none d-md-block">
                    <img src="{{asset('assets/images/logo.jpeg')}}" height="40" width="40" class="" style="border-radius: 50%;" alt="Medicare Admin Template">
                </a>
            </div>
            <!-- App brand ends -->
            
            <!-- App header actions starts -->
            <div class="header-actions">
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
                            <a href="{{route('deconnecter')}}" class="btn btn-danger">Se deconnecté</a>
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
                    <img src="{{asset('assets/images/user8.png')}}" class="img-shadow img-3x me-3 rounded-5" alt="Hospital Admin Templates">
                    <div class="m-0">
                        <h5 class="mb-1 profile-name text-nowrap text-truncate">Nick Gonzalez</h5>
                        <p class="m-0 small profile-name text-nowrap text-truncate">Dept Admin</p>
                    </div>
                </div>
                <!-- Sidebar profile ends -->
                <!-- Sidebar menu starts -->
                <div class="sidebarMenuScroll">
                    <ul class="sidebar-menu">
                        <li class="">{{-- active current-page --}}
                            <a href="{{route('index_accueil')}}">
                                <i class="ri-bar-chart-line"></i>
                                <span class="menu-text">Accueil</span>
                            </a>
                        </li>
                        <li class="">{{-- active current-page --}}
                            <a href="{{route('index_reception')}}">
                                <i class="ri-bar-chart-line"></i>
                                <span class="menu-text">Réception</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#!">
                                <i class="ri-settings-5-line"></i>
                                <span class="menu-text">Configuration</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#!">
                                        Ajouter
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{route('medecin_new')}}">Utilisateur</a>
                                        </li>
                                        <li>
                                            <a href="#!">
                                                Infirmerie
                                                <i class="ri-arrow-right-s-line"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li>
                                                    <a href="#!">
                                                        Soin
                                                        <i class="ri-arrow-right-s-line"></i>
                                                    </a>
                                                    <ul class="treeview-menu">
                                                        <li>
                                                            <a href="#">Type de soin</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Soin Infirmerie</a>
                                                        </li>
                                                    </ul>
                                                <li>
                                                    <a href="{{route('chambre_new')}}">Chambre & Lit</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('lit_new')}}">lit</a>
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
                                                    <a href="{{route('assurance_new')}}">Assurance</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('produit_new')}}">Produit</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('taux_new')}}">Taux</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('typeproduit_new')}}">Type Produit</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('assureur_new')}}">Assureur</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('societe_new')}}">Société assurer</a>
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
                                <li>
                                    <a href="{{route('acte_new')}}">Acte</a>
                                </li>
                                <li>
                                    <a href="{{route('typeacte_new')}}">Type acte</a>
                                </li>
                            </ul>
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
                                            <a href="{{route('encaissement')}}">Caisse</a>
                                        </li>
                                        <li>
                                            <a href="{{route('liste_caisse')}}">Liste</a>
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
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <!-- *************
            ************ Vendor Js Files *************
        ************* -->
    <!-- Overlay Scroll JS -->
    <script src="{{asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('assets/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>
    <!-- Apex Charts -->
    <script src="{{asset('assets/vendor/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/apex/custom/home/patients.js')}}"></script>
    <script src="{{asset('assets/vendor/apex/custom/home/treatment.js')}}"></script>
    {{-- <script src="{{asset('')}}assets/vendor/apex/custom/home/available-beds.js"></script> --}}
    <script src="{{asset('assets/vendor/apex/custom/home/earnings.js')}}"></script>
    <script src="{{asset('assets/vendor/apex/custom/home/gender-age.js')}}"></script>
    <script src="{{asset('assets/vendor/apex/custom/home/claims.js')}}"></script>
    <!-- Custom JS files -->
    <script src="{{asset('assets/js/custom.js')}}"></script>

    @if (session('success'))
        <div class="modal fade" id="success" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-5 text-center">
                        <h1 class="display-4">
                            <i class="ri-checkbox-circle-line text-success"></i>
                        </h1>
                        <h4 class="text-success">Succès</h4>
                        <p>{{session('success')}}</p>
                        <a data-bs-dismiss="modal" class="btn btn-lg btn-success w-25">
                            ok
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('success'));
                myModal.show();
            });
        </script>
        @php session()->forget('success'); @endphp
    @endif

    @if (session('error'))
        <div class="modal fade" id="error" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-5 text-center">
                        <h1 class="display-4">
                            <i class="ri-close-circle-line text-danger"></i>
                        </h1>
                        <h4 class="text-danger">Erreur</h4>
                        <p>{{session('error')}}</p>
                        <a data-bs-dismiss="modal" class="btn btn-lg btn-danger w-25">
                            ok
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('error'));
                myModal.show();
            });
        </script>
        @php session()->forget('error'); @endphp
    @endif

    @if (session('info'))
        <div class="modal fade" id="info" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-5 text-center">
                        <h1 class="display-4">
                            <i class="ri-question-line text-info"></i>
                        </h1>
                        <h4 class="text-info">Information</h4>
                        <p>{{session('info')}}</p>
                        <a data-bs-dismiss="modal" class="btn btn-lg btn-info w-25">
                            ok
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('info'));
                myModal.show();
            });
        </script>
        @php session()->forget('info'); @endphp
    @endif

    @if (session('warning'))
        <div class="modal fade" id="warning" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-5 text-center">
                        <h1 class="display-4">
                            <i class="ri-alert-line text-warning"></i>
                        </h1>
                        <h4 class="text-warning">Alert</h4>
                        <p>{{session('warning')}}</p>
                        <a data-bs-dismiss="modal" class="btn btn-lg btn-warning w-25">
                            ok
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('warning'));
                myModal.show();
            });
        </script>
        @php session()->forget('warning'); @endphp
    @endif


</body>
<!-- Mirrored from buybootstrap.com/demos/medflex/medflex-admin-dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Sep 2024 12:22:06 GMT -->

</html>