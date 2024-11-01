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
            Liste des patients
        </li>
        <li class="breadcrumb-item" style="display: block;" id="div_btn_affiche_stat">
            <a class="btn btn-sm btn-warning" id="btn_affiche_stat">
                Afficher les Statstiques
            </a>
        </li>
        <li class="breadcrumb-item" style="display: none;" id="div_btn_cache_stat">
            <a class="btn btn-sm btn-danger" id="btn_cache_stat">
                Cacher les Statstiques
            </a>
        </li>
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <div class="row gx-3 ">
        <div class="col-xxl-12 col-sm-12">
            <div class="card mb-3 bg-3">
                <div class="card-body " style="background: rgba(0, 0, 0, 0.7);" >
                    <div class="py-4 px-3 text-white">
                        <h6>Bienvenue,</h6>
                        <h2>{{Auth::user()->sexe.'. '.Auth::user()->name}}</h2>
                        <h5>Patients.</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gx-3" id="stat"></div>
    </div>
    <div class="row gx-3" >
        <div class="col-sm-12">
            <div class="card mb-3 mt-3">
                <div class="card-body" style="margin-top: -30px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center bg-primary bg-2" id="customTab4" role="tablist" style="background: rgba(0, 0, 0, 0.7);">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-white" id="tab-twoAAAN" data-bs-toggle="tab" href="#twoAAAN" role="tab" aria-controls="twoAAAN" aria-selected="false" tabindex="-1">
                                    <i class="ri-user-add-line me-2"></i>
                                    Nouveau Patient
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-contacts-line me-2"></i>
                                    Liste des Patients
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoRech" data-bs-toggle="tab" href="#twoRech" role="tab" aria-controls="twoRech" aria-selected="false" tabindex="-1">
                                    <i class="ri-search-2-line me-2"></i>
                                    Recherche
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane active show fade" id="twoAAAN" role="tabpanel" aria-labelledby="tab-twoAAAN">
                                <div class="card-header">
                                    <h5 class="card-title">Formulaire Nouveau Patient</h5>
                                </div>
                                <div class="card-body" >
                                    <div class="row gx-3">
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Nom et Prénoms</label>
                                                <input type="text" class="form-control" id="patient_np_new" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Date de naissance
                                                </label>
                                                <input type="date" class="form-control" placeholder="Selectionner une date" id="patient_datenaiss_new">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" id="patient_email_new" placeholder="facultatif">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Contact</label>
                                                <input type="tel" class="form-control" id="patient_tel_new" placeholder="Saisie Obligatoire" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Contact 2</label>
                                                <input type="tel" class="form-control" id="patient_tel2_new" placeholder="facultatif" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Adresse</label>
                                                <input type="text" class="form-control" id="patient_adresse_new" placeholder="facultatif">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Sexe</label>
                                                <select class="form-select" id="patient_sexe_new">
                                                    <option value="">Selectionner</option>
                                                    <option value="Mr">Homme</option>
                                                    <option value="Mme">Femme</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Assurer</label>
                                                <select class="form-select" id="assurer">
                                                    <option selected value="non">Non</option>
                                                    <option value="oui">Oui</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row gx-3" id="div_assurer" style="display: none;">
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Filiation</label>
                                                    <select class="form-select" id="patient_filiation_new">
                                                        <option value="">Selectionner</option>
                                                        <option value="Adhérent(e)">Adhérent(e)</option>
                                                        <option value="Bénéficiaire">Bénéficiaire</option>
                                                        <option value="Conjoint(e)">Conjoint(e)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Assurance</label>
                                                    <select class="form-select" id="patient_assurance_id_new">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Matricule assurance</label>
                                                    <input type="text" class="form-control" id="patient_matriculeA_new" placeholder="Saisie Obligatoire">
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Taux</label>
                                                    <select class="form-select" id="patient_taux_id_new">
                                                        <option value="">Sélectionner un taux</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Société</label>
                                                    <select class="form-select" id="patient_societe_id_new">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <div class="d-flex gap-2 justify-content-start">
                                                <button id="btn_eng_patient" class="btn btn-success">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="twoAAA" role="tabpanel" aria-labelledby="tab-twoAAA">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">
                                        Liste des Patients
                                    </h5>
                                    <div class="d-flex">
                                        <input type="text" id="searchInputP" placeholder="Recherche" class="form-control me-1">
                                    </div>
                                </div>
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="w-100">
                                        <div class="input-group">
                                            <span class="input-group-text">Du</span>
                                            <input type="date" id="searchDate1" placeholder="Recherche" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                            <span class="input-group-text">au</span>
                                            <input type="date" id="searchDate2" placeholder="Recherche" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                                            <span class="input-group-text">Assurer</span>
                                            <select class="form-select me-1" id="statutP">
                                                <option selected value="tous">Tous</option>
                                                <option value="oui">Assurer</option>
                                                <option value="non">Non Assurer</option>
                                            </select>
                                            <a id="btn_search_table" class="btn btn-outline-success ms-auto">
                                                <i class="ri-search-2-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="div_alert_tableP">
                                    </div>
                                    <div class="table-outer" id="div_TableP" style="display: none;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-hover m-0 truncate" id="TableP">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">N°</th>
                                                        <th scope="col">N° Dossier</th>
                                                        <th scope="col">Nom et Prénoms</th>
                                                        <th scope="col">Date de naissance</th>
                                                        <th scope="col">Age</th>
                                                        <th scope="col">Assurer</th>
                                                        <th scope="col">Contact</th>
                                                        <th scope="col">Date de création</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="message_TableP" style="display: none;">
                                        <p class="text-center">
                                            Aucun Patient n'a été trouvé
                                        </p>
                                    </div>
                                    <div id="div_Table_loaderP" style="display: none;">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                            <strong>Chargement des données...</strong>
                                        </div>
                                    </div>
                                    <div id="pagination-controlsP"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="twoRech" role="tabpanel" aria-labelledby="tab-twoRech">
                                <div class="row gx-3">
                                    <div class="row gx-3 justify-content-center align-items-center" >
                                        <div class="col-xxl-4 col-lg-4 col-sm-6">
                                            <div class=" mb-1">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <a class="d-flex align-items-center flex-column">
                                                            <img src="{{asset('assets/images/user8.png')}}" class="img-7x rounded-circle border border-3">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 text-center">
                                                <label class="form-label">
                                                    Nom du Patient
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control text-center" id="nameRech" placeholder="Nom du patient" autocomplete="off">
                                                </div>
                                                <div class="input-group">
                                                    <div class="suggestions w-100" id="suggestions" style="display: none;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-5" id="div_info_patient">
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

