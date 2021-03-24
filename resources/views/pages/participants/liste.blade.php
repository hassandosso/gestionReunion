@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->
<?php
  $not_delete = DB::table('reunions')->select('identification')->get();
?>
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Liste des membres
            <a href="{{route('creer')}}" class="btn btn-warning btn-sm" style="float:right">Ajouter un Membre</a>
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-5p">No</th>
                  <th class="wd-15p">Nom et Prénoms</th>
                  <th class="wd-20p">Surnom / ID</th>
                  <th class="wd-15p">Téléphone</th>
                  <th class="wd-15p">Nom du père</th>
                  <th class="wd-15p">Status</th>
                  <th class="wd-20p">Actions</th>

                </tr>
              </thead>
              <tbody>
                <?php
                  $reunions = DB::table('reunions')->get();
                  $maj = DB::table('mise_ajours')->get();
                  $count = count($reunions);
                ?>
                @foreach ($liste as $key=>$row)
                <?php
                  $paie = 0;
                  foreach ($reunions as $key_r =>$val){
                    $arr_id = explode(',',$val->identification);
                    array_unshift($arr_id,100000);
                    $arr_cotisation = explode(',',$val->cotisation);
                    array_unshift($arr_cotisation,0);
                    $index = array_search($row->identification,$arr_id);
                    if($index){
                      $paie = $paie + intval($arr_cotisation[$index]);
                    }

                  }
                  foreach ($maj as $m){
                    if ($m->id_participant == $row->id){
                      $paie = $paie + $m->montant;
                    }
                  }

                  $somme_reu = 1000 * $count;
                  $total = $paie - $somme_reu;
                ?>
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row->nom}} {{$row->prenom}}</td>
                  <td>{{$row->surnom}} / {{$row->identification}}</td>
                  <td>{{$row->contact}}</td>
                  <td>{{$row->pere}}</td>
                  @if ($row->decede == 1)
                  <td><span class="badge badge-danger">DECEDE</span></td>
                  @else
                  @if ($total > 0)
                  <td class="text-success">+{{$total}}f</td>
                  @elseif ($total < 0)
                  <td class="text-danger">{{$total}}f</td>
                  @else
                  <td class="text-info">{{$total}}</td>
                  @endif
                  @endif
                  <td>
                    <a href="{{URL::to('detail/membre/'.$row->identification)}}" class="btn btn-warning btn-sm" title="Détails"><i class="fa fa-eye"></i></a>
                    @if ($row->decede == null)
                    <a href="{{URL::to('modifier/membre/'.$row->id)}}" class="btn btn-info btn-sm" title="Modifier"><i class="fa fa-edit"></i></a>
                    <?php
                      $index = false;
                      foreach($not_delete as $id){
                        $index = array_search($row->identification,explode(',',$id->identification));
                        if($index){
                          break;
                        }
                      }
                    ?>
                    <a href="{{URL::to('supprimer/membre/'.$row->id)}}" class="btn btn-danger btn-sm" id="delete" title="Supprimer" style="display:<?php if($index) echo "none";?>"><i class="fa fa-trash"></i></a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection()
