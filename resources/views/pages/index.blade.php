@extends('layouts.app')

@section('content')
<div class="sl-mainpanel">

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Tableau de bord</a>
    <span class="breadcrumb-item active">Bilan Trésorerie</span>
  </nav>

  <div class="sl-pagebody">

    <div class="row row-sm">
      <div class="col-sm-6 col-xl-4">
        <div class="card pd-20 bg-primary">
          <div class="d-flex justify-content-between align-items-center mg-b-10">
            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Cotisations Mensuelles</h6>
            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
          </div><!-- card-header -->
          <?php
            $cotisation = DB::table('reunions')->sum('montant_obtenu');
            $first = DB::table('reunions')->orderby('montant_obtenu','DESC')->first();
            $montants = DB::table('reunions')->select('montant_obtenu')->get();
            $mt = array();
            foreach ($montants as $row){
              array_push($mt,$row->montant_obtenu);
            }
            $maj = DB::table('mise_ajours')->sum('montant');

          ?>
          <div class="d-flex align-items-center justify-content-between">
            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
            <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{number_format(($cotisation + $maj),0,',','.')}} F</h3>
          </div><!-- card-body -->
          <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
            <div>
              <span class="tx-11 tx-white-6">Plus gros montant</span>
              <h6 class="tx-white mg-b-0">{{number_format($first->montant_obtenu,0,',','.')}} F</h6>
            </div>
            <div>
              <span class="tx-11 tx-white-6">Date</span>
              <h6 class="tx-white mg-b-0">{{$first->date}}</h6>
            </div>
          </div><!-- -->
        </div><!-- card -->
      </div><!-- col-3 -->
      <?php
      $count =0;
        $cotisationEx = DB::table('paiement_cotisations')->get();
        $totalSum = 0;
        $id_cotisation = array();
        foreach($cotisationEx as $paies){
          if($paies->paiement !=NULL){
            $paie = explode(',',$paies->paiement);
            $totalSum = $totalSum + array_sum($paie);
            if(!in_array($paies->id_cotisation,$id_cotisation)){
              array_push($id_cotisation,$paies->id_cotisation);
            }
          }
        }
        $sommeCoti = array();
        foreach($id_cotisation as $id){
          $montant = 0;
          foreach($cotisationEx as $cot){
            if($cot->id_cotisation == $id){
            if ($cot->paiement !=NULL){
              $montant = $montant + array_sum(explode(',',$cot->paiement));
            }
          }
          }
          $nom = DB::table('cotisations')->select('nom')->where('id',$id)->first();
          $sommeCoti[$nom->nom] = $montant;
        }
      ?>
      <div class="col-sm-6 col-xl-4 mg-t-20 mg-sm-t-0">
        <div class="card pd-20 bg-secondary">
          <div class="d-flex justify-content-between align-items-center mg-b-10">
            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Cotisation exceptionnelle</h6>
            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
          </div><!-- card-header -->
          <div class="d-flex align-items-center justify-content-between">
            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
            <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{number_format($totalSum,0,',','.')}} F</h3>
          </div><!-- card-body -->
          <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

  <div class="carousel-inner">
    <?php $count =0 ?>
    @foreach($sommeCoti as $key=>$val)

    <div class="carousel-item <?php if($count==0) echo "active" ?>">
      <div>
        <span class="tx-14 tx-white-6">{{$key}}</span>
        <h6 class="tx-white mg-b-0">{{number_format($val,0,',','.')}} F</h6>
      </div>

    </div>
    <?php $count++ ?>
    @endforeach
  </div>
