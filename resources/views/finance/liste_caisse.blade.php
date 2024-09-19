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
                        Liste des Factures
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
                                        <th scope="col">Total</th>
                                        <th scope="col">Date de création</th>
                                        <th scope="col">Statut</th>
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
                    <div class="col-xxl-3 col-sm-3 col-12">
                        <img height="100" width="100" src="{{asset('assets/images/facture.webp')}}" alt="Bootstrap Admin Dashboard" class="img-fluid">
                    </div>
                    <div class="col-sm-9 col-12">
                        <div class="text-end" id="fac_detail">
                            
                        </div>
                    </div>
                    <div class="col-12 mb-5"></div>
                </div>
                {{-- <div class="row justify-content-between">
                    <div class="col-lg-6 col-12">
                        <h6 class="fw-semibold">Billed To :</h6>
                        <p class="m-0">
                            Hamspire Jordan,<br>
                            8900 Gilsion Ave,<br>
                            San Francisco, California(CA), 66789
                        </p>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="text-end">
                            <h6 class="fw-semibold">Hospital Address :</h6>
                            <p class="text-end m-0">
                                Medicare LTD, 76890 St. <br>
                                5000 thomos Street, Suite 980<br>
                                Huntsville, Alabama, 87890
                            </p>
                        </div>
                    </div>
                    <div class="col-12 mb-3"></div>
                </div> --}}
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
                                                        <th width="50px" >Remise</th>
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


{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
{{-- <script src="https://unpkg.com/jspdf-invoice-template@1.4.4/dist/index.js"></script> --}}
<script src="{{asset('assets/js/app/js/jspdfinvoicetemplate/dist/index.js')}}" ></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        list();

        document.getElementById("btn_refresh_table").addEventListener("click", list);

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

        function list() {

            const tableBody = document.querySelector('#Table tbody');
            const messageDiv = document.getElementById('message_Table');
            const tableDiv = document.getElementById('div_Table'); // The message div
            const loaderDiv = document.getElementById('div_Table_loader');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            // Fetch data from the API
            fetch('/api/list_facture') // API endpoint
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
                                <td class="text-primary" >
                                    ${formatPrice(item.part_patient ?? 0)} Fcfa
                                </td>
                                <td class="text-primary" >
                                    ${formatPrice(item.montant ?? 0)} Fcfa
                                </td>
                                <td>${formatDate(item.created_at)}</td>
                                <td>
                                    <span class="badge ${item.statut === 'payer' ? 'bg-success' : 'bg-danger'}">
                                        ${item.statut === 'payer' ? 'Réglé' : 'Non Réglé'}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-inline-flex gap-1">
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

                                        const id = data.ID.code_fac;
                                        const date_fac = data.ID.date_fac;
                                        const statutValue = data.ID.statut;
                                        const date_paye = data.ID.date_paye;

                                        const fac_detail = document.getElementById('fac_detail');

                                        fac_detail.innerHTML = '';

                                        const para = document.createElement('p');
                                        para.className = "mb-2";
                                        para.innerHTML = `
                                            Invoice - <span class="text-primary">${id}</span>
                                        `;
                                        fac_detail.appendChild(para);

                                        if (date_paye) {
                                            const date = document.createElement('p');
                                            date.className = "mb-2";
                                            date.innerHTML = `
                                                Date de paiement ${formatDateHeure(date_paye)}
                                            `;
                                            fac_detail.appendChild(date);
                                        }

                                        const statutElement = document.createElement('span');
                                        if (statutValue === 'payer') {
                                            statutElement.className = "badge bg-success";
                                            statutElement.innerHTML = `
                                                Facture Réglée
                                            `;
                                        } else {
                                            statutElement.className = "badge bg-danger";
                                            statutElement.innerHTML = `
                                                Facture Non Réglée
                                            `;
                                        }
                                        fac_detail.appendChild(statutElement);

    
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
                                                            ${item.remise ?? 0}%
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
                    item.remise !== null && item.remise !== undefined ? item.remise + '%' : '0%', // Remise with default value
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
                    { title: "Description", style: { width: 80 } },
                    { title: "Part Assurance", style: { width: 28 } },
                    { title: "Taux", style: { width: 15 } },
                    { title: "Remise", style: { width: 15 } },
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