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
            Nouvel Utilisateur
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
                    <h5 class="card-title">Formulaire Nouvel Utilisateur</h5>
                </div>
                <form class="card-body" id="form_utilisateur" method="post" action="{{route('insert_utilisateur')}}" >
                    @csrf
                    <!-- Row starts -->
                    <div class="row gx-3">
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="nom">Nom et Prénoms</label>
                                <input name="name" required type="text" class="form-control" id="nom" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="sexe">Sexe</label>
                                <select name="sexe" class="form-select" id="sexe">
                                    <option value="">Selectionner</option>
                                    <option value="M">Homme</option>
                                    <option value="Mme">Femme</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input name="email" required type="email" class="form-control" id="email" placeholder="Saisie Obligatoire">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="tel">Contact</label>
                                <input name="tel" required type="tel" class="form-control" id="tel" placeholder="Saisie Obligatoire" maxlength="10">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="tel2">Contact 2</label>
                                <input name="tel2" type="tel" class="form-control" id="tel2" placeholder="Autre contact (facultatif)" maxlength="10">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="adresse">Adresse</label>
                                <input required name="adresse" type="text" class="form-control" id="adresse" placeholder="Saisie Obligatoire">
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
                    <h5 class="card-title">Assurance enregistrées Aujourd'hui</h5>
                </div>
                <div class="card-body">
                    <div class="table-outer">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover m-0 truncate">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Nom et Prénoms</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Adresse</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $key => $value)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <img height="40" width="40" class="rounded-circle" src="assets/images/user8.png" alt="Bootstrap Gallery">
                                            {{$value->sexe.'. '.$value->name}}
                                        </td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->tel}}</td>
                                        <td>{{$value->adresse}}</td>
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

<script src="{{asset('assets/js/app/js/nouveau/utilisateur.js')}}" ></script>
<script src="{{asset('assets/js/app/js/modifier/utilisateur.js')}}" ></script>

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

@foreach($users as $value)
<div class="modal fade" id="Mdetail{{$value->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Détail Utilisateur
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gx-3">
                    <div class="col-12 text-center">
                        <div class="mb-3">
                            <h5 class="card-title">Nom et Prénoms : </h5>
                            <label class="form-label" for="nom">{{$value->sexe.'. '.$value->name}}</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="mb-3">
                            <h5 class="card-title">Email : </h5>
                            <label class="form-label" for="nom">{{$value->email}}</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="mb-3">
                            <h5 class="card-title">Contact : </h5>
                            <label class="form-label" for="nom">{{'+225 '.$value->tel}}</label>
                        </div>
                    </div>
                    @if(!empty($value->tel2))
                    <div class="col-12 text-center">
                        <div class="mb-3">
                            <h5 class="card-title">Contact 2 : </h5>
                            <label class="form-label" for="nom">{{'+225 '.$value->tel2}}</label>
                        </div>
                    </div>
                    @endif
                    <div class="col-12 text-center">
                        <div class="mb-3">
                            <h5 class="card-title">Adresse : </h5>
                            <label class="form-label" for="nom">{{$value->adresse}}</label>
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

@foreach($users as $value)
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
                <form class="card-body" id="form_utilisateur_modifier" method="post" action="{{route('update_utilisateur',$value->id)}}" >
                    @csrf
                    <!-- Row starts -->
                    <div class="row gx-3">
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="name_modif">Nom et Prénoms</label>
                                <input name="name_modif" required type="text" class="form-control" id="name_modif" placeholder="Saisie Obligatoire" oninput="this.value = this.value.toUpperCase()" value="{{$value->name}}" >
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="sexe_modif">Sexe</label>
                                <select name="sexe_modif" required class="form-select" id="sexe_modif">
                                    <option value="">Selectionner</option>
                                    <option @if($value->sexe === 'M') selected @endif value="M">Homme</option>
                                    <option @if($value->sexe === 'Mme') selected @endif value="Mme">Femme</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="email_modif">Email</label>
                                <input name="email_modif" required type="email" class="form-control" id="email_modif" placeholder="Saisie Obligatoire" value="{{$value->email}}">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="tel_modif">Contact</label>
                                <input name="tel_modif" required type="tel_modif" class="form-control" id="tel_modif" placeholder="Saisie Obligatoire" maxlength="10" value="{{$value->tel}}">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="tel2_modif">Contact 2</label>
                                <input name="tel2_modif" type="tel_modif" class="form-control" id="tel2_modif" placeholder="(facultatif)" maxlength="10" value="{{$value->tel2}}">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="adresse_modif">Adresse</label>
                                <input required name="adresse_modif" type="text" class="form-control" id="adresse_modif" placeholder="Saisie Obligatoire" value="{{$value->adresse}}">
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


<script>
    var inputElement = document.getElementById('tel');
    inputElement.addEventListener('input', function() {
        // Supprimer tout sauf les chiffres
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

<script>
    var inputElement = document.getElementById('tel2');
    inputElement.addEventListener('input', function() {
        // Supprimer tout sauf les chiffres
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

<script>
    var inputElement = document.getElementById('tel_modif');
    inputElement.addEventListener('input', function() {
        // Supprimer tout sauf les chiffres
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

<script>
    var inputElement = document.getElementById('tel2_modif');
    inputElement.addEventListener('input', function() {
        // Supprimer tout sauf les chiffres
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>


@endsection