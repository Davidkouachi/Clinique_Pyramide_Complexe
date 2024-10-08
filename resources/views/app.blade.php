<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace Santé</title>
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/remix/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/dataTables.bs5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/dataTables.bs5-custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/buttons/dataTables.bs5-custom.css')}}">
    <script src="{{asset('sweetalert.js')}}"></script>
</head>

<body>
    <!-- Loading starts -->
    {{-- <div id="loading-wrapper">
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
    </div> --}}
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
                    <img src="{{asset('assets/images/logo.png')}}" height="40" width="40" class="" style="border-radius: 10%;" alt="Medicare Admin Template">
                </a>
                <a href="" class="d-lg-none d-md-block">
                    <img src="{{asset('assets/images/logo.png')}}" height="40" width="40" class="" style="border-radius: 10%;" alt="Medicare Admin Template">
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
                            <h6 class="m-0">{{Auth::user()->name}}</h6>
                        </div>
                        <div class="mx-3 my-2 d-grid">
                            <a href="{{route('deconnecter')}}" class="btn btn-danger">Se deconnecté</a>
                        </div>
                    </div>
                </div>
                <!-- Header user settings ends -->
            </div>
        </div>
        <div class="main-container">
            <!-- Sidebar wrapper starts -->
            <nav id="sidebar" class="sidebar-wrapper">
                <!-- Sidebar profile starts -->
                <div class="sidebar-profile">
                    <img src="{{asset('assets/images/user8.png')}}" class="img-shadow img-3x me-3 rounded-5" alt="Hospital Admin Templates">
                    <div class="m-0">
                        <h5 class="mb-1 profile-name text-nowrap text-truncate">
                            {{Auth::user()->name}}
                        </h5>
                        <p class="m-0 small profile-name text-nowrap text-truncate">
                            {{Auth::user()->email}}
                        </p>
                    </div>
                </div>
                <div class="sidebarMenuScroll">
                    <ul class="sidebar-menu">
                        <li @if(request()->routeIs('index_accueil')) class="active current-page" @endif>
                            <a href="{{route('index_accueil')}}">
                                <i class="ri-home-line"></i>
                                <span class="menu-text">Accueil</span>
                            </a>
                        </li>
                        <li @if(request()->routeIs('index_reception','consultation_liste','patient_liste','societe_liste','horaire_medecin')) class="active current-page treeview" @else class="treeview" @endif >
                            <a href="#!">
                                <i class="ri-computer-line"></i>
                                <span class="menu-text">Réception</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a @if(request()->routeIs('index_reception')) class="text-primary" @endif href="{{route('index_reception')}}">
                                        Tableau de bord
                                    </a>
                                </li>
                                <li>
                                    <a @if(request()->routeIs('consultation_liste')) class="text-primary" @endif href="{{route('consultation_liste')}}">
                                        Consultation
                                    </a>
                                </li>
                                <li>
                                    <a @if(request()->routeIs('patient_liste')) class="text-primary" @endif href="{{route('patient_liste')}}">
                                        Patient
                                    </a>
                                </li>
                                <li>
                                    <a @if(request()->routeIs('horaire_medecin')) class="text-primary" @endif href="{{route('horaire_medecin')}}">
                                        Horaires Médecins
                                    </a>
                                </li>
                                <li>
                                    <a @if(request()->routeIs('societe_liste')) class="text-primary" @endif href="{{route('societe_liste')}}">Société</a>
                                </li>
                            </ul>
                        </li>
                        <li @if(request()->routeIs('hospitalisation','examen','soinsam')) class="active current-page treeview" @else class="treeview" @endif>
                            <a href="#!">
                                <i class="ri-first-aid-kit-fill"></i>
                                <span class="menu-text">services médicaux</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a @if(request()->routeIs('examen')) class="text-primary" @endif href="{{route('examen')}}">
                                        Examen
                                    </a>
                                </li>
                                <li>
                                    <a @if(request()->routeIs('hospitalisation')) class="text-primary" @endif href="{{route('hospitalisation')}}">
                                        Hospitalisation
                                    </a>
                                </li>
                                <li>
                                    <a @if(request()->routeIs('soinsam')) class="text-primary" @endif href="{{route('soinsam')}}">
                                        Soins Ambulantoires
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li @if(request()->routeIs('encaissement_cons','liste_caisse_cons','encaissement_hos','liste_caisse_hos','encaissement_soinsam','liste_caisse_soinsam','encaissement_examen','liste_caisse_examen')) class="active current-page treeview" @else class="treeview" @endif>
                            <a href="#!">
                                <i class="ri-safe-2-line"></i>
                                <span class="menu-text">Caisse</span>
                            </a>
                            <ul class="treeview-menu">
                                <li @if(request()->routeIs('encaissement_cons','liste_caisse_cons')) class="active" @endif >
                                    <a href="#!">
                                        Consultation
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a @if(request()->routeIs('encaissement_cons')) class="text-primary" @endif href="{{route('encaissement_cons')}}">Facture non-réglée</a>
                                        </li>
                                        <li>
                                            <a @if(request()->routeIs('liste_caisse_cons')) class="text-primary" @endif href="{{route('liste_caisse_cons')}}">Liste facture</a>
                                        </li>
                                    </ul>
                                </li>
                                <li @if(request()->routeIs('encaissement_hos','liste_caisse_hos')) class="active" @endif >
                                    <a href="#!">
                                        Hospitalisation
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a @if(request()->routeIs('encaissement_hos')) class="text-primary" @endif href="{{route('encaissement_hos')}}">Facture non-réglée</a>
                                        </li>
                                        <li>
                                            <a @if(request()->routeIs('liste_caisse_hos')) class="text-primary" @endif href="{{route('liste_caisse_hos')}}">Liste facture</a>
                                        </li>
                                    </ul>
                                </li>
                                <li @if(request()->routeIs('encaissement_soinsam','liste_caisse_soinsam')) class="active" @endif >
                                    <a href="#!">
                                        Soins Ambulatoires
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a @if(request()->routeIs('encaissement_soinsam')) class="text-primary" @endif href="{{route('encaissement_soinsam')}}">Facture non-réglée</a>
                                        </li>
                                        <li>
                                            <a @if(request()->routeIs('liste_caisse_soinsam')) class="text-primary" @endif href="{{route('liste_caisse_soinsam')}}">Liste facture</a>
                                        </li>
                                    </ul>
                                </li>
                                <li @if(request()->routeIs('encaissement_examen','liste_caisse_examen')) class="active" @endif >
                                    <a href="#!">
                                        Examen
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a @if(request()->routeIs('encaissement_examen')) class="text-primary" @endif href="{{route('encaissement_examen')}}">Facture non-réglée</a>
                                        </li>
                                        <li>
                                            <a @if(request()->routeIs('liste_caisse_examen')) class="text-primary" @endif href="{{route('liste_caisse_examen')}}">Liste facture</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li @if(request()->routeIs('medecin_new','assurance_new','taux_new','societe_new','acte_new','typeacte_new','chambre_new','lit_new','typeadmission_new','natureadmission_new','produit_new','typesoins_new','soinsinfirmier_new','specialite')) class="active current-page treeview" @else class="treeview" @endif>
                            <a href="#!">
                                <i class="ri-settings-5-line"></i>
                                <span class="menu-text">Configuration</span>
                            </a>
                            <ul class="treeview-menu">
                                <li @if(request()->routeIs('chambre_new','lit_new','typeadmission_new','natureadmission_new','produit_new')) class="active" @endif >
                                    <a href="#!">
                                        Hospitalisation
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a @if(request()->routeIs('chambre_new')) class="text-primary" @endif href="{{route('chambre_new')}}">Chambre</a>
                                        </li>
                                        <li>
                                            <a @if(request()->routeIs('lit_new')) class="text-primary" @endif href="{{route('lit_new')}}">lit</a>
                                        </li>
                                        <li>
                                            <a @if(request()->routeIs('typeadmission_new')) class="text-primary" @endif href="{{route('typeadmission_new')}}">Type admission</a>
                                        </li>
                                        <li>
                                            <a @if(request()->routeIs('natureadmission_new')) class="text-primary" @endif href="{{route('natureadmission_new')}}">Nature admission</a>
                                        </li>
                                        <li>
                                            <a @if(request()->routeIs('produit_new')) class="text-primary" @endif href="{{route('produit_new')}}">Produit Pharmacie</a>
                                        </li>
                                    </ul>
                                </li>
                                <li @if(request()->routeIs('typesoins_new','soinsinfirmier_new')) class="active" @endif >
                                    <a href="#!">
                                        Infirmerie
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a @if(request()->routeIs('typesoins_new')) class="text-primary" @endif  href="{{route('typesoins_new')}}">Type Soins</a>
                                        </li>
                                        <li>
                                            <a @if(request()->routeIs('soinsinfirmier_new')) class="text-primary" @endif href="{{route('soinsinfirmier_new')}}">Soins Infirmier</a>
                                        </li>
                                    </ul>
                                </li>
                                <li @if(request()->routeIs('medecin_new','acte_new','typeacte_new','specialite')) class="active" @endif >
                                    <a href="#!">
                                        Medecin
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{route('medecin_new')}}">Nouveau</a>
                                        </li>
                                        {{-- <li>
                                            <a @if(request()->routeIs('acte_new')) class="text-primary" @endif  href="{{route('acte_new')}}">Acte</a>
                                        </li>
                                        <li>
                                            <a @if(request()->routeIs('typeacte_new')) class="text-primary" @endif href="{{route('typeacte_new')}}">Type acte</a>
                                        </li> --}}
                                        <li>
                                            <a @if(request()->routeIs('specialite')) class="text-primary" @endif href="{{route('specialite')}}">
                                                Spécialité
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li @if(request()->routeIs('etat_facture')) class="active current-page treeview" @else class="treeview" @endif >
                            <a href="#!">
                                <i class="ri-archive-fill"></i>
                                <span class="menu-text">Etats</span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a @if(request()->routeIs('etat_facture')) class="text-primary" @endif href="{{route('etat_facture')}}">
                                        Factures
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-contact" style="background-color: red;">
                    <p class="fw-light mb-1 text-nowrap text-truncate">Appel d'urgence</p>
                    <h5 class="m-0 lh-1 text-nowrap text-truncate">0987654321</h5>
                    <i class="ri-phone-line"></i>
                </div>
            </nav>
            <div class="app-container">
                @yield('info_page')
                @yield('content')
                <div class="app-footer bg-white">
                    <span>© Espace Santé 2024</span>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('assets/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>
    <script src="{{asset('assets/vendor/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables/dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables/custom/custom-datatables.js')}}"></script>

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
</html>