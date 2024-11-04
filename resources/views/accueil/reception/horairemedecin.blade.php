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
            Accueil
        </li>
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <div class="row gx-3 mb-3">
        <div class="col-xxl-12 col-sm-12">
            <div class="card bg-3">
                <div class="card-body" style="background: rgba(0, 0, 0, 0.7);">
                    <div class="py-4 px-3 text-white">
                        <h6>Bienvenue,</h6>
                        <h2>{{Auth::user()->sexe.'. '.Auth::user()->name}}</h2>
                        <h5>Horaires des Médecins.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-3 mb-3" >
        <div class="col-sm-12">
            <div class="card mb-3">
                <div class="card-body" style="margin-top: -30px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center bg-primary bg-2" id="customTab4" role="tablist" style="background: rgba(0, 0, 0, 0.7);">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-white" id="tab-twoAAAN" data-bs-toggle="tab" href="#twoAAAN" role="tab" aria-controls="twoAAAN" aria-selected="false" tabindex="-1">
                                    <i class="ri-dossier-line me-2"></i>
                                    Nouvel horaire
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoAAAL" data-bs-toggle="tab" href="#twoAAAL" role="tab" aria-controls="twoAAAL" aria-selected="false" tabindex="-1">
                                    <i class="ri-dossier-line me-2"></i>
                                    Liste des rendez-vous
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane active show fade" id="twoAAAN" role="tabpanel" aria-labelledby="tab-twoAAAN">
                                <div class="card-header">
                                    <h5 class="card-title text-center">Nouvel Horaire</h5>
                                </div>
                                <div class="row gx-3 justify-content-center align-items-center mb-4">
                                    <div class="col-12">
                                        <div class=" mb-0">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <a class="d-flex align-items-center flex-column">
                                                        <img src="{{asset('assets/images/docteur.png')}}" class="img-7x rounded-circle">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_medecin" >
                                        <div class="mb-3 text-center">
                                            <label class="form-label">Medecin</label>
                                            <select class="form-select text-center" id="medecin_id"></select>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_Horaire" style="display: none;">
                                    <div class="mb-3 p-2" >
                                        <div class="row gx-3 justify-content-center align-items-center">
                                            <div class="col-12">
                                                <div class="row gx-3 justify-content-center align-items-center">
                                                    <div class="col-12 mb-3 text-center">
                                                        <button type="button" id="add_horaire" class="btn btn-info">
                                                            <i class="ri-sticky-note-add-line"></i>
                                                            Ajouter un horaire
                                                        </button>
                                                    </div>
                                                    <div class="col-12" id="contenu_horaire">

                                                    </div>
                                                    <div class="row gx-3" id="div_btn_horaire" style="display: none;">
                                                        <div class="col-12 mb-3 text-center">
                                                            <button type="button" id="btn_eng" class="btn btn-success">
                                                                Enregistrer
                                                                <i class="ri-send-plane-fill"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane fade" id="twoAAAL" role="tabpanel" aria-labelledby="tab-twoAAAL">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">
                                        Liste des Rendez-Vous
                                    </h5>
                                    <div class="d-flex">
                                        <select class="form-select me-1" id="statut_rdv">
                                            <option selected value="tous">Tous</option>
                                            <option value="en cours">en cours</option>
                                            <option value="terminer">terminer</option>
                                        </select>
                                        <a id="btn_refresh_table_rdv" class="btn btn-outline-info ms-auto">
                                            <i class="ri-loop-left-line"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-outer" id="div_Table_rdv" style="display: none;">
                                        <div class="table-responsive">
                                            <table class="table m-0 align-middle" id="Table_rdv">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Patient</th>
                                                        <th>Contact</th>
                                                        <th>Médecin</th>
                                                        <th>Spécialité</th>
                                                        <th>Rdv prévu</th>
                                                        <th>Statut</th>
                                                        <th>Date de création</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="message_Table_rdv" style="display: none;">
                                        <p class="text-center">
                                            Aucun Rendez-Vous n'a été trouvée
                                        </p>
                                    </div>
                                    <div id="div_Table_loader_rdv" style="display: none;">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                            <strong>Chargement des données...</strong>
                                        </div>
                                    </div>
                                    <div id="pagination-controls_rdv"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-3 mb-3">
        <div class="col-sm-12 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row gx-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <button id="btn_refresh" class="btn btn-outline-primary">
                                    <i class="ri-loop-left-line" ></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Médecins</label>
                                <select class="form-select" id="rech_medecin">
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Spécialités</label>
                                <select class="form-select" id="rech_specialite">
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Jours</label>
                                <select class="form-select" id="rech_jour">
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Périodes</label>
                                <select class="form-select" id="rech_periode">
                                    <option selected value="tout">Tout</option>
                                    <option value="Matin">Matin</option>
                                    <option value="Soir">Soir</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 row gx-3 d-flex mb-3" id="table" style="display: none;" >
            
        </div>
        <div id="message" style="display: none;" class="mb-3">
            <p class="text-center">Aucune donnée n'a été trouvée</p>
        </div>
        <div id="loader" style="display: none;" class="mb-3">
            <div class="d-flex justify-content-center align-items-center">
                <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                <strong>Chargement des données...</strong>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Detail_motif" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-body" id="modal_Detail_motif"></div>
    </div>
