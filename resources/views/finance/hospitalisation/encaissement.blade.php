@extends('app')

@section('titre', 'Nouveau Produit')

@section('info_page')
<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-bar-chart-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{route('index_accueil')}}">Espace Santé</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Nouveau Produit
        </li>
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <!-- Row starts -->
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        Facture non réglée
                    </h5>
                    <div class="d-flex" >
                        <input type="text" id="searchInput" placeholder="N° facture" class="form-control me-1" >
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
                                        <th scope="col">Id facture</th>
                                        <th scope="col">Part Assurance</th>
                                        <th scope="col">Part Patient</th>
                                        <th scope="col">Remise</th>
                                        <th scope="col">Montant Chambre</th>
                                        <th scope="col">Montant Soins</th>
                                        <th scope="col">Montant a payer</th>
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
                        <p class="text-center" >
                            Aucune facture disponible
                        </p>
                    </div>
                    <div id="div_Table_loader" style="display: none;">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                            <strong>Chargement des données...</strong>
                        </div>
                    </div>
                    <div id="pagination-controls" ></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row ends -->
</div>

<div class="modal fade" id="Detail" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >
                    Détails
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal_detail">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Detail_produit" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">
                    Produit Pharmacie Utilisé
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive" id="div_TableP" style="display: none;">
                                            <table class="table table-bordered" id="TableP">
                                                <thead>
                                                    <tr>
                                                        <th>Produit utilisé</th>
                                                        <th style="width: 150px;" >Prix unitaire</th>
                                                        <th style="width: 50px;" >Quantité</th>
                                                        <th style="width: 150px;" >Prix</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="message_TableP" style="display: none;">
                                            <p class="text-center" >
                                                Aucun Produit utilisé pour le moment
                                            </p>
                                        </div>
                                        <div id="div_Table_loaderP" style="display: none;">
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
</div>

