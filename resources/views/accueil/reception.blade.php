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
            Tableau de bord
        </li>
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <!-- Row starts -->
    <div class="row gx-3 ">
        <div class="col-12 ">
            <div class="mb-3" >
                <div class="card-header ">
                    <h3 class="card-title text-center">
                        Statistique
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-3">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                            <i class="ri-walk-line fs-4 lh-1"></i>
                        </div>
                        <h6>Total Patient</h6>
                        <h5 class="text-primary m-0">0</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-success mb-3">
                            <i class="ri-walk-line fs-4 lh-1"></i>
                        </div>
                        <h6>Patient Assurer</h6>
                        <h5 class="text-primary m-0">0</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-danger mb-3">
                            <i class="ri-walk-line fs-4 lh-1"></i>
                        </div>
                        <h6>Patient non-assurer</h6>
                        <h5 class="text-primary m-0">0</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-warning mb-3">
                            <i class="ri-cash-line fs-4 lh-1"></i>
                        </div>
                        <h6>Total Consultation</h6>
                        <h5 class="text-primary m-0">0 Fcfa</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row ends -->

    <div class="row gx-3" >
        <div class="col-sm-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Consultation</h5>
                </div>
                <div class="p-2" id="div_alert" >
                    
                </div>
                <div class="card-body" style="margin-top: -40px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center" id="customTab4" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab" aria-controls="oneAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Nouvelle consultation
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Nouveau patient
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " id="tab-threeAAA" data-bs-toggle="tab" href="#threeAAA" role="tab" aria-controls="threeAAA" aria-selected="true">
                                    <i class="ri-shake-hands-line me-2"></i>
                                    Nouvelle societe
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " id="tab-frewAAA" data-bs-toggle="tab" href="#frewAAA" role="tab" aria-controls="frewAAA" aria-selected="true">
                                    <i class="ri-shake-hands-line me-2"></i>
                                    Nouvelle Assurance
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane fade active show" id="oneAAA" role="tabpanel" aria-labelledby="tab-oneAAA">
                                <div class="card-header">
                                    <h5 class="card-title text-center">Formulaire Nouvelle consultation</h5>
                                </div>
                                <div class="row gx-3">
                                    <div class="row gx-3 justify-content-center align-items-center" >
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Numéro du dossier</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">P-</span>
                                                    <input type="text" class="form-control" id="matricule_patient" placeholder="Saisie Obligatoire" maxlength="6">
                                                    <button id="btn_rech_num_dossier" class="btn btn-outline-success">
                                                        <i class="ri-search-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" id="div_info_patient">
                                    </div>
                                    <div class="col-sm-12" id="div_info_consul" style="display: none;">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">Information consultation</h5>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Période de consultation</label>
                                                    <div class="m-0">
                                                        <div class="form-check form-check-inline">
                                                            <input checked class="form-check-input" type="radio" id="jourO" name="periode_consul" value="ouvrable">
                                                            <label class="form-check-label" for="jourO">Jour Ouvrable</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="Nuit" name="periode_consul" value="nuit">
                                                            <label class="form-check-label" for="Nuit">Nuit</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="jourF" name="periode_consul" value="ferier">
                                                            <label class="form-check-label" for="jourF">Jour Ferié</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Motif</label>
                                                    <select class="form-select" id="acte_id">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_typeacteS" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label">Spécialité</label>
                                                    <select class="form-select" id="typeacte_idS">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_medecin" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label">Medecin</label>
                                                    <select class="form-select" id="medecin_id">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-header text-center">
                                                <h5 class="card-title">Information Caisse</h5>
                                            </div>
                                            <div class="row gx-3">
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Part Assurance</span>
                                                            <input readonly type="tel" class="form-control" id="montant_assurance">
                                                            <span class="input-group-text">Fcfa</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Part Patient</span>
                                                            <input readonly type="tel" class="form-control" id="montant_patient">
                                                            <span class="input-group-text">Fcfa</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Remise</span>
                                                            <input type="tel" class="form-control" id="taux_remise" maxlength="3">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Montant Total</span>
                                                            <input readonly type="tel" class="form-control" id="montant_total">
                                                            <span class="input-group-text">Fcfa</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>      
                                            <div class="col-sm-12">
                                                <div class="d-flex gap-2 justify-content-start">
                                                    <a href="javascript:location.reload();" class="btn btn-outline-danger">
                                                        Rémise à zéro
                                                    </a>
                                                    <button id="btn_eng_consultation" class="btn btn-success">
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
                                    <h5 class="card-title">Formulaire Nouveau Patient</h5>
                                </div>
                                <div class="row gx-3">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nom et Prénoms</label>
                                            <input type="text" class="form-control" id="patient_np_new" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
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
                                            <input type="text" class="form-control" id="patient_adresse_new" placeholder="Saisie Obligatoire">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Assurer</label>
                                            <div class="m-0">
                                                <div class="form-check form-check-inline">
                                                    <input checked class="form-check-input" type="radio" id="assurerO" name="patient_statut_assurer" value="non">
                                                    <label class="form-check-label" for="assurerO">Non</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="assurerN" name="patient_statut_assurer" value="oui">
                                                    <label class="form-check-label" for="assurerN">Oui</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gx-3" id="div_assurer" style="display: none;" >
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Assurance</label>
                                                <select class="form-select" id="patient_assurance_id_new">
                                                </select>
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
                                    <div class="col-sm-12">
                                        <div class="d-flex gap-2 justify-content-start">
                                            <button id="btn_eng_patient" class="btn btn-success">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="threeAAA" role="tabpanel" aria-labelledby="tab-threeAAA">
                                <div class="card-header">
                                    <h5 class="card-title">Formulaire Nouvelle Scoiété</h5>
                                </div>
                                <div class="row gx-3 justify-content-center align-items-center">
                                    <div class="col-xxl-6 col-lg-8 col-sm-10">
                                        <div class="mb-3">
                                            <label class="form-label">Nom de la société</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="societe_new" placeholder="Saisie Obligatoire">
                                                <button id="btn_eng_societe" class="btn btn-outline-success">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="frewAAA" role="tabpanel" aria-labelledby="tab-frewAAA">
                                <div class="card-header">
                                    <h5 class="card-title">Formulaire Nouvelle Assurance</h5>
                                </div>
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
                                            <input type="tel" class="form-control" id="tel2_assurance_new" placeholder="facultatif" maxlength="10">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gx-3" >
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Consultation enregistrées Aujourd'hui</h5>
                </div>
                <div class="card-body">
                    <div class="table-outer">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover m-0 truncate">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Motif</th>
                                        <th scope="col">Détail</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- <script src="{{asset('assets/js/app/js/reception/assurer_info.js')}}" ></script> --}}
{{-- <script src="{{asset('assets/js/app/js/reception/rech_dossier.js')}}" ></script> --}}

