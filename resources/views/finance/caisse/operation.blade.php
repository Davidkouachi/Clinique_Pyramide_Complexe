@extends('app')

@section('titre', 'Acceuil')

@section('info_page')
<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-bar-chart-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{route('index_accueil')}}">Espace Santé</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Opération de Caisse
        </li>
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <div class="row gx-3">
        <div class="col-xxl-12 col-sm-12">
            <div class="card mb-3 bg-3">
                <div class="card-body" style="background: rgba(0, 0, 0, 0.7);">
                    <div class="py-4 px-3 text-white">
                        <h6>Bienvenue,</h6>
                        <h2>{{Auth::user()->sexe.'. '.Auth::user()->name}}</h2>
                        <div class="mt-4 row gx-3">
                            <div class="d-flex align-items-center col-xxl-3 col-lg-4 col-sm-6 col-12 mb-3 ">
                                <div class="icon-box lg bg-success rounded-5 me-3">
                                    <i class="ri-safe-2-line fs-1"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h4 id="solde_caisse" class="m-0 lh-1"></h4>
                                    <p class="m-0">Solde Actuel</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card mb-3 mt-3">
                <div class="card-body" style="margin-top: -30px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center bg-primary bg-2" id="customTab4" role="tablist" style="background: rgba(0, 0, 0, 0.7);">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-white" id="tab-twoAAAN" data-bs-toggle="tab" href="#twoAAAN" role="tab" aria-controls="twoAAAN" aria-selected="false" tabindex="-1">
                                    <i class="ri-swap-3-line me-2"></i>
                                    Nouveau Opération
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-upload-cloud-line me-2"></i>
                                    Historique Caisse
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-tAAA" data-bs-toggle="tab" href="#tAAA" role="tab" aria-controls="tAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-upload-cloud-line me-2"></i>
                                    Bilan Journalier
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane active show fade" id="twoAAAN" role="tabpanel" aria-labelledby="tab-twoAAAN">
                                <div class="row justify-content-center" id="div_caisse_verf" style="display: none;">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="card-body row gx-3 d-flex align-items-center justify-content-between">
                                                <div class="col-12">
                                                    <div class="mb-1 text-center">
                                                        <a class="d-flex align-items-center flex-column">
                                                            <img src="{{asset('assets/images/caisse.jpg')}}" class="img-7x rounded-circle border border-3">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-12" id="btn_ouvert">
                                                    <div class="mb-1 text-center">
                                                        <button id="btn_ouvert_C" type="button" class="btn btn-outline-success">
                                                            Ouverture de Caisse
                                                            <i class="ri-door-open-line"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-12" id="btn_fermer">
                                                    <div class="mb-1 text-center">
                                                        <button id="btn_fermer_C" type="button" class="btn btn-outline-danger">
                                                            Fermeture de Caisse
                                                            <i class="ri-door-close-line"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="div_caisse" style="display: none;" >
                                    <div class="card-header">
                                        <h5 class="card-title">Formulaire Nouvelle Opération</h5>
                                    </div>
                                    <div class="card-body" >
                                        <div class="row gx-3">
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Type d'opération</label>
                                                    <select class="form-select" id="type_ope">
                                                        <option value="">Selectionner</option>
                                                        <option value="entrer">Entrer d'argent</option>
                                                        <option value="sortie">Sortie d'argent</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Montant</label>
                                                    <div class="input-group">
                                                        <input type="tel" class="form-control" id="montant_ope" placeholder="Saisie Obligatoire">
                                                        <span class="input-group-text">Fcfa</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        Nom et Prénoms
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="Saisie Obligatoire" id="nom_ope" oninput="this.value = this.value.toUpperCase()">
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        Date de l'opération
                                                    </label>
                                                    <input type="date" class="form-control" id="date_ope" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class=" mb-3">
                                                    <label class="form-label" for="abc6">Motif</label>
                                                    <textarea style="resize: none;" class="form-control" id="libelle_ope" rows="3" oninput="this.value = this.value.toUpperCase()"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="d-flex gap-2 justify-content-start">
                                                    <button id="btn_eng_ope" class="btn btn-success">
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="twoAAA" role="tabpanel" aria-labelledby="tab-twoAAA">
                                <div class="card-header">
                                    <h5 class="card-title">Liste des Opérations de Caisse</h5>
                                </div>
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="w-100">
                                        <div class="input-group">
                                            <span class="input-group-text">Du</span>
                                            <input type="date" id="searchDate1" placeholder="Recherche" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                            <span class="input-group-text">au</span>
                                            <input type="date" id="searchDate2" placeholder="Recherche" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                            <span class="input-group-text">Type Mvt</span>
                                            <select class="form-select me-1" id="statutTrace">
                                                <option selected value="tous">Tout</option>
                                                <option value="Entrer de Caisse">Entrer</option>
                                                <option value="Sortie de Caisse">Sortie</option>
                                            </select>
                                            <span class="input-group-text">Cassier(ère)</span>
                                            <select class="form-select me-1" id="userTrace">
                                            </select>
                                            <a id="btn_search_trace" class="btn btn-outline-success ms-auto">
                                                <i class="ri-search-2-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- <div class="d-flex">
                                        <a id="btn_refresh_trace" class="btn btn-outline-info ms-auto">
                                            <i class="ri-loop-left-line"></i>
                                        </a>
                                    </div> --}}
                                </div>
                                <div class="card-body mb-3">
                                    <div class="table-outer" id="div_Table" style="display: none;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-hover m-0 truncate" id="Table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">N°</th>
                                                        <th scope="col">Créer par</th>
                                                        <th scope="col">Motif</th>
                                                        <th scope="col">Type de mouvement</th>
                                                        <th scope="col">Montant</th>
                                                        <th scope="col">Date d'opération</th>
                                                        <th scope="col">Date de création</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="message_Table" style="display: none;">
                                        <p class="text-center">
                                            Aucune n'a été trouvé
                                        </p>
                                    </div>
                                    <div id="div_Table_loader" style="display: none;">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                            <strong>Chargement des données...</strong>
                                        </div>
                                    </div>
                                    <div id="pagination-controls"></div>
                                </div>
                                <div class="card-header">
                                    <h5 class="card-title">Liste des ouvertures et fermetures de Caisse</h5>
                                </div>
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="w-100">
                                        <div class="input-group">
                                            <span class="input-group-text">Du</span>
                                            <input type="date" id="searchDate1_ofc" placeholder="Recherche" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                            <span class="input-group-text">au</span>
                                            <input type="date" id="searchDate2_ofc" placeholder="Recherche" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                            <a id="btn_search_trace_ofc" class="btn btn-outline-success ms-auto">
                                                <i class="ri-search-2-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mb-3">
                                    <div class="table-outer" id="div_Table_ofc" style="display: none;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-hover m-0 truncate" id="Table_ofc">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">N°</th>
                                                        <th scope="col">Motif</th>
                                                        <th scope="col">Solde Caisse</th>
                                                        <th scope="col">Auteur</th>
                                                        <th scope="col">Date de création</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="message_Table_ofc" style="display: none;">
                                        <p class="text-center">
                                            Aucune n'a été trouvé
                                        </p>
                                    </div>
                                    <div id="div_Table_loader_ofc" style="display: none;">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                            <strong>Chargement des données...</strong>
                                        </div>
                                    </div>
                                    <div id="pagination-controls_ofc"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tAAA" role="tabpanel" aria-labelledby="tab-tAAA">
                                <div class="row gx-3 justify-content-center align-items-center">
                                    <div class="col-xxl-4 col-sm-6">
                                        <div class="card-header">
                                            <h5 class="card-title">Bilan Journalier de la caisse</h5>
                                        </div>
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <div class="w-100">
                                                <div class="input-group">
                                                    <span class="input-group-text">Date</span>
                                                    <input type="date" id="searchDate1_bj" placeholder="Recherche" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                                    <a id="btn_search_trace_bj" class="btn btn-outline-success ms-auto">
                                                        <i class="ri-search-2-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-header">
                                                <h5 class="card-title">Bilan Journalier</h5>
                                            </div>
                                            <div class="scroll300">
                                                <div class="d-flex flex-column gap-2" id="historique_contenu">
                                                </div>
                                            </div>
                                            <div class="mt-3" id="historique_total">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Detail" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-body" id="modal_detail"></div>
    </div>
