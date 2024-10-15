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
            Liste des consultations
        </li>
        <li class="breadcrumb-item" style="display: block;" id="div_btn_affiche_stat">
            <a class="btn btn-sm btn-warning" id="btn_affiche_stat">
                Afficher les Statstiques
            </a>
        </li>
        <li class="breadcrumb-item" style="display: none;" id="div_btn_cache_stat">
            <a class="btn btn-sm btn-danger" id="btn_cache_stat">
                Cacher les Statstiques
            </a>
        </li>
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <div class="row gx-3 mb-3" id="stat_consultation"></div>
    <div class="row gx-3">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        Liste des Conultations
                    </h5>
                    <div class="d-flex">
                        <input type="text" id="searchInputC" placeholder="N° Consultation" class="form-control me-1">
                        <a id="btn_refresh_tableC" class="btn btn-outline-info ms-auto">
                            <i class="ri-loop-left-line"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div id="div_alert_tableC">
                    </div>
                    <div class="table-outer" id="div_TableC" style="display: none;">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover m-0 truncate" id="TableC">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">N° dossier</th>
                                        <th scope="col">Nom et Prénoms</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Médecin</th>
                                        <th scope="col">Spécialité</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="message_TableC" style="display: none;">
                        <p class="text-center">
                            Aucune Consultation n'a été trouvée
                        </p>
                    </div>
                    <div id="div_Table_loaderC" style="display: none;">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                            <strong>Chargement des données...</strong>
                        </div>
                    </div>
                    <div id="pagination-controlsC"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="CDetail" tabindex="-1" aria-modal="true" role="dialog" >
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalXlLabel">
                    Détail facture
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="div_TableDC" style="display: none;" >
                    <div class="row">
                        <div class="col-xxl-3 col-sm-3 col-12">
                            <img height="100" width="100" src="{{asset('assets/images/facture.webp')}}" alt="Bootstrap Admin Dashboard" class="img-fluid">
                        </div>
                        <div class="col-sm-9 col-12">
                            <div class="text-end" id="fac_detail">
                                
                            </div>
                        </div>
                        <div class="col-12 mb-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="div_alert_tableDC" >
                        
                                            </div>
                                            <div class="table-responsive" >
                                                <table class="table " id="TableDC">
                                                    <thead>
                                                        <tr>
                                                            <th width="100px" >Code</th>
                                                            <th colspan="2">Description</th>
                                                            <th width="120px" >Part Assurance</th>
                                                            <th width="50px" >Taux</th>
                                                            <th width="100px" >Remise</th>
                                                            <th width="120px" >Part Patient</th>
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
                <div class="row" id="message_TableDC" style="display: none;">
                    <div class="col-12 " >
                        <div class="mb-3" >
                            <p class="text-center" >
                                Aucune facture disponible
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row" id="div_Table_loaderDC" style="display: none;">
                    <div class="col-12 " >
                        <div class="mb-3">
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

