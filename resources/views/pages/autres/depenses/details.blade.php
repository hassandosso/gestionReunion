@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Evènement rattaché:  <?php if($details->nom==NULL){echo "Aucun évènement n'est rattaché";}else{echo $details->nom;}?>
            <a href="{{route('liste.depenses')}}" class="btn btn-warning btn-sm" style="float:right">Liste Dépenses</a>
          </h6>
          <p>{!!$details->details!!}</p>
        </div><!-- card -->
    </div><!-- sl-mainpanel -->

    <!-- ########## END: MAIN PANEL ########## -->
@endsection()
