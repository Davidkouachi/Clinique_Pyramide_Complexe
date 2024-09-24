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
            Tableau de bord
        </li>
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <div class="row gx-3">
        <div class="col-xxl-9 col-sm-12">
            <div class="card mb-3 bg-2 rounded-2">
                <div class="card-body rounded-2" style="background: rgba(0, 0, 0, 0.7);">
                    <div class="mh-230">
                        <div class="text-white">
                            <h6>Bienvenue,</h6>
                            <h2>{{Auth::user()->sexe.'. '.Auth::user()->name}}</h2>
                            <h5>Les statistiques d'aujourd'hui.</h5>
                            <div class="mt-4 row gx-3">
                                <div class="d-flex align-items-center col-xxl-3 col-lg-4 col-sm-6 col-12 mb-3 ">
                                    <div class="icon-box lg bg-info rounded-5 me-3">
                                        <i class="ri-walk-line fs-1"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h4 id="nbre_patient_day" class="m-0 lh-1"></h4>
                                        <p class="m-0">Patients</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center col-xxl-3 col-lg-4 col-sm-6 col-12 mb-3">
                                    <div class="icon-box lg bg-success rounded-5 me-3">
                                        <i class="ri-walk-line fs-1"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h4 id="nbre_patient_assurer_day" class="m-0 lh-1"></h4>
                                        <p class="m-0">assurer</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center col-xxl-3 col-lg-4 col-sm-6 col-12 mb-3">
                                    <div class="icon-box lg bg-danger rounded-5 me-3">
                                        <i class="ri-walk-line fs-1"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h4 id="nbre_patient_nassurer_day" class="m-0 lh-1"></h4>
                                        <p class="m-0">non-assurer</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center col-xxl-3 col-lg-4 col-sm-6 col-12 mb-3">
                                    <div class="icon-box lg bg-warning rounded-5 me-3">
                                        <i class="ri-cash-line fs-1"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h4 id="prix_cons_day" class="m-0 lh-1"></h4>
                                        <p class="m-0">Total</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-12">
            <div class="card mb-3 bg-lime">
                <div class="card-body">
                    <div class="mh-230 text-white">
                        <h5>Activités de la semaine</h5>
                        <div class="text-body chart-height-md" style="margin-top: -30px;">
                            <div id="docActivity"></div>
                        </div>
                        <div id="consultationComparison" style="margin-top: -10px;" ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gx-3 mb-3" id="stat_consultation">
        <div id="div_Table_loader_Cons" style="display: none;">
            <div class="d-flex justify-content-center align-items-center">
                <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                <strong>Chargement des données...</strong>
            </div>
        </div>
    </div>

    <div class="row gx-3" >
        <div class="col-sm-12">
            <div class="card mb-3">
                <div class="card-header" hidden >
                    <h5 class="card-title">Réception</h5>
                </div>
                <div class="p-2" id="div_alert" >
                    
                </div>
                <div class="card-body" style="margin-top: -30px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center bg-primary bg-2" id="customTab4" role="tablist" style="background: rgba(0, 0, 0, 0.7);">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Nouveau patient
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-white" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab" aria-controls="oneAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Nouvelle consultation
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  text-white" id="tab-threeAAA" data-bs-toggle="tab" href="#threeAAA" role="tab" aria-controls="threeAAA" aria-selected="true">
                                    <i class="ri-shake-hands-line me-2"></i>
                                    Nouvelle societe
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  text-white" id="tab-frewAAA" data-bs-toggle="tab" href="#frewAAA" role="tab" aria-controls="frewAAA" aria-selected="true">
                                    <i class="ri-shake-hands-line me-2"></i>
                                    Nouvelle Assurance
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane fade active show" id="oneAAA" role="tabpanel" aria-labelledby="tab-oneAAA">
                                <div class="card-header">
                                    <h5 class="card-title text-center">Recherche</h5>
                                </div>
                                <div class="row gx-3">
                                    <div class="row gx-3 justify-content-center align-items-center" >
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Nom du patient
                                                </label>
                                                <div class="input-group">
                                                    <input type="hidden" class="form-control" id="matricule_patient" autocomplete="off">
                                                    <input type="text" class="form-control" id="name_rech" name="np" placeholder="Saisie Obligatoire" autocomplete="off">
                                                    <button hidden id="btn_rech_num_dossier" class="btn btn-outline-success">
                                                        <i class="ri-search-line"></i>
                                                    </button>
                                                </div>
                                                <div class="suggestions" id="suggestions" style="display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" id="div_info_patient">
                                    </div>
                                    <div class="col-sm-12" id="div_info_consul" style="display: none;">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">
                                                ACTE A EFFECTUER
                                            </h5>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Période</label>
                                                    <div class="m-0">
                                                        <div class="form-check form-check-inline">
                                                            <input checked class="form-check-input" type="radio" id="jourO" name="periode_consul" value="jour ouvrable">
                                                            <label class="form-check-label" for="jourO">Jour Ouvrable</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="Nuit" name="periode_consul" value="nuit">
                                                            <label class="form-check-label" for="Nuit">Nuit</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="jourF" name="periode_consul" value="jour ferier">
                                                            <label class="form-check-label" for="jourF">Jour Ferié</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label">Motif</label>
                                                    <select class="form-select" id="acte_id">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_typeacteS" style="display: block;">
                                                <div class="mb-3">
                                                    <label class="form-label">Spécialité</label>
                                                    <select class="form-select" id="typeacte_idS">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_medecin" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label">Medecin</label>
                                                    <select class="form-select" id="medecin_id">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-header text-center">
                                                <h5 class="card-title">Information Caisse</h5>
                                            </div>
                                            <div class="row gx-3">
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Part Assurance</span>
                                                            <input readonly type="tel" class="form-control" id="montant_assurance">
                                                            <input type="hidden" class="form-control" id="montant_assurance_hidden">
                                                            <span class="input-group-text">Fcfa</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Part Patient</span>
                                                            <input readonly type="tel" class="form-control" id="montant_patient">
                                                            <input type="hidden" class="form-control" id="montant_patient_hidden">
                                                            <span class="input-group-text">Fcfa</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Montant Total</span>
                                                            <input readonly type="tel" class="form-control" id="montant_total">
                                                            <span class="input-group-text">Fcfa</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_remise" style="display: none;">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Remise</span>
                                                            <input type="tel" class="form-control" id="taux_remise" value="0">
                                                            <span class="input-group-text">Fcfa</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_remise_appliq" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label">Application de la remise</label>
                                                    <select class="form-select" id="appliq_remise">
                                                        <option selected value="patient">Patient</option>
                                                        <option value="assurance">Assurance</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="d-flex gap-2 justify-content-start">
                                                    <a href="javascript:location.reload();" class="btn btn-outline-danger">
                                                        Rémise à zéro
                                                    </a>
                                                    <button id="btn_eng_consultation" class="btn btn-success">
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="twoAAA" role="tabpanel" aria-labelledby="tab-twoAAA">
                                <div class="card-header">
                                    <h5 class="card-title">Formulaire Nouveau Patient</h5>
                                </div>
                                <div class="row gx-3">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nom et Prénoms</label>
                                            <input type="text" class="form-control" id="patient_np_new" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Date de naissance
                                            </label>
                                            <input type="date" class="form-control" placeholder="Selectionner une date" id="patient_datenaiss_new">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" id="patient_email_new" placeholder="facultatif">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Contact</label>
                                            <input type="tel" class="form-control" id="patient_tel_new" placeholder="Saisie Obligatoire" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Contact 2</label>
                                            <input type="tel" class="form-control" id="patient_tel2_new" placeholder="facultatif" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Adresse</label>
                                            <input type="text" class="form-control" id="patient_adresse_new" placeholder="Saisie Obligatoire">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Sexe</label>
                                            <select class="form-select" id="patient_sexe_new">
                                                <option value="">Selectionner</option>
                                                <option value="M">Homme</option>
                                                <option value="Mme">Femme</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Assurer</label>
                                            <select class="form-select" id="assurer">
                                                <option selected value="non">Non</option>
                                                <option value="oui">Oui</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row gx-3" id="div_assurer" style="display: none;" >
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Filiation</label>
                                                <select class="form-select" id="patient_filiation_new">
                                                    <option value="">Selectionner</option>
                                                    <option value="Adhérent(e)">Adhérent(e)</option>
                                                    <option value="Bénéficiaire">Bénéficiaire</option>
                                                    <option value="Conjoint(e)">Conjoint(e)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Assurance</label>
                                                <select class="form-select" id="patient_assurance_id_new">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Matricule assurance</label>
                                                <input type="text" class="form-control" id="patient_matriculeA_new" placeholder="Saisie Obligatoire">
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Taux</label>
                                                <select class="form-select" id="patient_taux_id_new">
                                                    <option value="">Sélectionner un taux</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Société</label>
                                                <select class="form-select" id="patient_societe_id_new">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="d-flex gap-2 justify-content-start">
                                            <button id="btn_eng_patient" class="btn btn-success">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="threeAAA" role="tabpanel" aria-labelledby="tab-threeAAA">
                                <div class="card-header">
                                    <h5 class="card-title">Formulaire Nouvelle Scoiété</h5>
                                </div>
                                <div class="row gx-3 justify-content-center align-items-center">
                                    <div class="col-xxl-6 col-lg-8 col-sm-10">
                                        <div class="mb-3">
                                            <label class="form-label">Nom de la société</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="societe_new" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                                                <button id="btn_eng_societe" class="btn btn-outline-success">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="frewAAA" role="tabpanel" aria-labelledby="tab-frewAAA">
                                <div class="card-header">
                                    <h5 class="card-title">Formulaire Nouvelle Assurance</h5>
                                </div>
                                <div class="row gx-3">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="nom_assurance_new" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input required type="email" class="form-control" id="email_assurance_new" placeholder="Saisie Obligatoire">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Contact</label>
                                            <input type="tel" class="form-control" id="tel_assurance_new" placeholder="Saisie Obligatoire" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Contact 2</label>
                                            <input type="tel" class="form-control" id="tel2_assurance_new" placeholder="facultatif" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" >Fax</label>
                                            <input type="text" class="form-control" id="fax_assurance_new" placeholder="Saisie Obligatoire">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Adresse</label>
                                            <input type="text" class="form-control" id="adresse_assurance_new" placeholder="Saisie Obligatoire">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="d-flex gap-2 justify-content-start">
                                            <button id="btn_eng_assurance" class="btn btn-success">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2" id="div_alert_consultation" >
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row gx-3" >
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        Patient recu Aujourd'hui
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
                                        <th scope="col">Code</th>
                                        <th scope="col">N° dossier</th>
                                        <th scope="col">Nom et Prénoms</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Motif</th>
                                        <th scope="col">Détail</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="message_Table" style="display: none;">
                        <p class="text-center" >
                            Aucun patient recu aujourd'hui
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

