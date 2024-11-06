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
        <li class="breadcrumb-item">
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
                        <div class="text-body chart-height-md" id="docActivity" style="margin-top: -30px;">
                        </div>
                        <div id="consultationComparison" style="margin-top: -10px;" ></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="card-body ">
                    <ol class="breadcrumb justify-content-center align-items-center">
                        <li class="" style="display: block;" id="div_btn_affiche_stat">
                            <a class="btn btn-sm btn-warning" id="btn_affiche_stat">
                                Afficher les Statstiques
                                <i class="ri-eye-line" ></i>
                            </a>
                        </li>
                        <li class="" style="display: none;" id="div_btn_cache_stat">
                            <a class="btn btn-sm btn-danger" id="btn_cache_stat">
                                Cacher les Statstiques
                                <i class="ri-eye-off-line" ></i>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row gx-3 mb-3" id="stat_consultation"></div>

    <div class="row gx-3" >
        <div class="col-sm-12">
            <div class="card mb-3">
                <div class="card-body" style="margin-top: -32px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center bg-primary bg-2" id="customTab4" role="tablist" style="background: rgba(0, 0, 0, 0.7);">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-file-user-line me-2"></i>
                                    Nouveau patient
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-white" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab" aria-controls="oneAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-first-aid-kit-line me-2"></i>
                                    Nouvelle consultation
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  text-white" id="tab-threeAAAL" data-bs-toggle="tab" href="#threeAAAL" role="tab" aria-controls="threeAAAL" aria-selected="true">
                                    <i class="ri-calendar-check-line me-2"></i>
                                    Rendez-Vous
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  text-white" id="tab-threeAAA" data-bs-toggle="tab" href="#threeAAA" role="tab" aria-controls="threeAAA" aria-selected="true">
                                    <i class="ri-sticky-note-add-line me-2"></i>
                                    Nouvelle societe
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  text-white" id="tab-frewAAA" data-bs-toggle="tab" href="#frewAAA" role="tab" aria-controls="frewAAA" aria-selected="true">
                                    <i class="ri-folder-add-line me-2"></i>
                                    Nouvelle Assurance
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane fade active show" id="oneAAA" role="tabpanel" aria-labelledby="tab-oneAAA">
                                <div class="card-header">
                                    <h5 class="card-title text-center">Recherche du Patient</h5>
                                </div>
                                <div class="row gx-3">
                                    <div class="row gx-3 justify-content-center align-items-center" >
                                        <div class="col-12">
                                            <div class=" mb-0">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <a class="d-flex align-items-center flex-column">
                                                            <img src="{{asset('assets/images/user8.png')}}" class="img-7x rounded-circle border border-3">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-lg-4 col-sm-6">
                                            <div class="mb-3 text-center">
                                                <label class="form-label">
                                                    Nom du patient
                                                </label>
                                                <div class="input-group">
                                                    <input type="hidden" class="form-control" id="id_patient" autocomplete="off">
                                                    <input type="text" class="form-control text-center" id="name_rech" placeholder="Selectionner un Patient" autocomplete="off">
                                                    <button hidden id="btn_rech_num_dossier" class="btn btn-outline-success">
                                                        <i class="ri-search-line"></i>
                                                    </button>
                                                </div>
                                                <div class="input-group">
                                                    <div class="suggestions w-100" id="suggestions" style="display: none;"></div>
                                                </div>
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
                                            <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_numcode" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label">Numéro de bon</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            N°
                                                        </span>
                                                        <input type="text" class="form-control" id="mumcode">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6" id="div_assurance_utiliser" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label">Utilisé l'assurance</label>
                                                    <select class="form-select" id="assurance_utiliser">
                                                        <option selected value="oui">Oui</option>
                                                        <option value="non">Non</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-header text-center">
                                                <h5 class="card-title">Information Caisse</h5>
                                            </div>
                                            <div class="row gx-3">
                                                <div class="col-xxl-3 col-lg-4 col-sm-6" id="input_part_assurance" style="display: none;">
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
                                            <div class="col-sm-12 mb-3">
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <a href="javascript:location.reload();" class="btn btn-outline-danger">
                                                        Rémise à zéro
                                                    </a>
                                                    <button id="btn_eng_consultation" class="btn btn-success">
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="div_alert_consultation" class="mb-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="twoAAA" role="tabpanel" aria-labelledby="tab-twoAAA">
                                <div class="card-header">
                                    <h5 class="card-title text-center">Formulaire Nouveau Patient</h5>
                                </div>
                                <div class="row gx-3">
                                    <div class="col-12">
                                            <div class=" mb-0">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <a class="d-flex align-items-center flex-column">
                                                            <img src="{{asset('assets/images/user8.png')}}" class="img-7x rounded-circle border border-3">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nom et Prénoms</label>
                                            <input type="text" class="form-control" id="patient_np_new" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
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
                                            <input type="text" class="form-control" id="patient_adresse_new" placeholder="facultatif">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Sexe</label>
                                            <select class="form-select" id="patient_sexe_new">
                                                <option value="">Selectionner</option>
                                                <option value="Mr">Homme</option>
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
                                        <div class="d-flex gap-2 justify-content-center">
                                            <button id="btn_eng_patient" class="btn btn-success">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="threeAAAL" role="tabpanel" aria-labelledby="tab-threeAAAL">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">Listes de Rendez-Vous du jour</h5>
                                    <div class="d-flex">
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
                                            Aucun Rendez-Vous n'est prévu aujourd'hui
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
                            <div class="tab-pane fade" id="threeAAA" role="tabpanel" aria-labelledby="tab-threeAAA">
                                <div class="card-header">
                                    <h5 class="card-title text-center">Formulaire Nouvelle Scoiété</h5>
                                </div>
                                <div class="card-header">
                                    <div class="text-center">
                                        <a class="d-flex align-items-center flex-column">
                                            <img src="{{asset('assets/images/batiment.avif')}}" class="img-7x rounded-circle border border-3">
                                        </a>
                                    </div>
                                </div>
                                <div class="row gx-3 ">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nom de la société</label>
                                            <input type="text" class="form-control" id="nom_societe" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email_societe" placeholder="facultatif">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Contact</label>
                                            <input type="tel" class="form-control" id="tel_societe" placeholder="Saisie Obligatoire" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Contact 2</label>
                                            <input type="tel" class="form-control" id="tel2_societe" placeholder="facultatif" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Adresse</label>
                                            <input type="text" class="form-control" id="adresse_societe" placeholder="facultatif">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Fax</label>
                                            <input type="text" class="form-control" id="fax_societe" placeholder="facultatif">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Situation Géographique</label>
                                            <input type="text" class="form-control" id="sgeo_societe" placeholder="facultatif">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <button id="btn_eng_societe" class="btn btn-outline-success">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="frewAAA" role="tabpanel" aria-labelledby="tab-frewAAA">
                                <div class="card-header">
                                    <h5 class="card-title text-center">Formulaire Nouvelle Assurance</h5>
                                </div>
                                <div class="row gx-3">
                                    <div class="col-12">
                                        <div class=" mb-0">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <a class="d-flex align-items-center flex-column">
                                                        <img src="{{asset('assets/images/assurance3.jpg')}}" class="img-7x rounded-circle border border-3">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                            <input type="tel" class="form-control" id="tel2_assurance_new" placeholder="Facultatif" maxlength="10">
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
                                        <div class="d-flex gap-2 justify-content-center">
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
            </div>
        </div>
    </div>

    <div class="row gx-3" >
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title text-center">
                        Patient recu Aujourd'hui
                    </h5>
                    <div class="d-flex" >
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
                                        <th scope="col">N° Consultation</th>
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
                    <div id="pagination-controls"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="Detail_motif" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-body" id="modal_Detail_motif"></div>
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