<div class="modal fade" id="DetailP" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Détail Patient
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal_detailP">
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Detailexam" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Examens Demandés
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
                                        <div class="table-responsive" id="div_Tableexam" style="display: none;">
                                            <table class="table table-bordered" id="Tableexam">
                                                <thead>
                                                    <tr>
                                                        <th>Examen</th>
                                                        <th>Cotation</th>
                                                        <th>Prix</th>
                                                        <th>Accepté ?</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="message_Tableexam" style="display: none;">
                                            <p class="text-center" >
                                                Aucun Produit utilisé pour le moment
                                            </p>
                                        </div>
                                        <div id="div_Table_loaderexam" style="display: none;">
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

<div class="modal fade" id="Detailhos" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Détail
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal_detailhos"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="Detail_produithos" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
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
                                        <div class="table-responsive" id="div_Tablehos" style="display: none;">
                                            <table class="table table-bordered" id="Tablehos">
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
                                        <div id="message_Tablehos" style="display: none;">
                                            <p class="text-center" >
                                                Aucun Produit utilisé pour le moment
                                            </p>
                                        </div>
                                        <div id="div_Table_loaderhos" style="display: none;">
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

<div class="modal fade" id="Detail_produitsoinsam" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
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
                                        <div class="table-responsive" id="div_Tablesoinsamp" style="display: none;">
                                            <!-- Tableau Soins Infirmiers -->
                                            <table class="table table-bordered" id="Tablesoinsamp">
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

                                        <div class="table-responsive" id="div_TableProdsoinsamp" style="display: none;">
                                            <!-- Tableau Produits Utilisés -->
                                            <table class="table table-bordered" id="TableProdsoinsamp">
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

                                        <div id="message_Tablesoinsamp" style="display: none;">
                                            <p class="text-center" >
                                                Aucun détail pour le moment
                                            </p>
                                        </div>
                                        <div id="div_Table_loadersoinsamp" style="display: none;">
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

<div class="modal fade" id="Detailsoinsam" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Détails
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal_detailsoinsamd" style="display: none;">
            </div>
            <div id="message_detailsoinsamd" style="display: none;">
                <p class="text-center" >
                    Aucun détail pour le moment
                </p>
            </div>
            <div id="div_detail_loadersoinsamd" style="display: none;">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                    <strong>Chargement des données...</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/app/js/jspdfinvoicetemplate/dist/index.js')}}" ></script>
