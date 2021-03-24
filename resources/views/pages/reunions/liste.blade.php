@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Liste des Réunions
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">No</th>
                  <th class="wd-15p">Date</th>
                  <th class="wd-15p">Nombre Présent</th>
                  <th class="wd-20p">Somme Cotisée</th>
                  <th class="wd-15p">Procès Verbal</th>
                  <th class="wd-15p">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($listeReunion as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <?php setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
                    $dt = utf8_encode(strftime("%d %B %Y", strtotime($row->date)));
                  ?>
                  <td>{{$dt}}</td>
                  <td>{{$row->nombre_present}}</td>
                  <td>{{$row->montant_obtenu}}</td>
                  <td>@if ($row->link !='')
                    <a href="{{asset($row->link)}}" target="_blank">PV reunion</a>
                  @endif</td>
                  <td>
                    <a href="{{URL::to('gestion/reunion/reuniondujour/details/'.$row->id)}}" class="btn btn-warning btn-sm" title="Détails"><i class="fa fa-eye"></i></a>
                    <a href="{{URL::to('gestion/reunion/supprimer/reuniondujour/'.$row->id)}}" class="btn btn-danger btn-sm" id="delete" title="Supprimer"><i class="fa fa-trash"></i></a>
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
