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
            Liste des assurances
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
                        <h5>Assurances.</h5>
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
                                    Nouvelle Assurance
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-contacts-line me-2"></i>
                                    Liste des Assurances
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
                                    <h5 class="card-title">Formulaire Nouvelle Assurance</h5>
                                </div>
                                <div class="card-body" >
                                    <div class="row gx-3">
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="nom_assurance_new" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input required type="email" class="form-control" id="email_assurance_new" placeholder="Saisie Obligatoire">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Contact</label>
                                                <input type="tel" class="form-control" id="tel_assurance_new" placeholder="Saisie Obligatoire" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Contact 2</label>
                                                <input type="tel" class="form-control" id="tel2_assurance_new" placeholder="Facultatif" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" >Fax</label>
                                                <input type="text" class="form-control" id="fax_assurance_new" placeholder="Saisie Obligatoire">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Adresse</label>
                                                <input type="text" class="form-control" id="adresse_assurance_new" placeholder="Saisie Obligatoire">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="d-flex gap-2 justify-content-start">
                                                <button id="btn_eng_assurance" class="btn btn-success">
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
                                        Liste des Assurances
                                    </h5>
                                    <div class="d-flex">
                                        <input type="text" id="searchInputA" placeholder="Recherche" class="form-control me-1" oninput="this.value = this.value.toUpperCase()">
                                        <a id="btn_refresh_tableP" class="btn btn-outline-info ms-auto">
                                            <i class="ri-loop-left-line"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-outer" id="div_TableP" style="display: none;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-hover m-0 truncate" id="TableP">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">N°</th>
                                                        <th scope="col">Assurance</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Contact 1</th>
                                                        <th scope="col">Contact 2</th>
                                                        <th scope="col">Fax</th>
                                                        <th scope="col">Adresse</th>
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
                                            Aucune Assurance n'a été trouvé
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
                                                            <img src="{{asset('assets/images/assurance2.jpg')}}" class="img-7x rounded-circle border border-3">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 text-center">
                                                <label class="form-label">
                                                    Assurance
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-select" id="assurance_id">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-3" id="div_info_patient">
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

