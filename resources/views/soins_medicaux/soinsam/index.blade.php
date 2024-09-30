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
                        <h2>Dr. Patrick Kim</h2>
                        <h5>Votre emploi du temps aujourd'hui.</h5>
                        <div class="mt-4 d-flex gap-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box lg bg-info rounded-5 me-3">
                                    <i class="ri-walk-line fs-1"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h2 class="m-0 lh-1">9</h2>
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
                                    <i class="ri-walk-line me-2"></i>
                                    Nouveau Soins Infirmier
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab" aria-controls="oneAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
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
                                            <input type="hidden" class="form-control" id="matricule_patient" autocomplete="off">
                                            <input type="text" class="form-control" id="patient" placeholder="saisie obligatoire" autocomplete="off">
                                            <div class="suggestions" id="suggestions_patient" style="display: none;"></div>
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
                                    <div class="p-2" id="div_alert_calcul" ></div>
                                    </div>
                                    <div class="p-2" id="div_alert" ></div>
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

        Name_atient();
        select_typesoins();

        
        document.getElementById("btn_calcul").addEventListener("click", CalculMontant);
        document.getElementById("assurance_utiliser").addEventListener("change", CalculMontant);
        document.getElementById("btn_eng").addEventListener("click", Eng_sa);


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
                    });

                    // Hide suggestions when clicking outside
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


        // function rech_dossier()
        // {
        //     const matricule_patient = document.getElementById("matricule_patient").value;

        //     if(!matricule_patient.trim()){
        //         showAlert('warning', 'Veuillez saisie le nom d\'un du patient.');
        //         return false;
        //     }

        //     // Créer l'élément de préchargement
        //     var preloader_ch = `
        //         <div id="preloader_ch">
        //             <div class="spinner_preloader_ch"></div>
        //         </div>
        //     `;

        //     // Ajouter le préchargeur au body
        //     document.body.insertAdjacentHTML('beforeend', preloader_ch);

        //     $.ajax({
        //         url: '/api/rech_patient_hos/' + matricule_patient,
        //         method: 'GET',
        //         success: function(response) {
        //             var preloader = document.getElementById('preloader_ch');

        //             if (preloader) {
        //                 preloader.remove();
        //             }

        //             if(response.existep) {

        //                 showAlert('warning', 'Ce patient n\'existe pas.');
        //                 return false;

        //             } else if(response.existe) {

        //                 showAlert('warning', 'Ce patient est déjà hospitaliser.');
        //                 document.getElementById('patient').value = "" ;
        //                 document.getElementById("matricule_patient").value = "" ;
        //                 return false;

        //             } else if (response.success) {
        //                 showAlert('success', 'Patient trouvé.');

        //                 const patient_taux = document.getElementById('patient_taux');
        //                 patient_taux.value = '';
        //                 patient_taux.value = response.patient.taux ? response.patient.taux : 0;

        //                 const appliq_remise = document.getElementById('appliq_remise');

        //                 // Cacher l'option "Assurance" si le taux est égal à 0
        //                 if (patient_taux.value == 0) {
        //                     for (let i = 0; i < appliq_remise.options.length; i++) {
        //                         if (appliq_remise.options[i].value === 'assurance') {
        //                             appliq_remise.options[i].style.display = 'none'; // Cacher l'option
        //                         }
        //                     }
        //                 } else {
        //                     // Afficher l'option "Assurance" si le taux est différent de 0
        //                     for (let i = 0; i < appliq_remise.options.length; i++) {
        //                         if (appliq_remise.options[i].value === 'assurance') {
        //                             appliq_remise.options[i].style.display = 'block'; // Afficher l'option
        //                         }
        //                     }
        //                 }
        //             }
        //         },
        //         error: function() {
        //             var preloader = document.getElementById('preloader_ch');
        //             if (preloader) {
        //                 preloader.remove();
        //             }
        //             showAlert('danger', 'Une erreur est survenue lors de la recherche.');
        //         }
        //     });
        // }

        function showAlert(type, message) {

            var dynamicFields = document.getElementById("div_alert");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var groupe = document.createElement("div");
            groupe.className = `alert bg-${type} text-white alert-dismissible fade show`;
            groupe.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>   
            `;
            document.getElementById("div_alert").appendChild(groupe);

            setTimeout(function() {
                groupe.classList.remove("show");
                groupe.classList.add("fade");
                setTimeout(function() {
                    groupe.remove();
                }, 150); // Time for the fade effect to complete
            }, 3000);
        }

        function showAlertCalcul(type, message) {

            var dynamicFields = document.getElementById("div_alert_calcul");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var groupe = document.createElement("div");
            groupe.className = `alert bg-${type} text-white alert-dismissible fade show`;
            groupe.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>   
            `;
            document.getElementById("div_alert_calcul").appendChild(groupe);

            setTimeout(function() {
                groupe.classList.remove("show");
                groupe.classList.add("fade");
                setTimeout(function() {
                    groupe.remove();
                }, 150); // Time for the fade effect to complete
            }, 3000);
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
                showAlertSoins('warning', `Selectionner un Type de Soins`);
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

        function showAlertSoins(type, message) {

            var dynamicFields = document.getElementById("div_alert_soins");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var groupe = document.createElement("div");
            groupe.className = `alert bg-${type} text-white alert-dismissible fade show`;
            groupe.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>   
            `;
            document.getElementById("div_alert_soins").appendChild(groupe);

            setTimeout(function() {
                groupe.classList.remove("show");
                groupe.classList.add("fade");
                setTimeout(function() {
                    groupe.remove();
                }, 150); // Time for the fade effect to complete
            }, 3000);
        }

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
                    showAlertQauntite('warning', `La quantité demandée ne peut pas dépasser ${quantiteDisponible}.`);
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

        function showAlertQauntite(type, message) {

            var dynamicFields = document.getElementById("div_alert_produit_qu");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var groupe = document.createElement("div");
            groupe.className = `alert bg-${type} text-white alert-dismissible fade show`;
            groupe.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>   
            `;
            document.getElementById("div_alert_produit_qu").appendChild(groupe);

            setTimeout(function() {
                groupe.classList.remove("show");
                groupe.classList.add("fade");
                setTimeout(function() {
                    groupe.remove();
                }, 150); // Time for the fade effect to complete
            }, 3000);
        }

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
                showAlertCalcul('warning', 'Veuillez sélectionner un Patient.');
                resetLoaderAndButton();
                return;
            }

            // 2. Vérifier si un type de soins a été sélectionné
            if (typesoins_id === '') {
                showAlertCalcul('warning', 'Veuillez sélectionner un Type de Soins.');
                resetLoaderAndButton();
                return;
            }

            const contenuDiv = document.getElementById('contenu_soins');
            if (contenuDiv.innerHTML.trim() == "") {
                showAlertCalcul('warning', 'Aucun Soins Infirmier n\'a été sélectionné.');
                resetLoaderAndButton();
                return;
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
                    showAlertCalcul('warning', 'Veuillez sélectionner un ou plusieurs Soins Infirmiers valides.');
                    formIsValid = false;
                    return;
                }

                if (selectedSoinsIds.has(idSoins)) {
                    showAlertCalcul('warning', 'Vous avez sélectionné le même Soins Infirmier plusieurs fois.');
                    formIsValid = false;
                    return;
                }

                selectedSoinsIds.add(idSoins);
                selectionsSoins.push({
                    id: idSoins,
                    montant: montant
                });
            });

            const contenuDivPro = document.getElementById('contenu_produit');
            if (contenuDivPro.innerHTML.trim() == "") {
                showAlertCalcul('warning', 'Aucun Produit n\'a été sélectionné.');
                resetLoaderAndButton();
                return;
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
                    showAlertCalcul('warning', 'Veuillez sélectionner un ou plusieurs Produits avec une quantité valide.');
                    formIsValid = false;
                    return;
                }

                if (selectedProduitIds.has(idProduit)) {
                    showAlertCalcul('warning', 'Vous avez sélectionné le même Produit plusieurs fois.');
                    formIsValid = false;
                    return;
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
                return;
            }

            // 5. Calcul du montant total des soins infirmiers et des produits
            const montantTotalSoins = selectionsSoins.reduce((total, soin) => total + soin.montant, 0);
            const montantTotalProduits = selectionsProduits.reduce((total, produit) => total + produit.montant, 0);
            const montantTotal = montantTotalSoins + montantTotalProduits;

            // 6. Calcul de la part de l'assurance et celle du patient
            let taux = parseInt(document.getElementById('patient_taux').value) || 0;

            const auS = document.getElementById('assurance_utiliser').value;
            const appliq_remise = document.getElementById('appliq_remise');
            const taux_remise = 0;

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

            document.getElementById('taux_remise').value = 0;

            document.getElementById('btn_calcul').style.display = 'block';
            document.getElementById('div_calcul').style.display = 'flex';
            document.getElementById('div_loader').style.display = 'none';
        }

        // Fonction pour réinitialiser l'affichage du loader et du bouton
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

            CalculMontant();
            
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

            const matricule_patient = document.getElementById('matricule_patient').value;
            const typesoins_id = document.getElementById('typesoins_id').value;

            if (matricule_patient == '') {
                showAlertCalcul('warning', 'Veuillez sélectionner un Patient.');
                return false;
            }

            if (typesoins_id == '') {
                showAlertCalcul('warning', 'Veuillez sélectionner un Type de Soins.');
                return false;
            }

            var montant_assurance = document.getElementById('montant_assurance').value;
            var taux_remise = document.getElementById('taux_remise').value;
            var montant_total = document.getElementById('montant_total').value;
            var montant_patient = document.getElementById('montant_patient').value;

            // Validate monetary fields
            if (!montant_assurance || 
                !montant_total || 
                !montant_patient) {
                
                showAlertCalcul('warning', 'Vérifier les montants SVP.');
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
                
                showAlertCalcul('warning', 'Vérifier les montants SVP (les montants ne doivent pas être négatifs).');
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
        };

        // -----------------------------------------------------

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

    });
</script>


@endsection
