@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Modification de cotisation</h6>
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


           <form method="post" action="{{url('gestion/reunion/validermodification/'.$cotisation->id)}}">
             @csrf
           <div class="modal-body pd-20">

                 <div class="form-group">
                   <label for="nom">Nom</label>
                   <input type="text" class="form-control" id="nom" name="nom" value="{{$cotisation->nom}}" require>
                 </div>
                 <div class="form-group">
                   <label for="montant">Montant Fixé</label>
                   <input type="text" class="form-control" id="montant" name="montant_fixe" value="{{$cotisation->montant_fixe}}" require>
                 </div>
                 <div class="form-group">
                   <label for="date_limite">Date Limite</label>
                   <input type="date" class="form-control" id="date_limite" name="date_limite" value="{{$cotisation->date_limite}}">
                 </div>

           </div><!-- modal-body -->
           <div class="modal-footer">
             <button type="submit" class="btn btn-info pd-x-20">Valider</button>
             <button type="reset" class="btn btn-secondary pd-x-20">Fermer</button>
           </form>
           </div>
         </div>

  </div><!-- sl-pagebody -->

  </div><!-- sl-mainpanel -->

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
   crossorigin="anonymous"></script>
@endsection
