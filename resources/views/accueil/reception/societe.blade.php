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
            Nouvelle Societe
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
                        <h5>Sociétes.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-3" >
        <div class="col-sm-12">
            <div class="card mb-3">
                <div class="card-body" style="margin-top: -30px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center bg-primary bg-2" id="customTab4" role="tablist" style="background: rgba(0, 0, 0, 0.7);">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-white" id="tab-twoAAAN" data-bs-toggle="tab" href="#twoAAAN" role="tab" aria-controls="twoAAAN" aria-selected="false" tabindex="-1">
                                    <i class="ri-home-7-line me-2"></i>
                                    Nouvelle Société
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-building-4-line me-2"></i>
                                    Liste des Sociétés
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane active show fade" id="twoAAAN" role="tabpanel" aria-labelledby="tab-twoAAAN">
                                <div class="card-header">
                                    <h5 class="card-title">Formulaire Nouvelle Societe</h5>
                                </div>
                                <div class="card-body" >
                                    <div class="row gx-3">
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Nom de la société</label>
                                                <input type="text" class="form-control" id="nom" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
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
                                                <input type="tel2" class="form-control" id="tel2" placeholder="facultatif" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Adresse</label>
                                                <input type="text" class="form-control" id="adresse" placeholder="Saisie Obligatoire">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Fax</label>
                                                <input type="text" class="form-control" id="fax" placeholder="Saisie Obligatoire">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Situation Géographique</label>
                                                <input type="text" class="form-control" id="sgeo" placeholder="Saisie Obligatoire">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <div class="d-flex gap-2 justify-content-start">
                                                <button id="btn_eng" class="btn btn-outline-success">
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
                                        Liste des Sociétés
                                    </h5>
                                    <div class="d-flex">
                                        <input type="text" id="searchInput" placeholder="Société" class="form-control me-1">
                                        <a id="btn_refresh_table" class="btn btn-outline-info ms-auto">
                                            <i class="ri-loop-left-line"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-outer" id="div_Table" style="display: none;">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-hover m-0 truncate" id="Table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">N°</th>
                                                        <th scope="col">Nom</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">contact 1</th>
                                                        <th scope="col">contact 2</th>
                                                        <th scope="col">Adresse</th>
                                                        <th scope="col">Fax</th>
                                                        <th scope="col">Localisation</th>
                                                        <th scope="col">Date de création</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="message_Table" style="display: none;">
                                        <p class="text-center">
                                            Aucune société n'a été trouvée
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

<div class="modal fade" id="Mmodif" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mise à jour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateChambreForm">
                    <input type="hidden" id="Id">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nomModif" oninput="this.value = this.value.toUpperCase()">
                        </div>
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
                        <input type="tel2" class="form-control" id="tel2Modif" placeholder="Facultatif" maxlength="10">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresseModif" placeholder="Saisie Obligatoire">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fax</label>
                        <input type="text" class="form-control" id="faxModif" placeholder="Saisie Obligatoire">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Situation Géographique</label>
                        <input type="text" class="form-control" id="sgeoModif" placeholder="Saisie Obligatoire">
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
                Voulez-vous vraiment supprimé cette Société
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

<script src="{{asset('assets/js/app/js/jspdfinvoicetemplate/dist/index.js')}}" ></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        list();

        document.getElementById("btn_eng").addEventListener("click", eng);
        document.getElementById("updateBtn").addEventListener("click", updatee);
        document.getElementById("deleteBtn").addEventListener("click", deletee);
        document.getElementById("btn_refresh_table").addEventListener("click", list);

        var inputs = ['tel', 'tel2','telModif', 'tel2Modif',]; // Array of element IDs
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

        function showAlert(title, message, type) {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
            });
        }

        function eng()
        {
            const nom = document.getElementById("nom");
            const email = document.getElementById("email");
            const adresse = document.getElementById("adresse");
            const fax = document.getElementById("fax");
            const tel = document.getElementById("tel");
            const tel2 = document.getElementById("tel2");
            const sgeo = document.getElementById("sgeo");

            if(!nom.value.trim() || !email.value.trim() || !adresse.value.trim() || !fax.value.trim() || !tel.value.trim() || !sgeo.value.trim())
            {
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.', 'warning');
                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) { 
                showAlert('Alert', 'Email incorrect.','warning');
                return false;
            }


            if (tel.value.length !== 10 || (tel2.value !== '' && tel2.value.length !== 10)) {
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
                url: '/api/societe_new',
                method: 'GET',
                data: { 
                    nom: nom.value,
                    email: email.value,
                    adresse: adresse.value,
                    fax: fax.value,
                    tel: tel.value,
                    tel2: tel2.value || null,
                    sgeo: sgeo.value,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    if (response.warning) {
                        showAlert('Alert', 'Cette société existe déjà.', 'warning');
                    } else if (response.success) {
                        showAlert('Succès', 'Société Enregistrée.', 'success');
                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.','error');
                    }

                    nom.value = '';
                    email.value = '';
                    adresse.value = '';
                    fax.value = '';
                    tel.value = '';
                    tel2.value = '';
                    sgeo.value = '';

                    list();
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.', 'error');
                }
            });
        }

        function list(page = 1) {

            const tableBody = document.querySelector('#Table tbody');
            const messageDiv = document.getElementById('message_Table');
            const tableDiv = document.getElementById('div_Table');
            const loaderDiv = document.getElementById('div_Table_loader');

            let allSocietes = [];

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const url = `/api/list_societe_all?page=${page}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    allSocietes = data.societe || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    tableBody.innerHTML = '';

                    if (allSocietes.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        function displayRows(filteredSocietes) {
                            tableBody.innerHTML = ''; 

                            filteredSocietes.forEach((item, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                    <td>${item.nom}</td>
                                    <td>${item.email}</td>
                                    <td>${item.tel}</td>
                                    <td>${item.tel2 || 'Néant'}</td>
                                    <td>${item.adresse}</td>
                                    <td>${item.fax}</td>
                                    <td>${item.sgeo}</td>
                                    <td>${formatDateHeure(item.created_at)}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a class="btn btn-outline-info btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mmodif" id="edit-${item.id}">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            
                                        </div>
                                    </td>
                                `;
                                tableBody.appendChild(row);

                                // <a class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mdelete" id="delete-${item.id}">
                                //                 <i class="ri-delete-bin-line"></i>
                                //             </a>

                                document.getElementById(`edit-${item.id}`).addEventListener('click', () => 
                                {
                                    document.getElementById('Id').value = item.id;
                                    document.getElementById('nomModif').value = item.nom;
                                    document.getElementById('emailModif').value = item.email;
                                    document.getElementById('adresseModif').value = item.adresse;
                                    document.getElementById('telModif').value = item.tel;
                                    document.getElementById('tel2Modif').value = item.tel2;
                                    document.getElementById('faxModif').value = item.fax;
                                    document.getElementById('sgeoModif').value = item.sgeo;
                                });

                                // document.getElementById(`delete-${item.id}`).addEventListener('click', () => {
                                //     document.getElementById('Iddelete').value = item.id;
                                // });
                                
                            });
                        };

                        // Update table with filtered factures
                        function applySearchFilter() {
                            const searchTerm = searchInput.value.toLowerCase();
                            const filteredSocietes = allSocietes.filter(item =>
                                item.nom.toLowerCase().includes(searchTerm)
                            );
                            displayRows(filteredSocietes); // Display only filtered factures
                        }

                        searchInput.addEventListener('input', applySearchFilter);

                        displayRows(allSocietes);

                        updatePaginationControls(pagination);

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

        function updatePaginationControls(pagination) {
            const paginationDiv = document.getElementById('pagination-controls');
            paginationDiv.innerHTML = '';

            // Bootstrap pagination wrapper
            const paginationWrapper = document.createElement('ul');
            paginationWrapper.className = 'pagination justify-content-center';

            // Previous button
            if (pagination.current_page > 1) {
                const prevButton = document.createElement('li');
                prevButton.className = 'page-item';
                prevButton.innerHTML = `<a class="page-link" href="#">Precédent</a>`;
                prevButton.onclick = () => list(pagination.current_page - 1);
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
                pageItem.onclick = () => list(i);
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
                lastPageItem.onclick = () => list(totalPages);
                paginationWrapper.appendChild(lastPageItem);
            }

            // Next button
            if (pagination.current_page < pagination.last_page) {
                const nextButton = document.createElement('li');
                nextButton.className = 'page-item';
                nextButton.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                nextButton.onclick = () => list(pagination.current_page + 1);
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

        function updatee() {

            const id = document.getElementById('Id').value;
            const nom = document.getElementById('nomModif');
            const email = document.getElementById("emailModif");
            const adresse = document.getElementById("adresseModif");
            const fax = document.getElementById("faxModif");
            const tel = document.getElementById("telModif");
            const tel2 = document.getElementById("tel2Modif");
            const sgeo = document.getElementById("sgeoModif");

            if(!nom.value.trim() || !email.value.trim() || !adresse.value.trim() || !fax.value.trim() || !tel.value.trim() || !sgeo.value.trim())
            {
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.','warning');
                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) { 
                showAlert('Alert', 'Email incorrect.','warning');
                return false;
            }


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
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/update_societe/'+id,
                method: 'GET',
                data: { 
                    nom: nom.value,
                    email: email.value,
                    adresse: adresse.value,
                    fax: fax.value,
                    tel: tel.value,
                    tel2: tel2.value || null,
                    sgeo: sgeo.value,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Succès', 'Mise à jour éffectuée.','success');
                    list();
                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Alert', 'Erreur lors de la mise à jour de l\'acte.','error');
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

            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/delete_societe/'+id,
                method: 'GET',
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Succès', 'Acte supprimer avec succès.','success');

                    list();
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
