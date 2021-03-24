@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Dons / Participations Exceptionnelles
            <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cotisation" style="float:right">Nouvel Enregistrement</a>
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Donateur</th>
                  <th class="wd-10p">Montant</th>
                  <th class="wd-15p">Details</th>
                  <th class="wd-15p">Pour</th>
                  <th class="wd-15p">Date</th>
                  <th class="wd-10p">Actions</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($dons as $key=>$row)
                <tr>
                  <td>{{$row->donateur}}</td>
                  <td>{{number_format($row->montant,0,',','.')}}</td>
                  <td>{{$row->details}}</td>
                  <td>
                    {{$row->nom_ev}}
                    @if ($row->nom_cot!=NULL && $row->nom_ev!=NULL)
                    ,
                    @endif
                    {{$row->nom_cot}}
                  </td>
                  <?php
                    setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
                    $dt = utf8_encode(strftime("%d %B %Y", strtotime($row->date)));
                  ?>
                  <td>{{$dt}}</td>
                  <td>
                    <a href="{{URL::to('gestion/reunion/modifier/don/'.$row->id)}}" class="btn btn-info btn-sm" title="Modifier"><i class="fa fa-edit"></i></a>
                    <a href="{{URL::to('gestion/reunion/supprimer/don/'.$row->id)}}" class="btn btn-danger btn-sm" id="delete" title="Supprimer"><i class="fa fa-trash"></i></a>
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
    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Dons / Participation Exceptionnelles</h6>
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

  <form method="post" action="{{route('enregistrer.don')}}">
    @csrf
  <div class="modal-body pd-20">
    <div class="form-group">
      <label for="donateur">Donateur:</label>
      <input type="text" class="form-control" id="donateur" name="donateur" required>
    </div>
    <div class="form-group">
      <label for="montant">Montant</label>
      <input type="text" class="form-control" id="montant" name="montant" require>
    </div>
      <div class="form-group">
        <label class="form-control-label">Details: <span class="tx-danger">*</span></label>
        <select class="form-control" name="details">
          <option value="Don">Don</option>
          <option value="Participation Exceptionnelle">Participation Exceptionnelle</option>
          <option value="Demande d'aide">Demande d'aide</option>
        </select>
      </div>
      <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" require>
      </div>
    <?php
      $evenement = DB::table('evenements')->get();
      $cotisation = DB::table('cotisations')->get();
    ?>
        <div class="form-group">
          <label for="nom">Evènement Rattaché (Optionnel):</label>
          <select class="form-control" id="evenement" name="id_evenement">
            <option value="-1" class="text-danger">Selectionnz l'évènement rattaché</option>
            @foreach ($evenement as $event)
              <option value="{{$event->id}}">{{$event->nom}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="nom">Cotisation Rattaché (Optionnel):</label>
          <select class="form-control" id="cotisation" name="id_cotisation">
            <option value="-1" class="text-danger">Selectionne la cotisation rattachée</option>
            @foreach ($cotisation as $cotis)
              <option value="{{$cotis->id}}">{{$cotis->nom}}</option>
            @endforeach
          </select>
        </div>

  </div><!-- modal-body -->
  <div class="modal-footer">
    <button type="submit" class="btn btn-info pd-x-20">Enregistrer</button>
    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Fermer</button>
  </div>
  </form>
</div>
</div><!-- modal-dialog -->
</div><!-- modal -->


    <!-- ########## END: MAIN PANEL ########## -->
@endsection()