<div class="modal fade" id="Caisse" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">
                    Caisse
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gx-3">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">A payer</label>
                            <input readonly class="form-control" id="input_montant_payer">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Montant versé</label>
                            <div class="input-group">
                                <input type="tel" class="form-control" id="input_montant_verser" placeholder="Saisie Obligatoire">
                                <span class="input-group-text">Fcfa</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Montant Remis</label>
                            <div class="input-group">
                                <input readonly type="tel" class="form-control" id="input_montant_remis" placeholder="Saisie Obligatoire">
                                <span class="input-group-text">Fcfa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="div_btn_valider" style="display: none;">
                <input type="hidden" id="id_code_fac">
                <button data-bs-dismiss="modal" class="btn btn-success" id="btn_valider" >
                    Validé
                </button>
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

        document.getElementById("btn_refresh_table").addEventListener("click", list);
        document.getElementById("btn_valider").addEventListener("click", payer);

        // ->----------------------------

        document.getElementById('input_montant_verser').addEventListener('input', function() {
            // Nettoyer la valeur entrée en supprimant les caractères non numériques sauf le point
            const rawValue = this.value.replace(/[^0-9]/g, ''); // Supprimer tous les caractères non numériques
            
            // Ajouter des points pour les milliers
            const formattedValue = formatPrice(rawValue);
            
            // Mettre à jour la valeur du champ avec la valeur formatée
            this.value = formattedValue;

            // Convertir la valeur formatée en nombre pour les calculs
            const montantPayer = parseFloat(document.getElementById('input_montant_payer').value.replace(/\./g, '')) || 0;
            const montantVerser = parseFloat(rawValue) || 0;

            // Calculer le montant remis
            const montantRemis = montantVerser - montantPayer;
            document.getElementById('input_montant_remis').value = `${formatPrice(montantRemis)}`;

            const btnValider = document.getElementById('div_btn_valider');
            if (montantRemis >= 0) {
                btnValider.style.display = 'block';
            } else {
                btnValider.style.display = 'none';
            }
        });

        document.getElementById('input_montant_verser').addEventListener('keypress', function(event) {
            // Permettre uniquement les chiffres et le point
            const key = event.key;
            if (isNaN(key)) {
                event.preventDefault();
            }
        });
        
        // -----------------------------------------

        function formatPrice(price) {

            // Convert to float and round to the nearest whole number
            let number = Math.round(parseFloat(price));
            if (isNaN(number)) {
                return '';
            }

            // Format the number with dot as thousands separator
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function showAlert(title, message, type) {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
            });
        }

        function formatDate(dateString) {

            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const year = date.getFullYear();

            return `${day}/${month}/${year}`; // Format as dd/mm/yyyy
        }

        function payer()
        {
            const code_fac = document.getElementById("id_code_fac").value;
            const montant_verser = document.getElementById("input_montant_verser");
            const montant_remis = document.getElementById("input_montant_remis");

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            if(!montant_verser.value.trim() || !montant_remis.value.trim()){
                var preloader = document.getElementById('preloader_ch');
                if (preloader) {
                    preloader.remove();
                }
                showAlert('Alert', 'Impossible d\'éffectuée le paiement.','error');
                return false;
            }

            $.ajax({
                url: '/api/facture_payer_hos/' + code_fac,
                method: 'GET',
                data: { montant_verser: montant_verser.value, montant_remis: montant_remis.value,},
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {

                        showAlert('Succès', 'Paiement éffectuée.','success');

                        const hopital = response.hopital;
                        const facture = response.facture;
                        const patient = response.patient;
                        const nature = response.natureadmission;
                        const type = response.typeadmission;
                        const lit = response.lit;
                        const chambre = response.chambre;
                        const user = response.user;
                        const produit = response.produit;

                        list();

                        generatePDFInvoicePayer(hopital, facture, patient, nature, type, lit, chambre, user, produit);

                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue lors du paiement, Veuillez ressayer.','error');
                    }

                },
                error: function(xhr, status, error) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('Alert', 'Une erreur est survenue lors du paiement.','error');
                }
            });
        }

        function list(page = 1) {
            const tableBody = document.querySelector('#Table tbody');
            const messageDiv = document.getElementById('message_Table');
            const tableDiv = document.getElementById('div_Table');
            const loaderDiv = document.getElementById('div_Table_loader');
            const searchInput = document.getElementById('searchInput');

            let allFactures = []; // Array to hold all factures data fetched from API

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            // Fetch data from the API
            const url = `/api/list_facture_hos?page=${page}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    allFactures = data.hopital || [];
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    if (allFactures.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        // Display rows function with optional filtering
                        function displayRows(filteredFactures) {
                            tableBody.innerHTML = ''; // Clear existing rows

                            filteredFactures.forEach((item, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                    <td>Fac-${item.code_fac}</td>
                                    <td class="text-primary">
                                        ${item.part_assurance ?? 0} Fcfa
                                    </td>
                                    <td class="text-success">
                                        ${item.part_patient ?? 0} Fcfa
                                    </td>
                                    <td class="text-warning">
                                        ${item.remise ?? 0} Fcfa
                                    </td>
                                    <td class="text-primary">
                                        ${item.montant_chambre ?? 0} Fcfa
                                    </td>
                                    <td class="text-primary">
                                        ${item.montant_soins ?? 0} Fcfa
                                    </td>
                                    <td class="text-primary">
                                        ${item.montant ?? 0} Fcfa
                                    </td>
                                    <td>${formatDate(item.created_at)}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a class="btn btn-outline-success btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Caisse" id="paye-${item.id}">
                                                <i class="ri-hand-coin-line"></i>
                                            </a>
                                            <a class="btn btn-outline-warning btn-sm rounded-5" id="detail-${item.id}" data-bs-toggle="modal" data-bs-target="#Detail">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm rounded-5" id="detail_produit-${item.id}" data-bs-toggle="modal" data-bs-target="#Detail_produit">
                                                <i class="ri-archive-2-fill"></i>
                                            </a>
                                            <a class="btn btn-outline-info btn-sm rounded-5" id="printer-${item.id}">
                                                <i class="ri-printer-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                `;
                                tableBody.appendChild(row);

                                // Add event listeners
                                document.getElementById(`paye-${item.id}`).addEventListener('click', () => {
                                    const payer = document.getElementById('input_montant_payer');
                                    payer.value = `${item?.part_patient || 0} Fcfa`;

                                    const verser = document.getElementById('input_montant_verser');
                                    verser.value = '';
                                    document.getElementById('input_montant_remis').value = '0 Fcfa';

                                    document.getElementById('id_code_fac').value = `${item.code_fac}`;
                                });

                                document.getElementById(`detail-${item.id}`).addEventListener('click', () =>
                                {
                                    fetch(`/api/detail_hos/${item.id}`) // API endpoint
                                        .then(response => response.json())
                                        .then(data => {
                                            // Access the 'chambre' array from the API response
                                            const modalD = document.getElementById('modal_detail');
                                            modalD.innerHTML = '';

                                            const hopital = data.hopital;
                                            const facture = data.facture;
                                            const patient = data.patient;
                                            const nature = data.natureadmission;
                                            const type = data.typeadmission;
                                            const lit = data.lit;
                                            const chambre = data.chambre;
                                            const user = data.user;

                                            const div = document.createElement('div');
                                            div.innerHTML = `
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="">
                                                            <div class="card-body">
                                                                <div class="row justify-content-between">
                                                                    <div class="col-12 text-center">                  
                                                                        <h6 class="fw-semibold">Docteur :</h6>
                                                                        <p>${user.name}</p>
                                                                        <h6 class="fw-semibold">Spécialité :</h6>
                                                                        <p>${user.typeacte}</p>
                                                                        <h6 class="fw-semibold">Chambre Occupé :</h6>
                                                                        <p>CH-${chambre.code}</p>
                                                                        <h6 class="fw-semibold">Lit Occupé :</h6>
                                                                        <p>LIT-${lit.code}/${lit.type}</p>
                                                                        <h6 class="fw-semibold">Prix :</h6>
                                                                        <p>${chambre.prix} Fcfa</p>
                                                                    </div>
                                                                    <div class="col-12 text-center mt-4">
                                                                        <h6 class="fw-semibold">Type d'admission :</h6>
                                                                        <p>${type.nom}</p>
                                                                        <h6 class="fw-semibold">Nature d'admission :</h6>
                                                                        <p>${nature.nom}</p>
                                                                        <h6 class="fw-semibold">Date d'entrer :</h6>
                                                                        <p>${formatDate(hopital.date_debut)}</p>
                                                                        <h6 class="fw-semibold">Date de sortie Probable :</h6>
                                                                        <p>${formatDate(hopital.date_fin)}</p>
                                                                        <h6 class="fw-semibold">Nombre de jours :</h6>
                                                                        <p>${calculateDaysBetween(hopital.date_debut, hopital.date_fin)}</p>
                                                                    </div>
                                                                    <div class="col-12 text-center mt-4">
                                                                        <h6 class="fw-semibold">N° Dossier :</h6>
                                                                        <p>${patient.matricule}</p>
                                                                        <h6 class="fw-semibold">Nom du patient :</h6>
                                                                        <p>${patient.np}</p>
                                                                        <h6 class="fw-semibold">contact :</h6>
                                                                        <p>${patient.tel}</p>
                                                                        <h6 class="fw-semibold">Assurer :</h6>
                                                                        <p>${patient.assurer}</p>
                                                                        ${patient.assurer === 'oui' ? `
                                                                            <h6 class="fw-semibold">Taux :</h6>
                                                                            <p>${patient.taux}%</p>

                                                                            <h6 class="fw-semibold">Assurance :</h6>
                                                                            <p>${patient.assurance}</p> 

                                                                            <h6 class="fw-semibold">Matricule :</h6>
                                                                            <p>${patient.matricule_assurance}</p>
                                                                        ` : ''}
                                                                    </div>
                                                                    <div class="col-12 text-center mt-4">
                                                                        <h6 class="fw-semibold">Part Patient :</h6>
                                                                        <p>${hopital.part_patient} Fcfa</p>
                                                                        <h6 class="fw-semibold">Part Assurance :</h6>
                                                                        <p>${hopital.part_assurance} Fcfa</p>
                                                                        <h6 class="fw-semibold">Remise :</h6>
                                                                        <p>${hopital.remise ? hopital.remise : '0'} Fcfa</p>
                                                                        <h6 class="fw-semibold">Montant Total :</h6>
                                                                        <p>${hopital.montant} Fcfa</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;

                                            modalD.appendChild(div);

                                        })
                                        .catch(error => {
                                            console.error('Erreur lors du chargement des données:', error);
                                        });
                                });

                                document.getElementById(`detail_produit-${item.id}`).addEventListener('click',()=>
                                {
                                    const tableBodyP = document.querySelector('#TableP tbody');
                                    const messageDivP = document.getElementById('message_TableP');
                                    const tableDivP = document.getElementById('div_TableP');
                                    const loaderDivP = document.getElementById('div_Table_loaderP');

                                    messageDivP.style.display = 'none';
                                    tableDivP.style.display = 'none';
                                    loaderDivP.style.display = 'block';

                                    fetch(`/api/list_facture_hos_d/${item.id}`) // API endpoint
                                        .then(response => response.json())
                                        .then(data => {
                                            // Access the 'chambre' array from the API response
                                            const factureds = data.factured;

                                            // Clear any existing rows in the table body
                                            tableBodyP.innerHTML = '';

                                            if (factureds.length > 0) {

                                                loaderDivP.style.display = 'none';
                                                messageDivP.style.display = 'none';
                                                tableDivP.style.display = 'block';

                                                // Loop through each item in the chambre array
                                                factureds.forEach((item, index) => {
                                                    // Create a new row
                                                    const row = document.createElement('tr');
                                                    // Create and append cells to the row based on your table's structure
                                                    row.innerHTML = `
                                                        <td>
                                                            <h6>${item.nom_produit}</h6>
                                                        </td>
                                                        <td>
                                                            <h6>${item.prix_produit} Fcfa</h6>
                                                        </td>
                                                        <td>
                                                            <h6>${item.quantite}</h6>
                                                        </td>
                                                        <td>
                                                            <h6>${item.montant} Fcfa</h6>
                                                        </td>
                                                    `;
                                                    // Append the row to the table body
                                                    tableBodyP.appendChild(row);

                                                });

                                                const row2 = document.createElement('tr');
                                                row2.innerHTML = `
                                                    <td colspan="2">&nbsp;</td>
                                                    <td colspan="2" >
                                                        <h5 class="mt-4 text-success">
                                                            Total : ${item.montant_soins} Fcfa
                                                        </h5>
                                                    </td>
                                                `;
                                                tableBodyP.appendChild(row2);

                                                const row3 = document.createElement('tr');
                                                row3.innerHTML = `
                                                    <td colspan="4">
                                                        <h6 class="text-danger">NOTE</h6>
                                                        <p class="small m-0">
                                                            Le Montant Total des produits utilisés
                                                            seront ajouter au montant total de la
                                                            chambre occupé par le patient.
                                                        </p>
                                                    </td>
                                                `;

                                                tableBodyP.appendChild(row3);

                                            } else {
                                                loaderDivP.style.display = 'none';
                                                messageDivP.style.display = 'block';
                                                tableDivP.style.display = 'none';
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Erreur lors du chargement des données:', error);
                                            loaderDivD.style.display = 'none';
                                            messageDivD.style.display = 'block';
                                            tableDivD.style.display = 'none';
                                        });
                                    
                                });

                                document.getElementById(`printer-${item.id}`).addEventListener('click', () =>
                                {
                                    fetch(`/api/detail_hos/${item.id}`) // API endpoint
                                        .then(response => response.json())
                                        .then(data => {
                                            // Access the 'chambre' array from the API response
                                            const hopital = data.hopital;
                                            const facture = data.facture;
                                            const patient = data.patient;
                                            const nature = data.natureadmission;
                                            const type = data.typeadmission;
                                            const lit = data.lit;
                                            const chambre = data.chambre;
                                            const user = data.user;
                                            const produit = data.produit;

                                            generatePDFInvoice(hopital, facture, patient, nature, type, lit, chambre, user, produit);

                                        })
                                        .catch(error => {
                                            console.error('Erreur lors du chargement des données:', error);
                                        });
                                });
                            });
                        }

                        // Update table with filtered factures
                        function applySearchFilter() {
                            const searchTerm = searchInput.value.toLowerCase();
                            const filteredFactures = allFactures.filter(facture =>
                                facture.code_fac.toLowerCase().includes(searchTerm)
                            );
                            displayRows(filteredFactures); // Display only filtered factures
                        }

                        searchInput.addEventListener('input', applySearchFilter);

                        displayRows(allFactures);

                        updatePaginationControls(pagination);

                    } else {
                        document.getElementById('btn_print_table').style.display = 'none';
                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'block';
                        tableDiv.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des données:', error);
                    loaderDiv.style.display = 'none';
                    messageDiv.style.display = 'block';
                    tableDiv.style.display = 'none';
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
                prevButton.onclick = (event) => {
                    event.preventDefault(); // Empêche le défilement en haut de la page
                    list(pagination.current_page - 1);
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
                    list(i);
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
                    list(totalPages);
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
                    list(pagination.current_page + 1);
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

        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');  // Ajoute un '0' si le jour est à un chiffre
            const month = String(date.getMonth() + 1).padStart(2, '0');  // Les mois sont indexés de 0, donc +1
            const year = date.getFullYear();
            
            return `${day}-${month}-${year}`;
        }

        function calculateDaysBetween(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            
            // Calcul de la différence en millisecondes
            const diffInMilliseconds = end - start;

            // Conversion en jours (millisecondes en secondes, minutes, heures, jours)
            let diffInDays = diffInMilliseconds / (1000 * 60 * 60 * 24);

            // Si la différence est inférieure ou égale à 0, on retourne 1 jour minimum
            return diffInDays <= 0 ? 1 : Math.round(diffInDays); 
        }

        function generatePDFInvoice(hopital, facture, patient, nature, type, lit, chambre, user, produit) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });

            let yPos = 10;

            function drawConsultationSection(yPos) {
                rightMargin = 15;
                leftMargin = 15;
                pdfWidth = doc.internal.pageSize.getWidth();

                const titlea = "Impayer";
                doc.setFontSize(100);
                doc.setTextColor(252, 173, 159); // Gray color for background effect
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
                const hopitalDate = new Date(hopital.created_at);
                // Formatter la date et l'heure séparément
                const formattedDate = hopitalDate.toLocaleDateString(); // Formater la date
                const formattedTime = hopitalDate.toLocaleTimeString();
                doc.text("Date: " + formattedDate, 15, (yPos + 25));
                doc.text("Heure: " + formattedTime, 15, (yPos + 30));

                //Ligne de séparation
                doc.setFontSize(15);
                doc.setFont("Helvetica", "bold");
                doc.setLineWidth(0.5);
                doc.setTextColor(0, 0, 0);
                // doc.line(10, 35, 200, 35); 
                const titleR = "FACTURE HOSPITALISATION";
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
                doc.setTextColor(0, 0, 0); // Couleur du texte rouge
                doc.text(titleR, titleRX, (yPos + 25)); // Positionner le texte
                const titleN = "N° "+facture.code;
                doc.text(titleN, (doc.internal.pageSize.getWidth() - doc.getTextWidth(titleN)) / 2, (yPos + 31));

                doc.setFontSize(10);
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(0, 0, 0);
                const numDossier = "N° Dossier : P-"+ patient.matricule;
                const numDossierWidth = doc.getTextWidth(numDossier);
                doc.text(numDossier, pdfWidth - rightMargin - numDossierWidth, yPos + 28);

                yPoss = (yPos + 40);

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

                yPoss = (yPos + 40);

                const medecinInfo = [
                    { label: "Medecin", value: "Dr. "+user.name },
                    { label: "Spécialité", value: user.typeacte },
                    { label: "Date d'entrée le ", value: formatDate(hopital.date_debut) },
                    { label: "Date de sortie prévu le ", value: formatDate(hopital.date_fin) },
                    { label: "Nombre de jours ", value: calculateDaysBetween(hopital.date_debut, hopital.date_fin)+" Jour(s)" },
                ];

                medecinInfo.forEach(info => {
                    doc.setFontSize(8);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 100, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 135, yPoss);
                    yPoss += 7;
                });

                yPoss = (yPos + 90);

                const typeInfo = [
                    { label: "Type d'admission", value: type.nom },
                    { label: "Nature d'admission", value: nature.nom },
                    { label: "Chambre Occupée", value: "CH-"+chambre.code },
                    { label: "Lit Occupée", value: "LIT-"+lit.code+"/"+lit.type },
                    { label: "Prix", value: chambre.prix+" Fcfa" },
                ];

                typeInfo.forEach(info => {
                    doc.setFontSize(8);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 35, yPoss);
                    yPoss += 7;
                });

                yPoss = (yPos + 90);

                const compteInfo = [
                    { label: "Part assurance", value: hopital.part_assurance+" Fcfa"},
                    { label: "Part Patient", value: hopital.part_patient+" Fcfa"},
                    { label: "Remise", value: hopital.remise ? hopital.remise + " Fcfa" : "0 Fcfa" }
                ];

                if (patient.taux !== null) {
                    compteInfo.push({ label: "Taux", value: patient.taux + "%" });
                }

                compteInfo.forEach(info => {
                    doc.setFontSize(9);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 120, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 150, yPoss);
                    yPoss += 7;
                });

                yPoss += 1;

                doc.setFontSize(11);
                doc.setFont("Helvetica", "bold");
                doc.text('Total Chambre', leftMargin + 120, yPoss);
                doc.setFont("Helvetica", "bold");
                doc.text(": "+hopital.montant_chambre+" Fcfa", leftMargin + 150, yPoss);

                const donneeTable = produit;
                // Using autoTable to add a dynamic table for hospital stay details
                if (donneeTable.length > 0) {
                    yPossT = yPoss + 10;
                    doc.autoTable({
                        startY: yPossT, // Ajustez cette valeur pour le placer correctement sur la page
                        head: [['N°','Nom du produit utilisé', 'Quantité', 'Prix Unitaire', 'Montant']], // En-têtes du tableau
                        body: donneeTable.map((item, index) => [
                            index + 1,
                            item.nom_produit, // Nom du produit
                            item.quantite, // Quantité
                            item.prix_produit+" Fcfa", // Prix unitaire
                            item.montant+" Fcfa", // Montant (quantité * prix unitaire)
                        ]), // Remplace les lignes par les données dynamiques
                        theme: 'striped', // Vous pouvez changer le thème en plain, grid, etc.
                        // headStyles: { fillColor: [255, 0, 0] }, // En-tête en rouge si nécessaire
                    });

                    // Utiliser la position Y de la dernière ligne du tableau
                    const finalY = doc.autoTable.previous.finalY || yPossT + 10;

                    // Ajuster yPoss à la fin du tableau pour le placement des totaux
                    yPoss = finalY + 10;

                    // Déclarer finalInfo comme un tableau vide
                    const finalInfo = [];
                    
                    // Ajouter l'entrée "Total Produit" si produit.length > 0
                    if (produit.length > 0) {
                        finalInfo.push({ label: "Total Produit", value: hopital.montant_soins });
                    }
                    
                    // Ajouter l'entrée "Montant a payer"
                    finalInfo.push({ label: "Montant Total", value: hopital.montant });
                    
                    // Boucler à travers finalInfo pour afficher les informations
                    finalInfo.forEach(info => {
                        doc.setFontSize(11);
                        doc.setFont("Helvetica", "bold");
                        doc.text(info.label, leftMargin + 120, yPoss);
                        doc.setFont("Helvetica", "normal");
                        doc.text(": " + info.value + " Fcfa", leftMargin + 150, yPoss);
                        yPoss += 7;
                    });

                } else {

                    yPoss += 7;
                    // Déclarer finalInfo comme un tableau vide
                    const finalInfo = [];
                    // Ajouter l'entrée "Total Produit" si produit.length > 0
                    if (produit.length > 0) {
                        finalInfo.push({ label: "Total Produit", value: hopital.montant_soins });
                    }
                    // Ajouter l'entrée "Montant a payer"
                    finalInfo.push({ label: "Montant Total", value: hopital.montant });
                    // Boucler à travers finalInfo pour afficher les informations
                    finalInfo.forEach(info => {
                        doc.setFontSize(11);
                        doc.setFont("Helvetica", "bold");
                        doc.text(info.label, leftMargin + 120, yPoss);
                        doc.setFont("Helvetica", "normal");
                        doc.text(": " + info.value + " Fcfa", leftMargin + 150, yPoss);
                        yPoss += 7;
                    });
                }

            }

            function addFooter() {
                const pageCount = doc.internal.getNumberOfPages();
                for (let i = 1; i <= pageCount; i++) {
                    doc.setPage(i);
                    const footerText = "Imprimer le " + new Date().toLocaleDateString() + " à " + new Date().toLocaleTimeString();
                    doc.setFontSize(7);
                    doc.setFont("Helvetica", "bold");
                    doc.setTextColor(0, 0, 0);
                    doc.text(footerText, 5, 295); // Position near the bottom of the page (5mm from the left, 290mm from the top)
                }
            }

            drawConsultationSection(yPos);

            addFooter();

            doc.output('dataurlnewwindow');
        }

        function generatePDFInvoicePayer(hopital, facture, patient, nature, type, lit, chambre, user, produit) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });

            let yPos = 10;

            function drawConsultationSection(yPos) {
                rightMargin = 15;
                leftMargin = 15;
                pdfWidth = doc.internal.pageSize.getWidth();

                const titlea = "Payer";
                doc.setFontSize(100);
                doc.setTextColor(174, 255, 165); // Gray color for background effect
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
                const hopitalDate = new Date(hopital.created_at);
                // Formatter la date et l'heure séparément
                const formattedDate = hopitalDate.toLocaleDateString(); // Formater la date
                const formattedTime = hopitalDate.toLocaleTimeString();
                doc.text("Date: " + formattedDate, 15, (yPos + 25));
                doc.text("Heure: " + formattedTime, 15, (yPos + 30));

                //Ligne de séparation
                doc.setFontSize(15);
                doc.setFont("Helvetica", "bold");
                doc.setLineWidth(0.5);
                doc.setTextColor(0, 0, 0);
                // doc.line(10, 35, 200, 35); 
                const titleR = "FACTURE HOSPITALISATION";
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
                doc.setTextColor(0, 0, 0); // Couleur du texte rouge
                doc.text(titleR, titleRX, (yPos + 25)); // Positionner le texte
                const titleN = "N° "+facture.code;
                doc.text(titleN, (doc.internal.pageSize.getWidth() - doc.getTextWidth(titleN)) / 2, (yPos + 31));

                doc.setFontSize(10);
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(0, 0, 0);
                const numDossier = "N° Dossier : P-"+ patient.matricule;
                const numDossierWidth = doc.getTextWidth(numDossier);
                doc.text(numDossier, pdfWidth - rightMargin - numDossierWidth, yPos + 28);

                yPoss = (yPos + 40);

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

                yPoss = (yPos + 40);

                const medecinInfo = [
                    { label: "Medecin", value: "Dr. "+user.name },
                    { label: "Spécialité", value: user.typeacte },
                    { label: "Date d'entrée le ", value: formatDate(hopital.date_debut) },
                    { label: "Date de sortie prévu le ", value: formatDate(hopital.date_fin) },
                    { label: "Nombre de jours ", value: calculateDaysBetween(hopital.date_debut, hopital.date_fin)+" Jour(s)" },
                ];

                medecinInfo.forEach(info => {
                    doc.setFontSize(8);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 100, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 135, yPoss);
                    yPoss += 7;
                });

                yPoss = (yPos + 90);

                const typeInfo = [
                    { label: "Type d'admission", value: type.nom },
                    { label: "Nature d'admission", value: nature.nom },
                    { label: "Chambre Occupée", value: "CH-"+chambre.code },
                    { label: "Lit Occupée", value: "LIT-"+lit.code+"/"+lit.type },
                    { label: "Prix", value: chambre.prix+" Fcfa" },
                ];

                typeInfo.forEach(info => {
                    doc.setFontSize(8);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 35, yPoss);
                    yPoss += 7;
                });

                yPoss = (yPos + 90);

                const compteInfo = [
                    { label: "Part assurance", value: hopital.part_assurance+" Fcfa"},
                    { label: "Part Patient", value: hopital.part_patient+" Fcfa"},
                    { label: "Remise", value: hopital.remise ? hopital.remise + " Fcfa" : "0 Fcfa" }
                ];

                if (patient.taux !== null) {
                    compteInfo.push({ label: "Taux", value: patient.taux + "%" });
                }

                compteInfo.forEach(info => {
                    doc.setFontSize(9);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 120, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 150, yPoss);
                    yPoss += 7;
                });

                yPoss += 1;

                doc.setFontSize(11);
                doc.setFont("Helvetica", "bold");
                doc.text('Total Chambre', leftMargin + 120, yPoss);
                doc.setFont("Helvetica", "bold");
                doc.text(": "+hopital.montant_chambre+" Fcfa", leftMargin + 150, yPoss);

                const donneeTable = produit;
                // Using autoTable to add a dynamic table for hospital stay details
                if (donneeTable.length > 0) {
                    yPossT = yPoss + 10;
                    doc.autoTable({
                        startY: yPossT, // Ajustez cette valeur pour le placer correctement sur la page
                        head: [['N°','Nom du produit utilisé', 'Quantité', 'Prix Unitaire', 'Montant']], // En-têtes du tableau
                        body: donneeTable.map((item, index) => [
                            index + 1,
                            item.nom_produit, // Nom du produit
                            item.quantite, // Quantité
                            item.prix_produit+" Fcfa", // Prix unitaire
                            item.montant+" Fcfa", // Montant (quantité * prix unitaire)
                        ]), // Remplace les lignes par les données dynamiques
                        theme: 'striped', // Vous pouvez changer le thème en plain, grid, etc.
                        // headStyles: { fillColor: [255, 0, 0] }, // En-tête en rouge si nécessaire
                    });

                    // Utiliser la position Y de la dernière ligne du tableau
                    const finalY = doc.autoTable.previous.finalY || yPossT + 10;

                    // Ajuster yPoss à la fin du tableau pour le placement des totaux
                    yPoss = finalY + 10;

                    // Déclarer finalInfo comme un tableau vide
                    const finalInfo = [];
                    
                    // Ajouter l'entrée "Total Produit" si produit.length > 0
                    if (produit.length > 0) {
                        finalInfo.push({ label: "Total Produit", value: hopital.montant_soins });
                    }
                    
                    // Ajouter l'entrée "Montant a payer"
                    finalInfo.push({ label: "Montant Total", value: hopital.montant });
                    
                    if (facture) {
                        finalInfo.push(
                            { label: "Montant Verser", value: facture.montant_verser },
                            { label: "Montant Remis", value: facture.montant_remis },
                            );
                    }

                    // Boucler à travers finalInfo pour afficher les informations
                    finalInfo.forEach(info => {
                        doc.setFontSize(11);
                        doc.setFont("Helvetica", "bold");
                        doc.text(info.label, leftMargin + 120, yPoss);
                        doc.setFont("Helvetica", "normal");
                        doc.text(": " + info.value + " Fcfa", leftMargin + 150, yPoss);
                        yPoss += 7;
                    });

                } else {

                    yPoss += 7;
                    // Déclarer finalInfo comme un tableau vide
                    const finalInfo = [];
                    // Ajouter l'entrée "Total Produit" si produit.length > 0
                    if (produit.length > 0) {
                        finalInfo.push({ label: "Total Produit", value: hopital.montant_soins });
                    }
                    // Ajouter l'entrée "Montant a payer"
                    finalInfo.push({ label: "Montant Total", value: hopital.montant });
                    // Boucler à travers finalInfo pour afficher les informations
                    finalInfo.forEach(info => {
                        doc.setFontSize(11);
                        doc.setFont("Helvetica", "bold");
                        doc.text(info.label, leftMargin + 120, yPoss);
                        doc.setFont("Helvetica", "normal");
                        doc.text(": " + info.value + " Fcfa", leftMargin + 150, yPoss);
                        yPoss += 7;
                    });
                }

            }

            function addFooter() {
                const pageCount = doc.internal.getNumberOfPages();
                for (let i = 1; i <= pageCount; i++) {
                    doc.setPage(i);
                    const footerText = "Imprimer le " + new Date().toLocaleDateString() + " à " + new Date().toLocaleTimeString();
                    doc.setFontSize(7);
                    doc.setFont("Helvetica", "bold");
                    doc.setTextColor(0, 0, 0);
                    doc.text(footerText, 5, 295); // Position near the bottom of the page (5mm from the left, 290mm from the top)
                }
            }

            drawConsultationSection(yPos);

            addFooter();

            doc.output('dataurlnewwindow');
        }

    });
</script>



@endsection