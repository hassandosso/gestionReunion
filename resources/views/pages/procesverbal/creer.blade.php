@extends('layouts.app')

@section('content')
<div class="sl-mainpanel">

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Réunion Familiale</a>
    <span class="breadcrumb-item active">Section Enregistrement des Procès verbaux</span>
  </nav>

  <div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
         <h6 class="card-body-title">Nouvel enregistrement
           <a href="{{route('liste.pv')}}" class="btn btn-success btn-sm pull-right">Liste de PV</a>
         </h6>
<?php
  $reunions = DB::table('procesverbals')
              ->join('reunions','procesverbals.id_reunion','reunions.id')
              ->select('procesverbals.id','procesverbals.id_reunion','reunions.date')
              ->where('procesverbals.link',NULL)
              ->orderBy('date')->get();
?>
         <p class="mg-b-20 mg-sm-b-30">Renseignez le champ</p>
         <form method="post" action="{{route('store.pv')}}">
           @csrf
         <div class="form-layout">
           <div class="row mg-b-25">
             <div class="col-lg-4 col-sm-6">
               <select name="id_reunion">>
                 <option value="">Choisissez la date de la réunion</option>
                 @foreach ($reunions as $reu)
                 <?php setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
                   $dt = utf8_encode(strftime("%d %B %Y", strtotime($reu->date)));
                 ?>
                  <option value="{{$reu->id_reunion}},{{$reu->id}}">{{$dt}}</option>
                 @endforeach
               </select>
             </div>
             <div class="col-lg-12">
               <div class="form-group">
                 <label class="form-control-label">Procès Verbal: <span class="tx-danger">*</span></label>
                 <textarea class="form-control" name="link" id="summernote1"></textarea>
               </div>
             </div><!-- col-4 -->

           <div class="form-layout-footer">
             <button class="btn btn-info mg-r-5">Enregistrer</button>
             <a href="{{route('liste.pv')}}" class="btn btn-secondary">Annuler</a>
           </div><!-- form-layout-footer -->
         </div><!-- form-layout -->
       </form>
       </div><!-- card -->

  </div><!-- sl-pagebody -->

  </div><!-- sl-mainpanel -->
<script src="{{asset('public/backend/js/onlineJs/jquery-3.5.1.min.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
   crossorigin="anonymous"></script>
@endsection
