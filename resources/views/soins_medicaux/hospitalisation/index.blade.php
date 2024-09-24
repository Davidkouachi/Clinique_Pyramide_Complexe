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
                                    <p class="m-0">Hospitaliés</p>
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
                                    Patient hospitalisé
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
                                                <input type="text" class="form-control" id="patient" placeholder="facultatif">
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
                                    <div class="col-sm-3 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Date d'entrée
                                            </label>
                                            <input type="date" class="form-control" placeholder="Selectionner une date" id="date_entrer" min="{{ date('Y-m-d')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Date de sortie probable
                                            </label>
                                            <input type="date" class="form-control" placeholder="Sélectionner une date" id="date_sortie" min="{{ date('Y-m-d')}}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Motif</label>
                                            <input type="email" class="form-control" id="motif" placeholder="facultatif">
                                        </div>
                                    </div>
                                    <div class="card-header text-center">
                                        <h5 class="card-title">Information Caisse</h5>
                                    </div>
                                    <div class="row gx-3">
                                        <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_taux" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label">Taux</label>
                                                <div class="input-group">
                                                    <input readonly type="tel" class="form-control" id="patient_taux" value="">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6" style="display: none;" id="div_assurance">
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
                                        <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_remise" style="display: block;">
                                            <div class="mb-3">
                                                <label class="form-label">Remise</label>
                                                <div class="input-group">
                                                    <input type="tel" class="form-control" id="taux_remise" value="0">
                                                    <span class="input-group-text">Fcfa</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_remise_appliq" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label">Application de la remise</label>
                                                <select class="form-select" id="appliq_remise">
                                                    <option selected value="patient">Patient</option>
                                                    <option value="assurance">Assurance</option>
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
                            <div class="tab-pane fade " id="oneAAA" role="tabpanel" aria-labelledby="tab-oneAAA">
                                <div class="card-header">
                                    <h5 class="card-title text-center">Patient hospitalisé</h5>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {

        Name_atient();
        select_medecin();
        select_chambre();
        select_typeadmission();
        list_lit();

        document.getElementById("id_chambre").addEventListener("change", select_lit);
        document.getElementById("id_typeadmission").addEventListener("change", select_natureadmission);
        document.getElementById("btn_refresh_table").addEventListener("click", list_lit);

        document.getElementById('taux_remise').addEventListener('input', function() {
            this.value = formatPrice(this.value);
            if (this.value !== ''){
                document.getElementById('div_remise_appliq').style.display = 'block';
            }else{
                document.getElementById('div_remise_appliq').style.display = 'none';
            }
        });

        function Name_atient()
        {
            $.ajax({
                url: '/api/name_patient',
                method: 'GET',
                success: function(response) {
                    // Sample data array
                    const data = response.name;

                    // Elements
                    const input = document.getElementById('patient');
                    const matricule_patient = document.getElementById('matricule_patient');
                    const suggestionsDiv = document.getElementById('suggestions_patient');

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
                                input.value = `${item.np}`;
                                matricule_patient.value = `${item.matricule}`;
                                suggestionsDiv.innerHTML = ''; // Clear suggestions
                                suggestionsDiv.style.display = 'none';

                                rech_dossier();

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
                }
            });
        }

        function rech_dossier()
        {
            const matricule_patient = document.getElementById("matricule_patient");

            if(!matricule_patient.value.trim()){
                showAlert('warning', 'Veuillez saisie le nom d\'un du patient.');
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

                    } else if (response.success) {
                        showAlert('success', 'Patient trouvé.');

                        const patient_taux = document.getElementById('patient_taux');
                        patient_taux.value = '';
                        patient_taux.value = response.patient.taux ? response.patient.taux : 0;

                        if (patient_taux.value > 0) {
                            document.getElementById('div_taux').style.display = 'block';
                            document.getElementById('div_assurance').style.display = 'block';
                        }

                        const appliq_remise = document.getElementById('appliq_remise');

                        // Cacher l'option "Assurance" si le taux est égal à 0
                        if (patient_taux.value == 0) {
                            for (let i = 0; i < appliq_remise.options.length; i++) {
                                if (appliq_remise.options[i].value === 'assurance') {
                                    appliq_remise.options[i].style.display = 'none'; // Cacher l'option
                                }
                            }
                        } else {
                            // Afficher l'option "Assurance" si le taux est différent de 0
                            for (let i = 0; i < appliq_remise.options.length; i++) {
                                if (appliq_remise.options[i].value === 'assurance') {
                                    appliq_remise.options[i].style.display = 'block'; // Afficher l'option
                                }
                            }
                        }

                        let prix = document.getElementById('montant_total').value;

                        document.getElementById('div_remise_appliq').style.display = 'none';
                        document.getElementById('taux_remise').value = 0;

                        calculateAndFormatAmounts(prix, patient_taux.value);

                    }
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('danger', 'Une erreur est survenue lors de la recherche.');
                }
            });
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
                            option.textContent = item.code;
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

            const montant_assurance = document.getElementById('montant_assurance');
            const taux_remise = document.getElementById('taux_remise');
            const montant_total = document.getElementById('montant_total');
            const montant_patient = document.getElementById('montant_patient');

            const montant_patient_hidden = document.getElementById('montant_patient_hidden');
            const montant_assurance_hidden = document.getElementById('montant_assurance_hidden');

            montant_assurance.value = '';
            montant_total.value = '';
            montant_patient.value = '';

            const patient_taux = document.getElementById('patient_taux');

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
                                option.textContent = 'Lit-'+item.code+'-'+item.type;
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

                        calculateAndFormatAmounts(prix,patient_taux.value);

                    } else {
                        montant_total.value = '';
                        montant_assurance.value = '';
                        montant_patient.value = '';// Clear the field if no valid price
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
                    montant_patient.value = formatPrice(prixFloat.toString());
                    montant_patient_hidden.value = formatPrice(prixFloat.toString());
                    montant_assurance_hidden.value = '0';
                } else {
                    // Calculate insurance amount and patient's amount
                    let montantAssurance = (tauxFloat / 100) * prixFloat;
                    let montantPatient = prixFloat - montantAssurance;

                    // Format the results and assign them
                    montant_assurance.value = formatPrice(montantAssurance.toString());
                    montant_patient.value = formatPrice(montantPatient.toString());

                    montant_patient_hidden.value = formatPrice(montantPatient.toString());
                    montant_assurance_hidden.value = formatPrice(montantAssurance.toString());
                }

                getElementById('div_remise').style.display = 'block';

            } else {
                montant_total.value = '';
            }
        }

        document.getElementById('taux_remise').addEventListener('input', function() {
            // Nettoyer la valeur entrée en supprimant les caractères non numériques sauf le point
            const rawValue = this.value.replace(/[^0-9]/g, ''); // Supprimer tous les caractères non numériques
            // Ajouter des points pour les milliers
            const formattedValue = formatPrice(rawValue);
            
            // Mettre à jour la valeur du champ avec la valeur formatée
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

            // Nettoyer la valeur entrée en supprimant les caractères non numériques sauf le point
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


    });
</script>


@endsection
