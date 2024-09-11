@extends('app')

@section('titre', 'Nouvelle Assurance')

@section('info_page')
<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-bar-chart-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{route('index_accueil')}}">Espace Santé</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Nouvelle Chambre
        </li>
    </ol>
</div>
@endsection

@section('content')

<div class="app-body">
    <!-- Row starts -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Formulaire Nouvelle Chambre</h5>
                </div>
                <form class="card-body" id="form_chambre" method="post" action="{{route('insert_chambre')}}" >
                    @csrf
                    <!-- Row starts -->
                    <div class="row gx-3">
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Numero du lit
                                </label>
                                <select required name="code" class="form-select" id="code">
                                    <option value="">Selectionner</option>
                                    @for($i = 1; $i <= 10; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Type
                                </label>
                                <select required name="type" class="form-select" id="type">
                                    <option value="">Selectionner</option>
                                    <option value="Enfant">Enfant</option>
                                    <option value="Adulte">Adulte</option>
                                    <option value="Berceau">Berceau</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Chambre
                                </label>
                                <select required name="chambre_id" class="form-select" id="chambre_id">
                                    <option value="">Selectionner</option>
                                    @foreach($chams as $value)
                                        <option value="{{$value->id}}">
                                            {{'Chambre '.$value}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
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
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Lits enregistrées Aujourd'hui</h5>
                </div>
                <div class="card-body">
                    <div class="table-outer">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover m-0 truncate">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Numéro</th>
                                        <th scope="col">Catégorie</th>
                                        <th scope="col">Nombre de le chambre</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lits as $key => $value)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            {{$value->code}}
                                        </td>
                                        <td>{{$value->type}}</td>
                                        <td>{{$value->code_chambre}}</td>
                                        <td>{{$value->prix_chambre.' Fcfa'}}</td>
                                        <td>
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
                                        </td>
                                    </tr>
                                    @endforeach
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

<div class="modal fade" id="delRow" tabindex="-1" aria-labelledby="delRowLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delRowLabel">
                    Confirm
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the department?
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end gap-2">
                    <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No</a>
                    <a class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Yes</a>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($lits as $value)
<div class="modal fade" id="Mdetail{{$value->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Détail lit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gx-3">
                    <div class="col-12 text-center">
                        <div class="mb-3">
                            <h5 class="card-title">Numéro du lit : </h5>
                            <label class="form-label" for="nom">{{$value->code}}</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="mb-3">
                            <h5 class="card-title">Type : </h5>
                            <label class="form-label" for="nom">{{$value->type}}</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="mb-3">
                            <h5 class="card-title">Numéro de la chambre : </h5>
                            <label class="form-label" for="nom">{{$value->code_chambre}}</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="mb-3">
                            <h5 class="card-title">Prix : </h5>
                            <label class="form-label" for="nom">{{$value->prix_chambre.' Fcfa'}}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($lits as $value)
<div class="modal fade" id="Mmodif{{$value->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Mise à jour
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="card-body" id="form_lit_modifier" method="post" action="{{route('update_lit',$value->id)}}" >
                    @csrf
                    <!-- Row starts -->
                    <div class="row gx-3">
                         <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Numero du lit
                                </label>
                                <select required name="code" class="form-select" id="code">
                                    <option value="">Selectionner</option>
                                    @for($i = 1; $i <= 10; $i++)
                                    <option @if($value->code === $i) selected @endif value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Type
                                </label>
                                <select required name="type" class="form-select" id="type">
                                    <option value="">Selectionner</option>
                                    <option @if($value->type === 'Enfant') selected @endif value="Enfant">Enfant</option>
                                    <option @if($value->type === 'Adulte') selected @endif value="Adulte">Adulte</option>
                                    <option @if($value->type === 'Berceau') selected @endif value="Berceau">Berceau</option>
                                    <option @if($value->type === 'Autre') selected @endif value="Autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Chambre
                                </label>
                                <select required name="chambre_id" class="form-select" id="chambre_id">
                                    <option value="">Selectionner</option>
                                    @foreach($chams as $cham)
                                        <option @if($cham->code === $value->code_chambre) selected @endif value="{{$cham->id}}">
                                                {{'Chambre '.$cham->code}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex gap-2 justify-content-end">
                                <a type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                   Fermer
                                </a>
                                <button type="submit" class="btn btn-success">
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Row ends -->
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection