@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Modification de l'amande</h6>
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


      <form method="post" action="{{url('gestion/reunion/valider/amande/'.$amande->id)}}">
        @csrf
      <div class="modal-body pd-20">
        <div class="form-group">
          <label for="montant">Montant:</label>
          <input type="text" class="form-control" id="montant" name="montant" value="{{$amande->montant}}">
        </div>
          <div class="form-group">
            <label class="form-control-label">Raion de l'amande: <span class="tx-danger">*</span></label>
            <textarea class="form-control" name="raison">{{$amande->raison}}</textarea>
          </div>
        <?php
          $participants = DB::table('participants')->get();
        ?>
        <div class="form-group">
          <label for="nom">Participant:</label>
          <select class="form-control" id="participant" name="id_participant" require>
            <option class="text-danger">Selection la personne</option>
            @foreach ($participants as $part)
              <option value="{{$part->id}}" <?php if($part->id==$amande->id_participant)echo "selected";?>>{{$part->nom}} {{$part->prenom}} /{{$part->identification}}</option>
            @endforeach
          </select>
        </div>

      </div><!-- modal-body -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-info pd-x-20">Enregistrer</button>
        <a href="{{route('liste.amandes')}}" class="btn btn-secondary pd-x-20">Fermer</a>
        </form>
      </div>

         </div>

  </div><!-- sl-pagebody -->

  </div><!-- sl-mainpanel -->

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
   crossorigin="anonymous"></script>
@endsection
