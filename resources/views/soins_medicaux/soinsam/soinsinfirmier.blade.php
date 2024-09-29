@extends('app')

@section('titre', 'Nouveau Type acte')

@section('info_page')
<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-bar-chart-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{route('index_accueil')}}">Espace Santé</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Nouveau Soins Infirmier
        </li>
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <!-- Row starts -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Formulaire Nouveau Soins Infirmier</h5>
                </div>
                <div class="card-body" >
                    <!-- Row starts -->
                    <div class="row gx-3">
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Type de Soins
                                </label>
                                <select class="form-select" id="typesoins_id">
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Soins Infirmier
                                </label>
                                <input type="text" class="form-control" id="nom_soins" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Prix</label>
                                <div class="input-group">
                                    <input type="tel" class="form-control" id="prix" placeholder="Saisie Obligatoire">
                                    <span class="input-group-text">Fcfa</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <div class="d-flex gap-2 justify-content-start">
                                    <button id="btn_eng" class="btn btn-success">
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
        </div>
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        Liste des Soins Infirmiers
                    </h5>
                    <a id="btn_refresh_table" class="btn btn-outline-info ms-auto">
                        <i class="ri-loop-left-line"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div id="div_alert_table" >
                    
                    </div>
                    <div class="table-outer" id="div_Table" style="display: none;">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover m-0 truncate" id="Table" >
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Soins</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="message_Table" style="display: none;">
                        <p class="text-center" >
                            Aucun Soins Infirmier n'a été trouvé
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
    <!-- Row ends -->
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
                Voulez-vous vraiment supprimé ce Soins Infirmier ?
                <input type="hidden" id="Iddelete">
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end gap-2">
                    <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Non</a>
                    <button id="deleteBtn" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Oui</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Mmodif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mise à jour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <div class="mb-3" id="alert_update">
                        
                    </div>
                    <input type="hidden" id="Id"> <!-- Hidden field for the room's ID -->
                    <div class="mb-3">
                        <label class="form-label">Soins Infirmier</label>
                        <input type="text" class="form-control" id="nomModif" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Acte</label>
                        <select class="form-select" id="typesoins_id_modif"></select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prix</label>
                        <div class="input-group">
                            <input type="tel" class="form-control" id="prixModif" placeholder="Saisie Obligatoire">
                            <span class="input-group-text">Fcfa</span>
                        </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {

        select();
        select_modif();
        list();

        document.getElementById("btn_eng").addEventListener("click", eng);
        document.getElementById("btn_refresh_table").addEventListener("click", list);
        document.getElementById("updateBtn").addEventListener("click", updatee);
        document.getElementById("deleteBtn").addEventListener("click", deletee);

        document.getElementById('prix').addEventListener('input', function() {
            this.value = formatPrice(this.value);
        });
        document.getElementById('prix').addEventListener('keypress', function(event) {
            const key = event.key;
            if (isNaN(key)) {
                event.preventDefault();
            }
        });

        document.getElementById('prixModif').addEventListener('input', function() {
            this.value = formatPrice(this.value);
        });
        document.getElementById('prixModif').addEventListener('keypress', function(event) {
            const key = event.key;
            if (isNaN(key)) {
                event.preventDefault();
            }
        });

        function formatPrice(input) {
            // Supprimer tous les points existants
            input = input.replace(/\./g, '');
            // Formater le prix avec des points
            return input.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function select() {
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
        }

        function select_modif() {
            const selectElement = document.getElementById('typesoins_id_modif');

            // Clear existing options
            selectElement.innerHTML = '';

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

        function showAlertUpdate(type, message) {

            var dynamicFields = document.getElementById("alert_update");
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
            document.getElementById("alert_update").appendChild(groupe);

            setTimeout(function() {
                groupe.classList.remove("show");
                groupe.classList.add("fade");
                setTimeout(function() {
                    groupe.remove();
                }, 150); // Time for the fade effect to complete
            }, 3000);
        }

        function showAlertList(type, message) {

            var dynamicFields = document.getElementById("div_alert_table");
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
            document.getElementById("div_alert_table").appendChild(groupe);

            setTimeout(function() {
                groupe.classList.remove("show");
                groupe.classList.add("fade");
                setTimeout(function() {
                    groupe.remove();
                }, 150); // Time for the fade effect to complete
            }, 3000);
        }

        function eng() {

            const typesoins_id = document.getElementById("typesoins_id");
            const nom_soins = document.getElementById("nom_soins");
            const prix = document.getElementById("prix");

            var dynamicFields = document.getElementById("div_alert");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            if(!typesoins_id.value.trim() || !nom_soins.value.trim() || !prix.value.trim()){
                showAlert('warning', 'Veuillez remplir tous les champs SVP.');
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
                url: '/api/new_soinsIn',
                method: 'GET',  // Use 'POST' for data creation
                data: { typesoins_id: typesoins_id.value, nom_soins: nom_soins.value, prix: prix.value },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {
                        showAlert('success', 'Opération éffectuée.');
                    } else if (response.error) {
                        showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                    }

                    typesoins_id.value = '';
                    nom_soins.value = '';
                    prix.value = '';

                    select_modif();
                    select();
                    list();
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                }
            });
        }

        function list() {

            const tableBody = document.querySelector('#Table tbody'); // Target the specific table by id
            const messageDiv = document.getElementById('message_Table');
            const tableDiv = document.getElementById('div_Table'); // The message div
            const loaderDiv = document.getElementById('div_Table_loader');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            // Fetch data from the API
            fetch('/api/list_soinsIn') // API endpoint
                .then(response => response.json())
                .then(data => {
                    // Access the 'chambre' array from the API response
                    const soinsins = data.soinsin;

                    // Clear any existing rows in the table body
                    tableBody.innerHTML = '';

                    if (soinsins.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        // Loop through each item in the chambre array
                        soinsins.forEach((item, index) => {
                            // Create a new row
                            const row = document.createElement('tr');
                            // Create and append cells to the row based on your table's structure
                            row.innerHTML = `
                                <td>${index + 1}</td>
                                <td>${item.nom}</td>
                                <td>${item.nom_typesoins}</td>
                                <td>${item.prix} Fcfa</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a class="btn btn-outline-info btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mmodif" id="edit-${item.id}">
                                            <i class="ri-edit-box-line"></i>
                                        </a>
                                        
                                    </div>
                                </td>
                            `;
                            // <a class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mdelete" id="delete-${item.id}">
                            //                 <i class="ri-delete-bin-line"></i>
                            //             </a>
                            // Append the row to the table body
                            tableBody.appendChild(row);

                            // Add event listener to the edit button to open the modal with pre-filled data
                            document.getElementById(`edit-${item.id}`).addEventListener('click', () =>
                            {
                                // Set the values in the modal form
                                document.getElementById('Id').value = item.id;
                                document.getElementById('nomModif').value = item.nom;
                                document.getElementById('prixModif').value = item.prix;

                                const modifActeSelect = document.getElementById('typesoins_id_modif');
                                const typeeOptions = modifActeSelect.options;

                                // Loop through the options to find the matching value
                                for (let i = 0; i < typeeOptions.length; i++) {
                                    if (String(typeeOptions[i].value) === String(item.typesoins_id)) {
                                        typeeOptions[i].selected = true; // Set the matching option as selected
                                        break; // Stop the loop once a match is found
                                    }
                                }
                            });

                            // Add event listener to the edit button to open the modal with pre-filled data
                            // document.getElementById(`delete-${item.id}`).addEventListener('click', () => {
                            //     // Set the values in the modal form
                            //     document.getElementById('Iddelete').value = item.id;
                            // });

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

        function updatee() {

            const id = document.getElementById('Id').value;
            const nomModif = document.getElementById('nomModif').value;
            const typesoins_id_modif = document.getElementById('typesoins_id_modif').value;
            const prixModif = document.getElementById('prixModif').value;


            var dynamicFields = document.getElementById("alert_update");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            if(!nomModif.trim() || !typesoins_id_modif.trim() || !prixModif.trim()){
                showAlertUpdate('warning', 'Veuillez remplir tous les champs SVP.');
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
                url: '/api/update_soinIn/'+id,
                method: 'GET',  // Use 'POST' for data creation
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Include CSRF token if required
                //     'Content-Type': 'application/json',  // Ensure JSON request
                // },
                data: { nomModif: nomModif, typesoins_id: typesoins_id_modif, prix: prixModif,},
                // data: JSON.stringify({
                //     nbre_lit: nbreLit,
                //     prix: prix,
                // }),
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlertList('success', 'Soins Infirmier mis à jour avec succès.');
            
                    list();
                    select();
                    select_modif();
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlertList('error', 'Erreur lors de la mise à jour.');
                }
            });
        }

        function deletee() {

            const id = document.getElementById('Iddelete').value;

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
                url: '/api/delete_soinsIn/'+id,
                method: 'GET',  // Use 'POST' for data creation
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Include CSRF token if required
                //     'Content-Type': 'application/json',  // Ensure JSON request
                // },
                // data: { nbre_lit: nbreLit, prix: prix},
                // data: JSON.stringify({
                //     nbre_lit: nbreLit,
                //     prix: prix,
                // }),
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlertList('success', 'Soins Infirmier supprimer avec succès.');
                    
                    list();
                    select();
                    select_modif();
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlertList('error', 'Erreur lors de la suppression de la chambre.');
                }
            });
        }

    });
</script>


@endsection