<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>
<script src="{{asset('assets/vendor/apex/apexcharts.min.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        select_taux();
        select_societe_patient();
        select_assurance_patient();
        listP();
        Name_atient();

        document.getElementById("btn_eng_patient").addEventListener("click", eng_patient);
        document.getElementById("btn_search_table").addEventListener("click", listP);

        document.getElementById('btn_affiche_stat').addEventListener('click',function(){

            document.getElementById('div_btn_affiche_stat').style.display = 'none';
            document.getElementById('div_btn_cache_stat').style.display = 'block';

            Statistique();
        });

        document.getElementById('btn_cache_stat').addEventListener('click',function(){

            document.getElementById('div_btn_affiche_stat').style.display = 'block';
            document.getElementById('div_btn_cache_stat').style.display = 'none';

            const stat = document.getElementById("stat");
            stat.innerHTML = '';
        });

        var inputs = ['patient_tel_new', 'patient_tel2_new',]; // Array of element IDs
        inputs.forEach(function(id) {
            var inputElement = document.getElementById(id); // Get each element by its ID

            // Allow only numeric input (and optionally some special keys like backspace or delete)
            inputElement.addEventListener('keypress', function(event) {
                const key = event.key;
                // Allow numeric keys, backspace, and delete
                if (!/[0-9]/.test(key) && key !== 'Backspace' && key !== 'Delete') {
                    event.preventDefault();
                }
            });

            // Alternatively, for more comprehensive input validation, use input event listener
            inputElement.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, ''); // Allow only numbers
            });
        });

        document.getElementById('assurer').addEventListener('change', function() {

            if (this.value == 'oui'){
                document.getElementById("div_assurer").style.display = "flex";
            }else{
                document.getElementById("div_assurer").style.display = "none";
            }
        });

        function formatPrice(price) {

            // Convert to float and round to the nearest whole number
            let number = Math.round(parseFloat(price));
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

        function addGroup(data) {

            var dynamicFields = document.getElementById("div_info_patient");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var groupe = document.createElement("div");
            groupe.className = "row gx-3";
            groupe.innerHTML = `
                <div class="col-12">
                    <div class="card-header">
                        <h5 class="card-title">Information du patient</h5>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="email">Nom et Prénoms</label>
                        <input value="${data.np}" readonly class="form-control">
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="tel">Contact</label>
                        <input value="+225 ${data.tel}" readonly class="form-control">
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="adresse">Adresse</label>
                        <input value="${data.adresse}" readonly class="form-control">
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Assurer</label>
                        <input value="${data.assurer}" readonly class="form-control">
                    </div>
                </div>
            `;

            // Check if the patient has insurance and add the additional fields
            if (data.assurer === 'oui') {
                groupe.innerHTML += `
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Assurance</label>
                            <input value="${data.assurance}" readonly class="form-control" placeholder="Néant">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Taux</label>
                            <div class="input-group">      
                                <input id="patient_taux" value="${data.taux}" readonly class="form-control" placeholder="Néant">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Société</label>
                            <input value="${data.societe}" readonly class="form-control" placeholder="Néant">
                        </div>
                    </div>
                `;
            }else{
                groupe.innerHTML += `
                    <div class="col-xxl-3 col-lg-4 col-sm-6" hidden>
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Assurance</label>
                            <input value="Aucun" readonly class="form-control" placeholder="Néant">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-6" hidden>
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Taux</label>
                            <div class="input-group">      
                                <input id="patient_taux" value="0" readonly class="form-control" placeholder="Néant">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-6" hidden>
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Société</label>
                            <input value="Aucun" readonly class="form-control" placeholder="Néant">
                        </div>
                    </div>
                `;
            }

            dynamicFields.appendChild(groupe);
        }

        function showAlert(title, message, type) {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
            });
        }

        function select_taux()
        {
            const selectElement = document.getElementById('patient_taux_id_new');
            selectElement.innerHTML = '';

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner un taux';
            selectElement.appendChild(defaultOption);
            // Vérifie que l'élément select existe
            if (selectElement) {
                // Effectuer une requête pour récupérer les taux
                fetch('/api/taux_select_patient_new')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(taux => {
                            const option = document.createElement('option');
                            option.value = taux.id; // Assure-toi que 'id' est la clé correcte
                            option.textContent = taux.taux+'%'; // Assure-toi que 'nom' est la clé correcte
                            selectElement.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Erreur lors du chargement des taux:', error));
            }
        }

        function select_societe_patient()
        {
            const selectElement = document.getElementById('patient_societe_id_new');
            selectElement.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner une société';
            selectElement.appendChild(defaultOption);
            // Vérifie que l'élément select existe
            if (selectElement) {
                // Effectuer une requête pour récupérer les taux
                fetch('/api/societe_select_patient_new')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(societe => {
                            const option = document.createElement('option');
                            option.value = societe.id; // Assure-toi que 'id' est la clé correcte
                            option.textContent = societe.nom; // Assure-toi que 'nom' est la clé correcte
                            selectElement.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Erreur lors du chargement des societes:', error));
            }
        }

        function select_assurance_patient()
        {
            const selectElement = document.getElementById('patient_assurance_id_new');
            // Clear existing options
            selectElement.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner une Assurance';
            selectElement.appendChild(defaultOption);

            fetch('/api/assurance_select_patient_new')
                .then(response => response.json())
                .then(data => {
                    data.forEach(assurance => {
                        const option = document.createElement('option');
                        option.value = assurance.id; // Ensure 'id' is the correct key
                        option.textContent = assurance.nom; // Ensure 'nom' is the correct key
                        selectElement.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des societes:', error));
        }

        function eng_patient()
        {
            const divAssurer = document.getElementById("div_assurer");

            var nom = document.getElementById("patient_np_new");
            var email = document.getElementById("patient_email_new");
            var phone = document.getElementById("patient_tel_new");
            var phone2 = document.getElementById("patient_tel2_new");
            var adresse = document.getElementById("patient_adresse_new");
            var assurer = document.getElementById('assurer');

            var datenais = document.getElementById("patient_datenaiss_new");
            var sexe = document.getElementById("patient_sexe_new");
            var filiation = document.getElementById("patient_filiation_new");
            var matricule_assurance = document.getElementById("patient_matriculeA_new");

            var assurance_id = document.getElementById("patient_assurance_id_new");
            var taux_id = document.getElementById("patient_taux_id_new");
            var societe_id = document.getElementById("patient_societe_id_new");

            if (!nom.value.trim() || !phone.value.trim() || !datenais.value.trim() || !sexe.value.trim()) {
                showAlert('Alert', 'Tous les champs sont obligatoires.','warning');
                return false; 
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value.trim() && !emailRegex.test(email.value.trim())) {
                showAlert('Alert', 'Email incorrect.','warning');
                return false;
            }

            if (phone.value.length !== 10 || (phone2.value !== '' && phone2.value.length !== 10)) {
                showAlert('Alert', 'Contact incomplet.','warning');
                return false;
            }

            if (assurer.value == 'oui') {
                if (assurance_id.value !== '' && taux_id.value !== '' && societe_id.value !== '' || filiation.value !== '' || matricule_assurance.value !== '') {
                } else {
                    showAlert('Alert', 'Veuillez remplir tous les champs relatifs à l\'assurance','warning');
                    return false;
                }
            }

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/patient_new',
                method: 'GET',  // Use 'POST' for data creation
                data: { nom: nom.value, email: email.value || null , tel: phone.value, tel2: phone2.value || null, adresse: adresse.value || null, assurer: assurer.value, assurance_id: assurance_id.value || null, taux_id: taux_id.value || null, societe_id: societe_id.value || null, datenais: datenais.value, sexe: sexe.value, filiation: filiation.value || null, matricule_assurance: matricule_assurance.value || null
                },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.tel_existe) {
                        showAlert('Alert', 'Ce numéro de téléphone appartient déjà a un patient.','warning');
                    }else if (response.email_existe) {
                        showAlert('Alert', 'Cet email appartient déjà a un patient.','warning');
                    }else if (response.nom_existe) {
                        showAlert('Alert', 'Cet patient existe déjà.','warning');
                    } else if (response.success) {

                        nom.value = '';
                        email.value = '';
                        phone.value = '';
                        phone2.value = '';
                        adresse.value = '';
                        datenais.value = '';
                        sexe.value = '';
                        filiation.value = '';
                        matricule_assurance.value = '';
                        assurance_id.value = "";
                        taux_id.value = "";
                        societe_id.value = "";

                        assurer.value = 'non';

                        divAssurer.style.display = "none";

                        Statistique();
                        listP();
                        Name_atient();

                        showAlert('Succès', 'Patient Enregistrée.','success');
                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.','error');
                    }

                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.','error');
                }
            });
        }

        function listP(page = 1) {

            const tableBody = document.querySelector('#TableP tbody');
            const messageDiv = document.getElementById('message_TableP');
            const tableDiv = document.getElementById('div_TableP');
            const loaderDiv = document.getElementById('div_Table_loaderP');

            const date1 = document.getElementById('searchDate1').value;
            const date2 = document.getElementById('searchDate2').value;

            let allPatients = [];

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const statut = document.getElementById('statutP').value;
            const url = `/api/list_patient_all/${date1}/${date2}/${statut}?page=${page}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    allPatients = data.patient || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    tableBody.innerHTML = '';

                    if (allPatients.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        function displayRows(filteredPatients) {
                            tableBody.innerHTML = ''; 

                            filteredPatients.forEach((item, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                    <td>P-${item.matricule}</td>
                                    <td>${item.sexe}. ${item.np}</td>
                                    <td>${formatDate(item.datenais)}</td>
                                    <td>${item.age} an(s)</td>
                                    <td>
                                        <span class="badge ${item.assurer === 'oui' ? 'bg-success' : 'bg-danger'}">
                                            ${item.assurer === 'oui' ? 'Oui' : 'Non'}
                                        </span>
                                    </td>
                                    <td>+225 ${item.tel}</td>
                                    <td>${formatDateHeure(item.created_at)}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a class="btn btn-outline-warning btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#DetailP" id="detailP-${item.id}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                `;
                                tableBody.appendChild(row);

                                document.getElementById(`detailP-${item.id}`).addEventListener('click', () =>
                                {
                                    const modal = document.getElementById('modal_detailP');
                                    modal.innerHTML = '';

                                    const div = document.createElement('div');
                                    div.innerHTML = `
                                           <div class="row gx-3">
                                                <div class="col-12">
                                                    <div class=" mb-3">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <a href="doctors-profile.html" class="d-flex align-items-center flex-column">
                                                                    <img src="{{asset('assets/images/user7.png')}}" class="img-7x rounded-circle mb-3 border border-3">
                                                                    <h5>${item.sexe}. ${item.np}</h5>
                                                                    <h6 class="text-truncate">
                                                                        +225 ${item.tel}
                                                                    </h6>
                                                                    <p>Date création : ${formatDateHeure(item.created_at)} </p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class=" mb-3">
                                                        <div class="card-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item active text-center" aria-current="true">
                                                                    Informations personnelles
                                                                </li>
                                                                <li class="list-group-item">
                                                                    N° Dossier : P-${item.matricule} 
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Nom et Prénoms : ${item.np}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Date de naissance : ${formatDate(item.datenais)}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Age : ${item.age ? item.age : '0'} an(s)
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Genre : ${item.sexe == 'M' ? 'Homme' : 'Femme'}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Email : ${item.email ? item.email : 'Néant'}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Contact 1 : ${item.tel ? '+225 '+item.tel : 'Néant'}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Contact2 :  ${item.tel2 ? '+225 '+item.tel2 : 'Néant'}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Adresse : ${item.adresse ? item.adresse : 'Néant'}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Assurer : ${item.assurer ? item.assurer : 'Néant'}
                                                                </li>
                                                                ${item.assurer == 'oui' ? 
                                                                `<li class="list-group-item">
                                                                    Société : ${item.societe ? item.societe : 'Néant'}
                                                                </li>` : ``}

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                ${item.assurer == 'oui' ?  
                                                `<div class="col-12">
                                                    <div class=" mb-3">
                                                        <div class="card-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item active text-center" aria-current="true">
                                                                    Informations Assurance
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Nom de l'assurance : ${item.assurance ? item.assurance : 'Néant'}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Taux de Couverture : ${item.taux ? item.taux+'%' : 'Néant'}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Filiation : ${item.filiation ? item.filiation : 'Néant'}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Matricule : ${item.matricule_assurance ? item.matricule_assurance : 'Néant'}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>`
                                                : ''}
                                                <div class="col-12">
                                                    <div class=" mb-3">
                                                        <div class="card-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item active text-center" aria-current="true">
                                                                    Statistique
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Consultation : ${item.nbre_cons ? item.nbre_cons : 'O'}
                                                                </li>
                                                                <li class="list-group-item">
                                                                    Hospitalisation : ${item.nbre_hos ? item.nbre_hos : 'O'}
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
                        };

                        // Update table with filtered factures
                        function applySearchFilter() {
                            const searchTerm = searchInputP.value.toLowerCase();

                            // Filtrer les patients en vérifiant plusieurs champs
                            const filteredPatients = allPatients.filter(item =>
                                item.matricule.toLowerCase().includes(searchTerm) ||
                                item.np.toLowerCase().includes(searchTerm) ||
                                item.sexe.toLowerCase().includes(searchTerm) ||
                                item.tel.toLowerCase().includes(searchTerm) ||
                                formatDate(item.datenais).toLowerCase().includes(searchTerm) ||
                                item.age.toString().toLowerCase().includes(searchTerm) ||
                                item.assurer.toLowerCase().includes(searchTerm) ||
                                formatDateHeure(item.created_at).toLowerCase().includes(searchTerm)
                            );

                            displayRows(filteredPatients); // Afficher seulement les patients filtrés
                        }

                        searchInputP.addEventListener('input', applySearchFilter);

                        displayRows(allPatients);

                        updatePaginationControlsP(pagination);

                    } else {
                        tableDiv.style.display = 'none';
                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des donnée:', error);
                    loaderDiv.style.display = 'none';
                    tableDiv.style.display = 'none';
                    messageDiv.style.display = 'block';
                });
        }

        function updatePaginationControlsP(pagination) {
            const paginationDiv = document.getElementById('pagination-controlsP');
            paginationDiv.innerHTML = '';

            // Bootstrap pagination wrapper
            const paginationWrapper = document.createElement('ul');
            paginationWrapper.className = 'pagination justify-content-center';

            // Previous button
            if (pagination.current_page > 1) {
                const prevButton = document.createElement('li');
                prevButton.className = 'page-item';
                prevButton.innerHTML = `<a class="page-link" href="#">Precédent</a>`;
                prevButton.onclick = () => listP(pagination.current_page - 1);
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
                pageItem.onclick = () => listP(i);
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
                lastPageItem.onclick = () => listP(totalPages);
                paginationWrapper.appendChild(lastPageItem);
            }

            // Next button
            if (pagination.current_page < pagination.last_page) {
                const nextButton = document.createElement('li');
                nextButton.className = 'page-item';
                nextButton.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                nextButton.onclick = () => listP(pagination.current_page + 1);
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

        function formatDate(dateString) {

            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const year = date.getFullYear();

            return `${day}/${month}/${year}`; // Format as dd/mm/yyyy
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

        function Statistique() {

            const stat = document.getElementById("stat");

            const div = document.createElement('div');
            div.innerHTML = `
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                    <strong>Chargement des données...</strong>
                </div>
            `;
            stat.appendChild(div);

            fetch('/api/statistique_patient') // API endpoint
                .then(response => response.json())
                .then(data => {

                    const stat_h = data.stat_h;
                    const stat_f = data.stat_f;
                    const stat_a = data.stat_a;
                    const stat_an = data.stat_an;

                    stat.innerHTML = '';

                    if (stat_h === 0 && stat_f === 0 && stat_a === 0 && stat_an === 0) {
                        const div = document.createElement('div');
                        div.innerHTML = `
                            <div class="d-flex justify-content-center align-items-center">
                                <p>Aucune données n'a été trouvée</p>
                            </div>
                        `;
                        stat.appendChild(div);
                        return; // Exit the function, no need to render charts
                    }

                    const rowDiv = document.createElement('div');
                    rowDiv.classList.add('row');

                    const div1 = document.createElement('div');
                    div1.classList.add('col-xxl-3', 'col-sm-6', 'mb-3');
                    div1.innerHTML = `
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title">Genre</h5>
                                <div class="auto-align-graph">
                                    <div id="graphGenre"></div>
                                </div>
                            </div>
                        </div>
                    `;
                    rowDiv.appendChild(div1);

                    const div2 = document.createElement('div');
                    div2.classList.add('col-xxl-3', 'col-sm-6', 'mb-3');
                    div2.innerHTML = `
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Assurer ?</h5>
                                <div class="auto-align-graph">
                                    <div id="graphAssurer"></div>
                                </div>
                            </div>
                        </div>
                    `;
                    rowDiv.appendChild(div2);

                    stat.appendChild(rowDiv);

                    var options1 = {
                        chart: {
                            width: 240,
                            type: "donut",
                        },
                        labels: ["Homme", "Femme"],
                        series: [stat_h, stat_f],
                        legend: {
                            position: "bottom",
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        stroke: {
                            width: 0,
                        },
                        colors: ["#116AEF", "#ff5a39", "#ff5a39", "#3e3e42", "#75C2F6"],
                    };
                    var chart1 = new ApexCharts(document.querySelector("#graphGenre"), options1);
                    chart1.render();

                    var options = {
                        chart: {
                            width: 240,
                            type: "donut",
                        },
                        labels: ["Assuré", "Non-Assuré"],
                        series: [stat_a, stat_an],
                        legend: {
                            position: "bottom",
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        stroke: {
                            width: 0,
                        },
                        colors: ["#0ebb13", "#3e3e42"],
                    };
                    var chart = new ApexCharts(document.querySelector("#graphAssurer"), options);
                    chart.render();

                    
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des données:', error);
                });
        }

        function Name_atient() {
            $.ajax({
                url: '/api/name_patient',
                method: 'GET',
                success: function(response) {
                    // Récupérer les données de l'API
                    const data = response.name;

                    // Élément de l'input et autres éléments HTML
                    const input = document.getElementById('nameRech');
                    const suggestionsDiv = document.getElementById('suggestions');

                    function displaySuggestions() {
                        const searchTerm = input.value.toLowerCase();
                        
                        suggestionsDiv.style.display = 'block';
                        suggestionsDiv.innerHTML = '';

                        const filteredData = data.filter(item => item.np.toLowerCase().includes(searchTerm));

                        filteredData.forEach(item => {
                            const suggestion = document.createElement('div');
                            suggestion.innerText = item.np;
                            suggestion.addEventListener('click', function() {

                                input.value = `${item.np}`;
                                suggestionsDiv.innerHTML = '';
                                suggestionsDiv.style.display = 'none';

                                addGroup(item);

                            });
                            suggestionsDiv.appendChild(suggestion);
                        });

                        suggestionsDiv.style.display = filteredData.length > 0 ? 'block' : 'none';
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
                    console.error('Erreur lors du chargement des patients');
                }
            });
        }

        function addGroup(data) {

            const item = data;

            const dynamicFields = document.getElementById("div_info_patient");
            dynamicFields.innerHTML = "";

            //--------------------------------------------------------------

            var charge = `
                <div class="d-flex justify-content-center align-items-center" id="laoder_stat">
                    <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                    <strong>Chargement des données...</strong>
                </div>
            `;
            dynamicFields.innerHTML = charge;

            const url = `/api/patient_stat/${item.id}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {

                    var loader = document.getElementById('laoder_stat');
                    if (loader) loader.remove();

                    //--------------------------------------------------

                    const nbre_cons = data.nbre_cons;
                    const nbre_hos = data.nbre_hos;
                    const nbre_exam = data.nbre_exam;
                    const nbre_soinsam = data.nbre_soinsam;
                    const stats = data.data;
                    const payer = data.fac_patient_payer;
                    const impayer = data.fac_patient_impayer;
                    const total = data.fac_patient_total;

                    //--------------------------------------------------

                    var groupe = document.createElement("div");
                    groupe.className = "row gx-3";
                    groupe.innerHTML = `
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="email">N° Dossier</label>
                                <input value="${item.matricule ? 'P-'+item.matricule : `Néant` }" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input value="${item.email ? item.email : `Néant` }" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="tel">Contact 1</label>
                                <input value="+225 ${item.tel}" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="email">Contact 2</label>
                                <input value="${item.tel2 ? `+225 `+item.tel2 : `Néant` }" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="email">Adresse</label>
                                <input value="${item.adresse ? item.adresse : `Néant` }" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Assurer</label>
                                <input value="${item.assurer}" readonly class="form-control">
                            </div>
                        </div>
                    `;

                    if (item.assurer === 'oui') {
                        groupe.innerHTML += `
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="adresse">Assurance</label>
                                    <input value="${item.assurance}" readonly class="form-control" placeholder="Néant">
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Taux</label>
                                    <div class="input-group">      
                                        <input id="patient_taux" value="${item.taux}" readonly class="form-control" placeholder="Néant">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="adresse">Société</label>
                                    <input value="${item.societe}" readonly class="form-control" placeholder="Néant">
                                </div>
                            </div>
                        `;
                    }

                    groupe.innerHTML += `
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="adresse">Date de création</label>
                                <input value="${formatDateHeure(item.created_at)}" readonly class="form-control" placeholder="Néant">
                            </div>
                        </div>
                    `;

                    dynamicFields.appendChild(groupe);

                    //--------------------------------------------------

                    var groupe1 = document.createElement("div");
                    groupe1.className = "row gx-3";
                    groupe1.innerHTML = `
                        <div class=" mb-0">
                            <div class="card-body">
                                <div class="card-header d-flex flex-column justify-content-center align-items-center">
                                    <h5 class="card-title mb-3">
                                        Statistique des actes éffectués
                                    </h5>
                                </div>
                                <div class="row gx-3 d-flex align-items-center justify-content-center">
                                    <div class="mb-3 w-25">
                                        <div class="border rounded-2 d-flex align-items-center justify-content-center flex-row p-2">
                                            <div class="text-center">
                                                <div class="d-flex align-items-center">
                                                    <h4 class="m-0 fw-bold text-primary">
                                                        ${formatPriceT(total)} Fcfa
                                                    </h4>
                                                </div>
                                                <small>Montant Total</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 w-25">
                                        <div class="border rounded-2 d-flex align-items-center justify-content-center flex-row p-2">
                                            <div class="text-center">
                                                <div class="d-flex align-items-center">
                                                    <h4 class="m-0 fw-bold text-success">
                                                        ${formatPriceT(payer)} Fcfa
                                                    </h4>
                                                </div>
                                                <small>Montant Payer</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 w-25">
                                        <div class="border rounded-2 d-flex align-items-center justify-content-center flex-row p-2">
                                            <div class="text-center">
                                                <div class="d-flex align-items-center">
                                                    <h4 class="m-0 fw-bold text-danger">
                                                        ${formatPriceT(impayer)} Fcfa
                                                    </h4>
                                                </div>
                                                <small>Montant Impayer</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    dynamicFields.appendChild(groupe1);

                    //--------------------------------------------------

                    var groupe01 = document.createElement("div");
                    groupe01.className = "row gx-3 stat_acte";
                    dynamicFields.appendChild(groupe01);

                    groupe01.innerHTML = '';
                    const cardData_acte = [
                        { label: "Consultations", count: nbre_cons, icon: "ri-lungs-line", colorClass: "text-success", borderColor: "border-success", bgColor: "bg-success", mTotal : formatPrice(stats.m_cons.total_general), pTotal : formatPrice(stats.m_cons.total_payer), ipTotal : formatPrice(stats.m_cons.total_impayer), assurance : formatPrice(stats.m_cons.part_assurance), patient : formatPrice(stats.m_cons.part_patient)},
                        { label: "Examens", count: nbre_exam, icon: "ri-medicine-bottle-line", colorClass: "text-danger", borderColor: "border-danger", bgColor: "bg-danger", mTotal : formatPrice(stats.m_exam.total_general), pTotal : formatPrice(stats.m_exam.total_payer), ipTotal : formatPrice(stats.m_exam.total_impayer), assurance : formatPrice(stats.m_exam.part_assurance), patient : formatPrice(stats.m_exam.part_patient)},
                        { label: "Hospitalisations", count: nbre_hos, icon: "ri-hotel-bed-line", colorClass: "text-primary", borderColor: "border-primary", bgColor: "bg-primary", mTotal : formatPrice(stats.m_hos.total_general), pTotal : formatPrice(stats.m_hos.total_payer), ipTotal : formatPrice(stats.m_hos.total_impayer), assurance : formatPrice(stats.m_hos.part_assurance), patient : formatPrice(stats.m_hos.part_patient)},
                        { label: "Soins Ambulatoires", count: nbre_soinsam, icon: "ri-dossier-line", colorClass: "text-warning", borderColor: "border-warning", bgColor: "bg-warning", mTotal : formatPrice(stats.m_soinsam.total_general), pTotal : formatPrice(stats.m_soinsam.total_payer), ipTotal : formatPrice(stats.m_soinsam.total_impayer), assurance : formatPrice(stats.m_soinsam.part_assurance), patient : formatPrice(stats.m_soinsam.part_patient)},
                    ];

                    cardData_acte.forEach(card => {
                        const div = document.createElement('div');
                        div.className = "col-xl-3 col-sm-6 col-12";
                        div.innerHTML = `
                            <div class="border rounded-2 d-flex align-items-center flex-row p-2 mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="p-2 ${card.borderColor} rounded-circle me-3">
                                            <div class="icon-box md ${card.bgColor} rounded-5">
                                                <i class="${card.icon} fs-4 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h2 class="lh-1">${card.count}</h2>
                                            <p class="m-0">${card.label}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-1">
                                        <a class="${card.colorClass}" href="javascript:void(0);">
                                            <span>Montant Total</span>
                                            <i class="ri-arrow-right-line ${card.colorClass} ms-1"></i>
                                        </a>
                                        <div class="text-end">
                                            <p class="mb-0 ${card.colorClass}">${card.mTotal} Fcfa</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-1">
                                        <a class="${card.colorClass}" href="javascript:void(0);">
                                            <span>Montant Réglé</span>
                                            <i class="ri-arrow-right-line ${card.colorClass} ms-1"></i>
                                        </a>
                                        <div class="text-end">
                                            <p class="mb-0 ${card.colorClass}">${card.pTotal} Fcfa</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-1">
                                        <a class="${card.colorClass}" href="javascript:void(0);">
                                            <span>Montant Non-Réglé</span>
                                            <i class="ri-arrow-right-line ${card.colorClass} ms-1"></i>
                                        </a>
                                        <div class="text-end">
                                            <p class="mb-0 ${card.colorClass}">${card.ipTotal} Fcfa</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-1">
                                        <a class="${card.colorClass}" href="javascript:void(0);">
                                            <span>Part Assurance</span>
                                            <i class="ri-arrow-right-line ${card.colorClass} ms-1"></i>
                                        </a>
                                        <div class="text-end">
                                            <p class="mb-0 ${card.colorClass}">${card.assurance} Fcfa</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-1">
                                        <a class="${card.colorClass}" href="javascript:void(0);">
                                            <span>Part Patient</span>
                                            <i class="ri-arrow-right-line ${card.colorClass} ms-1"></i>
                                        </a>
                                        <div class="text-end">
                                            <p class="mb-0 ${card.colorClass}">${card.patient} Fcfa</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        groupe01.appendChild(div);
                    });

                    //--------------------------------------------------

                    var groupe2 = document.createElement("div");
                    groupe2.className = "row gx-3";
                    groupe2.innerHTML = `
                        <div class="col-sm-12">
                            <div class=" mb-3">
                                <div class="card-body">
                                    <div class="card-header d-flex justify-content-center m">
                                        <h5 class="card-title">
                                            Liste des actes éffectués
                                        </h5>
                                    </div>
                                    <div class="custom-tabs-container">
                                        <ul class="nav nav-tabs justify-content-center" id="customTab4" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="tab-one1" data-bs-toggle="tab" href="#one1" role="tab" aria-controls="one1" aria-selected="false" tabindex="-1">Consultations</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="tab-one2" data-bs-toggle="tab" href="#one2" role="tab" aria-controls="one2" aria-selected="false" tabindex="-1">Examens</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="tab-one3" data-bs-toggle="tab" href="#one3" role="tab" aria-controls="one3" aria-selected="true">Hospitalisations</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="tab-one4" data-bs-toggle="tab" href="#one4" role="tab" aria-controls="one4" aria-selected="true">Soins Ambulatoires</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="customTabContent">
                                            <div class="tab-pane fade active show" id="one1" role="tabpanel" aria-labelledby="tab-one1">
                                                <div class="card-body">
                                                    <div class="table-outer" id="div_TableC" style="display: none;">
                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-hover m-0 truncate" id="TableC">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">N°</th>
                                                                        <th scope="col">Code</th>
                                                                        <th scope="col">Médecin</th>
                                                                        <th scope="col">Spécialité</th>
                                                                        <th scope="col">Prix</th>
                                                                        <th scope="col">Date et Heure</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div id="message_TableC" style="display: none;">
                                                        <p class="text-center">
                                                            Aucune Consultation n'a été trouvée
                                                        </p>
                                                    </div>
                                                    <div id="div_Table_loaderC" style="display: none;">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                                            <strong>Chargement des données...</strong>
                                                        </div>
                                                    </div>
                                                    <div id="pagination-controlsC"></div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="one2" role="tabpanel" aria-labelledby="tab-one2">
                                                <div class="card-body">
                                                    <div class="table-outer" id="div_TableED" style="display: none;">
                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-hover m-0 truncate" id="TableED">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">N°</th>
                                                                        <th scope="col">Type d'examen</th>
                                                                        <th scope="col">Médecin</th>
                                                                        <th scope="col">Nombre d'examen</th>
                                                                        <th scope="col">Prélevement</th>
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
                                                    <div id="message_TableED" style="display: none;">
                                                        <p class="text-center" >
                                                            Aucun examen demandé pour le moment
                                                        </p>
                                                    </div>
                                                    <div id="div_Table_loaderED" style="display: none;">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                                            <strong>Chargement des données...</strong>
                                                        </div>
                                                    </div>
                                                    <div id="pagination-controlsED" ></div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="one3" role="tabpanel" aria-labelledby="tab-one3">
                                                <div class="card-body">
                                                    <div class="table-outer" id="div_Table_hos" style="display: none;">
                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-hover m-0 truncate" id="Table_hos">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">N°</th>
                                                                        <th scope="col">Type</th>
                                                                        <th scope="col">Nature</th>
                                                                        <th scope="col">Date entrer</th>
                                                                        <th scope="col">Date sorti</th>
                                                                        <th scope="col">Médecin</th>
                                                                        <th scope="col">Statut</th>
                                                                        <th scope="col">Montant Chambre</th>
                                                                        <th scope="col">Montant Soins</th>
                                                                        <th scope="col">Montant Total</th>
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
                                            <div class="tab-pane fade" id="one4" role="tabpanel" aria-labelledby="tab-one4">
                                                <div class="card-body">
                                                    <div class="table-outer" id="div_Tablesoinsam" style="display: none;">
                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-hover m-0 truncate" id="Tablesoinsam">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">N°</th>
                                                                        <th scope="col">Statut</th>
                                                                        <th scope="col">Type de Soins</th>
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
                                                    <div id="message_Tablesoinsam" style="display: none;">
                                                        <p class="text-center" >
                                                            Aucun Soins Ambulatoires pour le moment
                                                        </p>
                                                    </div>
                                                    <div id="div_Table_loadersoinsam" style="display: none;">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                                            <strong>Chargement des données...</strong>
                                                        </div>
                                                    </div>
                                                    <div id="pagination-controlssoinsam" ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    dynamicFields.appendChild(groupe2);

                    //--------------------------------------------------

                    list_cons_patient(item.id);
                    list_exam_patient(item.id);
                    list_hos_patient(item.id);
                    list_soinsam_patient(item.id);

                })
                .catch(error => {
                    console.error('Erreur lors du chargement des données:', error);
                });

        }

        function list_cons_patient(id,page = 1) {

            const tableBody = document.querySelector('#TableC tbody');
            const messageDiv = document.getElementById('message_TableC');
            const tableDiv = document.getElementById('div_TableC');
            const loaderDiv = document.getElementById('div_Table_loaderC');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const url = `/api/list_cons_patient/${id}?page=${page}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {

                    const allCons = data.consultation || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    tableBody.innerHTML = '';

                    if (allCons.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        allCons.forEach((item, index) => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                <td>C-${item.code}</td>
                                <td>${item.medecin}</td>  
                                <td>${item.type_motif}</td>
                                <td>${item.montant} Fcfa</td>
                                <td>${formatDateHeure(item.created_at)}</td>
                            `;
                            tableBody.appendChild(row);

                        });

                        updatePaginationControlsC(id,pagination);

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

        function updatePaginationControlsC(id,pagination) {
            const paginationDiv = document.getElementById('pagination-controlsC');
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
                    list_cons_patient(id,pagination.current_page - 1);
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
                    list_cons_patient(id,i);
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
                    list_cons_patient(id,totalPages);
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
                    list_cons_patient(id,pagination.current_page + 1);
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

        function list_exam_patient(id,page = 1) {

            const tableBody = document.querySelector('#TableED tbody');
            const messageDiv = document.getElementById('message_TableED');
            const tableDiv = document.getElementById('div_TableED');
            const loaderDiv = document.getElementById('div_Table_loaderED');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const url = `/api/list_examend_patient/${id}?page=${page}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const allExamens = data.examen || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    tableBody.innerHTML = '';

                    if (allExamens.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        allExamens.forEach((item, index) => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                <td>${item.acte}</td>
                                <td>Dr. ${item.medecin}</td>
                                <td>${item.nbre}</td>
                                <td>${item.prelevement} Fcfa</td>
                                <td>${item.montant} Fcfa</td>
                                <td>${formatDateHeure(item.created_at)}</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a class="btn btn-outline-warning btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Detailexam" id="detail-${item.id}">
                                            <i class="ri-archive-2-line"></i>
                                        </a>
                                    </div>
                                </td>
                            `;
                            tableBody.appendChild(row);

                            document.getElementById(`detail-${item.id}`).addEventListener('click',()=>
                                {
                                    const tableBodyP = document.querySelector('#Tableexam tbody');
                                    const messageDivP = document.getElementById('message_Tableexam');
                                    const tableDivP = document.getElementById('div_Tableexam');
                                    const loaderDivP = document.getElementById('div_Table_loaderexam');

                                    messageDivP.style.display = 'none';
                                    tableDivP.style.display = 'none';
                                    loaderDivP.style.display = 'block';

                                    fetch(`/api/list_facture_exam_d/${item.id}`) // API endpoint
                                        .then(response => response.json())
                                        .then(data => {

                                            const factureds = data.factured;
                                            const sumMontantEx = data.sumMontantEx;

                                            tableBodyP.innerHTML = '';

                                            if (factureds.length > 0) {

                                                loaderDivP.style.display = 'none';
                                                messageDivP.style.display = 'none';
                                                tableDivP.style.display = 'block';

                                                factureds.forEach((item, index) => {
                                                    const row = document.createElement('tr');
                                                    row.innerHTML = `
                                                        <td>
                                                            <h6>${item.nom_ex}</h6>
                                                        </td>
                                                        <td>
                                                            <h6>${item.cotation_ex}${item.valeur_ex}</h6>
                                                        </td>
                                                        <td>
                                                            <h6>${item.prix_ex} Fcfa</h6>
                                                        </td>
                                                        <td>
                                                            <h6>${item.accepte}</h6>
                                                        </td>
                                                        <td>
                                                            <h6>${item.montant_ex} Fcfa</h6>
                                                        </td>
                                                    `;
                                                    tableBodyP.appendChild(row);

                                                });

                                                const row2 = document.createElement('tr');
                                                row2.innerHTML = `
                                                    <td colspan="3">&nbsp;</td>
                                                    <td colspan="2" >
                                                        <h5 class="mt-4 text-success">
                                                            Total : ${formatPriceT(sumMontantEx)} Fcfa
                                                        </h5>
                                                    </td>
                                                `;
                                                tableBodyP.appendChild(row2);

                                                const row3 = document.createElement('tr');
                                                row3.innerHTML = `
                                                    <td colspan="5">
                                                        <h6 class="text-danger">NOTE</h6>
                                                        <p class="small m-0">
                                                            Le Montant Total des examens  ajouter au montant du prélevement.
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

                        updatePaginationControlsED(id,pagination);

                    } else {
                        tableDiv.style.display = 'none';
                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des données:', error);
                    loaderDiv.style.display = 'none';
                    tableDiv.style.display = 'none';
                    messageDiv.style.display = 'block';
                });
        }

        function updatePaginationControlsED(id,pagination)
        {
            const paginationDiv = document.getElementById('pagination-controlsED');
            paginationDiv.innerHTML = '';

            // Bootstrap pagination wrapper
            const paginationWrapper = document.createElement('ul');
            paginationWrapper.className = 'pagination justify-content-center';

            // Previous button
            if (pagination.current_page > 1) {
                const prevButton = document.createElement('li');
                prevButton.className = 'page-item';
                prevButton.innerHTML = `<a class="page-link" href="#">Precédent</a>`;
                prevButton.onclick = () => list_exam_patient(id,pagination.current_page - 1);
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
                pageItem.onclick = () => list_exam_patient(id,i);
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
                lastPageItem.onclick = () => list_exam_patient(id,totalPages);
                paginationWrapper.appendChild(lastPageItem);
            }

            // Next button
            if (pagination.current_page < pagination.last_page) {
                const nextButton = document.createElement('li');
                nextButton.className = 'page-item';
                nextButton.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                nextButton.onclick = () => list_exam_patient(id,pagination.current_page + 1);
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

        function list_hos_patient(id,page = 1) {

            const tableBody = document.querySelector('#Table_hos tbody');
            const messageDiv = document.getElementById('message_Table_hos');
            const tableDiv = document.getElementById('div_Table_hos'); // The message div
            const loaderDiv = document.getElementById('div_Table_loader_hos');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const url = `/api/list_hopital_patient/${id}?page=${page}`;
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

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        hopitals.forEach((item, index) => {
                            // Create a new row
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                <td>${item.type}</td>
                                <td>${item.nature}</td>
                                <td>${formatDate(item.date_debut)}</td>
                                <td>${formatDate(item.date_fin)}</td>
                                <td>${item.medecin}</td>
                                <td>
                                    ${item.statut === 'Hospitaliser' ? 
                                        `<span class="badge bg-danger">${item.statut}</span>` : 
                                        `<span class="badge bg-success">${item.statut}</span>`}
                                </td>
                                <td>${item.montant_chambre} Fcfa</td>
                                <td>${item.montant_soins} Fcfa</td>
                                <td>${item.montant} Fcfa</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a class="btn btn-outline-danger btn-sm" id="detail_produit-${item.id}" data-bs-toggle="modal" data-bs-target="#Detail_produithos">
                                            <i class="ri-archive-2-fill"></i>
                                        </a>
                                        <a class="btn btn-outline-warning btn-sm" id="detailhos-${item.id}" data-bs-toggle="modal" data-bs-target="#Detailhos">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </td>
                                
                            `;
                            // Append the row to the table body
                            tableBody.appendChild(row);

                            document.getElementById(`detailhos-${item.id}`).addEventListener('click', () =>
                            {
                                fetch(`/api/detail_hos/${item.id}`) // API endpoint
                                    .then(response => response.json())
                                    .then(data => {
                                        // Access the 'chambre' array from the API response
                                        const modal = document.getElementById('modal_detailhos');
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
                                                                    ${hopital.num_bon != null ? `
                                                                        <h6 class="fw-semibold">Numéro de prise en charge :</h6>
                                                                        <p>${hopital.num_bon}</p>
                                                                    ` : ''}
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

                            document.getElementById(`detail_produit-${item.id}`).addEventListener('click',()=>
                                {
                                    const tableBodyP = document.querySelector('#Tablehos tbody');
                                    const messageDivP = document.getElementById('message_Tablehos');
                                    const tableDivP = document.getElementById('div_Tablehos');
                                    const loaderDivP = document.getElementById('div_Table_loaderhos');

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

                        updatePaginationControlshos(id,pagination);

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

        function updatePaginationControlshos(id,pagination) {
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
                    list_hos_patient(id,pagination.current_page - 1);
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
                    list_hos_patient(id,i);
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
                    list_hos_patient(id,totalPages);
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
                    list_hos_patient(id,pagination.current_page + 1);
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

        function list_soinsam_patient(id,page = 1) {

            const tableBody = document.querySelector('#Tablesoinsam tbody');
            const messageDiv = document.getElementById('message_Tablesoinsam');
            const tableDiv = document.getElementById('div_Tablesoinsam');
            const loaderDiv = document.getElementById('div_Table_loadersoinsam');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const url = `/api/list_soinsam_patient/${id}?page=${page}`;
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
                                <td>${item.nbre_soins}</td>
                                <td>${item.nbre_produit}</td>
                                <td>${item.montant} Fcfa</td>
                                <td>${formatDateHeure(item.created_at)}</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a class="btn btn-outline-danger btn-sm" id="detail_produit-${item.id}" data-bs-toggle="modal" data-bs-target="#Detail_produitsoinsam">
                                            <i class="ri-archive-2-fill"></i>
                                        </a>
                                        <a class="btn btn-outline-warning btn-sm" id="detail-${item.id}" data-bs-toggle="modal" data-bs-target="#Detailsoinsam">
                                            <i class="ri-eye-line"></i>
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
                                        const message_detail =document.getElementById('message_detailsoinsamd');
                                        const modal_detail = document.getElementById('modal_detailsoinsamd');
                                        const div_detail_loader=document.getElementById('div_detail_loadersoinsamd');

                                        message_detail.style.display = 'none';
                                        modal_detail.style.display = 'none';
                                        div_detail_loader.style.display = 'block';

                                        // Access the 'chambre' array from the API response
                                        const modal = document.getElementById('modal_detailsoinsamd');
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

                            document.getElementById(`detail_produit-${item.id}`).addEventListener('click', () => 
                            {
                                const tableBodyP = document.querySelector('#Tablesoinsamp tbody'); // Pour les soins infirmiers
                                const tableBodyProdP = document.querySelector('#TableProdsoinsamp tbody'); // Pour les produits
                                const messageDivP = document.getElementById('message_Tablesoinsamp');
                                const tableDivP = document.getElementById('div_Tablesoinsamp');
                                const tableDivProdP = document.getElementById('div_TableProdsoinsamp'); // Div pour les produits
                                const loaderDivP = document.getElementById('div_Table_loadersoinsamp');

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

                        updatePaginationControlssoinsam(id,pagination);

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

        function updatePaginationControlssoinsam(id,pagination) {
            const paginationDiv = document.getElementById('pagination-controlssoinsam');
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
                    list_soinsam_patient(id,pagination.current_page - 1);
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
                    list_soinsam_patient(id,i);
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
                    list_soinsam_patient(id,totalPages);
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
                    list_soinsam_patient(id,pagination.current_page + 1);
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

    });
</script>

@endsection
