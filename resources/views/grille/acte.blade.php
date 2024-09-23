@extends('app')

@section('titre', 'Nouvel Acte')

@section('info_page')
<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-bar-chart-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{route('index_accueil')}}">Espace Santé</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Nouvel Acte
        </li>
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <!-- Row starts -->
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-lg-6 col-md-8 col-sm-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Formulaire Nouvel Acte</h5>
                </div>
                <div class="card-body" >
                    <div class="row gx-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">
                                    Nom de l'acte
                                </label>
                                <input type="text" class="form-control" id="nomA" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3 d-flex gap-2 justify-content-start">
                                <button id="btn_eng" class="btn btn-success">
                                    Enregistrer
                                </button>
                            </div>
                        </div> 
                        <div class="col-sm-12" >
                            <div class="mb-3" >
                                <div id="div_alert" >
                    
                                </div>
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
                        Liste des Actes
                    </h5>
                    <a id="btn_refresh_table" class="btn btn-outline-info ms-auto">
                        <i class="ri-loop-left-line"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div id="div_alert_table" >
                    
                    </div>
                    <div class="table-outer" id="div_Table" style="display: none;" >
                        <div class="table-responsive">
                            <table class="table align-middle table-hover m-0 truncate" id="Table_day">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Nom</th>
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
                            Aucun acte n'a été trouvé
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
                Voulez-vous vraiment supprimé cet Acte
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
                <h5 class="modal-title" id="exampleModalLabel">Modifier Acte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateChambreForm">
                    <div class="mb-3" id="alert_update">
                        
                    </div>
                    <input type="hidden" id="Id"> <!-- Hidden field for the room's ID -->
                    <div class="mb-3">
                        <label class="form-label">Nom de l'acte</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nomModif" oninput="this.value = this.value.toUpperCase()">
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

        list();

        document.getElementById("btn_eng").addEventListener("click", eng);
        document.getElementById("btn_refresh_table").addEventListener("click", list);
        document.getElementById("updateBtn").addEventListener("click", updatee);
        document.getElementById("deleteBtn").addEventListener("click", deletee);

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

        function showAlertTable(type, message) {

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

        function eng() 
        {

            const nom = document.getElementById("nomA");

            var dynamicFields = document.getElementById("div_alert");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            if(!nom.value.trim()){
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
                url: '/api/motif_cons_new',
                method: 'GET',
                data: { nom: nom.value,},
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.existe) {
                        showAlert('warning', 'Cet Acte existe déjà.');
                    } else if (response.success) {
                        showAlert('success', 'Acte Enregistrée.');
                    } else if (response.error) {
                        showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                    }

                    nom.value = '';

                    list();
                },
                error: function(xhr, status, error) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    // You can log the entire error object to inspect it if needed
                    console.log(xhr, status, error);

                    // Display a more specific error message
                    if (xhr.responseText) {
                        showAlert('danger', `Erreur: ${xhr.responseText}`);
                    } else {
                        showAlert('danger', `Erreur: ${status} - ${error}`);
                    }

                    nom.value = '';
                }
            });
        }

        function list() {

            const tableBody = document.querySelector('#Table_day tbody'); // Target the specific table by id
            const messageDiv = document.getElementById('message_Table');
            const tableDiv = document.getElementById('div_Table'); // The message div
            const loaderDiv = document.getElementById('div_Table_loader');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            // Fetch data from the API
            fetch('/api/list_acte') // API endpoint
                .then(response => response.json())
                .then(data => {
                    // Access the 'chambre' array from the API response
                    const actes = data.acte;

                    // Clear any existing rows in the table body
                    tableBody.innerHTML = '';

                    if (actes.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        // Loop through each item in the chambre array
                        actes.forEach((item, index) => {
                            // Create a new row
                            const row = document.createElement('tr');
                            // Create and append cells to the row based on your table's structure
                            row.innerHTML = `
                                <td>${index + 1}</td>
                                <td>${item.nom}</td>
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
                            document.getElementById(`edit-${item.id}`).addEventListener('click', () => {
                                // Set the values in the modal form
                                document.getElementById('Id').value = item.id;
                                document.getElementById('nomModif').value = item.nom;
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
            const nom = document.getElementById('nomModif').value;

            var dynamicFields = document.getElementById("alert_update");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var dynamicFields2 = document.getElementById("div_alert_table");
            // Remove existing content
            while (dynamicFields2.firstChild) {
                dynamicFields2.removeChild(dynamicFields2.firstChild);
            }

            if(!nom.trim()){
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
                url: '/api/update_acte/'+id,
                method: 'GET',  // Use 'POST' for data creation
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Include CSRF token if required
                //     'Content-Type': 'application/json',  // Ensure JSON request
                // },
                data: { nom: nom},
                // data: JSON.stringify({
                //     nbre_lit: nbreLit,
                //     prix: prix,
                // }),
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlertTable('success', 'Acte mise à jour avec succès.');
                    // Reload the list or update the table row without a full refresh
                    list(); // Call your function to reload the table
                    // Close the modal
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlertTable('error', 'Erreur lors de la mise à jour de l\'acte.');
                }
            });
        }

        function deletee() {

            const id = document.getElementById('Iddelete').value;

            var dynamicFields = document.getElementById("div_alert_table");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

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
                url: '/api/delete_acte/'+id,
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

                    showAlertTable('success', 'Acte supprimer avec succès.');
                    // Reload the list or update the table row without a full refresh
                    list(); // Call your function to reload the table
                    // Close the modal
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlertTable('error', 'Erreur lors de la suppression de la chambre.');
                }
            });
        }
    });
</script>

@endsection


