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
            Nouvel Utilisateur
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
                        <h5>Utilisateurs</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row starts -->
    <div class="row gx-3" >
        <div class="col-sm-12">
            <div class="card mb-3 mt-3">
                <div class="card-body" style="margin-top: -30px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center bg-primary bg-2" id="customTab4" role="tablist" style="background: rgba(0, 0, 0, 0.7);">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-white" id="tab-twoAAAN" data-bs-toggle="tab" href="#twoAAAN" role="tab" aria-controls="twoAAAN" aria-selected="false" tabindex="-1">
                                    <i class="ri-user-add-line me-2"></i>
                                    Nouvel Utilisateur
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-contacts-line me-2"></i>
                                    Liste des Utilisateurs
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane active show fade" id="twoAAAN" role="tabpanel" aria-labelledby="tab-twoAAAN">
                                <div class="card-header">
                                    <h5 class="card-title">Formulaire Nouvel Utilisateur</h5>
                                </div>
                                <div class="card-body" >
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
                                                    <option value="Mr">Homme</option>
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
                                                <label class="form-label">Rôle</label>
                                                <select class="form-select select2" id="role_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Mot de passe</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="password" placeholder="Saisie Obligatoire" value="0000">
                                                    <a class="btn btn-white" id="btn_hidden_mpd">
                                                        <i id="toggleIcon" class="ri-eye-line text-primary"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3 d-flex gap-2 justify-content-start">
                                                <button id="btn_eng" class="btn btn-success">
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
                                        Liste des Utilisateurs
                                    </h5>
                                    <a id="btn_refresh_table" class="btn btn-outline-info ms-auto">
                                        <i class="ri-loop-left-line"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="table-outer" id="div_Table" style="display: none;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-hover m-0 truncate" id="Table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">N°</th>
                                                        <th scope="col">Nom et Prénoms</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Matricule</th>
                                                        <th scope="col">Rôle</th>
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
                                            Aucun Utilisateur n'a été enregistrer
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
                Voulez-vous vraiment supprimé cet Utilisateur ?
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

<div class="modal fade" id="Mmodif" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mise à jour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
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
                        <label class="form-label">Rôle</label>
                        <select class="form-select select2" id="role_idModif"></select>
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

@include('select2')

<script>
    $('#Mmodif').on('shown.bs.modal', function () {
        $('#role_idModif').select2({
            theme: 'bootstrap',
            placeholder: 'Selectionner',
            language: {
                noResults: function() {
                    return "Aucun résultat trouvé";
                }
            },
            width: '100%',
            dropdownParent: $('#Mmodif'),
        });
    });
</script>