</div>
<script src="{{asset('assets/vendor/apex/apexcharts.min.js')}}"></script>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
{{-- <script src="https://unpkg.com/jspdf-invoice-template@1.4.4/dist/index.js"></script> --}}
<script src="{{asset('assets/js/app/js/jspdfinvoicetemplate/dist/index.js')}}" ></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        Statistique();
        Activity_cons();
        Activity_cons_count();
        Statistique_cons();
        Name_atient();
        select_taux();
        select_societe_patient();
        select_assurance_patient();
        list_cons();

        // ------------------------------------------------------------------

        document.getElementById("btn_eng_consultation").addEventListener("click", eng_consultation);
        document.getElementById("btn_refresh_table").addEventListener("click", list_cons);
        document.getElementById("btn_rech_num_dossier").addEventListener("click", rech_dosier);
        document.getElementById("acte_id").addEventListener("change", select_list_typeacte);
        document.getElementById("btn_eng_societe").addEventListener("click", eng_societe);
        document.getElementById("btn_eng_assurance").addEventListener("click", eng_assurance);
        document.getElementById("btn_eng_patient").addEventListener("click", eng_patient);

        // ------------------------------------------------------------------

        var inputs = ['tel_assurance_new', 'tel2_assurance_new', 'patient_tel_new', 'patient_tel2_new', 'taux_remise', 'montant_assurance', 'montant_patient']; // Array of element IDs
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

        document.getElementById('taux_remise').addEventListener('input', function() {
            this.value = formatPrice(this.value);
            if (this.value !== ''){
                document.getElementById('div_remise_appliq').style.display = 'block';
            }else{
                document.getElementById('div_remise_appliq').style.display = 'none';
            }
        });

        document.getElementById('typeacte_idS').addEventListener('change', function() {
            if (this.value !== ''){
                document.getElementById('div_remise').style.display = 'block';
            }else{
                document.getElementById('div_remise').style.display = 'none';
            }
        });

        document.getElementById('assurer').addEventListener('change', function() {

            if (this.value == 'oui'){
                document.getElementById("div_assurer").style.display = "flex";
            }else{
                document.getElementById("div_assurer").style.display = "none";
            }

        });

        document.getElementById('taux_remise').addEventListener('input', function() {
            // Nettoyer la valeur entrée en supprimant les caractères non numériques sauf le point
            const rawValue = this.value.replace(/[^0-9]/g, ''); // Supprimer tous les caractères non numériques
            // Ajouter des points pour les milliers
            const formattedValue = formatPrice(rawValue);
            
            // Mettre à jour la valeur du champ avec la valeur formatée
            this.value = formattedValue;

            const appliq_remise = document.getElementById('appliq_remise').value;

            if (appliq_remise == 'patient') {
                // Convertir la valeur formatée en nombre pour les calculs
                const montant_patient = parseInt(document.getElementById('montant_patient_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_patient - remise;
                document.getElementById('montant_patient').value = formatPriceT(montantRemis);
            }else{
                // Convertir la valeur formatée en nombre pour les calculs
                const montant_assurance = parseInt(document.getElementById('montant_assurance_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_assurance - remise;
                document.getElementById('montant_assurance').value = formatPriceT(montantRemis);
            }

        });

        document.getElementById('appliq_remise').addEventListener('change', function() {

            document.getElementById('montant_assurance').value = formatPrice(document.getElementById('montant_assurance_hidden').value);
            document.getElementById('montant_patient').value = formatPrice(document.getElementById('montant_patient_hidden').value);

            // Nettoyer la valeur entrée en supprimant les caractères non numériques sauf le point
            const rawValue = document.getElementById('taux_remise').value.replace(/[^0-9]/g, ''); // 

            if (this.value == 'patient') {
                // Convertir la valeur formatée en nombre pour les calculs
                const montant_patient = parseFloat(document.getElementById('montant_patient_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseFloat(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_patient - remise;
                document.getElementById('montant_patient').value = formatPriceT(montantRemis);
            }else{
                // Convertir la valeur formatée en nombre pour les calculs
                const montant_assurance = parseFloat(document.getElementById('montant_assurance_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseFloat(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_assurance - remise;
                document.getElementById('montant_assurance').value = formatPriceT(montantRemis);
            }

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

        // ------------------------------------------------------------------

        function Name_atient()
        {
            $.ajax({
                url: '/api/name_patient',
                method: 'GET',
                success: function(response) {
                    // Sample data array
                    const data = response.name;

                    // Elements
                    const input = document.getElementById('name_rech');
                    const matricule_patient = document.getElementById('matricule_patient');
                    const suggestionsDiv = document.getElementById('suggestions');

                    // Event listener for input typing
                    input.addEventListener('input', function() {
                        const searchTerm = input.value.toLowerCase();
                        
                        // Clear previous suggestions
                        suggestionsDiv.style.display = 'block';
                        suggestionsDiv.innerHTML = '';

                        // Filter data based on input
                        const filteredData = data.filter(item => item.np.toLowerCase().includes(searchTerm));

                        // Display filtered data
                        filteredData.forEach(item => {
                            const suggestion = document.createElement('div');
                            suggestion.innerText = item.np;
                            suggestion.addEventListener('click', function() {
                                // Set selected data in the input field
                                input.value = `${item.np}`;
                                matricule_patient.value = `${item.matricule}`;
                                suggestionsDiv.innerHTML = ''; // Clear suggestions
                                rech_dosier();
                            });
                            suggestionsDiv.appendChild(suggestion);
                        });

                        // Show/hide suggestions based on results
                        suggestionsDiv.style.display = filteredData.length > 0 ? 'block' : 'none';
                    });

                    // Hide suggestions when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!suggestionsDiv.contains(e.target) && e.target !== input) {
                            suggestionsDiv.style.display = 'none';
                        }
                    });
                },
                error: function() {
                }
            });
        }

        function rech_dosier()
        {
            document.getElementById('div_typeacteS').style.display = 'block';
            document.getElementById('div_medecin').style.display = 'block';
            document.getElementById('acte_id').value = '1';

            document.getElementById('montant_assurance').value = '0';
            document.getElementById('taux_remise').value = '0';
            document.getElementById('montant_total').value = '0';
            document.getElementById('montant_patient').value = '0';

            const matricule_patient = document.getElementById("matricule_patient");

            if(!matricule_patient.value.trim()){
                showAlert('warning', 'Veuillez saisie le nom d\'un du patient.');
                return false;
            }

            // Créer l'élément de préchargement
            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;

            // Ajouter le préchargeur au body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/rech_patient',
                method: 'GET',  // Use 'POST' for data creation
                data: { matricule: matricule_patient.value },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    if(response.existep) {

                        showAlert('warning', 'Ce patient n\'existe pas.');
                        Reset();
                    } else if (response.success) {
                        showAlert('success', 'Patient trouvé.');
                        addGroup(response.patient);
                        document.getElementById("div_info_consul").style.display = 'block';
                        select_list_typeacte();
                    }
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('danger', 'Une erreur est survenue lors de la recherche.');
                    societeInput.value = '';
                }
            });
        }

        function addGroup(data) {

            var dynamicFields = document.getElementById("div_info_patient");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var groupe = document.createElement("div");
            groupe.className = "row gx-3";
            groupe.innerHTML = `
                <div class="col-12">
                    <div class="card-header">
                        <h5 class="card-title">Information du patient</h5>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="email">Nom et Prénoms</label>
                        <input value="${data.np}" readonly class="form-control">
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="tel">Contact</label>
                        <input value="+225 ${data.tel}" readonly class="form-control">
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="adresse">Adresse</label>
                        <input value="${data.adresse}" readonly class="form-control">
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Assurer</label>
                        <input value="${data.assurer}" readonly class="form-control">
                    </div>
                </div>
            `;

            // Check if the patient has insurance and add the additional fields
            if (data.assurer === 'oui') {
                groupe.innerHTML += `
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Assurance</label>
                            <input value="${data.assurance}" readonly class="form-control" placeholder="Néant">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Taux</label>
                            <div class="input-group">      
                                <input id="patient_taux" value="${data.taux}" readonly class="form-control" placeholder="Néant">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Société</label>
                            <input value="${data.societe}" readonly class="form-control" placeholder="Néant">
                        </div>
                    </div>
                `;
            }else{
                groupe.innerHTML += `
                    <div class="col-xxl-3 col-lg-4 col-sm-6" hidden>
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Assurance</label>
                            <input value="Aucun" readonly class="form-control" placeholder="Néant">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-6" hidden>
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Taux</label>
                            <div class="input-group">      
                                <input id="patient_taux" value="0" readonly class="form-control" placeholder="Néant">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-6" hidden>
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Société</label>
                            <input value="Aucun" readonly class="form-control" placeholder="Néant">
                        </div>
                    </div>
                `;
            }

            dynamicFields.appendChild(groupe);
        }

        function showAlert(type, message) {

            var dynamicFields = document.getElementById("div_alert");
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
            document.getElementById("div_alert").appendChild(groupe);

            setTimeout(function() {
                groupe.classList.remove("show");
                groupe.classList.add("fade");
                setTimeout(function() {
                    groupe.remove();
                }, 150); // Time for the fade effect to complete
            }, 3000);
        }

        function showAlertConsultation(type, message) {

            var dynamicFields = document.getElementById("div_alert_consultation");
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
            document.getElementById("div_alert_consultation").appendChild(groupe);

            setTimeout(function() {
                groupe.classList.remove("show");
                groupe.classList.add("fade");
                setTimeout(function() {
                    groupe.remove();
                }, 150); // Time for the fade effect to complete
            }, 3000);
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

        function Reset() {

            var dynamicFields = document.getElementById("div_info_patient");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            document.getElementById("div_info_consul").style.display = 'none';
            document.getElementById("matricule_patient").value='';
        }

        // ------------------------------------------------------------------

        function select_taux()
        {
            const selectElement = document.getElementById('patient_taux_id_new');
            selectElement.innerHTML = '';

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner un taux';
            selectElement.appendChild(defaultOption);
            // Vérifie que l'élément select existe
            if (selectElement) {
                // Effectuer une requête pour récupérer les taux
                fetch('/api/taux_select_patient_new')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(taux => {
                            const option = document.createElement('option');
                            option.value = taux.id; // Assure-toi que 'id' est la clé correcte
                            option.textContent = taux.taux+'%'; // Assure-toi que 'nom' est la clé correcte
                            selectElement.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Erreur lors du chargement des taux:', error));
            }
        }

        function select_societe_patient()
        {
            const selectElement = document.getElementById('patient_societe_id_new');
            selectElement.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner une société';
            selectElement.appendChild(defaultOption);
            // Vérifie que l'élément select existe
            if (selectElement) {
                // Effectuer une requête pour récupérer les taux
                fetch('/api/societe_select_patient_new')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(societe => {
                            const option = document.createElement('option');
                            option.value = societe.id; // Assure-toi que 'id' est la clé correcte
                            option.textContent = societe.nom; // Assure-toi que 'nom' est la clé correcte
                            selectElement.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Erreur lors du chargement des societes:', error));
            }
        }

        function select_assurance_patient()
        {
            const selectElement = document.getElementById('patient_assurance_id_new');
            // Clear existing options
            selectElement.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner une Assurance';
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

        function select_list_medecin()
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
        }

        function select_list_acte() {
            const selectElement = document.getElementById('acte_id');

            // Clear existing options
            selectElement.innerHTML = '';

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner';
            selectElement.appendChild(defaultOption);

            $.ajax({
                url: '/api/list_acte',
                method: 'GET',
                success: function(response) {
                    data = response.acte;
                    data.forEach(acte => {
                        const option = document.createElement('option');
                        option.value = acte.id; // Ensure 'id' is the correct key
                        option.textContent = acte.nom; // Ensure 'nom' is the correct key
                        selectElement.appendChild(option);
                    });
                },
                error: function() {
                    // showAlert('danger', 'Impossible de generer le code automatiquement');
                }
            });
        }

        function select_list_typeacte() {
            const divTypeActe = document.getElementById('div_typeacteS'); // The whole div
            const divMedecin = document.getElementById('div_medecin');
            const typeActeSelect = document.getElementById('typeacte_idS');
            // const acteId = document.getElementById("acte_id").value;
            const acteId = '1';

            const montant_assurance = document.getElementById('montant_assurance');
            const taux_remise = document.getElementById('taux_remise');
            const montant_total = document.getElementById('montant_total');
            const montant_patient = document.getElementById('montant_patient');

            const montant_patient_hidden = document.getElementById('montant_patient_hidden');
            const montant_assurance_hidden = document.getElementById('montant_assurance_hidden');

            montant_assurance.value = '';
            montant_total.value = '';
            montant_patient.value = '';

            const patient_taux = document.getElementById('patient_taux');

            // Reset the select and hide the div initially
            typeActeSelect.innerHTML = '';
            divTypeActe.style.display = 'none';  // Hide div initially
            divMedecin.style.display = 'none'; 

            // Create a default option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionner';
            typeActeSelect.appendChild(defaultOption);

            // Validate if acteId is valid before making the AJAX request
             if (acteId) {
                $.ajax({
                    url: '/api/select_typeacte/' + acteId,
                    method: 'GET',
                    success: function(response) {
                        const data = response.typeacte; 

                        if (data && data.length > 0) {

                            // Populate the select with the response data
                            data.forEach(typeacte => {
                                const option = document.createElement('option');
                                option.value = typeacte.id; // Ensure 'id' is the correct key
                                option.textContent = typeacte.nom;
                                option.setAttribute('data-prix', typeacte.prix); // Ensure 'nom' is the correct key
                                typeActeSelect.appendChild(option);
                            });

                            divTypeActe.style.display = 'block';
                            divMedecin.style.display = 'block';

                            // Call the select_list_medecin() function to load the list of doctors
                            select_list_medecin();

                        } else {
                            // If no data, append a "No data available" option and hide the div
                            const noDataOption = document.createElement('option');
                            noDataOption.value = '';
                            noDataOption.textContent = 'Aucun données disponible';
                            typeActeSelect.appendChild(noDataOption);
                            divTypeActe.style.display = 'none';
                        }
                    },
                    error: function() {
                        console.error('Erreur lors du chargement des types d\'actes');
                        // Handle error case
                    }
                });

                typeActeSelect.addEventListener('change', function() {
                    const selectedOption = typeActeSelect.options[typeActeSelect.selectedIndex];
                    const prix = selectedOption.getAttribute('data-prix');

                    if (prix) {

                        calculateAndFormatAmounts(prix,patient_taux.value);

                    } else {
                        montant_total.value = '';
                        montant_assurance.value = '';
                        montant_patient.value = '';// Clear the field if no valid price
                    }

                });
            }
        }

        function calculateAndFormatAmounts(prix, patient_taux) {
            if (prix) {
                // Remove all dots and commas from price and convert to number
                let prixFloat = parseFloat(prix.replace(/[.,]/g, ''));
                if (isNaN(prixFloat)) {
                    console.error('Invalid price value');
                    montant_total.value = ''; // Clear the field if the price is invalid
                    return;
                }

                // Assign the total price
                montant_total.value = formatPrice(prix);

                // Ensure patient_taux is a valid number
                let tauxFloat = parseFloat(patient_taux);
                if (isNaN(tauxFloat)) {
                    tauxFloat = 0; // Set to 0 if patient_taux is not a number
                }

                if (tauxFloat === 0) {
                    montant_assurance.value = '0'; // No insurance coverage
                    montant_patient.value = formatPrice(prixFloat.toString());
                    montant_patient_hidden.value = formatPrice(prixFloat.toString());
                    montant_assurance_hidden.value = '0';
                } else {
                    // Calculate insurance amount and patient's amount
                    let montantAssurance = (tauxFloat / 100) * prixFloat;
                    let montantPatient = prixFloat - montantAssurance;

                    // Format the results and assign them
                    montant_assurance.value = formatPrice(montantAssurance.toString());
                    montant_patient.value = formatPrice(montantPatient.toString());

                    montant_patient_hidden.value = formatPrice(montantPatient.toString());
                    montant_assurance_hidden.value = formatPrice(montantAssurance.toString());
                }
            } else {
                montant_total.value = ''; // Clear the field if no valid price
            }
        }

        // ------------------------------------------------------------------

        function eng_societe()
        {
            const societeInput = document.getElementById("societe_new");

            var dynamicFields = document.getElementById("div_alert");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            if(societeInput.value == ''){
                showAlert('warning', 'Veuillez saisie le nom de la société SVP.');
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
                method: 'GET',  // Use 'POST' for data creation
                data: { societe: societeInput.value },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    if (response.warning) {
                        showAlert('warning', 'Cette société existe déjà.');
                    } else if (response.success) {
                        showAlert('success', 'Société Enregistrée.');
                    } else if (response.error) {
                        showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                    }
                    societeInput.value = '';
                    select_societe_patient();
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                    societeInput.value = '';
                }
            });
        }

        // ------------------------------------------------------------------

        function eng_assurance()
        {
            var nom = document.getElementById("nom_assurance_new");
            var email = document.getElementById("email_assurance_new");
            var phone = document.getElementById("tel_assurance_new");
            var phone2 = document.getElementById("tel2_assurance_new");
            var adresse = document.getElementById("adresse_assurance_new");
            var fax = document.getElementById("fax_assurance_new");

            if (!nom.value.trim() || !email.value.trim() || !phone.value.trim() || !adresse.value.trim() || !fax.value.trim()) {
                showAlert('warning', 'Tous les champs sont obligatoires.');
                return false; 
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) {  // Use email.value.trim() to check the actual input
                showAlert('warning', 'Email incorrect.');
                return false;
            }


            if (phone.value.length !== 10 || (phone2.value !== '' && phone2.value.length !== 10)) {
                showAlert('warning', 'Contact incomplet.');
                return false;
            }


            var dynamicFields = document.getElementById("div_alert");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/assurance_new',
                method: 'GET',  // Use 'POST' for data creation
                data: { nom: nom.value, email: email.value, tel: phone.value, tel2: phone2.value || null, fax: fax.value, adresse: adresse.value},
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.tel_existe) {
                        showAlert('warning', 'Ce numéro de téléphone appartient déjà a une assurance.');
                    }else if (response.email_existe) {
                        showAlert('warning', 'Ce email appartient déjà a une assurance.');
                    }else if (response.nom_existe) {
                        showAlert('warning', 'Cette assurance existe déjà.');
                    }else if (response.fax_existe) {
                        showAlert('warning', 'Ce fax appartient déjà a une assurance.');
                    } else if (response.success) {
                        showAlert('success', 'Assurance Enregistrée.');
                    } else if (response.error) {
                        showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                    }

                    nom.value = '';
                    email.value = '';
                    phone.value = '';
                    phone2.value = '';
                    fax.value = '';
                    adresse.value = '';

                    select_assurance_patient();
                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');

                    nom.value = '';
                    email.value = '';
                    phone.value = '';
                    phone2.value = '';
                    fax.value = '';
                    adresse.value = '';
                }
            });
        }

        // ------------------------------------------------------------------

        function eng_patient()
        {
            const divAssurer = document.getElementById("div_assurer");

            var nom = document.getElementById("patient_np_new");
            var email = document.getElementById("patient_email_new");
            var phone = document.getElementById("patient_tel_new");
            var phone2 = document.getElementById("patient_tel2_new");
            var adresse = document.getElementById("patient_adresse_new");
            var assurer = document.getElementById('assurer');

            var datenais = document.getElementById("patient_datenaiss_new");
            var sexe = document.getElementById("patient_sexe_new");
            var filiation = document.getElementById("patient_filiation_new");
            var matricule_assurance = document.getElementById("patient_matriculeA_new");

            var assurance_id = document.getElementById("patient_assurance_id_new");
            var taux_id = document.getElementById("patient_taux_id_new");
            var societe_id = document.getElementById("patient_societe_id_new");

            if (!nom.value.trim() || !phone.value.trim() || !adresse.value.trim() || !datenais.value.trim() || !sexe.value.trim()) {
                showAlert('warning', 'Tous les champs sont obligatoires.');
                return false; 
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value.trim() && !emailRegex.test(email.value.trim())) {  // Use email.value.trim() to check the actual input
                showAlert('warning', 'Email incorrect.');
                return false;
            }

            if (phone.value.length !== 10 || (phone2.value !== '' && phone2.value.length !== 10)) {
                showAlert('warning', 'Contact incomplet.');
                return false;
            }

            if (assurer.value == 'oui') {
                if (assurance_id.value !== '' && taux_id.value !== '' && societe_id.value !== '' || filiation.value !== '' || matricule_assurance.value !== '') {
                    // Do something when all the fields have values
                } else {
                    showAlert('warning', 'Veuillez remplir tous les champs relatifs à l\'assurance');
                    return false; // Prevent form submission
                }
            }

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/patient_new',
                method: 'GET',  // Use 'POST' for data creation
                data: { nom: nom.value, email: email.value || null , tel: phone.value, tel2: phone2.value || null, adresse: adresse.value, assurer: assurer.value, assurance_id: assurance_id.value || null, taux_id: taux_id.value || null, societe_id: societe_id.value || null, datenais: datenais.value, sexe: sexe.value, filiation: filiation.value || null, matricule_assurance: matricule_assurance.value || null},
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.tel_existe) {
                        showAlert('warning', 'Ce numéro de téléphone appartient déjà a un patient.');
                    }else if (response.email_existe) {
                        showAlert('warning', 'Cet email appartient déjà a un patient.');
                    }else if (response.nom_existe) {
                        showAlert('warning', 'Cet patient existe déjà.');
                    } else if (response.success) {
                        showAlert('success', 'Patient Enregistrée.');
                    } else if (response.error) {
                        showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                    }

                    nom.value = '';
                    email.value = '';
                    phone.value = '';
                    phone2.value = '';
                    adresse.value = '';

                    datenais.value = '';
                    sexe.value = '';
                    filiation.value = '';
                    matricule_assurance.value = '';

                    assurer.value = 'non';

                    divAssurer.style.display = "none";

                    document.getElementById('name_rech').value = `${response.name}`;
                    document.getElementById('matricule_patient').value = `${response.matricule}`;

                    rech_dosier();

                    var newConsultationTab = new bootstrap.Tab(document.getElementById('tab-oneAAA'));
                    newConsultationTab.show();
                    newConsultationTab.active();

                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('danger', 'Une erreur est survenue lors de l\'enregistrement.');

                    nom.value = '';
                    email.value = '';
                    phone.value = '';
                    phone2.value = '';
                    adresse.value = '';

                    datenais.value = '';
                    sexe.value = '';
                    filiation.value = '';
                    matricule_assurance.value = '';

                    assurer.value = 'non';

                    divAssurer.style.display = "none";
                }
            });
        }

        // ------------------------------------------------------------------

        function eng_consultation()
        {
            var num_patient = document.getElementById("matricule_patient");
            // var acte_id = document.getElementById("acte_id");
            var acte_id = '1';
            var typeacte_idS = document.getElementById("typeacte_idS");
            var medecin_id = document.getElementById("medecin_id");
            var periode = document.querySelector('input[name="periode_consul"]:checked');
            var montant_assurance = document.getElementById("montant_assurance");
            var montant_patient = document.getElementById("montant_patient");
            var taux_remise = document.getElementById("taux_remise");
            var montant_total = document.getElementById("montant_total");

            var jourO = document.getElementById('jourO');
            var jourF = document.getElementById('jourF');
            var nuit = document.getElementById('Nuit');

            if (taux_remise.value == '') {
                taux_remise.value = '0';
            }

            if (!num_patient.value.trim() || acte_id =='' || typeacte_idS.value =='' || medecin_id.value =='' || !taux_remise.value.trim()) {
                showAlertConsultation('warning', 'Tous les champs sont obligatoires.');
                return false; 
            }

            if (montant_assurance.value < 0 || montant_patient.value < 0 || taux_remise.value < 0) {
                showAlertConsultation('warning', 'Veullez vérifier le montant de la remise.');
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
                url: '/api/new_consultation',
                method: 'GET',  // Use 'POST' for data creation
                data: {num_patient: num_patient.value, acte_id: acte_id, typeacte_id: typeacte_idS.value, user_id: medecin_id.value, periode: periode.value, montant_assurance: montant_assurance.value, montant_patient: montant_patient.value, taux_remise: taux_remise.value, total: montant_total.value, appliq_remise: appliq_remise.value},
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.success) {

                        showAlertConsultation('success', 'Patient Enregistrée.');

                        const patient = response.patient;
                        const typeacte = response.typeacte;
                        const user = response.user;
                        const consultation = response.consultation;

                        generatePDFficheCons(patient, user, typeacte, consultation);

                        list_cons();
                        Statistique();
                        Statistique_cons();

                    } else if (response.error) {
                        showAlertConsultation('danger', 'Une erreur est survenue lors de l\'enregistrement.');
                    }

                    jourO.checked = true;
                    jourF.checked = false;
                    nuit.checked = false;

                    var dynamicFields = document.getElementById("div_info_patient");
                    // Remove existing content
                    while (dynamicFields.firstChild) {
                        dynamicFields.removeChild(dynamicFields.firstChild);
                    }

                    document.getElementById("div_info_consul").style.display = 'none';

                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlertConsultation('danger', ' Une erreur est survenue lors de l\'enregistrement.');

                    jourO.checked = true;
                    jourF.checked = false;
                    nuit.checked = false;
                }
            });
        }

        // ------------------------------------------------------------------

        function list_cons(page = 1) {

            const tableBody = document.querySelector('#Table tbody');
            const messageDiv = document.getElementById('message_Table');
            const tableDiv = document.getElementById('div_Table'); // The message div
            const loaderDiv = document.getElementById('div_Table_loader');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            // Fetch data from the API
            const url = `/api/list_cons_day?page=${page}`;
            fetch(url) // API endpoint
                .then(response => response.json())
                .then(data => {
                    // Access the 'chambre' array from the API response
                    const consultations = data.consultation || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    // Clear any existing rows in the table body
                    tableBody.innerHTML = '';

                    if (consultations.length > 0) {

                        document.getElementById(`btn_print_table`).style.display = 'block';

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        // Loop through each item in the chambre array
                        consultations.forEach((item, index) => {
                            // Create a new row
                            const row = document.createElement('tr');
                            // Create and append cells to the row based on your table's structure
                            row.innerHTML = `
                                <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                <td>C-${item.code}</td>
                                <td>P-${item.matricule}</td>
                                <td>${item.name}</td>
                                <td>+225 ${item.tel}</td>
                                <td>${item.motif}</td>
                                <td>${item.type_motif}</td>
                                <td>${item.montant} Fcfa</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a class="btn btn-outline-warning btn-sm" id="facture-${item.code}">
                                            <i class="ri-printer-line"></i>
                                        </a>
                                        <a class="btn btn-outline-info btn-sm" id="fiche-${item.code}">
                                            <i class="ri-file-line"></i>
                                        </a>
                                    </div>
                                </td>
                            `;
                            // Append the row to the table body
                            tableBody.appendChild(row);

                            document.getElementById(`fiche-${item.code}`).addEventListener('click', () =>
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

                            document.getElementById(`facture-${item.code}`).addEventListener('click', () =>
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

                        });

                        document.getElementById(`btn_print_table`).addEventListener('click', () =>
                        {
                            const priceElement = document.getElementById('prix_cons_day');
                            const price = priceElement ? priceElement.innerText.trim() : '0 Fcfa';

                            generatePDFlisteCons(consultations,price);
                        });

                        updatePaginationControls(pagination);

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
                    list_cons(pagination.current_page - 1);
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
                    list_cons(i);
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
                    list_cons(totalPages);
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
                    list_cons(pagination.current_page + 1);
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

        // ------------------------------------------------------------------

        function Statistique() {

            const nbre_patient_day = document.getElementById("nbre_patient_day");
            const nbre_patient_assurer_day = document.getElementById("nbre_patient_assurer_day");
            const nbre_patient_nassurer_day = document.getElementById("nbre_patient_nassurer_day");
            const prix_cons_day = document.getElementById("prix_cons_day");

            $.ajax({
                url: '/api/statistique_reception',
                method: 'GET',
                success: function(response) {
                    // Set the text content of each element
                    nbre_patient_day.textContent = response.nbre_patient_day;
                    nbre_patient_assurer_day.textContent = response.nbre_patient_assurer_day;
                    nbre_patient_nassurer_day.textContent = response.nbre_patient_nassurer_day;
                    prix_cons_day.textContent = formatPrice(response.prix_cons_day.toString()) + ' Fcfa'; // assuming the currency is XOF
                },
                error: function() {
                    // Set default values in case of an error
                    nbre_patient_day.textContent = '0';
                    nbre_patient_assurer_day.textContent = '0';
                    nbre_patient_nassurer_day.textContent = '0';
                    prix_cons_day.textContent = '0 Fcfa';
                }
            });
        }

        function Statistique_cons() {

            document.getElementById("div_Table_loader_Cons").style.display = 'block';

            const stat_consultation = document.getElementById("stat_consultation");

            fetch('/api/statistique_reception_cons') // API endpoint
                .then(response => response.json())
                .then(data => {
                    // Access the 'chambre' array from the API response
                    const typeactes = data.typeacte;
                    document.getElementById("div_Table_loader_Cons").style.display = 'none';
                    // Clear any existing rows in the table body
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

        function Activity_cons() {

            fetch('/api/getWeeklyConsultations')
                .then(response => response.json())
                .then(data => {
                    // Now use the data to update the chart
                    var options = {
                        chart: {
                            height: 150,
                            type: "bar",
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "70%",
                                borderRadius: 2,
                                distributed: true,
                                dataLabels: {
                                    position: "center",
                                },
                            },
                        },
                        series: [{
                            name: "Consultations",
                            data: data, // Use the data from the backend
                        }],
                        legend: {
                            show: false,
                        },
                        xaxis: {
                            categories: [
                                "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"
                            ],
                            axisBorder: {
                                show: false,
                            },
                            labels: {
                                show: true,
                            },
                        },
                        yaxis: {
                            show: false,
                        },
                        grid: {
                            borderColor: "#d8dee6",
                            strokeDashArray: 5,
                            xaxis: {
                                lines: {
                                    show: true,
                                },
                            },
                            yaxis: {
                                lines: {
                                    show: false,
                                },
                            },
                            padding: {
                                top: 0,
                                right: 0,
                                bottom: 0,
                                left: 0,
                            },
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val;
                                },
                            },
                        },
                        colors: [
                            "rgba(255, 255, 255, 0.7)", "rgba(255, 255, 255, 0.6)", "rgba(255, 255, 255, 0.5)", "rgba(255, 255, 255, 0.4)", "rgba(255, 255, 255, 0.3)", "rgba(255, 255, 255, 0.2)", "rgba(255, 255, 255, 0.2)"
                        ],
                    };

                    var chart = new ApexCharts(document.querySelector("#docActivity"), options);
                    chart.render();
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function Activity_cons_count() {
            fetch('/api/getConsultationComparison')
                .then(response => response.json())
                .then(data => {
                    const percentage = data.percentage || 0;
                    const currentWeek = data.currentWeek || 0;
                    const lastWeek = data.lastWeek || 0;

                    // Afficher le résultat
                    document.getElementById('consultationComparison').innerHTML = `
                        <div class="text-center">
                            <span class="badge bg-danger">${percentage}%</span> des patients sont supérieurs<br>à ceux de la semaine dernière. 
                            (${currentWeek} consultation cette semaine, et ${lastWeek} consultation la semaine dernière).
                        </div>
                    `;
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // ------------------------------------------------------------------

        function generatePDFlisteCons(consultations,price) {

            window.jsPDF = window.jspdf.jsPDF;

            function formatDate(dateString) {
                const date = new Date(dateString);
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                const year = date.getFullYear();
                return `${day}/${month}/${year}`; // Format as dd/mm/yyyy
            }

            let tableData = [];
    
            consultations.forEach((item, index) => {
                tableData.push([
                    index + 1,                      // Row number
                    'C-'+item.code || "",                // Code
                    'P-'+item.matricule || "",           // Matricule
                    item.name || "",                // Name
                    '+225 '+item.tel || "", 
                    item.motif || "",               // Motif
                    item.type_motif || "",          // Type motif
                    item.montant+' Fcfa' || "",                // Total
                    formatDate(item.created_at) || "",
                ]);
            });

            // Ensure tableData is not empty before generating PDF
            if (tableData.length === 0) {
                alert("No data found to generate PDF.");
                return;
            }

            // Update the props to include the extracted table data
            var props = {
                outputType: jsPDFInvoiceTemplate.OutputType.Save,
                returnJsPDFDocObject: true,
                fileName: "Consultations",
                orientationLandscape: true,
                compress: true,
                logo: {
                    src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/logo.png",
                    type: 'PNG', //optional, when src= data:uri (nodejs case)
                    width: 53.33, //aspect ratio = width/height
                    height: 26.66,
                    margin: {
                        top: 0, //negative or positive num, from the current position
                        left: 0 //negative or positive num, from the current position
                    }
                },
                stamp: {
                    inAllPages: true, //by default = false, just in the last page
                    src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
                    type: 'JPG', //optional, when src= data:uri (nodejs case)
                    width: 20, //aspect ratio = width/height
                    height: 20,
                    margin: {
                        top: 0, //negative or positive num, from the current position
                        left: 0 //negative or positive num, from the current position
                    }
                },
                business: {
                    name: "Clinic Name",
                    address: "Address here",
                    phone: "(+123) 456-7890",
                    email: "email@clinic.com",
                },
                contact: {
                    name: "Liste des consultations: ",
                    label: "Date : " + new Date().toLocaleDateString(), // Show current date
                },
                invoice: {
                    headerBorder: true,
                    tableBodyBorder: true,
                    header: [
                        { title: "N°", style: { width: 10 } },
                        { title: "N° Cons", style: { width: 20 } },
                        { title: "N° Dossier", style: { width: 20 } },
                        { title: "Name", style: { width: 65 } },
                        { title: "Telephone", style: { width: 35 } },
                        { title: "Motif", style: { width: 38 } },
                        { title: "Type Motif", style: { width: 38 } },
                        { title: "Total", style: { width: 30 } },
                        { title: "Date", style: { width: 20 } }
                    ],
                    table: tableData,
                    additionalRows: [
                        {
                            col1: 'Total consultations:',
                            col2: price,
                            style: { fontSize: 12 }
                        }
                    ],
                    invDescLabel: "Consultation Summary",
                    invDesc: "This is the consultation summary for the day.",
                    rowColor: [240, 240, 240],
                    rowEvenColor: [255, 255, 255],
                    rowOddColor: [230, 230, 230],
                    footer: {
                        text: "Generated by the clinic system."
                    },
                    tableStyle: {
                        fontSize: 10,
                        color: 'black'
                    }
                },
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
                    doc.setFontSize(9);
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
                    doc.setFontSize(9);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 110, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 140, yPoss);
                    yPoss += 7;
                });

                yPoss = (yPos + 90);

                const compteInfo = [
                    { label: "Part assurance", value: consultation.part_assurance+" Fcfa"},
                    { label: "Part Patient", value: consultation.part_patient+" Fcfa"},
                    { label: "Remise", value: consultation.remise+" Fcfa"},
                ];

                if (patient.taux !== null) {
                    compteInfo.push({ label: "Taux", value: patient.taux + "%" });
                }

                compteInfo.forEach(info => {
                    doc.setFontSize(9);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 110, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 140, yPoss);
                    yPoss += 7;
                });

                yPoss += 1;

                doc.setFontSize(11);
                doc.setFont("Helvetica", "bold");
                doc.text('Total', leftMargin + 110, yPoss);
                doc.setFont("Helvetica", "bold");
                doc.text(": "+typeacte.prix+" Fcfa", leftMargin + 140, yPoss);

                doc.setFontSize(10);
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(0, 0, 0);
                doc.text("Imprimer le "+new Date().toLocaleDateString()+" à "+new Date().toLocaleTimeString() , 5, yPoss + 13);

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
