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
                                    <h2 class="m-0 lh-1" id="nbre_hos"></h2>
                                    <p class="m-0">Hospitalisation</p>
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
                <div class="p-2" id="div_alert" >
                    
                </div>
                <div class="card-body" style="margin-top: -30px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center bg-primary bg-2" id="customTab4" role="tablist" style="background: rgba(0, 0, 0, 0.7);">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Nouvelle admission
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab" aria-controls="oneAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Liste
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  text-white" id="tab-threeAAA" data-bs-toggle="tab" href="#threeAAA" role="tab" aria-controls="threeAAA" aria-selected="true">
                                    <i class="ri-shake-hands-line me-2"></i>
                                    Disponibilité Chambre & Lit
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane active show fade" id="twoAAA" role="tabpanel" aria-labelledby="tab-twoAAA">
                                <div class="p-2" id="div_alert" ></div>
                                <div class="card-header">
                                    <h5 class="card-title text-center">Nouvelle admission</h5>
                                </div>
                                <div class="row gx-3 justify-content-center align-items-center mb-4">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Patient</label>
                                            <div class="input-group">
                                                <input type="hidden" class="form-control" id="matricule_patient" autocomplete="off">
                                                <input type="text" class="form-control" id="patient" placeholder="Saisie Obligatoire" autocomplete="off">
                                            </div>
                                            <div class="suggestions" id="suggestions_patient" style="display: none;"></div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Medecin</label>
                                            <select class="form-select" id="medecin_id"></select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Type admission</label>
                                            <select class="form-select" id="id_typeadmission"></select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nature Admission</label>
                                            <select class="form-select" id="id_natureadmission">
                                                <option value="">Selectioner</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Chambre à occuper</label>
                                            <select class="form-select" id="id_chambre"></select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Lit à occuper</label>
                                            <select class="form-select" id="id_lit">
                                                <option value="">Selectioner</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Date d'entrée
                                            </label>
                                            <input type="date" class="form-control" placeholder="Selectionner une date" id="date_entrer" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Date de sortie probable
                                            </label>
                                            <input type="date" class="form-control" placeholder="Sélectionner une date" id="date_sortie" min="{{ date('Y-m-d')}}" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Nombre de jours
                                            </label>
                                            <input readonly type="tel" class="form-control" id="nbre_jour" value="1">
                                        </div>
                                    </div>
                                    {{-- <div class="col-xxl-9 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Motif</label>
                                            <input type="email" class="form-control" id="motif" placeholder="facultatif">
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-12">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <button id="btn_calcul" class="btn btn-warning">
                                                Calculer le montant final
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row gx-3" id="div_calcul" style="display: none;">
                                        <div class="card-header text-center">
                                            <h5 class="card-title">Information Caisse</h5>
                                        </div>
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
                                                <label class="form-label">Prix de la chambre</label>
                                                <div class="input-group">
                                                    <input readonly type="tel" class="form-control" id="montant_chambre">
                                                    <span class="input-group-text">Fcfa</span>
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
                                                    <input type="tel" class="form-control" id="taux_remise">
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
                                        <div class="col-sm-12">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button id="btn_eng_hosp" class="btn btn-success">
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
                                    <div class="p-2" id="div_alert_calcul" ></div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="oneAAA" role="tabpanel" aria-labelledby="tab-oneAAA">
                                <div class="row gx-3" >
                                    <div class="col-12">
                                        <div class=" mb-3">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="card-title">
                                                    List des hospitalisation
                                                </h5>
                                                <div class="d-flex" >
                                                    <select class="form-select me-1" id="statut">
                                                        <option selected value="tous">Tous</option>
                                                        <option value="Hospitaliser">Hospitaliser</option>
                                                        <option value="Liberé">Liberé</option>
                                                    </select>
                                                    <a id="btn_print_table_hos" style="display: none;" class="btn btn-outline-warning ms-auto me-1">
                                                        <i class="ri-printer-line"></i>
                                                    </a>
                                                    <a id="btn_refresh_table_hos" class="btn btn-outline-info ms-auto">
                                                        <i class="ri-loop-left-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div id="div_alert_table_hos" >
                                                
                                                </div>
                                                <div class="table-outer" id="div_Table_hos" style="display: none;">
                                                    <div class="table-responsive">
                                                        <table class="table align-middle table-hover m-0 truncate" id="Table_hos">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">N°</th>
                                                                    <th scope="col">Statut</th>
                                                                    <th scope="col">Type</th>
                                                                    <th scope="col">Nature</th>
                                                                    <th scope="col">Nom et Prénoms</th>
                                                                    <th scope="col">Date entrer</th>
                                                                    <th scope="col">Date sorti</th>
                                                                    <th scope="col">Medecin</th>
                                                                    <th scope="col">Prix</th>
                                                                    <th scope="col">Prix Soins</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div id="message_Table_hos" style="display: none;">
                                                    <p class="text-center" >
                                                        Aucune hospitalisation pour le moment
                                                    </p>
                                                </div>
                                                <div id="div_Table_loader_hos" style="display: none;">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                                        <strong>Chargement des données...</strong>
                                                    </div>
                                                </div>
                                                <div id="pagination-controls-hos" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="threeAAA" role="tabpanel" aria-labelledby="tab-threeAAA">
                                <div class="card-header">
                                    <h5 class="card-title text-center">Disponibilité Chambre & Lit</h5>
                                </div>
                                <div class="row gx-3" >
                                    <div class="col-12">
                                        <div class=" mb-3">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <a id="btn_refresh_table" class="btn btn-outline-info ms-auto">
                                                    <i class="ri-loop-left-line"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-outer" id="div_Table_lit" style="display: none;">
                                                    <div class="table-responsive">
                                                        <table class="table align-middle table-hover m-0 truncate" id="Table_lit">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">N°</th>
                                                                    <th scope="col">Numéro</th>
                                                                    <th scope="col">Catégorie</th>
                                                                    <th scope="col">Numéro chambre</th>
                                                                    <th scope="col">Prix</th>
                                                                    <th scope="col">Statut</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div id="message_Table_lit" style="display: none;">
                                                    <p class="text-center" >
                                                        Aucun Lit n'a été enregistrer aujourd'hui
                                                    </p>
                                                </div>
                                                <div id="div_Table_loader" style="display: none;">
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
            <div class="modal-body" id="modal_detail">
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
            <div id="div_alert_produit_qu" ></div>
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
                            <input readonly type="tel" class="form-control" id="montant_total_produit" placeholder="Montant Total">
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
                    Produit Pharmacie Utilisé
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
                                        <div id="div_alert_tableP" >
                    
                                        </div>
                                        <div class="table-responsive" id="div_TableP" style="display: none;">
                                            <table class="table table-bordered" id="TableP">
                                                <thead>
                                                    <tr>
                                                        <th>Produit utilisé</th>
                                                        <th style="width: 150px;" >Prix unitaire</th>
                                                        <th style="width: 50px;" >Quantité</th>
                                                        <th style="width: 150px;" >Prix</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="message_TableP" style="display: none;">
                                            <p class="text-center" >
                                                Aucun Produit utilisé pour le moment
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
        calculerJours();
        select_medecin();
        select_chambre();
        select_typeadmission();
        list_lit();
        list_hos();
        

        document.getElementById("id_chambre").addEventListener("change", select_lit);
        document.getElementById("id_typeadmission").addEventListener("change", select_natureadmission);
        document.getElementById("btn_refresh_table").addEventListener("click", list_lit);
        document.getElementById('date_entrer').addEventListener('change', calculerJours);
        document.getElementById('date_sortie').addEventListener('change', calculerJours);
        document.getElementById('btn_calcul').addEventListener('click', calculAmounts);
        document.getElementById('btn_eng_hosp').addEventListener('click', eng_hosp);
        document.getElementById("btn_refresh_table_hos").addEventListener("click", list_hos);
        document.getElementById("statut").addEventListener("change", list_hos);

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

                    // Event listener for input typing
                    input.addEventListener('input', function() {
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

                                // Cacher ou afficher l'option "Assurance" selon le taux
                                if (patient_taux.value == 0) {
                                    for (let i = 0; i < appliq_remise.options.length; i++) {
                                        if (appliq_remise.options[i].value === 'assurance') {
                                            appliq_remise.options[i].style.display = 'none'; // Cacher l'option
                                        }
                                    }
                                } else {
                                    for (let i = 0; i < appliq_remise.options.length; i++) {
                                        if (appliq_remise.options[i].value === 'assurance') {
                                            appliq_remise.options[i].style.display = 'block'; // Afficher l'option
                                        }
                                    }
                                }

                            });
                            suggestionsDiv.appendChild(suggestion);
                        });

                        // Show/hide suggestions based on results
                        suggestionsDiv.style.display = filteredData.length > 0 ? 'block' : 'none';
                    });

                    // Hide suggestions when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!suggestionsDiv.contains(e.target) && e.target !== input) {
                            suggestionsDiv.style.display = 'none';
                        }
                    });
                },
                error: function() {
                    // Gérer l'erreur
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

        function select_medecin()
        {
            const selectElement = document.getElementById('medecin_id');
            // Clear existing options
            selectElement.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner un medecin';
            selectElement.appendChild(defaultOption);

            fetch('/api/list_medecin')
                .then(response => response.json())
                .then(data => {
                    const medecins = data.medecin;
                    medecins.forEach((item, index) => {
                        const option = document.createElement('option');
                        option.value = `${item.id}`; // Ensure 'id' is the correct key
                        option.textContent = `Dr. ${item.name}`; // Ensure 'nom' is the correct key
                        selectElement.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des societes:', error));
        }

        function select_typeadmission()
        {
            const selectElement = document.getElementById('id_typeadmission');
            selectElement.innerHTML = '';

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner';
            selectElement.appendChild(defaultOption);
            // Vérifie que l'élément select existe
            if (selectElement) {
                // Effectuer une requête pour récupérer les taux
                fetch('/api/list_typeadmission')
                    .then(response => response.json())
                    .then(data => {
                        const typeadmissions = data.typeadmission;
                        typeadmissions.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item.nom;
                            selectElement.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Erreur lors du chargement des taux:', error));
            }
        }

        function select_chambre()
        {
            const selectElement = document.getElementById('id_chambre');
            selectElement.innerHTML = '';

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner';
            selectElement.appendChild(defaultOption);
            // Vérifie que l'élément select existe

            if (selectElement) {
                // Effectuer une requête pour récupérer les taux
                fetch('/api/list_chambre')
                    .then(response => response.json())
                    .then(data => {
                        const chambres = data.chambre;
                        chambres.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = "CH-"+item.code;
                            selectElement.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Erreur lors du chargement des taux:', error));
            }
        }

        function select_lit() {
            const typeSelect = document.getElementById('id_lit');

            typeSelect.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner';
            typeSelect.appendChild(defaultOption);

            const Id = document.getElementById('id_chambre').value;

            // Validate if acteId is valid before making the AJAX request
             if (Id) {
                $.ajax({
                    url: '/api/lit_select/' + Id,
                    method: 'GET',
                    success: function(response) {
                        const data = response.lit; 

                        if (data && data.length > 0) {

                            // Populate the select with the response data
                            data.forEach(item => {
                                const option = document.createElement('option');
                                option.value = item.id; // Ensure 'id' is the correct key
                                option.textContent = 'Lit-'+item.code+'/'+item.type;
                                option.setAttribute('data-prix', item.prix);
                                typeSelect.appendChild(option);
                            });

                        }
                    },
                    error: function() {
                        console.error('Erreur lors du chargement des types d\'actes');
                    }
                });

                typeSelect.addEventListener('change', function() {
                    const selectedOption = typeSelect.options[typeSelect.selectedIndex];
                    const prix = selectedOption.getAttribute('data-prix');

                    if (prix) {

                        document.getElementById('montant_chambre').value = prix;


                    } else {
                        document.getElementById('montant_chambre').value = 0;
                    }

                });
            }
        }

        function select_natureadmission() {
            const typeSelect = document.getElementById('id_natureadmission');

            typeSelect.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner';
            typeSelect.appendChild(defaultOption);

            const Id = document.getElementById('id_typeadmission').value;

            // Validate if acteId is valid before making the AJAX request
             if (Id) {
                $.ajax({
                    url: '/api/natureadmission_select/' + Id,
                    method: 'GET',
                    success: function(response) {
                        const data = response.natureadmission; 

                        if (data && data.length > 0) {

                            // Populate the select with the response data
                            data.forEach(item => {
                                const option = document.createElement('option');
                                option.value = item.id; // Ensure 'id' is the correct key
                                option.textContent =item.nom;
                                typeSelect.appendChild(option);
                            });

                        }
                    },
                    error: function() {
                        console.error('Erreur lors du chargement des types d\'actes');
                    }
                });
            }
        }

        function calculAmounts() {
            // Show loader and hide other elements
            document.getElementById('div_loader').style.display = 'block';
            document.getElementById('div_calcul').style.display = 'none';
            document.getElementById('btn_calcul').style.display = 'none';

            document.getElementById('montant_assurance').value = formatPrice(document.getElementById('montant_assurance_hidden').value);
            document.getElementById('montant_patient').value = formatPrice(document.getElementById('montant_patient_hidden').value);
            document.getElementById('taux_remise').value = 0;

            // Get input elements
            const montant_assurance = document.getElementById('montant_assurance');
            const taux_remise = document.getElementById('taux_remise');
            const montant_total = document.getElementById('montant_total');
            const montant_patient = document.getElementById('montant_patient');

            const montant_patient_hidden = document.getElementById('montant_patient_hidden');
            const montant_assurance_hidden = document.getElementById('montant_assurance_hidden');

            // Initialize amounts
            let montantAssurance = 0;
            let remise = 0;
            let totalMontant = 0;
            let montantPatient = 0;

            const patient_taux = document.getElementById('patient_taux').value;
            const nbre_jour = document.getElementById('nbre_jour').value;
            const montant_chambre = document.getElementById('montant_chambre').value;

            // Validate inputs
            if (patient_taux === '' || nbre_jour === '' || montant_chambre === '') {

                showAlert('Alert', 'Veuillez remplir tous les champs SVP.','warning');

                document.getElementById('div_loader').style.display = 'none';
                document.getElementById('div_calcul').style.display = 'none';
                document.getElementById('btn_calcul').style.display = 'block';

                return false;
            }

            // Convert and validate values
            let prixFloat = parseInt(montant_chambre.replace(/[.,]/g, ''));
            let joursInt = parseInt(nbre_jour);

            if (isNaN(prixFloat) || isNaN(joursInt)) {
                console.error('Invalid price or number of days');
                montant_total.value = '';  // Clear the field if values are invalid
                return false;
            }

            // Calculate total price
            let prixTotal = prixFloat * joursInt;

            // Apply discount if available
            remise = parseInt(taux_remise.value) || 0;  // Get discount rate or default to 0
            if (remise > 0 && remise <= 100) {
                prixTotal -= (prixTotal * remise / 100);  // Apply discount
            }

            // Set total price
            montant_total.value = formatPrice(prixTotal.toString());

            // Validate insurance rate
            let tauxFloat = parseInt(patient_taux);
            if (isNaN(tauxFloat)) {
                tauxFloat = 0;  // Set to 0 if the rate is not valid
            }

            // Calculate insurance and patient portions
            if (tauxFloat === 0) {
                montant_assurance.value = '0';  // No insurance coverage
                montant_patient.value = formatPrice(prixTotal.toString());
                montant_patient_hidden.value = formatPrice(prixTotal.toString());
                montant_assurance_hidden.value = '0';
            } else {
                montantAssurance = (tauxFloat / 100) * prixTotal;
                montantPatient = prixTotal - montantAssurance;

                montant_assurance.value = formatPrice(montantAssurance.toString());
                montant_patient.value = formatPrice(montantPatient.toString());

                montant_patient_hidden.value = formatPrice(montantPatient.toString());
                montant_assurance_hidden.value = formatPrice(montantAssurance.toString());
            }

            document.getElementById('taux_remise').value = 0;

            // Show results
            document.getElementById('div_loader').style.display = 'none';
            document.getElementById('div_calcul').style.display = 'flex';
            document.getElementById('btn_calcul').style.display = 'block';

            return false;
        }

        document.getElementById('taux_remise').addEventListener('input', function() {
            // Nettoyer la valeur entrée en supprimant les caractères non numériques sauf le point
            const rawValue = this.value.replace(/[^0-9]/g, ''); // Supprimer tous les caractères non numériques
            // Ajouter des points pour les milliers
            const formattedValue = formatPrice(rawValue);
            
            this.value = formattedValue;

            const appliq_remise = document.getElementById('appliq_remise').value;

            if (appliq_remise == 'patient') {
                // Convertir la valeur formatée en nombre pour les calculs
                const montant_patient = parseInt(document.getElementById('montant_patient_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_patient - remise;
                document.getElementById('montant_patient').value = formatPriceT(montantRemis);
            }else{
                // Convertir la valeur formatée en nombre pour les calculs
                const montant_assurance = parseInt(document.getElementById('montant_assurance_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_assurance - remise;
                document.getElementById('montant_assurance').value = formatPriceT(montantRemis);
            }
        });

        document.getElementById('appliq_remise').addEventListener('change', function() {

            document.getElementById('montant_assurance').value = formatPrice(document.getElementById('montant_assurance_hidden').value);
            document.getElementById('montant_patient').value = formatPrice(document.getElementById('montant_patient_hidden').value);

            const rawValue = document.getElementById('taux_remise').value.replace(/[^0-9]/g, ''); // 

            if (this.value == 'patient') {
                // Convertir la valeur formatée en nombre pour les calculs
                const montant_patient = parseFloat(document.getElementById('montant_patient_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseFloat(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_patient - remise;
                document.getElementById('montant_patient').value = formatPriceT(montantRemis);
            }else{
                // Convertir la valeur formatée en nombre pour les calculs
                const montant_assurance = parseFloat(document.getElementById('montant_assurance_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseFloat(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_assurance - remise;
                document.getElementById('montant_assurance').value = formatPriceT(montantRemis);
            }
        }); 

        function formatPrice(input) {
            // Remove all non-numeric characters except the comma
            input = input.replace(/[^\d,]/g, '');

            // Convert comma to dot for proper float conversion
            input = input.replace(',', '.');

            // Convert to float and round to the nearest whole number
            let number = Math.round(parseFloat(input));
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

        function list_lit() {

            const tableBody = document.querySelector('#Table_lit tbody');
            const messageDiv = document.getElementById('message_Table_lit');
            const tableDiv = document.getElementById('div_Table_lit'); // The message div
            const loaderDiv = document.getElementById('div_Table_loader');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            // Fetch data from the API
            fetch('/api/list_lit') // API endpoint
                .then(response => response.json())
                .then(data => {
                    // Access the 'chambre' array from the API response
                    const lits = data.lit;

                    // Clear any existing rows in the table body
                    tableBody.innerHTML = '';

                    if (lits.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        // Loop through each item in the chambre array
                        lits.forEach((item, index) => {
                            // Create a new row
                            const row = document.createElement('tr');
                            // Create and append cells to the row based on your table's structure
                            row.innerHTML = `
                                <td>${index + 1}</td>
                                <td>Lit-${item.code}</td>
                                <td>${item.type}</td>
                                <td>CH-${item.code_ch}</td>
                                <td>${item.prix} Fcfa</td>
                                <td>
                                    ${item.statut === 'indisponible' ? 
                                        `<span class="badge bg-danger">${item.statut}</span>` : 
                                        `<span class="badge bg-success">${item.statut}</span>`}
                                </td>
                            `;
                            // Append the row to the table body
                            tableBody.appendChild(row);

                        });
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

        function calculerJours() {
            // Sélectionner les éléments des champs date
            const dateEntree = document.getElementById('date_entrer');
            const dateSortie = document.getElementById('date_sortie');
            const joursInput = document.getElementById('nbre_jour');

            const entreeValue = new Date(dateEntree.value);
            const sortieValue = new Date(dateSortie.value);

            // Vérifier si les deux dates sont valides
            if (entreeValue && sortieValue) {
                // Calcul de la différence en millisecondes
                const difference = sortieValue - entreeValue;
                // Convertir en jours (1 jour = 24*60*60*1000 millisecondes)
                let jours = difference / (1000 * 60 * 60 * 24);
                // jours = jours = 0 ? jours + 1 : 0;
                
                // Si jours est égal à 0, alors définir jours à 1
                jours = jours === 0 ? 1 : jours;
                
                // Mise à jour de la valeur du champ input
                joursInput.value = jours;
            }
        }

        function eng_hosp()
        {
            var matricule_patient = document.getElementById("matricule_patient").value;
            var medecin_id = document.getElementById("medecin_id").value;
            var id_typeadmission = document.getElementById("id_typeadmission").value;
            var id_natureadmission = document.getElementById("id_natureadmission").value;
            var id_chambre = document.getElementById("id_chambre").value;
            var id_lit = document.getElementById('id_lit').value;
            var date_entrer = document.getElementById('date_entrer').value;
            var date_sortie = document.getElementById('date_sortie').value;


            if (!matricule_patient.trim() || 
                !medecin_id.trim() || 
                !id_typeadmission.trim() || 
                !id_natureadmission.trim() || 
                !id_chambre.trim() || 
                !id_lit.trim() || 
                !date_entrer.trim() || 
                !date_sortie.trim()) {
                showAlert('Alert', 'Tous les champs sont obligatoires.','warning');
                return false; 
            }

            var montant_assurance = document.getElementById('montant_assurance').value;
            var taux_remise = document.getElementById('taux_remise').value;
            var montant_total = document.getElementById('montant_total').value;
            var montant_patient = document.getElementById('montant_patient').value;
            var patient_taux = document.getElementById('patient_taux').value;
            var nbre_jour = document.getElementById('nbre_jour').value;
            var montant_chambre = document.getElementById('montant_chambre').value;

            // Validate monetary fields
            if (!montant_assurance || 
                !montant_total || 
                !montant_patient || 
                !patient_taux || 
                !nbre_jour || 
                !montant_chambre) {
                
                showAlert('Alert', 'Vérifier les montants SVP.','warning');
                return false; 
            }

            var montantAssuranceValue = parseFloat(montant_assurance);
            var montantTotalValue = parseFloat(montant_total);
            var montantPatientValue = parseFloat(montant_patient);
            var montantChambreValue = parseFloat(montant_chambre);

            if (isNaN(montantAssuranceValue) || 
                isNaN(montantTotalValue) || 
                isNaN(montantPatientValue) || 
                isNaN(montantChambreValue) || 
                montantAssuranceValue < 0 || 
                montantTotalValue < 0 || 
                montantPatientValue < 0 || 
                montantChambreValue < 0) {
                
                showAlert('Alert', 'Vérifier les montants SVP (les montants ne doivent pas être négatifs).','warning');
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
                url: '/api/hosp_new',
                method: 'GET',  // Use 'POST' for data creation
                data: {
                    matricule_patient: matricule_patient,
                    medecin_id: medecin_id,
                    id_typeadmission: id_typeadmission,
                    id_natureadmission: id_natureadmission,
                    id_chambre: id_chambre,
                    id_lit: id_lit,
                    date_entrer: date_entrer,
                    date_sortie: date_sortie,
                    montant_assurance: montant_assurance,
                    taux_remise: taux_remise,
                    montant_total: montant_total,
                    montant_patient: montant_patient,
                    patient_taux: patient_taux,
                    nbre_jour: nbre_jour,
                    montant_chambre: montant_chambre
                },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.success) {
                        Statistique();
                        showAlert('Succès', 'Patient Hospitaliser.', 'success');
                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue lors de l\'hospitalisation.','error');
                    }

                    list_hos();
                    reset();
                    Name_atient();
                    calculerJours();
                    select_medecin();
                    select_chambre();
                    select_typeadmission();
                    list_lit();

                    var newConsultationTab = new bootstrap.Tab(document.getElementById('tab-oneAAA'));
                    newConsultationTab.show();
                    newConsultationTab.active();

                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Alert', 'Une erreur est survenue lors de l\'hospitalisation.','error');

                    reset();
                    
                }
            });
        }

        function reset()
        {
            document.getElementById("patient").value = '';
            document.getElementById("matricule_patient").value = '';
            document.getElementById("medecin_id").value = '';
            document.getElementById("id_typeadmission").value = '';
            document.getElementById("id_natureadmission").value = '';
            document.getElementById("id_chambre").value = '';
            document.getElementById('id_lit').value = '';
            document.getElementById('date_entrer').value = '';
            document.getElementById('date_sortie').value = '';
            document.getElementById('motif').value = '';

            document.getElementById('montant_assurance').value = '';
            document.getElementById('taux_remise').value = '';
            document.getElementById('montant_total').value = '';
            document.getElementById('montant_patient').value = '';
            document.getElementById('patient_taux').value = '';
            document.getElementById('nbre_jour').value = '';
            document.getElementById('montant_chambre').value = '';

            document.getElementById('div_loader').style.display = 'none';
            document.getElementById('div_calcul').style.display = 'none';
            document.getElementById('btn_calcul').style.display = 'block';

            calculerJours();
            Name_atient();
            select_medecin();
            select_chambre();
            select_typeadmission();
            list_lit();
        }

        function list_hos(page = 1) {

            const tableBody = document.querySelector('#Table_hos tbody');
            const messageDiv = document.getElementById('message_Table_hos');
            const tableDiv = document.getElementById('div_Table_hos'); // The message div
            const loaderDiv = document.getElementById('div_Table_loader_hos');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            // Fetch data from the API
            const statut = document.getElementById('statut').value;
            const url = `/api/list_hopital/${statut}?page=${page}`;
            fetch(url) // API endpoint
                .then(response => response.json())
                .then(data => {

                    const hopitals = data.hopital || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    // Clear any existing rows in the table body
                    tableBody.innerHTML = '';

                    if (hopitals.length > 0) {

                        document.getElementById(`btn_print_table_hos`).style.display = 'block';

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        // Loop through each item in the chambre array
                        hopitals.forEach((item, index) => {
                            // Create a new row
                            const row = document.createElement('tr');
                            // Create and append cells to the row based on your table's structure
                            let addButton = '';
                            if (item.statut === 'Hospitaliser') {
                                addButton = `
                                    <a class="btn btn-outline-success btn-sm" id="add-${item.id}" data-bs-toggle="modal" data-bs-target="#Add">
                                        <i class="ri-dossier-line"></i>
                                    </a>
                                `;
                            }
                            row.innerHTML = `
                                <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                <td>
                                    ${item.statut === 'Hospitaliser' ? 
                                        `<span class="badge bg-danger">${item.statut}</span>` : 
                                        `<span class="badge bg-success">${item.statut}</span>`}
                                </td>
                                <td>${item.type}</td>
                                <td>${item.nature}</td>
                                <td>${item.patient}</td>
                                <td>${formatDate(item.date_debut)}</td>
                                <td>${formatDate(item.date_fin)}</td>
                                <td>${item.medecin}</td>
                                <td>${item.montant} Fcfa</td>
                                <td>${item.montant_soins} Fcfa</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        ${addButton}
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
                                fetch(`/api/detail_hos/${item.id}`) // API endpoint
                                    .then(response => response.json())
                                    .then(data => {
                                        // Access the 'chambre' array from the API response
                                        const modal = document.getElementById('modal_detail');
                                        modal.innerHTML = '';

                                        const hopital = data.hopital;
                                        const facture = data.facture;
                                        const patient = data.patient;
                                        const nature = data.natureadmission;
                                        const type = data.typeadmission;
                                        const lit = data.lit;
                                        const chambre = data.chambre;
                                        const user = data.user;

                                        const div = document.createElement('div');
                                        div.innerHTML = `
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="">
                                                        <div class="card-body">
                                                            <div class="row justify-content-between">
                                                                <div class="col-12 text-center">                  
                                                                    <h6 class="fw-semibold">Docteur :</h6>
                                                                    <p>${user.name}</p>
                                                                    <h6 class="fw-semibold">Spécialité :</h6>
                                                                    <p>${user.typeacte}</p>
                                                                    <h6 class="fw-semibold">Chambre Occupé :</h6>
                                                                    <p>CH-${chambre.code}</p>
                                                                    <h6 class="fw-semibold">Lit Occupé :</h6>
                                                                    <p>LIT-${lit.code}/${lit.type}</p>
                                                                    <h6 class="fw-semibold">Prix :</h6>
                                                                    <p>${chambre.prix} Fcfa</p>
                                                                </div>
                                                                <div class="col-12 text-center mt-4">
                                                                    <h6 class="fw-semibold">Type d'admission :</h6>
                                                                    <p>${type.nom}</p>
                                                                    <h6 class="fw-semibold">Nature d'admission :</h6>
                                                                    <p>${nature.nom}</p>
                                                                    <h6 class="fw-semibold">Date d'entrer :</h6>
                                                                    <p>${formatDate(hopital.date_debut)}</p>
                                                                    <h6 class="fw-semibold">Date de sortie Probable :</h6>
                                                                    <p>${formatDate(hopital.date_fin)}</p>
                                                                    <h6 class="fw-semibold">Nombre de jours :</h6>
                                                                    <p>${calculateDaysBetween(hopital.date_debut, hopital.date_fin)}</p>
                                                                </div>
                                                                <div class="col-12 text-center mt-4">
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
                                                                    <h6 class="fw-semibold">Part Patient :</h6>
                                                                    <p>${hopital.part_patient} Fcfa</p>
                                                                    <h6 class="fw-semibold">Part Assurance :</h6>
                                                                    <p>${hopital.part_assurance} Fcfa</p>
                                                                    <h6 class="fw-semibold">Remise :</h6>
                                                                    <p>${hopital.remise ? hopital.remise : '0'} Fcfa</p>
                                                                    <h6 class="fw-semibold">Montant Total :</h6>
                                                                    <p>${hopital.montant} Fcfa</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        `;

                                        modal.appendChild(div);

                                    })
                                    .catch(error => {
                                        console.error('Erreur lors du chargement des données:', error);
                                    });
                            });

                            document.getElementById(`fiche-${item.id}`).addEventListener('click', () =>
                            {
                                fetch(`/api/detail_hos/${item.id}`) // API endpoint
                                    .then(response => response.json())
                                    .then(data => {
                                        // Access the 'chambre' array from the API response
                                        const hopital = data.hopital;
                                        const facture = data.facture;
                                        const patient = data.patient;
                                        const nature = data.natureadmission;
                                        const type = data.typeadmission;
                                        const lit = data.lit;
                                        const chambre = data.chambre;
                                        const user = data.user;
                                        const produit = data.produit;

                                        generatePDFInvoice(hopital, facture, patient, nature, type, lit, chambre, user, produit);

                                    })
                                    .catch(error => {
                                        console.error('Erreur lors du chargement des données:', error);
                                    });
                            });

                            const deleteButton = document.getElementById(`add-${item.id}`);
                            if (deleteButton) {
                                deleteButton.addEventListener('click', () => {
                                    fetch(`/api/list_produit_all`) // API endpoint pour récupérer la liste des produits
                                        .then(response => response.json())
                                        .then(data => {
                                            
                                            document.getElementById('id_hos_produit').value = item.id;
                                            document.getElementById('montant_total_produit').value = "";

                                            const produits = data.produit;

                                            // Affichage initial des produits dans le premier select
                                            const contenuDiv = document.getElementById('contenu');
                                            contenuDiv.innerHTML = '';
                                            
                                            addSelect(contenuDiv, produits); // Ajouter le premier select
                                        })
                                        .catch(error => {
                                            console.error('Erreur lors du chargement des données:', error);
                                        });
                                });
                            }

                            document.getElementById(`detail_produit-${item.id}`).addEventListener('click',()=>
                                {
                                    const tableBodyP = document.querySelector('#TableP tbody');
                                    const messageDivP = document.getElementById('message_TableP');
                                    const tableDivP = document.getElementById('div_TableP');
                                    const loaderDivP = document.getElementById('div_Table_loaderP');

                                    messageDivP.style.display = 'none';
                                    tableDivP.style.display = 'none';
                                    loaderDivP.style.display = 'block';

                                    fetch(`/api/list_facture_hos_d/${item.id}`) // API endpoint
                                        .then(response => response.json())
                                        .then(data => {
                                            // Access the 'chambre' array from the API response
                                            const factureds = data.factured;

                                            // Clear any existing rows in the table body
                                            tableBodyP.innerHTML = '';

                                            if (factureds.length > 0) {

                                                loaderDivP.style.display = 'none';
                                                messageDivP.style.display = 'none';
                                                tableDivP.style.display = 'block';

                                                // Loop through each item in the chambre array
                                                factureds.forEach((item, index) => {
                                                    // Create a new row
                                                    const row = document.createElement('tr');
                                                    // Create and append cells to the row based on your table's structure
                                                    row.innerHTML = `
                                                        <td>
                                                            <h6>${item.nom_produit}</h6>
                                                        </td>
                                                        <td>
                                                            <h6>${item.prix_produit} Fcfa</h6>
                                                        </td>
                                                        <td>
                                                            <h6>${item.quantite}</h6>
                                                        </td>
                                                        <td>
                                                            <h6>${item.montant} Fcfa</h6>
                                                        </td>
                                                    `;
                                                    // Append the row to the table body
                                                    tableBodyP.appendChild(row);

                                                });

                                                const row2 = document.createElement('tr');
                                                row2.innerHTML = `
                                                    <td colspan="2">&nbsp;</td>
                                                    <td colspan="2" >
                                                        <h5 class="mt-4 text-success">
                                                            Total : ${item.montant_soins} Fcfa
                                                        </h5>
                                                    </td>
                                                `;
                                                tableBodyP.appendChild(row2);

                                                const row3 = document.createElement('tr');
                                                row3.innerHTML = `
                                                    <td colspan="4">
                                                        <h6 class="text-danger">NOTE</h6>
                                                        <p class="small m-0">
                                                            Le Montant Total des produits utilisés
                                                            seront ajouter au montant total de la
                                                            chambre occupé par le patient.
                                                        </p>
                                                    </td>
                                                `;

                                                tableBodyP.appendChild(row3);

                                            } else {
                                                loaderDivP.style.display = 'none';
                                                messageDivP.style.display = 'block';
                                                tableDivP.style.display = 'none';
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Erreur lors du chargement des données:', error);
                                            loaderDivD.style.display = 'none';
                                            messageDivD.style.display = 'block';
                                            tableDivD.style.display = 'none';
                                        });
                                    
                                });

                        });

                        updatePaginationControls(pagination);

                    } else {
                        document.getElementById(`btn_print_table_hos`).style.display = 'none';
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

            // Fonction pour mettre à jour le montant total
            function updateMontantTotal() {
                let montantTotal = 0;
                const selects = document.querySelectorAll('.produit-select');
                selects.forEach(select => {
                    const selectedOption = select.options[select.selectedIndex];
                    const prix = parseInt(selectedOption.dataset.prix);
                    const quantite = parseInt(select.parentElement.querySelector('#quantite_demande').value);
                    montantTotal += prix * quantite;
                });
                
                // Formater le montant total avec des points
                const montantTotalFormatted = montantTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                document.getElementById('montant_total_produit').value = montantTotalFormatted;
            }

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
                    showAlert('Alert', `La quantité demandée ne peut pas dépasser ${quantiteDisponible}.`,'warning');
                    quantiteInput.value = quantiteDisponible;
                }else if(quantiteInput.value == ''){
                    quantiteInput.value = 1;
                }

                if(!selectedOption.value == ''){
                    updateMontantTotal();
                } // Mettre à jour le montant total lors de la perte de focus
            });
        }

        document.getElementById('add_select').addEventListener('click', () => {
            const contenuDiv = document.getElementById('contenu');

            // Récupérer les produits à partir de l'API
            fetch(`/api/list_produit_all`)
                .then(response => response.json())
                .then(data => {
                    const produits = data.produit;
                    // Ajouter un nouveau select avec les produits
                    addSelect(contenuDiv, produits);
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des produits:', error);
                });
        });

        function checkContenu() {
            const contenuDiv = document.getElementById('contenu');
            const divBtnPro = document.getElementById('div_btn_pro');
            
            // Si la div #contenu a un contenu, on affiche le bouton, sinon on le cache
            if (contenuDiv.innerHTML.trim() !== "") {
                divBtnPro.style.display = "block"; // Afficher le bouton
            } else {
                divBtnPro.style.display = "none";  // Cacher le bouton
            }
        }

        // Assurez-vous que ce code soit exécuté après l'ajout du bouton "Enregistrer"
        document.getElementById('btn_eng_produit').addEventListener('click', () => {
            const selections = [];
            const selects = document.querySelectorAll('.produit-select');
            let formIsValid = true;

            selects.forEach(select => {
                const selectedOption = select.options[select.selectedIndex];
                const idProduit = selectedOption.value; // ID du produit sélectionné
                const quantiteDemande = parseInt(select.parentElement.querySelector('#quantite_demande').value); // Quantité demandée
                const prix = parseInt(selectedOption.dataset.prix); // Prix du produit

                // Validation du produit et de la quantité
                if (!idProduit) {  // Si aucun produit n'est sélectionné
                    formIsValid = false;
                    showAlert('Alert', 'Veuillez sélectionner un produit.','warning');
                    return false;  // Stopper l'exécution si une erreur est trouvée
                }

                if (isNaN(quantiteDemande) || quantiteDemande <= 0) { // Si la quantité n'est pas valide
                    formIsValid = false;
                    showAlert('Alert', 'Veuillez entrer une quantité valide pour chaque produit.','warning');
                    return false;  // Stopper l'exécution si une erreur est trouvée
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

            if (!Array.isArray(selections) || selections.length === 0) {
                showAlert('Alert', 'Veuillez selectionner un produit.','warning');
                return;
            }

            if (!formIsValid) {
                showAlert('Alert', 'Veuillez selectionner un ou des produit(s).','warning');
                return; // Sortir de la fonction pour éviter le calcul
            }

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
                        showAlert('Succès', 'Produit Pharmacie ajouter.','success');
                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue','error');
                    } else if (response.json) {
                        showAlert('Alert', 'Invalid selections format','error');
                    }

                    list_hos();
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement','error');
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

        function calculateDaysBetween(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            
            // Calcul de la différence en millisecondes
            const diffInMilliseconds = end - start;

            // Conversion en jours (millisecondes en secondes, minutes, heures, jours)
            let diffInDays = diffInMilliseconds / (1000 * 60 * 60 * 24);

            // Si la différence est inférieure ou égale à 0, on retourne 1 jour minimum
            return diffInDays <= 0 ? 1 : Math.round(diffInDays); 
        }

        function updatePaginationControls(pagination) {
            const paginationDiv = document.getElementById('pagination-controls-hos');
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
                    list_hos(pagination.current_page - 1);
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
                    list_hos(i);
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
                    list_hos(totalPages);
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
                    list_hos(pagination.current_page + 1);
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

        function generatePDFInvoice(hopital, facture, patient, nature, type, lit, chambre, user, produit) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });

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
                const hopitalDate = new Date(hopital.created_at);
                // Formatter la date et l'heure séparément
                const formattedDate = hopitalDate.toLocaleDateString(); // Formater la date
                const formattedTime = hopitalDate.toLocaleTimeString();
                doc.text("Date: " + formattedDate, 15, (yPos + 25));
                doc.text("Heure: " + formattedTime, 15, (yPos + 30));

                //Ligne de séparation
                doc.setFontSize(15);
                doc.setFont("Helvetica", "bold");
                doc.setLineWidth(0.5);
                doc.setTextColor(255, 0, 0);
                // doc.line(10, 35, 200, 35); 
                const titleR = "FACTURE HOSPITALISATION";
                const titleRWidth = doc.getTextWidth(titleR);
                const titleRX = (doc.internal.pageSize.getWidth() - titleRWidth) / 2;
                // Définir le padding
                const paddingh = 0; // Padding vertical
                const paddingw = 15; // Padding horizontal
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

                const medecinInfo = [
                    { label: "Medecin", value: "Dr. "+user.name },
                    { label: "Spécialité", value: user.typeacte },
                    { label: "Date d'entrée le ", value: formatDate(hopital.date_debut) },
                    { label: "Date de sortie prévu le ", value: formatDate(hopital.date_fin) },
                    { label: "Nombre de jours ", value: calculateDaysBetween(hopital.date_debut, hopital.date_fin)+" Jour(s)" },
                ];

                medecinInfo.forEach(info => {
                    doc.setFontSize(8);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 100, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 135, yPoss);
                    yPoss += 7;
                });

                yPoss = (yPos + 90);

                const typeInfo = [
                    { label: "Type d'admission", value: type.nom },
                    { label: "Nature d'admission", value: nature.nom },
                    { label: "Chambre Occupée", value: "CH-"+chambre.code },
                    { label: "Lit Occupée", value: "LIT-"+lit.code+"/"+lit.type },
                    { label: "Prix", value: chambre.prix+" Fcfa" },
                ];

                typeInfo.forEach(info => {
                    doc.setFontSize(8);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 35, yPoss);
                    yPoss += 7;
                });

                yPoss = (yPos + 90);

                const compteInfo = [
                    { label: "Part assurance", value: hopital.part_assurance+" Fcfa"},
                    { label: "Part Patient", value: hopital.part_patient+" Fcfa"},
                    { label: "Remise", value: hopital.remise ? hopital.remise + " Fcfa" : "0 Fcfa" }
                ];

                if (patient.taux !== null) {
                    compteInfo.push({ label: "Taux", value: patient.taux + "%" });
                }

                compteInfo.forEach(info => {
                    doc.setFontSize(9);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 120, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 150, yPoss);
                    yPoss += 7;
                });

                yPoss += 1;

                doc.setFontSize(11);
                doc.setFont("Helvetica", "bold");
                doc.text('Total Chambre', leftMargin + 120, yPoss);
                doc.setFont("Helvetica", "bold");
                doc.text(": "+hopital.montant+" Fcfa", leftMargin + 150, yPoss);

                const donneeTable = produit;
                // Using autoTable to add a dynamic table for hospital stay details
                if (donneeTable.length > 0) {
                    yPossT = yPoss + 10;
                    doc.autoTable({
                        startY: yPossT, // Ajustez cette valeur pour le placer correctement sur la page
                        head: [['N°','Nom du produit utilisé', 'Quantité', 'Prix Unitaire', 'Montant']], // En-têtes du tableau
                        body: donneeTable.map((item, index) => [
                            index + 1,
                            item.nom_produit, // Nom du produit
                            item.quantite, // Quantité
                            item.prix_produit+" Fcfa", // Prix unitaire
                            item.montant+" Fcfa", // Montant (quantité * prix unitaire)
                        ]), // Remplace les lignes par les données dynamiques
                        theme: 'striped', // Vous pouvez changer le thème en plain, grid, etc.
                        // headStyles: { fillColor: [255, 0, 0] }, // En-tête en rouge si nécessaire
                    });

                    // Utiliser la position Y de la dernière ligne du tableau
                    const finalY = doc.autoTable.previous.finalY || yPossT + 10;

                    // Ajuster yPoss à la fin du tableau pour le placement des totaux
                    yPoss = finalY + 10;

                    // Déclarer finalInfo comme un tableau vide
                    const finalInfo = [];
                    
                    // Ajouter l'entrée "Total Produit" si produit.length > 0
                    if (produit.length > 0) {
                        finalInfo.push({ label: "Total Produit", value: hopital.montant_soins });
                    }
                    
                    // Ajouter l'entrée "Montant a payer"
                    finalInfo.push({ label: "Montant a payer", value: hopital.total_final });
                    
                    // Boucler à travers finalInfo pour afficher les informations
                    finalInfo.forEach(info => {
                        doc.setFontSize(11);
                        doc.setFont("Helvetica", "bold");
                        doc.text(info.label, leftMargin + 120, yPoss);
                        doc.setFont("Helvetica", "normal");
                        doc.text(": " + info.value + " Fcfa", leftMargin + 150, yPoss);
                        yPoss += 7;
                    });

                } else {

                    yPoss += 7;
                    // Déclarer finalInfo comme un tableau vide
                    const finalInfo = [];
                    // Ajouter l'entrée "Total Produit" si produit.length > 0
                    if (produit.length > 0) {
                        finalInfo.push({ label: "Total Produit", value: hopital.montant_soins });
                    }
                    // Ajouter l'entrée "Montant a payer"
                    finalInfo.push({ label: "Montant a payer", value: hopital.total_final });
                    // Boucler à travers finalInfo pour afficher les informations
                    finalInfo.forEach(info => {
                        doc.setFontSize(11);
                        doc.setFont("Helvetica", "bold");
                        doc.text(info.label, leftMargin + 120, yPoss);
                        doc.setFont("Helvetica", "normal");
                        doc.text(": " + info.value + " Fcfa", leftMargin + 150, yPoss);
                        yPoss += 7;
                    });
                }

            }

            function addFooter() {
                const pageCount = doc.internal.getNumberOfPages();
                for (let i = 1; i <= pageCount; i++) {
                    doc.setPage(i);
                    const footerText = "Imprimer le " + new Date().toLocaleDateString() + " à " + new Date().toLocaleTimeString();
                    doc.setFontSize(7);
                    doc.setFont("Helvetica", "bold");
                    doc.setTextColor(0, 0, 0);
                    doc.text(footerText, 5, 295); // Position near the bottom of the page (5mm from the left, 290mm from the top)
                }
            }

            drawConsultationSection(yPos);

            addFooter();

            doc.output('dataurlnewwindow');
        }

        function Statistique() {

            const nbre_day = document.getElementById("nbre_hos");

            $.ajax({
                url: '/api/statistique_hos',
                method: 'GET',
                success: function(response) {
                    // Set the text content of each element
                    nbre_day.textContent = response.stat_hos_day;
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
