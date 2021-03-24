@extends('layouts.app')

@section('content')
<style>
b,strong{
	font-size: 16px;
}
.badge-secondary{
	font-size:13px;
	margin-left: 15px;
}
</style>
	<!-- Single Product -->
<div class="sl-mainpanel">

	<div class="single_product">
		<div class="container">
      <div class="row">
      <div class="col-lg-8 col-sm-8">
				@if ($membre->decede == 1)
					<h5 style="text-align:center;margin-bottom:-30px"><span class="badge badge-danger">MEMBRE DECEDE</span></h5>
				@endif
          <img src="{{asset($membre->photo)}}" alt="{{$membre->nom}} {{$membre->prenom}}"
          style="float:right; width:150px; height:150px; margin-top:80px; border:1px solid darkblue">
      </div>
    </div>
    <div class="row">
      <a href="{{route('listeMembre')}}" class="btn btn-warning btn-sm" style="float:right">Retour à la liste</a>
    </div>
    <hr>
    <h6 class="card-body-title" style="text-align:left; color:darkblue">Informations Personnelles</h6>
    <hr width="20%" align="left">
			<div class="row" style="margin-bottom:30px;">
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Numéro d'identification:  </strong><span class="badge badge-secondary">{{$membre->identification}}</span>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Nom & Prénoms:  </strong><span class="badge badge-secondary">{{$membre->nom}} {{$membre->prenom}}</span>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Surnom:  </strong><span class="badge badge-secondary">{{$membre->surnom}}</span>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Nom du Père:  </strong><span class="badge badge-secondary">{{$membre->pere}}</span>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Téléphone:  </strong><span class="badge badge-secondary">{{$membre->contact}}</span>
        </div>
        <div class="col-lg-4 col-sm-6 col-md-4">
          <strong>Domicile:  </strong><span class="badge badge-secondary">{{$membre->adresse}}</span>
        </div>
			</div>
      <hr>
      <h6 class="card-body-title" style="text-align:left; color:darkblue;">Informations Réunions Mensuelles</h6>
      <hr width="24%" align="left">
      <div class="row">
        <div class="col-lg-4 col-sm-12 col-md-4">
					<p><strong>Total Réunion:  </strong><span class="badge badge-secondary">{{$countReunion}}</span></p>
          <p><strong>Nombre de Participation:  </strong><span class="badge badge-secondary">{{$nbParticipation}}</span></p>
            <p><strong>Montant Cotisé:  </strong><span class="badge badge-secondary">{{$cotisee}}f</span></p>
          <p><strong>Status:</strong>
            <?php $mt = $cotisee-$countReunion*1000 ?>
						@if ($membre->decede == null)
            @if($mt > 0)
              <span class="badge badge-secondary">Avancé de {{$mt}}f</span>
            @elseif ($mt == 0)
              <span class="badge badge-secondary">A jour</span>
            @else
              <span class="badge badge-secondary">Doit {{$mt*(-1)}}f</span>
            @endif
						@endif
          </p>
        </div>
				<div class="col-lg-8 col-md-8 col-sm-12">
					<div class="col-12 text-center"><h6>Detail des paiements</h6></div>
					<div class="col-12 border border-left rounded-left">
          @foreach($detailReunion as $key=>$value)
					<div style="margin-left:30px; display:inline-block; margin-bottom:30px;">
						<?php
						$sum = 0;
							foreach ($date as $key_d =>$dt){
								if ($dt == $value){
									$sum = $sum + $payer[$key_d];
								}
							}
						?>
            <strong style="color:#8A8A00; font-size:14px;">{{$value}}</strong><br>
            <input type="checkbox" checked disabled><b>{{$sum}}</b>
					</div>
          @endforeach
					@foreach($maj as $m)
					<div style="margin-left:30px; display:inline-block; margin-bottom:30px;">
          <?php setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
            $dt2 = utf8_encode(strftime("%d %B %Y", strtotime($m->created_at)));
          ?>
            <strong style="color:#8A8A00; font-size:14px;">{{$dt2}}</strong><br>
						<input type="checkbox" disabled checked><b>Mise à Jour</b>
            <input type="checkbox" checked disabled><b>{{$m->montant}}</b>
					</div>
					@endforeach
				</div>
				</div>
      </div>
			<hr>

      <h6 class="card-body-title" style="text-align:left; color:darkblue">Informations Cotisations exceptionnelles</h6>
      <hr width="29%" align="left">
			<div class="container">
				<table id="datatable2" class="table display responsive nowrap">
					<thead>
						<tr>
							<th class="wd-5p">No</th>
							<th class="wd-15p">Désignation</th>
							<th class="wd-10p">Somme cotisée</th>
							<th class="wd-15p">Status</th>
						</tr>
					</thead>
					<tbody>
				@foreach($cotisations as $no =>$cotise)
				<?php
					$montant = explode(',',$paiement[$no]);
					$total = array_sum($montant);

						$infos = DB::table('cotisations')->where('nom',$cotise)->first();
				?>
				@if ($total == 0 and $membre->decede == 1)
				@else
				<tr>
					<td>{{$no+1}}</td>
					<td>{{$cotise}}</td>
					<td>{{$total}}</td>
					@if ($active[$no] == 1)
					@if (($infos->montant_fixe-$total) == 0 )
					<td>Soldée</td>
					@elseif(($infos->montant_fixe-$total) > 0)
					<td><span class="badge badge-danger">-{{$infos->montant_fixe-$total}}</span></td>
					@else
						<td><span class="badge badge-infos">+{{-($infos->montant_fixe-$total)}}</span></td>
					@endif
					@else
					<td><span class="badge badge-infos">Fermée</span></td>
					@endif
				</tr>
				@endif
				@endforeach
			</tbody>
		</table>
			</div>
			</div>
		</div>
	</div>
</div>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	 crossorigin="anonymous"></script>

<script src="{{asset('public/backend/js/onlineJs/jquery-3.5.1.min.js')}}"></script>


@endsection
