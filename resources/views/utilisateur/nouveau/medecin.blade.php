@extends('app')

@section('titre', 'Nouvel Utilisateur')

@section('info_page')
<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-bar-chart-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{route('index_accueil')}}">Espace Santé</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Nouveau Médecin
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
                    <h5 class="card-title">Formulaire Nouveau Médecin</h5>
                </div>
                <div class="card-body" >
                    <!-- Row starts -->
                    <div class="row gx-3">
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Nom et Prénoms</label>
                                <input type="text" class="form-control" id="nom" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Sexe</label>
                                <select class="form-select" id="sexe">
                                    <option value="">Selectionner</option>
                                    <option value="M">Homme</option>
                                    <option value="Mme">Femme</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Saisie Obligatoire">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Contact</label>
                                <input type="tel" class="form-control" id="tel" placeholder="Saisie Obligatoire" maxlength="10">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Contact 2</label>
                                <input type="tel" class="form-control" id="tel2" placeholder="facultatif" maxlength="10">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="adresse">Localisation</label>
                                <input type="text" class="form-control" id="adresse" placeholder="Saisie Obligatoire">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Spécialité</label>
                                <select class="form-select" id="typeacte_id">
                                </select>
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
                                <div id="div_alert" ></div>
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
                        Liste des Médecins
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
                            <table class="table align-middle table-hover m-0 truncate" id="Table">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Nom et Prénoms</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Matricule</th>
                                        <th scope="col">Specialité</th>
                                        <th scope="col">contact</th>
                                        <th scope="col">Localisation</th>
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
                            Aucun Medecin n'a été enregistrer
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
                Voulez-vous vraiment supprimé ce Médecin
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
                    <input type="hidden" id="Id">
                    <div class="mb-3">
                        <label class="form-label">Nom et Prénoms</label>
                        <input type="text" class="form-control" id="nomModif" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sexe</label>
                        <select class="form-select" id="sexeModif">
                            <option value="M">Homme</option>
                            <option value="Mme">Femme</option>
                        </select>
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
                        <input type="tel" class="form-control" id="tel2Modif" placeholder="facultatif" maxlength="10">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresseModif" placeholder="Saisie Obligatoire">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Specialité</label>
                        <select class="form-select" id="typeacte_idModif"></select>
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

        var inputs = ['tel', 'tel2', 'telModif', 'tel2Modif']; // Array of element IDs
        inputs.forEach(function(id) {
            var inputElement = document.getElementById(id); // Get each element by its ID
            inputElement.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, ''); // Allow only numbers
            });
        });


        function select() {
            const selectElement = document.getElementById('typeacte_id');

            // Clear existing options
            selectElement.innerHTML = '';

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner une spécialité';
            selectElement.appendChild(defaultOption);

            $.ajax({
                url: '/api/select_specialite',
                method: 'GET',
                success: function(response) {
                    data = response.typeacte;
                    data.forEach(typeacte => {
                        const option = document.createElement('option');
                        option.value = typeacte.id; // Ensure 'id' is the correct key
                        option.textContent = typeacte.nom; // Ensure 'nom' is the correct key
                        selectElement.appendChild(option);
                    });
                },
                error: function() {
                    // showAlert('danger', 'Impossible de generer le code automatiquement');
                }
            });
        }

        function select_modif() {
            const selectElement = document.getElementById('typeacte_idModif');

            // Clear existing options
            selectElement.innerHTML = '';

            $.ajax({
                url: '/api/select_specialite',
                method: 'GET',
                success: function(response) {
                    data = response.typeacte;
                    data.forEach(typeacte => {
                        const option = document.createElement('option');
                        option.value = typeacte.id; // Ensure 'id' is the correct key
                        option.textContent = typeacte.nom; // Ensure 'nom' is the correct key
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

        function eng() {

            const nom = document.getElementById("nom");
            const email = document.getElementById("email");
            const tel = document.getElementById("tel");
            const tel2 = document.getElementById("tel2");
            const sexe = document.getElementById("sexe");
            const adresse = document.getElementById("adresse");
            const typeacte_id = document.getElementById("typeacte_id");
            
            var dynamicFields = document.getElementById("div_alert");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            if (!nom.value.trim() || !email.value.trim() || !tel.value.trim() || !sexe.value.trim() || !adresse.value.trim() || !typeacte_id.value.trim()) {
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.','warning');
                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) { 
                showAlert('Alert', 'Email incorrect.','warning');
                return false;
            }

            if (tel.value.length !== 10 || (tel2.value.trim() && tel2.value.length !== 10)) {
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
                url: '/api/new_medecin',
                method: 'GET',
                data: { nom: nom.value, email: email.value, tel: tel.value, tel2: tel2.value || null, adresse: adresse.value, sexe: sexe.value, typeacte_id: typeacte_id.value },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.tel_existe) {

                        showAlert('Alert', 'Veuillez saisir autre numéro de téléphone s\'il vous plaît','warning');

                    }else if (response.email_existe) {

                        showAlert('Alert', 'Veuillez saisir autre email s\'il vous plaît','warning');

                    }else if (response.nom_existe) {

                        showAlert('Alert', 'Cet Médecin existe déjà.','warning');

                    } else if (response.success) {

                        nom.value = '';
                        email.value = '';
                        tel.value = '';
                        tel2.value = '';
                        adresse.value = '';
                        sexe.value = '';
                        typeacte_id.value = '';

                        list();

                        showAlert('Succès', 'Opération éffectuée.','success');

                    } else if (response.error) {

                        showAlert('Erreur', 'Une erreur est survenue lors de l\'enregistrement.','error');

                    }
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Erreur', 'Une erreur est survenue lors de l\'enregistrement.','error');
                }
            });
        }

        function list() {

            const tableBody = document.querySelector('#Table tbody');
            const messageDiv = document.getElementById('message_Table');
            const tableDiv = document.getElementById('div_Table'); // The message div
            const loaderDiv = document.getElementById('div_Table_loader');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            // Fetch data from the API
            fetch('/api/list_medecin') // API endpoint
                .then(response => response.json())
                .then(data => {
                    // Access the 'chambre' array from the API response
                    const medecins = data.medecin;

                    // Clear any existing rows in the table body
                    tableBody.innerHTML = '';

                    if (medecins.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        // Loop through each item in the chambre array
                        medecins.forEach((item, index) => {
                            // Create a new row
                            const row = document.createElement('tr');
                            // Create and append cells to the row based on your table's structure
                            row.innerHTML = `
                                <td>${index + 1}</td>
                                <td>${item.sexe}. ${item.name}</td>
                                <td>${item.email}</td>
                                <td>M-${item.matricule}</td>
                                <td>${item.typeacte}</td>
                                <td>+225 ${item.tel}</td>
                                <td>${item.adresse}</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a class="btn btn-outline-info btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mmodif" id="edit-${item.id}">
                                            <i class="ri-edit-box-line"></i>
                                        </a>
                                        <a class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mdelete" id="delete-${item.id}">
                                            <i class="ri-delete-bin-line"></i>
                                        </a>
                                    </div>
                                </td>
                            `;
                            // Append the row to the table body
                            tableBody.appendChild(row);

                            // Add event listener to the edit button to open the modal with pre-filled data
                            document.getElementById(`edit-${item.id}`).addEventListener('click', () =>
                            {
                                // Set the values in the modal form
                                document.getElementById('Id').value = item.id;
                                document.getElementById('nomModif').value = item.name;
                                document.getElementById('emailModif').value = item.email;
                                document.getElementById('telModif').value = item.tel;
                                document.getElementById('tel2Modif').value = item.tel2;
                                document.getElementById('adresseModif').value = item.adresse;

                                const modifSexeSelect = document.getElementById('sexeModif');
                                const typeeOptions = modifSexeSelect.options;
                                // Loop through the options to find the matching value
                                for (let i = 0; i < typeeOptions.length; i++) {
                                    if (String(typeeOptions[i].value) === String(item.sexe)) {
                                        typeeOptions[i].selected = true; // Set the matching option as selected
                                        break; // Stop the loop once a match is found
                                    }
                                }

                                const modifActeSelect = document.getElementById('typeacte_idModif');
                                const typeOptions = modifActeSelect.options;
                                // Loop through the options to find the matching value
                                for (let i = 0; i < typeOptions.length; i++) {
                                    if (String(typeOptions[i].value) === String(item.typeacte_id)) {
                                        typeOptions[i].selected = true; // Set the matching option as selected
                                        break; // Stop the loop once a match is found
                                    }
                                }
                            });

                            document.getElementById(`delete-${item.id}`).addEventListener('click', () => {
                                // Set the values in the modal form
                                document.getElementById('Iddelete').value = item.id;
                            });

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
            const id = document.getElementById("Id").value;
            const nom = document.getElementById("nomModif");
            const email = document.getElementById("emailModif");
            const tel = document.getElementById("telModif");
            const tel2 = document.getElementById("tel2Modif");
            const sexe = document.getElementById("sexeModif");
            const adresse = document.getElementById("adresseModif");
            const typeacte_id = document.getElementById("typeacte_idModif");

            var dynamicFields = document.getElementById("alert_update");
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            // Field validation
            if (!nom.value.trim() || !email.value.trim() || !tel.value.trim() || !sexe.value.trim() || !adresse.value.trim() || !typeacte_id.value.trim()) {
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.','warning');
                return false;
            }

            // Email validation
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) {
                showAlert('Alert', 'Email incorrect.','warning');
                return false;
            }

            // Phone validation
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
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/update_medecin/' + id,
                method: 'GET', // Corrected to 'PUT'
                data: {
                    nom: nom.value, 
                    email: email.value, 
                    tel: tel.value, 
                    tel2: tel2.value || null, 
                    adresse: adresse.value, 
                    sexe: sexe.value, 
                    typeacte_id: typeacte_id.value
                },
                success: function(response) {

                    document.getElementById('preloader_ch').remove();

                    if (response.tel_existe) {

                        showAlert('Alert', 'Veuillez saisir autre numéro de téléphone s\'il vous plaît','warning');

                    }else if (response.email_existe) {

                        showAlert('Alert', 'Veuillez saisir autre email s\'il vous plaît','warning');

                    }else if (response.nom_existe) {

                        showAlert('Alert', 'Cet Médecin existe déjà.','warning');

                    } else if (response.success) {

                        list();

                        showAlert('Succès', 'Opération éffectuée.','success');

                    } else if (response.error) {

                        showAlert('Erreur', 'Une erreur est survenue lors de l\'enregistrement.','error');

                    }
                },
                error: function() {
                    document.getElementById('preloader_ch').remove();
                    showAlert('Erreur', 'Erreur lors de la mise à jour.','error');
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
                url: '/api/delete_medecin/'+id,
                method: 'GET',
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {

                        list();

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