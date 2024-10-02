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
    <div class="row gx-3">
        <div class="col-xxl-12 col-sm-12">
            <div class="card mb-3 bg-3">
                <div class="card-body" style="background: rgba(0, 0, 0, 0.7);">
                    <div class="py-4 px-3 text-white">
                        <h6>Bienvenue,</h6>
                        <h2>{{Auth::user()->sexe.'. '.Auth::user()->name}}</h2>
                        <h5>Les statistiques d'aujourd'hui.</h5>
                        <div class="mt-4 d-flex gap-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-box lg bg-info rounded-5 me-3">
                                    <i class="ri-walk-line fs-1"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h2 class="m-0 lh-1" id="nbre_analyse" >0</h2>
                                    <p class="m-0">Analyse</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="icon-box lg bg-info rounded-5 me-3">
                                    <i class="ri-walk-line fs-1"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h2 class="m-0 lh-1" id="nbre_imagerie" >0</h2>
                                    <p class="m-0">Imagerie</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-3" >
        <div class="col-sm-12">
            <div class="card mb-3">
                <div class="card-header" hidden >
                    <h5 class="card-title">Hospitalisation</h5>
                </div>
                <div class="card-body" style="margin-top: -30px;">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center bg-primary bg-2" id="customTab4" role="tablist" style="background: rgba(0, 0, 0, 0.7);">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-white" id="tab-twoAAAN" data-bs-toggle="tab" href="#twoAAAN" role="tab" aria-controls="twoAAAN" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Demande d'examen
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Nouvel Examen
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-oneAAAD" data-bs-toggle="tab" href="#oneAAAD" role="tab" aria-controls="oneAAAD" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Liste des demandes d'examens
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab" aria-controls="oneAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Liste des Examens
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-white" id="tab-oneAAAP" data-bs-toggle="tab" href="#oneAAAP" role="tab" aria-controls="oneAAAP" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Prélévement
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane active show fade" id="twoAAAN" role="tabpanel" aria-labelledby="tab-twoAAAN">
                                <div class="card-header">
                                    <h5 class="card-title text-left">
                                        Nouvelle Demande d'examen
                                    </h5>
                                </div>
                                <div class="row gx-3 justify-content-center align-items-center mb-4">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Patient</label>
                                            <input type="hidden" class="form-control" id="matricule_patient" autocomplete="off">
                                            <input type="text" class="form-control" id="patient" placeholder="saisie obligatoire" autocomplete="off">
                                            <div class="suggestions" id="suggestions_patient" style="display: none;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gx-3 justify-content-center align-items-center mb-4">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Type de Soins Infirmer</label>
                                            <select class="form-select" id="typesoins_id"></select>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_selectSoins" class="border border-2 mb-3 p-2" >
                                    <div class="card-header">
                                        <h5 class="card-title text-center">
                                            Choix des Soins Infirmiers
                                        </h5>
                                    </div>
                                    <div class="row gx-3 justify-content-center align-items-center">
                                        <div class="col-lg-8 col-12">
                                            <div class="row gx-3 justify-content-center align-items-center">
                                                <div id="div_alert_soins" ></div>
                                                <div class="col-12 mb-3 text-center">
                                                    <button type="button" id="add_select_soins" class="btn btn-info">
                                                        <i class="ri-sticky-note-add-line"></i>
                                                        Ajouter un Soins
                                                    </button>
                                                </div>
                                                <div class="col-12" id="contenu_soins">

                                                </div>
                                                <div class="col-12" id="div_btn_soins" style="display: none;">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            Montant Total
                                                        </span>
                                                        <input readonly type="tel" class="form-control" id="montant_total_soins" placeholder="Montant Total">
                                                        <span class="input-group-text">Fcfa</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_selectProduit" class="border border-2 mb-3 p-2" >
                                    <div class="card-header">
                                        <h5 class="card-title text-center">
                                            Choix des Produits Utilisés
                                        </h5>
                                    </div>
                                    <div class="row gx-3 justify-content-center align-items-center" >
                                        <div class="col-lg-8 col-12">
                                            <div class="row gx-3 justify-content-center align-items-center">
                                                <div id="div_alert_produit_qu" ></div>
                                                <div class="col-12 mb-3 text-center">
                                                    <button type="button" id="add_select_produit" class="btn btn-info">
                                                        <i class="ri-sticky-note-add-line"></i>
                                                        Ajouter un Produit
                                                    </button>
                                                </div>
                                                <div class="col-12" id="contenu_produit">

                                                </div>
                                                <div class="col-12" id="div_btn_pro" style="display: none;">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">
                                                            Montant Total
                                                        </span>
                                                        <input readonly type="tel" class="form-control" id="montant_total_produit" placeholder="Montant Total">
                                                        <span class="input-group-text">Fcfa</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_btn_calcul" class="border border-2 mb-3 p-2" >
                                    <div class="card-header">
                                        <h5 class="card-title text-center">
                                            Informations Montant
                                        </h5>
                                    </div>
                                    <div class="row gx-3 justify-content-center align-items-center" >
                                        <div class="col-sm-12 mb-3">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button id="btn_calcul" class="btn btn-warning">
                                                    Calculer le montant final
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gx-3" id="div_calcul" style="display: none;">
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Taux</label>
                                                <div class="input-group">
                                                    <input readonly type="tel" class="form-control" id="patient_taux">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Part Assurance</label>
                                                <div class="input-group">
                                                    <input readonly type="tel" class="form-control" id="montant_assurance">
                                                    <input type="hidden" class="form-control" id="montant_assurance_hidden">
                                                    <span class="input-group-text">Fcfa</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Part Patient</label>
                                                <div class="input-group">
                                                    <input readonly type="tel" class="form-control" id="montant_patient">
                                                    <input type="hidden" class="form-control" id="montant_patient_hidden">
                                                    <span class="input-group-text">Fcfa</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Montant Total</label>
                                                <div class="input-group">
                                                    <input readonly type="tel" class="form-control" id="montant_total">
                                                    <span class="input-group-text">Fcfa</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Remise</label>
                                                <div class="input-group">
                                                    <input type="tel" class="form-control" id="taux_remise" value="0">
                                                    <span class="input-group-text">Fcfa</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Application de la remise</label>
                                                <select class="form-select" id="appliq_remise">
                                                    <option selected value="patient">Patient</option>
                                                    <option value="assurance">Assurance</option>
                                                </select>
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
                                        <div class="col-sm-12">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button id="btn_eng" class="btn btn-success">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div_loader" style="display: none;">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                            <strong>Calcul en cours...</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="twoAAA" role="tabpanel" aria-labelledby="tab-twoAAA">
                                <div class="card-header">
                                    <h5 class="card-title text-left">
                                        Nouvel Examen
                                    </h5>
                                </div>
                                <div class="row gx-3 justify-content-center align-items-center">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Type d'examen
                                            </label>
                                            <select class="form-select" id="acte_id_ex">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Nom
                                            </label>
                                            <input type="text" class="form-control" id="nom_ex" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Cotation
                                            </label>
                                            <input type="text" class="form-control" id="cotation_ex" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()" maxlength="1">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Valeur
                                            </label>
                                            <input type="text" class="form-control" id="valeur_ex" placeholder="Saisie Obligatoire">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Prix</label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" id="prix_ex" placeholder="Saisie Obligatoire">
                                                <span class="input-group-text">Fcfa</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Total</label>
                                            <div class="input-group">
                                                <input readonly type="tel" class="form-control" id="montant_ex" placeholder="Montant Total">
                                                <span class="input-group-text">Fcfa</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button id="btn_eng_ex" class="btn btn-success">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="oneAAAD" role="tabpanel" aria-labelledby="tab-oneAAAD">
                                <div class="row gx-3" >
                                    <div class="col-12">
                                        <div class=" mb-3">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="card-title">
                                                    Liste des Examens Demandées
                                                </h5>
                                                <div class="d-flex" >
                                                    <select class="form-select me-1" id="statut">
                                                        <option selected value="tous">Tous</option>
                                                        <option value="en cours">En cours</option>
                                                        <option value="terminé">Terminé</option>
                                                    </select>
                                                    <a id="btn_print_table" style="display: none;" class="btn btn-outline-warning ms-auto me-1">
                                                        <i class="ri-printer-line"></i>
                                                    </a>
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
                                                                    <th scope="col">Statut</th>
                                                                    <th scope="col">Type de Soins</th>
                                                                    <th scope="col">Nom et Prénoms</th>
                                                                    <th scope="col">Soins Infirmiers</th>
                                                                    <th scope="col">Produits</th>
                                                                    <th scope="col">Montant Total</th>
                                                                    <th scope="col">Date de création</th>
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
                                                        Aucun Soins Ambulatoires pour le moment
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
                            <div class="tab-pane fade " id="oneAAA" role="tabpanel" aria-labelledby="tab-oneAAA">
                                <div class="row gx-3" >
                                    <div class="col-12">
                                        <div class=" mb-3">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="card-title">
                                                    Liste des Examens
                                                </h5>
                                                <div class="d-flex" >
                                                    <input type="text" id="searchInputE" placeholder="Recherche" class="form-control me-1">
                                                    <a id="btn_print_tableE" style="display: none;" class="btn btn-outline-warning ms-auto me-1">
                                                        <i class="ri-printer-line"></i>
                                                    </a>
                                                    <a id="btn_refresh_tableE" class="btn btn-outline-info ms-auto">
                                                        <i class="ri-loop-left-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-outer" id="div_TableE" style="display: none;">
                                                    <div class="table-responsive">
                                                        <table class="table align-middle table-hover m-0 truncate" id="TableE">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">N°</th>
                                                                    <th scope="col">Type</th>
                                                                    <th scope="col">Examen</th>
                                                                    <th scope="col">Cotation</th>
                                                                    <th scope="col">Valeur</th>
                                                                    <th scope="col">Prix</th>
                                                                    <th scope="col">Montant Total</th>
                                                                    <th scope="col">Date de création</th>
                                                                    <th scope="col"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div id="message_TableE" style="display: none;">
                                                    <p class="text-center" >
                                                        Aucun Examen n'a été trouvée
                                                    </p>
                                                </div>
                                                <div id="div_Table_loaderE" style="display: none;">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                                                        <strong>Chargement des données...</strong>
                                                    </div>
                                                </div>
                                                <div id="pagination-controlsE" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="oneAAAP" role="tabpanel" aria-labelledby="tab-oneAAAP">
                                <div class="card-header">
                                    <h5 class="card-title text-left">
                                        Prélévment
                                    </h5>
                                </div>
                                <div class="row gx-3 justify-content-center align-items-center">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Prix</label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" id="prix" placeholder="Saisie Obligatoire">
                                                <span class="input-group-text">Fcfa</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button id="btn_eng" class="btn btn-success">
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
    </div>
