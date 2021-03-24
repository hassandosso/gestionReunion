@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Créer un évènement</h6>
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


           <form method="post" action="{{route('enregistrer.Ev')}}">
             @csrf
           <div class="modal-body pd-20">

                 <div class="form-group">
                   <label for="nom">Nom</label>
                   <input type="text" class="form-control" id="nom" name="nom" require>
                 </div>
                 <div class="form-group">
                   <label for="lieu">Lieu</label>
                   <input type="text" class="form-control" id="lieu" name="lieu">
                 </div>
                 <div class="form-group">
                   <label for="date_prevue">Date Prévue</label>
                   <input type="date" class="form-control" id="date_prevue" name="date">
                 </div>
                 <div class="form-group">
                   <label for="budget">Budget</label>
                   <input type="text" class="form-control" id="budget" name="budget">
                 </div>
                 <div class="form-group">
                   <label for="cotisation">Cotisation Rattachée</label>
                   <?php
                    $cotisation = DB::table('cotisations')->get();
                   ?>
                   <select class="form-control" id="n_cotisation" name="cotisation_id">
                     @foreach ($cotisation as $row)
                     <option value="{{$row->id}}">{{$row->nom}}</option>
                     @endforeach
                     <option value="nouvelle" class="text-danger">Créer une nouvelle cotisation</option>
                     <option value="-1" class="text-danger">Aucune cotisation prévue</option>
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

  <!-- LARGE MODAL -->
<div id="cotisation" class="modal fade">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content tx-size-sm">
<div class="modal-header pd-x-20">
  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Nouvelle Cotisation Exceptionnelles</h6>
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

<form method="post" action="{{route('creer.cotisation')}}">
  @csrf
<div class="modal-body pd-20">

      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" require>
      </div>
      <div class="form-group">
        <label for="montant">Montant Fixé</label>
        <input type="text" class="form-control" id="montant" name="montant_fixe" require>
      </div>
      <div class="form-group">
        <label for="date_limite">Date Limite</label>
        <input type="date" class="form-control" id="date_limite" name="date_limite">
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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
   crossorigin="anonymous"></script>
<script src="{{asset('public/backend/js/onlineJs/jquery-3.5.1.min.js')}}"></script>
<script>
  $('#n_cotisation').on('change',function(){
    var selected = $(this).val();
    if (selected == 'nouvelle'){
      $('#cotisation').modal('show');
    }
  });
</script>
@endsection
