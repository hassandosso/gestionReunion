@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Liste des Dépenses
            <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cotisation" style="float:right">Enregistrer une dépense</a>
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-5p">No</th>
                  <th class="wd-15p">Date</th>
                  <th class="wd-15p">Montant</th>
                  <th class="wd-15p">Evenement Rattaché</th>
                  <th class="wd-10p">Actions</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($depenses as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <?php
                    setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
                    $dt = utf8_encode(strftime("%d %B %Y", strtotime($row->created_at)));
                  ?>
                  <td>{{$dt}}</td>
                  <td>{{number_format($row->montant,0,',','.')}}</td>
                  <td>{{$row->nom}}</td>
                  <td>
                    <a href="{{URL::to('gestion/reunion/modifier/depense/'.$row->id)}}" class="btn btn-info btn-sm" title="Modifier"><i class="fa fa-edit"></i></a>
                    <a href="{{URL::to('gestion/reunion/details/depense/'.$row->id)}}" class="btn btn-warning btn-sm" title="Voir Details"><i class="fa fa-eye"></i></a>
                    <a href="{{URL::to('gestion/reunion/supprimer/depense/'.$row->id)}}" class="btn btn-danger btn-sm" id="delete" title="Supprimer"><i class="fa fa-trash"></i></a>
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
    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Enregistrer une Depense</h6>
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

  <form method="post" action="{{route('enregistrer.depense')}}">
    @csrf
  <div class="modal-body pd-20">
    <div class="form-group">
      <label for="montant">Montant</label>
      <input type="text" class="form-control" id="montant" name="montant" require>
    </div>
      <div class="form-group">
        <label class="form-control-label">Details: <span class="tx-danger">*</span></label>
        <textarea class="form-control" name="details" id="summernote1"></textarea>
      </div>
    <?php
      $evenement = DB::table('evenements')->get();
    ?>
        <div class="form-group">
          <label for="nom">Evènement Rattaché (Optionnel):</label>
          <select class="form-control" id="evenement" name="id_evenement" required>
            <option value="-1" class="text-danger">Selectionnz l'évènement rattaché</option>
            @foreach ($evenement as $event)
              <option value="{{$event->id}}">{{$event->nom}}</option>
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
