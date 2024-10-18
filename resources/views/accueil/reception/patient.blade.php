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
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
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
                                    <option value="M">Homme</option>
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
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        Liste des Patients
                    </h5>
                    <div class="d-flex">
                        <input type="text" id="searchInputP" placeholder="Recherche" class="form-control me-1">
                        <select class="form-select me-1" id="statutP">
                            <option selected value="tous">Tous</option>
                            <option value="oui">Assurer</option>
                            <option value="non">Non Assurer</option>
                        </select>
                        <a id="btn_refresh_tableP" class="btn btn-outline-info ms-auto">
                            <i class="ri-loop-left-line"></i>
                        </a>
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

{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
{{-- <script src="https://unpkg.com/jspdf-invoice-template@1.4.4/dist/index.js"></script> --}}
<script src="{{asset('assets/js/app/js/jspdfinvoicetemplate/dist/index.js')}}" ></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        select_taux();
        select_societe_patient();
        select_assurance_patient();
        listP();

        document.getElementById("btn_eng_patient").addEventListener("click", eng_patient);
        document.getElementById("btn_refresh_tableP").addEventListener("click", listP);
        document.getElementById("statutP").addEventListener("change", listP);

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
                data: { nom: nom.value, email: email.value || null , tel: phone.value, tel2: phone2.value || null, adresse: adresse.value || null, assurer: assurer.value, assurance_id: assurance_id.value || null, taux_id: taux_id.value || null, societe_id: societe_id.value || null, datenais: datenais.value, sexe: sexe.value, filiation: filiation.value || null, matricule_assurance: matricule_assurance.value || null},
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
                        showAlert('Succès', 'Patient Enregistrée.','success');
                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.','error');
                    }

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

                    listP();

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

            let allPatients = [];

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const statut = document.getElementById('statutP').value;
            const url = `/api/list_patient_all/${statut}?page=${page}`;

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

    });
</script>

@endsection
