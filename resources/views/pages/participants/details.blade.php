@extends('layouts.app')

@section('content')

	<!-- Single Product -->
<div class="sl-mainpanel">

	<div class="single_product">
		<div class="container">
      <div class="row">
      <div class="col-lg-8 col-sm-8">
          <img src="{{asset($membre->photo)}}" alt="{{$membre->nom}} {{$membre->prenom}}"
          style="float:right; width:150px; height:150px; margin-top:80px; border:1px solid darkblue">
      </div>
    </div>
    <div class="row">
      <a href="{{route('listeMembre')}}" class="btn btn-warning btn-sm" style="float:right">Retour à la liste</a>
    </div>
    <hr>
    <h6 class="card-body-title" style="text-align:center; color:darkblue">Informations Personnelles</h6>
    <hr>
			<div class="row">
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Numéro d'identification:  </strong><i>{{$membre->identification}}</i>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Nom & Prénoms:  </strong><i>{{$membre->nom}} {{$membre->prenom}}</i>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Surnom:  </strong><i>{{$membre->surnom}}</i>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Nom du Père:  </strong><i>{{$membre->pere}}</i>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Téléphone:  </strong><i>{{$membre->contact}}</i>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Domicile:  </strong><i>{{$membre->adresse}}</i>
        </div>
			</div>
      <hr>
      <h6 class="card-body-title" style="text-align:center; color:darkblue">Informations Réunions Mensuelles</h6>
      <hr>
      <div class="row">
        <div class="col-lg-4 col-sm-12 col-md-4">
          <p><strong>Nombre de Participation:  </strong><i>{{$nbParticipation}} / {{$countReunion}}</i></p>
            <p><strong>Somme Cotisée:  </strong><i>{{$cotisee}}f</i></p>
          <p><strong>Bilan des Cotisations:</strong>
            <?php $mt = $cotisee-$countReunion*500 ?>
            @if($mt > 0)
              <i>Est avancé de {{$mt}}f</i>
            @elseif ($mt == 0)
              <i>Ne doit rien</i>
            @else
              <i>Doit {{$mt*(-1)}}f</i>
            @endif
          </p>
        </div>
				<div class="col-lg-8 col-md-8 col-sm-12">
          @foreach($detailReunion as $key=>$value)
					<div style="margin-left:30px; display:inline-block; margin-bottom:30px;">
          <?php setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
            $dt = utf8_encode(strftime("%d %B %Y", strtotime($date[$key])));
          ?>
            <strong style="color:#8A8A00;">{{$dt}}</strong><br>
            <input type="checkbox" disabled <?php if($value=='present') echo "checked";?>><b>{{$value}}</b>
            <input type="checkbox" checked disabled><b>{{$payer[$key]}}<b>
					</div>
          @endforeach
				</div>
      </div>
			<hr>
      <h6 class="card-body-title" style="text-align:center; color:darkblue">Informations Cotisations exceptionnelles</h6>
      <hr>
		</div>
	</div>
</div>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	 crossorigin="anonymous"></script>


@endsection