</div>

          </div><!-- -->
        </div><!-- card -->
      </div><!-- col-3 -->
      <?php
        $sum_dons = DB::table('dons')->sum('montant');
        $sum_amandes = DB::table('amandes')->sum('montant');
      ?>
      <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
        <div class="card pd-20 bg-purple">
          <div class="d-flex justify-content-between align-items-center mg-b-10">
            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Dons et Amandes</h6>
            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
          </div><!-- card-header -->
          <div class="d-flex align-items-center justify-content-between">
            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
            <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{number_format(($sum_dons + $sum_amandes),0,',','.')}} F</h3>
          </div><!-- card-body -->
          <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
            <div>
              <span class="tx-11 tx-white-6">Dons</span>
              <h6 class="tx-white mg-b-0">{{number_format($sum_dons,0,',','.')}} F</h6>
            </div>
            <div>
              <span class="tx-11 tx-white-6">Amandes</span>
              <h6 class="tx-white mg-b-0">{{number_format($sum_amandes,0,',','.')}} F</h6>
            </div>
          </div><!-- -->
        </div><!-- card -->
      </div><!-- col-3 -->
      <?php
        $depenses = DB::table('depenses')->sum('montant');
        $g_depense = DB::table('depenses')
                    ->leftJoin('evenements','depenses.id_evenement','evenements.id')
                    ->select('depenses.*','evenements.nom')
                    ->orderBy('montant','DESC')->first();
      ?>
      <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0" style="margin-top:30px;">
        <div class="card pd-20 bg-danger">
          <div class="d-flex justify-content-between align-items-center mg-b-10">
            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Depenses</h6>
            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
          </div><!-- card-header -->
          <div class="d-flex align-items-center justify-content-between">
            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
            <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{number_format(($depenses),0,',','.')}} F</h3>
          </div><!-- card-body -->
          <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
            <div>
              <span class="tx-11 tx-white-6">Plus Grosse Dépense</span>
              <h6 class="tx-white mg-b-0">{{number_format($g_depense->montant,0,',','.')}} F</h6>
            </div>
            <div>
              <span class="tx-11 tx-white-6">Détails</span>
              <h6 class="tx-white mg-b-0"><a href="{{URL::to('gestion/reunion/details/depense/'.$g_depense->id)}}" style="text-decoration:none; color:white">Cliquer</a></h6>
            </div>
          </div><!-- -->
        </div><!-- card -->
      </div><!-- col-3 -->
        <?php
          $mt_dispo = $totalSum + $cotisation + $maj + $sum_dons + $sum_amandes - $depenses;

          $p_mensuel =($cotisation + $maj)*100/$mt_dispo;
          $p_except = $totalSum*100/$mt_dispo;
          $p_dam = ($sum_dons + $sum_amandes)*100/$mt_dispo;
          $p_dep = $depenses*100/$mt_dispo;
        ?>
      <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0" style="margin-top:30px;">
        <div class="card pd-20 bg-sl-primary">
          <div class="d-flex justify-content-between align-items-center mg-b-10">
            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Montant disponible</h6>
            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
          </div><!-- card-header -->
          <div class="d-flex align-items-center justify-content-between">
            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
            <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{number_format(($mt_dispo),0,',','.')}} F</h3>
          </div><!-- card-body -->
          <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
            <div>
              <span class="tx-11 tx-white-6">Mensuel</span>
              <h6 class="tx-white mg-b-0">{{number_format((float)$p_mensuel, 2, '.', '')}}%</h6>
            </div>
            <div>
              <span class="tx-11 tx-white-6">Exceptionnelle</span>
              <h6 class="tx-white mg-b-0">{{number_format((float)$p_except, 2, '.', '')}}%</h6>
            </div>
            <div>
              <span class="tx-11 tx-white-6">Dons & Amandes</span>
              <h6 class="tx-white mg-b-0">{{number_format((float)$p_dam, 2, '.', '')}}%</h6>
            </div>
            <div>
              <span class="tx-11 tx-white-6">Dépenses</span>
              <h6 class="tx-white mg-b-0">-{{number_format((float)$p_dep, 2, '.', '')}}%</h6>
            </div>
          </div><!-- -->
        </div><!-- card -->
      </div><!-- col-3 -->
    </div><!-- row -->

  </div><!-- sl-pagebody -->

  </div><!-- sl-mainpanel -->
@endsection
