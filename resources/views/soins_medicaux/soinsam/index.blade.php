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
            Accueil
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
                        <h5>Les statistiques d'aujourd'hui.</h5>
                        <div class="mt-4 d-flex gap-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box lg bg-info rounded-5 me-3">
                                    <i class="ri-walk-line fs-1"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h2 class="m-0 lh-1" id="nbre_soinsam" ></h2>
                                    <p class="m-0">Patients Traités</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-3" >
        <div class="col-sm-12">
            <div class="card mb-3">
                <div class="card-header" hidden >
                    <h5 class="card-title">Hospitalisation</h5>
                </div>
                <div class="card-body" style="margin-top: -30px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center bg-primary bg-2" id="customTab4" role="tablist" style="background: rgba(0, 0, 0, 0.7);">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-medicine-bottle-line me-2"></i>
                                    Nouveau Soins Infirmier
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab" aria-controls="oneAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-health-book-line me-2"></i>
                                    Liste
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane active show fade" id="twoAAA" role="tabpanel" aria-labelledby="tab-twoAAA">
                                <div class="card-header">
                                    <h5 class="card-title text-left">
                                        Nouveau Soins Infirmier
                                    </h5>
                                </div>
                                <div class="row gx-3 justify-content-center align-items-center mb-4">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Patient</label>
                                            <div class="input-group">
                                                <input type="hidden" class="form-control" id="matricule_patient" autocomplete="off">
                                                <input type="text" class="form-control" id="patient" placeholder="saisie obligatoire" autocomplete="off">
                                            </div>
                                            <div class="input-group">
                                                <div class="suggestions w-100" id="suggestions_patient" style="display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_numcode" style="display: none;">
                                        <div class="mb-3">
                                            <label class="form-label">N° prise en charge</label>
                                            <div class="input-group">
                                                <span class="input-group-text">N°</span>
                                                <input type="text" class="form-control" id="numcode">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gx-3 justify-content-center align-items-center mb-4">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Type de Soins Infirmer</label>
                                            <select class="form-select" id="typesoins_id"></select>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_selectSoins" class="border border-2 mb-3 p-2" >
                                    <div class="card-header">
                                        <h5 class="card-title text-center">
                                            Choix des Soins Infirmiers
                                        </h5>
                                    </div>
                                    <div class="row gx-3 justify-content-center align-items-center">
                                        <div class="col-lg-8 col-12">
                                            <div class="row gx-3 justify-content-center align-items-center">
                                                <div id="div_alert_soins" ></div>
                                                <div class="col-12 mb-3 text-center">
                                                    <button type="button" id="add_select_soins" class="btn btn-info">
                                                        <i class="ri-sticky-note-add-line"></i>
                                                        Ajouter un Soins
                                                    </button>
                                                </div>
                                                <div class="col-12" id="contenu_soins">

                                                </div>
                                                <div class="col-12" id="div_btn_soins" style="display: none;">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            Montant Total
                                                        </span>
                                                        <input readonly type="tel" class="form-control" id="montant_total_soins" placeholder="Montant Total">
                                                        <span class="input-group-text">Fcfa</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_selectProduit" class="border border-2 mb-3 p-2" >
                                    <div class="card-header">
                                        <h5 class="card-title text-center">
                                            Choix des Produits Utilisés
                                        </h5>
                                    </div>
                                    <div class="row gx-3 justify-content-center align-items-center" >
                                        <div class="col-lg-8 col-12">
                                            <div class="row gx-3 justify-content-center align-items-center">
                                                <div id="div_alert_produit_qu" ></div>
                                                <div class="col-12 mb-3 text-center">
                                                    <button type="button" id="add_select_produit" class="btn btn-info">
                                                        <i class="ri-sticky-note-add-line"></i>
                                                        Ajouter un Produit
                                                    </button>
                                                </div>
                                                <div class="col-12" id="contenu_produit">

                                                </div>
                                                <div class="col-12" id="div_btn_pro" style="display: none;">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            Montant Total
                                                        </span>
                                                        <input readonly type="tel" class="form-control" id="montant_total_produit" placeholder="Montant Total">
                                                        <span class="input-group-text">Fcfa</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_btn_calcul" class="border border-2 mb-3 p-2" >
                                    <div class="card-header">
                                        <h5 class="card-title text-center">
                                            Informations Montant
                                        </h5>
                                    </div>
                                    <div class="row gx-3 justify-content-center align-items-center" >
                                        <div class="col-sm-12 mb-3">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button id="btn_calcul" class="btn btn-warning">
                                                    Calculer le montant final
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gx-3" id="div_calcul" style="display: none;">
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Taux</label>
                                                <div class="input-group">
                                                    <input readonly type="tel" class="form-control" id="patient_taux">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Part Assurance</label>
                                                <div class="input-group">
                                                    <input readonly type="tel" class="form-control" id="montant_assurance">
                                                    <input type="hidden" class="form-control" id="montant_assurance_hidden">
                                                    <span class="input-group-text">Fcfa</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Part Patient</label>
                                                <div class="input-group">
                                                    <input readonly type="tel" class="form-control" id="montant_patient">
                                                    <input type="hidden" class="form-control" id="montant_patient_hidden">
                                                    <span class="input-group-text">Fcfa</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Montant Total</label>
                                                <div class="input-group">
                                                    <input readonly type="tel" class="form-control" id="montant_total">
                                                    <span class="input-group-text">Fcfa</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Remise</label>
                                                <div class="input-group">
                                                    <input type="tel" class="form-control" id="taux_remise" value="0">
                                                    <span class="input-group-text">Fcfa</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Application de la remise</label>
                                                <select class="form-select" id="appliq_remise">
                                                    <option selected value="patient">Patient</option>
                                                    <option value="assurance">Assurance</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_assurance_utiliser" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label">Utilisé l'assurance</label>
                                                <select class="form-select" id="assurance_utiliser">
                                                    <option selected value="oui">Oui</option>
                                                    <option value="non">Non</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button id="btn_eng" class="btn btn-success">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div_loader" style="display: none;">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                            <strong>Calcul en cours...</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="oneAAA" role="tabpanel" aria-labelledby="tab-oneAAA">
                                <div class="row gx-3" >
                                    <div class="col-12">
                                        <div class=" mb-3">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="card-title">
                                                    Liste des Soins Ambulatoires
                                                </h5>
                                            </div>
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <div class="w-100">
                                                    <div class="input-group">
                                                        <span class="input-group-text">Du</span>
                                                        <input type="date" id="searchDate1" placeholder="Recherche" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                                        <span class="input-group-text">au</span>
                                                        <input type="date" id="searchDate2" placeholder="Recherche" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                                        <span class="input-group-text">Statut</span>
                                                        <select class="form-select me-1" id="statut">
                                                            <option selected value="tous">Tous</option>
                                                            <option value="en cours">En cours</option>
                                                            <option value="terminé">Terminé</option>
                                                        </select>
                                                        <a id="btn_search_table" class="btn btn-outline-success ms-auto">
                                                            <i class="ri-search-2-line"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-outer" id="div_Table" style="display: none;">
                                                    <div class="table-responsive">
                                                        <table class="table align-middle table-hover m-0 truncate" id="Table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">N°</th>
                                                                    <th scope="col">Statut</th>
                                                                    <th scope="col">Type de Soins</th>
                                                                    <th scope="col">Nom et Prénoms</th>
                                                                    <th scope="col">Soins Infirmiers</th>
                                                                    <th scope="col">Produits</th>
                                                                    <th scope="col">Montant Total</th>
                                                                    <th scope="col">Date de création</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div id="message_Table" style="display: none;">
                                                    <p class="text-center" >
                                                        Aucun Soins Ambulatoires pour le moment
                                                    </p>
                                                </div>
                                                <div id="div_Table_loader" style="display: none;">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                                        <strong>Chargement des données...</strong>
                                                    </div>
                                                </div>
                                                <div id="pagination-controls" ></div>
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