<script>
    $(document).ready(function() {

        select();
        select_modif();
        list();

        $("#btn_eng").on("click", eng);
        $("#btn_refresh_table").on("click", list);
        $("#updateBtn").on("click", updatee);
        $("#deleteBtn").on("click", deletee);

        var inputs = ['tel', 'tel2', 'telModif', 'tel2Modif'];
        inputs.forEach(function(id) {
            $("#" + id).on("input", function() {
                this.value = this.value.replace(/[^0-9]/g, ''); // Allow only numbers
            });
        });

        $("#btn_hidden_mpd").on("click", function(event) {
            event.preventDefault();
            const passwordField = $('#password');
            const toggleIcon = $('#toggleIcon');

            if (passwordField.attr("type") === 'password') {
                passwordField.attr("type", "text");
                toggleIcon.removeClass('ri-eye-line').addClass('ri-eye-off-line');
            } else {
                passwordField.attr("type", "password");
                toggleIcon.removeClass('ri-eye-off-line').addClass('ri-eye-line');
            }
        });

        function select() {
            const selectElement = $('#role_id');
            selectElement.empty(); // Clear existing options
            selectElement.append($('<option>', {
                value: '',
                text: 'Selectionner'
            }));

            $.ajax({
                url: '/api/select_role',
                method: 'GET',
                success: function(response) {
                    const data = response.role;
                    data.forEach(function(item) {
                        selectElement.append($('<option>', {
                            value: item.id, // Ensure 'id' is the correct key
                            text: item.nom  // Ensure 'nom' is the correct key
                        }));
                    });
                },
                error: function() {
                    // showAlert('danger', 'Impossible de generer le code automatiquement');
                }
            });
        }

        function select_modif() {
            const selectElement = $('#role_idModif');
            selectElement.empty(); // Clear existing options

            $.ajax({
                url: '/api/select_role',
                method: 'GET',
                success: function(response) {
                    const data = response.role;
                    data.forEach(function(item) {
                        selectElement.append($('<option>', {
                            value: item.id, // Ensure 'id' is the correct key
                            text: item.nom  // Ensure 'nom' is the correct key
                        }));
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

        // Function to handle form submission and validation
        function eng() {
            const nom = $("#nom");
            const email = $("#email");
            const tel = $("#tel");
            const tel2 = $("#tel2");
            const sexe = $("#sexe");
            const adresse = $("#adresse");
            const role_id = $("#role_id");
            const password = $("#password");

            // Check for empty required fields
            if (!nom.val().trim() || !email.val().trim() || !tel.val().trim() || !sexe.val().trim() || !adresse.val().trim() || !role_id.val().trim() || !password.val().trim()) {
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.', 'warning');
                return false;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.val().trim())) { 
                showAlert('Alert', 'Email incorrect.', 'warning');
                return false;
            }

            // Phone number validation
            if (tel.val().length !== 10 || (tel2.val().trim() && tel2.val().length !== 10)) {
                showAlert('Alert', 'Contact incomplet.', 'warning');
                return false;
            }

            // Show preloader
            const preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            $("body").append(preloader_ch);

            // AJAX request to create a new user
            $.ajax({
                url: '/api/new_user',
                method: 'GET',
                data: { 
                    nom: nom.val(),
                    email: email.val(),
                    tel: tel.val(),
                    tel2: tel2.val() || null,
                    adresse: adresse.val(),
                    sexe: sexe.val(),
                    role_id: role_id.val(),
                    password: password.val(),
                },
                success: function(response) {
                    $("#preloader_ch").remove();

                    if (response.tel_existe) {
                        showAlert('Alert', 'Veuillez saisir autre numéro de téléphone s\'il vous plaît', 'warning');
                    } else if (response.email_existe) {
                        showAlert('Alert', 'Veuillez saisir autre email s\'il vous plaît', 'warning');
                    } else if (response.nom_existe) {
                        showAlert('Alert', 'Cet Utilisateur existe déjà.', 'warning');
                    } else if (response.success) {
                        // Clear form inputs
                        nom.val('');
                        email.val('');
                        tel.val('');
                        tel2.val('');
                        adresse.val('');
                        sexe.val('');
                        role_id.val('').trigger('change');
                        password.val('0000');

                        list(); // Refresh the list
                        showAlert('Succès', 'Opération éffectuée.', 'success');
                    } else if (response.error) {
                        showAlert('Erreur', 'Une erreur est survenue lors de l\'enregistrement.', 'error');
                    }
                },
                error: function() {
                    $("#preloader_ch").remove();
                    showAlert('Erreur', 'Une erreur est survenue', 'error');
                }
            });
        }

        // Function to load and display the user list
        function list() {
            const tableBody = $('#Table tbody');
            const messageDiv = $('#message_Table');
            const tableDiv = $('#div_Table');
            const loaderDiv = $('#div_Table_loader');

            messageDiv.hide();
            tableDiv.hide();
            loaderDiv.show();

            // Fetch user data from API
            $.getJSON('/api/list_user')
                .done(function(data) {
                    const users = data.user;
                    tableBody.empty();

                    if (users.length > 0) {
                        loaderDiv.hide();
                        messageDiv.hide();
                        tableDiv.show();

                        users.forEach((item, index) => {
                            const row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a class="d-flex align-items-center flex-column me-2">
                                                <img src="{{asset('assets/images/user8.png')}}" class="img-2x rounded-circle border border-1">
                                            </a>
                                            ${item.sexe}. ${item.name}
                                        </div>
                                    </td>
                                    <td>${item.email}</td>
                                    <td>${item.matricule}</td>
                                    <td>${item.role}</td>
                                    <td>+225 ${item.tel}</td>
                                    <td>${item.adresse}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a class="btn btn-outline-info btn-sm rounded-5 edit-btn" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#Mmodif">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm rounded-5 delete-btn" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#Mdelete">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                            tableBody.append(row);
                        });

                        // Attach event listeners to dynamically added buttons
                        $(".edit-btn").on('click', function() {
                            const id = $(this).data('id');
                            const user = users.find(u => u.id === id);
                            if (user) {
                                $('#Id').val(user.id);
                                $('#nomModif').val(user.name);
                                $('#emailModif').val(user.email);
                                $('#telModif').val(user.tel);
                                $('#tel2Modif').val(user.tel2);
                                $('#adresseModif').val(user.adresse);
                                $('#sexeModif').val(user.sexe);

                                $('#role_idModif').val(null).trigger('change');
                                $('#role_idModif').val(user.role_id).trigger('change');
                            }
                        });

                        $(".delete-btn").on('click', function() {
                            $('#Iddelete').val($(this).data('id'));
                        });

                    } else {
                        loaderDiv.hide();
                        messageDiv.show();
                        tableDiv.hide();
                    }
                })
                .fail(function(error) {
                    console.error('Erreur lors du chargement des données:', error);
                    loaderDiv.hide();
                    messageDiv.show();
                    tableDiv.hide();
                });
        }

        function updatee() {

            const id = $('#Id').val();
            const nomModif = $('#nomModif').val();
            const typesoins_id_modif = $('#typesoins_id_modif').val();
            const prixModif = $('#prixModif').val();

            if (!nomModif.trim() || !typesoins_id_modif.trim() || !prixModif.trim()) {
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.', 'warning');
                return false;
            }

            var modal = bootstrap.Modal.getInstance($('#Mmodif')[0]);
            modal.hide();

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            $('body').append(preloader_ch);

            $.ajax({
                url: '/api/update_soinIn/' + id,
                method: 'GET',  // Use 'POST' for data creation
                data: {
                    nomModif: nomModif,
                    typesoins_id: typesoins_id_modif,
                    prix: prixModif
                },
                success: function(response) {
                    $('#preloader_ch').remove(); // Remove preloader

                    showAlert('Succès', 'Soins Infirmier mis à jour avec succès.', 'success');

                    list();
                    select();
                    select_modif();
                },
                error: function() {
                    $('#preloader_ch').remove(); // Remove preloader

                    showAlert('Erreur', 'Erreur lors de la mise à jour.', 'error');
                }
            });
        }

        function deletee() {

            const id = $('#Iddelete').val();

            var modal = bootstrap.Modal.getInstance($('#Mdelete')[0]);
            modal.hide();

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            $('body').append(preloader_ch);

            $.ajax({
                url: '/api/delete_soinsIn/' + id,
                method: 'GET',  // Use 'POST' for data creation
                success: function(response) {
                    $('#preloader_ch').remove(); // Remove preloader

                    showAlert('Succès', 'Soins Infirmier supprimé avec succès.', 'success');

                    list();
                    select();
                    select_modif();
                },
                error: function() {
                    $('#preloader_ch').remove(); // Remove preloader

                    showAlert('Erreur', 'Erreur lors de la suppression.', 'error');
                }
            });
        }

    });
</script>


@endsection