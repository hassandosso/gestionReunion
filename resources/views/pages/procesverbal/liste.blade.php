@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Liste des Procès verbaux
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">No</th>
                  <th class="wd-15p">Date de la Réunion</th>
                  <th class="wd-15p">PV</th>
                  <th class="wd-20p">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($listepv as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <?php setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
                    $dt = utf8_encode(strftime("%d %B %Y", strtotime($row->date)));
                  ?>
                  <td>{{$dt}}</td>
                  <td><a href="{{asset($row->link)}}" target="_blank">PV reunion</a></td>
                  <td><a href="{{URL::to('gestion/reunion/modifierpv/'.$row->id)}}" class="btn btn-info btn-sm" title="Modifier"><i class="fa fa-edit"></i>Modifier</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection()
