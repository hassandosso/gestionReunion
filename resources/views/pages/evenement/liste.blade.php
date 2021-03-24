@extends('layouts.app')

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Tableau</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Liste des Evènements
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-5p">No</th>
                  <th class="wd-20p">Designation</th>
                  <th class="wd-15p">Lieu</th>
                  <th class="wd-10p">Date Prévue</th>
                  <th class="wd-20p">Cotisation Rattachée</th>
                  <th class="wd-10p">Budget</th>
                  <th class="wd-20p">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($evenements as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row->nom}}</td>
                  <td>{{$row->lieu}}</td>
                  <td>{{$row->date}}</td>
                  <td><a href="{{asset('gestion/reunion/cotisation/details/'.$row->cotisation_id)}}">{{$row->cotisation}}</a></td>
                  <td>{{number_format($row->budget,0,',','.')}}</td>
                  <td>
                    <a href="{{URL::to('gestion/reunion/modifier/evenement/'.$row->id)}}" class="btn btn-info btn-sm" title="Modifier"><i class="fa fa-edit"></i></a>
                    <a href="{{URL::to('gestion/reunion/supprimer/evenement/'.$row->id)}}" class="btn btn-danger btn-sm" id="delete" title="Supprimer"><i class="fa fa-trash"></i></a>
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
