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
        <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Formulaire Nouveau Produit</h5>
                </div>
                <div class="card-body" >
                    <!-- Row starts -->
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
                    <!-- Row ends -->
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        Facture non réglée
                    </h5>
                    <div class="d-flex" >
                        <a id="btn_refresh_table" class="btn btn-outline-info ms-auto">
                            <i class="ri-loop-left-line"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-outer">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover m-0 truncate">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Produit</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            <div class="d-inline-flex gap-1">
                                                <a class="btn btn-outline-warning btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Detail">
                                                  <i class="ri-eye-line"></i>
                                                </a>
                                                <a class="btn btn-outline-info btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#Mmodif">
                                                    <i class="ri-printer-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="100px" >Code</th>
                                                        <th colspan="2">Description</th>
                                                        <th width="150px" >Part Assurance</th>
                                                        <th width="150px" >Remise</th>
                                                        <th width="150px" >Part Patient</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h6>C-456284</h6>
                                                        </td>
                                                        <td colspan="2" >
                                                            <h6>Bootstrap Admin Template</h6>
                                                            <p>
                                                                Create quality mockups and prototypes 
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-primary" >13.000 Fcfa</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-primary" >5%</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-primary" >10.000 Fcfa</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6>C-456284</h6>
                                                        </td>
                                                        <td colspan="2" >
                                                            <h6>Bootstrap Admin Template</h6>
                                                            <p>
                                                                Create quality mockups and prototypes 
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-primary" >15.000 Fcfa</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-primary" >7%</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-primary" >1.000 Fcfa</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">&nbsp;</td>
                                                        <td colspan="2" >
                                                            <h5 class="mt-1 text-success">
                                                                Total : 51.000 Fcfa
                                                            </h5>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">
                                                            <h6 class="text-danger">NOTES</h6>
                                                            <p class="small m-0">
                                                                We really appreciate your business and if
                                                                there’s anything else we can do, please
                                                                let us know! Also, should you need us to
                                                                add VAT or anything else to this order,
                                                                it’s super easy since this is a template,
                                                                so just ask!
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row end -->
                                <!-- Row start -->
                                <div class="row">
                                    <div class="col-sm-12 col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button class="btn btn-outline-warning">
                                                Imprimer
                                            </button>
                                            <button class="btn btn-success">
                                                Payer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection