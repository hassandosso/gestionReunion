@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Modification de dépense</h6>
      <!-- card -->
    <!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <!-- LARGE MODAL -->

      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif


      <form method="post" action="{{url('gestion/reunion/valider/depense/'.$depense->id)}}">
        @csrf
      <div class="modal-body pd-20">
        <div class="form-group">
          <label for="montant">Montant:</label>
          <input type="text" class="form-control" id="montant" name="montant" value="{{$depense->montant}}">
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label class="form-control-label">Details: <span class="tx-danger">*</span></label>
            <textarea class="form-control" name="details" id="summernote1">{!!$depense->details!!}</textarea>
          </div>
        </div>
        <?php
          $evenement = DB::table('evenements')->get();
        ?>
            <div class="form-group">
              <label for="nom">Evènement Rattaché (Optionnel):</label>
              <select class="form-control" id="evenement" name="id_evenement" required>
                <option value="-1" class="text-danger">Selectionnz l'évènement rattaché</option>
                @foreach ($evenement as $event)
                  <option value="{{$event->id}}" <?php if($event->id==$depense->id_evenement) echo "selected";?>>{{$event->nom}}</option>
                @endforeach
              </select>
            </div>

      </div><!-- modal-body -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-info pd-x-20">Enregistrer</button>
        <a href="{{route('liste.depenses')}}" class="btn btn-secondary pd-x-20">Fermer</a>
        </form>
      </div>

         </div>

  </div><!-- sl-pagebody -->

  </div><!-- sl-mainpanel -->

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
   crossorigin="anonymous"></script>
@endsection