<div class="modal fade" id="Mmodif" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mise à jour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateChambreForm">
                    <input type="hidden" id="Id">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nomModif" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailModif" placeholder="Saisie Obligatoire">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact</label>
                        <input type="tel" class="form-control" id="telModif" placeholder="Saisie Obligatoire" maxlength="10">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact 2</label>
                        <input type="tel2" class="form-control" id="tel2Modif" placeholder="Facultatif" maxlength="10">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresseModif" placeholder="Saisie Obligatoire">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fax</label>
                        <input type="text" class="form-control" id="faxModif" placeholder="Saisie Obligatoire">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="updateBtn">Mettre à jour</button>
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

        select_assurance();
        list();

        document.getElementById("btn_eng_assurance").addEventListener("click", eng_assurance);
        document.getElementById("btn_refresh_tableP").addEventListener("click", list);
        document.getElementById("updateBtn").addEventListener("click", updatee);

        var inputs = ['tel_assurance_new', 'tel2_assurance_new',]; // Array of element IDs
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

        function showAlert(title, message, type) {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
            });
        }

        function select_assurance()
        {
            const selectElement = document.getElementById('assurance_id');
            // Clear existing options
            selectElement.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Selectionner';
            selectElement.appendChild(defaultOption);

            fetch('/api/assurance_select_patient_new')
                .then(response => response.json())
                .then(data => {
                    data.forEach(assurance => {
                        const option = document.createElement('option');
                        option.value = assurance.id;
                        option.textContent = assurance.nom;
                        selectElement.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des societes:', error));
        }

        function eng_assurance()
        {
            var nom = document.getElementById("nom_assurance_new");
            var email = document.getElementById("email_assurance_new");
            var phone = document.getElementById("tel_assurance_new");
            var phone2 = document.getElementById("tel2_assurance_new");
            var adresse = document.getElementById("adresse_assurance_new");
            var fax = document.getElementById("fax_assurance_new");

            if (!nom.value.trim() || !email.value.trim() || !phone.value.trim() || !adresse.value.trim() || !fax.value.trim()) {
                showAlert('Alert', 'Tous les champs sont obligatoires.','warning');
                return false; 
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) { 
                showAlert('Alert', 'Email incorrect.','warning');
                return false;
            }


            if (phone.value.length !== 10 || (phone2.value !== '' && phone2.value.length !== 10)) {
                showAlert('Alert', 'Contact incomplet.','warning');
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
                url: '/api/assurance_new',
                method: 'GET',
                data: { 
                    nom: nom.value, 
                    email: email.value, 
                    tel: phone.value, 
                    tel2: phone2.value || null, 
                    fax: fax.value, 
                    adresse: adresse.value
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.tel_existe) {
                        showAlert('Alert', 'Ce numéro de téléphone appartient déjà a une assurance.','warning');
                    }else if (response.email_existe) {
                        showAlert('Alert', 'Ce email appartient déjà a une assurance.','warning');
                    }else if (response.nom_existe) {
                        showAlert('Alert', 'Cette assurance existe déjà.','warning');
                    }else if (response.fax_existe) {
                        showAlert('Alert', 'Ce fax appartient déjà a une assurance.','warning');
                    } else if (response.success) {

                        nom.value = '';
                        email.value = '';
                        phone.value = '';
                        phone2.value = '';
                        fax.value = '';
                        adresse.value = '';

                        list();
                        select_assurance();

                        showAlert('Succès', 'Assurance Enregistrée.','success');
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

        function list(page = 1) {

            const tableBody = document.querySelector('#TableP tbody');
            const messageDiv = document.getElementById('message_TableP');
            const tableDiv = document.getElementById('div_TableP');
            const loaderDiv = document.getElementById('div_Table_loaderP');

            let allAssurances = [];

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const url = `/api/list_assurance_all?page=${page}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    allAssurances = data.assurance || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    tableBody.innerHTML = '';

                    if (allAssurances.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        function displayRows(filteredAssurances) {
                            tableBody.innerHTML = ''; 

                            filteredAssurances.forEach((item, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                    <td>${item.nom}</td>
                                    <td>${item.email}</td>
                                    <td>${item.tel ? '+225 '+item.tel : 'Néant'}</td>
                                    <td>${item.tel2 ? '+225 '+item.tel2 : 'Néant'}</td>
                                    <td>${item.fax}</td>
                                    <td>${item.adresse}</td>
                                    <td>${formatDateHeure(item.created_at)}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a class="btn btn-outline-info btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mmodif" id="edit-${item.id}">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            
                                        </div>
                                    </td>
                                `;
                                tableBody.appendChild(row);

                                document.getElementById(`edit-${item.id}`).addEventListener('click', () => 
                                {
                                    document.getElementById('Id').value = item.id;
                                    document.getElementById('nomModif').value = item.nom;
                                    document.getElementById('emailModif').value = item.email;
                                    document.getElementById('adresseModif').value = item.adresse;
                                    document.getElementById('telModif').value = item.tel;
                                    document.getElementById('tel2Modif').value = item.tel2;
                                    document.getElementById('faxModif').value = item.fax;
                                });

                            });
                        };

                        // Update table with filtered factures
                        function applySearchFilter() {
                            const searchTerm = searchInputA.value.toLowerCase();

                            // Filtrer les patients en vérifiant plusieurs champs
                            const filteredAssurances = allAssurances.filter(item =>
                                item.nom.toLowerCase().includes(searchTerm)
                            );

                            displayRows(filteredAssurances); // Afficher seulement les patients filtrés
                        }

                        searchInputA.addEventListener('input', applySearchFilter);

                        displayRows(allAssurances);

                        updatePaginationControlsP(pagination);

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
                prevButton.onclick = () => list(pagination.current_page - 1);
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
                pageItem.onclick = () => list(i);
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
                lastPageItem.onclick = () => list(totalPages);
                paginationWrapper.appendChild(lastPageItem);
            }

            // Next button
            if (pagination.current_page < pagination.last_page) {
                const nextButton = document.createElement('li');
                nextButton.className = 'page-item';
                nextButton.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                nextButton.onclick = () => list(pagination.current_page + 1);
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

        function updatee() {

            const id = document.getElementById('Id').value;
            const nom = document.getElementById('nomModif');
            const email = document.getElementById("emailModif");
            const adresse = document.getElementById("adresseModif");
            const fax = document.getElementById("faxModif");
            const tel = document.getElementById("telModif");
            const tel2 = document.getElementById("tel2Modif");

            if(!nom.value.trim() || !email.value.trim() || !adresse.value.trim() || !fax.value.trim() || !tel.value.trim())
            {
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.','warning');
                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) { 
                showAlert('Alert', 'Email incorrect.','warning');
                return false;
            }


            if (tel.value.length !== 10 || (tel2.value !== '' && tel2.value.length !== 10)) {
                showAlert('Alert', 'Contact incomplet.','warning');
                return false;
            }

            var modal = bootstrap.Modal.getInstance(document.getElementById('Mmodif'));
            modal.hide();

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/update_assurance/'+id,
                method: 'GET',
                data: { 
                    nom: nom.value,
                    email: email.value,
                    adresse: adresse.value,
                    fax: fax.value,
                    tel: tel.value,
                    tel2: tel2.value || null,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.tel_existe) {
                        showAlert('Alert', 'Ce numéro de téléphone appartient déjà a une assurance.','warning');
                    }else if (response.email_existe) {
                        showAlert('Alert', 'Ce email appartient déjà a une assurance.','warning');
                    }else if (response.nom_existe) {
                        showAlert('Alert', 'Cette assurance existe déjà.','warning');
                    }else if (response.fax_existe) {
                        showAlert('Alert', 'Ce fax appartient déjà a une assurance.','warning');
                    } else if (response.success) {
                        select_assurance();
                        list();
                        showAlert('Succès', 'Opérationn éffectué.','success');
                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue.','error');
                    }
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('Alert', 'Erreur lors de la mise à jour.','error');
                }
            });
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

        document.getElementById('assurance_id').addEventListener('change', function() {

            const dynamicFields = document.getElementById("div_info_patient");
            dynamicFields.innerHTML = "";

            if (this.value == ''){
                showAlert('Alert', 'Veuillez selectionner une assurance s\'il vous plaît.','warning');
                return false;
            }

            const assurance_id = this.value;

            //--------------------------------------------------------------

            var charge = `
                <div class="d-flex justify-content-center align-items-center" id="laoder_stat">
                    <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                    <strong>Chargement des données...</strong>
                </div>
            `;
            dynamicFields.innerHTML = charge;

            const url = `/api/assurance_stat/${assurance_id}`;

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


                })
                .catch(error => {
                    console.error('Erreur lors du chargement des données:', error);
                });
        });

    });
</script>

@endsection