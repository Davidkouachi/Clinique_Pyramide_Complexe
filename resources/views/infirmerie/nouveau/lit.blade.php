@extends('app')

@section('titre', 'Nouvelle Assurance')

@section('info_page')
<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-bar-chart-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{route('index_accueil')}}">Espace Santé</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Nouveau Lit
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
                        <h5>Lits</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-3" >
        <div class="col-sm-12">
            <div class="card mb-3 mt-3">
                <div class="card-body" style="margin-top: -30px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center bg-primary bg-2" id="customTab4" role="tablist" style="background: rgba(0, 0, 0, 0.7);">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-white" id="tab-twoAAAN" data-bs-toggle="tab" href="#twoAAAN" role="tab" aria-controls="twoAAAN" aria-selected="false" tabindex="-1">
                                    <i class="ri-add-line me-2"></i>
                                    Nouveau Lit
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-archive-drawer-line me-2"></i>
                                    Liste des Lits
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane active show fade" id="twoAAAN" role="tabpanel" aria-labelledby="tab-twoAAAN">
                                <div class="card-header">
                                    <h5 class="card-title">Formulaire Nouveau Lit</h5>
                                </div>
                                <div class="card-body" >
                                    <!-- Row starts -->
                                    <div class="row gx-3">
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Numéro du lit
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Lit-</span>
                                                    <input type="text" class="form-control" id="num_lit" placeholder="Saisie Obligatoire" maxlength="6">
                                                    <a id="btn_search_num" class="btn btn-success">
                                                        <i class="ri-loop-left-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Type
                                                </label>
                                                <select class="form-select" id="type">
                                                    <option value="">Selectionner</option>
                                                    <option value="Enfant">Enfant</option>
                                                    <option value="Adulte">Adulte</option>
                                                    <option value="Berceau">Berceau</option>
                                                    <option value="Autre">Autre</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Chambre
                                                </label>
                                                <select class="form-select" id="chambre_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <div class="d-flex gap-2 justify-content-start">
                                                    <button id="btn_eng_lit" class="btn btn-success">
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3" id="div_alert">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row ends -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="twoAAA" role="tabpanel" aria-labelledby="tab-twoAAA">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">
                                        Lits enregistrées Aujourd'hui
                                    </h5>
                                    <a id="btn_refresh_table_day" class="btn btn-outline-info ms-auto">
                                        <i class="ri-loop-left-line"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="table-outer" id="div_Table_lit_day" style="display: none;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-hover m-0 truncate" id="Table_lit_day">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">N°</th>
                                                        <th scope="col">Numéro</th>
                                                        <th scope="col">Catégorie</th>
                                                        <th scope="col">Numéro chambre</th>
                                                        <th scope="col">Prix</th>
                                                        <th scope="col">Statut</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="message_Table_lit_day" style="display: none;">
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

