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
            Factures
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
                        <h5>Factures Déposer</h5>
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
                        Liste des Dépôts
                    </h5>
                </div>
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="w-100">
                        <div class="input-group">
                            <span class="input-group-text">Du</span>
                            <input type="date" id="searchDate1" placeholder="Recherche" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                            <span class="input-group-text">au</span>
                            <input type="date" id="searchDate2" placeholder="Recherche" class="form-control me-1" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                            <span class="input-group-text">Statut</span>
                            <select class="form-select me-1" id="statut">
                                <option selected value="tous">Tous</option>
                                <option value="oui">Réglée</option>
                                <option value="non">Non Réglée</option>
                            </select>
                            <a id="btn_search_table" class="btn btn-outline-success ms-auto">
                                <i class="ri-search-2-line"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-outer" id="div_Table" style="display: none;">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover m-0 truncate" id="Table">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Assurance</th>
                                        <th scope="col">Du</th>
                                        <th scope="col">Au</th>
                                        <th scope="col">Date du dépôt</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Part assurance</th>
                                        <th scope="col">Part patient</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">date de création</th>
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
                            Aucun dépôt n'a été trouvé
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
                Voulez-vous vraiment supprimé cet dépôt ?
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

<div class="modal fade" id="Paiement" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >
                    Détail paiement
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="IdPaiement">
                <div class="row gx-3">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Date du dépôt</label>
                            <input readonly type="date" class="form-control" id="date_depotP">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Date du paiement</label>
                            <input type="date" class="form-control" id="date_payer" max="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Type de payement</label>
                            <select class="form-select" id="type_payer">
                                <option value="">Selectionner</option>
                                <option value="virement">Par Virement Bancaire</option>
                                <option value="cheque">Par Chèque</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12" id="div_num_cheque" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label">Numéro du Chèque</label>
                            <div class="input-group">
                                <span class="input-group-text">N°</span>
                                <input type="tel" class="form-control" id="num_cheque_payer" placeholder="Saisie Obligatoire">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btn_paiement" >
                    Enregistrer
                </button>
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
                <div id="updateChambreForm">
                    <input type="hidden" id="IdModif">
                    <input type="hidden" id="assurance_idM">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Du</label>
                            <input type="date" class="form-control" id="date1M" max="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Au</label>
                            <input type="date" class="form-control" id="date2M" max="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Date de dépôt</label>
                            <input type="date" class="form-control" id="date_depotM" max="{{ date('Y-m-d') }}">
                        </div>
                    </div>                                                                                                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="updateBtn">Mettre à jour</button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/app/js/jspdfinvoicetemplate/dist/index.js')}}" ></script>