{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
{{-- <script src="https://unpkg.com/jspdf-invoice-template@1.4.4/dist/index.js"></script> --}}
<script src="{{asset('assets/js/app/js/jspdfinvoicetemplate/dist/index.js')}}" ></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        list_cons_all();

        document.getElementById("btn_refresh_tableC").addEventListener("click", list_cons_all);

        document.getElementById('btn_affiche_stat').addEventListener('click',function(){

            document.getElementById('div_btn_affiche_stat').style.display = 'none';
            document.getElementById('div_btn_cache_stat').style.display = 'block';

            Statistique_cons();
        });

        document.getElementById('btn_cache_stat').addEventListener('click',function(){

            document.getElementById('div_btn_affiche_stat').style.display = 'block';
            document.getElementById('div_btn_cache_stat').style.display = 'none';

            const stat_consultation = document.getElementById("stat_consultation");
            stat_consultation.innerHTML = '';
        });

        function formatPrice(input) {
            // Remove all non-numeric characters except the comma
            input = input.replace(/[^\d,]/g, '');

            // Convert comma to dot for proper float conversion
            input = input.replace(',', '.');

            // Convert to float and round to the nearest whole number
            let number = Math.round(parseFloat(input));
            if (isNaN(number)) {
                return '';
            }

            // Format the number with dot as thousands separator
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function formatPriceT(price) {

            // Convert to float and round to the nearest whole number
            let number = Math.round(parseInt(price));
            if (isNaN(number)) {
                return '';
            }

            // Format the number with dot as thousands separator
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function formatDate(dateString) {
                const date = new Date(dateString);
                
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                const year = date.getFullYear();
                
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                const seconds = String(date.getSeconds()).padStart(2, '0');
                
                return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`; // Format as dd/mm/yyyy hh:mm:ss
        }

        // ------------------------------------------------------------------

        function Statistique_cons() {

            const stat_consultation = document.getElementById("stat_consultation");

            const div = document.createElement('div');
            div.innerHTML = `
                <div class="d-flex justify-content-center align-items-center">
                    <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                    <strong>Chargement des données...</strong>
                </div>
            `;
            stat_consultation.appendChild(div);


            fetch('/api/statistique_cons') // API endpoint
                .then(response => response.json())
                .then(data => {

                    const typeactes = data.typeacte;
                    stat_consultation.innerHTML = '';

                    if (typeactes.length > 0) {

                        // Loop through each item in the chambre array
                        typeactes.forEach((item, index) => {
                            // Create a new row
                            const row = document.createElement('div');
                            row.className = "col-xl-3 col-sm-6 col-12";
                            // Create and append cells to the row based on your table's structure
                            row.innerHTML = `
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="p-2 border border-primary rounded-circle me-3">
                                                <div class="icon-box md bg-primary-subtle rounded-5">
                                                    <i class="ri-stethoscope-line fs-4 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h5 class="lh-1">
                                                    ${item.nom}
                                                </h5>
                                                <p class="m-0">
                                                    ${item.nbre} Consultation(s)
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-1">
                                            <div class="text-start">
                                                <p class="mb-0 text-primary">Part Assurance</p>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-0 text-primary">
                                                    ${formatPrice(item.part_assurance.toString())} Fcfa
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-1">
                                            <div class="text-start">
                                                <p class="mb-0 text-primary">Part Patient</p>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-0 text-primary">
                                                    ${formatPrice(item.part_patient.toString())} Fcfa
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-1">
                                            <div class="text-start">
                                                <p class="mb-0 text-primary">Montant Total</p>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-0 text-primary">
                                                    ${formatPrice(item.total.toString())} Fcfa
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            // Append the row to the table body
                            stat_consultation.appendChild(row);

                        });
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des données:', error);
                });
        }

        // ------------------------------------------------------------------

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

        function list_cons_all(page = 1) {

            const tableBody = document.querySelector('#TableC tbody');
            const messageDiv = document.getElementById('message_TableC');
            const tableDiv = document.getElementById('div_TableC'); // The message div
            const loaderDiv = document.getElementById('div_Table_loaderC');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            let allCons = [];

            // Fetch data from the API
            const url = `/api/list_cons_all?page=${page}`;
            fetch(url) // API endpoint
                .then(response => response.json())
                .then(data => {
                    // Access the 'chambre' array from the API response
                    allCons = data.consultation || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    // Clear any existing rows in the table body
                    tableBody.innerHTML = '';

                    if (allCons.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        function displayRows(filteredCons) {
                            tableBody.innerHTML = ''; 

                            // Loop through each item in the chambre array
                            filteredCons.forEach((item, index) => {
                                // Create a new row
                                const row = document.createElement('tr');
                                // Create and append cells to the row based on your table's structure
                                row.innerHTML = `
                                    <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                    <td>C-${item.code}</td>
                                    <td>P-${item.matricule}</td>
                                    <td>${item.name}</td>
                                    <td>+225 ${item.tel}</td>
                                    <td>${item.medecin}</td>  
                                    <td>${item.type_motif}</td>
                                    <td>${item.montant} Fcfa</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#CDetail" id="Cdetail-${item.id}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a class="btn btn-outline-warning btn-sm" id="Cfacture-${item.code}">
                                                <i class="ri-printer-line"></i>
                                            </a>
                                            <a class="btn btn-outline-info btn-sm" id="Cfiche-${item.code}">
                                                <i class="ri-file-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                `;
                                // Append the row to the table body
                                tableBody.appendChild(row);

                                document.getElementById(`Cfiche-${item.code}`).addEventListener('click', () =>
                                {
                                    fetch(`/api/fiche_consultation/${item.code}`) // API endpoint
                                        .then(response => response.json())
                                        .then(data => {
                                            // Access the 'chambre' array from the API response
                                            const patient = data.patient;
                                            const typeacte = data.typeacte;
                                            const user = data.user;
                                            const consultation = data.consultation;

                                            generatePDFficheCons(patient, user, typeacte, consultation);

                                        })
                                        .catch(error => {
                                            console.error('Erreur lors du chargement des données:', error);
                                        });
                                });

                                document.getElementById(`Cfacture-${item.code}`).addEventListener('click', () =>
                                {
                                    fetch(`/api/fiche_consultation/${item.code}`) // API endpoint
                                        .then(response => response.json())
                                        .then(data => {
                                            // Access the 'chambre' array from the API response
                                            const patient = data.patient;
                                            const typeacte = data.typeacte;
                                            const user = data.user;
                                            const consultation = data.consultation;

                                            generatePDFInvoice(patient, user, typeacte, consultation);

                                        })
                                        .catch(error => {
                                            console.error('Erreur lors du chargement des données:', error);
                                        });
                                });

                                document.getElementById(`Cdetail-${item.id}`).addEventListener('click', () => 
                                {
                                    const tableBodyD = document.querySelector('#TableDC tbody');
                                    const messageDivD = document.getElementById('message_TableDC');
                                    const tableDivD = document.getElementById('div_TableDC');
                                    const loaderDivD = document.getElementById('div_Table_loaderDC');

                                    messageDivD.style.display = 'none';
                                    tableDivD.style.display = 'none';
                                    loaderDivD.style.display = 'block';

                                    fetch(`/api/list_facture_inpayer_d/${item.id}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            const factureds = data.factured;
                                            const total = data.Total;

                                            const id = data.ID.code_fac;
                                            const date_fac = data.ID.date_fac;
                                            const statutValue = data.ID.statut;
                                            const date_paye = data.ID.date_paye;

                                            const fac_detail = document.getElementById('fac_detail');
                                            fac_detail.innerHTML = '';

                                            const para = document.createElement('p');
                                            para.className = "mb-2";
                                            para.innerHTML = `N° Facture - <span class="text-primary">${id}</span>`;
                                            fac_detail.appendChild(para);

                                            const date0 = document.createElement('p');
                                            date0.className = "mb-2";
                                            date0.innerHTML = `Date de création ${formatDateHeure(date_fac)}`;
                                            fac_detail.appendChild(date0);

                                            if (date_paye) {
                                                const date = document.createElement('p');
                                                date.className = "mb-2";
                                                date.innerHTML = `Date de paiement ${formatDateHeure(date_paye)}`;
                                                fac_detail.appendChild(date);
                                            }

                                            const statutElement = document.createElement('span');
                                            if (statutValue === 'payer') {
                                                statutElement.className = "badge bg-success";
                                                statutElement.innerHTML = `Facture Réglée`;
                                            } else {
                                                statutElement.className = "badge bg-danger";
                                                statutElement.innerHTML = `Facture Non Réglée`;
                                            }
                                            fac_detail.appendChild(statutElement);

                                            tableBodyD.innerHTML = '';

                                            if (factureds.length > 0) {
                                                loaderDivD.style.display = 'none';
                                                messageDivD.style.display = 'none';
                                                tableDivD.style.display = 'block';

                                                factureds.forEach((item, index) => {
                                                    // Create a new row
                                                    const row = document.createElement('tr');
                                                    // Create and append cells to the row based on your table's structure
                                                    row.innerHTML = `
                                                        <td><h6>C-${item.code}</h6></td>
                                                        <td colspan="2" >
                                                            <h6>${item.nom_acte}</h6>
                                                            <p>
                                                                ${item.nom_typeacte}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-primary" >
                                                                ${item.part_assurance} Fcfa
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-primary" >
                                                                ${item.taux ?? 0}%
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-primary">
                                                                ${item.remise ?? 0} Fcfa
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-success" >
                                                                ${item.part_patient} Fcfa
                                                            </h6>
                                                        </td>
                                                    `;
                                                    // Append the row to the table body
                                                    tableBodyD.appendChild(row);

                                                });

                                                const row2 = document.createElement('tr');
                                                row2.innerHTML = `
                                                    <td colspan="4">&nbsp;</td>
                                                    <td colspan="3" >
                                                        <h5 class="mt-1 text-success">
                                                            Total : ${formatPriceT(total.total_sum)} Fcfa
                                                        </h5>
                                                    </td>
                                                `;
                                                tableBodyD.appendChild(row2);

                                            } else {
                                                tableDivD.style.display = 'none';
                                                messageDivD.style.display = 'block';
                                                loaderDivD.style.display = 'none';
                                                messageDivD.innerHTML = '<p class="text-danger">Aucun détail trouvé.</p>';
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Erreur lors du chargement des données:', error);
                                        });
                                });

                            });
                        }

                        // Update table with filtered factures
                        function applySearchFilterC() {
                            const searchTerm = searchInputC.value.toLowerCase();
                            const filteredCons = allCons.filter(item =>
                                item.code.toLowerCase().includes(searchTerm)
                            );
                            displayRows(filteredCons); // Display only filtered factures
                        }

                        searchInputC.addEventListener('input', applySearchFilterC);

                        displayRows(allCons);

                        updatePaginationControlsC(pagination);

                    } else {
                        document.getElementById(`btn_print_tableC`).style.display = 'none';
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

        function updatePaginationControlsC(pagination) {
            const paginationDiv = document.getElementById('pagination-controlsC');
            paginationDiv.innerHTML = '';

            // Bootstrap pagination wrapper
            const paginationWrapper = document.createElement('ul');
            paginationWrapper.className = 'pagination justify-content-center';

            // Previous button
            if (pagination.current_page > 1) {
                const prevButton = document.createElement('li');
                prevButton.className = 'page-item';
                prevButton.innerHTML = `<a class="page-link" href="#">Precédent</a>`;
                prevButton.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list_cons_all(pagination.current_page - 1);
                };
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
                pageItem.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list_cons_all(i);
                };
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
                lastPageItem.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list_cons_all(totalPages);
                };
                paginationWrapper.appendChild(lastPageItem);
            }

            // Next button
            if (pagination.current_page < pagination.last_page) {
                const nextButton = document.createElement('li');
                nextButton.className = 'page-item';
                nextButton.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                nextButton.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list_cons_all(pagination.current_page + 1);
                };
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

        function generatePDFficheCons(patient, user, typeacte, consultation) {

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            const titlea = "Fiche";
            doc.setFontSize(100);
            doc.setTextColor(242, 237, 237); // Gray color for background effect
            doc.setFont("Helvetica", "bold");
            doc.text(titlea, 120, 150, { align: 'center', angle: 40 });

            // Informations de l'entreprise
            doc.setFontSize(10);
            doc.setTextColor(0, 0, 0);
            doc.setFont("Helvetica", "bold");
            // Texte de l'entreprise
            const title = "ESPACE MEDICO SOCIAL LA PYRAMIDE DU COMPLEXE";
            const titleWidth = doc.getTextWidth(title);
            const titleX = (doc.internal.pageSize.getWidth() - titleWidth) / 2;
            doc.text(title, titleX, 20);
            // Texte de l'adresse
            doc.setFont("Helvetica", "normal");
            const address = "Abidjan Yopougon Selmer, Non loin du complexe sportif Jesse-Jackson - 04 BP 1523";
            const addressWidth = doc.getTextWidth(address);
            const addressX = (doc.internal.pageSize.getWidth() - addressWidth) / 2;
            doc.text(address, addressX, 25);
            // Texte du téléphone
            const phone = "Tél.: 20 24 44 70 / 20 21 71 92 - Cel.: 01 01 01 63 43";
            const phoneWidth = doc.getTextWidth(phone);
            const phoneX = (doc.internal.pageSize.getWidth() - phoneWidth) / 2;
            doc.text(phone, phoneX, 30);

            const consultationDate = new Date(consultation.created_at);
            // Formatter la date et l'heure séparément
            const formattedDate = consultationDate.toLocaleDateString(); // Formater la date
            const formattedTime = consultationDate.toLocaleTimeString(); // Formater l'heure
            doc.setFontSize(10);
            doc.setFont("Helvetica", "normal");
            doc.text("Date: " + formattedDate, 15, 47);
            doc.text("Heure: " + formattedTime, 15, 52);

            //Ligne de séparation
            doc.setFontSize(15);
            doc.setFont("Helvetica", "bold");
            doc.setLineWidth(0.5);
            doc.setTextColor(255, 0, 0);
            // doc.line(10, 35, 200, 35); 
            const titleR = "FICHE DE CONSULTATION";
            const titleRWidth = doc.getTextWidth(titleR);
            const titleRX = (doc.internal.pageSize.getWidth() - titleRWidth) / 2;
            // Définir le padding
            const paddingh = 0; // Padding vertical
            const paddingw = 15; // Padding horizontal
            // Calculer les dimensions du rectangle
            const rectX = titleRX - paddingw; // X du rectangle
            const rectY = 50 - (15 / 2) - paddingh; // Y du rectangle
            const rectWidth = titleRWidth + (paddingw * 2); // Largeur du rectangle
            const rectHeight = 12 + (paddingh * 2); // Hauteur du rectangle
            // Définir la couleur pour le cadre (noir)
            doc.setDrawColor(0, 0, 0);
            doc.rect(rectX, rectY, rectWidth, rectHeight); // Dessiner le rectangle
            // Ajouter le texte centré en gras
            doc.setFontSize(15);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(255, 0, 0); // Couleur du texte rouge
            doc.text(titleR, titleRX, 50); // Positionner le texte

            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("N° Dossier : P-" + patient.matricule, 160, 47);
            doc.text("N° Cons : C-" + consultation.code, 160, 52);

            // Informations du service
            doc.setFontSize(9);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Medecin", 15, 65);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": Dr. "+ user.name, 55, 65);

            // Informations du servic
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Spécialité", 15, 72);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": " + typeacte.nom, 55, 72);

            // Informations du servic
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Nom et Prénoms", 15, 79);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": " + patient.np , 55, 79);

            // Informations du servic
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Assurer", 15, 86);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(225, 0, 0);
            doc.text(": " + patient.assurer, 55, 86);

            // Informations du service
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Age", 15, 93);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": " + patient.age +" an(s)", 55, 93);

            // Informations du servic
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Domicile", 15, 100);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": " + patient.adresse, 55, 100);

            // Informations du servic
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Contact", 15, 107);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": +225 " + patient.tel, 55, 107);

            if (patient.assurer === 'oui') {
                // Informations du service
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(225, 0, 0);
                doc.text("Assurance", 15, 114);

                doc.setFont("Helvetica", "normal");
                doc.setTextColor(225, 0, 0);
                doc.text(": " + patient.assurance, 55, 114);

                // Informations du service
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(225, 0, 0);
                doc.text("Matricule", 15, 121);

                doc.setFont("Helvetica", "normal");
                doc.setTextColor(225, 0, 0);
                doc.text(": " + patient.matricule_assurance, 55, 121);
            }

            doc.setFontSize(30);
            doc.setLineWidth(0.5);
            doc.line(10, 128, 200, 128);

            doc.setFontSize(15);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(255, 0, 0);
            const rendu = "Compte Rendu";
            const titleRr = doc.getTextWidth(rendu);
            const titlerendu = (doc.internal.pageSize.getWidth() - titleRr) / 2;
            doc.text(rendu, titlerendu, 140);
            // Dessiner une ligne sous le texte pour le souligner
            const underlineY = 142; // Ajustez cette valeur selon vos besoins
            doc.setDrawColor(255, 0, 0);
            doc.setLineWidth(0.5); // Épaisseur de la ligne
            doc.line(titlerendu, underlineY, titlerendu + titleRr, underlineY);

            // Informations du service
            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("TA", 20, 155);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": ..........", 35, 155);

            // Informations du service
            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("BD", 60, 155);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": ..........", 75, 155);

            // Informations du service
            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("BG", 100, 155);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": ..........", 115, 155);

            // Informations du service
            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Poids", 20, 165);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": ..........", 35, 165);

            // Informations du service
            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Pouls", 60, 165);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": ..........", 75, 165);

            // Informations du service
            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Taille", 100, 165);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": ..........", 115, 165);

            // Informations du service
            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Temp", 140, 165);

            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text(": ..........", 155, 165);

            doc.setFontSize(15);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            const motif = "Motif";
            const titleRm = doc.getTextWidth(motif);
            const titlemotif = (doc.internal.pageSize.getWidth() - titleRm) / 2;
            doc.text(motif, titlemotif, 185);
            // Dessiner une ligne sous le texte pour le souligner
            const underlineYm = 187; // Ajustez cette valeur selon vos besoins
            doc.setDrawColor(0, 0, 0);
            doc.setLineWidth(0.5); // Épaisseur de la ligne
            doc.line(titlemotif, underlineYm, titlemotif + titleRm, underlineYm);

            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            doc.text("Imprimer le "+new Date().toLocaleDateString()+" à "+new Date().toLocaleTimeString() , 5, 295);

            doc.output('dataurlnewwindow');
        }

        function generatePDFInvoice(patient, user, typeacte, consultation) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });

            yPos = 10;

            function drawConsultationSection(yPos) {
                rightMargin = 15;
                leftMargin = 15;
                pdfWidth = doc.internal.pageSize.getWidth();

                const titlea = "Facture";
                doc.setFontSize(100);
                doc.setTextColor(242, 237, 237); // Gray color for background effect
                doc.setFont("Helvetica", "bold");
                doc.text(titlea, 120, yPos + 120, { align: 'center', angle: 40 });

                // Informations de l'entreprise
                doc.setFontSize(10);
                doc.setTextColor(0, 0, 0);
                doc.setFont("Helvetica", "bold");
                // Texte de l'entreprise
                const title = "ESPACE MEDICO SOCIAL LA PYRAMIDE DU COMPLEXE";
                const titleWidth = doc.getTextWidth(title);
                const titleX = (doc.internal.pageSize.getWidth() - titleWidth) / 2;
                doc.text(title, titleX, yPos);
                // Texte de l'adresse
                doc.setFont("Helvetica", "normal");
                const address = "Abidjan Yopougon Selmer, Non loin du complexe sportif Jesse-Jackson - 04 BP 1523";
                const addressWidth = doc.getTextWidth(address);
                const addressX = (doc.internal.pageSize.getWidth() - addressWidth) / 2;
                doc.text(address, addressX, (yPos + 5));
                // Texte du téléphone
                const phone = "Tél.: 20 24 44 70 / 20 21 71 92 - Cel.: 01 01 01 63 43";
                const phoneWidth = doc.getTextWidth(phone);
                const phoneX = (doc.internal.pageSize.getWidth() - phoneWidth) / 2;
                doc.text(phone, phoneX, (yPos + 10));
                doc.setFontSize(10);
                doc.setFont("Helvetica", "normal");
                const consultationDate = new Date(consultation.created_at);
                // Formatter la date et l'heure séparément
                const formattedDate = consultationDate.toLocaleDateString(); // Formater la date
                const formattedTime = consultationDate.toLocaleTimeString();
                doc.text("Date: " + formattedDate, 15, (yPos + 25));
                doc.text("Heure: " + formattedTime, 15, (yPos + 30));

                //Ligne de séparation
                doc.setFontSize(15);
                doc.setFont("Helvetica", "bold");
                doc.setLineWidth(0.5);
                doc.setTextColor(255, 0, 0);
                // doc.line(10, 35, 200, 35); 
                const titleR = "FACTURE DE CONSULTATION";
                const titleRWidth = doc.getTextWidth(titleR);
                const titleRX = (doc.internal.pageSize.getWidth() - titleRWidth) / 2;
                // Définir le padding
                const paddingh = 0; // Padding vertical
                const paddingw = 15; // Padding horizontal
                // Calculer les dimensions du rectangle
                const rectX = titleRX - paddingw; // X du rectangle
                const rectY = (yPos + 18) - paddingh; // Y du rectangle
                const rectWidth = titleRWidth + (paddingw * 2); // Largeur du rectangle
                const rectHeight = 15 + (paddingh * 2); // Hauteur du rectangle
                // Définir la couleur pour le cadre (noir)
                doc.setDrawColor(0, 0, 0);
                doc.rect(rectX, rectY, rectWidth, rectHeight); // Dessiner le rectangle
                // Ajouter le texte centré en gras
                doc.setFontSize(15);
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(255, 0, 0); // Couleur du texte rouge
                doc.text(titleR, titleRX, (yPos + 25)); // Positionner le texte
                const titleN = "N° "+ consultation.code_fac;
                doc.text(titleN, (doc.internal.pageSize.getWidth() - doc.getTextWidth(titleN)) / 2, (yPos + 31));

                doc.setFontSize(10);
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(0, 0, 0);
                const numDossier = "N° Dossier : P-"+ patient.matricule;
                const numDossierWidth = doc.getTextWidth(numDossier);
                doc.text(numDossier, pdfWidth - rightMargin - numDossierWidth, yPos + 28);

                yPoss = (yPos + 50);

                const patientInfo = [
                    { label: "Nom et Prénoms", value: patient.np },
                    { label: "Assurer", value: patient.assurer },
                    { label: "Age", value: patient.age+" an(s)" },
                    { label: "Domicile", value: patient.adresse },
                    { label: "Contact", value: "+225 "+patient.tel }
                ];

                if (patient.assurer == 'oui') {
                    patientInfo.push(
                        { label: "Assurance", value: patient.assurance },
                        { label: "Matricule", value: patient.matricule_assurance },
                    );
                }

                patientInfo.forEach(info => {
                    doc.setFontSize(8);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 35, yPoss);
                    yPoss += 7;
                });

                yPoss = (yPos + 50);

                const medecinInfo = [
                    { label: "N° Consultation", value: "C-"+consultation.code},
                    { label: "Medecin", value: "Dr. "+user.name },
                    { label: "Spécialité", value: typeacte.nom },
                    { label: "Prix Consultation", value: typeacte.prix+" Fcfa" },
                ];

                medecinInfo.forEach(info => {
                    doc.setFontSize(8);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 100, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 130, yPoss);
                    yPoss += 7;
                });

                yPoss = (yPos + 90);

                const compteInfo = [
                    { label: "Montant Total", value: typeacte.prix + " Fcfa" },
                    ...(parseInt(consultation.part_assurance.replace(/[^0-9]/g, '')) > 0 
                        ? [{ label: "Part assurance", value: consultation.part_assurance + " Fcfa" }] 
                        : []),
                    { label: "Remise", value: consultation.remise + " Fcfa" },
                ];


                if (patient.taux !== null) {
                    compteInfo.push({ label: "Taux", value: patient.taux + "%" });
                }

                compteInfo.forEach(info => {
                    doc.setFontSize(9);
                    doc.setFont("Helvetica", "bold");
                    doc.setTextColor(0, 0, 0);
                    doc.text(info.label, leftMargin + 110, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 140, yPoss);
                    yPoss += 7;
                });

                yPoss += 1;

                doc.setFontSize(11);
                doc.setTextColor(0, 0, 0);
                doc.setFont("Helvetica", "bold");
                doc.text('Montant à payer', leftMargin + 110, yPoss);
                doc.setFont("Helvetica", "bold");
                doc.text(": "+consultation.part_patient+" Fcfa", leftMargin + 140, yPoss);

                // doc.setFontSize(10);
                // doc.setFont("Helvetica", "bold");
                // doc.setTextColor(0, 0, 0);
                // doc.text("Imprimer le "+new Date().toLocaleDateString()+" à "+new Date().toLocaleTimeString() , 5, yPoss + 20);

            }

            drawConsultationSection(yPos);

            doc.setFontSize(30);
            doc.setLineWidth(0.5);
            doc.setLineDashPattern([3, 3], 0);
            doc.line(0, (yPos + 135), 300, (yPos + 135));
            doc.setLineDashPattern([], 0);

            drawConsultationSection(yPos + 150);


            doc.output('dataurlnewwindow');
        }

    });
</script>

@endsection