<div class="modal fade" id="MdeleteCons" tabindex="-1" aria-labelledby="delRowLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delRowLabel">
                    Confirmation
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Voulez-vous vraiment supprimé cette consultation ?
                <input type="hidden" id="IddeleteCons">
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end gap-2">
                    <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Non</a>
                    <button id="deleteBtnCons" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Oui</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/vendor/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/app/js/jspdfinvoicetemplate/dist/index.js')}}" ></script>
<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        Statistique();
        Activity_cons();
        Activity_cons_count();
        Name_atient();
        select_taux();
        select_societe_patient();
        select_assurance_patient();
        list_cons();
        list_rdv();

        // ------------------------------------------------------------------

        document.getElementById("btn_eng_consultation").addEventListener("click", eng_consultation);
        document.getElementById("btn_refresh_table").addEventListener("click", list_cons);
        document.getElementById("acte_id").addEventListener("change", select_list_typeacte);
        document.getElementById("btn_eng_societe").addEventListener("click", eng_societe);
        document.getElementById("btn_eng_assurance").addEventListener("click", eng_assurance);
        document.getElementById("btn_eng_patient").addEventListener("click", eng_patient);

        document.getElementById("btn_update_rdv").addEventListener("click", update_rdv);
        document.getElementById("btn_refresh_table_rdv").addEventListener("click", list_rdv);
        document.getElementById("btn_delete_rdv").addEventListener("click", delete_rdv);
        document.getElementById("deleteBtnCons").addEventListener("click", delete_cons);

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

        // ------------------------------------------------------------------

        var inputs = ['tel_assurance_new', 'tel2_assurance_new', 'patient_tel_new', 'patient_tel2_new', 'taux_remise', 'montant_assurance', 'montant_patient','tel_societe','tel2_societe'];
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

        document.getElementById('assurance_utiliser').addEventListener('change', function() {
            if (this.value == 'non'){
                document.getElementById('div_numcode').style.display = 'none';
                document.getElementById('mumcode').value = '';
            }else{
                document.getElementById('div_numcode').style.display = 'block';
                document.getElementById('mumcode').value = '';
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
            const assuranceUtiliser = document.getElementById('assurance_utiliser').value; // Récupérer la valeur 'oui' ou 'non'

            if (appliq_remise == 'patient' || assuranceUtiliser == 'non') {
                // Convertir la valeur formatée en nombre pour les calculs
                const montant_patient = parseInt(document.getElementById('montant_patient_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseInt(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_patient - remise;
                document.getElementById('montant_patient').value = formatPriceT(montantRemis);
            } else if (assuranceUtiliser == 'oui') {

                // Si l'assurance est utilisée (valeur 'oui'), calculer le montant remis pour l'assurance
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
            const rawValue = document.getElementById('taux_remise').value.replace(/[^0-9]/g, ''); 

            const assuranceUtiliser = document.getElementById('assurance_utiliser').value; // Récupérer la valeur 'oui' ou 'non'

            if (this.value == 'patient' || assuranceUtiliser == 'non') {
                // Convertir la valeur formatée en nombre pour les calculs

                const montant_patient = parseFloat(document.getElementById('montant_patient_hidden').value.replace(/\./g, '')) || 0;
                const remise = parseFloat(rawValue) || 0;

                // Calculer le montant remis
                const montantRemis = montant_patient - remise;
                document.getElementById('montant_patient').value = formatPriceT(montantRemis);
            } else if (assuranceUtiliser == 'oui') {

                // Si l'assurance est utilisée (valeur 'oui'), calculer le montant remis pour l'assurance
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

        function Name_atient() {
            $.ajax({
                url: '/api/name_patient_reception',
                method: 'GET',
                success: function(response) {
                    // Récupérer les données de l'API
                    const data = response.name;

                    // Élément de l'input et autres éléments HTML
                    const input = document.getElementById('name_rech');
                    const id_patient = document.getElementById('id_patient');
                    const suggestionsDiv = document.getElementById('suggestions');

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
                                // Remplir l'input avec la suggestion sélectionnée
                                input.value = `${item.np}`;
                                id_patient.value = `${item.id}`;
                                suggestionsDiv.innerHTML = ''; // Vider les suggestions
                                suggestionsDiv.style.display = 'none'; // Masquer les suggestions
                                rech_dosier(); // Appeler la fonction de recherche de dossier
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

        function rech_dosier()
        {
            document.getElementById('div_typeacteS').style.display = 'block';
            document.getElementById('div_medecin').style.display = 'block';
            document.getElementById('acte_id').value = '1';

            document.getElementById('montant_assurance').value = '0';
            document.getElementById('taux_remise').value = '0';
            document.getElementById('montant_total').value = '0';
            document.getElementById('montant_patient').value = '0';

            const id_patient = document.getElementById("id_patient");

            if(!id_patient.value.trim()){
                showAlert('Alert', 'Veuillez saisie le nom d\'un du patient.', 'warning');
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
                data: { id: id_patient.value },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    if(response.existep) {
                        showAlert('Alert', 'Ce patient n\'existe pas.', 'error');
                        Reset();
                    } else if (response.success) {
                        // showAlert('Succés', 'Patient trouvé.', 'success');

                        addGroup(response.patient);

                        document.getElementById("div_info_consul").style.display = 'block';

                        if (response.patient.assurer == 'oui') {
                            // Le patient a un taux d'assurance
                            document.getElementById("input_part_assurance").style.display = 'block';
                            document.getElementById("div_assurance_utiliser").style.display = 'block';
                            document.getElementById("div_numcode").style.display = 'block';

                            // Afficher le select et inclure l'option 'Assurance'
                            // Assurez-vous que l'option 'Assurance' est visible
                            const assuranceOption = document.querySelector("#appliq_remise option[value='assurance']");
                            if (assuranceOption) {
                                assuranceOption.style.display = 'block';
                            } else {
                                // Si l'option 'Assurance' n'existe pas, la créer et l'ajouter
                                const newAssuranceOption = document.createElement('option');
                                newAssuranceOption.value = 'assurance';
                                newAssuranceOption.text = 'Assurance';
                                document.getElementById("appliq_remise").appendChild(newAssuranceOption);
                            }

                        } else {
                            // Le patient n'a pas d'assurance
                            document.getElementById("input_part_assurance").style.display = 'none';
                            document.getElementById("div_assurance_utiliser").style.display = 'none';
                            document.getElementById("div_numcode").style.display = 'none';

                            // Cacher l'option 'Assurance' dans le select
                            const assuranceOption = document.querySelector("#appliq_remise option[value='assurance']");
                            if (assuranceOption) {
                                assuranceOption.style.display = 'none';
                            }
                        }

                        select_list_typeacte();
                    }
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('Alert', 'Une erreur est survenue lors de la recherche.', 'error');
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

        function showAlert(title, message, type) {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
            });
        }

        function Reset() {

            var dynamicFields = document.getElementById("div_info_patient");
            // Remove existing content
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            document.getElementById("div_info_consul").style.display = 'none';
            document.getElementById("id_patient").value = '';
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

            fetch('/api/select_list_medecin')
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

                const appliq_remise = document.getElementById('appliq_remise');
                const auS = document.getElementById('assurance_utiliser');
                auS.addEventListener('change', function() {
                    const selectedOption = typeActeSelect.options[typeActeSelect.selectedIndex];
                    const prix = selectedOption.getAttribute('data-prix');

                    taux_remise.value = 0;

                    if (prix) {
                        if (this.value == 'oui') {
                            appliq_remise.querySelector('option[value="assurance"]').style.display = 'block';
                            calculateAndFormatAmounts(prix, patient_taux.value);
                        } else {
                            appliq_remise.value = 'patient'; // Sélectionner l'option "patient"
                            appliq_remise.querySelector('option[value="assurance"]').style.display = 'none'; // Cacher l'option "Assurance"
                            calculateAndFormatAmounts(prix, 0); // Calculer sans taux d'assurance
                        }
                    } else {
                        // Réinitialiser les champs si aucun prix valide n'est trouvé
                        montant_total.value = '';
                        montant_assurance.value = '';
                        montant_patient.value = '';
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
                const au = document.getElementById('assurance_utiliser');
                let tauxFloat = parseFloat(patient_taux);

                if (au.value == 'non') {
                    tauxFloat = 0;
                }else{
                   if (isNaN(tauxFloat)) {
                        tauxFloat = 0; // Set to 0 if patient_taux is not a number
                    } 
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
            const nom = document.getElementById("nom_societe");
            const email = document.getElementById("email_societe");
            const adresse = document.getElementById("adresse_societe");
            const fax = document.getElementById("fax_societe");
            const tel = document.getElementById("tel_societe");
            const tel2 = document.getElementById("tel2_societe");
            const sgeo = document.getElementById("sgeo_societe");

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

                    select_societe_patient();
                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.', 'error');
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
                showAlert('Alert', 'Tous les champs sont obligatoires.','warning');
                return false; 
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) { 
                showAlert('Alert', 'Email incorrect.','warning');
                return false;
            }


            if (phone.value.length !== 10 || (phone2.value !== '' && phone2.value.length !== 10)) {
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
                url: '/api/assurance_new',
                method: 'GET',  // Use 'POST' for data creation
                data: { nom: nom.value, email: email.value, tel: phone.value, tel2: phone2.value || null, fax: fax.value, adresse: adresse.value},
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.tel_existe) {
                        showAlert('Alert', 'Ce numéro de téléphone appartient déjà a une assurance.','warning');
                    }else if (response.email_existe) {
                        showAlert('Alert', 'Ce email appartient déjà a une assurance.','warning');
                    }else if (response.nom_existe) {
                        showAlert('Alert', 'Cette assurance existe déjà.','warning');
                    }else if (response.fax_existe) {
                        showAlert('Alert', 'Ce fax appartient déjà a une assurance.','warning');
                    } else if (response.success) {
                        showAlert('Succès', 'Assurance Enregistrée.','success');
                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.','error');
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

                    showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.','error');

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

            if (!nom.value.trim() || !phone.value.trim() || !datenais.value.trim() || !sexe.value.trim()) {
                showAlert('Alert', 'Tous les champs sont obligatoires.','warning');
                return false; 
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value.trim() && !emailRegex.test(email.value.trim())) {  // Use email.value.trim() to check the actual input
                showAlert('Alert', 'Email incorrect.','warning');
                return false;
            }

            if (phone.value.length !== 10 || (phone2.value !== '' && phone2.value.length !== 10)) {
                showAlert('Alert', 'Contact incomplet.','warning');
                return false;
            }

            if (assurer.value == 'oui') {
                if (assurance_id.value !== '' && taux_id.value !== '' && societe_id.value !== '' || filiation.value !== '' || matricule_assurance.value !== '') {
                    // Do something when all the fields have values
                } else {
                    showAlert('Alert', 'Veuillez remplir tous les champs relatifs à l\'assurance','warning');
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
                data: { 
                    nom: nom.value,
                    email: email.value || null ,
                    tel: phone.value,
                    tel2: phone2.value || null,
                    adresse: adresse.value || null,
                    assurer: assurer.value,
                    assurance_id: assurance_id.value || null,
                    taux_id: taux_id.value || null,
                    societe_id: societe_id.value || null,
                    datenais: datenais.value,
                    sexe: sexe.value,
                    filiation: filiation.value || null,
                    matricule_assurance: matricule_assurance.value || null,
                },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.tel_existe) {
                        showAlert('Alert', 'Ce numéro de téléphone appartient déjà a un patient.','warning');
                    }else if (response.email_existe) {
                        showAlert('Alert', 'Cet email appartient déjà a un patient.','warning');
                    }else if (response.nom_existe) {
                        showAlert('Alert', 'Cet patient existe déjà.','warning');
                    } else if (response.success) {

                        nom.value = '';
                        email.value = '';
                        phone.value = '';
                        phone2.value = '';
                        adresse.value = '';
                        datenais.value = '';
                        sexe.value = '';
                        filiation.value = '';
                        matricule_assurance.value = '';
                        assurance_id.value = "";
                        taux_id.value = "";
                        societe_id.value = "";

                        assurer.value = 'non';

                        divAssurer.style.display = "none";

                        document.getElementById('name_rech').value = `${response.name}`;
                        document.getElementById('id_patient').value = `${response.id}`;

                        rech_dosier();
                        Name_atient();

                        var newConsultationTab = new bootstrap.Tab(document.getElementById('tab-oneAAA'));
                        newConsultationTab.show();

                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.','error');
                    }

                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.','error');
                }
            });
        }

        // ------------------------------------------------------------------

        function eng_consultation()
        {
            const auth_id = {{ Auth::user()->id }};
            var id_patient = document.getElementById("id_patient");
            var assurance_utiliser = document.getElementById("assurance_utiliser");
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

            var mumcode = document.getElementById('mumcode');

            if (taux_remise.value == '') {
                taux_remise.value = '0';
            }

            if (typeacte_idS.value =='' || medecin_id.value =='' || !taux_remise.value.trim()) {
                showAlert('Alert', 'Tous les champs sont obligatoires.','warning');
                return false; 
            }

            if (montant_assurance.value < 0 || montant_patient.value < 0 || taux_remise.value < 0) {
                showAlert('Alert', 'Veullez vérifier le montant de la remise.','warning');
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
                data: {
                    id_patient: id_patient.value, 
                    acte_id: acte_id, 
                    typeacte_id: typeacte_idS.value, 
                    user_id: medecin_id.value, 
                    periode: periode.value, 
                    montant_assurance: montant_assurance.value, 
                    montant_patient: montant_patient.value, 
                    taux_remise: taux_remise.value, 
                    total: montant_total.value, 
                    appliq_remise: appliq_remise.value, 
                    mumcode: mumcode.value || null,
                    assurance_utiliser: assurance_utiliser.value,
                    auth_id: auth_id,
                },
                success: function(response) {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }
                    
                    if (response.success) {

                        jourO.checked = true;
                        jourF.checked = false;
                        nuit.checked = false;

                        var dynamicFields = document.getElementById("div_info_patient");
                        // Remove existing content
                        while (dynamicFields.firstChild) {
                            dynamicFields.removeChild(dynamicFields.firstChild);
                        }

                        document.getElementById("div_info_consul").style.display = 'none';
                        document.getElementById("name_rech").value = "";

                        mumcode.value = "";

                        showAlert('Succès', 'Patient Enregistrée.', 'success');

                        const patient = response.patient;
                        const typeacte = response.typeacte;
                        const user = response.user;
                        const consultation = response.consultation;

                        const stat_consultation = document.getElementById("stat_consultation");

                        if (stat_consultation && stat_consultation.innerHTML.trim() !== "") {
                            Statistique_cons();
                        }

                        list_cons();
                        Statistique();
                        Reset();
                        Activity_cons();
                        Activity_cons_count();

                        generatePDFficheCons(patient, user, typeacte, consultation);

                    } else if (response.error) {
                        showAlert('Alert', 'Une erreur est survenue lors de l\'enregistrement.','error');
                    }

                },
                error: function() {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Alert', ' Une erreur est survenue lors de l\'enregistrement.','error');
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
                                <td>${item.code}</td>
                                <td>${item.matricule}</td>
                                <td>${item.name}</td>
                                <td>+225 ${item.tel}</td>
                                <td>${item.motif}</td>
                                <td>${item.type_motif}</td>
                                <td>${item.montant} Fcfa</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <a class="btn btn-outline-warning btn-sm rounded-5" id="facture-${item.code}">
                                            <i class="ri-printer-line"></i>
                                        </a>
                                        <a class="btn btn-outline-info btn-sm rounded-5" id="fiche-${item.code}">
                                            <i class="ri-file-line"></i>
                                        </a>
                                        ${item.statut_fac == 'impayer' ?  
                                            `<a class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#MdeleteCons" id="deleteCons-${item.id}">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>` : ``}
                                    </div>
                                </td>
                            `;
                            // Append the row to the table body
                            tableBody.appendChild(row);

                            const deleteButton = document.getElementById(`deleteCons-${item.id}`);
                                if (deleteButton) {
                                    deleteButton.addEventListener('click', () => {
                                        document.getElementById('IddeleteCons').value = item.id;
                                    });
                                }

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

                        updatePaginationControls(pagination);

                    } else {
                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'block';
                        tableDiv.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des donnée:', error);
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

        function delete_cons() {

            const id = document.getElementById('IddeleteCons').value;

            var modal = bootstrap.Modal.getInstance(document.getElementById('MdeleteCons'));
            modal.hide();

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);

            $.ajax({
                url: '/api/delete_Cons/'+id,
                method: 'GET',
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.success) {
                        list_cons();
                        showAlert('Succès', 'Opération éffectuée.','success');
                    } else if (response.error) {
                        showAlert("ERREUR", 'Echec de l\'opération', "error");
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

        //-------------------------------------------------------------------

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

            const stat_consultation = document.getElementById("stat_consultation");

            const div = document.createElement('div');
            div.innerHTML = `
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                    <strong>Chargement des données...</strong>
                </div>
            `;
            stat_consultation.appendChild(div);


            fetch('/api/statistique_reception_cons') // API endpoint
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

        function Activity_cons() {

            fetch('/api/getWeeklyConsultations')
                .then(response => response.json())
                .then(data => {

                    const page = document.getElementById('docActivity');
                    page.innerHTML = "";

                    var contenu = `
                        <div id="docActivity2"></div>
                    `;

                    page.innerHTML = contenu;
                    
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

                    var chart = new ApexCharts(document.querySelector("#docActivity2"), options);
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

        function generatePDFficheCons(patient, user, typeacte, consultation) {

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            const pdfFilename = "Fiche Consultation N°" + consultation.code + " du " + formatDateHeure(consultation.created_at);
            doc.setProperties({
                title: pdfFilename,
            });

            yPos = 10;

            function drawConsultationSection(yPos) {
                rightMargin = 15;
                leftMargin = 15;
                pdfWidth = doc.internal.pageSize.getWidth();

                const titlea = "Fiche";
                doc.setFontSize(100);
                doc.setTextColor(242, 237, 237); // Gray color for background effect
                doc.setFont("Helvetica", "bold");
                doc.text(titlea, 120, yPos + 150, { align: 'center', angle: 40 });

                const logoSrc = "{{asset('assets/images/logo.png')}}";
                const logoWidth = 22;
                const logoHeight = 22;
                doc.addImage(logoSrc, 'PNG', leftMargin, yPos - 7, logoWidth, logoHeight);

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
                const titleN = "N° "+ consultation.code;
                doc.text(titleN, (doc.internal.pageSize.getWidth() - doc.getTextWidth(titleN)) / 2, (yPos + 31));

                doc.setFontSize(10);
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(0, 0, 0);
                const numDossier = "N° Dossier : P-"+ patient.matricule;
                const numDossierWidth = doc.getTextWidth(numDossier);
                doc.text(numDossier, pdfWidth - rightMargin - numDossierWidth, yPos + 25);

                yPoss = (yPos + 45);

                const patientInfo = [
                    { label: "Medecin", value: "Dr. "+ user.name },
                    { label: "Spécialité", value: typeacte.nom },
                    { label: "Nom et Prénoms", value: patient.np },
                    { label: "Assurer", value: patient.assurer },
                    { label: "Age", value: patient.age +" an(s)" },
                    { label: "Adresse", value: patient.adresse },
                    { label: "Contact", value: "+225 "+patient.tel },
                ];

                if (patient.assurer == 'oui') {
                    patientInfo.push(
                        { label: "Assurance", value: patient.assurance },
                        { label: "Matricule", value: patient.matricule_assurance },
                    );
                }

                patientInfo.forEach(info => {
                    doc.setFontSize(10);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 35, yPoss);
                    yPoss += 7;
                });

                doc.setFontSize(30);
                doc.setLineWidth(0.5);
                doc.line(10, yPoss, 200, yPoss);

                doc.setFontSize(15);
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(255, 0, 0);
                const rendu = "Compte Rendu";
                const titleRr = doc.getTextWidth(rendu);
                const titlerendu = (doc.internal.pageSize.getWidth() - titleRr) / 2;
                doc.text(rendu, titlerendu, yPoss + 10);
                // Dessiner une ligne sous le texte pour le souligner
                const underlineY = yPoss + 12; // Ajustez cette valeur selon vos besoins
                doc.setDrawColor(255, 0, 0);
                doc.setLineWidth(0.5); // Épaisseur de la ligne
                doc.line(titlerendu, underlineY, titlerendu + titleRr, underlineY);

                yPoss += 25;
                hPoss = yPoss;
                doc.setTextColor(0, 0, 0);

                const pInfo1 = [
                    { label: "TA", value: "..........." },
                    { label: "Poids", value: "..........." },
                ];

                pInfo1.forEach(info => {
                    doc.setFontSize(10);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin, yPoss);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 15, yPoss);
                    yPoss += 7;
                });

                const pInfo2 = [
                    { label: "BD", value: "..........." },
                    { label: "Pouls", value: "..........." },
                ];

                pInfo2.forEach(info => {
                    doc.setFontSize(10);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 40, yPoss - 14);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 55, yPoss - 14);
                    yPoss += 7;
                });

                const pInfo3 = [
                    { label: "BG", value: "..........." },
                    { label: "Taille", value: "..........." },
                ];

                pInfo3.forEach(info => {
                    doc.setFontSize(10);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 75, yPoss - 28);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 90, yPoss - 28);
                    yPoss += 7;
                });

                const pInfo4 = [
                    { label: "Temp", value: "..........." },
                ];

                pInfo4.forEach(info => {
                    doc.setFontSize(10);
                    doc.setFont("Helvetica", "bold");
                    doc.text(info.label, leftMargin + 110, yPoss - 42);
                    doc.setFont("Helvetica", "normal");
                    doc.text(": " + info.value, leftMargin + 125, yPoss - 42);
                    yPoss += 7;
                });

                hPoss += 25;

                doc.setFontSize(15);
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(0, 0, 0);
                const motif = "Motif";
                const titleRm = doc.getTextWidth(motif);
                const titlemotif = (doc.internal.pageSize.getWidth() - titleRm) / 2;
                doc.text(motif, titlemotif, hPoss);
                // Dessiner une ligne sous le texte pour le souligner
                const underlineYm = hPoss + 2; // Ajustez cette valeur selon vos besoins
                doc.setDrawColor(0, 0, 0);
                doc.setLineWidth(0.5); // Épaisseur de la ligne
                doc.line(titlemotif, underlineYm, titlemotif + titleRm, underlineYm);

                doc.setFontSize(10);
                doc.setFont("Helvetica", "bold");
                doc.setTextColor(0, 0, 0);
                doc.text("Imprimer le "+new Date().toLocaleDateString()+" à "+new Date().toLocaleTimeString() , 5, 295);

            }

            drawConsultationSection(yPos);

            doc.output('dataurlnewwindow');
        }

        function generatePDFInvoice(patient, user, typeacte, consultation) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });

            const pdfFilename = "Consultation Facture N°" + consultation.code_fac + " du " + formatDateHeure(consultation.created_at);
            doc.setProperties({
                title: pdfFilename,
            });

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

                const logoSrc = "{{asset('assets/images/logo.png')}}";
                const logoWidth = 22;
                const logoHeight = 22;
                doc.addImage(logoSrc, 'PNG', leftMargin, yPos - 7, logoWidth, logoHeight);

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

        // -----------------------------------------------------------------

        function list_rdv(page = 1) {

            const tableBody = document.querySelector('#Table_rdv tbody');
            const messageDiv = document.getElementById('message_Table_rdv');
            const tableDiv = document.getElementById('div_Table_rdv');
            const loaderDiv = document.getElementById('div_Table_loader_rdv');

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const url = `/api/list_rdv_day?page=${page}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const rdvs = data.rdv || [];
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
                                        <span class="badge ${item.statut === 'en attente' ? 'bg-warning' : 'bg-success'}">
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

                        updatePaginationControlsRdv(pagination);

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

        function updatePaginationControlsRdv(pagination) {
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
