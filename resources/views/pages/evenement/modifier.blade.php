@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Modification d'évènement</h6>
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


           <form method="post" action="{{url('gestion/reunion/valider/evenement/'.$evenement->id)}}">
             @csrf
           <div class="modal-body pd-20">

             <div class="form-group">
               <label for="nom">Nom</label>
               <input type="text" class="form-control" id="nom" name="nom" value="{{$evenement->nom}}">
             </div>
             <div class="form-group">
               <label for="lieu">Lieu</label>
               <input type="text" class="form-control" id="lieu" name="lieu" value="{{$evenement->lieu}}">
             </div>
             <div class="form-group">
               <label for="date_prevue">Date Prévue</label>
               <input type="date" class="form-control" id="date_prevue" name="date" value="{{$evenement->date}}">
             </div>
             <div class="form-group">
               <label for="budget">Budget</label>
               <input type="text" class="form-control" id="budget" name="budget" value="{{$evenement->budget}}">
             </div>
             <div class="form-group">
               <label for="cotisation">Cotisation Rattachée</label>
               <?php
                $cotisation = DB::table('cotisations')->get();
               ?>
               <select class="form-control" id="n_cotisation" name="cotisation_id">
                 @foreach ($cotisation as $row)
                 <option value="{{$row->id}}" <?php if($row->id == $evenement->cotisation_id) echo "selected";?>>{{$row->nom}}</option>
                 @endforeach
                 <option value="nouvelle" class="text-danger">Créer une nouvelle cotisation</option>
                 <option value="" class="text-danger">Aucune cotisation prévue</option>
               </select>
             </div>

           </div><!-- modal-body -->
           <div class="modal-footer">
             <button type="submit" class="btn btn-info pd-x-20">Valider</button>
             <a href="{{route('liste.evenement')}}" class="btn btn-secondary pd-x-20">Annuler</a>
           </form>
           </div>
         </div>

  </div><!-- sl-pagebody -->

  </div><!-- sl-mainpanel -->

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
   crossorigin="anonymous"></script>
@endsection