</div>

<div class="modal fade" id="Rdv_modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouveau Rendez-Vous</h5>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <input type="hidden" id="medecin_id_rdv">
                    <div class="mb-3">
                        <label class="form-label">Médecin</label>
                        <input readonly type="text" class="form-control" id="medecin_rdv">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Spécialité</label>
                        <input readonly type="text" class="form-control" id="specialite_rdv">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Patient</label>
                        <div class="input-group">
                            <input type="hidden" id="patient_id_rdv">
                            <input type="text" class="form-control" id="patient_rdv" placeholder="Saisie Obligatoire" autocomplete="off">
                        </div>
                        <div class="input-group">
                            <div class="suggestions w-100" id="suggestions_patient" style="display: none;">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" id="date_rdv" placeholder="Saisie Obligatoire" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Motif</label>
                        <textarea class="form-control" id="motif_rdv" rows="3" style="resize: none;"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" id="close_M_rdv" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-success" id="btn_eng_rdv">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Modif_Rdv_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mise à jour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <input type="hidden" id="medecin_id_rdvM">
                    <div class="mb-3">
                        <label class="form-label">Médecin</label>
                        <input readonly type="text" class="form-control" id="medecin_rdvM">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Spécialité</label>
                        <input readonly type="text" class="form-control" id="specialite_rdvM">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Patient</label>
                        <input readonly type="text" class="form-control" id="patient_rdvM" placeholder="Saisie Obligatoire" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" id="date_rdvM" placeholder="Saisie Obligatoire" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Motif</label>
                        <textarea class="form-control" id="motif_rdvM" rows="3" style="resize: none;"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-danger" data-bs-dismiss="modal">Fermer</a>
                <button type="button" class="btn btn-success" id="btn_update_rdv">Enregistrer</button>
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
                Voulez-vous vraiment Annulé ce Rendez-Vous
                <input type="hidden" id="Iddelete">
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end gap-2">
                    <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Non</a>
                    <button id="btn_delete_rdv" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Oui</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>
