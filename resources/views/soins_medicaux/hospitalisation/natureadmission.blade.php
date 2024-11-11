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
            Nouvelle Nature Admission
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
                        <h5>Nature d'admission</h5>
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
                                    Nouvel nature d'admission
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-archive-drawer-line me-2"></i>
                                    Liste des natures d'admissions
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane active show fade" id="twoAAAN" role="tabpanel" aria-labelledby="tab-twoAAAN">
                                <div class="card-header">
                                    <h5 class="card-title text-center">Formulaire Nouvelle Nature Admission</h5>
                                </div>
                                <div class="card-header">
                                    <div class="text-center">
                                        <a class="d-flex align-items-center flex-column">
                                            <img src="{{asset('assets/images/type_admission.jpg')}}" class="img-7x rounded-circle border border-1">
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body" >
                                    <!-- Row starts -->
                                    <div class="row gx-3 align-items-center justify-content-center">
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Type Admission
                                                </label>
                                                <select class="form-select" id="type_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Nature Admission
                                                </label>
                                                <input type="text" class="form-control" id="nom_nature" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button id="btn_eng" class="btn btn-success">
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row ends -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="twoAAA" role="tabpanel" aria-labelledby="tab-twoAAA">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">
                                        Liste des Nature Admissions
                                    </h5>
                                    <div class="d-flex">
                                        <input type="text" id="searchInput" placeholder="Recherche" class="form-control me-1">
                                        <a id="btn_refresh_table" class="btn btn-outline-info ms-auto">
                                            <i class="ri-loop-left-line"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-outer" id="div_Table" style="display: none;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-hover m-0 truncate" id="Table" >
                                                <thead>
                                                    <tr>
                                                        <th scope="col">N°</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Acte</th>
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
                                            Aucune nature d'admission n'a été enregistrer
                                        </p>
                                    </div>
                                    <div id="div_Table_loader" style="display: none;">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                            <strong>Chargement des données...</strong>
                                        </div>
                                    </div>
                                    <div id="pagination-controls"></div>
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
                Voulez-vous vraiment supprimé cette nature d'admission ?
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
                <h5 class="modal-title" >Mise à jour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <input type="hidden" id="Id">
                    <div class="mb-3">
                        <label class="form-label">Nature Admission</label>
                        <input type="text" class="form-control" id="nomModif" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Acte</label>
                        <select class="form-select" id="type_id_modif"></select>
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
    $(document).ready(function() {

        select();
        select_modif();
        list();

        $('#btn_eng').on('click', eng);
        $('#btn_refresh_table').on('click', list);
        $('#updateBtn').on('click', updatee);
        $('#deleteBtn').on('click', deletee);


        function select() {
            const $selectElement = $('#type_id');

            // Clear existing options
            $selectElement.empty();

            // Add default option
            $selectElement.append($('<option>', {
                value: '',
                text: 'Sélectionner un Type d\'admission'
            }));

            $.ajax({
                url: '/api/list_typeadmission',
                method: 'GET',
                success: function(response) {
                    const typeadmissions = response.typeadmission;
                    typeadmissions.forEach(item => {
                        $selectElement.append($('<option>', {
                            value: item.id, // 'id' est la clé correcte
                            text: item.nom  // 'nom' est la clé correcte
                        }));
                    });
                },
                error: function() {
                    // showAlert('danger', 'Impossible de generer le code automatiquement');
                }
            });
        }

        function select_modif() {
            const $selectElement = $('#type_id_modif');
            $selectElement.empty();

            $.ajax({
                url: '/api/list_typeadmission',
                method: 'GET',
                success: function(response) {
                    const typeadmissions = response.typeadmission;
                    typeadmissions.forEach(item => {
                        $selectElement.append($('<option>', {
                            value: item.id, // 'id' est la clé correcte
                            text: item.nom  // 'nom' est la clé correcte
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

        function eng() {

            const type_id = $('#type_id').val().trim();
            const nom = $('#nom_nature').val().trim();

            if(!type_id || !nom) {
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.', 'warning');
                return false;
            }

            const preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            $('body').append(preloader_ch);

            $.ajax({
                url: '/api/new_natureadmission',
                method: 'GET',  // Use 'POST' for data creation
                data: { id: type_id, nom: nom },
                success: function(response) {
                    $('#preloader_ch').remove();

                    if (response.success) {
                        showAlert('Succès', 'Opération effectuée.', 'success');
                    } else if (response.error) {
                        showAlert('Erreur', 'Une erreur est survenue lors de l\'enregistrement.', 'error');
                    }

                    $('#type_id').val('');
                    $('#nom_nature').val('');

                    select_modif();
                    select();
                    list();
                },
                error: function() {
                    $('#preloader_ch').remove();

                    showAlert('Erreur', 'Une erreur est survenue lors de l\'enregistrement.', 'error');

                    $('#type_id').val('');
                    $('#nom_nature').val('');

                    select_modif();
                    select();
                    list();
                }
            });
        }

        function list(page = 1) {
            const tableBody = $('#Table tbody');
            const messageDiv = $('#message_Table');
            const tableDiv = $('#div_Table');
            const loaderDiv = $('#div_Table_loader');

            messageDiv.hide();
            tableDiv.hide();
            loaderDiv.show();

            let allNatureadmissions = [];

            const url = `/api/list_natureadmission?page=${page}`;
            $.get(url, function(data) {
                allNatureadmissions = data.natureadmission || [];
                const pagination = data.pagination || {};

                const perPage = pagination.per_page || 10;
                const currentPage = pagination.current_page || 1;

                if (allNatureadmissions.length > 0) {
                    function displayRows(filteredNatureadmissions) {
                        loaderDiv.hide();
                        messageDiv.hide();
                        tableDiv.show();

                        tableBody.empty();

                        filteredNatureadmissions.forEach((item, index) => {
                            const row = `
                                <tr>
                                    <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a class="d-flex align-items-center flex-column me-2">
                                                <img src="{{asset('assets/images/type_admission.jpg')}}" class="img-2x rounded-circle border border-1">
                                            </a>
                                            ${item.nom}
                                        </div>
                                    </td>
                                    <td>${item.typeadmission}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a class="btn btn-outline-info btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mmodif" id="edit-${item.id}">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            ${item.nbre == '0' ? 
                                                `<a class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mdelete" id="delete-${item.id}">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>` : `` }
                                        </div>
                                    </td>
                                </tr>
                            `;

                            tableBody.append(row);

                            $(`#edit-${item.id}`).on('click', () => {
                                $('#Id').val(item.id);
                                $('#nomModif').val(item.nom);
                                $('#type_id_modif').val(item.typeadmission_id).trigger('change');
                            });

                            const deleteButton = $(`#delete-${item.id}`);
                            if (deleteButton.length) {
                                deleteButton.on('click', () => {
                                    $('#Iddelete').val(item.id);
                                });
                            }
                        });
                    }

                    function applySearchFilter() {
                        const searchTerm = $('#searchInput').val().toLowerCase();
                        const filteredNatureadmissions = allNatureadmissions.filter(item =>
                            item.nom.toLowerCase().includes(searchTerm)
                        );
                        displayRows(filteredNatureadmissions);
                    }

                    $('#searchInput').on('input', applySearchFilter);
                    displayRows(allNatureadmissions);
                    PaginationControls(pagination);

                } else {
                    loaderDiv.hide();
                    messageDiv.show();
                    tableDiv.hide();
                }
            }).fail(function() {
                console.error('Erreur lors du chargement des données');
                loaderDiv.hide();
                messageDiv.show();
                tableDiv.hide();
            });
        }

        function PaginationControls(pagination) {
            const paginationDiv = $('#pagination-controls');
            paginationDiv.empty();

            const paginationWrapper = $('<ul class="pagination justify-content-center"></ul>');

            if (pagination.current_page > 1) {
                const prevButton = $('<li class="page-item"><a class="page-link" href="#">Precédent</a></li>');
                prevButton.on('click', function(event) {
                    event.preventDefault();
                    list(pagination.current_page - 1);
                });
                paginationWrapper.append(prevButton);
            } else {
                paginationWrapper.append('<li class="page-item disabled"><a class="page-link" href="#">Precédent</a></li>');
            }

            const totalPages = pagination.last_page;
            const currentPage = pagination.current_page;
            const maxVisiblePages = 5;

            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (endPage - startPage < maxVisiblePages - 1) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            for (let i = startPage; i <= endPage; i++) {
                const pageItem = $(`<li class="page-item ${i === currentPage ? 'active' : ''}"><a class="page-link" href="#">${i}</a></li>`);
                pageItem.on('click', function(event) {
                    event.preventDefault();
                    list(i);
                });
                paginationWrapper.append(pageItem);
            }

            if (endPage < totalPages) {
                paginationWrapper.append('<li class="page-item disabled"><a class="page-link" href="#">...</a></li>');

                const lastPageItem = $(`<li class="page-item"><a class="page-link" href="#">${totalPages}</a></li>`);
                lastPageItem.on('click', function(event) {
                    event.preventDefault();
                    list(totalPages);
                });
                paginationWrapper.append(lastPageItem);
            }

            if (pagination.current_page < pagination.last_page) {
                const nextButton = $('<li class="page-item"><a class="page-link" href="#">Suivant</a></li>');
                nextButton.on('click', function(event) {
                    event.preventDefault();
                    list(pagination.current_page + 1);
                });
                paginationWrapper.append(nextButton);
            } else {
                paginationWrapper.append('<li class="page-item disabled"><a class="page-link" href="#">Suivant</a></li>');
            }

            paginationDiv.append(paginationWrapper);
        }

        function updatee() {

            const id = $('#Id').val();
            const nomModif = $('#nomModif').val();
            const type_id_modif = $('#type_id_modif').val();

            if (!nomModif.trim() || !type_id_modif.trim()) {
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.', 'warning');
                return false;
            }

            const modal = bootstrap.Modal.getInstance($('#Mmodif')[0]);
            modal.hide();

            const preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            $('body').append(preloader_ch);

            $.ajax({
                url: `/api/update_natureadmission/${id}`,
                method: 'GET',  // Use 'POST' for data creation
                data: { nomModif: nomModif, type_id: type_id_modif },
                success: function(response) {
                    $('#preloader_ch').remove();
                    showAlert('Succès', 'Nature d\'admission mise à jour avec succès.', 'success');

                    list();
                    select();
                    select_modif();
                },
                error: function() {
                    $('#preloader_ch').remove();
                    showAlert('Erreur', 'Erreur lors de la mise à jour.', 'error');
                }
            });
        }

        function deletee() {
            const id = $('#Iddelete').val();

            const modal = bootstrap.Modal.getInstance($('#Mdelete')[0]);
            modal.hide();

            const preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            $('body').append(preloader_ch);

            $.ajax({
                url: `/api/delete_natureadmission/${id}`,
                method: 'GET',  // Use 'POST' for data deletion
                success: function(response) {
                    $('#preloader_ch').remove();
                    showAlert('Succès', 'Nature d\'admission supprimée avec succès.', 'success');

                    list();
                    select();
                    select_modif();
                },
                error: function() {
                    $('#preloader_ch').remove();
                    showAlert('Erreur', 'Erreur lors de la suppression de la nature d\'admission.', 'error');
                }
            });
        }

    });
</script>


@endsection