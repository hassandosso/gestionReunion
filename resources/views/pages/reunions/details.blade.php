@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->
        <?php setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
          $dt = utf8_encode(strftime("%d %B %Y", strtotime($d_reunion->date)));
        ?>
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Réunion du {{$dt}}
          </h6>
          <?php
          if($d_reunion->identification != NULL){
            $cotisation = explode(',',$d_reunion->cotisation);
            $presence = explode(',',$d_reunion->presence);
            $ids = explode(',', $d_reunion->identification);
          }else{
            $cotisation = NULL;
            $presence = NULL;
            $ids = NULL;
          }

          ?>

          <table id="datatable1" class="table display responsive nowrap">
            <h6 class="text-danger">Liste de cotisation et de présence</h6>
            <thead class="table-dark">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Participants</th>
                <th scope="col">Présences</th>
                <th scope="col">Cotisation</th>
              </tr>
            </thead>
            <tbody>
              @if ($ids != NULL)
              @foreach($ids as $key=>$value)
              <?php
                $info = DB::table('participants')->where('identification',$value)->first();
              ?>
            <tr>
              <th scope="row">{{$key+1}}</th>
              <td>{{$info->prenom}} ({{$info->surnom}} /{{$value}})</td>
              <td>{{$presence[$key]}}</td>
              <td>{{$cotisation[$key]}}</td>
            </tr>
            @endforeach
            @endif
          </tbody>
          <tfoot class="table-dark">
            <tr>
              <td></td>
              <td>Résumé</td>
              <td>{{$d_reunion->nombre_present}} Présents</td>
              <td>{{$d_reunion->montant_obtenu}}</td>
            </tr>
          </tfoot>
        </table>

        </div><!-- card -->
    </div><!-- sl-mainpanel -->

    <!-- ########## END: MAIN PANEL ########## -->
@endsection()