<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>
<script src="{{asset('jsPDF-AutoTable/dist/jspdf.plugin.autotable.min.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        list();

        document.getElementById("btn_paiement").addEventListener("click", eng_paiement);
        document.getElementById("btn_search_table").addEventListener("click", list);
        document.getElementById("updateBtn").addEventListener("click", updatee);
        document.getElementById("deleteBtn").addEventListener("click", deletee);
        document.getElementById("type_payer").addEventListener("change", num_cheque);

        document.getElementById('num_cheque_payer').addEventListener('input', function()
        {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        function showAlert(title, message, type)
        {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
            });
        }

        function isValidDate(dateString) {
            const regEx = /^\d{4}-\d{2}-\d{2}$/;
            if (!dateString.match(regEx)) return false;
            const date = new Date(dateString);
            const timestamp = date.getTime();
            if (typeof timestamp !== 'number' || isNaN(timestamp)) return false;
            return dateString === date.toISOString().split('T')[0];
        }

        function formatPrice(price)
        {

            // Convert to float and round to the nearest whole number
            let number = Math.round(parseFloat(price));
            if (isNaN(number)) {
                return '';
            }

            // Format the number with dot as thousands separator
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function formatDate(dateString)
        {

            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const year = date.getFullYear();

            return `${day}/${month}/${year}`; // Format as dd/mm/yyyy
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

        function datechangeM()
        {
            const date1Value = document.getElementById('date1M').value;
            const date2 = document.getElementById('date2M');

            date2.value = date1Value;

            date2.min = date1Value;
        }

        function num_cheque() {
            const paymentType = document.getElementById('type_payer').value;
            const divNumCheque = document.getElementById('div_num_cheque');

            document.getElementById('num_cheque_payer').value = "";

            if (paymentType === 'virement') {
                divNumCheque.style.display = 'none';
            } else if (paymentType === 'cheque') {
                divNumCheque.style.display = 'block';
            } else {
                divNumCheque.style.display = 'none';
            }
        }

        function eng_paiement()
        {
            const auth_id = {{ Auth::user()->id }};
            const id = document.getElementById('IdPaiement').value;
            const date_depot = document.getElementById('date_depotP');
            const date = document.getElementById('date_payer');
            const type = document.getElementById('type_payer');
            const cheque = document.getElementById('num_cheque_payer');

            if (!date.value.trim() || !type.value.trim()) {
                showAlert('Alert', 'Tous les champs sont obligatoires.','warning');
                return false; 
            }

            if (type.value === 'cheque' && !cheque.value.trim() ) {
                showAlert('Alert', 'Tous les champs sont obligatoires.', 'warning');
                return false; 
            }

            if (!isValidDate(date.value)) {
                showAlert('Erreur', 'La date de paiement est invalide.', 'error');
                return false;
            }

            const pDate = new Date(date.value);
            const Datedepot = new Date(date_depot.value);

            if (pDate < Datedepot) {
                showAlert('Erreur', 'La date de paiement ne peut pas être inférieure à la date du depôt.', 'error');
                return false;
            }

            var modal = bootstrap.Modal.getInstance(document.getElementById('Paiement'));
            modal.hide();

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/paiement_depot_fac/'+id,
                method: 'GET',
                data: {
                    date: date.value, 
                    type: type.value, 
                    cheque: cheque.value || null,
                    auth_id: auth_id,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {

                        date.value = "";
                        type.value = "";
                        cheque.value = "";

                        list();

                        showAlert('Succès', 'Opération éffectuée','success');

                    } else if (response.error) {

                        showAlert('Informations', 'Echec de l\'opération','info');

                    } else if (response.non_touve) {
                        
                        showAlert('Information', 'Echec de l\'opération: Dépôt introuvable.', 'info');

                    }

                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Alert', ' Une erreur est survenue.','error');
                }
            });
        }

        function list(page = 1)
        {
            const tableBody = document.querySelector('#Table tbody');
            const messageDiv = document.getElementById('message_Table');
            const tableDiv = document.getElementById('div_Table');
            const loaderDiv = document.getElementById('div_Table_loader');

            const date1 = document.getElementById('searchDate1').value;
            const date2 = document.getElementById('searchDate2').value;

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const statut = document.getElementById('statut').value;
            const url = `/api/list_depotfacture/${date1}/${date2}/${statut}?page=${page}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    alldepots = data.depot || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    tableBody.innerHTML = '';

                    if (alldepots.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                            tableBody.innerHTML = ''; 

                            alldepots.forEach((item, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                    <td>
                                        <div class="d-flex align-items-center ">
                                            <a class="d-flex align-items-center flex-column me-2">
                                                <img src="{{asset('assets/images/depot_fac.jpg')}}" class="img-2x rounded-circle">
                                            </a>
                                            ${item.assurance}
                                        </div>
                                    </td>
                                    <td>${formatDate(item.date1)}</td>
                                    <td>${formatDate(item.date2)}</td>
                                    <td>${formatDate(item.date_depot)}</td>
                                    <td>
                                        <span class="badge ${item.statut === 'oui' ? 'bg-success' : 'bg-danger'}">
                                            ${item.statut === 'oui' ? 'Réglée' : 'Non Réglée'}
                                        </span>
                                    </td>
                                    <td>${item.part_assurance} Fcfa</td>
                                    <td>${item.part_patient} Fcfa</td>
                                    <td>${item.total} Fcfa</td>
                                    <td>${formatDateHeure(item.created_at)}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            ${item.statut === 'non' ?  
                                            `<a class="btn btn-outline-success btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Paiement" id="paiement-${item.id}">
                                                <i class="ri-inbox-archive-line"></i>
                                            </a>` : ``}
                                            <a class="btn btn-outline-warning btn-sm rounded-5"  id="detail-${item.id}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            ${item.statut === 'non' ?  
                                            `<a class="btn btn-outline-info btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mmodif" id="modif-${item.id}">
                                                <i class="ri-edit-line"></i>
                                            </a>` : ``}
                                            ${item.statut === 'non' ?  
                                            `<a class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mdelete" id="delete-${item.id}">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>` : ``}
                                            <a class="btn btn-outline-dark btn-sm rounded-5"  id="printer-${item.id}">
                                                <i class="ri-printer-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                `;
                                tableBody.appendChild(row);

                                const deleteButton = document.getElementById(`delete-${item.id}`);
                                if (deleteButton) {
                                    deleteButton.addEventListener('click', () => {
                                        document.getElementById('Iddelete').value = item.id;
                                    });
                                }

                                const updateButton = document.getElementById(`modif-${item.id}`);
                                if (updateButton) {
                                    updateButton.addEventListener('click', () => {

                                        document.getElementById('date1M').value = `${item.date1}`;
                                        document.getElementById('date2M').value = `${item.date2}`;
                                        document.getElementById('date_depotM').value = `${item.date_depot}`;
                                        document.getElementById('IdModif').value = `${item.id}`;
                                        document.getElementById('assurance_idM').value = `${item.assurance_id}`;

                                    });
                                }

                                const paieButton = document.getElementById(`paiement-${item.id}`);
                                if (paieButton) {
                                    paieButton.addEventListener('click', () => {

                                        document.getElementById('date_payer').value = "";
                                        document.getElementById('type_payer').value = "";
                                        document.getElementById('num_cheque_payer').value = "";

                                        document.getElementById('IdPaiement').value = `${item.id}`;
                                        document.getElementById('date_depotP').value = `${item.date_depot}`;

                                    });
                                }

                                document.getElementById(`detail-${item.id}`).addEventListener('click', () => {

                                    var preloader_ch = `
                                        <div id="preloader_ch">
                                            <div class="spinner_preloader_ch"></div>
                                        </div>
                                    `;
                                    // Add the preloader to the body
                                    document.body.insertAdjacentHTML('beforeend', preloader_ch);

                                    fetch(`/api/imp_fac_depot/${item.id}`)
                                            .then(response => response.json())
                                            .then(data => {

                                                var preloader = document.getElementById('preloader_ch');
                                                if (preloader) {
                                                    preloader.remove();
                                                }

                                                const societes = data.societes;
                                                const assurance = data.assurance;
                                                const date1 = data.date1;
                                                const date2 = data.date2;

                                                if (societes.length > 0) {

                                                    generatePDFInvoice_Fac(societes,assurance,date1,date2);

                                                } else {

                                                    showAlert('Informations', 'Aucune donnée n\'a été trouvée pour cette période','info');
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Erreur lors du chargement des données:', error);
                                            });
                                });

                                document.getElementById(`printer-${item.id}`).addEventListener('click', () => {

                                    var preloader_ch = `
                                        <div id="preloader_ch">
                                            <div class="spinner_preloader_ch"></div>
                                        </div>
                                    `;
                                    // Add the preloader to the body
                                    document.body.insertAdjacentHTML('beforeend', preloader_ch);

                                    fetch(`/api/imp_fac_depot_bordo/${item.id}`)
                                            .then(response => response.json())
                                            .then(data => {

                                                var preloader = document.getElementById('preloader_ch');
                                                if (preloader) {
                                                    preloader.remove();
                                                }

                                                const societes = data.societes;
                                                const assurance = data.assurance;
                                                const date1 = data.date1;
                                                const date2 = data.date2;
                                                const statut = item.statut;
                                                const date_paiement = formatDate(item.date_payer);
                                                const type = item.type_paiement;
                                                const cheque = item.num_cheque;

                                                if (societes.length > 0) {

                                                    generatePDFInvoice_Fac_Bordo(societes,assurance,date1,date2,statut,date_paiement,type,cheque);

                                                } else {

                                                    showAlert('Informations', 'Aucune donnée n\'a été trouvée pour cette période','info');
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Erreur lors du chargement des données:', error);
                                            });
                                });

                            });

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

        function updatePaginationControls(pagination)
        {
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

        function updatee()
        {
            const id = document.getElementById('IdModif').value;
            const assurance_id = document.getElementById('assurance_idM');
            const date1 = document.getElementById('date1M');
            const date2 = document.getElementById('date2M');
            const date_depot = document.getElementById('date_depotM');

            if (!date1.value.trim() || !date2.value.trim() || !date_depot.value.trim()) {
                showAlert('Alert', 'Tous les champs sont obligatoires.','warning');
                return false; 
            }

            if (!isValidDate(date1.value)) {
                showAlert('Erreur', 'La première date est invalide.', 'error');
                return false;
            }

            if (!isValidDate(date2.value)) {
                showAlert('Erreur', 'La deuxième date est invalide.', 'error');
                return false;
            }

            if (!isValidDate(date_depot.value)) {
                showAlert('Erreur', 'La deuxième date est invalide.', 'error');
                return false;
            }

            const startDate = new Date(date1.value);
            const endDate = new Date(date2.value);
            const Datedepot = new Date(date_depot.value);

            if (startDate > endDate) {
                showAlert('Erreur', 'La date de début ne peut pas être supérieur à la date de fin.', 'error');
                return false;
            }

            if (endDate > Datedepot) {
                showAlert('Erreur', 'La date du dépôt ne peut pas être supérieur à la date de fin.', 'error');
                return false;
            }

            const oneYearInMs = 365 * 24 * 60 * 60 * 1000;
            if (endDate - startDate > oneYearInMs) {
                showAlert('Erreur', 'La plage de dates ne peut pas dépasser un an.', 'error');
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
                url: '/api/update_depot_fac/' + id,
                method: 'GET',
                data: {
                    date1: date1.value, 
                    date2: date2.value, 
                    date_depot: date_depot.value,
                    assurance_id: assurance_id.value,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {

                        date1.value = "";
                        date2.value = "";
                        date_depot.value = "";

                        list();

                        showAlert('Succès', 'Opération éffectuée','success');

                    } else if (response.error) {

                        showAlert('Informations', 'Echec de l\'opération','info');

                    } else if (response.existe) {
                        
                        showAlert('Informations', 'L\'intervalle de dates choisi se trouve dans l\'intervalle de certaines factures qui ont déjà été déposées.', 'info');

                    } else if (response.non_touve) {
                        
                        showAlert('Informations', 'Echec de l\'opération: Dépôt introuvable.', 'info');

                    }

                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Alert', ' Une erreur est survenue.','error');
                }
            });
        }

        function deletee()
        {

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
                url: '/api/delete_depotfacture/'+id,
                method: 'GET',
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {
                        list();
                        showAlert('Succès', 'Opération éffectuée.','success');
                    } else if (response.error) {
                        showAlert('Erreur', 'Echec de l\'opération.','error');
                    }
                      
                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Erreur', 'Erreur est survenue.','error');
                }
            });
        }

        function generatePDFInvoice_Fac(societes,assurance,date1,date2) {

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'l', unit: 'mm', format: 'a4' });

            const pdfFilename = "FACTURES EMISES du " + formatDate(date1) + " au " + formatDate(date2);
            doc.setProperties({
                title: pdfFilename,
            });

            let yPos = 10;

            function drawSection(yPos) {

                rightMargin = 15;
                leftMargin = 15;
                pdfWidth = doc.internal.pageSize.getWidth();

                doc.setFontSize(10);
                doc.setTextColor(0, 0, 0);
                doc.setFont("Helvetica", "bold");

                const logoSrc = "{{asset('assets/images/logo.png')}}";
                const logoWidth = 22;
                const logoHeight = 22;
                doc.addImage(logoSrc, 'PNG', leftMargin, yPos - 7, logoWidth, logoHeight);

                const title = "ESPACE MEDICO SOCIAL LA PYRAMIDE DU COMPLEXE";
                const titleWidth = doc.getTextWidth(title);
                const titleX = (doc.internal.pageSize.getWidth() - titleWidth) / 2;
                doc.text(title, titleX, yPos);

                doc.setFont("Helvetica", "normal");
                const address = "Abidjan Yopougon Selmer, Non loin du complexe sportif Jesse-Jackson - 04 BP 1523";
                const addressWidth = doc.getTextWidth(address);
                const addressX = (doc.internal.pageSize.getWidth() - addressWidth) / 2;
                doc.text(address, addressX, (yPos + 5));

                const phone = "Tél.: 20 24 44 70 / 20 21 71 92 - Cel.: 01 01 01 63 43";
                const phoneWidth = doc.getTextWidth(phone);
                const phoneX = (doc.internal.pageSize.getWidth() - phoneWidth) / 2;
                doc.text(phone, phoneX, (yPos + 10));

                // Définir le style pour le texte
                doc.setFontSize(12);
                doc.setFont("Helvetica", "bold");
                doc.setLineWidth(0.5);
                doc.setTextColor(0, 0, 0);

                const titleR = "LISTE DES FACTURES PAR ASSURANCE : " + assurance.nom;
                const titleRWidth = doc.getTextWidth(titleR);
                const titleRX = (doc.internal.pageSize.getWidth() - titleRWidth) / 2;

                const paddingh = 5;  // Ajuster le padding en hauteur
                const paddingw = 5;  // Ajuster le padding en largeur

                const rectX = titleRX - paddingw;
                let rectY = yPos + 18; // Position initiale du rectangle
                const rectWidth = titleRWidth + (paddingw * 2);
                const rectHeight = 15 + (paddingh * 2);

                doc.setDrawColor(0, 0, 0);
                doc.rect(rectX, rectY, rectWidth, rectHeight);

                // Centrer le texte dans le rectangle
                const textY = rectY + (rectHeight / 2) - 2;  // Ajustement de la position Y du texte pour centrer verticalement
                doc.text(titleR, titleRX, textY);

                // Ajout de la date sous le titre avec un saut de ligne
                const dateText = "du : " + formatDate(date1) + " au " + formatDate(date2); // Assurez-vous que formatDate est une fonction qui formate la date comme vous le souhaitez
                const dateTextWidth = doc.getTextWidth(dateText);
                const dateTextX = (doc.internal.pageSize.getWidth() - dateTextWidth) / 2; // Centrer la date

                // Positionner la date sous le rectangle
                doc.text(dateText, dateTextX, textY + 10);  // Ajuster `+ 10` selon l'espace souhaité entre le titre et la date


                yPoss = (yPos + 40);

                let grandTotalAssurance = 0;
                let grandTotalPatient = 0;
                let grandTotalMontant = 0;

                if (societes.length > 0) {
                    societes.forEach((societe, indexSociete) => {
                        const fac_cons = societe.fac_cons || [];
                        const fac_exam = societe.fac_exam || [];
                        const fac_soinsam = societe.fac_soinsam || [];
                        const fac_hopital = societe.fac_hopital || [];

                        // Fusionner consultations, examens et soins ambulatoires dans un tableau unique
                        const fac_global = [
                            ...fac_cons.map(item => ({
                                ...item,
                                acte: 'Consultation',
                            })),
                            ...fac_exam.map(item => ({
                                ...item,
                                acte: 'Examen',
                            })),
                            ...fac_soinsam.map(item => ({
                                ...item,
                                acte: 'Soins Ambulatoire',
                            })),
                            ...fac_hopital.map(item => ({
                                ...item,
                                acte: 'Hospitalisation',
                            })),
                        ];

                        if (fac_global.length > 0) {
                            // Titre de la société
                            yPoss += 20;
                            
                            doc.setFontSize(14);
                            doc.setFont("Helvetica", "bold");
                            doc.setTextColor(0, 0, 0);
                            const text = "Société " + societe.nom;
                            const textWidth = doc.getTextWidth(text);
                            const pageWidth = doc.internal.pageSize.getWidth();
                            const centerX = (pageWidth - textWidth) / 2;
                            doc.text(text, centerX, yPoss);
                            const underlineY = yPoss + 2;
                            doc.setLineWidth(0.5);
                            doc.setDrawColor(0, 0, 0);
                            doc.line(centerX, underlineY, centerX + textWidth, underlineY);
                            
                            yPoss += 10;

                            // Générer le tableau unique pour consultations, examens et soins ambulatoires
                            const sortedFacGlobal = fac_global.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                            doc.autoTable({
                                startY: yPoss,
                                head: [['N°', 'Date', 'Numéro de Bon', 'Patient', 'Acte effectué', 'Montant Total', 'Part Assurance', 'Part assuré']],
                                body: sortedFacGlobal.map((item, index) => [
                                    index + 1,
                                    formatDate(item.created_at) || '',
                                    item.num_bon || '',
                                    item.patient || '',
                                    item.acte,
                                    (item.montant || '') + " Fcfa",
                                    (item.part_assurance || '') + " Fcfa",
                                    (item.part_patient || '') + " Fcfa",
                                ]),
                                theme: 'striped',
                            });

                            const finalY = doc.autoTable.previous.finalY || yPoss + 10;
                            yPoss = finalY + 10;

                            // Calculer les totaux pour la société
                            const totalAssurance = fac_global.reduce((sum, item) => sum + parseInt(item.part_assurance.replace(/[^0-9]/g, '') || 0), 0);
                            const totalPatient = fac_global.reduce((sum, item) => sum + parseInt(item.part_patient.replace(/[^0-9]/g, '') || 0), 0);
                            const totalMontant = fac_global.reduce((sum, item) => sum + parseInt(item.montant.replace(/[^0-9]/g, '') || 0), 0);

                            // Ajouter les totaux de cette société aux grands totaux
                            grandTotalAssurance += totalAssurance;
                            grandTotalPatient += totalPatient;
                            grandTotalMontant += totalMontant;

                            const finalInfo = [
                                { label: "Total Assurance", value: formatPrice(totalAssurance) + " Fcfa" },
                                { label: "Total Patient", value: formatPrice(totalPatient) + " Fcfa" },
                                { label: "Montant Total", value: formatPrice(totalMontant) + " Fcfa" },
                            ];

                            // Afficher les totaux après le tableau pour chaque société
                            finalInfo.forEach(info => {
                                doc.setFontSize(11);
                                doc.setFont("Helvetica", "bold");
                                doc.text(info.label, leftMargin, yPoss);
                                doc.setFont("Helvetica", "normal");
                                doc.text(": " + info.value, leftMargin + 50, yPoss);
                                yPoss += 7;
                            });

                            // Sauter une page si nécessaire après chaque société
                            if (indexSociete < societes.length - 1) {
                                doc.addPage();
                                yPoss = 20; // Réinitialiser la position pour la nouvelle page
                            }
                        }
                    });

                    // Ajouter une nouvelle page pour les grands totaux
                    doc.addPage();
                    yPoss = 20;

                    // Afficher les grands totaux sur cette page
                    doc.setFontSize(14);
                    doc.setFont("Helvetica", "bold");
                    doc.text("TOTAL DES FACTURES", 15, yPoss);
                    yPoss += 10;

                    const grandTotalInfo = [
                        { label: "Total Assurance", value: formatPrice(grandTotalAssurance) + " Fcfa" },
                        { label: "Total Patient", value: formatPrice(grandTotalPatient) + " Fcfa" },
                        { label: "Montant Total", value: formatPrice(grandTotalMontant) + " Fcfa" },
                    ];

                    // Afficher les grands totaux sur la nouvelle page
                    grandTotalInfo.forEach(info => {
                        doc.setFontSize(11);
                        doc.setFont("Helvetica", "bold");
                        doc.text(info.label, leftMargin, yPoss);
                        doc.setFont("Helvetica", "normal");
                        doc.text(": " + info.value, leftMargin + 50, yPoss);
                        yPoss += 7;
                    });
                }

            }

            function addFooter() {
                // Add footer with current date and page number in X/Y format
                const pageCount = doc.internal.getNumberOfPages();
                const footerY = doc.internal.pageSize.getHeight() - 2; // 10 mm from the bottom

                for (let i = 1; i <= pageCount; i++) {
                    doc.setPage(i);
                    doc.setFontSize(8);
                    doc.setTextColor(0, 0, 0);
                    const pageText = `Page ${i} sur ${pageCount}`;
                    const pageTextWidth = doc.getTextWidth(pageText);
                    const centerX = (doc.internal.pageSize.getWidth() - pageTextWidth) / 2;
                    doc.text(pageText, centerX, footerY);
                    doc.text("Imprimé le : " + new Date().toLocaleDateString() + " à " + new Date().toLocaleTimeString(), 15, footerY); // Left-aligned
                }
            }

            drawSection(yPos);

            addFooter();

            doc.output('dataurlnewwindow');
        }

        function generatePDFInvoice_Fac_Bordo(societes,assurance,date1,date2,statut,date_paiement,type,cheque) {

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });

            const pdfFilename = "BORDEREAUX DES FACTURES EMISES DEPOSER. Du " + formatDate(date1) + " au " + formatDate(date2);
            doc.setProperties({
                title: pdfFilename,
            });

            let yPos = 10;

            function drawSection(yPos) {

                rightMargin = 15;
                leftMargin = 15;
                pdfWidth = doc.internal.pageSize.getWidth();

                doc.setFontSize(10);
                doc.setTextColor(0, 0, 0);
                doc.setFont("Helvetica", "bold");

                const logoSrc = "{{asset('assets/images/logo.png')}}";
                const logoWidth = 22;
                const logoHeight = 22;
                doc.addImage(logoSrc, 'PNG', leftMargin, yPos - 7, logoWidth, logoHeight);

                const title = "ESPACE MEDICO SOCIAL LA PYRAMIDE DU COMPLEXE";
                const titleWidth = doc.getTextWidth(title);
                const titleX = (doc.internal.pageSize.getWidth() - titleWidth) / 2;
                doc.text(title, titleX, yPos);

                doc.setFont("Helvetica", "normal");
                const address = "Abidjan Yopougon Selmer, Non loin du complexe sportif Jesse-Jackson - 04 BP 1523";
                const addressWidth = doc.getTextWidth(address);
                const addressX = (doc.internal.pageSize.getWidth() - addressWidth) / 2;
                doc.text(address, addressX, (yPos + 5));

                const phone = "Tél.: 20 24 44 70 / 20 21 71 92 - Cel.: 01 01 01 63 43";
                const phoneWidth = doc.getTextWidth(phone);
                const phoneX = (doc.internal.pageSize.getWidth() - phoneWidth) / 2;
                doc.text(phone, phoneX, (yPos + 10));

                // Définir le style pour le texte
                doc.setFontSize(12);
                doc.setFont("Helvetica", "bold");
                doc.setLineWidth(0.5);
                doc.setTextColor(0, 0, 0);

                const titleR = "BORDEREAUX PAR ASSURANCE : " + assurance.nom;
                const titleRWidth = doc.getTextWidth(titleR);
                const titleRX = (doc.internal.pageSize.getWidth() - titleRWidth) / 2;

                const paddingh = 5;  // Ajuster le padding en hauteur
                const paddingw = 5;  // Ajuster le padding en largeur

                const rectX = titleRX - paddingw;
                let rectY = yPos + 18; // Position initiale du rectangle
                const rectWidth = titleRWidth + (paddingw * 2);
                const rectHeight = 15 + (paddingh * 2);

                doc.setDrawColor(0, 0, 0);
                doc.rect(rectX, rectY, rectWidth, rectHeight);

                // Centrer le texte dans le rectangle
                const textY = rectY + (rectHeight / 2) - 2;  // Ajustement de la position Y du texte pour centrer verticalement
                doc.text(titleR, titleRX, textY);

                // Ajout de la date sous le titre avec un saut de ligne
                const dateText = "du : " + formatDate(date1) + " au " + formatDate(date2); // Assurez-vous que formatDate est une fonction qui formate la date comme vous le souhaitez
                const dateTextWidth = doc.getTextWidth(dateText);
                const dateTextX = (doc.internal.pageSize.getWidth() - dateTextWidth) / 2; // Centrer la date
                // Positionner la date sous le rectangle
                doc.text(dateText, dateTextX, textY + 10);

                yPoss = (yPos + 50);

                const pageWidth = doc.internal.pageSize.getWidth();
                let text;
                if (statut === 'oui') {
                    if (type === 'virement') {
                        text = "Paiement effectué le " + date_paiement + " par Virement Bancaire";
                    } else if (type === 'cheque') {
                        text = "Paiement effectué le " + date_paiement + " par Chèque. N°" + cheque;
                    }
                } else {
                    text = "Paiement non effectué";
                }
                doc.setFontSize(12);
                doc.setFont("Helvetica", "bold");
                if (statut === 'oui') {
                    doc.setTextColor(0, 128, 0);
                } else {
                    doc.setTextColor(255, 0, 0);
                }
                const textWidth = doc.getTextWidth(text);
                const xPos = (pageWidth - textWidth) / 2;
                doc.text(text, xPos, yPoss);


                yPoss += 5;

                if (societes.length > 0) {

                    doc.autoTable({
                        startY: yPoss,
                        head: [['N°', 'Société', 'Montant Total', 'Part Assurance', 'Part assuré']],
                        body: societes.map((item, index) => [
                            index + 1,
                            item.nom || '',
                            (item.total_montant || '') + " Fcfa",
                            (item.total_assurance || '') + " Fcfa",
                            (item.total_patient || '') + " Fcfa",
                        ]),
                        theme: 'striped',
                    });

                    const finalY = doc.autoTable.previous.finalY || yPoss + 10;
                    yPoss = finalY + 10;

                    // Totals
                    const totalAssurance = societes.reduce((sum, item) => sum + parseInt(item.total_assurance.replace(/[^0-9]/g, '') || 0), 0);
                    const totalPatient = societes.reduce((sum, item) => sum + parseInt(item.total_patient.replace(/[^0-9]/g, '') || 0), 0);
                    const totalMontant = societes.reduce((sum, item) => sum + parseInt(item.total_montant.replace(/[^0-9]/g, '') || 0), 0);

                    doc.setFontSize(14);
                    doc.setFont("Helvetica", "bold");
                    doc.setTextColor(0, 0, 0);
                    doc.text("TOTAL DES FACTURES", 15, yPoss);
                    yPoss += 10;

                    const finalInfo = [
                        { label: "Total Assurance", value: formatPrice(totalAssurance) + " Fcfa" },
                        { label: "Total Patient", value: formatPrice(totalPatient) + " Fcfa" },
                        { label: "Montant Total", value: formatPrice(totalMontant) + " Fcfa" },
                    ];

                    finalInfo.forEach(info => {
                        doc.setFontSize(11);
                        doc.setTextColor(0, 0, 0);
                        doc.setFont("Helvetica", "bold");
                        doc.text(info.label, leftMargin, yPoss);
                        doc.setFont("Helvetica", "normal");
                        doc.text(": " + info.value, leftMargin + 50, yPoss);
                        yPoss += 7;
                    });
                }

            }

            function addFooter() {
                // Add footer with current date and page number in X/Y format
                const pageCount = doc.internal.getNumberOfPages();
                const footerY = doc.internal.pageSize.getHeight() - 2; // 10 mm from the bottom

                for (let i = 1; i <= pageCount; i++) {
                    doc.setPage(i);
                    doc.setFontSize(8);
                    doc.setTextColor(0, 0, 0);
                    const pageText = `Page ${i} sur ${pageCount}`;
                    const pageTextWidth = doc.getTextWidth(pageText);
                    const centerX = (doc.internal.pageSize.getWidth() - pageTextWidth) / 2;
                    doc.text(pageText, centerX, footerY);
                    doc.text("Imprimé le : " + new Date().toLocaleDateString() + " à " + new Date().toLocaleTimeString(), 15, footerY); // Left-aligned
                }
            }

            drawSection(yPos);

            addFooter();

            doc.output('dataurlnewwindow');
        }

    });
</script>

@endsection


