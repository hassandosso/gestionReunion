@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Liste des Mises à jour
            <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cotisation" style="float:right">Enregistrer une mise à jour</a>
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-5p">No</th>
                  <th class="wd-25p">Nom et Prénoms</th>
                  <th class="wd-15p">Surnom / ID</th>
                  <th class="wd-15p">Montant</th>
                  <th class="wd-15p">Date de Paiement</th>
                  <th class="wd-15p">Actions</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($liste_maj as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row->nom}} {{$row->prenom}}</td>
                  <td>{{$row->surnom}} /{{$row->identification}}</td>
                  <td>{{$row->montant}}</td>
                  <?php
                    setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
                    $dt = utf8_encode(strftime("%d %B %Y", strtotime($row->created_at)));
                  ?>
                  <td>{{$dt}}</td>
                  <td>
                    <a href="{{URL::to('gestion/reunion/modifier/misajour/'.$row->id)}}" class="btn btn-info btn-sm" title="Modifier"><i class="fa fa-edit"></i></a>
                    <a href="{{URL::to('gestion/reunion/supprimer/misajour/'.$row->id)}}" class="btn btn-danger btn-sm" id="delete" title="Supprimer"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-mainpanel -->

    <!-- LARGE MODAL -->
<div id="cotisation" class="modal fade">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content tx-size-sm">
  <div class="modal-header pd-x-20">
    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Enregistrer une mise à jour</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form method="post" action="{{route('creer.maj')}}">
    @csrf
  <div class="modal-body pd-20">
    <?php
      $participants = DB::table('participants')->get();
    ?>
        <div class="form-group">
          <label for="nom">Participant:</label>
          <select class="form-control" id="participant" name="id_participant" require>
            <option class="text-danger">Selection la personne</option>
            @foreach ($participants as $part)
              <option value="{{$part->id}}">{{$part->nom}} {{$part->prenom}} /{{$part->identification}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="montant">Montant</label>
          <input type="text" class="form-control" id="montant" name="montant" require>
        </div>

  </div><!-- modal-body -->
  <div class="modal-footer">
    <button type="submit" class="btn btn-info pd-x-20">Enregistrer</button>
    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Fermer</button>
  </form>
  </div>
</div>
</div><!-- modal-dialog -->
</div><!-- modal -->


    <!-- ########## END: MAIN PANEL ########## -->
@endsection()