</div>

<div class="modal fade" id="Detail" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">
                    Détails
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal_detail" style="display: none;">
            </div>
            <div id="message_detail" style="display: none;">
                <p class="text-center" >
                    Aucun détail pour le moment
                </p>
            </div>
            <div id="div_detail_loader" style="display: none;">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="spinner-border text-warning me-2" role="status" aria-hidden="true"></div>
                    <strong>Chargement des données...</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Add" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >
                    Produits Pharmacie
                </h5>
                <button type="button" id="close_modal_produit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal_add">
                <div class="row gx-3 justify-content-center align-items-center">
                    <div class="col-12 mb-3">
                        <button type="button" id="add_select" class="btn btn-info">
                            <i class="ri-sticky-note-add-line"></i>
                            Ajouter un Produit
                        </button>
                    </div>
                    <div class="col-12" id="contenu">

                    </div>
                    <div class="col-12" id="div_btn_pro">
                        <div class="input-group mb-3">
                            <input type="tel" class="form-control" id="montant_total_produit" placeholder="Montant Total">
                            <span class="input-group-text">Fcfa</span>
                        </div>
                        <input type="hidden" id="id_hos_produit">
                        <button type="button" id="btn_eng_produit" class="btn btn-outline-success">
                            Enregistrer
                            <i class="ri-send-plane-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Detail_produit" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">
                    Détail Soins Infirmiers et Produits Utilisés
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
                                        <div id="div_alert_tableP" >
                    
                                        </div>
                                        <div class="table-responsive" id="div_TableP" style="display: none;">
                                            <!-- Tableau Soins Infirmiers -->
                                            <table class="table table-bordered" id="TableP">
                                                <thead>
                                                    <tr>
                                                        <th>Soins Infirmiers</th>
                                                        <th style="width: 250px;">Prix</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="table-responsive" id="div_TableProdP" style="display: none;">
                                            <!-- Tableau Produits Utilisés -->
                                            <table class="table table-bordered" id="TableProdP">
                                                <thead>
                                                    <tr>
                                                        <th>Produits Utilisés</th>
                                                        <th style="width: 200px;">Prix Unitaire</th>
                                                        <th style="width: 50px;" >Quantité</th>
                                                        <th style="width: 200px;">Prix Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div id="message_TableP" style="display: none;">
                                            <p class="text-center" >
                                                Aucun détail pour le moment
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

