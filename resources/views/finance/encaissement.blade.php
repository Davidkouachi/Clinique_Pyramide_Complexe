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
        {{-- <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Formulaire Nouveau Produit</h5>
                </div>
                <div class="card-body" >
                    <div class="row gx-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Numéro Consultation</label>
                                <div class="input-group">
                                    <span class="input-group-text">C-</span>
                                    <input type="text" class="form-control" id="matricule_patient" placeholder="Saisie Obligatoire" maxlength="6">
                                    <button id="btn_rech_num_dossier" class="btn btn-outline-success">
                                        <i class="ri-search-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex gap-2 justify-content-start">
                                <button type="reset" class="btn btn-outline-danger">
                                    Rémise à zéro
                                </button>
                                <button type="submit" class="btn btn-success">
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        Facture non réglée
                    </h5>
                    <div class="d-flex" >
                        <a id="btn_print_table" style="display: none;" class="btn btn-outline-warning ms-auto me-1">
                            <i class="ri-printer-line"></i>
                        </a>
                        <a id="btn_refresh_table" class="btn btn-outline-info ms-auto">
                            <i class="ri-loop-left-line"></i>
                        </a>
                    </div>
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
                                        <th scope="col">Id facture</th>
                                        <th scope="col">Nom et Prénoms</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Part Assurance</th>
                                        <th scope="col">Part Patient</th>
                                        <th scope="col">Remise</th>
                                        <th scope="col">Total</th>
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
                </div>
            </div>
        </div>
    </div>
    <!-- Row ends -->
</div>

<div class="modal fade" id="Detail" tabindex="-1" aria-modal="true" role="dialog" >
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalXlLabel">
                    Détail facture
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
                                        <div id="div_alert_tableD" >
                    
                                        </div>
                                        <div class="table-responsive" id="div_TableD" style="display: none;">
                                            <table class="table table-bordered" id="TableD">
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
                                        <div id="message_TableD" style="display: none;">
                                            <p class="text-center" >
                                                Aucune facture disponible
                                            </p>
                                        </div>
                                        <div id="div_Table_loaderD" style="display: none;">
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


{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
{{-- <script src="https://unpkg.com/jspdf-invoice-template@1.4.4/dist/index.js"></script> --}}
<script src="{{asset('assets/js/app/js/jspdfinvoicetemplate/dist/index.js')}}" ></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

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

        function showAlertListD(type, message) {

            var dynamicFields = document.getElementById("div_alert_tableD");
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
            document.getElementById("div_alert_tableD").appendChild(groupe);

            setTimeout(function() {
                groupe.classList.remove("show");
                groupe.classList.add("fade");
                setTimeout(function() {
                    groupe.remove();
                }, 150); // Time for the fade effect to complete
            }, 3000);
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
                showAlertList('warning', 'Impossible d\'éffectuée le paiement.');
                return false;
            }

            $.ajax({
                url: '/api/facture_payer/' + code_fac,
                method: 'GET',
                data: { montant_verser: montant_verser.value, montant_remis: montant_remis.value,},
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {

                        showAlertList('success', 'Paiement éffectuée.');

                        const factures = response.factured;
                        const price = formatPrice(response.Total.total_sum);
                        const id = response.ID.code_fac;
                        const date_fac = response.ID.date_fac;
                        const statut = response.ID.statut;
                        const date_paye = response.ID.date_paye;

                        list();

                        generatePDF(factures,price,id,date_fac,statut,date_paye);

                    } else if (response.error) {
                        showAlertList('danger', 'Une erreur est survenue lors du paiement.');
                    }

                },
                error: function(xhr, status, error) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlertList('danger', 'Une erreur est survenue lors du paiement.');
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
            fetch('/api/list_facture_inpayer') // API endpoint
                .then(response => response.json())
                .then(data => {
                    // Access the 'chambre' array from the API response
                    const factures = data.facture;

                    // Clear any existing rows in the table body
                    tableBody.innerHTML = '';

                    if (factures.length > 0) {

                        document.getElementById(`btn_print_table`).style.display = 'block';

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        // Loop through each item in the chambre array
                        factures.forEach((item, index) => {
                            // Create a new row
                            const row = document.createElement('tr');
                            // Create and append cells to the row based on your table's structure
                            row.innerHTML = `
                                <td>${index + 1}</td>
                                <td>Fac-${item.code_fac}</td>
                                <td>${item.name}</td>
                                <td>+225 ${item.tel}</td>
                                <td class="text-primary" >
                                    ${formatPrice(item.part_assurance ?? 0)} Fcfa
                                </td>
                                <td class="text-success" >
                                    ${formatPrice(item.part_patient ?? 0)} Fcfa
                                </td>
                                <td class="text-warning" >
                                    ${formatPrice(item.remise ?? 0)} Fcfa
                                </td>
                                <td class="text-primary" >
                                    ${formatPrice(item.montant ?? 0)} Fcfa
                                </td>
                                <td>${formatDate(item.created_at)}</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a class="btn btn-outline-success btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Caisse" id="paye-${item.id}">
                                            <i class="ri-hand-coin-line"></i>
                                        </a>
                                        <a class="btn btn-outline-warning btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Detail" id="detail-${item.id}">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <a class="btn btn-outline-info btn-sm rounded-5" id="printer-${item.id}">
                                            <i class="ri-printer-line"></i>
                                        </a>
                                    </div>
                                </td>
                            `;
                            // Append the row to the table body
                            tableBody.appendChild(row);

                            document.getElementById(`paye-${item.id}`).addEventListener('click', () =>
                            {
                                const payer = document.getElementById('input_montant_payer');
                                payer.value = `${formatPrice(item?.part_patient || 0)} Fcfa`;

                                const verser = document.getElementById('input_montant_verser');
                                verser.value = '';
                                document.getElementById('input_montant_remis').value = '0 Fcfa';

                                document.getElementById('id_code_fac').value = `${item.code_fac}`;
                            });

                            document.getElementById(`printer-${item.id}`).addEventListener('click', () =>
                            {
                                fetch(`/api/list_facture_inpayer_d/${item.id}`) // API endpoint
                                    .then(response => response.json())
                                    .then(data => {
                                        // Access the 'chambre' array from the API response
                                        const factures = data.factured;
                                        const price = formatPrice(data.Total.total_sum);
                                        const id = data.ID.code_fac;
                                        const date_fac = data.ID.date_fac;
                                        const statut = data.ID.statut;
                                        const date_paye = data.ID.date_paye;

                                        generatePDF(factures,price,id,date_fac,statut,date_paye);

                                    })
                                    .catch(error => {
                                        console.error('Erreur lors du chargement des données:', error);
                                    });
                            });

                            document.getElementById(`detail-${item.id}`).addEventListener('click',()=>
                            {
                                const tableBodyD = document.querySelector('#TableD tbody');
                                const messageDivD = document.getElementById('message_TableD');
                                const tableDivD = document.getElementById('div_TableD');
                                const loaderDivD = document.getElementById('div_Table_loaderD');

                                messageDivD.style.display = 'none';
                                tableDivD.style.display = 'none';
                                loaderDivD.style.display = 'block';

                                fetch(`/api/list_facture_inpayer_d/${item.id}`) // API endpoint
                                    .then(response => response.json())
                                    .then(data => {
                                        // Access the 'chambre' array from the API response
                                        const factureds = data.factured;
                                        const Total = data.Total;

                                        // Clear any existing rows in the table body
                                        tableBodyD.innerHTML = '';

                                        if (factureds.length > 0) {

                                            loaderDivD.style.display = 'none';
                                            messageDivD.style.display = 'none';
                                            tableDivD.style.display = 'block';

                                            // Loop through each item in the chambre array
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
                                                        <h6 class="text-primary" >
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
                                                        Total : ${formatPrice(Total.total_sum)} Fcfa
                                                    </h5>
                                                </td>
                                            `;
                                            tableBodyD.appendChild(row2);

                                            const row3 = document.createElement('tr');
                                            row3.innerHTML = `
                                                <td colspan="7">
                                                    <h6 class="text-danger">NOTES</h6>
                                                    <p class="small m-0">
                                                        We really appreciate your business and if
                                                        there’s anything else we can do, please.
                                                        let us know! Also, should you need us to
                                                        add VAT or anything else to this order,
                                                        it’s super easy since this is a template,
                                                        so just ask!
                                                    </p>
                                                </td>
                                            `;

                                            tableBodyD.appendChild(row3);

                                        } else {
                                            loaderDivD.style.display = 'none';
                                            messageDivD.style.display = 'block';
                                            tableDivD.style.display = 'none';
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Erreur lors du chargement des données:', error);
                                        loaderDivD.style.display = 'none';
                                        messageDivD.style.display = 'block';
                                        tableDivD.style.display = 'none';
                                    });
                                
                            });

                        });

                    } else {
                        document.getElementById(`btn_print_table`).style.display = 'none';
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

        function generatePDF(factures, price, id, date_fac, statut, date_paye) {

            window.jsPDF = window.jspdf.jsPDF;

            function formatDate(dateString) {
                const date = new Date(dateString);
                
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = date.getFullYear();

                // Format time components (hours, minutes, seconds)
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                const seconds = String(date.getSeconds()).padStart(2, '0');

                return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
            }

            let tableData = [];

            // Iterate through factures and add to tableData
            factures.forEach((item, index) => {
                tableData.push([
                    index + 1, // Row index
                    'C-'+item.code, // Facture code
                    item.nom_acte + ' ' + item.nom_typeacte, // Description (combination of acte and typeacte)
                    item.part_assurance ? item.part_assurance + ' Fcfa' : '0 Fcfa', // Part Assurance with default value
                    item.taux !== null && item.taux !== undefined ? item.taux + '%' : '0%', // Taux with default value
                    item.remise !== null && item.remise !== undefined ? item.remise + 'Fcfa' : '0 Fcfa', // Remise with default value
                    item.part_patient ? item.part_patient + ' Fcfa' : '0 Fcfa' // Part Patient with default value
                ]);
            });

            const invoiceDetails = {
                invGenDate: "Imprimer le: " + new Date().toLocaleString(),
                headerBorder: true,
                tableBodyBorder: true,
                header: [
                    { title: "N°", style: { width: 10 } },
                    { title: "Code", style: { width: 20 } },
                    { title: "Description", style: { width: 70 } },
                    { title: "Part Assurance", style: { width: 28 } },
                    { title: "Taux", style: { width: 15 } },
                    { title: "Remise", style: { width: 25 } },
                    { title: "Part Patient", style: { width: 25 } },
                ],
                table: tableData,
                additionalRows: [
                    {
                        col1: 'Total :',
                        col2: price + ' Fcfa',
                        style: { fontSize: 12 }
                    }
                ],
                invDescLabel: "Statut: " + (statut === 'payer' ? 'payer' : 'non payé'),
                invDesc: "Merci d'avoir choisi notre clinique. Nous vous remercions de votre visite et espérons vous revoir bientôt.",
                footer: {
                    text: "Generated by the clinic system."
                },
                tableStyle: {
                    fontSize: 10,
                    color: 'black'
                }
            };

            // Conditionally add the invDate if statut is 'payer'
            if (statut === 'payer' && date_paye) {
                invoiceDetails.invDate = "Date de paiement: " + formatDate(date_paye);
            }

            // Ensure tableData is not empty before generating PDF
            if (tableData.length === 0) {
                alert("No data found to generate PDF.");
                return;
            }

            // var  pdfObject = jsPDFInvoiceTemplate.default(props);

            var props = {
                outputType: jsPDFInvoiceTemplate.OutputType.Save,
                returnJsPDFDocObject: true,
                fileName: "Facture-"+id,
                orientationLandscape: false,
                compress: true,
                logo: {
                    src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/logo.png",
                    type: 'PNG',
                    width: 53.33,
                    height: 26.66,
                },
                stamp: {
                    inAllPages: true,
                    src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
                    type: 'JPG',
                    width: 20,
                    height: 20,
                },
                business: {
                    name: "Clinique la Pyramide du Complexe",
                    address: "Address here",
                    phone: "(+123) 456-7890",
                    email: "email@clinic.com",
                },
                contact: {
                    name: "Facture ID: "+ id,
                    label: "Date de création : " + formatDate(date_fac),
                },
                invoice: invoiceDetails,
                footer: {
                    text: "Generated by the clinic system.",
                },
                pageEnable: true,
                pageLabel: "Page "
            };

            var pdf = jsPDFInvoiceTemplate.default(props);

            var pdfBlob = pdf.jsPDFDocObject.output('blob');
            var pdfUrl = URL.createObjectURL(pdfBlob);
            window.open(pdfUrl, '_blank');
            
        }

    });
</script>



@endsection