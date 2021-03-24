@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Modification de mise à jour</h6>
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


           <form method="post" action="{{url('gestion/reunion/valider/miseajour/'.$maj->id)}}">
             @csrf
           <div class="modal-body pd-20">
             <div class="form-group">
               <label for="participant">Participant:</label>
               <?php
                $part = DB::table('participants')->get();
               ?>
               <select class="form-control" id="participant" name="id_participant">
                 @foreach ($part as $row)
                 <option value="{{$row->id}}" <?php if($row->id == $maj->id_participant) echo "selected";?>>{{$row->nom}} {{$row->prenom}} /{{$row->identification}}</option>
                 @endforeach
               </select>
             </div>

             <div class="form-group">
               <label for="nom">Montant:</label>
               <input type="text" class="form-control" id="nom" name="montant" value="{{$maj->montant}}">
             </div>

           </div><!-- modal-body -->
           <div class="modal-footer">
             <button type="submit" class="btn btn-info pd-x-20">Valider</button>
             <a href="{{route('liste.maj')}}" class="btn btn-secondary pd-x-20">Annuler</a>
           </form>
           </div>
         </div>

  </div><!-- sl-pagebody -->

  </div><!-- sl-mainpanel -->

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
   crossorigin="anonymous"></script>
@endsection
