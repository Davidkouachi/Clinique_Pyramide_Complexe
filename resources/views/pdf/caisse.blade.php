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
            Point de la Caisse
        </li>
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <!-- Row starts -->
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-lg-6 col-md-8 col-sm-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Point de Caisse</h5>
                </div>
                <div class="card-body" >
                    <div class="row gx-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">
                                    Assurance
                                </label>
                                <select class="form-select" id="assurance_id"></select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">
                                    Date début
                                </label>
                                <input type="date" class="form-control" id="date1" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">
                                    Date Fin
                                </label>
                                <input type="date" class="form-control" id="date2" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-center">
                            <div class="mb-3 d-flex gap-2 justify-content-center">
                                <button id="btn_imp" class="btn btn-primary">
                                    <i class="ri-printer-line"></i>
                                    Imprimer
                                </button>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row ends -->
</div>

<script src="{{asset('assets/js/app/js/jspdfinvoicetemplate/dist/index.js')}}" ></script>
<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>
<script src="{{asset('jsPDF-AutoTable/dist/jspdf.plugin.autotable.min.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        select_assurance();

        document.getElementById("date1").addEventListener("change", datechange);
        document.getElementById("btn_imp").addEventListener("click", imp_fac);

        function showAlert(title, message, type) {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
            });
        }

        function formatPrice(price) {

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

        function datechange()
        {
            const date1Value = document.getElementById('date1').value;
            const date2 = document.getElementById('date2');

            date2.value = date1Value;
            date2.min = date1Value;
        }

        function select_assurance()
        {
            const selectElement = document.getElementById('assurance_id');

            selectElement.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Selectionner';
            selectElement.appendChild(defaultOption);

            fetch('/api/assurance_select_patient_new')
                .then(response => response.json())
                .then(data => {
                    data.forEach(assurance => {
                        const option = document.createElement('option');
                        option.value = assurance.id; // Ensure 'id' is the correct key
                        option.textContent = assurance.nom; // Ensure 'nom' is the correct key
                        selectElement.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des societes:', error));
        }

        function imp_fac()
        {
            const assurance_id = document.getElementById('assurance_id');
            const date1 = document.getElementById('date1');
            const date2 = document.getElementById('date2');

            if (!date1.value.trim() || !date2.value.trim()) {
                showAlert('Alert', 'Veuillez saisir des dates S\'il vous plaît.','warning');
                return false; 
            }

            function isValidDate(dateString) {
                const regEx = /^\d{4}-\d{2}-\d{2}$/;
                if (!dateString.match(regEx)) return false;
                const date = new Date(dateString);
                const timestamp = date.getTime();
                if (typeof timestamp !== 'number' || isNaN(timestamp)) return false;
                return dateString === date.toISOString().split('T')[0];
            }

            if (!isValidDate(date1.value)) {
                showAlert('Erreur', 'La première date est invalide.', 'error');
                return false;
            }

            if (!isValidDate(date2.value)) {
                showAlert('Erreur', 'La deuxième date est invalide.', 'error');
                return false;
            }

            const startDate = new Date(date1.value);
            const endDate = new Date(date2.value);

            if (startDate > endDate) {
                showAlert('Erreur', 'La date de début ne peut pas être supérieur à la date de fin.', 'error');
                return false;
            }

            const oneYearInMs = 365 * 24 * 60 * 60 * 1000;
            if (endDate - startDate > oneYearInMs) {
                showAlert('Erreur', 'La plage de dates ne peut pas dépasser un an.', 'error');
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
                url: '/api/etat_fac_caisse',
                method: 'GET',
                data: {
                    assurance_id: assurance_id.value || null, 
                    date1: date1.value, 
                    date2: date2.value,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    const fac_cons = response.fac_cons || [];
                    const fac_exam = response.fac_exam || [];
                    const fac_soinsam = response.fac_soinsam || [];
                    const fac_hopital = response.fac_hopital || [];
                    const date1 = response.date1;
                    const date2 = response.date2;

                    if (response.donnee_0) {

                        showAlert('Informations', 'Aucune donnée n\'a été trouvée pour cette période','info');

                    } else if (response.success) {

                        document.getElementById('date1').value = "";
                        document.getElementById('date2').value = "";

                        generatePDFInvoice(fac_cons,fac_exam,fac_soinsam,fac_hopital,date1,date2);

                    } else {
                        showAlert('Informations', 'Aucune donnée n\'a été trouvée pour cette période','info');
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

        function generatePDFInvoice(fac_cons,fac_exam,fac_soinsam,fac_hopital,date1,date2)
        {

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'l', unit: 'mm', format: 'a4' });

            const pdfFilename = "Point_Caisse_" + formatDate(date1) + "_au_" + formatDate(date2);
            doc.setProperties({
                title: pdfFilename,
            });

            let yPos = 10;

            function drawSection(yPos) {

                rightMargin = 15;
                leftMargin = 15;
                pdfWidth = doc.internal.pageSize.getWidth();

                const logoSrc = "{{asset('assets/images/logo.png')}}";
                const logoWidth = 22;
                const logoHeight = 22;
                doc.addImage(logoSrc, 'PNG', leftMargin, yPos - 7, logoWidth, logoHeight);

                doc.setFontSize(10);
                doc.setTextColor(0, 0, 0);
                doc.setFont("Helvetica", "bold");

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

                let titleR;

                if (formatDate(date1) === formatDate(date2)) {
                    titleR = "Point de la Caisse du "+formatDate(date1);
                }else{
                    titleR = "Point de la Caisse du "+formatDate(date1)+" au "+formatDate(date2);
                }

                const titleRWidth = doc.getTextWidth(titleR);
                const titleRX = (doc.internal.pageSize.getWidth() - titleRWidth) / 2;

                const paddingh = 5;  // Ajuster le padding en hauteur
                const paddingw = 5;  // Ajuster le padding en largeur

                const rectX = titleRX - paddingw;
                let rectY = yPos + 15; // Position initiale du rectangle
                const rectWidth = titleRWidth + (paddingw * 2);
                const rectHeight = 2 + (paddingh * 2);

                doc.setDrawColor(0, 0, 0);
                doc.rect(rectX, rectY, rectWidth, rectHeight);

                // Centrer le texte dans le rectangle
                const textY = rectY + (rectHeight / 2) + 2;  // Ajustement de la position Y du texte pour centrer verticalement
                doc.text(titleR, titleRX, textY);

                yPoss = (yPos + 40);
                
                let grandTotalAssurance = 0;
                let grandTotalPatient = 0;
                let grandTotalMontant = 0;

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
                            
                    doc.autoTable({
                        startY: yPoss,
                        head: [['N°', 'N° Dossier', 'Patient', 'Assurance', 'Acte effectué', 'Montant Total', 'Part Assurance', 'Part assuré', 'Statut', 'Date']],
                        body: fac_global.map((item, index) => [
                            index + 1,
                            "P-"+item.code_patient || '',
                            item.patient || '',
                            item.assurance || 'Néant',
                            item.acte,
                            item.montant + " Fcfa" || '' ,
                            item.part_assurance + " Fcfa" || '' ,
                            item.part_patient + " Fcfa" || '',
                            (item.statut_fac || ''),
                            formatDateHeure(item.created_at) || '',
                        ]),
                        theme: 'striped',
                        didParseCell: function (data) {
                            if (data.section === 'body' && data.column.index === 8) {
                                if (data.cell.raw.toLowerCase() === 'payer') {
                                    data.cell.styles.textColor = [0, 128, 0];
                                } else {
                                    data.cell.styles.textColor = [255, 0, 0];
                                }
                            }
                        }
                    });

                    const finalY = doc.autoTable.previous.finalY || yPoss + 10;
                    yPoss = finalY + 10;

                    const totalAssurance = fac_global.reduce((sum, item) => sum + parseInt(item.part_assurance.replace(/[^0-9]/g, '') || 0), 0);
                    const totalPatient = fac_global.reduce((sum, item) => sum + parseInt(item.part_patient.replace(/[^0-9]/g, '') || 0), 0);
                    const totalMontant = fac_global.reduce((sum, item) => sum + parseInt(item.montant.replace(/[^0-9]/g, '') || 0), 0);

                    grandTotalAssurance += totalAssurance;
                    grandTotalPatient += totalPatient;
                    grandTotalMontant += totalMontant;

                    const finalInfo = [
                        { label: "Montant Total", value: formatPrice(totalMontant) + " Fcfa" },
                        { label: "Total Assurance", value: formatPrice(totalAssurance) + " Fcfa" },
                        { label: "Total Patient", value: formatPrice(totalPatient) + " Fcfa" },
                        
                    ];

                    finalInfo.forEach(info => {
                        doc.setFontSize(11);
                        doc.setFont("Helvetica", "bold");
                        doc.text(info.label, leftMargin + 200, yPoss);
                        doc.setFont("Helvetica", "normal");
                        doc.text(": " + info.value, leftMargin + 235, yPoss);
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
                    doc.text(footerText, 5, 295);
                }
            }

            drawSection(yPos);

            addFooter();

            doc.output('dataurlnewwindow');
        }

    });
</script>

@endsection