<div class="modal fade" id="Detail" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">
                    Détails
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal_detail" style="display: none;">
            </div>
            <div id="message_detail" style="display: none;">
                <p class="text-center" >
                    Aucun détail pour le moment
                </p>
            </div>
            <div id="div_detail_loader" style="display: none;">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                    <strong>Chargement des données...</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Add" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >
                    Produits Pharmacie
                </h5>
                <button type="button" id="close_modal_produit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal_add">
                <div class="row gx-3 justify-content-center align-items-center">
                    <div class="col-12 mb-3">
                        <button type="button" id="add_select" class="btn btn-info">
                            <i class="ri-sticky-note-add-line"></i>
                            Ajouter un Produit
                        </button>
                    </div>
                    <div class="col-12" id="contenu">

                    </div>
                    <div class="col-12" id="div_btn_pro">
                        <div class="input-group mb-3">
                            <input type="tel" class="form-control" id="montant_total_produit" placeholder="Montant Total">
                            <span class="input-group-text">Fcfa</span>
                        </div>
                        <input type="hidden" id="id_hos_produit">
                        <button type="button" id="btn_eng_produit" class="btn btn-outline-success">
                            Enregistrer
                            <i class="ri-send-plane-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Detail_produit" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">
                    Détail Soins Infirmiers et Produits Utilisés
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive" id="div_TableP" style="display: none;">
                                            <!-- Tableau Soins Infirmiers -->
                                            <table class="table table-bordered" id="TableP">
                                                <thead>
                                                    <tr>
                                                        <th>Soins Infirmiers</th>
                                                        <th style="width: 250px;">Prix</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="table-responsive" id="div_TableProdP" style="display: none;">
                                            <!-- Tableau Produits Utilisés -->
                                            <table class="table table-bordered" id="TableProdP">
                                                <thead>
                                                    <tr>
                                                        <th>Produits Utilisés</th>
                                                        <th style="width: 200px;">Prix Unitaire</th>
                                                        <th style="width: 50px;" >Quantité</th>
                                                        <th style="width: 200px;">Prix Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div id="message_TableP" style="display: none;">
                                            <p class="text-center" >
                                                Aucun détail pour le moment
                                            </p>
                                        </div>
                                        <div id="div_Table_loaderP" style="display: none;">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                                <strong>Chargement des données...</strong>
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