<script src="{{asset('jsPDF-AutoTable/dist/jspdf.plugin.autotable.min.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        select_medecin();
        list_rdv();
        rech_medecin();
        rech_specialite();
        rech_jour();
        list();
        Name_atient();

        document.getElementById("add_horaire").addEventListener("click", add_select);
        document.getElementById("btn_eng").addEventListener("click", eng);
        document.getElementById("btn_eng_rdv").addEventListener("click", eng_rdv);
        document.getElementById("btn_update_rdv").addEventListener("click", update_rdv);
        document.getElementById("btn_refresh").addEventListener("click", refresh);
        document.getElementById("btn_refresh_table_rdv").addEventListener("click", list_rdv);
        document.getElementById("statut_rdv").addEventListener("change", list_rdv);
        document.getElementById("btn_delete_rdv").addEventListener("click", delete_rdv);

        ["rech_medecin", "rech_specialite", "rech_jour", "rech_periode"].forEach(id => document.getElementById(id).addEventListener("change", list));

        function showAlert(title, message, type)
        {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
            });
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

        function select_medecin()
        {
            const selectElement = document.getElementById('medecin_id');
            // Clear existing options
            selectElement.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner un medecin';
            selectElement.appendChild(defaultOption);

            fetch('/api/list_medecin')
                .then(response => response.json())
                .then(data => {
                    const medecins = data.medecin;
                    medecins.forEach((item, index) => {
                        const option = document.createElement('option');
                        option.value = `${item.id}`; // Ensure 'id' is the correct key
                        option.textContent = `Dr. ${item.name}`; // Ensure 'nom' is the correct key
                        selectElement.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des societes:', error));

            selectElement.addEventListener('change', function() {
                const id = this.value;
                if (id) {
                    const url = '/api/select_jours';
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {

                            const jours = data.jour;

                            const contenuDiv = document.getElementById('contenu_horaire');
                            contenuDiv.innerHTML = '';
                                                    
                            addSelectHoraire(contenuDiv, jours);

                            document.getElementById('div_Horaire').style.display = "block";
                        })
                        .catch(error => {
                            console.error('Erreur lors du chargement des données:', error);
                        });
                }else{
                    const contenuDiv = document.getElementById('contenu_horaire');
                    contenuDiv.innerHTML = '';
                    document.getElementById('div_Horaire').style.display = "none";
                }
                
            });
        }

        function rech_medecin()
        {
            const selectElementRech = document.getElementById('rech_medecin');
            // Clear existing options
            selectElementRech.innerHTML = '';
            const defaultOption2 = document.createElement('option');
            defaultOption2.value = 'tout';
            defaultOption2.textContent = 'Tout';
            selectElementRech.appendChild(defaultOption2);

            fetch('/api/list_medecin')
                .then(response => response.json())
                .then(data => {
                    const medecins = data.medecin;
                    medecins.forEach((item, index) => {
                        const option2 = document.createElement('option');
                        option2.value = `${item.id}`; // Ensure 'id' is the correct key
                        option2.textContent = `Dr. ${item.name}`; // Ensure 'nom' is the correct key
                        selectElementRech.appendChild(option2);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des societes:', error));
        }

        function rech_specialite()
        {
            const selectElementRech = document.getElementById('rech_specialite');
            // Clear existing options
            selectElementRech.innerHTML = '';
            const defaultOption2 = document.createElement('option');
            defaultOption2.value = 'tout';
            defaultOption2.textContent = 'Tout';
            selectElementRech.appendChild(defaultOption2);

            fetch('/api/select_specialite')
                .then(response => response.json())
                .then(data => {
                    const rechs = data.typeacte;
                    rechs.forEach((item, index) => {
                        const option2 = document.createElement('option');
                        option2.value = `${item.id}`; // Ensure 'id' is the correct key
                        option2.textContent = `${item.nom}`; // Ensure 'nom' is the correct key
                        selectElementRech.appendChild(option2);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des societes:', error));
        }

        function rech_jour()
        {
            const selectElementRech = document.getElementById('rech_jour');
            // Clear existing options
            selectElementRech.innerHTML = '';
            const defaultOption2 = document.createElement('option');
            defaultOption2.value = 'tout';
            defaultOption2.textContent = 'Tout';
            selectElementRech.appendChild(defaultOption2);

            fetch('/api/select_jour')
                .then(response => response.json())
                .then(data => {
                    const rechs = data.rech;
                    rechs.forEach((item, index) => {
                        const option2 = document.createElement('option');
                        option2.value = `${item.id}`; // Ensure 'id' is the correct key
                        option2.textContent = `${item.jour}`; // Ensure 'nom' is the correct key
                        selectElementRech.appendChild(option2);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des societes:', error));
        }

        function addSelectHoraire(contenuDiv, jours)
        {

            const div = document.createElement('div');
            div.className = 'mb-3';

            // Créer le groupe de contrôle contenant le select et le bouton supprimer
            div.innerHTML = `
                <div class="input-group">
                    <select class="form-select jour-select w-25">
                        <option value="">Selectionner le jour</option>
                        ${jours.map(item => 
                            `<option value="${item.id}">
                                ${item.jour}
                            </option>`).join('')}
                    </select>
                    <select class="form-select periode-select w-25">
                        <option value="">Selectionner la période</option>
                        <option value="Matin">Matin</option>
                        <option value="Soir">Soir</option>
                    </select>
                    <span class="input-group-text">Heure debut : </span>
                    <input type="time" class="form-control heure-debut-input">
                    <span class="input-group-text">Heure Fin : </span>
                    <input type="time" class="form-control heure-fin-input">
                    <button class="btn btn-outline-danger suppr-btn">Supprimer</button>
                </div>
            `;

            // Ajouter l'élément dans le parent (contenu div)
            contenuDiv.appendChild(div);

            checkContenuHoraire();

            // Ajouter un event listener pour le bouton supprimer
            div.querySelector('.suppr-btn').addEventListener('click', () => {
                div.remove(); // Supprimer l'élément div parent
                checkContenuHoraire();
            });
        }

        function checkContenuHoraire()
        {
            const contenuDiv = document.getElementById('contenu_horaire');
            const divBtn = document.getElementById('div_btn_horaire');
            // Si la div #contenu a un contenu, on affiche le bouton, sinon on le cache
            if (contenuDiv.innerHTML.trim() !== "") {
                divBtn.style.display = "block"; // Afficher le bouton
            } else {
                divBtn.style.display = "none";  // Cacher le bouton
            }
        }

        function add_select()
        {
            const contenuDiv = document.getElementById('contenu_horaire');
            const id = document.getElementById('medecin_id').value;

            if (id == '') {
                showAlert("ALERT", "Selectionner un médecin SVP.", "warning");
                return false;
            }

            const url = '/api/select_jours';
                fetch(url)
                    .then(response => response.json())
                    .then(data => {

                        const jours = data.jour;
                                                
                        addSelectHoraire(contenuDiv, jours); // Ajouter le premier select
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des données:', error);
                    });
        }

        function Verification() {

            let formIsValid = true;
            const medecin_id = document.getElementById('medecin_id').value;

            if (medecin_id === '') {
                showAlert("ALERT", "Veuillez sélectionner un médecin SVP.", "warning");
                formIsValid = false;
                return false;
            }

            const contenuDiv = document.getElementById('contenu_horaire');
            if (contenuDiv.innerHTML.trim() === "") {
                showAlert("ALERT", 'Aucun horaire n\'a été ajouté.', "warning");
                formIsValid = false;
                return false;
            }

            const jourSelects = document.querySelectorAll('.jour-select');
            const periodeSelects = document.querySelectorAll('.periode-select');
            const heureDebutInputs = document.querySelectorAll('.heure-debut-input');
            const heureFinInputs = document.querySelectorAll('.heure-fin-input');

            jourSelects.forEach((item, index) => {
                const jourValue = item.value;
                const periodeValue = periodeSelects[index].value;
                const heureDebut = heureDebutInputs[index].value;
                const heureFin = heureFinInputs[index].value;

                if (!jourValue) {
                    showAlert("ALERT", 'Veuillez sélectionner un jour pour chaque horaire.', "warning");
                    formIsValid = false;
                    return false;
                }

                if (!periodeValue) {
                    showAlert("ALERT", 'Veuillez sélectionner une période (Matin ou Soir).', "warning");
                    formIsValid = false;
                    return false;
                }

                if (!heureDebut) {
                    showAlert("ALERT", 'Veuillez sélectionner une heure de début.', "warning");
                    formIsValid = false;
                    return false;
                }

                if (!heureFin) {
                    showAlert("ALERT", 'Veuillez sélectionner une heure de fin.', "warning");
                    formIsValid = false;
                    return false;
                }

                // Vérification que l'heure de fin est bien après l'heure de début
                if (heureDebut >= heureFin) {
                    showAlert("ALERT", 'L\'heure de fin doit être supérieure à l\'heure de début.', "warning");
                    formIsValid = false;
                    return false;
                }
            });

            return formIsValid;
        }

        function eng()
        {

            try {
                const isValid = Verification();
                if (!isValid) {
                    return false;
                }
            } catch (error) {
                showAlert("ALERT", 'Veuillez bien definir tous les horaires SVP', "warning");
                return false;
            }
            
            const selectionsHoraire = [];
            const jourSelects = document.querySelectorAll('.jour-select');
            const periodeSelects = document.querySelectorAll('.periode-select');
            const heureDebutInputs = document.querySelectorAll('.heure-debut-input');
            const heureFinInputs = document.querySelectorAll('.heure-fin-input');

            jourSelects.forEach((item, index) => {
                const selectedJourOption = item.options[item.selectedIndex];
                const jourId = selectedJourOption.value; // ID du jour sélectionné

                const selectedPeriodeOption = periodeSelects[index].options[periodeSelects[index].selectedIndex];
                const periode = selectedPeriodeOption.value; // Période sélectionnée

                const heureDebut = heureDebutInputs[index].value; // Heure de début sélectionnée
                const heureFin = heureFinInputs[index].value;     // Heure de fin sélectionnée

                selectionsHoraire.push({
                    jour_id: jourId,
                    periode: periode,
                    heure_debut: heureDebut,
                    heure_fin: heureFin,
                });
            });

            const medecin_id = document.getElementById('medecin_id').value;

            if (medecin_id == '') {
                showAlert("ALERT", 'Veuillez selectionner un médecin SVP.', "warning");
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
                url: '/api/new_horaire',
                method: 'GET',
                data:{
                    selections: selectionsHoraire,
                    medecin_id: medecin_id,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.success) {

                        document.getElementById('medecin_id').value = "";
                        document.getElementById('div_Horaire').style.display = "none";

                        list();   

                        showAlert("ALERT", 'Enregistrement éffectué', "success");

                    } else if (response.error) {
                        showAlert("ERREUR", 'Une erreur est survenue', "error");
                    } else if (response.json) {
                        showAlert("ERREUR", 'Invalid selections format', "error");
                    }

                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert("ERREUR", 'Une erreur est survenue lors de l\'enregistrement', "error");
                }
            });
        };

        function refresh()
        {
            document.getElementById('rech_medecin').value = "tout";
            document.getElementById('rech_specialite').value = "tout";
            document.getElementById('rech_jour').value = "tout";
            document.getElementById('rech_periode').value = "tout";

            list();
        }

        function list() 
        {
            const tableBody = document.getElementById('table');
            const messageDiv = document.getElementById('message');
            const loaderDiv = document.getElementById('loader');

            // Récupération des filtres
            const medecin = document.getElementById('rech_medecin').value;
            const specialite = document.getElementById('rech_specialite').value;
            const jour = document.getElementById('rech_jour').value;
            const periode = document.getElementById('rech_periode').value;

            const url = `/api/list_horaire/${medecin}/${specialite}/${jour}/${periode}`;

            // Afficher le loader
            messageDiv.style.display = 'none';
            tableBody.style.display = 'none';
            loaderDiv.style.display = 'block';

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const medecins = data.medecins;
                    tableBody.innerHTML = '';

                    if (medecins.length > 0) {

                        messageDiv.style.display = 'none';
                        loaderDiv.style.display = 'none';
                        tableBody.style.display = 'block';

                        medecins.forEach((medecin) => {

                            let horairesList = '';

                            if (medecin.horaires.length > 0) {
                                horairesList = medecin.horaires.map(horaire => `
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>${horaire.jour} ${horaire.periode}</div>
                                        <div>${horaire.heure_debut} à ${horaire.heure_fin}</div>
                                        <div>
                                            <a id="deleteH-${horaire.id}" class="btn btn-sm btn-outline-danger rounded-5">
                                                <i class="ri-close-fill"></i>
                                            </a>
                                        </div>
                                    </li>
                                `).join('');
                            } else {
                                // Si aucun horaire n'est trouvé, afficher ce message
                                horairesList = `
                                    <li class="list-group-item text-center">
                                        Aucun horaire n'a été trouvé.
                                    </li>
                                `;
                            }

                            const div = document.createElement('div');
                            div.classList.add('col-xxl-3', 'col-sm-6', 'col-12', 'mb-3');

                            let buttonRdv = '';

                            if (medecin.horaires.length > 0) {
                                buttonRdv = `
                                    <a class="btn btn-outline-success mb-3" data-bs-toggle="modal" data-bs-target="#Rdv_modal" id="rdv-${medecin.id}">
                                        <i class="ri-calendar-schedule-line"></i>
                                        Prendre Rendez-Vous
                                    </a>
                                `;
                            }

                            div.innerHTML = `
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <a class="d-flex align-items-center flex-column">
                                                <img src="{{asset('assets/images/docteur.png')}}" class="img-7x rounded-circle mb-3">
                                                <h6>Dr. ${medecin.name}</h6>
                                                <h6 class="text-primary">${medecin.specialité}</h6>
                                                ${buttonRdv}
                                                <ul class="list-group">
                                                    ${horairesList}
                                                </ul>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `;

                            tableBody.appendChild(div);

                            medecin.horaires.forEach(horaire => {
                                const boutonModif = document.getElementById(`deleteH-${horaire.id}`);
                                boutonModif.addEventListener('click', () => {

                                    var preloader_ch = `
                                        <div id="preloader_ch">
                                            <div class="spinner_preloader_ch"></div>
                                        </div>
                                    `;
                                    // Add the preloader to the body
                                    document.body.insertAdjacentHTML('beforeend', preloader_ch);
                                    
                                    $.ajax({
                                        url: `/api/update_horaire/${horaire.id}`,
                                        method: 'GET',
                                        success: function(response) {

                                            var preloader = document.getElementById('preloader_ch');
                                            if (preloader) {
                                                preloader.remove();
                                            }
                                            
                                            if (response.success) {
                                                refresh();   
                                                showAlert("ALERT", 'Mise à jour éffectué', "success");

                                            } else if (response.error) {
                                                showAlert("ERREUR", 'Une erreur est survenue', "error");
                                            }

                                        },
                                        error: function() {
                                            var preloader = document.getElementById('preloader_ch');
                                            if (preloader) {
                                                preloader.remove();
                                            }

                                            showAlert("ERREUR", 'Une erreur est survenue lors de la mise à jour', "error");
                                        }
                                    });
                                });
                            });

                            const rdvButton = document.getElementById(`rdv-${medecin.id}`);
                            if (rdvButton) {
                                rdvButton.addEventListener('click', () => {
                                    document.getElementById('medecin_id_rdv').value = `${medecin.id}`;
                                    document.getElementById('medecin_rdv').value = `Dr. ${medecin.name}`;
                                    document.getElementById('specialite_rdv').value = `${medecin.specialité}`;

                                    document.getElementById('date_rdv').value = "";
                                    document.getElementById('patient_id_rdv').value = "";
                                    document.getElementById('patient_rdv').value = "";
                                    document.getElementById('motif_rdv').value = "";

                                    const allowedDays = medecin.horaires.map(horaire => horaire.jour);

                                    const dateInput = document.getElementById('date_rdv');
                                    let previousDate = dateInput.value; // Track previous date

                                    dateInput.addEventListener('blur', (event) => {
                                        if (!event.target.value) return;

                                        const selectedDate = new Date(event.target.value);
                                        const selectedDay = selectedDate.getDay();

                                        const dayMapping = {
                                            'DIMANCHE': 0,
                                            'LUNDI': 1,
                                            'MARDI': 2,
                                            'MERCREDI': 3,
                                            'JEUDI': 4,
                                            'VENDREDI': 5,
                                            'SAMEDI': 6
                                        };

                                        const isValidDay = allowedDays.some(day => dayMapping[day] === selectedDay);

                                        if (!isValidDay) {
                                            dateInput.value = previousDate;
                                            showAlert("ALERT", 'Veuillez sélectionner un jour valide selon les horaires du médecin.', "info");
                                        } else {
                                            previousDate = dateInput.value;
                                        }
                                    });

                                });
                            }

                        });

                    } else {
                        messageDiv.style.display = 'block';
                        tableBody.style.display = 'none';
                        loaderDiv.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des données:', error);
                    messageDiv.style.display = 'block';
                    tableBody.style.display = 'none';
                    loaderDiv.style.display = 'none';
                });
        }

        function Name_atient() {
            $.ajax({
                url: '/api/name_patient',
                method: 'GET',
                success: function(response) {
                    // Récupérer les données de l'API
                    const data = response.name;

                    // Élément de l'input et autres éléments HTML
                    const input = document.getElementById('patient_rdv');
                    const patient_id = document.getElementById('patient_id_rdv');
                    const suggestionsDiv = document.getElementById('suggestions_patient');

                    // Fonction pour afficher les suggestions
                    function displaySuggestions() {
                        const searchTerm = input.value.toLowerCase();
                        
                        // Vider les suggestions précédentes
                        suggestionsDiv.style.display = 'block';
                        suggestionsDiv.innerHTML = '';

                        // Filtrer les données en fonction de l'input
                        const filteredData = data.filter(item => item.np.toLowerCase().includes(searchTerm));

                        // Afficher les suggestions filtrées
                        filteredData.forEach(item => {
                            const suggestion = document.createElement('div');
                            suggestion.innerText = item.np;
                            suggestion.addEventListener('click', function() {
                                input.value = item.np;
                                patient_id.value = item.id;
                                suggestionsDiv.innerHTML = '';
                                suggestionsDiv.style.display = 'none';
                            });
                            suggestionsDiv.appendChild(suggestion);
                        });

                        // Afficher/masquer les suggestions en fonction du résultat
                        suggestionsDiv.style.display = filteredData.length > 0 ? 'block' : 'none';
                    }

                    // Afficher les suggestions dès que l'input est focus
                    input.addEventListener('focus', function() {
                        displaySuggestions(); // Afficher les suggestions dès que le curseur est sur l'input
                    });

                    // Mettre à jour les suggestions lors de la saisie
                    input.addEventListener('input', function() {
                        displaySuggestions(); // Afficher les suggestions pendant la saisie
                    });

                    // Masquer les suggestions quand on clique en dehors de l'input ou des suggestions
                    document.addEventListener('click', function(e) {
                        if (!suggestionsDiv.contains(e.target) && e.target !== input) {
                            suggestionsDiv.style.display = 'none';
                        }
                    });
                },
                error: function() {
                    console.error('Erreur lors du chargement des patients');
                }
            });
        }

        function eng_rdv()
        {
            const medecin_id = document.getElementById('medecin_id_rdv');
            const patient_id = document.getElementById('patient_id_rdv');
            const date_rdv = document.getElementById('date_rdv');
            const motif_rdv = document.getElementById('motif_rdv');

            if (!medecin_id.value.trim() || !patient_id.value.trim() || !date_rdv.value.trim() || !motif_rdv.value.trim()) {
                showAlert("ALERT", 'Veuillez remplir tous les champs.', "warning");
                return false;
            }

            var modal = bootstrap.Modal.getInstance(document.getElementById('Rdv_modal'));
            modal.hide();

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/new_rdv',
                method: 'GET',
                data:{
                    medecin_id: medecin_id.value,
                    patient_id: patient_id.value,
                    date: date_rdv.value,
                    motif: motif_rdv.value,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.success) {

                        list_rdv();
                        count_rdv_two_day();

                        showAlert("ALERT", 'Enregistrement éffectué', "success");

                    } else if (response.error) {
                        showAlert("ERREUR", 'Une erreur est survenue', "error");
                    } else if (response.json) {
                        showAlert("ERREUR", 'Invalid selections format', "error");
                    }

                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert("ERREUR", 'Une erreur est survenue lors de l\'enregistrement', "error");
                }
            });
        }

        function list_rdv(page = 1) {

            const tableBody = document.querySelector('#Table_rdv tbody');
            const messageDiv = document.getElementById('message_Table_rdv');
            const tableDiv = document.getElementById('div_Table_rdv');
            const loaderDiv = document.getElementById('div_Table_loader_rdv');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const statut = document.getElementById('statut_rdv').value;
            const url = `/api/list_rdv/${statut}?page=${page}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const rdvs = data.rdv || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    tableBody.innerHTML = '';

                    if (rdvs.length > 0) {

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                            rdvs.forEach((item, index) => {

                                let button = '';

                                if (item.statut == 'en attente') {
                                    button = `
                                        <a class="btn btn-outline-info btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Modif_Rdv_modal" id="modif-${item.id}">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <a class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mdelete" id="delete-${item.id}">
                                            <i class="ri-delete-bin-line"></i>
                                        </a>
                                    `;
                                }

                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                    <td>${item.patient}</td>
                                    <td>+225 ${item.patient_tel}</td>
                                    <td>Dr. ${item.medecin}</td>
                                    <td>${item.specialite}</td>
                                    <td>${formatDate(item.date)}</td>
                                    <td>
                                        <span class="badge ${item.statut === 'en attente' ? 'bg-danger' : 'bg-success'}">
                                            ${item.statut}
                                        </span>
                                    </td>
                                    <td>${formatDateHeure(item.created_at)}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a class="btn btn-outline-warning btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Detail_motif" id="motif-${item.id}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            ${button}
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

                                const modifButton = document.getElementById(`modif-${item.id}`);
                                if (modifButton) {
                                    modifButton.addEventListener('click', () => {
                                        document.getElementById('medecin_id_rdvM').value = item.id;
                                        document.getElementById('date_rdvM').value = item.date;
                                        document.getElementById('date_rdvM').min = item.date; 
                                        document.getElementById('patient_rdvM').value = item.patient;
                                        document.getElementById('motif_rdvM').value = item.motif;
                                        document.getElementById('medecin_rdvM').value = item.medecin;
                                        document.getElementById('specialite_rdvM').value = item.specialite;

                                        const allowedDays = item.horaires.map(horaire => horaire.jour);

                                        const dateInput = document.getElementById('date_rdvM');
                                        dateInput.addEventListener('blur', (event) => {

                                            const selectedDate = new Date(event.target.value);
                                            const selectedDay = selectedDate.getDay();

                                            const dayMapping = {
                                                'DIMANCHE': 0,
                                                'LUNDI': 1,
                                                'MARDI': 2,
                                                'MERCREDI': 3,
                                                'JEUDI': 4,
                                                'VENDREDI': 5,
                                                'SAMEDI': 6
                                            };

                                            const isValidDay = allowedDays.some(day => dayMapping[day] === selectedDay);

                                            if (!isValidDay) {
                                                dateInput.value = item.date;
                                                showAlert("ALERT", 'Veuillez sélectionner un jour valide selon les horaires du médecin.', "info");
                                            }
                                        });
                                    });
                                }

                                document.getElementById(`motif-${item.id}`).addEventListener('click', () =>
                                {
                                    const modal = document.getElementById('modal_Detail_motif');
                                    modal.innerHTML = '';

                                    const div = document.createElement('div');
                                    div.innerHTML = `
                                           <div class="row gx-3">
                                                <div class="col-12">
                                                    <div class=" mb-3">
                                                        <div class="card-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item active text-center" aria-current="true">
                                                                    Motif
                                                                </li>
                                                                <li class="list-group-item">
                                                                    ${item.motif} 
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>     
                                    `;

                                    modal.appendChild(div);

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

        function updatePaginationControls(pagination) {
            const paginationDiv = document.getElementById('pagination-controls_rdv');
            paginationDiv.innerHTML = '';

            // Bootstrap pagination wrapper
            const paginationWrapper = document.createElement('ul');
            paginationWrapper.className = 'pagination justify-content-center';

            // Previous button
            if (pagination.current_page > 1) {
                const prevButton = document.createElement('li');
                prevButton.className = 'page-item';
                prevButton.innerHTML = `<a class="page-link" href="#">Precédent</a>`;
                prevButton.onclick = () => list_rdv(pagination.current_page - 1);
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
                pageItem.onclick = () => list_rdv(i);
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
                lastPageItem.onclick = () => list_rdv(totalPages);
                paginationWrapper.appendChild(lastPageItem);
            }

            // Next button
            if (pagination.current_page < pagination.last_page) {
                const nextButton = document.createElement('li');
                nextButton.className = 'page-item';
                nextButton.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                nextButton.onclick = () => list_rdv(pagination.current_page + 1);
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

        function delete_rdv() {

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
                url: '/api/delete_rdv/'+id,
                method: 'GET',
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {
                        list_rdv();
                        count_rdv_two_day();
                        showAlert('Succès', 'Rendez-Vous annulé.','success');
                    } else if (response.error) {
                        showAlert("ERREUR", 'Une erreur est survenue', "error");
                    }
                
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Erreur', 'Erreur lors de la suppression.','error');
                }
            });
        }

        function update_rdv()
        {
            const id = document.getElementById('medecin_id_rdvM').value;
            const date_rdv = document.getElementById('date_rdvM');
            const motif_rdv = document.getElementById('motif_rdvM');

            if (!date_rdv.value.trim() || !motif_rdv.value.trim()) {
                showAlert("ALERT", 'Veuillez remplir tous les champs.', "warning");
                return false;
            }

            var modal = bootstrap.Modal.getInstance(document.getElementById('Modif_Rdv_modal'));
            modal.hide();

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/update_rdv/' + id,
                method: 'GET',
                data:{
                    date: date_rdv.value,
                    motif: motif_rdv.value,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.success) {

                        list_rdv();
                        count_rdv_two_day();
                        showAlert("ALERT", 'Mise à jour éffectué', "success");

                    } else if (response.error) {
                        showAlert("ERREUR", 'Une erreur est survenue', "error");
                    }

                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert("ERREUR", 'Une erreur est survenue lors de l\'enregistrement', "error");
                }
            });
        }

        function count_rdv_two_day() {

                fetch('/api/count_rdv_two_day')
                    .then(response => response.json())
                    .then(data => {
                        const nbre = data.nbre || 0;

                        document.getElementById('div_two_rdv').innerHTML = '';

                        if (nbre > 0) {

                            const div = `
                                <div class="sidebar-contact" style="background-color: red;">
                                    <a class="text-white" href="{{route('rdv_two_day')}}">
                                        <p class="fw-light mb-1 text-nowrap text-truncate">Rendez-Vous dans 2 jours</p>
                                        <h5 class="m-0 lh-1 text-nowrap text-truncate">${nbre}</h5>
                                        <i class="ri-calendar-schedule-line"></i>
                                    </a>
                                </div>
                            `;

                            document.getElementById('div_two_rdv').innerHTML = div;
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }

    });
</script>


@endsection