</div>

<script src="{{asset('assets/js/app/js/jspdfinvoicetemplate/dist/index.js')}}" ></script>
<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        caisse_verf();
        solde();
        select_user();
        list();
        list_ofc();
        historique();

        document.getElementById("btn_eng_ope").addEventListener("click", eng_ope);
        // document.getElementById("btn_refresh_trace").addEventListener("click", list);
        document.getElementById("btn_search_trace").addEventListener("click", list);
        document.getElementById("btn_search_trace_ofc").addEventListener("click", list_ofc);

        document.getElementById("btn_ouvert_C").addEventListener("click", caisse_ouvert);
        document.getElementById("btn_fermer_C").addEventListener("click", caisse_fermer);

        document.getElementById("btn_search_trace_bj").addEventListener("click", historique);

        function caisse_verf()
        {
            fetch('/api/verf_caisse')
                .then(response => response.json())
                .then(data => {
                    
                    if (data.caisse.statut == 'ouvert') {
                        document.getElementById('div_caisse').style.display = 'block';
                        document.getElementById('div_caisse_verf').style.display = 'block';
                        document.getElementById('btn_ouvert').style.display = 'none';
                        document.getElementById('btn_fermer').style.display = 'block';
                        list();
                    }else{
                        document.getElementById('div_caisse').style.display = 'none';
                        document.getElementById('div_caisse_verf').style.display = 'block';
                        document.getElementById('btn_ouvert').style.display = 'block';
                        document.getElementById('btn_fermer').style.display = 'none';
                    }

                })
                .catch(error => console.error('Erreur lors du chargement des donnée caisse:', error));
        }

        function caisse_ouvert()
        {
            const auth_id = {{ Auth::user()->id }};

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/caisse_ouvert',
                method: 'GET',
                data: { 
                    auth_id: auth_id,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {

                        document.getElementById('div_caisse').style.display = 'block';
                        document.getElementById('div_caisse_verf').style.display = 'block';
                        document.getElementById('btn_ouvert').style.display = 'none';
                        document.getElementById('btn_fermer').style.display = 'block';

                        list();
                        list_ofc();

                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue lors de l\'ouverture de la caisse.','error');
                    }

                },
                error: function(xhr, status, error) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('Alert', 'Une erreur est survenue.','error');
                }
            });
        }

        function caisse_fermer()
        {
            const auth_id = {{ Auth::user()->id }};

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/caisse_fermer',
                method: 'GET',
                data: { 
                    auth_id: auth_id,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {

                        document.getElementById('div_caisse').style.display = 'none';
                        document.getElementById('div_caisse_verf').style.display = 'block';
                        document.getElementById('btn_ouvert').style.display = 'block';
                        document.getElementById('btn_fermer').style.display = 'none';

                        list();
                        list_ofc();

                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue lors de la fermeture de la caisse.','error');
                    }

                },
                error: function(xhr, status, error) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('Alert', 'Une erreur est survenue.','error');
                }
            });
        }

        var inputs = ['montant_ope'];
        inputs.forEach(function(id) {
            var inputElement = document.getElementById(id);

            inputElement.addEventListener('keypress', function(event) {
                const key = event.key;
                if (!/[0-9]/.test(key) && key !== 'Backspace' && key !== 'Delete') {
                    event.preventDefault();
                }
            });

            inputElement.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '').toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");;
            });
        });

        function showAlert(title, message, type) {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
            });
        }

        function formatPrice(price)
        {

            // Convert to float and round to the nearest whole number
            let number = Math.round(parseFloat(price));
            if (isNaN(number)) {
                return '';
            }

            // Format the number with dot as thousands separator
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function formatDate(dateString)
        {

            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const year = date.getFullYear();

            return `${day}/${month}/${year}`; // Format as dd/mm/yyyy
        }

        function formatDateHeure(dateString)
        {

            const date = new Date(dateString);
                
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');

            return `${day}/${month}/${year} à ${hours}:${minutes}:${seconds}`;
        }

        function select_user()
        {
            const selectElement = document.getElementById('userTrace');

            selectElement.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = 'tous';
            defaultOption.textContent = 'Tout';
            selectElement.appendChild(defaultOption);

            fetch('/api/list_caissier')
                .then(response => response.json())
                .then(data => {
                    const caissiers = data.caissier;
                    caissiers.forEach((item, index) => {
                        const option = document.createElement('option');
                        option.value = `${item.id}`;
                        option.textContent = `${item.sexe}. ${item.name}`;
                        selectElement.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des societes:', error));
        }

        function solde() 
        {

            const solde_caisse = document.getElementById("solde_caisse");

            $.ajax({
                url: '/api/montant_solde',
                method: 'GET',
                success: function(response) {
                    solde_caisse.textContent = response.solde.solde + ' Fcfa';
                },
                error: function() {
                    solde_caisse.textContent = '0 Fcfa';
                }
            });
        }

        function eng_ope()
        {
            const auth_id = {{ Auth::user()->id }};
            const type_ope = document.getElementById("type_ope");
            const montant_ope = document.getElementById("montant_ope");
            const nom_ope = document.getElementById("nom_ope");
            const libelle_ope = document.getElementById("libelle_ope");
            const date_ope = document.getElementById("date_ope");

            if(!type_ope.value.trim() || !montant_ope.value.trim() || !libelle_ope.value.trim() || !nom_ope.value.trim() || !date_ope.value.trim())
            {
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.', 'warning');
                return false;
            }

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/ope_caisse_new',
                method: 'GET',
                data: {
                    auth_id: auth_id,
                    type_ope: type_ope.value,
                    montant_ope: montant_ope.value,
                    nom_ope: nom_ope.value,
                    libelle_ope: libelle_ope.value,
                    date_ope: date_ope.value,
                },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    caisse_verf();

                    if (response.success) {

                        type_ope.value = '';
                        montant_ope.value = '';
                        nom_ope.value = '';
                        libelle_ope.value = '';
                        date_ope.value = '{{ date('Y-m-d') }}';

                        solde();
                        list();
                        list_ofc();

                        showAlert('Succès', 'Opération éffectuée.', 'success');
                    } else if (response.error) {

                        showAlert('Alert', 'Echec de l\'opération.','error');
                    } else if (response.solde_negatif) {
                        
                        showAlert('Alert', 'Le montant de l\'opération est supérieur au montant actuel de la caisse.','warning');
                    } else if (response.caisse_fermer) {
                        showAlert('Alert', 'La caisse est actuellement fermer, Veuillez ouvrir la caisse avant d\'éffectuer un encaissement.','info');
                    }

                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.', 'error');
                }
            });
        }

        function list(page = 1) 
        {

            const tableBody = document.querySelector('#Table tbody');
            const messageDiv = document.getElementById('message_Table');
            const tableDiv = document.getElementById('div_Table');
            const loaderDiv = document.getElementById('div_Table_loader');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const date1 = document.getElementById('searchDate1').value;
            const date2 = document.getElementById('searchDate2').value;
            const typemvt = document.getElementById('statutTrace').value;
            const user_id = document.getElementById('userTrace').value;

            if (!date1.trim() || !date2.trim()) {
                showAlert('Alert', 'Tous les champs sont obligatoires.','warning');
                return false; 
            }

            const startDate = new Date(date1);
            const endDate = new Date(date2);

            if (startDate > endDate) {
                showAlert('Erreur', 'La date de début ne peut pas être supérieur à la date de fin.', 'error');
                return false;
            }

            const oneYearInMs = 365 * 24 * 60 * 60 * 1000;
            if (endDate - startDate > oneYearInMs) {
                showAlert('Erreur', 'La plage de dates ne peut pas dépasser un an.', 'error');
                return false;
            }

            const url = `/api/trace_operation/${date1}/${date2}/${typemvt}/${user_id}?page=${page}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {

                    const traces = data.trace || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    tableBody.innerHTML = '';

                    if (traces.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        traces.forEach((item, index) => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                <td>${item.user_sexe}. ${item.user}</td>
                                <td>${item.motif}</td>
                                <td>${item.typemvt}</td>
                                ${item.typemvt == 'Entrer de Caisse' ? 
                                `<td> 
                                    <span class="fs-6 badge bg-success-subtle text-success" >
                                        + ${item.montant} Fcfa
                                    </span>
                                </td>` : 
                                `<td>
                                    <span class="fs-6 badge bg-danger-subtle text-danger" >
                                        - ${item.montant} Fcfa
                                    </span>
                                </td>`
                                }
                                ${item.date_ope == '' ? 
                                `<td>${formatDate(item.created_at)}</td>` : 
                                `<td>${formatDate(item.date_ope)}</td>`
                                }
                                <td>${formatDateHeure(item.created_at)}</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a class="btn btn-outline-warning btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Detail" id="detail-${item.id}">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </td>
                            `;
                            // Append the row to the table body
                            tableBody.appendChild(row);

                            document.getElementById(`detail-${item.id}`).addEventListener('click', () =>
                                {
                                    const modal = document.getElementById('modal_detail');
                                    modal.innerHTML = '';

                                    const div = document.createElement('div');
                                    div.innerHTML = `
                                           <div class="row gx-3">
                                                <div class="col-12">
                                                    <div class=" mb-3">
                                                        <div class="card-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item active text-center" aria-current="true">
                                                                    Informations de l'operation
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Type de Mouvement : ${item.typemvt}
                                                                </li>
                                                                <li class="list-group-item ${item.typemvt == 'Entrer de Caisse' ? 'text-success' : 'text-danger' }">
                                                                    Montant : ${item.typemvt == 'Entrer de Caisse' ? '+ '+item.montant : '- '+item.montant } Fcfa
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Motif : ${item.motif}
                                                                </li>
                                                                <li class="list-group-item text-primary">
                                                                    Solde avant opération : ${item.solde_avant} Fcfa
                                                                </li>
                                                                <li class="list-group-item text-primary">
                                                                    Solde après opération : ${item.solde_apres} Fcfa
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Créer par : ${item.user_sexe}. ${item.user} 
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Date de l'opération : ${item.date_ope == `` ? `${formatDate(item.created_at)}` : `${formatDate(item.date_ope)}` }
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Date de création : ${formatDateHeure(item.created_at)}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Libelle : ${item.libelle}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>     
                                    `;

                                    modal.appendChild(div);

                                });

                        });

                        updatePaginationControls(pagination);

                    } else {
                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'block';
                        tableDiv.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des données:', error);
                    loaderDiv.style.display = 'none';
                    messageDiv.style.display = 'block';
                    tableDiv.style.display = 'none';
                });
        }

        function updatePaginationControls(pagination) 
        {
            const paginationDiv = document.getElementById('pagination-controls');
            paginationDiv.innerHTML = '';

            // Bootstrap pagination wrapper
            const paginationWrapper = document.createElement('ul');
            paginationWrapper.className = 'pagination justify-content-center';

            // Previous button
            if (pagination.current_page > 1) {
                const prevButton = document.createElement('li');
                prevButton.className = 'page-item';
                prevButton.innerHTML = `<a class="page-link" href="#">Precédent</a>`;
                prevButton.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list(pagination.current_page - 1);
                };
                paginationWrapper.appendChild(prevButton);
            } else {
                // Disable the previous button if on the first page
                const prevButton = document.createElement('li');
                prevButton.className = 'page-item disabled';
                prevButton.innerHTML = `<a class="page-link" href="#">Precédent</a>`;
                paginationWrapper.appendChild(prevButton);
            }

            // Page number links (show a few around the current page)
            const totalPages = pagination.last_page;
            const currentPage = pagination.current_page;
            const maxVisiblePages = 5; // Max number of page links to display

            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            // Adjust start page if end page exceeds the total pages
            if (endPage - startPage < maxVisiblePages - 1) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            // Loop through pages and create page links
            for (let i = startPage; i <= endPage; i++) {
                const pageItem = document.createElement('li');
                pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
                pageItem.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                pageItem.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list(i);
                };
                paginationWrapper.appendChild(pageItem);
            }

            // Ellipsis (...) if not all pages are shown
            if (endPage < totalPages) {
                const ellipsis = document.createElement('li');
                ellipsis.className = 'page-item disabled';
                ellipsis.innerHTML = `<a class="page-link" href="#">...</a>`;
                paginationWrapper.appendChild(ellipsis);

                // Add the last page link
                const lastPageItem = document.createElement('li');
                lastPageItem.className = `page-item`;
                lastPageItem.innerHTML = `<a class="page-link" href="#">${totalPages}</a>`;
                lastPageItem.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list(totalPages);
                };
                paginationWrapper.appendChild(lastPageItem);
            }

            // Next button
            if (pagination.current_page < pagination.last_page) {
                const nextButton = document.createElement('li');
                nextButton.className = 'page-item';
                nextButton.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                nextButton.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list(pagination.current_page + 1);
                };
                paginationWrapper.appendChild(nextButton);
            } else {
                // Disable the next button if on the last page
                const nextButton = document.createElement('li');
                nextButton.className = 'page-item disabled';
                nextButton.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                paginationWrapper.appendChild(nextButton);
            }

            // Append pagination controls to the DOM
            paginationDiv.appendChild(paginationWrapper);
        }

        function list_ofc(page = 1) 
        {

            const tableBody = document.querySelector('#Table_ofc tbody');
            const messageDiv = document.getElementById('message_Table_ofc');
            const tableDiv = document.getElementById('div_Table_ofc');
            const loaderDiv = document.getElementById('div_Table_loader_ofc');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const date1 = document.getElementById('searchDate1_ofc').value;
            const date2 = document.getElementById('searchDate2_ofc').value;

            if (!date1.trim() || !date2.trim()) {
                showAlert('Alert', 'Tous les champs sont obligatoires.','warning');
                return false; 
            }

            const startDate = new Date(date1);
            const endDate = new Date(date2);

            if (startDate > endDate) {
                showAlert('Erreur', 'La date de début ne peut pas être supérieur à la date de fin.', 'error');
                return false;
            }

            const oneYearInMs = 365 * 24 * 60 * 60 * 1000;
            if (endDate - startDate > oneYearInMs) {
                showAlert('Erreur', 'La plage de dates ne peut pas dépasser un an.', 'error');
                return false;
            }

            const url = `/api/trace_ouvert_fermer/${date1}/${date2}?page=${page}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {

                    const traces = data.trace || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    tableBody.innerHTML = '';

                    if (traces.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        traces.forEach((item, index) => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                ${item.motif == 'OUVERTURE DE CAISSE' ? 
                                `<td> 
                                    <span class="fs-6 badge bg-success-subtle text-success" >
                                        ${item.motif}
                                    </span>
                                </td>` : 
                                `<td>
                                    <span class="fs-6 badge bg-danger-subtle text-danger" >
                                        ${item.motif}
                                    </span>
                                </td>`
                                }
                                <td>${item.montant} Fcfa</td>
                                <td>${item.user_sexe}. ${item.user}</td>
                                <td>${formatDateHeure(item.created_at)}</td>
                            `;
                            // Append the row to the table body
                            tableBody.appendChild(row);

                        });

                        updatePaginationControls_ofc(pagination);

                    } else {
                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'block';
                        tableDiv.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des données:', error);
                    loaderDiv.style.display = 'none';
                    messageDiv.style.display = 'block';
                    tableDiv.style.display = 'none';
                });
        }

        function updatePaginationControls_ofc(pagination) 
        {
            const paginationDiv = document.getElementById('pagination-controls_ofc');
            paginationDiv.innerHTML = '';

            // Bootstrap pagination wrapper
            const paginationWrapper = document.createElement('ul');
            paginationWrapper.className = 'pagination justify-content-center';

            // Previous button
            if (pagination.current_page > 1) {
                const prevButton = document.createElement('li');
                prevButton.className = 'page-item';
                prevButton.innerHTML = `<a class="page-link" href="#">Precédent</a>`;
                prevButton.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list_ofc(pagination.current_page - 1);
                };
                paginationWrapper.appendChild(prevButton);
            } else {
                // Disable the previous button if on the first page
                const prevButton = document.createElement('li');
                prevButton.className = 'page-item disabled';
                prevButton.innerHTML = `<a class="page-link" href="#">Precédent</a>`;
                paginationWrapper.appendChild(prevButton);
            }

            // Page number links (show a few around the current page)
            const totalPages = pagination.last_page;
            const currentPage = pagination.current_page;
            const maxVisiblePages = 5; // Max number of page links to display

            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            // Adjust start page if end page exceeds the total pages
            if (endPage - startPage < maxVisiblePages - 1) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            // Loop through pages and create page links
            for (let i = startPage; i <= endPage; i++) {
                const pageItem = document.createElement('li');
                pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
                pageItem.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                pageItem.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list_ofc(i);
                };
                paginationWrapper.appendChild(pageItem);
            }

            // Ellipsis (...) if not all pages are shown
            if (endPage < totalPages) {
                const ellipsis = document.createElement('li');
                ellipsis.className = 'page-item disabled';
                ellipsis.innerHTML = `<a class="page-link" href="#">...</a>`;
                paginationWrapper.appendChild(ellipsis);

                // Add the last page link
                const lastPageItem = document.createElement('li');
                lastPageItem.className = `page-item`;
                lastPageItem.innerHTML = `<a class="page-link" href="#">${totalPages}</a>`;
                lastPageItem.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list_ofc(totalPages);
                };
                paginationWrapper.appendChild(lastPageItem);
            }

            // Next button
            if (pagination.current_page < pagination.last_page) {
                const nextButton = document.createElement('li');
                nextButton.className = 'page-item';
                nextButton.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                nextButton.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list_ofc(pagination.current_page + 1);
                };
                paginationWrapper.appendChild(nextButton);
            } else {
                // Disable the next button if on the last page
                const nextButton = document.createElement('li');
                nextButton.className = 'page-item disabled';
                nextButton.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                paginationWrapper.appendChild(nextButton);
            }

            // Append pagination controls to the DOM
            paginationDiv.appendChild(paginationWrapper);
        }
        
        function historique() {

            const date = document.getElementById('searchDate1_bj').value;

            const contenu_total = document.getElementById('historique_total');

            const contenu = document.getElementById('historique_contenu');
            contenu.innerHTML = '';

            var preloader = `
                <div class="d-flex justify-content-center align-items-center" id="laoder_stat">
                    <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                    <strong>Chargement des données...</strong>
                </div>
            `;
            contenu.innerHTML = preloader;

            const url = `/api/historique_caisse/${date}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const traces = data.trace || [] ;
                    const ofcs = data.ofc || [] ;
                    const total = data.total ;

                    const combinedData = [...traces, ...ofcs].sort((a, b) => new Date(a.created_at) - new Date(b.created_at));

                    contenu.innerHTML = '';

                    if (combinedData.length > 0) {

                        combinedData.forEach((item) => {
                            // Si typemvt n'existe pas, utiliser motif comme typemvt
                            const typemvt = item.typemvt || item.motif || 'Motif non spécifié';

                            let borderClass = '';
                            let iconClass = '';
                            let textClass = '';

                            if (typemvt === 'Entrer de Caisse') {
                                borderClass = 'border-success';
                                iconClass = 'ri-arrow-right-up-line';
                                textClass = 'text-success';
                            } else if (typemvt === 'Sortie de Caisse') {
                                borderClass = 'border-danger';
                                iconClass = 'ri-arrow-right-down-line';
                                textClass = 'text-danger';
                            } else if (typemvt === 'OUVERTURE DE CAISSE') {
                                borderClass = 'border-primary';
                                iconClass = 'ri-door-open-line';
                                textClass = 'text-primary';
                            } else if (typemvt === 'FERMETURE DE CAISSE') {
                                borderClass = 'border-warning';
                                iconClass = 'ri-door-closed-line';
                                textClass = 'text-warning';
                            }

                            const div = document.createElement('div');
                            div.className = "p-3 border rounded-2";
                            div.innerHTML = `
                                <div class="d-flex gap-3 mb-3">
                                    <i class="border ${borderClass} p-1 rounded-3 ${iconClass} fs-1 ${textClass} lh-1"></i>
                                    <div>
                                        <h5 class="${textClass}">
                                            ${
                                                typemvt === 'Entrer de Caisse'
                                                    ? '+ ' + item.montant + ' Fcfa'
                                                    : typemvt === 'Sortie de Caisse'
                                                    ? '- ' + item.montant + ' Fcfa'
                                                    : item.montant + ' Fcfa'
                                            }
                                        </h5>
                                        <p class="opacity-100 m-0">
                                            ${item.motif || 'Motif non spécifié'}.
                                        </p>
                                    </div>
                                </div>
                                <p>
                                    Créer par David kouachi à 23H50
                                </p>
                            `;
                            contenu.appendChild(div);
                        });


                        contenu_total.innerHTML = '';

                        const divT = `
                            <h5 class="card-title">Montant Total : ${formatPrice(total)} Fcfa</h5>   
                        `;
                        contenu_total.innerHTML = divT;


                    } else {
                        
                        var message = `
                            <div class="d-flex justify-content-center align-items-center" id="historique_message">
                                <strong>Aucune données n'a été trouvées</strong>
                            </div>
                        `;
                        contenu.innerHTML = message;
                        contenu_total.innerHTML = '';

                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des données:', error);
                });
        }

    });
</script>

@endsection