{{-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa --}}


<div class="modal fade" id="MmodifE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mise à jour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <input type="hidden" id="Id_exM"> <!-- Hidden field for the room's ID -->
                    <div class="row gx-3 justify-content-center align-items-center">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">
                                    Type d'examen
                                </label>
                                <select class="form-select" id="acte_id_exM">
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">
                                    Nom
                                </label>
                                <input type="text" class="form-control" id="nom_exM" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">
                                    Cotation
                                </label>
                                <input type="text" class="form-control" id="cotation_exM" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()" maxlength="1">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">
                                    Valeur
                                </label>
                                <input type="text" class="form-control" id="valeur_exM" placeholder="Saisie Obligatoire">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Prix</label>
                                <div class="input-group">
                                    <input type="tel" class="form-control" id="prix_exM" placeholder="Saisie Obligatoire">
                                    <span class="input-group-text">Fcfa</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Total</label>
                                <div class="input-group">
                                    <input readonly type="tel" class="form-control" id="montant_exM" placeholder="Montant Total">
                                    <span class="input-group-text">Fcfa</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Fermer
                </button>
                <button type="button" class="btn btn-primary" id="updateBtnE">
                    Mettre à jour
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('jsPDF-master/dist/jspdf.umd.js')}}"></script>
<script src="{{asset('jsPDF-AutoTable/dist/jspdf.plugin.autotable.min.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        select_acte();
        listE();

        document.getElementById("btn_eng_ex").addEventListener("click", eng_ex);

        document.getElementById('cotation_ex').addEventListener('keypress', function(event) {
            const key = event.key;
            if (!/^[a-zA-Z]+$/.test(key)) {
                event.preventDefault(); // Empêche la saisie si ce n'est pas une lettre
            }
        });
        document.getElementById('cotation_exM').addEventListener('keypress', function(event) {
            const key = event.key;
            if (!/^[a-zA-Z]+$/.test(key)) {
                event.preventDefault(); // Empêche la saisie si ce n'est pas une lettre
            }
        });
        document.getElementById('prix_ex').addEventListener('input', function() {
            this.value = formatPrice(this.value);
        });
        document.getElementById('prix_ex').addEventListener('keypress', function(event) {
            const key = event.key;  
            if (isNaN(key)) {
                event.preventDefault();
            }
        });
        document.getElementById('prix_exM').addEventListener('input', function() {
            this.value = formatPrice(this.value);
        });
        document.getElementById('prix_exM').addEventListener('keypress', function(event) {
            const key = event.key;  
            if (isNaN(key)) {
                event.preventDefault();
            }
        });
        document.getElementById('valeur_ex').addEventListener('keypress', function(event) {
            const key = event.key;
            if (isNaN(key)) {
                event.preventDefault();
            }
        });
        document.getElementById('valeur_exM').addEventListener('keypress', function(event) {
            const key = event.key;
            if (isNaN(key)) {
                event.preventDefault();
            }
        });

        var inputs = ['prix_ex','valeur_ex'];
        inputs.forEach(function(id) {
            var inputElement = document.getElementById(id);

            inputElement.addEventListener('input', function() {
                calcul_montant_ex();
            });
        });

        var inputs = ['prix_exM','valeur_exM'];
        inputs.forEach(function(id) {
            var inputElement = document.getElementById(id);

            inputElement.addEventListener('input', function() {
                calcul_montant_exM();
            });
        });

        function formatPrice(input) {
            // Remove all non-numeric characters except the comma
            input = input.replace(/[^\d,]/g, '');

            // Convert comma to dot for proper float conversion
            input = input.replace(',', '.');

            // Convert to float and round to the nearest whole number
            let number = Math.round(parseInt(input));
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

        function select_acte() {

            const selectElement = document.getElementById('acte_id_ex');
            const selectElementM = document.getElementById('acte_id_exM');

            selectElement.innerHTML = '';
            selectElementM.innerHTML = '';

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Selectionner';
            selectElement.appendChild(defaultOption);

            $.ajax({
                url: '/api/list_acte_ex',
                method: 'GET',
                success: function(response) {
                    data = response.acte;
                    data.forEach(acte => {
                        const option1 = document.createElement('option');
                        option1.value = acte.id; // Ensure 'id' is the correct key
                        option1.textContent = acte.nom; // Ensure 'nom' is the correct key
                        selectElement.appendChild(option1);

                        const option2 = document.createElement('option');
                        option2.value = acte.id;
                        option2.textContent = acte.nom;
                        selectElementM.appendChild(option2);
                    });
                },
                error: function() {
                    // showAlert('danger', 'Impossible de generer le code automatiquement');
                }
            });
        }

        function calcul_montant_ex() {

            const valeur = parseInt(document.getElementById('valeur_ex').value.replace(/[^0-9]/g, '')) || 0;
            const prix = parseInt(document.getElementById('prix_ex').value.replace(/[^0-9]/g, '')) || 0;

            const total = valeur * prix; 

            document.getElementById('montant_ex').value = formatPriceT(total);
        }

        function calcul_montant_exM() {

            const valeur = parseInt(document.getElementById('valeur_exM').value.replace(/[^0-9]/g, '')) || 0;
            const prix = parseInt(document.getElementById('prix_exM').value.replace(/[^0-9]/g, '')) || 0;

            const total = valeur * prix; 

            document.getElementById('montant_exM').value = formatPriceT(total);
        }

        function eng_ex()
        {
            const id = document.getElementById("acte_id_ex");
            const nom = document.getElementById("nom_ex");
            const cotation = document.getElementById("cotation_ex");
            const valeur = document.getElementById("valeur_ex");
            const prix = document.getElementById("prix_ex");
            const montant = document.getElementById("montant_ex");

            if(!id.value.trim() || !nom.value.trim() || !cotation.value.trim() || !valeur.value.trim() || !prix.value.trim() || !montant.value.trim()){
                showAlert('Alert', 'Veuillez remplir tous les champs SVP.','warning');
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
                url: '/api/examen_new',
                method: 'GET',  // Use 'POST' for data creation
                data: { 
                    id: id.value, 
                    nom: nom.value, 
                    prix: prix.value ,
                    cotation: cotation.value, 
                    valeur: valeur.value, 
                    montant: montant.value ,
                },
                success: function(response) {

                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    if (response.existe) {
                        showAlert('Alert', 'Cet Examen existe déjà.','warning');
                    }else if (response.success) {

                        id.value = '';
                        nom.value = '';
                        prix.value = '';
                        cotation.value = '';
                        valeur.value = '';
                        montant.value = '';

                        listE();

                        showAlert('Succès', 'Opération éffectuée.','success');
                    } else if (response.error) {
                        showAlert('Erreur', 'Une erreur est survenue lors de l\'enregistrement.','error');
                    }

                },
                error: function() {
                    var preloader = document.getElementById('preloader_ch');
                    if (preloader) {
                        preloader.remove();
                    }

                    showAlert('Erreur', 'Une erreur est survenue lors de l\'enregistrement.','error');
                }
            });
        }

        function listE(page = 1) {

            const tableBody = document.querySelector('#TableE tbody');
            const messageDiv = document.getElementById('message_TableE');
            const tableDiv = document.getElementById('div_TableE');
            const loaderDiv = document.getElementById('div_Table_loaderE');

            let allExamens = [];

            messageDiv.style.display = 'none';
            tableDiv.style.display = 'none';
            loaderDiv.style.display = 'block';

            const url = `/api/list_examen_all?page=${page}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    allExamens = data.examen || [] ;
                    const pagination = data.pagination || {};

                    const perPage = pagination.per_page || 10;
                    const currentPage = pagination.current_page || 1;

                    tableBody.innerHTML = '';

                    if (allExamens.length > 0) {
                        document.getElementById('btn_print_tableE').style.display = 'block';

                        loaderDiv.style.display = 'none';
                        messageDiv.style.display = 'none';
                        tableDiv.style.display = 'block';

                        function displayRows(filteredExamens) {
                            tableBody.innerHTML = ''; 

                            filteredExamens.forEach((item, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${((currentPage - 1) * perPage) + index + 1}</td>
                                    <td>${item.acte}</td>
                                    <td>${item.nom}</td>
                                    <td>${item.cotation}</td>
                                    <td>${item.valeur}</td>
                                    <td>${item.prix} Fcfa</td>
                                    <td>${item.montant} Fcfa</td>
                                    <td>${formatDateHeure(item.created_at)}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a class="btn btn-outline-info btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#MmodifE" id="modif-${item.id}">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                `;
                                tableBody.appendChild(row);

                                document.getElementById(`modif-${item.id}`).addEventListener('click', () =>
                                {
                                    // Set the values in the modal form
                                    document.getElementById('Id_exM').value = item.id;
                                    document.getElementById("nom_exM") = item.nom;
                                    document.getElementById("cotation_exM") = item.cotation;
                                    document.getElementById("valeur_exM") = item.valeur;
                                    document.getElementById("prix_exM") = item.prix;
                                    document.getElementById("montant_exM") = item.montant;

                                    const modifActeSelect = document.getElementById("acte_id_exM");
                                    const typeeOptions = modifActeSelect.options;

                                    for (let i = 0; i < typeeOptions.length; i++) {
                                        if (String(typeeOptions[i].value) === String(item.acte_id)) {
                                            typeeOptions[i].selected = true; 
                                            break;
                                        }
                                    }
                                });

                            });
                        };

                        function applySearchFilter() {
                            const searchTerm = searchInputE.value.toLowerCase();
                            const filteredExamens = allExamens.filter(item =>
                                item.type.toLowerCase().includes(searchTerm) ||
                                item.nom.toLowerCase().includes(searchTerm) ||
                                item.cotation.toLowerCase().includes(searchTerm) ||
                                item.valeur.toLowerCase().includes(searchTerm) ||
                                item.prix.toLowerCase().includes(searchTerm)||
                                item.montant.toLowerCase().includes(searchTerm) ||
                                formatDateHeure(item.created_at).toLowerCase().includes(searchTerm)
                            );
                            displayRows(filteredExamens);
                        }

                        searchInputE.addEventListener('input', applySearchFilter);

                        displayRows(allExamens);

                        updatePaginationControlsE(pagination);

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

        function updatePaginationControlsE(pagination) {
            const paginationDiv = document.getElementById('pagination-controlsE');
            paginationDiv.innerHTML = '';

            // Bootstrap pagination wrapper
            const paginationWrapper = document.createElement('ul');
            paginationWrapper.className = 'pagination justify-content-center';

            // Previous button
            if (pagination.current_page > 1) {
                const prevButton = document.createElement('li');
                prevButton.className = 'page-item';
                prevButton.innerHTML = `<a class="page-link" href="#">Precédent</a>`;
                prevButton.onclick = () => listE(pagination.current_page - 1);
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
                pageItem.onclick = () => listE(i);
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
                lastPageItem.onclick = () => listE(totalPages);
                paginationWrapper.appendChild(lastPageItem);
            }

            // Next button
            if (pagination.current_page < pagination.last_page) {
                const nextButton = document.createElement('li');
                nextButton.className = 'page-item';
                nextButton.innerHTML = `<a class="page-link" href="#">Suivant</a>`;
                nextButton.onclick = () => listE(pagination.current_page + 1);
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

    });
</script>


@endsection
