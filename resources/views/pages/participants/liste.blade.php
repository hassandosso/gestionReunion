@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Liste des membres
            <a href="{{route('creer')}}" class="btn btn-warning btn-sm" style="float:right">Ajouter un Membre</a>
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">No</th>
                  <th class="wd-15p">Identifiant</th>
                  <th class="wd-15p">Nom et Prénoms</th>
                  <th class="wd-20p">Surnom</th>
                  <th class="wd-15p">Naissance</th>
                  <th class="wd-15p">Nom du père</th>
                  <th class="wd-20p">Actions</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($liste as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row->identification}}</td>
                  <td>{{$row->nom}} {{$row->prenom}}</td>
                  <td>{{$row->surnom}}</td>
                  <td>{{$row->naissance}}</td>
                  <td>{{$row->pere}}</td>
                  <td>
                    <a href="{{URL::to('detail/membre/'.$row->identification)}}" class="btn btn-warning btn-sm" title="Détails"><i class="fa fa-eye"></i></a>
                    <a href="{{URL::to('modifier/membre/'.$row->id)}}" class="btn btn-info btn-sm" title="Modifier"><i class="fa fa-edit"></i></a>
                    <a href="{{URL::to('supprimer/membre/'.$row->id)}}" class="btn btn-danger btn-sm" id="delete" title="Supprimer"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection()
