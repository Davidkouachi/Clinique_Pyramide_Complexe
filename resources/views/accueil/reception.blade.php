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
    <!-- Row starts -->
    <div class="row gx-3">
        <div class="col-xl-2 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                            <i class="ri-verified-badge-line fs-4 lh-1"></i>
                        </div>
                        <h6>Total Patient</h6>
                        <h2 class="text-primary m-0">639</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                            <i class="ri-stethoscope-line fs-4 lh-1"></i>
                        </div>
                        <h6>Doctors</h6>
                        <h2 class="text-primary m-0">83</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                            <i class="ri-psychotherapy-line fs-4 lh-1"></i>
                        </div>
                        <h6>Staff</h6>
                        <h2 class="text-primary m-0">296</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                            <i class="ri-lungs-line fs-4 lh-1"></i>
                        </div>
                        <h6>Operations</h6>
                        <h2 class="text-primary m-0">49</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                            <i class="ri-hotel-bed-line fs-4 lh-1"></i>
                        </div>
                        <h6>Admitted</h6>
                        <h2 class="text-primary m-0">372</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                            <i class="ri-walk-line fs-4 lh-1"></i>
                        </div>
                        <h6>Discharged</h6>
                        <h2 class="text-primary m-0">253</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row ends -->

    <div class="row gx-3" >
        <div class="col-sm-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Consultation</h5>
                </div>
                <div class="card-body">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs justify-content-center" id="customTab4" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab" aria-controls="oneAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Nouvelle consultation
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab" aria-controls="twoAAA" aria-selected="false" tabindex="-1">
                                    <i class="ri-walk-line me-2"></i>
                                    Nouveau patient
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " id="tab-threeAAA" data-bs-toggle="tab" href="#threeAAA" role="tab" aria-controls="threeAAA" aria-selected="true">
                                    <i class="ri-shake-hands-line me-2"></i>
                                    Nouvelle societe
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="customTabContent">
                            <div class="tab-pane fade active show" id="oneAAA" role="tabpanel" aria-labelledby="tab-oneAAA">
                                <div class="card-header">
                                    <h5 class="card-title text-center">Formulaire Nouvelle consultation</h5>
                                </div>
                                <div class="row gx-3">
                                    <div class="row gx-3 justify-content-center align-items-center" >
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Numéro du dossier</label>
                                                <div class="input-group">
                                                    <input name="taux" required type="email" class="form-control" id="taux" placeholder="Email de l'assurance" maxlength="3">
                                                    <button id="btn_rech_num_dossier" type="submit" class="btn btn-outline-success">
                                                        <i class="ri-search-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" id="div_info_patient">
                                    </div>
                                    <div class="col-sm-12" id="div_info_consul" style="display: block;">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">Information consultation</h5>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Période de consultation</label>
                                                    <div class="m-0">
                                                        <div class="form-check form-check-inline">
                                                            <input checked class="form-check-input" type="radio" id="jourO" name="periode_consul" value="ouvrable">
                                                            <label class="form-check-label" for="jourO">Jour Ouvrable</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="Nuit" name="periode_consul" value="nuit">
                                                            <label class="form-check-label" for="Nuit">Nuit</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="jourF" name="periode_consul" value="ferier">
                                                            <label class="form-check-label" for="jourF">Jour Ferié</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="a6">Nature Consultation</label>
                                                    <select class="form-select" id="a6">
                                                        <option value="0">Select</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="a6">Type Consultation</label>
                                                    <select class="form-select" id="a6">
                                                        <option value="0">Select</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="a6">Medecin</label>
                                                    <select class="form-select" id="a6">
                                                        <option value="0">Select</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
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
                                                            <input readonly type="text" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Part Patient</span>
                                                            <input readonly type="text" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Remise</span>
                                                            <input readonly type="text" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text">Montant Total</span>
                                                            <input readonly type="text" class="form-control" id="">
                                                        </div>
                                                    </div>
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
                                            <input type="tel" class="form-control" id="patient_teel2_new" placeholder="Facultatif" maxlength="10">
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
                                            <label class="form-label">Assurer</label>
                                            <div class="m-0">
                                                <div class="form-check form-check-inline">
                                                    <input checked class="form-check-input" type="radio" id="assurerO" name="patient_statut_assurer" value="non">
                                                    <label class="form-check-label" for="assurerO">Non</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="assurerN" name="patient_statut_assurer" value="oui">
                                                    <label class="form-check-label" for="assurerN">Oui</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gx-3" id="div_assurer" style="display: none;" >
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Assurance</label>
                                                <select class="form-select" id="patient_assurance_id_new">
                                                    <option value="0">Select</option>
                                                    <option value="1">1</option>
                                                </select>
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
                                                    <option value="0">Select</option>
                                                    <option value="1">1</option>
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
                                                <input name="societe_new" required type="text" class="form-control" id="societe_new" placeholder="Saisie Obligatoire">
                                                <button id="btn_eng_societe" class="btn btn-outline-success">
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

    <div class="row gx-3" >
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Patient enregistrées Aujourd'hui</h5>
                </div>
                <div class="card-body">
                    <div class="table-outer">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover m-0 truncate">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Type</th>
                                        {{-- <th scope="col">Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <img height="40" width="40" class="rounded-circle" src="assets/images/user8.png">
                                            nom
                                        </td>
                                        <td>email</td>
                                        <td>Contact</td>
                                        <td>C213</td>
                                        <td>Consultation</td>
                                        {{-- <td>
                                            <div class="d-inline-flex gap-1">
                                                <a class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#delRow" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Supprimer">
                                                  <i class="ri-delete-bin-line"></i>
                                                </a>
                                                <a class="btn btn-outline-info btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mmodif{{$value->id}}">
                                                  <i class="ri-edit-box-line"></i>
                                                </a>
                                                <a class="btn btn-outline-warning btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mdetail{{$value->id}}">
                                                  <i class="ri-eye-line"></i>
                                                </a>
                                            </div>
                                        </td> --}}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{asset('assets/js/app/js/reception/assurer_info.js')}}" ></script>
<script src="{{asset('assets/js/app/js/reception/rech_dossier.js')}}" ></script>

<script src="{{asset('assets/js/app/js/reception/select_taux_patient_new.js')}}" ></script>

@endsection