{{-- <script src="{{asset('assets/js/app/js/reception/select_taux_patient_new.js')}}" ></script> --}}
{{-- <script src="{{asset('assets/js/app/js/reception/select_societe_patient_new.js')}}" ></script> --}}
{{-- <script src="{{asset('assets/js/app/js/reception/select_assurance_patient_new.js')}}" ></script> --}}

{{-- <script src="{{asset('assets/js/app/js/reception/eng_societe.js')}}" ></script> --}}
{{-- <script src="{{asset('assets/js/app/js/reception/eng_assurance.js')}}" ></script> --}}
{{-- <script src="{{asset('assets/js/app/js/reception/eng_patient.js')}}" ></script> --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {

        divAssurerChange();
        select_taux();
        select_societe_patient();
        select_assurance_patient();
        select_list_acte();

        // ------------------------------------------------------------------

        var inputs = ['tel_assurance_new', 'tel2_assurance_new', 'patient_tel_new', 'patient_tel2_new', 'taux_remise', 'montant_assurance', 'montant_patient']; // Array of element IDs
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

        // ------------------------------------------------------------------

        document.getElementById("assurerO").addEventListener("change", divAssurerChange);
        document.getElementById("assurerN").addEventListener("change", divAssurerChange);

        function divAssurerChange() {
            // Vérifier quelle option est sélectionnée
            const assurerO = document.getElementById("assurerO");
            const assurerN = document.getElementById("assurerN");
            const divAssurer = document.getElementById("div_assurer");

            if (assurerN.checked) {
                // Si "Oui" est sélectionné, afficher le div
                divAssurer.style.display = "flex";
            } else {
                // Si "Non" est sélectionné, masquer le div
                divAssurer.style.display = "none";
            }
        }

        // ------------------------------------------------------------------

        document.getElementById("btn_rech_num_dossier").addEventListener("click", rech_dosier);

        function rech_dosier()
        {
            document.getElementById('div_typeacteS').style.display = 'none';
            document.getElementById('div_medecin').style.display = 'none';
            document.getElementById('acte_id').value = '';

            document.getElementById('montant_assurance').value = '';
            document.getElementById('taux_remise').value = '';
            document.getElementById('montant_total').value = '';
            document.getElementById('montant_patient').value = '';

            const matricule_patient = document.getElementById("matricule_patient");

            if(!matricule_patient.value.trim()){
                showAlert('warning', 'Veuillez saisie le numéro de dossier du patient.');
                return false;
            }

            // Créer l'élément de préchargement
            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;

            // Ajouter le préchargeur au body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/rech_patient',
                method: 'GET',  // Use 'POST' for data creation
                data: { matricule: matricule_patient.value },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    if(response.existep) {

                        showAlert('warning', 'Ce patient n\'existe pas.');
                        Reset();
                    } else if (response.success) {
                        showAlert('success', 'Patient trouvé.');
                        addGroup(response.patient);
                        document.getElementById("div_info_consul").style.display = 'block';
                    }
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('danger', 'Une erreur est survenue lors de la recherche.');
                    societeInput.value = '';
                }
            });
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
                        <label class="form-label" for="email">Email</label>
                        <input value="${data.email}" readonly class="form-control" placeholder="Néant">
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
                        <label class="form-label" for="tel2">Contact 2</label>
                        <input value="+225 ${data.tel2}" readonly class="form-control" placeholder="Néant">
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
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Assurance</label>
                            <input value="Aucun" readonly class="form-control" placeholder="Néant">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Taux</label>
                            <div class="input-group">      
                                <input id="patient_taux" value="0" readonly class="form-control" placeholder="Néant">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Société</label>
                            <input value="Aucun" readonly class="form-control" placeholder="Néant">
                        </div>
                    </div>
                `;
            }

            dynamicFields.appendChild(groupe);
        }


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

        function Reset() {

            var dynamicFields = document.getElementById("div_info_patient");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            document.getElementById("div_info_consul").style.display = 'none';
            document.getElementById("matricule_patient").value='';
        }

        // ------------------------------------------------------------------

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

        function select_list_medecin()
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

        function select_list_acte() {
            const selectElement = document.getElementById('acte_id');

            // Clear existing options
            selectElement.innerHTML = '';

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner';
            selectElement.appendChild(defaultOption);

            $.ajax({
                url: '/api/list_acte',
                method: 'GET',
                success: function(response) {
                    data = response.acte;
                    data.forEach(acte => {
                        const option = document.createElement('option');
                        option.value = acte.id; // Ensure 'id' is the correct key
                        option.textContent = acte.nom; // Ensure 'nom' is the correct key
                        selectElement.appendChild(option);
                    });
                },
                error: function() {
                    // showAlert('danger', 'Impossible de generer le code automatiquement');
                }
            });
        }

        document.getElementById("acte_id").addEventListener("change", select_list_typeacte);

        function select_list_typeacte() {
            const divTypeActe = document.getElementById('div_typeacteS'); // The whole div
            const divMedecin = document.getElementById('div_medecin');
            const typeActeSelect = document.getElementById('typeacte_idS');
            const acteId = document.getElementById("acte_id").value;

            const montant_assurance = document.getElementById('montant_assurance');
            const taux_remise = document.getElementById('taux_remise');
            const montant_total = document.getElementById('montant_total');
            const montant_patient = document.getElementById('montant_patient');

            montant_assurance.value = '';
            taux_remise.value = '';
            montant_total.value = '';
            montant_patient.value = '';

            const patient_taux = document.getElementById('patient_taux');

            // Reset the select and hide the div initially
            typeActeSelect.innerHTML = '';
            divTypeActe.style.display = 'none';  // Hide div initially
            divMedecin.style.display = 'none'; 

            // Create a default option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner';
            typeActeSelect.appendChild(defaultOption);

            // Validate if acteId is valid before making the AJAX request
             if (acteId) {
                $.ajax({
                    url: '/api/select_typeacte/' + acteId,
                    method: 'GET',
                    success: function(response) {
                        const data = response.typeacte; // Adjust this path based on your actual API response
                        if (data && data.length > 0) {

                            // Populate the select with the response data
                            data.forEach(typeacte => {
                                const option = document.createElement('option');
                                option.value = typeacte.id; // Ensure 'id' is the correct key
                                option.textContent = typeacte.nom;
                                option.setAttribute('data-prix', typeacte.prix); // Ensure 'nom' is the correct key
                                typeActeSelect.appendChild(option);
                            });

                            divTypeActe.style.display = 'block';
                            divMedecin.style.display = 'block';

                            // Call the select_list_medecin() function to load the list of doctors
                            select_list_medecin();

                        } else {
                            // If no data, append a "No data available" option and hide the div
                            const noDataOption = document.createElement('option');
                            noDataOption.value = '';
                            noDataOption.textContent = 'Aucun données disponible';
                            typeActeSelect.appendChild(noDataOption);
                            divTypeActe.style.display = 'none';
                        }
                    },
                    error: function() {
                        console.error('Erreur lors du chargement des types d\'actes');
                        // Handle error case
                    }
                });

                typeActeSelect.addEventListener('change', function() {
                    const selectedOption = typeActeSelect.options[typeActeSelect.selectedIndex];
                    const prix = selectedOption.getAttribute('data-prix');

                    if (prix) {

                        calculateAndFormatAmounts(prix,patient_taux.value);

                    } else {
                        montant_total.value = '';
                        montant_assurance.value = '';
                        montant_patient.value = '';// Clear the field if no valid price
                    }

                });
            }
        }

        function calculateAndFormatAmounts(prix, patient_taux) {
            if (prix) {
                // Remove all dots and commas from price and convert to number
                let prixFloat = parseFloat(prix.replace(/[.,]/g, ''));
                if (isNaN(prixFloat)) {
                    console.error('Invalid price value');
                    montant_total.value = ''; // Clear the field if the price is invalid
                    return;
                }

                // Assign the total price
                montant_total.value = formatPrice(prix);

                // Ensure patient_taux is a valid number
                let tauxFloat = parseFloat(patient_taux);
                if (isNaN(tauxFloat)) {
                    tauxFloat = 0; // Set to 0 if patient_taux is not a number
                }

                if (tauxFloat === 0) {
                    montant_assurance.value = '0'; // No insurance coverage
                    montant_patient.value = formatPrice(prixFloat.toString()); // Patient pays full amount
                } else {
                    // Calculate insurance amount and patient's amount
                    let montantAssurance = (tauxFloat / 100) * prixFloat;
                    let montantPatient = prixFloat - montantAssurance;

                    // Format the results and assign them
                    montant_assurance.value = formatPrice(montantAssurance.toString());
                    montant_patient.value = formatPrice(montantPatient.toString());
                }
            } else {
                montant_total.value = ''; // Clear the field if no valid price
            }
        }

        // ------------------------------------------------------------------

        document.getElementById("btn_eng_societe").addEventListener("click", eng_societe);

        function eng_societe()
        {
            const societeInput = document.getElementById("societe_new");

            var dynamicFields = document.getElementById("div_alert");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            if(societeInput.value == ''){
                showAlert('warning', 'Veuillez saisie le nom de la société SVP.');
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
                url: '/api/societe_new',
                method: 'GET',  // Use 'POST' for data creation
                data: { societe: societeInput.value },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    if (response.warning) {
                        showAlert('warning', 'Cette société existe déjà.');
                    } else if (response.success) {
                        showAlert('success', 'Société Enregistrée.');
                    } else if (response.error) {
                        showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                    }
                    societeInput.value = '';
                    select_societe_patient();
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                    societeInput.value = '';
                }
            });
        }

        // ------------------------------------------------------------------

        document.getElementById("btn_eng_assurance").addEventListener("click", eng_assurance);

        function eng_assurance()
        {
            var nom = document.getElementById("nom_assurance_new");
            var email = document.getElementById("email_assurance_new");
            var phone = document.getElementById("tel_assurance_new");
            var phone2 = document.getElementById("tel2_assurance_new");
            var adresse = document.getElementById("adresse_assurance_new");
            var fax = document.getElementById("fax_assurance_new");

            if (!nom.value.trim() || !email.value.trim() || !phone.value.trim() || !adresse.value.trim() || !fax.value.trim()) {
                showAlert('warning', 'Tous les champs sont obligatoires.');
                return false; 
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) {  // Use email.value.trim() to check the actual input
                showAlert('warning', 'Email incorrect.');
                return false;
            }


            if (phone.value.length !== 10 || (phone2.value !== '' && phone2.value.length !== 10)) {
                showAlert('warning', 'Contact incomplet.');
                return false;
            }


            var dynamicFields = document.getElementById("div_alert");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
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
                method: 'GET',  // Use 'POST' for data creation
                data: { nom: nom.value, email: email.value, tel: phone.value, tel2: phone2.value || null, fax: fax.value, adresse: adresse.value},
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.tel_existe) {
                        showAlert('warning', 'Ce numéro de téléphone appartient déjà a une assurance.');
                    }else if (response.email_existe) {
                        showAlert('warning', 'Ce email appartient déjà a une assurance.');
                    }else if (response.nom_existe) {
                        showAlert('warning', 'Cette assurance existe déjà.');
                    }else if (response.fax_existe) {
                        showAlert('warning', 'Ce fax appartient déjà a une assurance.');
                    } else if (response.success) {
                        showAlert('success', 'Assurance Enregistrée.');
                    } else if (response.error) {
                        showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                    }

                    nom.value = '';
                    email.value = '';
                    phone.value = '';
                    phone2.value = '';
                    fax.value = '';
                    adresse.value = '';

                    select_assurance_patient();
                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');

                    nom.value = '';
                    email.value = '';
                    phone.value = '';
                    phone2.value = '';
                    fax.value = '';
                    adresse.value = '';
                }
            });
        }

        // ------------------------------------------------------------------

        document.getElementById("btn_eng_patient").addEventListener("click", eng_patient);

        function eng_patient()
        {
            const divAssurer = document.getElementById("div_assurer");

            var nom = document.getElementById("patient_np_new");
            var email = document.getElementById("patient_email_new");
            var phone = document.getElementById("patient_tel_new");
            var phone2 = document.getElementById("patient_tel2_new");
            var adresse = document.getElementById("patient_adresse_new");
            var assurer = document.querySelector('input[name="patient_statut_assurer"]:checked');

            var assurerNon = document.getElementById('assurerN');
            var assurerOui = document.getElementById('assurerO');

            var assurance_id = document.getElementById("patient_assurance_id_new");
            var taux_id = document.getElementById("patient_taux_id_new");
            var societe_id = document.getElementById("patient_societe_id_new");

            if (!nom.value.trim() || !phone.value.trim() || !adresse.value.trim()) {
                showAlert('warning', 'Tous les champs sont obligatoires.');
                return false; 
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value.trim() && !emailRegex.test(email.value.trim())) {  // Use email.value.trim() to check the actual input
                showAlert('warning', 'Email incorrect.');
                return false;
            }

            if (phone.value.length !== 10 || (phone2.value !== '' && phone2.value.length !== 10)) {
                showAlert('warning', 'Contact incomplet.');
                return false;
            }

            if (assurer.value == 'oui') {
                if (assurance_id.value !== '' && taux_id.value !== '' && societe_id.value !== '') {
                    // Do something when all the fields have values
                } else {
                    showAlert('warning', 'Veuillez remplir tous les champs relatifs à l\'assurance, taux et société.');
                    return false; // Prevent form submission
                }
            }

            var dynamicFields = document.getElementById("div_alert");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
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
                data: { nom: nom.value, email: email.value || null , tel: phone.value, tel2: phone2.value || null,
                adresse: adresse.value, assurer: assurer.value, assurance_id: assurance_id.value || null,
                taux_id: taux_id.value || null, societe_id: societe_id.value || null,},
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.tel_existe) {
                        showAlert('warning', 'Ce numéro de téléphone appartient déjà a un patient.');
                    }else if (response.email_existe) {
                        showAlert('warning', 'Cet email appartient déjà a un patient.');
                    }else if (response.nom_existe) {
                        showAlert('warning', 'Cet patient existe déjà.');
                    } else if (response.success) {
                        showAlert('success', 'Patient Enregistrée.');
                    } else if (response.error) {
                        showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                    }

                    nom.value = '';
                    email.value = '';
                    phone.value = '';
                    phone2.value = '';
                    adresse.value = '';

                    assurerNon.checked = true;
                    assurerOui.checked = false;

                    divAssurer.style.display = "none";

                    // document.getElementById("matricule_patient").value = response.matricule;

                    var modalHtml = `
                        <div class="modal fade show" id="Matricule" tabindex="-1" aria-labelledby="exampleModalSmLabel" 
                        aria-modal="true" role="dialog" style="position: fixed;" data-bs-backdrop="static" 
                        data-bs-keyboard="false">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalSmLabel">
                                  Matricule du patient
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <p>P-${response.matricule}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                    `;

                    // Insert the modal into the DOM
                    document.body.insertAdjacentHTML('beforeend', modalHtml);

                    // Show the modal
                    var modal = new bootstrap.Modal(document.getElementById('Matricule'));
                    modal.show();

                    // Remove the modal from the DOM after it is closed
                    document.getElementById('Matricule').addEventListener('hidden.bs.modal', function () {
                        document.getElementById('Matricule').remove();
                    });

                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');

                    nom.value = '';
                    email.value = '';
                    phone.value = '';
                    phone2.value = '';
                    adresse.value = '';

                    assurerNon.checked = true;
                    assurerOui.checked = false;

                    divAssurer.style.display = "none";
                }
            });
        }

    });
</script>

@endsection