<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>
<script src="{{asset('jsPDF-AutoTable/dist/jspdf.plugin.autotable.min.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        Statistique();
        Name_atient();
        select_typesoins();
        list();

        document.getElementById("btn_calcul").addEventListener("click", CalculMontant);
        document.getElementById("assurance_utiliser").addEventListener("change", CalculMontant);
        document.getElementById("btn_eng").addEventListener("click", Eng_sa);
        document.getElementById("btn_search_table").addEventListener("click", list);

        function Name_atient() {
            $.ajax({
                url: '/api/name_patient',
                method: 'GET',
                success: function(response) {
                    const data = response.name;

                    // Elements
                    const input = document.getElementById('patient');
                    const matricule_patient = document.getElementById('matricule_patient');
                    const suggestionsDiv = document.getElementById('suggestions_patient');
                    const patient_taux = document.getElementById('patient_taux');
                    const appliq_remise = document.getElementById('appliq_remise');
                    
                    let patientSelected = false;  // Variable to track if a patient was selected

                    // Event listener for input typing
                    function displaySuggestions() {

                        const searchTerm = input.value.toLowerCase();
                        
                        // Clear previous suggestions
                        suggestionsDiv.style.display = 'block';
                        suggestionsDiv.innerHTML = '';

                        // Filter data based on input
                        const filteredData = data.filter(item => item.np.toLowerCase().includes(searchTerm));

                        // Display filtered data
                        filteredData.forEach(item => {
                            const suggestion = document.createElement('div');
                            suggestion.innerText = item.np;
                            suggestion.addEventListener('click', function() {
                                // Set selected data in the input field
                                input.value = item.np;
                                matricule_patient.value = item.matricule;
                                suggestionsDiv.innerHTML = ''; // Clear suggestions
                                suggestionsDiv.style.display = 'none';

                                // Assign patient rate (taux)
                                patient_taux.value = item.taux ? item.taux : 0;

                                document.getElementById('numcode').value = '';
                                if (item.assurer == 'oui') {
                                    document.getElementById('div_numcode').style.display = 'block';
                                }else{
                                    document.getElementById('div_numcode').style.display = 'none';
                                }

                                if (patient_taux.value == 0) {
                                    document.getElementById('div_assurance_utiliser').style.display = 'none';
                                }else{
                                   document.getElementById('div_assurance_utiliser').style.display = 'block'; 
                                }

                                patientSelected = true; // Mark patient as selected
                                document.getElementById('div_calcul').style.display = 'none';
                            });
                            suggestionsDiv.appendChild(suggestion);
                        });

                        // Show/hide suggestions based on results
                        suggestionsDiv.style.display = filteredData.length > 0 ? 'block' : 'none';

                        // If the input is modified, reset matricule_patient and taux
                        if (patientSelected) {
                            matricule_patient.value = '';  // Clear matricule
                            patient_taux.value = '';  // Clear taux
                            patientSelected = false; // Reset patient selection flag
                            document.getElementById('div_calcul').style.display = 'none';
                        }
                    }

                    input.addEventListener('focus', function() {
                        displaySuggestions();
                    });

                    input.addEventListener('input', function() {
                        displaySuggestions();
                    });

                    document.addEventListener('click', function(e) {
                        if (!suggestionsDiv.contains(e.target) && e.target !== input) {
                            suggestionsDiv.style.display = 'none';
                        }
                    });
                },
                error: function() {
                    // Handle error
                }
            });
        }

        function showAlert(title, message, type) {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
            });
        }

        // -----------------------------------------------------

        function select_typesoins() {
            const selectElement = document.getElementById('typesoins_id');

            // Clear existing options
            selectElement.innerHTML = '';

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Selectionner';
            selectElement.appendChild(defaultOption);

            $.ajax({
                url: '/api/list_typesoins',
                method: 'GET',
                success: function(response) {
                    data = response.typesoins;
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id; // Ensure 'id' is the correct key
                        option.textContent = item.nom; // Ensure 'nom' is the correct key
                        selectElement.appendChild(option);
                    });
                },
                error: function() {
                    // showAlert('danger', 'Impossible de generer le code automatiquement');
                }
            });

            selectElement.addEventListener('change', function() {
                const id = this.value;
                
                if (id) {
                    const url = '/api/select_soinsIn/' + id;
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {

                            const soinsins = data.soinsin;

                            const contenuDiv = document.getElementById('contenu_soins');
                            contenuDiv.innerHTML = '';

                            document.getElementById('montant_total_soins').value ='';
                                                    
                            addSelectSoins(contenuDiv, soinsins); // Ajouter le premier select
                        })
                        .catch(error => {
                            console.error('Erreur lors du chargement des données:', error);
                        });
                }else{
                    const contenuDiv = document.getElementById('contenu_soins');
                    contenuDiv.innerHTML = '';

                    checkContenuSoins();
                }
                
            });
        }

        function addSelectSoins(parentDiv, soinsins) {
            const div = document.createElement('div');
            div.className = 'mb-3';

            // Créer le groupe de contrôle contenant le select et le bouton supprimer
            div.innerHTML = `
                <div class="input-group">
                    <select class="form-select soins-select w-50">
                        <option value="">Sélectionner</option>
                        ${soinsins.map(item => `<option value="${item.id}" data-prix="${item.prix.replace(/\./g, '')}">${item.nom} / ${item.prix} Fcfa</option>`).join('')}
                    </select>
                    <button class="btn btn-outline-danger suppr-btn">Supprimer</button>
                </div>
            `;

            // Ajouter l'élément dans le parent (contenu div)
            parentDiv.appendChild(div);

            checkContenuSoins();

            // Ajouter un event listener pour le bouton supprimer
            div.querySelector('.suppr-btn').addEventListener('click', () => {
                div.remove(); // Supprimer l'élément div parent
                checkContenuSoins(); // Re-vérifier le contenu
                updateMontantTotalSoins(); // Mettre à jour le montant total après la suppression
            });

            // Event listener pour le select
            const produitSelect = div.querySelector('.soins-select');
            produitSelect.addEventListener('change', function() {
                updateMontantTotalSoins();
            });
        }

        function updateMontantTotalSoins() {
            let montantTotal = 0;
            const selects = document.querySelectorAll('.soins-select');
            
            selects.forEach(select => {
                const selectedOption = select.options[select.selectedIndex];
                const prix = selectedOption.getAttribute('data-prix');
                
                if (prix) {
                    montantTotal += parseInt(prix); // Ajouter le prix à la somme totale
                }
            });
            
            // Formater le montant total avec des points
            const montantTotalFormatted = montantTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            document.getElementById('montant_total_soins').value = montantTotalFormatted;
        }

        function checkContenuSoins() {
            const contenuDiv = document.getElementById('contenu_soins');
            const divBtnPro = document.getElementById('div_btn_soins');
            
            // Si la div #contenu a un contenu, on affiche le bouton, sinon on le cache
            if (contenuDiv.innerHTML.trim() !== "") {
                divBtnPro.style.display = "block"; // Afficher le bouton
            } else {
                divBtnPro.style.display = "none";  // Cacher le bouton
            }
        }

        document.getElementById('add_select_soins').addEventListener('click', () => {
            const contenuDiv = document.getElementById('contenu_soins');
            const id = document.getElementById('typesoins_id').value;

            if (id == '') {
                showAlert("ALERT", "Selectionner un Type de Soins.", "warning");
            }

            const url = '/api/select_soinsIn/' + id;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {

                        const soinsins = data.soinsin;

                        const contenuDiv = document.getElementById('contenu_soins');
                                                
                        addSelectSoins(contenuDiv, soinsins); // Ajouter le premier select
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des données:', error);
                    });
        });

        // -------------------------------------------------------

        function addSelect(parentDiv, produits) {
            const div = document.createElement('div');
            div.className = 'mb-3';

            // Créer le groupe de contrôle contenant le select et le bouton supprimer
            div.innerHTML = `
                <div class="input-group">
                    <select class="form-select produit-select w-50">
                        <option value="">Sélectionner</option>
                        ${produits.map(produit => `<option value="${produit.id}" data-prix="${produit.prix.replace(/\./g, '')}" data-quantite="${produit.quantite}">${produit.nom} / ${produit.quantite} / ${produit.prix} Fcfa</option>`).join('')}
                    </select>
                    <input type="tel" id="quantite_demande" class="form-control" placeholder="Quantité" value="1" maxlength="2">
                    <button class="btn btn-outline-danger suppr-btn">Supprimer</button>
                </div>
            `;

            // Ajouter l'élément dans le parent (contenu div)
            parentDiv.appendChild(div);

            checkContenu(); // Vérifier le contenu et gérer la visibilité du bouton enregistrer

            // Ajouter un event listener pour le bouton supprimer
            div.querySelector('.suppr-btn').addEventListener('click', () => {
                div.remove(); // Supprimer l'élément div parent
                checkContenu(); // Re-vérifier le contenu
                updateMontantTotal(); // Mettre à jour le montant total après la suppression
            });

            const quantiteInput = div.querySelector('#quantite_demande');
            const produitSelect = div.querySelector('.produit-select');

            // Validation pour n'accepter que des valeurs numériques
            quantiteInput.addEventListener('keypress', function(event) {
                const key = event.key;
                if (isNaN(key)) {
                    event.preventDefault();
                }
            });

            // Validation de la quantité saisie pour ne pas dépasser la quantité disponible
            produitSelect.addEventListener('change', function() {
                const selectedOption = produitSelect.options[produitSelect.selectedIndex];
                const quantiteDisponible = parseInt(selectedOption.dataset.quantite);
                
                // Réinitialiser la quantité demandée à 1
                quantiteInput.value = 1;

                // Si la quantité est supérieure à la quantité disponible, ajuster
                if (quantiteDisponible < 1) {
                    quantiteInput.value = 1; // S'assurer que la quantité ne soit pas négative
                }

                updateMontantTotal(); // Mettre à jour le montant total après changement de produit
            });

            // Vérification lors de la perte de focus
            quantiteInput.addEventListener('blur', function() {
                const selectedOption = produitSelect.options[produitSelect.selectedIndex];
                const quantiteDisponible = parseInt(selectedOption.dataset.quantite);
                
                if (parseInt(quantiteInput.value) > quantiteDisponible) {
                    showAlert("ALERT",`La quantité demandée ne peut pas dépasser ${quantiteDisponible}.`, "warning");
                    quantiteInput.value = quantiteDisponible;
                }else if(quantiteInput.value == ''){
                    quantiteInput.value = 1;
                }

                if(!selectedOption.value == ''){
                    updateMontantTotal();
                } // Mettre à jour le montant total lors de la perte de focus
            });
        }

        function updateMontantTotal() {
            let montantTotal = 0;
            const selects = document.querySelectorAll('.produit-select');

            selects.forEach(select => {
                const selectedOption = select.options[select.selectedIndex];

                // Vérifier si une option valide est sélectionnée
                if (selectedOption.value) {
                    const prix = parseInt(selectedOption.dataset.prix) || 0; // Si 'prix' est invalide ou manquant, utiliser 0
                    const quantite = parseInt(select.parentElement.querySelector('#quantite_demande').value) || 1; // Si la quantité est invalide, utiliser 1 par défaut
                    montantTotal += prix * quantite;
                }
            });

            // Formater le montant total avec des points
            const montantTotalFormatted = montantTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            document.getElementById('montant_total_produit').value = montantTotalFormatted;
        }

        function checkContenu() {
            const contenuDiv = document.getElementById('contenu_produit');
            const divBtnPro = document.getElementById('div_btn_pro');
            
            // Si la div #contenu a un contenu, on affiche le bouton, sinon on le cache
            if (contenuDiv.innerHTML.trim() !== "") {
                divBtnPro.style.display = "block"; // Afficher le bouton
            } else {
                divBtnPro.style.display = "none";
                document.getElementById('montant_total_produit').value = '';
            }
        }

        document.getElementById('add_select_produit').addEventListener('click', () => {
            const contenuDiv = document.getElementById('contenu_produit');
            // Récupérer les produits à partir de l'API
            fetch(`/api/list_produit_all`)
                .then(response => response.json())
                .then(data => {
                    const contenuDiv = document.getElementById('contenu_produit');
                    const produits = data.produit;
                    // Ajouter un nouveau select avec les produits
                    addSelect(contenuDiv, produits);
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des produits:', error);
                });
        });

        function formatPrice(input) {
            // Remove all non-numeric characters except the comma
            input = input.replace(/[^\d,]/g, '');

            // Convert comma to dot for proper float conversion
            input = input.replace(',', '.');

            // Convert to float and round to the nearest whole number
            let number = Math.round(parseInt(input));
            if (isNaN(number)) {
                return '';
            }

            // Format the number with dot as thousands separator
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function formatPriceT(price) {

            // Convert to float and round to the nearest whole number
            let number = Math.round(parseInt(price));
            if (isNaN(number)) {
                return '';
            }

            // Format the number with dot as thousands separator
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // -----------------------------------------------------

        function CalculMontant() {

            document.getElementById('div_loader').style.display = 'block';
            document.getElementById('div_calcul').style.display = 'none';
            document.getElementById('btn_calcul').style.display = 'none';

            const matricule_patient = document.getElementById('matricule_patient').value;
            const typesoins_id = document.getElementById('typesoins_id').value;

            // 1. Vérifier si le matricule du patient est renseigné
            if (matricule_patient === '') {
                showAlert("ALERT", "Veuillez sélectionner un Patient.", "warning");
                resetLoaderAndButton();
                return false;
            }

            // 2. Vérifier si un type de soins a été sélectionné
            if (typesoins_id === '') {
                showAlert("ALERT", "Veuillez sélectionner un Type de Soins.", "warning");
                resetLoaderAndButton();
                return false;
            }

            const contenuDiv = document.getElementById('contenu_soins');
            if (contenuDiv.innerHTML.trim() == "") {
                showAlert("ALERT", 'Aucun Soins Infirmier n\'a été sélectionné.', "warning");
                resetLoaderAndButton();
                return false;
            }

            let formIsValid = true;
            const selectionsSoins = [];
            const selectionsProduits = [];

            // 3. Vérifier si tous les soins infirmiers ont été sélectionnés
            const soinsSelects = document.querySelectorAll('.soins-select');
            const selectedSoinsIds = new Set();

            soinsSelects.forEach(item => {
                const selectedOption = item.options[item.selectedIndex];
                const idSoins = selectedOption.value;
                const montant = parseInt(selectedOption.dataset.prix);

                if (!idSoins || isNaN(montant)) {
                    showAlert("ALERT", 'Aucun Soins Infirmier n\'a été sélectionné.', "warning");
                    formIsValid = false;
                    return false;
                }

                if (selectedSoinsIds.has(idSoins)) {
                    showAlert("ALERT", 'Vous avez sélectionné le même Soins Infirmier plusieurs fois.', "warning");
                    formIsValid = false;
                    return false;
                }

                selectedSoinsIds.add(idSoins);
                selectionsSoins.push({
                    id: idSoins,
                    montant: montant
                });
            });

            const contenuDivPro = document.getElementById('contenu_produit');
            if (contenuDivPro.innerHTML.trim() == "") {
                showAlert("ALERT", 'Aucun Produit n\'a été sélectionné.', "warning");
                resetLoaderAndButton();
                return false;
            }

            // 4. Vérifier si tous les produits ont été sélectionnés et validés
            const produitsSelects = document.querySelectorAll('.produit-select');
            const selectedProduitIds = new Set();

            produitsSelects.forEach(select => {
                const selectedOption = select.options[select.selectedIndex];
                const idProduit = selectedOption.value;
                const quantiteDemande = parseInt(select.parentElement.querySelector('#quantite_demande').value);
                const prix = parseInt(selectedOption.dataset.prix);

                if (!idProduit || isNaN(quantiteDemande) || quantiteDemande <= 0) {
                    showAlert("ALERT", 'Veuillez sélectionner un ou plusieurs Produits avec une quantité valide.', "warning");
                    formIsValid = false;
                    return false;
                }

                if (selectedProduitIds.has(idProduit)) {
                    showAlert("ALERT", 'Vous avez sélectionné le même Produit plusieurs fois.', "warning");
                    formIsValid = false;
                    return false;
                }

                selectedProduitIds.add(idProduit);
                selectionsProduits.push({
                    id: idProduit,
                    quantite: quantiteDemande,
                    montant: prix * quantiteDemande
                });
            });

            if (!formIsValid) {
                resetLoaderAndButton();
                return false;
            }

            // 5. Calcul du montant total des soins infirmiers et des produits
            const montantTotalSoins = selectionsSoins.reduce((total, soin) => total + soin.montant, 0);
            const montantTotalProduits = selectionsProduits.reduce((total, produit) => total + produit.montant, 0);
            const montantTotal = montantTotalSoins + montantTotalProduits;

            // 6. Calcul de la part de l'assurance et celle du patient
            let taux = parseInt(document.getElementById('patient_taux').value) || 0;

            const auS = document.getElementById('assurance_utiliser').value;
            const appliq_remise = document.getElementById('appliq_remise');
            const taux_remise = document.getElementById('taux_remise');

            let montantAssurance = 0;
            let montantPatient = 0;

            if (auS === 'non' || taux === 0) {
                taux = 0; // Exclure le taux d'assurance
                appliq_remise.value = 'patient'; // Appliquer la remise au patient
                appliq_remise.querySelector('option[value="assurance"]').style.display = 'none'; // Cacher l'option "Assurance"
                
                // Calcul du montant total payé uniquement par le patient
                montantAssurance = 0;
                montantPatient = Math.round(montantTotal);
                
            } else {
                appliq_remise.querySelector('option[value="assurance"]').style.display = ''; // Afficher l'option "Assurance"

                // Calcul de la part de l'assurance et du patient
                montantAssurance = Math.round(montantTotal * (taux / 100));
                montantPatient = Math.round(montantTotal - montantAssurance);
            }

            // Fonction pour formater les montants
            const formatMontant = montant => montant.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Afficher les résultats
            document.getElementById('montant_total').value = formatMontant(montantTotal);
            document.getElementById('montant_assurance_hidden').value = formatMontant(montantAssurance);
            document.getElementById('montant_assurance').value = formatMontant(montantAssurance);
            document.getElementById('montant_patient_hidden').value = formatMontant(montantPatient);
            document.getElementById('montant_patient').value = formatMontant(montantPatient);

            document.getElementById('btn_calcul').style.display = 'block';
            document.getElementById('div_calcul').style.display = 'flex';
            document.getElementById('div_loader').style.display = 'none';

            traitRemise();

            return true;
        }

        function resetLoaderAndButton() {
            document.getElementById('div_loader').style.display = 'none';
            document.getElementById('btn_calcul').style.display = 'block';
        }

        document.getElementById('taux_remise').addEventListener('input', function() {
            // Nettoyer la valeur entrée en supprimant les caractères non numériques
            const rawValue = this.value.replace(/[^0-9]/g, ''); 
            // Ajouter des points pour les milliers
            const formattedValue = formatPrice(rawValue);
            
            // Mettre à jour la valeur du champ avec la valeur formatée
            this.value = formattedValue;

            const appliq_remise = document.getElementById('appliq_remise').value;
            const assuranceUtiliser = document.getElementById('assurance_utiliser').value; // Récupérer la valeur 'oui' ou 'non'
            
            const montant_total = parseInt(document.getElementById('montant_total').value.replace(/\./g, '')) || 0;

            if (assuranceUtiliser == 'non') {
                // Si l'assurance n'est pas utilisée, montant_patient = montant_total
                const montant_patient = montant_total;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant après remise
                const montantRemis = montant_patient - remise;

                // Afficher les valeurs formatées
                document.getElementById('montant_patient_hidden').value = montant_patient; // Stocker le montant_patient
                document.getElementById('montant_patient').value = formatPriceT(montantRemis);

            } else if (appliq_remise == 'patient') {
                // Si la remise s'applique au patient
                const montant_patient = parseInt(document.getElementById('montant_patient_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant après remise
                const montantRemis = montant_patient - remise;
                document.getElementById('montant_patient').value = formatPriceT(montantRemis);
            
            } else if (appliq_remise == 'assurance') {
                // Si la remise s'applique à l'assurance
                const montant_assurance = parseInt(document.getElementById('montant_assurance_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant après remise
                const montantRemis = montant_assurance - remise;
                document.getElementById('montant_assurance').value = formatPriceT(montantRemis);
            }
        });

        function traitRemise() {
            // Nettoyer la valeur entrée en supprimant les caractères non numériques
            const rawValue = document.getElementById('taux_remise').value.replace(/[^0-9]/g, ''); 
            // Ajouter des points pour les milliers
            const formattedValue = formatPrice(rawValue);
            
            // Mettre à jour la valeur du champ avec la valeur formatée
            document.getElementById('taux_remise').value = formattedValue;

            const appliq_remise = document.getElementById('appliq_remise').value;
            const assuranceUtiliser = document.getElementById('assurance_utiliser').value; // Récupérer la valeur 'oui' ou 'non'
            
            const montant_total = parseInt(document.getElementById('montant_total').value.replace(/\./g, '')) || 0;

            if (assuranceUtiliser == 'non') {
                // Si l'assurance n'est pas utilisée, montant_patient = montant_total
                const montant_patient = montant_total;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant après remise
                const montantRemis = montant_patient - remise;

                // Afficher les valeurs formatées
                document.getElementById('montant_patient_hidden').value = montant_patient; // Stocker le montant_patient
                document.getElementById('montant_patient').value = formatPriceT(montantRemis);

            } else if (appliq_remise == 'patient') {
                // Si la remise s'applique au patient
                const montant_patient = parseInt(document.getElementById('montant_patient_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant après remise
                const montantRemis = montant_patient - remise;
                document.getElementById('montant_patient').value = formatPriceT(montantRemis);
            
            } else if (appliq_remise == 'assurance') {
                // Si la remise s'applique à l'assurance
                const montant_assurance = parseInt(document.getElementById('montant_assurance_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant après remise
                const montantRemis = montant_assurance - remise;
                document.getElementById('montant_assurance').value = formatPriceT(montantRemis);
            }
        }

        document.getElementById('appliq_remise').addEventListener('change', function() {

            document.getElementById('montant_assurance').value = formatPrice(document.getElementById('montant_assurance_hidden').value);
            document.getElementById('montant_patient').value = formatPrice(document.getElementById('montant_patient_hidden').value);

            // Nettoyer la valeur entrée en supprimant les caractères non numériques sauf le point
            const rawValue = document.getElementById('taux_remise').value.replace(/[^0-9]/g, ''); 

            const assuranceUtiliser = document.getElementById('assurance_utiliser').value; // Récupérer la valeur 'oui' ou 'non'

            if (this.value == 'patient' || assuranceUtiliser == 'non') {
                // Convertir la valeur formatée en nombre pour les calculs
                const montant_patient = parseInt(document.getElementById('montant_patient_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_patient - remise;
                document.getElementById('montant_patient').value = formatPriceT(montantRemis);
            } else if (assuranceUtiliser == 'oui') {
                // Si l'assurance est utilisée (valeur 'oui'), calculer le montant remis pour l'assurance
                const montant_assurance = parseInt(document.getElementById('montant_assurance_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_assurance - remise;
                document.getElementById('montant_assurance').value = formatPriceT(montantRemis);
            }
        });

        // -----------------------------------------------------

        function Eng_sa() {

            try {
                const calculResult = CalculMontant();
                if (!calculResult) {
                    return false;
                }
            } catch (error) {
                showAlert("ERREUR","Veuillez bien vérifier les données saisies", "error");
                return false;
            }
            
            const selectionsSoins = [];
            const soinsSelects = document.querySelectorAll('.soins-select');
            soinsSelects.forEach(item => {

                const selectedOption = item.options[item.selectedIndex];
                const idSoins = selectedOption.value;
                const montant = parseInt(selectedOption.dataset.prix);

                selectionsSoins.push({
                    id: idSoins,
                    montant: montant
                });
            });

            const selectionsProduits = [];
            const produitsSelects = document.querySelectorAll('.produit-select');
            produitsSelects.forEach(select => {

                const selectedOption = select.options[select.selectedIndex];
                const idProduit = selectedOption.value;
                const quantiteDemande = parseInt(select.parentElement.querySelector('#quantite_demande').value);
                const prix = parseInt(selectedOption.dataset.prix);

                selectionsProduits.push({
                    id: idProduit,
                    quantite: quantiteDemande,
                    montant: prix * quantiteDemande
                });
            });

            const auth_id = {{ Auth::user()->id }};
            const matricule_patient = document.getElementById('matricule_patient').value;
            const typesoins_id = document.getElementById('typesoins_id').value;

            if (matricule_patient == '') {
                showAlert("ALERT", 'Veuillez sélectionner un Patient.', "warning");
                return false;
            }

            if (typesoins_id == '') {
                showAlert("ALERT", 'Veuillez sélectionner un Type de Soins.', "warning");
                return false;
            }

            var montant_assurance = document.getElementById('montant_assurance').value;
            var taux_remise = document.getElementById('taux_remise').value;
            var montant_total = document.getElementById('montant_total').value;
            var montant_patient = document.getElementById('montant_patient').value;
            var assurance_utiliser = document.getElementById('assurance_utiliser').value;

            // Validate monetary fields
            if (!montant_assurance || 
                !montant_total || 
                !montant_patient) {
                
                showAlert("ALERT", 'Vérifier les montants SVP.', "warning");
                return false; 
            }

            var montantAssuranceValue = parseFloat(montant_assurance);
            var montantTotalValue = parseFloat(montant_total);
            var montantPatientValue = parseFloat(montant_patient);

            if (isNaN(montantAssuranceValue) || 
                isNaN(montantTotalValue) || 
                isNaN(montantPatientValue) || 
                montantAssuranceValue < 0 || 
                montantTotalValue < 0 || 
                montantPatientValue < 0) {
                
                showAlert("ALERT", 'Vérifier les montants SVP (les montants ne doivent pas être négatifs).', "warning");
                return false;
            }

            var numcode = document.getElementById('numcode').value;

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/new_soinsam/',
                method: 'GET',
                data:{
                    selectionsSoins: selectionsSoins,
                    selectionsProduits: selectionsProduits,
                    montantAssurance: montant_assurance,
                    montantRemise: taux_remise,
                    montantTotal: montant_total,
                    montantPatient: montant_patient,
                    matricule_patient: matricule_patient,
                    typesoins_id: typesoins_id,
                    numcode: numcode || null,
                    assurance_utiliser: assurance_utiliser,
                    auth_id: auth_id,
                },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.success) {

                        document.getElementById('div_calcul').style.display = 'none';
                        document.getElementById('typesoins_id').value = "";
                        document.getElementById('matricule_patient').value = "";
                        document.getElementById('patient').value = "";

                        const contenuDiv = document.getElementById('contenu_soins');
                        contenuDiv.innerHTML = "";
                        document.getElementById('div_btn_soins').style.display = 'none';

                        const contenuDivPro = document.getElementById('contenu_produit');
                        contenuDivPro.innerHTML = "";
                        document.getElementById('div_btn_pro').style.display = 'none';      

                        showAlert("ALERT", 'Enregistrement éffectué', "success");

                        list();
                        Statistique();

                        var newConsultationTab = new bootstrap.Tab(document.getElementById('tab-oneAAA'));
                        newConsultationTab.show();
                        newConsultationTab.active();

                    } else if (response.error) {
                        showAlert("ERREUR", 'Une erreur est survenue', "error");
                    } else if (response.json) {
                        showAlert("ERREUR", 'Invalid selections format', "error");
                    }

                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert("ERREUR", 'Une erreur est survenue lors de l\'enregistrement', "error");
                }
            });
        };

        // -----------------------------------------------------

        function list(page = 1) {

            const tableBody = document.querySelector('#Table tbody');
            const messageDiv = document.getElementById('message_Table');
            const tableDiv = document.getElementById('div_Table');
            const loaderDiv = document.getElementById('div_Table_loader');

            const date1 = document.getElementById('searchDate1').value;
            const date2 = document.getElementById('searchDate2').value;

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            // Fetch data from the API
            const statut = document.getElementById('statut').value;
            const url = `/api/list_soinsam_all/${date1}/${date2}/${statut}?page=${page}`;
            fetch(url) // API endpoint
                .then(response => response.json())
                .then(data => {

                    const spatients = data.spatient || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    // Clear any existing rows in the table body
                    tableBody.innerHTML = '';

                    if (spatients.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        // Loop through each item in the chambre array
                        spatients.forEach((item, index) => {
                            // Create a new row
                            const row = document.createElement('tr');
                            // Create and append cells to the row based on your table's structure
                            row.innerHTML = `
                                <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                <td>
                                    ${item.statut === 'en cours' ? 
                                        `<span class="badge bg-danger">${item.statut}</span>` : 
                                        `<span class="badge bg-success">${item.statut}</span>`}
                                </td>
                                <td>${item.type}</td>
                                <td>${item.patient}</td>
                                <td>${item.nbre_soins}</td>
                                <td>${item.nbre_produit}</td>
                                <td>${item.montant} Fcfa</td>
                                <td>${formatDateHeure(item.created_at)}</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a class="btn btn-outline-danger btn-sm" id="detail_produit-${item.id}" data-bs-toggle="modal" data-bs-target="#Detail_produit">
                                            <i class="ri-archive-2-fill"></i>
                                        </a>
                                        <a class="btn btn-outline-warning btn-sm" id="detail-${item.id}" data-bs-toggle="modal" data-bs-target="#Detail">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <a class="btn btn-outline-info btn-sm" id="fiche-${item.id}">
                                            <i class="ri-file-line"></i>
                                        </a>
                                    </div>
                                </td>
                                
                            `;
                            // Append the row to the table body
                            tableBody.appendChild(row);

                            document.getElementById(`detail-${item.id}`).addEventListener('click', () =>
                            {
                                fetch(`/api/detail_soinam/${item.id}`) // API endpoint
                                    .then(response => response.json())
                                    .then(data => {
                                        const message_detail =document.getElementById('message_detail');
                                        const modal_detail = document.getElementById('modal_detail');
                                        const div_detail_loader=document.getElementById('div_detail_loader');

                                        message_detail.style.display = 'none';
                                        modal_detail.style.display = 'none';
                                        div_detail_loader.style.display = 'block';

                                        // Access the 'chambre' array from the API response
                                        const modal = document.getElementById('modal_detail');
                                        modal.innerHTML = '';

                                        const soinspatient = data.soinspatient;
                                        const facture = data.facture;
                                        const patient = data.patient;
                                        const typesoins = data.typesoins;
                                        const soins = data.soins;
                                        const produit = data.produit;

                                        const div = document.createElement('div');
                                        div.innerHTML = `
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="">
                                                        <div class="card-body">
                                                            <div class="row justify-content-between">
                                                                <div class="col-12 text-center mt-4">
                                                                    <h6 class="fw-semibold">Type de Soins :</h6>
                                                                    <p>${typesoins.nom}</p>
                                                                    <h6 class="fw-semibold">N° Dossier :</h6>
                                                                    <p>${patient.matricule}</p>
                                                                    <h6 class="fw-semibold">Nom du patient :</h6>
                                                                    <p>${patient.np}</p>
                                                                    <h6 class="fw-semibold">contact :</h6>
                                                                    <p>${patient.tel}</p>
                                                                    <h6 class="fw-semibold">Assurer :</h6>
                                                                    <p>${patient.assurer}</p>
                                                                    ${patient.assurer === 'oui' ? `
                                                                        <h6 class="fw-semibold">Taux :</h6>
                                                                        <p>${patient.taux}%</p>

                                                                        <h6 class="fw-semibold">Assurance :</h6>
                                                                        <p>${patient.assurance}</p> 

                                                                        <h6 class="fw-semibold">Matricule :</h6>
                                                                        <p>${patient.matricule_assurance}</p>
                                                                    ` : ''}
                                                                </div>
                                                                <div class="col-12 text-center mt-4">
                                                                    ${soinspatient.num_bon != null ? `
                                                                        <h6 class="fw-semibold">Numéro de prise en charge :</h6>
                                                                        <p>${soinspatient.num_bon}</p>
                                                                    ` : ''}
                                                                    <h6 class="fw-semibold">Part Patient :</h6>
                                                                    <p>${soinspatient.part_patient} Fcfa</p>
                                                                    <h6 class="fw-semibold">Part Assurance :</h6>
                                                                    <p>${soinspatient.part_assurance} Fcfa</p>
                                                                    <h6 class="fw-semibold">Remise :</h6>
                                                                    <p>${soinspatient.remise ? soinspatient.remise : '0'} Fcfa</p>
                                                                    <h6 class="fw-semibold">Montant Total :</h6>
                                                                    <p>${soinspatient.montant} Fcfa</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        `;

                                        modal.appendChild(div);

                                        message_detail.style.display = 'none';
                                        modal_detail.style.display = 'block';
                                        div_detail_loader.style.display = 'none';

                                    })
                                    .catch(error => {
                                        message_detail.style.display = 'block';
                                        modal_detail.style.display = 'none';
                                        div_detail_loader.style.display = 'none';
                                        console.error('Erreur lors du chargement des données:', error);
                                    });
                            });

                            document.getElementById(`fiche-${item.id}`).addEventListener('click', () =>
                            {
                                fetch(`/api/detail_soinam/${item.id}`) // API endpoint
                                    .then(response => response.json())
                                    .then(data => {
                                        // Access the 'chambre' array from the API response
                                        const soinspatient = data.soinspatient;
                                        const facture = data.facture;
                                        const patient = data.patient;
                                        const typesoins = data.typesoins;
                                        const soins = data.soins;
                                        const produit = data.produit;

                                        generatePDFInvoice(soinspatient, facture, patient, typesoins, soins, produit);

                                    })
                                    .catch(error => {
                                        console.error('Erreur lors du chargement des données:', error);
                                    });
                            });

                            document.getElementById(`detail_produit-${item.id}`).addEventListener('click', () => 
                            {
                                const tableBodyP = document.querySelector('#TableP tbody'); // Pour les soins infirmiers
                                const tableBodyProdP = document.querySelector('#TableProdP tbody'); // Pour les produits
                                const messageDivP = document.getElementById('message_TableP');
                                const tableDivP = document.getElementById('div_TableP');
                                const tableDivProdP = document.getElementById('div_TableProdP'); // Div pour les produits
                                const loaderDivP = document.getElementById('div_Table_loaderP');

                                messageDivP.style.display = 'none';
                                tableDivP.style.display = 'none';
                                tableDivProdP.style.display = 'none'; // Cacher au départ
                                loaderDivP.style.display = 'block';

                                fetch(`/api/detail_soinam/${item.id}`) // API endpoint
                                    .then(response => response.json())
                                    .then(data => {
                                        const soinspatient = data.soinspatient;
                                        const soins = data.soins;
                                        const produit = data.produit; // Assurez-vous que l'API renvoie une liste de produits

                                        // Clear existing rows
                                        tableBodyP.innerHTML = '';
                                        tableBodyProdP.innerHTML = ''; // Pour les produits

                                        if (soins.length > 0 || produits.length > 0) {

                                            loaderDivP.style.display = 'none';
                                            messageDivP.style.display = 'none';
                                            tableDivP.style.display = 'block';
                                            tableDivProdP.style.display = 'block'; // Afficher le tableau des produits

                                            // Remplir le tableau des soins
                                            soins.forEach((item, index) => {
                                                const row = document.createElement('tr');
                                                row.innerHTML = `
                                                    <td>
                                                        <h6>${item.nom_si}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>${item.prix_si} Fcfa</h6>
                                                    </td>
                                                `;
                                                tableBodyP.appendChild(row);
                                            });

                                            const rowTotalSoin = document.createElement('tr');
                                            rowTotalSoin.innerHTML = `
                                                <td >&nbsp;</td>
                                                <td >
                                                    <h5 class="mt-4 text-success">
                                                        Total Soins : ${formatPriceT(soinspatient.stotal)} Fcfa
                                                    </h5>
                                                </td>
                                            `;
                                            tableBodyP.appendChild(rowTotalSoin);

                                            // Remplir le tableau des produits
                                            produit.forEach((item, index) => {
                                                const rowProd = document.createElement('tr');
                                                rowProd.innerHTML = `
                                                    <td>
                                                        <h6>${item.nom_pro}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>${item.prix_pro} Fcfa</h6>
                                                    </td>
                                                    <td>
                                                        <h6>${item.quantite}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>${item.montant} Fcfa</h6>
                                                    </td>
                                                `;
                                                tableBodyProdP.appendChild(rowProd);
                                            });

                                            const rowTotalProd = document.createElement('tr');
                                            rowTotalProd.innerHTML = `
                                                <td colspan="2" >&nbsp;</td>
                                                <td colspan="2">
                                                    <h5 class="mt-4 text-success">
                                                        Total Produits : ${formatPriceT(soinspatient.prototal)} Fcfa
                                                    </h5>
                                                </td>
                                            `;
                                            tableBodyProdP.appendChild(rowTotalProd);

                                            const rowNote = document.createElement('tr');
                                            rowNote.innerHTML = `
                                                <td colspan="4">
                                                    <h6 class="text-danger">NOTE</h6>
                                                    <p class="small m-0">
                                                        Le Montant Total des produits utilisés
                                                        seront ajoutés au montant total des soins.
                                                    </p>
                                                </td>
                                            `;

                                            tableBodyProdP.appendChild(rowNote);

                                        } else {
                                            loaderDivP.style.display = 'none';
                                            messageDivP.style.display = 'block';
                                            tableDivP.style.display = 'none';
                                            tableDivProdP.style.display = 'none';
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Erreur lors du chargement des données:', error);
                                        loaderDivP.style.display = 'none';
                                        messageDivP.style.display = 'block';
                                        tableDivP.style.display = 'none';
                                        tableDivProdP.style.display = 'none';
                                    });
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
                    // Hide the table and show the error message in case of failure
                    loaderDiv.style.display = 'none';
                    messageDiv.style.display = 'block';
                    tableDiv.style.display = 'none';
                });
        }

        // Assurez-vous que ce code soit exécuté après l'ajout du bouton "Enregistrer"
        document.getElementById('btn_eng_produit').addEventListener('click', () => {
            const selections = [];
            const selects = document.querySelectorAll('.produit-select');

            selects.forEach(select => {
                const selectedOption = select.options[select.selectedIndex];
                const idProduit = selectedOption.value; // ID du produit sélectionné
                const quantiteDemande = parseInt(select.parentElement.querySelector('#quantite_demande').value); // Quantité demandée
                const prix = parseInt(selectedOption.dataset.prix); // Prix du produit

                // Validation du produit et de la quantité
                if (!idProduit) {  // Si aucun produit n'est sélectionné
                    formIsValid = false;
                    showAlertQauntite('danger', 'Veuillez sélectionner un produit.');
                    return;  // Stopper l'exécution si une erreur est trouvée
                }
                if (isNaN(quantiteDemande) || quantiteDemande <= 0) { // Si la quantité n'est pas valide
                    formIsValid = false;
                    showAlertQauntite('danger', 'Veuillez entrer une quantité valide pour chaque produit.');
                    return;  // Stopper l'exécution si une erreur est trouvée
                }

                // Si un produit est sélectionné, ajoutez-le au tableau
                if (idProduit) {
                    selections.push({
                        id: idProduit,
                        quantite: quantiteDemande,
                        montant: prix * quantiteDemande // Calculer le montant
                    });
                }
            });

            const montantTotal = document.getElementById('montant_total_produit').value;
            const id = document.getElementById('id_hos_produit').value;

            var modal = bootstrap.Modal.getInstance(document.getElementById('Add'));
            modal.hide();

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/add_soinshopital/'+ id,
                method: 'GET',
                data:{
                    selections: selections,
                    montantTotal: montantTotal,
                },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.success) {
                        showAlert('success', 'Produit Pharmacie ajouter.');
                    } else if (response.error) {
                        showAlert('danger', 'Une erreur est survenue');
                    } else if (response.json) {
                        showAlert('danger', 'Invalid selections format');
                    }

                    list_hos();
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement');
                }
            });
        });

        document.getElementById('close_modal_produit').addEventListener('click', () => {
            document.getElementById('montant_total_produit').value = "";
        });


        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');  // Ajoute un '0' si le jour est à un chiffre
            const month = String(date.getMonth() + 1).padStart(2, '0');  // Les mois sont indexés de 0, donc +1
            const year = date.getFullYear();
            
            return `${day}-${month}-${year}`;
        }

        function formatDateHeure(dateString) {

            const date = new Date(dateString);
                
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');

            return `${day}/${month}/${year} à ${hours}:${minutes}:${seconds}`;
        }

        function updatePaginationControls(pagination) {
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

        function generatePDFInvoice(soinspatient, facture, patient, typesoins, soins, produit) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });

            const pdfFilename = "SOINS AMBULATOIRE Facture N°" + facture.code + " du " + formatDateHeure(facture.created_at);
            doc.setProperties({
                title: pdfFilename,
            });

            let yPos = 10;

            function drawConsultationSection(yPos) {
                rightMargin = 15;
                leftMargin = 15;
                pdfWidth = doc.internal.pageSize.getWidth();

                const titlea = "Facture";
                doc.setFontSize(100);
                doc.setTextColor(242, 242, 242); // Gray color for background effect
                doc.setFont("Helvetica", "bold");
                doc.text(titlea, 120, yPos + 120, { align: 'center', angle: 40 });

                const logoSrc = "{{asset('assets/images/logo.png')}}";
                const logoWidth = 22;
                const logoHeight = 22;
                doc.addImage(logoSrc, 'PNG', leftMargin, yPos - 7, logoWidth, logoHeight);

                // Informations de l'entreprise
                doc.setFontSize(10);
                doc.setTextColor(0, 0, 0);
                doc.setFont("Helvetica", "bold");
                // Texte de l'entreprise
                const title = "ESPACE MEDICO SOCIAL LA PYRAMIDE DU COMPLEXE";
                const titleWidth = doc.getTextWidth(title);
                const titleX = (doc.internal.pageSize.getWidth() - titleWidth) / 2;
                doc.text(title, titleX, yPos);
                // Texte de l'adresse
                doc.setFont("Helvetica", "normal");
                const address = "Abidjan Yopougon Selmer, Non loin du complexe sportif Jesse-Jackson - 04 BP 1523";
                const addressWidth = doc.getTextWidth(address);
                const addressX = (doc.internal.pageSize.getWidth() - addressWidth) / 2;
                doc.text(address, addressX, (yPos + 5));
                // Texte du téléphone
                const phone = "Tél.: 20 24 44 70 / 20 21 71 92 - Cel.: 01 01 01 63 43";
                const phoneWidth = doc.getTextWidth(phone);
                const phoneX = (doc.internal.pageSize.getWidth() - phoneWidth) / 2;
                doc.text(phone, phoneX, (yPos + 10));
                doc.setFontSize(10);
                doc.setFont("Helvetica", "normal");
                const spatientDate = new Date(soinspatient.created_at);
                // Formatter la date et l'heure séparément
                const formattedDate = spatientDate.toLocaleDateString(); // Formater la date
                const formattedTime = spatientDate.toLocaleTimeString();
                doc.text("Date: " + formattedDate, 15, (yPos + 25));
                doc.text("Heure: " + formattedTime, 15, (yPos + 30));

                //Ligne de séparation
                doc.setFontSize(15);
                doc.setFont("Helvetica", "bold");
                doc.setLineWidth(0.5);
                doc.setTextColor(255, 0, 0);
                // doc.line(10, 35, 200, 35); 
                const titleR = "FACTURE SOINS AMBULATOIRES";
                const titleRWidth = doc.getTextWidth(titleR);
                const titleRX = (doc.internal.pageSize.getWidth() - titleRWidth) / 2;
                // Définir le padding
                const paddingh = 0; // Padding vertical
                const paddingw = 8; // Padding horizontal
                // Calculer les dimensions du rectangle
                const rectX = titleRX - paddingw; // X du rectangle
                const rectY = (yPos + 18) - paddingh; // Y du rectangle
                const rectWidth = titleRWidth + (paddingw * 2); // Largeur du rectangle
                const rectHeight = 15 + (paddingh * 2); // Hauteur du rectangle
                // Définir la couleur pour le cadre (noir)
                doc.setDrawColor(0, 0, 0);
                doc.rect(rectX, rectY, rectWidth, rectHeight); // Dessiner le rectangle
                // Ajouter le texte centré en gras
                doc.setFontSize(15);
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(255, 0, 0); // Couleur du texte rouge
                doc.text(titleR, titleRX, (yPos + 25)); // Positionner le texte
                const titleN = "N° "+facture.code;
                doc.text(titleN, (doc.internal.pageSize.getWidth() - doc.getTextWidth(titleN)) / 2, (yPos + 31));

                doc.setFontSize(10);
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(0, 0, 0);
                const numDossier = "N° Dossier : P-"+ patient.matricule;
                const numDossierWidth = doc.getTextWidth(numDossier);
                doc.text(numDossier, pdfWidth - rightMargin - numDossierWidth, yPos + 28);

                yPoss = (yPos + 40);

                const patientInfo = [
                    { label: "Nom et Prénoms", value: patient.np },
                    { label: "Assurer", value: patient.assurer },
                    { label: "Age", value: patient.age+" an(s)" },
                    { label: "Domicile", value: patient.adresse },
                    { label: "Contact", value: "+225 "+patient.tel }
                ];

                if (patient.assurer == 'oui') {
                    patientInfo.push(
                        { label: "Assurance", value: patient.assurance },
                        { label: "Matricule", value: patient.matricule_assurance },
                    );
                }

                patientInfo.forEach(info => {
                    doc.setFontSize(8);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 35, yPoss);
                    yPoss += 7;
                });

                yPoss = (yPos + 40);

                const typeInfo = [];

                if (soinspatient.num_bon && soinspatient.num_bon !== "") {
                    typeInfo.push({ label: "N° prise en charge", value: soinspatient.num_bon });
                }

                typeInfo.push(
                    { label: "Type de Soins", value: typesoins.nom },
                    { label: "Soins Infirmiers", value: soins.length },
                    { label: "Produits Utilisés", value: produit.length },
                );

                typeInfo.forEach(info => {
                    doc.setFontSize(8);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 100, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 135, yPoss);
                    yPoss += 7;
                });

                yPoss += 30;

                const donneeTables = soins;
                let yPossT = yPoss + 10; // Initialisation de la position Y pour le tableau des soins

                // Tableau dynamique pour les détails des soins infirmiers
                doc.autoTable({
                    startY: yPossT,
                    head: [['N°', 'Nom du Soins Infirmiers', 'Prix Unitaire']],
                    body: donneeTables.map((item, index) => [
                        index + 1,
                        item.nom_si,
                        item.prix_si + " Fcfa",
                    ]),
                    theme: 'striped',
                });

                // Récupérer la position Y de la dernière ligne du tableau
                yPoss = doc.autoTable.previous.finalY || yPossT + 10;
                yPoss = yPoss + 5;
                // Ajout des totaux
                const finalInfos = [];
                if (soins.length > 0) {
                    finalInfos.push({ label: "Total Soins", value: formatPriceT(soinspatient.stotal) });
                }
                finalInfos.forEach(info => {
                    doc.setFontSize(11);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 95, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value + " Fcfa", leftMargin + 125, yPoss);
                    yPoss += 7; // Espacement pour la prochaine ligne
                });

                // Répéter le processus pour les produits
                const donneeTable = produit;
                yPossT = yPoss + 10; // Ajuster la position Y pour le tableau des produits
                doc.autoTable({
                    startY: yPossT,
                    head: [['N°', 'Nom du produit utilisé', 'Quantité', 'Prix Unitaire', 'Montant']],
                    body: donneeTable.map((item, index) => [
                        index + 1,
                        item.nom_pro,
                        item.quantite,
                        item.prix_pro + " Fcfa",
                        item.montant + " Fcfa",
                    ]),
                    theme: 'striped',
                });

                // Position Y après le tableau des produits
                yPoss = doc.autoTable.previous.finalY || yPossT + 10;
                yPoss = yPoss + 5;
                // Ajout des totaux pour les produits
                const finalInfo = [];
                if (produit.length > 0) {
                    finalInfo.push({ label: "Total Produit", value: formatPriceT(soinspatient.prototal) });
                }
                finalInfo.forEach(info => {
                    doc.setFontSize(11);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 120, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value + " Fcfa", leftMargin + 150, yPoss);
                    yPoss += 7; // Espacement pour la prochaine ligne
                });

                yPoss = yPoss + 10;

                const compteInfo = [
                    { label: "Total", value: soinspatient.montant ? soinspatient.montant + " Fcfa" : "0 Fcfa" },
                    ...(soinspatient.part_assurance.replace(/[^0-9]/g, '') > 0 ? 
                        [{ label: "Part assurance", value: soinspatient.part_assurance + " Fcfa" }] 
                        : []),
                    { label: "Remise", value: soinspatient.remise ? soinspatient.remise + " Fcfa" : "0 Fcfa" }
                ];


                if (patient.taux !== null) {
                    compteInfo.push({ label: "Taux", value: patient.taux + "%" });
                }

                compteInfo.forEach(info => {
                    doc.setFontSize(9);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 110, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 150, yPoss);
                    yPoss += 7;
                });
                doc.setFontSize(11);
                doc.setFont("Helvetica", "bold");
                doc.text('Montant à payer', leftMargin + 110, yPoss);
                doc.setFont("Helvetica", "bold");
                doc.text(": "+soinspatient.part_patient+" Fcfa", leftMargin + 150, yPoss);

            }

            function addFooter() {
                // Add footer with current date and page number in X/Y format
                const pageCount = doc.internal.getNumberOfPages();
                const footerY = doc.internal.pageSize.getHeight() - 2; // 10 mm from the bottom

                for (let i = 1; i <= pageCount; i++) {
                    doc.setPage(i);
                    doc.setFontSize(8);
                    doc.setTextColor(0, 0, 0);
                    const pageText = `Page ${i} sur ${pageCount}`;
                    const pageTextWidth = doc.getTextWidth(pageText);
                    const centerX = (doc.internal.pageSize.getWidth() - pageTextWidth) / 2;
                    doc.text(pageText, centerX, footerY);
                    doc.text("Imprimé le : " + new Date().toLocaleDateString() + " à " + new Date().toLocaleTimeString(), 15, footerY); // Left-aligned
                }
            }

            drawConsultationSection(yPos);

            addFooter();

            doc.output('dataurlnewwindow');
        }

        function Statistique() {

            const nbre_day = document.getElementById("nbre_soinsam");

            $.ajax({
                url: '/api/statistique_soinsam',
                method: 'GET',
                success: function(response) {
                    // Set the text content of each element
                    nbre_day.textContent = response.stat_soinsam_day;
                },
                error: function() {
                    // Set default values in case of an error
                    nbre_day.textContent = '0';
                }
            });
        }

    });
</script>


@endsection
