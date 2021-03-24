@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Modification Dons et Autres</h6>
          <form method="post" action="{{url('gestion/reunion/valider/don/'.$don->id)}}">
            @csrf
          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="donateur">Donateur:</label>
              <input type="text" class="form-control" id="donateur" name="donateur" value="{{$don->donateur}}">
            </div>
            <div class="form-group">
              <label for="montant">Montant</label>
              <input type="text" class="form-control" id="montant" name="montant" value="{{$don->montant}}">
            </div>
              <div class="form-group">
                <label class="form-control-label">Details: <span class="tx-danger">*</span></label>
                <select class="form-control" name="details">
                  <?php
                    $details = array("Don","Participation Exceptionnelle","Demande d'aide");
                  ?>
                  @foreach($details as $det)
                  <option value="{{$det}}" <?php if($det == $don->details) echo "selected";?>>{{$det}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{$don->date}}">
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
                      <option value="{{$event->id}}" <?php if($event->id==$don->id_evenement) echo "selected";?>>{{$event->nom}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="nom">Cotisation Rattaché (Optionnel):</label>
                  <select class="form-control" id="cotisation" name="id_cotisation">
                    <option value="-1" class="text-danger">Selectionne la cotisation rattachée</option>
                    @foreach ($cotisation as $cotis)
                      <option value="{{$cotis->id}}" <?php if($cotis->id==$don->id_cotisation) echo "selected";?>>{{$cotis->nom}}</option>
                    @endforeach
                  </select>
                </div>

          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pd-x-20">Enregistrer</button>
            <a href="{{route('liste.dons')}}" class="btn btn-secondary pd-x-20" >Annuler</a>
          </div>
          </form>
        </div><!-- card -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection()