<div class="modal fade" id="Mdelete" tabindex="-1" aria-labelledby="delRowLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delRowLabel">
                    Confirmation
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Voulez-vous vraiment supprimé cette chambre
                <input type="hidden" id="litIddelete">
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end gap-2">
                    <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Non</a>
                    <button id="deleteLitBtn" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Oui</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Mmodif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier Lit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateLitForm">
                    <input type="hidden" id="litId"> <!-- Hidden field for the room's ID -->
                    <div class="mb-3">
                        <label for="chambreCode" class="form-label">Numéro</label>
                        <div class="input-group">
                            <span class="input-group-text">Lit-</span>
                            <input type="text" class="form-control" id="litCode" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-select" id="typeLit">
                            <option value="">Selectionner</option>
                            <option value="Enfant">Enfant</option>
                            <option value="Adulte">Adulte</option>
                            <option value="Berceau">Berceau</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="updateLitBtn">Mettre à jour</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        refresh_num();
        select_lit();
        list_lit();

        document.getElementById("btn_search_num").addEventListener("click", refresh_num);
        document.getElementById("btn_eng_lit").addEventListener("click", eng_lit);

        document.getElementById("btn_refresh_table_day").addEventListener("click", list_lit);
        document.getElementById("updateLitBtn").addEventListener("click", update_lit);
        document.getElementById("deleteLitBtn").addEventListener("click", delete_lit);

        function refresh_num(){

            var num_lit = document.getElementById('num_lit');

            $.ajax({
                url: '/api/refresh_num_lit',
                method: 'GET',
                success: function(response) {
                    // showAlert('success', 'Code générer avec succès');
                    num_lit.value = response.code;
                },
                error: function() {
                    // showAlert('danger', 'Impossible de generer le code automatiquement');
                }
            });
        }

        function select_lit() {
            const selectElement = document.getElementById('chambre_id');

            // Clear existing options
            selectElement.innerHTML = '';

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner une Chambre';
            selectElement.appendChild(defaultOption);

            $.ajax({
                url: '/api/list_chambre_select',
                method: 'GET',
                success: function(response) {
                    data = response.list;
                    data.forEach(list => {
                        const option = document.createElement('option');
                        option.value = list.id; // Ensure 'id' is the correct key
                        option.textContent = 'CH-'+list.code; // Ensure 'nom' is the correct key
                        selectElement.appendChild(option);
                    });
                },
                error: function() {
                    // showAlert('danger', 'Impossible de generer le code automatiquement');
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

        function eng_lit() {

            const num_lit = document.getElementById("num_lit");
            const type = document.getElementById("type");
            const chambre_id = document.getElementById("chambre_id");

            if(!num_lit.value.trim() || !type.value.trim() || !chambre_id.value.trim()){
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.','warning');
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
                url: '/api/lit_new',
                method: 'GET',  // Use 'POST' for data creation
                data: { num_lit: num_lit.value, type: type.value, chambre_id: chambre_id.value },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.existe) {

                        select_lit();

                        showAlert('Alert', 'Cet Lit Existe déjà.','warning');

                    } else if (response.nbre) {

                        select_lit();

                        showAlert('Alert', 'Cette Chambre a atteint sa limite, Veuillez selectionner une autre chambre.','warning');

                    } else if (response.success) {

                        num_lit.value = '';
                        type.value = '';
                        chambre_id.value = '';

                        refresh_num();
                        select_lit();
                        list_lit();

                        showAlert('Succès', 'Opération éffectuée.','success');

                    } else if (response.error) {

                        select_lit();

                        showAlert('Erreur', 'Une erreur est survenue lors de l\'enregistrement.','error');

                    }

                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    select_lit();

                    showAlert('Erreur', 'Une erreur est survenue lors de l\'enregistrement.','error');
                }
            });

        }

        function list_lit() {

            const tableBody = document.querySelector('#Table_lit_day tbody'); // Target the specific table by id
            const messageDiv = document.getElementById('message_Table_lit_day');
            const tableDiv = document.getElementById('div_Table_lit_day'); // The message div
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
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a class="btn btn-outline-info btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mmodif" id="edit-${item.id}">
                                            <i class="ri-edit-box-line"></i>
                                        </a>
                                        ${item.statut === 'disponible' ? 
                                            `<a class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mdelete" id="delete-${item.id}">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>` : `` }
                                    </div>
                                </td>
                            `;
                            // Append the row to the table body
                            tableBody.appendChild(row);

                            // Add event listener to the edit button to open the modal with pre-filled data
                            document.getElementById(`edit-${item.id}`).addEventListener('click', () => {
                                // Set the values in the modal form
                                document.getElementById('litId').value = item.id;
                                document.getElementById('litCode').value = item.code;

                                const litTypeSelect = document.getElementById('typeLit');
                                const typeOptions = litTypeSelect.options;

                                // Loop through the options to find the matching value
                                for (let i = 0; i < typeOptions.length; i++) {
                                    if (typeOptions[i].value === item.type) { // Replace 'item.type_lit' with the correct field from your data
                                        typeOptions[i].selected = true; // Set the matching option as selected
                                        break; // Stop the loop once a match is found
                                    }
                                }
                            });

                            const deleteButton = document.getElementById(`delete-${item.id}`);
                            if (deleteButton) {
                                deleteButton.addEventListener('click', () => {
                                    // Set the values in the modal form
                                    document.getElementById('litIddelete').value = item.id;
                                });
                            }

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

        function update_lit() {

            const id = document.getElementById('litId').value;
            const typeLit = document.getElementById('typeLit').value;

            if(!typeLit.trim()){
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.','warning');
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
                url: '/api/update_lit/'+id,
                method: 'GET',
                data: { typeLit: typeLit},
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {

                        showAlert('Succès', 'Opération éffectuée.','success');

                    }

                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Erreur', 'Erreur lors de la mise à jour de la chambre.','error');
                }
            });
        }

        function delete_lit() {

            const id = document.getElementById('litIddelete').value;

            var modal = bootstrap.Modal.getInstance(document.getElementById('Mdelete'));
            modal.hide();

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/delete_lit/'+id,
                method: 'GET',
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {

                        showAlert('Succès', 'Opération éffectuée.','success');

                    }
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Erreur', 'Erreur lors de la suppression de la chambre.','error');
                }
            });
        }

    });
</script>


@endsection