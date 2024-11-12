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
                                            <div class="mb-3 d-flex gap-2 justify-content-center">
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
                                    <div class="">
                                        <div class="table-responsive">
                                            <table id="Table_day" class="table table-hover table-sm">
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
                            <option value="Mr">Homme</option>
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

        $("#btn_eng").on("click", eng);
        $("#updateBtn").on("click", updatee);
        $("#deleteBtn").on("click", deletee);

        $('#btn_refresh_table').on('click', function () {
            $('#Table_day').DataTable().ajax.reload();
        });

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

        function formatDateHeure(dateString)
        {

            const date = new Date(dateString);
                
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');

            return `${day}/${month}/${year} à ${hours}:${minutes}:${seconds}`;
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

                        $('#Table_day').DataTable().ajax.reload();
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

        $('#Table_day').DataTable({

            processing: true,
            serverSide: false,
            ajax: {
                url: `/api/list_user`,
                type: 'GET',
                dataSrc: 'data',
            },
            columns: [
                { 
                    data: null, 
                    render: (data, type, row, meta) => meta.row + 1,
                    searchable: false,
                    orderable: false,
                },
                { 
                    data: 'name', 
                    render: (data, type, row) => `
                    <div class="d-flex align-items-center">
                        <a class="d-flex align-items-center flex-column me-2">
                            <img src="/assets/images/user8.png" class="img-2x rounded-circle border border-1">
                        </a>
                        ${row.sexe}. ${data}
                    </div>`,
                    searchable: true, 
                },
                { 
                    data: 'email',
                    searchable: true,
                },
                { 
                    data: 'matricule',
                    searchable: true, 
                },
                { 
                    data: 'role',
                    searchable: true, 
                },
                { 
                    data: 'tel', 
                    render: (data) => `+225 ${data}`,
                    searchable: true, 
                },
                { 
                    data: 'adresse',
                    searchable: true, 
                },
                {
                    data: null,
                    render: (data, type, row) => `
                        <div class="d-inline-flex gap-1" style="font-size:10px;">
                            <a class="btn btn-outline-info btn-sm rounded-5 edit-btn" data-id="${row.id}" data-name="${row.name}" data-email="${row.email}" data-tel="${row.tel}" data-tel2="${row.tel2}" data-adresse="${row.adresse}" data-sexe="${row.sexe}" data-role_id="${row.role_id}" data-bs-toggle="modal" data-bs-target="#Mmodif" id="modif">
                                <i class="ri-edit-box-line"></i>
                            </a>
                            <a class="btn btn-outline-danger btn-sm rounded-5 delete-btn" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#Mdelete" id="delete">
                                <i class="ri-delete-bin-line"></i>
                            </a>
                        </div>
                    `,
                    searchable: false,
                    orderable: false,
                }
            ],
            language: {
                search: "Recherche:",
                lengthMenu: "Afficher _MENU_ entrées",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                infoEmpty: "Affichage de 0 à 0 sur 0 entrée",
                paginate: {
                    previous: "Précédent",
                    next: "Suivant"
                },
                zeroRecords: "Aucune donnée trouvée",
                emptyTable: "Aucune donnée disponible dans le tableau",
            },
            // autoWidth: true,
            // scrollX: true, 
            initComplete: function(settings, json) {
                initializeRowEventListeners();
            },
        });

        function initializeRowEventListeners() {

            $('#Table_day').on('click', '#modif', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const email = $(this).data('email');
                const tel = $(this).data('tel');
                const tel2 = $(this).data('tel2');
                const adresse = $(this).data('adresse');
                const sexe = $(this).data('sexe');
                const role_id = $(this).data('role_id');
                // Handle the 'Modif' button click
                $('#Id').val(id);
                $('#nomModif').val(name);
                $('#emailModif').val(email);
                $('#telModif').val(tel);
                $('#tel2Modif').val(tel2);
                $('#adresseModif').val(adresse);
                $('#sexeModif').val(sexe);

                $('#role_idModif').val(null).trigger('change');
                $('#role_idModif').val(role_id).trigger('change');
            });

            $('#Table_day').on('click', '#delete', function() {
                const id = $(this).data('id');
                // Handle the 'Delete' button click
                $('#Iddelete').val(id);
            });
        }

        function updatee() {

            const id = $('#Id').val().trim();
            const nom = $('#nomModif').val().trim();
            const email = $('#emailModif').val().trim();
            const tel = $('#telModif').val().trim();
            const tel2 = $('#tel2Modif').val().trim();
            const sexe = $('#sexeModif').val().trim();
            const adresse = $('#adresseModif').val().trim();
            const role_id = $('#role_idModif').val().trim();

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Field validation
            if (!nom || !email || !tel || !sexe || !adresse) {
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.','warning');
                return false;
            }

            // Email validation
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showAlert('Alert', 'Email incorrect.','warning');
                return false;
            }

            // Phone validation
            if (tel.length !== 10 || (tel2 && tel2.length !== 10)) {
                showAlert('Alert', 'Contact incomplet.', 'warning');
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
                url: '/refresh-csrf',
                method: 'GET',
                success: function(response_crsf) {
                    // Met à jour la balise <meta> avec le nouveau token
                    document.querySelector('meta[name="csrf-token"]').setAttribute('content', response_crsf.csrf_token);
                    
                    // console.log("Nouveau token CSRF:", response_crsf.csrf_token);

                    $.ajax({
                        url: '/api/update_user/' + id,
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': response_crsf.csrf_token,
                        },
                        data: {
                            nom: nom, 
                            email: email, 
                            tel: tel, 
                            tel2: tel2 || null, 
                            adresse: adresse || null, 
                            sexe: sexe, 
                            role_id: role_id,
                        },
                        success: function(response) {

                            document.getElementById('preloader_ch').remove();

                            if (response.tel_existe) {

                                showAlert('Alert', 'Veuillez saisir autre numéro de téléphone s\'il vous plaît','warning');

                            }else if (response.email_existe) {

                                showAlert('Alert', 'Veuillez saisir autre email s\'il vous plaît','warning');

                            }else if (response.nom_existe) {

                                showAlert('Alert', 'Cet Utilisateur existe déjà.','warning');

                            } else if (response.success) {

                                $('#Table_day').DataTable().ajax.reload();

                                showAlert('Succès', 'Opération éffectuée.', 'success');

                            } else if (response.error) {

                                showAlert('Erreur', 'Une erreur est survenue lors de l\'enregistrement.','error');

                            }
                        },
                        error: function() {
                            document.getElementById('preloader_ch').remove();
                            showAlert('Erreur', 'Erreur lors de la mise à jour.','error');
                        }
                    });

                },
                error: function() {
                    console.log("Erreur lors du rafraîchissement du token CSRF");
                    document.getElementById('preloader_ch').remove();
                    showAlert('Erreur', 'Erreur lors de la mise à jour.','error');
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
                url: '/api/delete_user/' + id,
                method: 'GET',  // Use 'POST' for data creation
                success: function(response) {
                    $('#preloader_ch').remove(); // Remove preloader

                    $('#Table_day').DataTable().ajax.reload();

                    showAlert('Succès', 'Opération éffectuée.', 'success');
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